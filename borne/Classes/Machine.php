<?php
namespace Classes;

require_once 'Database.php';
class Machine extends Database {

    public function insertUser($user_name){
        $user_name = addslashes($user_name);
        $sql = "INSERT INTO users(user_name) VALUES('$user_name')";
        return $this->query($sql);
    }

    public function insertSong($user_id, $title, $mood, $tempo, $style, $addons=''){
        $title = addslashes($title);
        $sql = "INSERT INTO songs(user_id, song_title, song_mood, song_tempo, song_style, song_addons) VALUES($user_id,'$title','$mood','$tempo','$style','$addons')";
        return $this->query($sql);
    }

    public function getSongTitles($tonality, $directory = 'lyrics/'): array
    {
        $files = scandir($directory.$tonality);
        $filenames = array();

        foreach($files as $key => $value){
            if(mb_strlen($value)<3){
                unset($files[$key]);
            }else{
                $filenames []= substr($value,0, -4);
            }
        }

        return $filenames;
    }

    public function getRandomTitles($tonality, $qty, $directory = 'lyrics/'): array
    {
        $titles = $this->getSongTitles($tonality, $directory);
        $random_keys = array_rand($titles,$qty);
        foreach($random_keys as $key){
            $random[] = $titles[$key];
        }
        shuffle($random);
        return $random;
    }

    public function getAvailAddons(){
        $addons = array('clap','hh','kick');
        return $addons;
    }

}


?>
