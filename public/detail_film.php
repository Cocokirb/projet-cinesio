<?php
    require_once __DIR__ . "/../src/repositories/filmRepository.php" ;
    require_once __DIR__ . "/../src/lib/functions.php" ;
    $tabFilms = findAllFilms() ;
    include __DIR__ . "/../src/includes/header.php" ;

    $messageErreur = "" ;
    $filmRecherche = null ;

    $id = $_GET['id'] ?? '' ;

    // Validation du paramètre
    if ($id === ''){
        $messageErreur = "URL invalide : identifiant de produit manquant" ;
    }elseif(filter_var($id , FILTER_VALIDATE_INT) === false) {
        $messageErreur = "URL invalide : identifiant doit être une valeur numérique" ;
    }elseif((int)$id <= 0) {
        $messageErreur = "URL invalide : identifiant doit être strictement positif" ;
    }else{
        foreach($tabFilms as $film){
            if($film['id'] === (int)$id){
                $filmRecherche = $film ;
                break ;  
            }
        }
        if($filmRecherche === null){
            $messageErreur = "Le film que vous recherchez n'existe pas ou n'est plus disponible dans notre catalogue." ;
        }
    }
?>

<main>

    <div ><a href="index.php" class="retourAccueil"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
    </svg>Retour au catalogue</a>
    </div>

    <?php if($messageErreur !== "") : ?>
        <div class="error-container">
            <h1>Film introuvable</h1>
            <p><?= $messageErreur ?></p>
            <a href="index.php" class="btn">Explorer le catalogue</a>
        </div>
    <?php else : ?>
        <div class="card-detail">
            <img src="<?= $filmRecherche['image'] ?>" alt="<?= $filmRecherche['titre'] ?>">

            <div class="card-content-details">
                <span class="pays-details">
                    <?= $filmRecherche["initiale"] ?>
                </span>

                <p class="l1"><?= $filmRecherche['genre'] . " ● " . substr($filmRecherche['date_sortie'], 0, 4) ?></p>

                <h1><?= $filmRecherche['titre'] ?></h1>

                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
<<<<<<< HEAD
                    </svg>
                    <?= convertirDuree($filmRecherche['duree']) ?>
=======
                    </svg><?= convertirDuree($filmRecherche['duree']) ?>
>>>>>>> 6dab161ec429d581b1ce3eab93e49ac5f9515010
                </p>

                <h2>Synopsis</h2>

                <p class="synopsis-text">
                    <?= $filmRecherche["synopsis"] ?>
                </p>

                <div>
                    <a href="#" class="btn">On verra plus tard ...</a>
                </div>
            </div>
        </div>
    <?php endif ; ?>

</main>


<?php
    include __DIR__ . "/../src/includes/footer.php"
?>
