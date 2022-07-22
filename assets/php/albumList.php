<?php
include 'db.php';
include 'composerList.php';


    $querySearch = "SELECT * FROM album";
    $resultSearch = pg_exec($db_connection , $querySearch);

    
    for ($searchRows = 0; $searchRows < pg_numrows($resultSearch); $searchRows++) {

        $searchRow = pg_result($resultSearch, $searchRows, 1);
        array_push($searchValues , $searchRow);
        $searchRow = pg_result($resultSearch, $searchRows , 0);
        array_push($searchIds , $searchRow);
        array_push($searchOptions,3);

    }


?>


