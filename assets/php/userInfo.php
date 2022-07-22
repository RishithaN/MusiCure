<?php
    include 'db.php';

    if(isset($_SESSION['id'])){
        $userId = $_SESSION['id'];
    }
    else{
        $userId = 0;
    }


    $query = "SELECT * FROM users WHERE userId = '$userId'";
    $result = pg_exec($db_connection, $query);

    for($row = 0 ; $row < pg_numrows($result) ; $row++){
        $userName = pg_result($result , $row , 'userName');
        $userEmail = pg_result($result , $row , 'userEmail');
        $userMobile = pg_result($result , $row , 'userMobile');
        $userCountry = pg_result($result , $row , 'userCountry');
        $userState = pg_result($result , $row , 'userState');
        $userCity = pg_result($result , $row , 'userCity');
        $userLanguage = pg_result($result , $row , 'languagePreference');

    }


?>

