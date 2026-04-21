<?php
    include __DIR__ . "/../src/includes/header.php" ;
    require_once __DIR__ . "/../src/repositories/filmRepository.php" ;
    require_once __DIR__ . "/../src/lib/functions.php" ;
    require_once __DIR__ . "/../src/database/connection.php" ;
    
    $listeGenres = findAllGenres() ;
    $listePays = findAllPays() ;
    $titreFilm = '';
    $dateSortie = '';
    $duree = '';
    $synopsis = '';
    $urlImgae = '';
    $genre = '';
    $pays = '';
    $erreurs = [];
    $success = false;
    
    // Traiter le formulaire à la soumission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titreFilm = trim($_POST['titreFilm'] ?? '');
        $dateSortie = $_POST['dateSortie'] ?? '';
        $duree = $_POST['duree'] ?? '';
        $synopsis = trim($_POST['synopsis'] ?? '');
        $urlImgae = trim($_POST['urlImgae'] ?? '');
        $genre = $_POST['genre'] ?? '';
        $pays = $_POST['pays'] ?? '';
        
        // Validations
        if (empty($titreFilm)) {
            $erreurs[] = "Le titre du film est obligatoire.";
        } elseif (strlen($titreFilm) < 2) {
            $erreurs[] = "Le titre doit contenir au moins 2 caractères.";
        } elseif (strlen($titreFilm) > 50) {
            $erreurs[] = "Le titre ne doit pas dépasser 50 caractères.";
        }
        
        /*
        if (empty($dateSortie)) {
            $erreurs[] = "La date de sortie est obligatoire.";
        } else {
            $dateObj = DateTime::createFromFormat('Y-m-d', $dateSortie);
            if (!$dateObj || $dateObj->format('Y-m-d') !== $dateSortie) {
                $erreurs[] = "La date de sortie n'est pas valide.";
            } elseif ($dateObj > new DateTime()) {
                $erreurs[] = "La date de sortie ne peut pas être dans le futur.";
            }
        }
        */
        
        if (empty($duree)) {
            $erreurs[] = "La durée est obligatoire.";
        } elseif (!is_numeric($duree) or $duree <= 0) {
            $erreurs[] = "La durée doit être un nombre positif.";
        } elseif ($duree > 300) {
            $erreurs[] = "La durée ne peut pas dépasser 1000 minutes.";
        }
        
        if (empty($synopsis)) {
            $erreurs[] = "Le synopsis est obligatoire.";
        } elseif (strlen($synopsis) < 10) {
            $erreurs[] = "Le synopsis doit contenir au moins 10 caractères.";
        } elseif (strlen($synopsis) > 5000) {
            $erreurs[] = "Le synopsis ne doit pas dépasser 5000 caractères.";
        }
        
        if (empty($urlImgae)) {
            $erreurs[] = "L'URL de l'image est obligatoire.";
        } elseif (filter_var($urlImgae, FILTER_VALIDATE_URL)) {
            $erreurs[] = "L'URL de l'image n'est pas valide.";
        }
        
        if (empty($genre)) {
            $erreurs[] = "Le genre est obligatoire.";
        } else {
            foreach ($listeGenres as $g) {
                if ($g['nom'] == $genre) {
                    $genreValide = true;
                    break;
                }
            }
        }
        if($genreValide === false){
            $erreurs[] = "Le genre selectionné n'est pas dans la liste veuillez en choisir un valide" ;
        }
        
        if (empty($pays)) {
            $erreurs[] = "Le pays est obligatoire.";
        } else {
            $apuysValide = false ;
            foreach ($listePays as $p) {
                if ($p['nom'] == $pays) {
                    $paysValide = true;
                    break;
                }
            }
        }
        if($paysValide === false){
            $erreurs[] = "Le pays selectionné n'est pas dans la liste veuillez en choisir un valide" ;
        }
         
        if (empty($erreurs)) {
            $SQL = "INSERT INTO film (titre, dateSortie, duree, synopsis, image, id_genre, id_pays) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $requete = $connexion->prepare($SQL);
            $requete -> execute([
                $titreFilm,
                $dateSortie,
                (int)$duree,
                $synopsis,
                $urlImgae,
                (int)$genre,
                (int)$pays
            ]);
            
            $success = true;

            $titreFilm = '';
            $dateSortie = '';
            $duree = '';
            $synopsis = '';
            $urlImgae = '';
            $genre = '';
            $pays = '';
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un film</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>


<body>
    
    <div class="container">
        <h1>Ajouter un nouveau film</h1>
        <p>Veuillez renseigner les informations ci-dessous pour ajouter un film au catalogue CinéSIO.</p>
        
        <?php if ($success): ?>
            <div class="message message-success">
                ✓ Le film a été ajouté avec succès au catalogue!
            </div>
        <?php endif; ?>
        
        <!-- Liste des erreurs -->
        <?php if (empty($erreurs) === false): ?>
            <div class="message message-echec">
                <ul>
                    <?php foreach ($erreurs as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form action="" method="post" autocomplete="off" novalidate>
            <div class="form">
                <label for="titreFilm">Titre du film <span class="required">*</span></label>
                <input type="text"
                    id="titreFilm"
                    name="titreFilm"
                    placeholder="Ex: Dune: Deuxième Partie"
                    value="<?= $titreFilm ?>"
                    required>
            </div>
            
            <div class="form-colonne">
                <div class="form">
                    <label for="dateSortie">Date de sortie <span class="required">*</span></label>
                    <input type="date"
                        id="dateSortie"
                        name="dateSortie"
                        value="<?= $dateSortie ?>"
                        required>
                </div>
                
                <div class="form">
                    <label for="duree">Durée (en minutes) <span class="required">*</span></label>
                    <input type="number"
                        id="duree"
                        name="duree"
                        placeholder="Ex: 166"
                        value="<?= $duree ?>"
                        min="1"
                        max="1000"
                        required>
                </div>
            </div>
            
            <div class="form">
                <label for="synopsis">Synopsis <span class="required">*</span></label>
                <textarea id="synopsis"
                    name="synopsis"
                    placeholder="Le héros commence son périple..."
                    rows="6"
                    required><?= $synopsis ?></textarea>
            </div>
            
            <div class="form">
                <label for="urlImgae">Affiche web (URL de l'image) <span class="required">*</span></label>
                <input type="url"
                    id="urlImgae"
                    name="urlImgae"
                    placeholder="https://exemple.com/image.jpg"
                    value="<?= $urlImgae ?>"
                    required>
            </div>
            
            <div class="form-colonne">
                <div class="form">
                    <label for="genre">Genre <span class="required">*</span></label>
                    <select id="genre" name="genre" required>
                        <option value="">Sélectionnez un genre...</option>
                        <?php foreach ($listeGenres as $g): ?>
                            <option value="<?=  ($g['id']) ?>"
                                <?= $g['id'] == $genre ? 'selected' : '' ?>>
                                <?=  $g['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form">
                    <label for="pays">Pays <span class="required">*</span></label>
                    <select id="pays" name="pays" required>
                        <option value="">Sélectionnez un pays...</option>
                        <?php foreach ($paysList as $p): ?>
                            <option value="<?=  ($p['id']) ?>"
                                <?= $p['id'] == $pays ? 'selected' : '' ?>>
                                <?=  $p['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                ⊕ Ajouter ce film au catalogue
            </button>
        </form>
    </div>
</body>
</html>

<?php
    include __DIR__ . "/../src/includes/footer.php" ;
?>