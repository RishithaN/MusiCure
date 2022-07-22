<?php

include 'db.php';

if($_POST){

    $composerId = $_POST['composerId'];

    $query = "SELECT * FROM composers WHERE composerId = '$composerId'";
    $result = pg_exec($db_connection, $query);

    for ($row = 0; $row < pg_numrows($result); $row++) {

        $composerInfoName = pg_result($result , $row , 'composerName');
        $composerDesc = pg_result($result , $row , 'composerDescription');
        
        $query1 = "SELECT * FROM songs WHERE songId IN (SELECT songId FROM songComposer WHERE composerId = '$composerId')";
        $result1 = pg_exec($db_connection , $query1);

        $composerSongList = array();

        for($row1 = 0; $row1 < pg_numrows($result1);$row1++){

            $composerSongListTemp = array();

            $composerSongName = pg_result($result1 , $row1 , 'songName');
            $composerSongDuration = pg_result($result1 , $row1 , 'duration');
            $composerSongLoc = pg_result($result1 , $row1 , 'songAudioLoc');
            $songId = pg_result($result1 , $row1 , 'songId');

            $query2 = "SELECT * FROM artists WHERE artistId IN (SELECT artistId FROM songArtist WHERE songId = '$songId')";
            $result2 = pg_exec($db_connection , $query2);

            $composerInfoArtistList = array();

            for($row2 = 0 ; $row2 < pg_numrows($result2) ; $row2++){

                $composerInfoArtist = pg_result($result2 , $row2 , 'artistName');

                array_push($composerInfoArtistList , $composerInfoArtist);
                
            }

            $query3 = "SELECT * FROM album WHERE albumId  = (SELECT albumId FROM songs WHERE songId = '$songId')";
            $result3 = pg_exec($db_connection , $query3);

            for($row3 = 0 ; $row3 < pg_numrows($result3) ; $row3++){

                $composerSongImg = pg_result($result3 , $row3 , 'albumImgLoc');
                $composerAlbumName = pg_result($result3 , $row3 , 'albumName');
                
            }

            array_push($composerSongListTemp , $composerInfoName);
            array_push($composerSongListTemp , $composerSongImg);
            array_push($composerSongListTemp , $composerSongName);
            array_push($composerSongListTemp , $composerAlbumName);
            array_push($composerSongListTemp , $composerSongDuration);
            array_push($composerSongListTemp , $composerSongLoc);
            array_push($composerSongListTemp , $songId);
            array_push($composerSongListTemp , $composerInfoArtistList);
            array_push($composerSongListTemp , $composerDesc);

            array_push($composerSongList , $composerSongListTemp);

        }

        echo json_encode($composerSongList);


    }


}


?>

