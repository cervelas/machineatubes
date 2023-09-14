<?php

//upload audio first
$ch = curl_init();
$headers = [
    'Content-Type: multipart/form-data',
    'Accept: application/json',
    'Authorization: Basic c2FsdXRAbXluYW1laXNmdXp6eS5jaA:N51ON3CPUu3QXeujqjDKr'
];

$file = new CURLFile($cereproc_audio_url, 'audio/mpeg', $_SESSION['song_id'].'.mp3');

curl_setopt($ch, CURLOPT_URL,"https://api.d-id.com/audios");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ['audio'=>$file]);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);
$server_output_arr = json_decode($server_output, true);

curl_close ($ch);

$audio_tmp_link = $server_output_arr['url'];

if($audio_tmp_link!==''){
    $ch = curl_init();
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Basic c2FsdXRAbXluYW1laXNmdXp6eS5jaA:N51ON3CPUu3QXeujqjDKr'
    ];
    $data = '{
  "script": {
    "type": "audio",
    "subtitles": "false",
    "provider": {
      "type": "microsoft",
      "voice_id": "en-US-JennyNeural"
    },
    "ssml": "false",
    "audio_url": "'.$audio_tmp_link.'"
  },
  "config": {
     "logo": {
      "position": [
        0,
        0
      ],
      "url": "https://metastories.io/lamachine/lamachine_logo.png"
    },
    "fluent": "false",
    "pad_audio": "0.0",
    "stitch":"true"
  },
  "source_url": "https://metastories.io/lamachine/bossa_vid.jpg"
}';

    curl_setopt($ch, CURLOPT_URL,"https://api.d-id.com/talks");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    $server_output_arr = json_decode($server_output, true);

    curl_close ($ch);

    echo $server_output;

    $talk_id = $server_output_arr['id'];
    $json .= '"id_video": "'.$talk_id.'"';

}

?>