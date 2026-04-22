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

function insertFilm($filmAInserer) : bool {

    $connexion = getConnexion() ;

    $requeteSQL = "INSERT INTO film (titre, date_sortie, duree, synopsis, image, id_genre, id_pays) 
    VALUES (:titre, :date_sortie, :duree, :synopsis, :image, :id_genre, :id_pays)" ;
    
    $requete = $connexion -> prepare($requeteSQL) ; 

    $requete ->bindValue(':titre', $filmAInserer['titre']) ;
    $requete ->bindValue(':date_sortie', $filmAInserer['date_sortie']) ;
    $requete ->bindValue(':duree', $filmAInserer['duree']) ;
    $requete ->bindValue(':synopsis', $filmAInserer['synopsis']) ;
    $requete ->bindValue(':image', $filmAInserer['image']) ;
    $requete ->bindValue(':id_genre', $filmAInserer['genre']) ;
    $requete ->bindValue(':id_pays', $filmAInserer['pays']) ;

    $requete ->execute() ;

    return $requete ;

}

?>