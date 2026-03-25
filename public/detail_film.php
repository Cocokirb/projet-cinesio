<?php
    require_once __DIR__ . "/../src/repositories/filmRepository.php" ;
    require_once __DIR__ . "/../src/lib/functions.php" ;
    $tabFilms = findAllFilms() ;
    include __DIR__ . "/../src/includes/header.php" ;

    $messageErreur = "" ;
    $produitRecherche = null ;

    $id = $_GET['id'] ?? '' ;

    // Validation du paramètre
    if ($id === ''){
        $messageErreur = "URL invalide : identifiant de produit manquant" ;
    }elseif(filter_var($id , FILTER_VALIDATE_INT) === false) {
        $messageErreur = "URL invalide : identifiant doit être une valeur numérique" ;
    }elseif((int)$id <= 0) {
        $messageErreur = "URL invalide : identifiant doit être strictement positif" ;
    }else{
        // le paramètre est présent est valide 
        $id = (int)$id ; // Facultatif
        //Recherche du produit
        foreach($tabFilms as $film){
            if($film['id'] === $id){
                $filmRecherche = $film ;
                break ;  
            }
        }
        // Tester si le produit recherché existe
        if($filmRecherche === null){
            $messageErreur = "Le produit recherché n'existe pas dans le catalogue" ;
        }
    }
?>

<main>

    <div ><a href="index.php" class="retourAccueil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
    </svg>Retour à l'accueil</a>
    </div>

    <div class="card-detail">

        
        <img src="<?= $film['image'] ?>" alt="">

        <div class="card-content-details">
             
            <span class="pays-details">

                <?php if($film["id_pays"] === 1) :?>
                    <?= $film["initiale"] ;?>
                <?php elseif($film["id_pays"] === 2) : ?>
                    <?= $film["initiale"]  ;?>
                <?php elseif($film["id_pays"] === 3) : ?>
                    <?= $film["initiale"]  ;?>
                <?php else :?>
                    <?= $film["initiale"]  ;?>
                <?php endif ; ?>

            </span>

            <p class="l1"><?= " ● " . $film['genre'] . " ● " . 2012/*substr($film['date-sortie'], 0 ,3)*/ ?></p> <br> 

            <h1 class="titre"> <?= $film['titre'] ?> </h1>  <br> <br>

            <h2>Synopsis</h2> <br>

            <p> 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                </svg><?=  convertirDuree($film['duree'])?>
            </p>

            <?php if (strlen($film["synopsis"]) >= 60) :?>
                    <?= substr($film["synopsis"] , 0, 60 ) . "..." ?> 
            <?php else : ?>
                <?= $film["synopsis"] ?>
            <?php endif ; ?><br> <br> <br>

            <div>
                <a href="#" class="btn">On verra plus tard ... </a>
            </div>  <br><br>

        </div>
    </div>

</main>


<?php
    include __DIR__ . "/../src/includes/footer.php"
?>
