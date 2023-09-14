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
        $sql = "INSERT INTO songs(user_id, song_title, song_mood, song_tempo, song_style, song_addons) VALUES($user_id,'$title','$mood','$tempo','$style','$addons')";
        return $this->query($sql);
    }

    public function getSongTitles($tonality): array
    {
        $sql = "SELECT * FROM song_titles WHERE mood='$tonality'";
        return $this->query($sql);
    }

    public function getRandomTitles($tonality, $qty): array
    {
        $titles = $this->getSongTitles($tonality);
        $random_keys = array_rand($titles,$qty);
        foreach($random_keys as $key){
            $random[] = $titles[$key]['id'];
        }
        shuffle($random);
        return $random;
    }

    public function getSongInfo($id) : array
    {
        $sql = "SELECT * FROM song_titles WHERE id=$id";
        $song_info = $this->query($sql);
        return $song_info[0];
    }

    public function getAvailAddons(){
        $addons = array('clap','hh','kick');
        return $addons;
    }

}


?>
