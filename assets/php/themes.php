<?php
include 'db.php';

    if(isset($_SESSION['id'])){
        $userId = $_SESSION['id'];
    }
    else{
        $userId = 0;
    }

    $themeNum = -1;

    $query = "SELECT * FROM users WHERE userId = '$userId'";
    $result = pg_exec($db_connection , $query);

    
    for ($row = 0; $row < pg_numrows($result); $row++) {

        $userLanguage = pg_result($result , $row , 'languagePreference');

        $query1 = "SELECT DISTINCT(themeLanguage) FROM theme";
        $result1 = pg_exec($db_connection , $query1);

        $themeLangs = array();

        for($row1 = 0 ; $row1 < pg_numrows($result1) ; $row1++){
            $themeLang = pg_result($result1 , $row1 , 'themeLanguage');

            array_push($themeLangs , $themeLang);

        }

        if (in_array($userLanguage , $themeLangs)){

            $themeNum = 1;

            $query2 = "SELECT * FROM theme WHERE themeLanguage = '$userLanguage'";
            $result2 = pg_exec($db_connection , $query2);

            $themeInfo = array();

            for($row2 = 0 ; $row2 < pg_numrows($result2) ; $row2++){

                $themeInfoTemp = array();

                $themeId = pg_result($result2 , $row2 , 'themeId');

                $themeImgLoc = pg_result($result2 , $row2 , 'themeImgLoc');
                
                array_push($themeInfoTemp , $themeId);
                array_push($themeInfoTemp , $themeImgLoc);

                array_push($themeInfo , $themeInfoTemp);
                

            }


        }

        else{
            $themeNum = -1;

        }

            $query3 = "SELECT * FROM theme WHERE themeName LIKE '%Hits' AND themeLanguage != '$userLanguage'";
            $result3 = pg_exec($db_connection , $query3);

            $themeInfoHits = array();

            for($row3 = 0 ; $row3 < pg_numrows($result3) ; $row3++){

                $themeInfoTemp = array();

                $themeId = pg_result($result3 , $row3 , 'themeId');

                $themeImgLoc = pg_result($result3 , $row3 , 'themeImgLoc');
                
                array_push($themeInfoTemp , $themeId);
                array_push($themeInfoTemp , $themeImgLoc);

                array_push($themeInfoHits , $themeInfoTemp);
                

            }

            $query4 = "SELECT * FROM theme WHERE themeName NOT LIKE '%Hits' AND themeLanguage != '$userLanguage'";
            $result4 = pg_exec($db_connection , $query4);

            $themeInfoOthers = array();

            for($row4 = 0 ; $row4 < pg_numrows($result4) ; $row4++){

                $themeInfoTemp = array();

                $themeId = pg_result($result4 , $row4 , 'themeId');

                $themeImgLoc = pg_result($result4 , $row4 , 'themeImgLoc');
                
                array_push($themeInfoTemp , $themeId);
                array_push($themeInfoTemp , $themeImgLoc);

                array_push($themeInfoOthers , $themeInfoTemp);
                

            }


        
    }


?>


