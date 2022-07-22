<?php
include 'db.php';
include 'albumList.php';
    


if( (!empty($searchValues)) && (!empty($searchIds)) && (!empty($searchOptions)) ){
    if( (sizeof($searchValues) == sizeof($searchIds)) && (sizeof($searchIds) == sizeof($searchOptions)) ){
        $length = sizeof($searchValues);
        echo $length;
    }

}


?>


