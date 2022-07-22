<?php

include 'db.php';

if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
}
else{
    $id=0;
}

$checkSong = -1;

if($id != 0){
    $query = "SELECT * FROM userSong WHERE userId = '$id'";
    $result = pg_exec($db_connection, $query);
    $songId = pg_fetch_result($result , 'songId');

    if($songId){
        $query1 = "SELECT * FROM songs WHERE songId = '$songId'";
        $result1 = pg_exec($db_connection, $query1);

        $songName = pg_fetch_result($result1 , 'songName');

        $songFavId = $songId;

        $checkSong = 1;

    }
    else{
        $checkSong = -1;
    }

}

?>

