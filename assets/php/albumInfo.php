<?php

include 'db.php';

if($_POST){

    $albumId = $_POST['albumId'];

    // $query = "SELECT * FROM album WHERE albumId = '$albumId'";
    // $result = pg_exec($db_connection, $query);

    $query = "SELECT * FROM album JOIN songs ON album.albumId = songs.albumId WHERE album.albumId ='$albumId'";
    $result = pg_exec($db_connection, $query);

    $albumSongList = array();

    for ($row = 0; $row < pg_numrows($result); $row++) {

        $albumSongListTemp = array();

        $albumInfoName = pg_result($result , $row , 'albumName');
        $albumInfoImg = pg_result($result , $row , 'albumImgLoc');
        $albumSongName = pg_result($result , $row , 'songName');
        $albumSongDuration = pg_result($result , $row , 'duration');
        $albumSongLoc = pg_result($result , $row , 'songAudioLoc');
        $songId = pg_result($result , $row , 'songId');

        $query1 = "SELECT * FROM artists WHERE artistId IN (SELECT artistId FROM songArtist WHERE songId = '$songId')";
        $result1 = pg_exec($db_connection , $query1);

        $albumInfoArtistList = array();

        for($row1 = 0 ; $row1 < pg_numrows($result1) ; $row1++){

            $albumInfoArtist = pg_result($result1 , $row1 , 'artistName');

            array_push($albumInfoArtistList , $albumInfoArtist);
                
        }

            array_push($albumSongListTemp , $albumInfoName);
            array_push($albumSongListTemp , $albumInfoImg);
            array_push($albumSongListTemp , $albumSongName);
            array_push($albumSongListTemp , $albumSongDuration);
            array_push($albumSongListTemp , $albumSongLoc);
            array_push($albumSongListTemp , $songId);
            array_push($albumSongListTemp , $albumInfoArtistList);


            array_push($albumSongList , $albumSongListTemp);

        }

        echo json_encode($albumSongList);


    }

?>

