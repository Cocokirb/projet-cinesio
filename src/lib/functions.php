<?php
    require __DIR__ . "/../data/data.php" ;

    function convertirDuree (int $duree) : string {
        $heure = intdiv($duree,60);
        $minute = $duree%60 ;
        return " • $heure h $minute min" ;
    } 

?>