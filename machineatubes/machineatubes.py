import time
import signal
import pprint
import argparse
import webview 
import threading
import rtmidi2 as rm
from pathlib import Path
from bottle import get, static_file

from machineatubes.parser import parseMXML2Score, parseJSON2Score
from machineatubes.tube import out, Tube, VideoNote, abort

 
def handler(signum, frame):
    msg = "Ctrl-c was pressed. Exiting..."
    abort.set()
    exit(0)
 
signal.signal(signal.SIGINT, handler)

DEFAULT_DEVICE = 0

#############################
# ARGUMENTS & GLOBAL VARS

window = False

midi_outs = rm.get_out_ports()

parser = argparse.ArgumentParser(
                    prog='MachineaTubes',
                    description="""La Machine a Tube""",
                    epilog='Clément Borel',
                    formatter_class=argparse.RawTextHelpFormatter)

parser.add_argument('file', help="File to play (json or xml)")

parser.add_argument('--out', type=str, help="Export to json")

parser.add_argument('--bpm', type=int, help="BPM")

parser.add_argument('-v', '--verbose', action="store_true", help="Verbose Mode")
parser.add_argument('-np', '--noplay', action="store_true", help="Wait enter for play")

parser.add_argument('--no-ui', action="store_true", help="do not start UI")

if len(midi_outs) == 0:
    exit("Aborted, No midi device found !")

parser.add_argument('--midiout', type=int,
                    default=DEFAULT_DEVICE,
                    choices=[ i for i, o in enumerate(midi_outs) ], 
                    help="Output Midi Device Number, Default is 0 (%s)\n\n%s" % (midi_outs[0], 
                            "\n".join([ "%s: %s" % (i, o) for i, o in enumerate(midi_outs) ])))  

args = parser.parse_args()


class Api:
    def __init__(self, tube):
        self.win = False
        self.tube = tube

    def close(self):
        self.tube.stop.set()
        time.sleep(0.5)
        self.win.destroy()
    
    def fullscreen(self):
        self.win.toggle_fullscreen()

def ui_main(window, score):
    score.play(window)

def main():

    out.open_port(args.midiout)    

    print("Press ctrl-c to quit")

    print("Will play on %s" % midi_outs[args.midiout])

    score = Tube()

    if args.file.endswith(".xml"):
        print("Load Music XML File %s" % args.file)
        score = parseMXML2Score(args.file, args.verbose)
    elif args.file.endswith(".json"):
        print("Loaded JSON MAT File %s" % args.file)
        score = parseJSON2Score(args.file, args.verbose)

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
        
    if args.no_ui:
        score.play()
    else:
        api = Api(score)
        window = webview.create_window('La Machine à Tubes', str(Path(__file__).parent.parent / 'examples' / 'ui.html'), js_api=api, 
                                    width=1600, height=1200)
        api.win = window
        VideoNote.window = window
        webview.start(ui_main, (window, score), http_server=True, http_port=23456, debug=True, private_mode=False)

if __name__ == "__main__":
    main()