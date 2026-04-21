<?php

require_once __DIR__ . "/../database/connection.php" ;

function findAllFilms() : array {

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

function findAllGenres() : array {

    $connexion = getConnexion() ;

    $requeteSQL = "SELECT id, nom FROM genre " ;
    
    $requete = $connexion -> prepare($requeteSQL) ; 
    $requete ->execute() ;

    $requete ->setFetchMode(PDO::FETCH_ASSOC) ;

    $genres = $requete->fetchAll() ;
    return $genres ;

}

function findAllPays() : array {

    $connexion = getConnexion() ;

    $requeteSQL = "SELECT id, nom FROM pays " ;
    
    $requete = $connexion -> prepare($requeteSQL) ; 
    $requete ->execute() ;

    $requete ->setFetchMode(PDO::FETCH_ASSOC) ;

    $pays = $requete->fetchAll() ;
    return $pays ;

}



?>