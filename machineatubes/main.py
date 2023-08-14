import time
import signal
import pprint
import argparse
import webview 
import threading
import rtmidi2 as rm

from flask import render_template, request

from machineatubes.server import server
from machineatubes.parser import parseFile2Score, parseJSON2Score
from machineatubes.tube import out, Tube, VideoNote, abort, LyricsNote

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

parser.add_argument('--file', help="No-UI Only: File to play (json or xml)")

parser.add_argument('--no-ui', action="store_true", help="do not start UI")

parser.add_argument('--out', type=str, help="No-UI Only: Export to json")

parser.add_argument('--bpm', type=int, help="No-UI Only: BPM Override")

parser.add_argument('-v', '--verbose', action="store_true", help="Verbose Mode")
parser.add_argument('-np', '--noplay', action="store_true", help="No-UI Only: Wait enter for play")


if len(midi_outs) == 0:
    exit("Aborted, No midi device found !")

parser.add_argument('--midiout', type=int,
                    default=DEFAULT_DEVICE,
                    choices=[ i for i, o in enumerate(midi_outs) ], 
                    help="Output Midi Device Number, Default is 0 (%s)\n\n%s" % (midi_outs[0], 
                            "\n".join([ "%s: %s" % (i, o) for i, o in enumerate(midi_outs) ])))  

args = parser.parse_args()

class Machine:
    def __init__(self):
        self.win = False
        self.tubes = [] 

    def close(self):
        abort.set()
        time.sleep(0.5)
        self.win.destroy()
    
    def fullscreen(self):
        self.win.toggle_fullscreen()

    def play(self):
        if len(self.tubes) > 0 and self.tubes[0].playing is False:
            self.tubes[0].play(self.win, args.verbose)
            self.tubes.pop(0)

    def log(self, txt):
        self.win.evaluate_js("log('%s')" % txt)

    def load_tube(self, payload):
        self.tubes.append(parseJSON2Score(payload, args.verbose))

        t = self.tubes[-1]
        self.log("parts:")
        for k, v in t.parts.items():
            self.log("\t(%s) %s channel %s" % (k, v["name"], v["channel"]))
        
        self.log("Signature : %s/%s" % (t.beat_time, t.beat_type))
        self.log("%s BPM" % t.bpm)
        self.log("%s measures" % t.measures)
        self.log("duration %s s" % t.duration())

    def load_score_file(self):
        file_types = (' JSON Files (*.json)', 'MXML Files (*.xml;*.mxml;*.musicxml)')

        result = self.win.create_file_dialog(webview.OPEN_DIALOG, allow_multiple=False, file_types=file_types)
        
        if result:
            self.tubes.append(parseFile2Score(result[0]))
            self.log("loaded file " + result[0])

machine = Machine()

@server.route('/play', methods=['POST'])
def playsong():
    '''
    This will load a song when a post request is received
    '''
    print("received tube " + str(request.json))
    try:
        machine.load_tube(request.json)
    except Exception as e:
        return "Parsing error : " + str(e), 500
    return 200

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
        screens = webview.screens
        print('Available screens are: ' + str(screens))
        window = webview.create_window('La Machine à Tubes', server, js_api=machine, width=1600, height=1200, http_port=23456)
        machine.win = window
        VideoNote.window = window
        LyricsNote.window = window
        webview.start(http_port=23456, debug=True, private_mode=False)

if __name__ == "__main__":
    main()