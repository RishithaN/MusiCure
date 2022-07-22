<?php

include 'db.php';
session_start();

if($_POST){

    $songId = $_POST['songId'];

    $id = $_SESSION['id'];

    $query = "INSERT INTO favorites (userId , songId) VALUES ($id , $songId)";
    $result = pg_exec($db_connection , $query);

    echo $id + $songId;

}

?>

