<?php
// Définir une fonction qui retourne une connexion une connexion avec de serveur de base de données 
require_once __DIR__ . "/../config/database.php" ;
function getConnexion() : PDO {
    try{
        $dsn = "pgsql:host = " . DB_HOST . ";port =" . DB_PORT . ";dbname=" . DB_NAME;
        $connexion = new PDO($dsn,DB_USER,DB_PASSWORD );
        return $connexion ;
    } catch (PDOException $erreur){
        // Afficher le message d'erreur 
        echo "Erreur : " . $erreur -> getMessage() ;
        // Mettre fin au script 
        exit ;
        

    }

}

?>