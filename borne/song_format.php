<?php
use Classes\Tube;

$format = ['intro', 'theme0', 'text0', 'text1', 'theme1', 'text2', 'text3', 'solo', 'text4', 'outro'];
$general_lengths = [
    'intro' => 4,
    'theme0'=>4,
    'theme1' => 4,
    'text0'=>8,
    'text1'=>8,
    'text2'=>8,
    'text3'=>8,
    'text4'=>8,
    'solo' => 8,
    'outro'=>4
];

$go_drums = ['theme0'];
$stop_drums = ['text4'];
$go_arpeggiato = ['text1', 'text3'];
$stop_arpeggiato = ['theme1', 'solo'];
$go_topline = ['theme0','theme1','solo'];
$stop_topline = ['text0', 'text2', 'text4'];
$go_harmony = ['text1','text3'];
$stop_harmony = ['text2','outro'];

$song_formats_tube = new Tube();
$chp = $song_formats_tube->getChordProgression($chords);

include_once 'addons.php';

$avail_addons = $song_formats_tube->getAvailAddons();
foreach($avail_addons as $addon_name){
    $go_addon = 'go_'.$addon_name;
    $stop_addon = 'stop_'.$addon_name;
    $$go_addon = $random_addons[$addon_name]['go'];
    $$stop_addon = $random_addons[$addon_name]['stop'];
}

$chords_per_part = [
    'intro' => $chp['m1'],
    'theme0' => $chp['m1'],
    'theme1' => $chp['m1'],
    'text0' => $chp['m1'],
    'text1' => $chp['m1'],
    'text2' => $chp['m1'],
    'text3' => $chp['m1'],
    'text4' => $chp['m1'],
    'solo' => $chp['m1'],
    'outro' => $chp['m1']
];


?>
