import time
import json
import threading
import pprint
import random
from pathlib import Path, PurePosixPath

import rtmidi2 as rm

abort = threading.Event()

out = rm.MidiOut() # we may need more than one

notes2midi = { rm.midi2note(i): i for i in range(-255, 255) }

bpm2midi = {
    80: 13,
    90: 14,
    100: 15,
    110: 16,
    120: 17,
    130: 18,
    140: 19,
    150: 20,
}


song_structure = [
    ("intro", 0, 31, 8),
    ("couplet", 32, 63, 8),
    ("refrain", 64, 95, 8),
    ("intro", 96, 111, 8),
    ("couplet", 112, 143, 8),
    ("refrain", 144, 175, 8),
    ("solo", 176, 207, 8),
    ("refrain", 208, 239, 8),
    ("intro", 240, 248, 8),
]

# pprint.pprint(notes2midi) show me all your notes

t = time.perf_counter()

videospath = Path(__file__).parent / '..' / 'machine' / 'videos'
relpath = Path(__file__).parent / '..'

print(videospath)

vext = 'webm'

def getvideos():
    return {
        v[0]: [ str(PurePosixPath(vid.relative_to(relpath))) for vid in (videospath / v[0]).glob('*.' + vext) ] for v in song_structure
    }

def initsleep():
    global t
    t = time.perf_counter()

def nanosleep(s):
    ''' high precision sleep timer with drift correction '''
    global t
    first = True
    while time.perf_counter() - t < s:
        first = False
        continue

    if first:
        print("WARNING: timer drifted %ss" % s)
    t2 = time.perf_counter() if not first else time.perf_counter() + s
    t = t2

class Tube():

    window = False

    def __init__(self, name="noname") -> None:
        self.name = name
        self.notes = {}
        self.beat_time = 4
        self.beat_type = 4
        self.measures = 0
        self.bpm = None
        self.beat_duration = 0
        self.parts = {}
        self.start_time = 0
        self.time_signature = 0
        self.divisions = 16
        self.playing = False
        self.infos = {}
        #self.mix_videos()

    def duration(self):
        '''
        Duration in seconds
        '''
        return 60 * ( ( self.measures * self.beat_type ) / ( self.bpm ) )

    def progress(self, b):
        m = int(b / self.measures)
        mcount = "%s/%s " % (m, self.measures)
        t = " %0.2f" % (time.perf_counter() - self.start_time)
        return mcount + '#' * m + ('o' * (self.measures - m)) + t

    def midinote(self, beat, note):
        #if args.verbose:
        #    print("\tbeat %s added %s duration %s" % (beat, note.hnote, note.duration))
        note.offset = beat
        self.__update(beat + note.duration)
        notes = self.notes.get(beat, [])
        self.notes.update( { beat: notes + [ note ] } )
        notes = self.notes.get(beat+note.duration, [])
        self.notes.update( { beat+note.duration: notes + [ note ] } )

    def videonote(self, beat, note):
        note.beat = beat
        notes = self.notes.get(beat, [])
        self.notes.update( { beat: notes + [ note ] } )

    def lyricsnote(self, beat, note):
        note.beat = beat
        notes = self.notes.get(beat, [])
        self.notes.update( { beat: notes + [ note ] } )

    def __update(self, offset):
        for i in range(offset):
            self.notes.update( { i: self.notes.get(i, []) } )

    def export(self, file):
        json_dict = {   "name": self.name, 
                        "tempo":  self.bpm,
                        "song": {} }
        for name, part in self.parts.items():
            if part["type"] == "notes":
                json_dict["song"][name] = { 
                        "type": part["type"],
                        "channel": part["channel"],
                        "notes": []
                    }
        
                for beat, notes in self.notes.items():
                    for note in notes:
                        if note.channel == part["channel"] and beat == note.offset:
                            json_dict["song"][name]["notes"].append(
                                { "beat": beat, "note": note.note, "duration": note.duration }
                            )
                
        with open(file, 'w') as f:
            json.dump(json_dict, f, indent=4)

    def playintro(self):
        #jouer video d'intro
        pass

    def play(self, window=False, verbose=False):
        if Tube.window:
            Tube.window.evaluate_js('displayinfos("%s","%s","%s","%s","%s")' % 
                                    (self.name, self.infos["ambiance"], self.infos["style"], self.bpm, self.infos["prenom"]))
        # send bpm control
        self.setbpm()
        self.stop()
        initsleep()
        self.start_time = time.perf_counter()
        self.playing = True
        for b, notes in self.notes.items():
            if abort.is_set():
                print("aborting play...")
                break
            for note in notes:
                note.play(b, verbose)
            if verbose:
                if len(notes) == 0:
                    print(b)
            nanosleep( ( 60 / self.bpm ) )
        print("END")
        self.stop()
        self.playing = False

    def setbpm(self):
        out.send_noteon(0, bpm2midi[self.bpm], 127)
        time.sleep(0.1)
        out.send_noteoff(0, bpm2midi[self.bpm])

    def stop(self):
        out.send_noteon(0, 12, 127)
        time.sleep(0.05)
        out.send_noteoff(0, 12)

    def aplay(self, window=False, verbose=False):
        t = threading.Thread(target=self.play, args=(window,verbose))
        t.start()

    def mix_videos(self):
        videos = getvideos()
        print(videos)
        for v in song_structure:
            for b in range(v[1], v[2], v[3]):
                print("add videonote %s %s" % (b, v[0]))
                vid = VideoNote(file=random.choice(videos[v[0]]))
                self.videonote(b, vid)

class Note():
    def play(self, i, verbose=False):
        raise NotImplementedError()

class MidiNote():
    def __init__(self, note, duration = 4, velo=127, offset=0, channel=1) -> None:
        self.note = note
        self.offset = offset
        self.duration = duration
        self.velo = velo
        self.channel = channel
        
        # easy notation support
        if isinstance(note, str):
            self.note = notes2midi[note]

        self.hnote = rm.midi2note(self.note)

        if duration < 1:
            self.duration = int(duration * 16)
        if offset < 1:
            self.offset = int(offset * 16)

    def play(self, i, verbose=False):
        if i == self.offset:
            out.send_noteon(self.channel-1, self.note, self.velo)
            if verbose:
                print("%s note on %s channel %s duration %s" % ( i, self.note, self.channel, self.duration) )
        elif i == self.offset + self.duration:
            out.send_noteoff(self.channel-1, self.note)
            if verbose:
                print("%s note off %s channel %s" % ( i, self.note, self.channel) )

class VideoNote():

    window = False

    def __init__(self, file, position=None) -> None:
        self.file = file
        self.beat = 0
        self.position = position or "video"
        if VideoNote.window:
            VideoNote.window.evaluate_js("preloadvid('%s')" % (self.file))

    def play(self, i, verbose=False):
        if i == self.beat:
            if VideoNote.window:
                print("play %s" % self.file)
                VideoNote.window.evaluate_js("playvid('%s','%s')" % (self.file, self.position))

class LyricsNote():

    window = False

    def __init__(self, lyrics, position = None) -> None:
        self.lyrics = lyrics
        self.beat = 0
        self.position = position or "paroles"

    def play(self, i, verbose=False):
        if i == self.beat:
            if LyricsNote.window:
                print("show lyrics: %s" % self.lyrics)
                LyricsNote.window.evaluate_js('displaylyrics("%s","%s")' % (self.lyrics, self.position))
