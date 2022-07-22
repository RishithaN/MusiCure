<?php

include 'db.php';

if($_POST){

    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $mob = $_POST['mob'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $langPref = $_POST['langPref'];
    $num = -1;


    $query = "SELECT * FROM users WHERE userEmail = '$email' OR userMobile = '$mob' OR userName = '$uname'";
    $result = pg_exec($db_connection, $query);

    $existingId = 0;
    
    for($row = 0 ; $row < pg_numrows($result) ; $row++){
        $existingId = pg_result($result , $row , 'userId');
    }


    if($existingId == 0){

        $query2 = "SELECT MAX(userId) FROM users";
        $result2 = pg_exec($db_connection , $query2);

        $newId = 0;

        for($row1 = 0 ; $row1 < pg_numrows($result2) ; $row1++){
            $maxId = pg_result($result2 , $row1 , 'max');

            $newId = $maxId + 1;
        }

        if($newId != 0){
            $query1 = "INSERT INTO users (userId , userName , userCountry , userState , userCity , userEmail , userMobile , userPassword , languagePreference) VALUES ('$newId' , '$uname' , '$country' , '$state' , '$city' , '$email' , '$mob' , '$password' , '$langPref')";
            $result1 = pg_exec($db_connection , $query1);
            $num = 1;

        }

    }
    else{
        $num = -1;
    }

    echo $num;

}


?>

