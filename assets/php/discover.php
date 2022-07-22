<?php

include 'db.php';

if($_POST){

    $themeId = $_POST['themeId'];

    $query = "SELECT * FROM discover";
    $result = pg_exec($db_connection , $query);

    for ($row = 0; $row < pg_numrows($result); $row++) {

        $lastChanged = pg_result($result , $row , 'lastUpdated');

        $query1 = "SELECT discover_weekly('$lastChanged')";
        $result1 = pg_exec($db_connection , $query1);

        for($row1 = 0 ; $row < pg_numrows($result1) ; $row++){
            $timetstamp = pg_result($result1 , $row1 , 'discover_weekly');

        }

        if($timetstamp != $lastChanged){


            $query2 = "DELETE FROM themeSongs WHERE themeId = '$themeId'";
            $result2 = pg_exec($db_connection , $query2);

            $query3 = "SELECT MAX(songId) FROM songs";
            $result3 = pg_exec($db_connection , $query3);

            for($row2 = 0 ; $row2 < pg_numrows($result3) ; $row2++){
                $maxSongId = pg_result($result3 , $row2 , 'max');

                $n = range(1 , (int)$maxSongId);
                shuffle($n);
                for ($x=0; $x< 5; $x++)
                {
                    $newSongId = (string)$n[$x];
                    $query4 = "INSERT INTO themeSongs (themeId , songId) VALUES ($themeId , $newSongId)";
                    $result4 = pg_exec($db_connection , $query4);
                }


            }

            $query5 = "UPDATE discover SET lastUpdated = '$timetstamp'";
            $result5 = pg_exec($db_connection , $query5);


        }
            

            $query = "SELECT * FROM theme WHERE themeId = '$themeId'";
            $result = pg_exec($db_connection, $query);

            for ($row = 0; $row < pg_numrows($result); $row++) {

                $themeName = pg_result($result , $row , 'themeName');
                $themeImg = pg_result($result , $row , 'themeImgLoc');
                
                $query1 = "SELECT * FROM songs WHERE songId IN ( SELECT songId FROM themeSongs WHERE themeId = '$themeId' )";
                $result1 = pg_exec($db_connection , $query1);

                $themeSongList = array();

                for($row1 = 0; $row1 < pg_numrows($result1);$row1++){

                    $themeSongListTemp = array();

                    $themeSongName = pg_result($result1 , $row1 , 'songName');
                    $themeSongDuration = pg_result($result1 , $row1 , 'duration');
                    $themeSongLoc = pg_result($result1 , $row1 , 'songAudioLoc');
                    $songId = pg_result($result1 , $row1 , 'songId');

                    $query2 = "SELECT * FROM album WHERE albumId IN (SELECT albumId FROM songs WHERE songId = '$songId')";
                    $result2 = pg_exec($db_connection , $query2);

                    for($row2 = 0 ; $row2 < pg_numrows($result2) ; $row2++){
                        $themeSongAlbum = pg_result($result2 , $row2 , 'albumName');
                        $themeSongImg = pg_result($result2 , $row2 , 'albumImgLoc');
                    }

                    $query3 = "SELECT * FROM artists WHERE artistId IN (SELECT artistId FROM songArtist WHERE songId = '$songId')";
                    $result3 = pg_exec($db_connection , $query3);

                    $artistNameTheme = pg_result($result3 , 0 , 'artistName');

                    array_push($themeSongListTemp , $themeName);
                    array_push($themeSongListTemp , $themeImg);
                    array_push($themeSongListTemp , $themeSongImg);
                    array_push($themeSongListTemp , $themeSongName);
                    array_push($themeSongListTemp , $themeSongAlbum);
                    array_push($themeSongListTemp , $themeSongDuration);
                    array_push($themeSongListTemp , $themeSongLoc);
                    array_push($themeSongListTemp , $songId);
                        

                    array_push($themeSongListTemp , $artistNameTheme);

                    array_push($themeSongList , $themeSongListTemp);

                }


            }

            echo json_encode($themeSongList);
        


    }


}


?>

