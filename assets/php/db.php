<?php

$db_connection = pg_connect("host=localhost dbname=Musicure user=postgres password=NRishi1358");

if(!$db_connection){
    die("connection error" . $con->error);
}

?>

