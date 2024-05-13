<?php
namespace Classes;

require_once 'Machine.php';
require_once 'midiequiv.php';
class Tube extends Machine
{
    public function getTonality($mood){
        $sql = "SELECT tonality FROM song_moods WHERE mood='$mood'";
        $res = $this->query($sql);
        return $res[0]['tonality'];
    }

    public function getMoodName($tonality){
        $mood_names = array(
            'D'=>'Joyeuse',
            'Ab'=>'Stable',
            'C'=>'Mélancolique'
        );

        return $mood_names[$tonality];
    }

    public function getChordsDrums($style){
        $styles = $this->getDistinct('midi_chords','style', 'style_option="'.$style.'"');
        $key = array_rand($styles);
        return $styles[$key];
    }

    public function getChordChannel($tonality){
        $midi_channel_arr = [
            'D' => 4,
            'Ab' => 3,
            'C' => 2
        ];
        return $midi_channel_arr[$tonality];
    }

    public function getSinging($song_title_id){
        $sql = "SELECT * FROM song_titles WHERE id=$song_title_id";
        return $this->queryAssocArray($sql);
    }

    public function getChords($tonality){
        $sql = "SELECT chord FROM midi_avail_chords_per_tonality WHERE tonality='$tonality'";
        $chords = $this->query($sql);
        shuffle($chords);
        return $chords;
    }

    public function getChordPitch($step, $do_alter, $octave){
        $note = $step;

        if($do_alter == 1){
            if($note == "B") $note .= "b";
            else $note .= "#";
        }

        $note .= $octave;
        if(array_key_exists($note, MIDIEQUIV)){
            return MIDIEQUIV[$note];
        }else{
            throw new \Exception('Cannot find midi equiv for ' . $note);
        }
    }

    public function getChordProgression($chords){
        $m1 = [
            [$chords[0]['chord'],$chords[1]['chord'],$chords[2]['chord'],$chords[0]['chord'],$chords[0]['chord'],$chords[1]['chord'],$chords[2]['chord'],$chords[0]['chord']],
            [$chords[0]['chord'],$chords[1]['chord'],$chords[2]['chord'],$chords[3]['chord'],$chords[0]['chord'],$chords[1]['chord'],$chords[2]['chord'],$chords[3]['chord']],
            [$chords[2]['chord'],$chords[1]['chord'],$chords[0]['chord'],$chords[0]['chord'],$chords[2]['chord'],$chords[1]['chord'],$chords[0]['chord'],$chords[0]['chord']],
            [$chords[0]['chord'],$chords[0]['chord'],$chords[1]['chord'],$chords[1]['chord'],$chords[0]['chord'],$chords[0]['chord'],$chords[1]['chord'],$chords[1]['chord']]
        ];
        $m2 = [
            [$chords[3]['chord'],$chords[4]['chord'],$chords[5]['chord'],$chords[0]['chord'],$chords[3]['chord'],$chords[4]['chord'],$chords[5]['chord'],$chords[0]['chord']],
            [$chords[2]['chord'],$chords[3]['chord'],$chords[5]['chord'],$chords[2]['chord'],$chords[2]['chord'],$chords[3]['chord'],$chords[5]['chord'],$chords[2]['chord']],
            [$chords[1]['chord'],$chords[2]['chord'],$chords[3]['chord'],$chords[4]['chord'],$chords[1]['chord'],$chords[2]['chord'],$chords[3]['chord'],$chords[4]['chord']]
        ];
        $m = [
            'm1' => $m1[array_rand($m1,1)],
            'm2' => $m2[array_rand($m2, 1)]
            ];
        return $m;
    }

    public function getCustomChordProgression($chords, $chp_format){
        foreach($chp_format as $chord_key){
            $custom[] = $chords[$chord_key]['chord'];
        }
        $cchp = ['custom' => $custom];
        return $cchp;
    }

    public function getChordEquiv($tonality, $style, $chord){
        $sql = "SELECT step, do_alter, octave FROM midi_chords WHERE tonality='$tonality' AND style='$style' AND name='$chord'";
        return $this->queryAssocArray($sql);
    }

    public function getAutotune($tonality, $chord){
        $sql = "SELECT * FROM midi_chords WHERE function='autotune' AND tonality='$tonality' AND name='$chord'";
        $results = $this->query($sql);
        return $results[0];
    }

    public function getGoDrums($style){
        $drums_name = 'SAMPLE_DRUMS_'.strtoupper($style);
        $sql = "SELECT * FROM midi_percussions WHERE name = '$drums_name'";
        $results = $this->query($sql);
        return $results[0];
    }

    public function getStopDrums(){
        $sql = "SELECT * FROM midi_actions WHERE name = 'STOP_DRUMS'";
        $results = $this->query($sql);
        return $results[0];
    }

    public function getArpeggiato($tonality, $chord){
        $sql = "SELECT * FROM midi_chords WHERE function='arpeggiato' AND tonality='$tonality' AND name='$chord'";
        $results = $this->query($sql);
        return $results[0];
    }

    public function getStopArpeggiato(){
        $sql = "SELECT * FROM midi_actions WHERE name = 'STOP_ARPEGGIATO'";
        $results = $this->query($sql);
        return $results[0];
    }

    public function getAddons($addon){
        $addon_name_substr = 'ADDON_'.strtoupper($addon);
        $sql = "SELECT * FROM midi_percussions WHERE name LIKE '$addon_name_substr%'";
        $res = $this->query($sql);
        return $res[array_rand($res)];
    }

    function getStopAddon($addon){
        $addon_name_substr = 'STOP_ADDON_'.strtoupper($addon);
        $sql = "SELECT * FROM midi_actions WHERE name LIKE '$addon_name_substr%'";
        $res = $this->query($sql);
        return $res[0];
    }

    public function getFormat($lines){
        $text = array();
        $paragraph = 0;
        $length = 0;
        foreach($lines as $line){
            if(strlen($line)>0){
                $length++;
                $text[$paragraph] = $length;
            }else{
                $length = 0;
                $paragraph++;
            }
        }
        return $text;
    }

    public function getMidiAction($action){
        $sql = "SELECT * FROM midi_actions WHERE name='$action'";
        return $this->query($sql);
    }

    public function getLyrics($csvfile){
        $csv_arr = array();
        $lyrics = array();
        $fc = fopen($csvfile, 'r');
        while($data = fgetcsv($fc,null, ';')){
            $csv_arr[]= $data;
        }
        foreach($csv_arr as $inner_arr){
            $lyrics[$inner_arr[0]] = $inner_arr[1];
        }
        return $lyrics;
    }

    
    public function getToplineChannel($tonality){
        $top_channel = [
            'D' => 10,
            'Ab' => 11,
            'C' => 9
        ];
        return $top_channel[$tonality];
    }

    public function getToplinePitch(){
        return rand(1,108);
    }

    public function getStopTopline(){
        $sql = "SELECT * FROM midi_actions WHERE name = 'STOP_TOPLINE'";
        $results = $this->query($sql);
        return $results[0];
    }

    public function getVoiceHarmony(){
        $sql = "SELECT * FROM midi_actions WHERE name = 'VOICE_HARMONY'";
        $results = $this->query($sql);
        return $results[0];
    }

    function getOldTitles(){
        $sql = "SELECT title FROM song_titles";
        return $this->querySimpleArray($sql, 'title');
    }

    function getOldInspo(){
        $sql = "SELECT text FROM song_inspo";
        return $this->querySimpleArray($sql, 'text');
    }

}
