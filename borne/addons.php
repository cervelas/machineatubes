<?php

$addons_arr = [
    'clap'=>[
        'a'=>array(
            'go'=>['text1','text3'],
            'stop'=>['text2','text4']
        ),
        'b'=>array(
            'go'=>['intro','text1','text3'],
            'stop'=>['text0','text2']
        ),
        'c'=>array(
            'go'=>['text1','text3'],
            'stop'=>['theme1','solo']
        )
    ],
    'hh'=>[
        'a'=>array(
            'go'=>['intro'],
            'stop'=>['text4']
        ),
        'b'=>array(
            'go'=>['theme1','solo'],
            'stop'=>['text2','outro']
        ),
        'c'=>array(
            'go'=>[],
            'stop'=>[]
        )
    ],
    'kick'=>[
        'a'=>array(
            'go'=>['intro'],
            'stop'=>['outro']
        ),
        'b'=>array(
            'go'=>['text1','text3'],
            'stop'=>['text2','outro']
        ),
        'c'=>array(
            'go'=>[],
            'stop'=>[]
        )
    ]
];


foreach($addons_arr as $type=>$variant){
    $keys = array_keys($variant);
    $random_key = $keys[array_rand($keys)];
    $random_addons[$type] = $variant[$random_key];
}



?>