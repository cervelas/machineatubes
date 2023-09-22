
import xml.etree.ElementTree as ET
import json
import pprint

from machineatubes.tube import Tube, MidiNote, VideoNote, LyricsNote

def parseFile2Score(filepath, verbose=False):
    if filepath.endswith(".xml"):
        xml = ET.parse(filepath)
        print("Load Music XML File %s" % filepath)
        return parseMXML2Score(xml, verbose)
    elif filepath.endswith(".json"):
        with open(filepath, 'r', encoding='utf-8-sig') as f:
            struct = json.load(f)
        print("Loaded JSON MAT File %s" % filepath)
        return parseJSON2Score(struct, verbose)

def parseJSON2Score(payload, verbose=False):
    '''
    Parse XML file to SCore structure
    '''

    score = Tube(payload.get("name", "noname"))
    
    score.bpm = int(payload.get("tempo", 120))

    score.beat_time = 4
    score.beat_type = 4

    max_length = 0

    score.style_flavor = payload.get("style").split("_")[1] or "1"

    score.infos = {
        "name": payload.get("name"),
        "ambiance": payload.get("ambiance"),
        "style": payload.get("style").split("_")[0],
        "prenom": payload.get("prenom"),
        "numero": payload.get("numero"),
        "id_video": payload.get("id_video"),
        "intro_video_url": "assets/videos/machine/bug.mp4",
    }
    
    pprint.pprint(score.infos)

    for name, part in payload.get("song").items():
        score.parts[name] = { 
            "name": name,
            "type": part.get("type"),
            "channel": part.get("channel", part["type"]),
        }

        if part["type"] == "notes":
            midi_channel = int(part["channel"])
            if verbose:
                print("\n\nPART %s" % name)
            
            if len(part.get("notes", [])) == 0:
                print("Empty Part !!")
            
            notes = part.get("notes", [])

            for note in notes:
                        
                duration = int(note.get("duration", score.beat_time))
                
                b = int(note["beat"])

                if b > max_length:
                    max_length = b

                score.midinote( b, 
                            MidiNote(int(note["note"]),
                                duration=duration,
                                channel=midi_channel)
                            )

        elif part["type"] == "video":
            
            notes = part.get("triggers", [])

            for note in notes:
                
                b = int(note["beat"])

                if b > max_length:
                    max_length = b

                score.videonote( b, 
                            VideoNote(note["file"],
                                position=note.get("position", False))
                            )
                
        elif part["type"] == "lyrics":
            
            notes = part.get("lyrics", [])

            for note in notes:
                
                if len(note["text"]) > 0:
                    b = int(note["beat"]) - 4

                    if b > max_length:
                        max_length = b


                    score.lyricsnote(b, LyricsNote(note["text"].replace('"', ''),
                                    position=note.get("position", False)))


    score.measures = int(max_length / score.beat_type) + 1

    score.mix_videos()

    score.get_intro_video(payload.get("id_video"))

    return score


def parseMXML2Score(xml, verbose=False):
    '''
    Parse XML file to Score structure
    '''
    root = xml.getroot()

    score = Tube()

    for part in root.find('./part-list').findall('score-part'):
        score.parts[part.attrib["id"]] = { 
            "name": part.find('./part-name').text,
            "type": "notes",
            "channel": int(part.find('./midi-instrument/midi-channel').text),
        }
    
    for part in root.findall('./part'):
        midi_channel = score.parts[part.attrib["id"]]["channel"]
        if verbose:
            print("\n\nPART %s" % score.parts[part.attrib["id"]]["name"])
        number = 0
        for measure in part.findall('./measure'):
            snd = measure.findall('./sound')
            if len(snd) > 0:
                score.bpm = int(snd[0].attrib['tempo'])

            if measure.find('./attributes/time'):
                score.beat_time = int(measure.find('./attributes/time/beats').text)
                score.beat_type = int(measure.find('./attributes/time/beat-type').text)

            division = measure.find('./attributes/divisions')
            if division is not None:
                division = 1 / int(measure.find('./attributes/divisions').text)
            else:
                division = 1
            
            number = int(measure.attrib["number"])


            offset = number*score.beat_time
            for note in measure.findall('./note'):
                alt = note.find('./pitch/alter')
                if alt is not None and int(alt.text) == 1:
                    alt = "#"
                    
                duration = score.beat_time
                if note.find('./duration') is not None:
                    duration = int(note.find('./duration').text)
                
                if note.find('./pitch') is not None: 
                    n = MidiNote("".join([ note.find('./pitch/step').text, 
                                        alt or "",
                                        note.find('./pitch/octave').text ]
                                    ),
                                    duration=duration,
                                    channel=midi_channel
                                    )
                    score.midinote( offset, n )
                offset += duration
        
        if score.measures < number:
            score.measures = number

    score.mix_videos()

    return score