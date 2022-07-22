<?php

include 'db.php';

if($_POST){

    $artistId = $_POST['artistId'];

    // $query = "SELECT * FROM artists WHERE artistId = '$artistId'";
    // $result = pg_exec($db_connection, $query);

    $query = "SELECT * FROM songs LEFT JOIN artists RIGHT JOIN songArtist ON artists.artistId = songArtist.artistId ON songs.SongId = songArtist.songId WHERE artists.artistId = '$artistId'";
    $result = pg_exec($db_connection, $query);

    $artistSongList = array();

    for ($row = 0; $row < pg_numrows($result); $row++) {

        $artistSongListTemp = array();

        $artistInfoName = pg_result($result , $row , 'artistName');

        $artistDesc = pg_result($result , $row , 'artistDescription');

        $artistSongName = pg_result($result , $row , 'songName');
        $artistSongDuration = pg_result($result , $row , 'duration');
        $artistSongLoc = pg_result($result , $row , 'songAudioLoc');
        $songId = pg_result($result , $row , 'songId');

        $query2 = "SELECT * FROM album WHERE albumId IN (SELECT albumId FROM songs WHERE songId = '$songId')";
        $result2 = pg_exec($db_connection , $query2);

        for($row2 = 0 ; $row2 < pg_numrows($result2) ; $row2++){
            $artistSongAlbum = pg_result($result2 , $row2 , 'albumName');
            $artistSongImg = pg_result($result2 , $row2 , 'albumImgLoc');
        }

            array_push($artistSongListTemp , $artistInfoName);
            array_push($artistSongListTemp , $artistSongImg);
            array_push($artistSongListTemp , $artistSongName);
            array_push($artistSongListTemp , $artistSongAlbum);
            array_push($artistSongListTemp , $artistSongDuration);
            array_push($artistSongListTemp , $artistSongLoc);
            array_push($artistSongListTemp , $songId);
            array_push($artistSongListTemp , $artistDesc);

            array_push($artistSongList , $artistSongListTemp);

        }

        echo json_encode($artistSongList);


    }



?>

