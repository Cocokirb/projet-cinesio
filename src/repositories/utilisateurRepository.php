<?php

require_once __DIR__ . "/../database/connection.php" ;


function findUtilisateurByEmail(string  $email) {

    $connexion = getConnexion() ;

    $requeteSQL = "SELECT id, pseudo, email, mot_de_passe FROM utilisateur WHERE email = :email" ;
    
    $requete = $connexion -> prepare($requeteSQL) ; 

    $requete ->bindValue(':email', $email ) ;

    $requete ->execute() ;

    $utilisateurByEmail = $requete->fetchAll() ;

    return $utilisateurByEmail;

} ;


function findUtilisateurByPseudo(string  $pseudo) {

    $connexion = getConnexion() ;

    $requeteSQL = "SELECT id, pseudo, email, mot_de_passe FROM utilisateur WHERE pseudo = :pseudo" ;
    
    $requete = $connexion -> prepare($requeteSQL) ; 

    $requete ->bindValue(':pseudo', $pseudo ) ;

    $requete ->execute() ;

    $utilisateurByPseudo = $requete->fetchAll() ;
    
    return $utilisateurByPseudo ;

}


function createUtilisateur(array $data) {

    $connexion = getConnexion() ;

    $requeteSQL = "INSERT INTO utilisateur (pseudo, email, mot_de_passe) VALUES (:pseudo, :email, :mot_de_passe) " ;
    

    $requete = $connexion -> prepare($requeteSQL) ; 
    $requete -> bindValue(':pseudo', $data['pseudo']) ;
    $requete -> bindValue(':email', $data['email']) ;
    $requete -> bindValue(':mot_de_passe', password_hash($data['mot_de_passe'] , PASSWORD_DEFAULT)) ;


    $requete ->execute() ;

    return $requete ;
}


?>