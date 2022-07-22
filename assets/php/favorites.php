<?php
include 'db.php';


    if(isset($_SESSION['id'])){
        $id=$_SESSION['id'];
    }
    else{
        $id = 0;
    }


    $query = "SELECT * FROM songs WHERE songId IN (SELECT songId FROM favorites WHERE userId = '$id')";
    $result = pg_exec($db_connection , $query);

    $favoriteSongIdCheckList = array();

    for ($row = 0 ; $row<pg_numrows($result) ; $row++) {

        $songIdCheckFav = pg_result($result , $row , 'songId');
        array_push($favoriteSongIdCheckList , $songIdCheckFav);

        
    }


?>


