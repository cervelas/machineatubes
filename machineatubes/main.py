import time
import signal
import pprint
import argparse
import webview 
import threading
import platform

import rtmidi2 as rm
from flask import Flask, render_template, request

from machineatubes.server import server
from machineatubes.parser import parseFile2Score, parseJSON2Score
from machineatubes.tube import out, Tube, VideoNote, abort, LyricsNote


close = threading.Event()

def is_win():
    return platform.system() == 'Windows'

def is_mac():
    return platform.system() == 'Darwin'

screens = webview.screens
    
def handler(signum, frame):
    '''
    Handle system interrupt
    '''
    print("Ctrl-c was pressed. Exiting...")
    abort.set()
    exit(0)
 
signal.signal(signal.SIGINT, handler)

DEFAULT_DEVICE = 0

window = False

midi_outs = rm.get_out_ports()

parser = argparse.ArgumentParser(
                    prog='MachineaTubes',
                    description="""La Machine a Tube""",
                    epilog='Clément Borel',
                    formatter_class=argparse.RawTextHelpFormatter)

parser.add_argument('-v', '--verbose', action="store_true", help="Verbose Mode")

if len(midi_outs) == 0:
    exit("Aborted, No midi device found !")

parser.add_argument('--midiout', type=int,
                    default=DEFAULT_DEVICE,
                    choices=[ i for i, o in enumerate(midi_outs) ], 
                    help="Output Midi Device Number, Default is 0 (%s)\nAvailable MIDI Devices:\n%s\n\n" % (midi_outs[0], 
                            "\n".join([ "%s: %s" % (i, o) for i, o in enumerate(midi_outs) ])))  


parser.add_argument('--no-ui', action="store_true", help="do not start UI")

parser.add_argument('--file', help="No-UI Only: File to play (json or xml)")

parser.add_argument('--out', type=str, help="No-UI Only: Export to json")

parser.add_argument('--bpm', type=int, help="No-UI Only: BPM Override")

parser.add_argument('-np', '--noplay', action="store_true", help="No-UI Only: Wait enter for play")

args = parser.parse_args()

class Machine:
    def __init__(self):
        self.win = False
        self.ctrlwin = False
        self.tubes = [] 
        self.autoplay = False

    def close(self):
        close.set()

    def stop(self):
        abort.set()

    def start(self):
        self.win.show()
        if len(screens) > 1:
            if is_mac():
                self.win.resize(screens[1].width, screens[1].height)
                self.win.move(screens[0].width, 0)
            if is_win():
                self.win.move(screens[1].width + 500, 0)
                self.win.toggle_fullscreen()
                time.sleep(0.2)
                self.win.toggle_fullscreen()
                time.sleep(0.2)
                self.win.toggle_fullscreen()

    def play(self):
        if len(self.tubes) > 0 and self.tubes[0].playing is False:
            abort.clear()
            self.tubes[0].aplay(self.win, args.verbose)
        if len(self.tubes) > 1:
            self.tubes.pop(0)

    def log(self, txt):
        self.ctrlwin.evaluate_js("log('%s')" % txt)

    def load_tube(self, payload):
        self.tubes.append(parseJSON2Score(payload, args.verbose))

        t = self.tubes[-1]
        
        if args.verbose:
            self.log("parts:")
            for k, v in t.parts.items():
                self.log("\t(%s) %s channel %s" % (k, v["name"], v["channel"]))
            
            self.log("Signature : %s/%s" % (t.beat_time, t.beat_type))
            self.log("%s BPM" % t.bpm)
            self.log("%s measures" % t.measures)
            self.log("duration %s s" % t.duration())
        self.log("Received the song %s !" % t.name)
        self.log("Press P to play")

    def load_score_file(self):
        file_types = (' JSON Files (*.json)', 'MXML Files (*.xml;*.mxml;*.musicxml)')

        result = self.ctrlwin.create_file_dialog(webview.OPEN_DIALOG, allow_multiple=False, file_types=file_types)
        
        if result:
            self.tubes.append(parseFile2Score(result[0]))
            self.log("loaded file " + result[0])
            t = self.tubes[-1]
        
            if args.verbose:
                self.log("parts:")
                for k, v in t.parts.items():
                    self.log("\t(%s) %s channel %s" % (k, v["name"], v["channel"]))
                
                self.log("Signature : %s/%s" % (t.beat_time, t.beat_type))
                self.log("%s BPM" % t.bpm)
                self.log("%s measures" % t.measures)
                self.log("duration %s s" % t.duration())
            self.log("Press P to play")
        if self.autoplay:
            self.play()

machine = Machine()


from flask import Flask, render_template

import webview

@server.route('/play', methods=['POST'])
def playsong():
    '''
    This will load a song when a post request is received
    '''
    print("received tube " + str(request.json))
    try:
        machine.load_tube(request.json)
    except Exception as e:
        print("Error on RX: %s" % e)
        return "error", 500
    return "success", 200

def webview_cb():
    machine.win.hide()
    time.sleep(2)
    machine.start()
    while not close.wait(1):
        pass
    machine.stop()
    time.sleep(0.1)
    # add check
    machine.win.destroy()
    machine.ctrlwin.destroy()

def main():
    '''
    Entry Point
    '''
    out.open_port(args.midiout)

    print("Will play on %s" % midi_outs[args.midiout])

    if args.no_ui:
        score = parseFile2Score(args.file, args.verbose)

        if args.bpm:
            print("force bpm to %s BPM" % args.bpm)
            score.bpm = args.bpm

        print("parts:")
        for k, v in score.parts.items():
            print("\t(%s) %s channel %s" % (k, v["name"], v["channel"]))
        
        print("Signature : %s/%s" % (score.beat_time, score.beat_type))
        print("%s BPM" % score.bpm)
        print("%s measures" % score.measures)
        print("duration %s s" % score.duration())

        if args.noplay:
            input("press enter to play")

        if args.out:
            score.export(args.out)
            return

        score.play()
    else:
        print(screens)
        window = webview.create_window('Machine à Tubes', server, width=1000, height=700, http_port=23456, frameless=is_mac(), focus=False)
        
        ctrlwindow = webview.create_window('Control Room', url="/ctrl", js_api=machine, width=800, height=600, frameless=True)

        machine.win = window
        machine.ctrlwin = ctrlwindow
        Tube.window = window
        VideoNote.window = window
        LyricsNote.window = window
        webview.start(webview_cb, http_port=23456, debug=True, private_mode=False, gui="cef")
        exit(0)

if __name__ == "__main__":
    main()