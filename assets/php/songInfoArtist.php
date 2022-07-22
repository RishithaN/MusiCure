<?php

include 'db.php';

if($_POST){

    $songId = $_POST['songId'];

    $query = "SELECT * FROM songArtist WHERE songId = '$songId'";
    $result = pg_exec($db_connection, $query);

    $songInfoArtists = array();

    for ($row = 0; $row < pg_numrows($result); $row++) {

        $songInfoArtistId = pg_result($result , $row , 'artistId');

        $query1 = "SELECT * FROM artists WHERE artistId = '$songInfoArtistId'";
        $result1 = pg_exec($db_connection, $query1);

        for($artistRow = 0; $artistRow < pg_numrows($result1); $artistRow++){

            $songInfoArtist = pg_result($result1 , $artistRow , 'artistName');
            array_push($songInfoArtists , $songInfoArtist);

        }
    }

    echo json_encode($songInfoArtists);
}

?>

