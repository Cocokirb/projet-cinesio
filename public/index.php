<?php
    include __DIR__ . "/../src/includes/header.php" ;
    require_once __DIR__ . "/../src/repositories/filmRepository.php" ;
    require_once __DIR__ . "/../src/lib/functions.php" ;
    $tabFilms = findAllFilms() ;
    $nombreFilmDisponibles = count($tabFilms) ;
?>

<main>

    <h1>Catalogue des films</h1>
    <p class="text">Il y a actuellement <span class="nbfilm"><?= $nombreFilmDisponibles ?></span> films dans le catalogue</p>

    <div class="main">
    <?php if($nombreFilmDisponibles === 0 ) : ?>
        <p>Aucun film disponible pour le moment</p>
    <?php else : ?>
        <?php foreach($tabFilms as $film) : ?>
            
            <div class="card"> 
                <span class="badge">

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
                <img src="<?= $film['image'] ?>" alt="">
                <div class="card-content">

                    <p class="titre"><?= $film['titre'] ?></p> <br> 

                    <?= $film['genre']  ." " . convertirDuree($film['duree']) ?> <br> <br>
                    <?php if (strlen($film["synopsis"]) >= 60) :?>
                        <?= substr($film["synopsis"] , 0, 60 ) . "..." ?> 
                    <?php else : ?>
                        <?= $film["synopsis"] ?>
                    <?php endif ; ?><br> <br> <br>

                    <div>
                        <a href="detail_film.php?id=<?= $film['id']?>" class="btn">Détails</a>
                    </div>  
                    <br><br>

                </div>
            
            </div>

        <?php endforeach ; ?>    
    <?php endif?>    
    </div>

</main>



<?php
    include __DIR__ . "/../src/includes/footer.php"
?>