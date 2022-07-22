<?php

    include 'db.php';

    session_start();

    unset($_SESSION["id"]);
    echo "Successfully Logged Out";


?>