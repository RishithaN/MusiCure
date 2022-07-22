<?php
include 'db.php';
session_start();

    $id = $_SESSION['id'];

    $query = "SELECT * FROM songs WHERE songId IN (SELECT songId FROM favorites WHERE userId = '$id')";
    $result = pg_exec($db_connection , $query);

    $favoriteSongList = array();

    for ($row = 0 ; $row<pg_numrows($result) ; $row++) {

        $favoriteSongListTemp = array();

        $songNameFav = pg_result($result , $row , 'songName');
        $songIdFav = pg_result($result , $row , 'songId');
        $albumIdFav = pg_result($result , $row , 'albumId');
        $songDurationFav = pg_result($result , $row , 'duration');
        $songLocFav = pg_result($result , $row , 'songAudioLoc');
        
        $query1 = "SELECT * FROM album WHERE albumId = '$albumIdFav'";
        $result1 = pg_exec($db_connection , $query1);

        for($row1 = 0 ; $row1 < pg_numrows($result1) ; $row1++){
            $albumNameFav = pg_result($result1 , $row1 , 'albumName');
            $songImgFav = pg_result($result1 , $row1 , 'albumImgLoc');

            array_push($favoriteSongListTemp , $songNameFav);
            array_push($favoriteSongListTemp , $songImgFav);
            array_push($favoriteSongListTemp , $albumNameFav);
            array_push($favoriteSongListTemp , $songDurationFav);
            array_push($favoriteSongListTemp , $songLocFav);
            array_push($favoriteSongListTemp , $songIdFav);

        }

        $query2 = "SELECT * FROM artists WHERE artistId IN (SELECT artistId FROM songArtist WHERE songId = '$songIdFav')";
        $result2 = pg_exec($db_connection , $query2);
            
        $artistNameFav = pg_result($result2 , 0 , 'artistName');


        array_push($favoriteSongListTemp , $artistNameFav);

        array_push($favoriteSongList , $favoriteSongListTemp);

        
    }

    echo json_encode($favoriteSongList);


?>


