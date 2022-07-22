<?php

include 'db.php';
include 'assets\php\lastPlayed.php'; 

    if($checkSong == 1){
        $query1 = "SELECT * FROM songs WHERE songId = '$songId'";
        $result1 = pg_exec($db_connection, $query1);

        $albumId = pg_fetch_result($result1 , 'albumId');

        if($albumId){
            $query2 = "SELECT * FROM album WHERE albumId = '$albumId'";
            $result2 = pg_exec($db_connection, $query2);

            $songImg = pg_fetch_result($result2 , 'albumImgLoc');
        }
    }
    else{
        $songId = 0;
    }
 

?>