<?php

function findAllFilms() : array {

    require_once __DIR__ . "/../database/connection.php" ;
    $connexion = getConnexion() ;

    $requeteSQL = "SELECT film.id , film.titre , film.date_sortie , film.duree , film.synopsis , film.image , film.id_genre , film.id_pays , genre.nom AS genre, pays.nom AS pays, pays.initiale
    FROM film , pays , genre
    WHERE film.id_pays = pays.id 
    AND film.id_genre = genre.id LIMIT 100" ;
    
    $requete = $connexion -> prepare($requeteSQL) ; 
    $requete ->execute() ;

    $requete ->setFetchMode(PDO::FETCH_ASSOC) ;

    $films = $requete->fetchAll() ;
    return $films ;

}

?>