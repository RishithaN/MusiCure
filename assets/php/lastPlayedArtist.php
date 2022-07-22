 <?php

include 'db.php';
include 'assets\php\lastPlayed.php'; 

    if($checkSong == 1){
        $query3 = "SELECT * FROM songArtist WHERE songId = '$songId'";
        $result3 = pg_exec($db_connection, $query3);

        for ($row = 0; $row < pg_numrows($result3); $row++) {

            $artistId = pg_result($result3 , $row, 'artistId');

            $query4 = "SELECT * FROM artists WHERE artistId = '$artistId'";
            $result4 = pg_exec($db_connection, $query4);

            $artists = array();
            $artistsName = pg_fetch_result($result4 , 'artistName');
            array_push($artists , $artistsName);
            
        }
    }
 

?>