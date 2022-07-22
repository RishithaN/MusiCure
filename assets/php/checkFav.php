<?php

include 'db.php';
session_start();

if($_POST){

    $songId = $_POST['songId'];

    $id = $_SESSION['id'];

    $num = -1;

    $query = "SELECT * FROM favorites WHERE songId = '$songId' AND userId = '$id'";
    $result = pg_exec($db_connection , $query);

    for($row=0;$row<pg_numrows($result);$row++){
        $userId = pg_result($result , $row , 'userId');
        $songIdCheck = pg_result($result , $row , 'songId');

        if($userId && $songIdCheck){
            $num = 1;
        }
        else{
            $num = -1;
        }
    }

    echo $num;


}


?>

