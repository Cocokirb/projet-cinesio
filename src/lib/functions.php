<?php
    require __DIR__ . "/../data/data.php" ;

    function convertirDuree (int $duree) : string {
        $heure = intdiv($duree,60);
        $minute = $duree%60 ;
        if ($heure == 0) {
            return " •$minute min" ;
        }else {
            return " • $heure h $minute min" ;
        }
        
    } 
?>