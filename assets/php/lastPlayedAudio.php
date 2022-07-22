<?php

include 'db.php';
include 'assets\php\lastPlayed.php'; 

    if($checkSong == 1){
        $query1 = "SELECT * FROM songs WHERE songId = '$songId'";
        $result1 = pg_exec($db_connection, $query1);

        $audioSrc = pg_fetch_result($result1 , 'songAudioLoc');

    }
 

?>