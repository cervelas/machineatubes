<?php
use Classes\Tube;
require_once 'autoloader.php';
$machine = new Tube();
$tonalities = array("C", "D", "Ab");
//$tonalities = array("Ab");
$show_only ["C"]= array_map(function($n) { return sprintf("C".$n, $n); }, range(40, 40) );
$show_only ["D"]= array_map(function($n) { return sprintf("D".$n, $n); }, range(40, 40) );
$show_only ["Ab"]= array_map(function($n) { return sprintf("Ab".$n, $n); }, range(33, 40) );

//print_r($show_only);

foreach($tonalities as $tonality){
    $song_titles[$tonality] = $machine->getSongTitles($tonality);
}

foreach($song_titles as $tonality=>$song_info) {
    foreach($song_info as $song_details){
        if(in_array($song_details['filename'], $show_only[$tonality])){
        $song_filename = $song_details['filename'];
        $csvfile = "lyrics/" . $tonality . "/" . $song_filename . ".csv";
        $lyrics = $machine->getLyrics($csvfile);

        foreach ($lyrics as $tmp_key => $tmp_line) {
            $tmp_line = trim($tmp_line);
            $tmp_line = mb_convert_encoding($tmp_line, 'UTF-8');

            $tmp_line = iconv('UTF-8', 'ASCII//TRANSLIT', $tmp_line);

            if ($tmp_line == '[intro]' || $tmp_line == '[outro]' || $tmp_line == '[ solo ]' || $tmp_line == '[ ... ]' || $tmp_line == '') {
                unset($lyrics[$tmp_key]);
            }
        }

        $lyrics = array_values($lyrics);

        foreach ($lyrics as $key => $line) {
            $directory = $tonality . '/' . $song_details['filename'];
            $line_no = $key;
            include('cereproc.php');
            echo $line . '<br>';
        }

    }

    }

}


?>