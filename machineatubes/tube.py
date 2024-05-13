import time
import json
import threading
import pprint
import random
import requests
from pathlib import Path, PurePosixPath

import rtmidi2 as rm

abort = threading.Event()
videoend = threading.Event()

out = rm.MidiOut() # we may need more than one
#out2 = rm.MidiOut() # we may need more than one

notes2midi = { rm.midi2note(i): i for i in range(-255, 255) }

# generate php array for notes
'''print("$midi_equiv = array(")
for k, v in notes2midi.items():
    print('"%s" => %s,' % (k, v))
print(");")
exit(0)'''

bpm2midi = {
    95: 13,
    108: 14,
    120: 15,
    140: 16,
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
    ("intro", 240, 244, 4),
]

presets_arp = [ int(i) for i in range(48, 68) ]

presets_pss = [ 24, 29, 31, 33, 34, 38, 41, 42 ]

# pprint.pprint(notes2midi) show me all your notes

t = time.perf_counter()

videospath = Path(__file__).parent / '..' / 'ui' / 'assets' / 'videos'
relpath = Path(__file__).parent / '..' / 'ui'

vext = 'mp4'

did_key = False
with open(Path(__file__).parent / "did_key", 'r') as f:
    did_key = f.read()

def getsongvideos(subfolder = ""):
    return {
        v[0]: [ str(PurePosixPath(vid.relative_to(relpath))) for vid in (videospath / subfolder / v[0]).glob('*.' + vext) ] for v in song_structure
    }



def get_intro_video():
    return random.choice(
        [ str(PurePosixPath(vid.relative_to(relpath))) for vid in (videospath / "machine" / "intro").glob('*.' + vext) ]
    )

def get_outro_video():
    return random.choice(
        [ str(PurePosixPath(vid.relative_to(relpath))) for vid in (videospath / "machine" / "outro").glob('*.' + vext) ]
    )


def get_bug_video():
    return random.choice(
        [ str(PurePosixPath(vid.relative_to(relpath))) for vid in (videospath / "machine" / "bug").glob('*.' + vext) ]
    )

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
    playing = False

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
        self.infos = {}
        self.intro_video_url = None
        self.videos = []

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
        if note.file not in self.videos:
            self.videos.append(note.file)

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
        Tube.window.load_url('/')
        videoend.clear()
        Tube.playing = True
        for v in self.videos:
            Tube.window.evaluate_js("preloadvid('%s')" % (v))
        if Tube.window:
            Tube.window.evaluate_js('displayinfos("%s","%s","%s","%s","%s","%s")' % 
                                    (self.name, self.infos["numero"], self.infos["ambiance"], self.infos["style"], self.bpm, self.infos["prenom"]))
            if self.infos.get("intro_video_url"):
                Tube.window.evaluate_js('gointro("%s")' % (self.infos["intro_video_url"]))
        
        self.gomachine()
        print("wait playsong")
        videoend.wait(30)
        print("playsong !")
        # send bpm control
        self.stop()
        self.setbpm()
        self.stop()
        self.rnd_preset()
        self.start_time = time.perf_counter()
        initsleep()
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
        videoend.clear()
        self.stop()
        self.applause()
        
        Tube.window.evaluate_js('gooutro("%s")' % get_outro_video())
        print("END")
        videoend.wait(30)
        #attente
        time.sleep(5)
        self.stop()

        Tube.playing = False

    def rnd_preset(self):
        n = random.choice(presets_arp)
        out.send_noteon(4, n, 127)
        time.sleep(0.5)
        out.send_noteoff(4, n)

        n = random.choice(presets_pss)
        out.send_noteon(14, n, 127)
        time.sleep(0.5)
        out.send_noteoff(14, n)

    def setbpm(self):
        out.send_noteon(0, bpm2midi[self.bpm], 127)
        time.sleep(0.2)
        out.send_noteoff(0, bpm2midi[self.bpm])

    def gomachine(self):
        out.send_noteon(14, 84, 127)
        time.sleep(0.2)
        out.send_noteoff(14, 84)

    def stop(self):
        out.send_noteon(0, 12, 127)
        time.sleep(0.2)
        out.send_noteoff(0, 12)
        time.sleep(0.1)
        out.send_noteon(0, 12, 127)
        time.sleep(0.2)
        out.send_noteoff(0, 12)

    def applause(self):
        out.send_noteon(0, 109, 127)
        out.send_noteon(0, 110, 127)
        out.send_noteon(0, 111, 127)
        time.sleep(0.2)
        out.send_noteoff(0, 109)
        out.send_noteoff(0, 110)
        out.send_noteoff(0, 111)

    def mix_videos(self):
        path = Path(str(self.bpm)) / self.infos["style"] / self.style_flavor
        videos = getsongvideos(path)
        for v in song_structure:
            i = 0
            for b in range(v[1], v[2], v[3]):
                if len(videos[v[0]]) == 0:
                    print("no video for %s / %s" % (path, v[0]))
                    continue
                print("add videonote %s %s" % (b, v[0]))
                vid = VideoNote(file=videos[v[0]][i % (len(videos[v[0]]))])
                self.videonote(b, vid)
                if len(videos[v[0]]) > 0:
                    i = (i + 1)

    def get_intro_video(self, id):
        import random
        self.infos["intro_video_url"] = get_bug_video()
        print("get video id " + id)
        if id and len(id) > 0:
            if Tube.playing is False:
                Tube.window.evaluate_js('loading()')

            url = "https://api.d-id.com/talks/" + id

            headers = {"accept": "application/json",
                    "Authorization": "Basic " + did_key}

            try:
                retry = 1
                while retry <= 10:
                    print("trying d-id %s" % url)
                    time.sleep(retry+1)
                    response = requests.get(url, headers=headers)

                    response = response.json()

                    if response.get("result_url"):
                        video_url = response.get("result_url")
                        response = requests.get(video_url)
                        #pprint.pprint(response.__dict__, indent=4)
                        if response.status_code == 200:
                            print("result ok from d-id !")
                            self.infos["intro_video_url"] = video_url
                        else:
                            print("bad response from d-id: %s" % response.status_code)
                            print(response)
                        
                        if Tube.playing is False:
                            Tube.window.evaluate_js('loaded()')
                        break
                    else:
                        pprint.pprint(response)

                    print("retrying... %s" % retry)
                    retry += 1

            except Exception as e:
                print("INTRO VIDEO ERROR")
                print(e)

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

    def play(self, i, verbose=False):
        if i == self.beat:
            if VideoNote.window:
                VideoNote.window.evaluate_js('playvid("%s","%s")' % (self.file, self.position))
                print("play %s" % self.file)

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
