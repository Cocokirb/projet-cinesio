<?php

function findAllFilms() : array {

    // Connection a la base de données 

    require_once __DIR__ . "/../database/connection.php" ;
    $connexion = getConnexion() ;

    // Execution réelle de la requete 

    $requeteSQL = "SELECT * FROM film , pays , genre WHERE film.id_pays = pays.id AND film.id_genre = genre.id LIMIT 100" ;
    $requete = $connexion -> prepare($requeteSQL) ; // requete est le ticket cf cours 
    $requete ->execute() ;

    // Récupération des enregistrements

    $requete ->setFetchMode(PDO::FETCH_ASSOC) ;
    // Pour récuperer un tableau

    $films = $requete -> fetchAll() ;
    return $films ;
}

?>