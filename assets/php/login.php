<?php

include 'db.php';
session_start();

if($_POST){

    $email = $_POST['email'];
    $password = $_POST['psw'];
    $num = -1;

    $query = "SELECT userId FROM users WHERE userEmail = '$email' AND userPassword = '$password'";
    $result = pg_exec($db_connection, $query);
    $id = pg_fetch_result($result , 'userId');


    if($id){

        $_SESSION['id'] = $id;
        $num = 1;
    }
    else{
        $num = -1;
    }

    echo $num;

}


?>

