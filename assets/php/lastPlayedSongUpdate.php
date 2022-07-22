<?php

include 'db.php';
session_start();

if($_POST){

    $songId = $_POST['songId'];
    $userId = $_SESSION['id'];

    $query = "SELECT * FROM userSong WHERE userId = '$userId'";
    $result = pg_exec($db_connection, $query);

    $row = 0;

    for($row = 0 ; $row < pg_numrows($result) ; $row++){
        $query1 = "UPDATE userSong SET songId = '$songId' WHERE userId = '$userId'";
        $result1 = pg_exec($db_connection , $query1);

    }

    if ($row == 0){
        $query2 = "INSERT INTO userSong (userId , songId) VALUES ($userId , $songId);";
        $result2 = pg_exec($db_connection , $query2);
    }

    $query3 = "SELECT * FROM userSong WHERE userId = '$userId'";
    $result3 = pg_exec($db_connection , $query3);

    for($userRow = 0 ; $userRow < pg_numrows($result3) ; $userRow++){
        $num = -1;
        if(pg_result($result3 , $userRow , 'songId') == $songId){
            $num = 1;
        }
        else{
            $num = -1;
        }

        echo $num;
    }
   

}


?>

