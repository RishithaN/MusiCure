<?php

include 'db.php';

if($_POST){
    $songId = $_POST['songId'];

    $query = "SELECT * FROM songs WHERE songId = '$songId'";
    $result = pg_exec($db_connection, $query);

    for ($row = 0; $row < pg_numrows($result); $row++) {

        $songInfoName = pg_result($result , $row , 'songName');
        $songInfoAlbumId = pg_result($result , $row , 'albumId');
        $songInfoAudio = pg_result($result , $row , 'songAudioLoc');

        $query1 = "SELECT * FROM album WHERE albumId='$songInfoAlbumId'";
        $result1 = pg_exec($db_connection , $query1);

        for($row = 0; $row < pg_numrows($result1);$row++){

            $songInfoAlbum = pg_result($result1 , $row , 'albumName');
            $songInfoImg = pg_result($result1 , $row , 'albumImgLoc');

            echo json_encode(array($songInfoName , $songInfoAlbum , $songInfoImg , $songInfoAudio));

        }
    }
}

?>

