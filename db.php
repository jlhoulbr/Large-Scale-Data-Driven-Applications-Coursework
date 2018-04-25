<?php

$values = $_POST['values'];

if($values == 'All'){
    printAll();
} else {
    $title = $values['title'];
    $sort = $values['sort'];
    $limit = $values['limit'];
    $where = $values['where'];
    $name = $values['name'];
    if($sort == 'Ascending'){
        $sort = 1;
    } else {
        $sort = -1;
    }
    printQuery($where,$name,$title,$sort,$limit);
}


function printQuery($where,$name,$title,$sort,$limit){
    if($limit == null){
        $limit = 600;
    }
    $doc= array(
       $title => $sort,
    );
    if ($name == null){
        $doc2 = [];
    } elseif (is_numeric($name)) {
        settype($name,"double");
        $doc2 = array(
            "$where" => array('$eq' => $name)
        );
        echo gettype($name);
        print_r($doc2);
    } else {
        $doc2 = array(
            $where => $name,
        );
    }
    $connection = new MongoClient(); // connect
    $db = $connection->lsdda;
    $collection = $db->coursework;
    $cursor = $collection->find($doc2)->sort($doc)->limit($limit);
    echo '<table class="printQuery"><tr><th class="artist_id">artist_id</th><th class="artist_name">artist_name</th><th class="song_title">song_title</th><th class="id">id</th><th class="key">key</th><th class="energy">energy</th><th class="liveness">liveness</th><th class="tempo">tempo</th><th class="speechiness">speechiness</th><th class="Sound_quailty">Sound_quailty</th><th class="instrumentalness">instrumentalness</th><th class="mode">mode</th><th class="time_signature">time_signature</th><th class="duration">duration</th><th class="loudness">loudness</th><th class="valence">valence</th><th class="danceability">danceability</th><th class="years">years</th></tr>';
    foreach ($cursor as $line) {
        echo '<tr><td class="artist_id">'.$line['artist_id'].'</td><td class="artist_name">'.$line['artist_name'].'</td><td class="song_title">'.$line['song_title'].'</td><td class="id">'.$line['id'].'</td><td class="key">'.$line['key'].'</td><td class="energy">'.$line['energy'].'</td><td class="liveness">'.$line['liveness'].'</td><td class="tempo">'.$line['tempo'].'</td><td class="speechiness">'.$line['speechiness'].'</td><td class="Sound_quailty">'.$line['Sound_quailty'].'</td><td class="instrumentalness">'.$line['instrumentalness'].'</td><td class="mode">'.$line['mode'].'</td><td class="time_signature">'.$line['time_signature'].'</td><td class="duration">'.$line['duration'].'</td><td class="loudness">'.$line['loudness'].'</td><td class="valence">'.$line['valence'].'</td><td class="danceability">'.$line['danceability'].'</td><td class="years">'.$line['years'].'</td></tr>';
    }
    echo '</table>';
}
    function printAll(){
        $connection = new MongoClient(); // connect
        $db = $connection->lsdda;
        $collection = $db->coursework;
        $cursor = $collection->find();
        echo '<table><tr><th>artist_id</th><th>artist_name</th><th>song_title</th><th>id</th><th>key</th><th>energy</th><th>liveness</th><th>tempo</th><th>speechiness</th><th>Sound_quailty</th><th>instrumentalness</th><th>mode</th><th>time_signature</th><th>duration</th><th>loudness</th><th>valence</th><th>danceability</th><th>years</th></tr>';
        foreach ($cursor as $line) {
            echo '<tr><td>'.$line['artist_id'].'</td><td>'.$line['artist_name'].'</td><td>'.$line['song_title'].'</td><td>'.$line['id'].'</td><td>'.$line['key'].'</td><td>'.$line['energy'].'</td><td>'.$line['liveness'].'</td><td>'.$line['tempo'].'</td><td>'.$line['speechiness'].'</td><td>'.$line['Sound_quailty'].'</td><td>'.$line['instrumentalness'].'</td><td>'.$line['mode'].'</td><td>'.$line['time_signature'].'</td><td>'.$line['duration'].'</td><td>'.$line['loudness'].'</td><td>'.$line['valence'].'</td><td>'.$line['danceability'].'</td><td>'.$line['years'].'</td></tr>';
        }
        echo '</table>';
    }

