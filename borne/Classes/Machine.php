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

    public function insertUsedTitle($title_id){
        $sql = "INSERT INTO songs_titles_used(song_title_id, used) VALUES($title_id, 1)";
        return $this->query($sql);
    }

    public function getSongTitles($tonality): array
    {
        $sql = "SELECT * FROM song_titles WHERE mood='$tonality'";
        return $this->query($sql);
    }

    public function getUsedSongTitles(){
        $sql = "SELECT DISTINCT song_title_id FROM songs_titles_used WHERE used=1";
        return $this->querySimpleArray($sql,'song_title_id');
    }

    public function getUnusedSongTitles($tonality){
        $used_ids = $this->getUsedSongTitles();
        $sql = "SELECT * FROM song_titles WHERE mood='$tonality'";
        if(sizeof($used_ids)>0){
            $used_str = implode(',',$used_ids);
            $sql .= " AND id NOT IN ($used_str)";
        }
        $res = $this->query($sql);
        if(sizeof($res)>4){
            return $res;
        }else{
            if($this->resetUsedSongTitles($tonality)){
                return $this->getSongTitles($tonality);
            }
        }
    }

    public function resetUsedSongTitles($tonality){
        $used_ids = array_column($this->getSongTitles($tonality),'id');
        $used_str = implode(',',$used_ids);
        $sql = "UPDATE songs_titles_used SET used=0 WHERE song_title_id IN ($used_str)";
        return $this->query($sql);
    }

    public function getRandomTitles($tonality, $qty): array
    {
        $titles = $this->getUnusedSongTitles($tonality);
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
