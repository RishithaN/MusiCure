<?php

include 'db.php';
session_start();

if($_POST){

    $songId = $_POST['songId'];

    $id = $_SESSION['id'];

    $query = "DELETE FROM favorites WHERE userId = '$id' AND songId = '$songId'";
    $result = pg_exec($db_connection , $query);

    echo $id + $songId;

}

?>

