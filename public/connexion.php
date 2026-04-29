<?php
    include __DIR__ . "/../src/includes/header.php" ;
    require_once __DIR__ . "/../src/repositories/utilisateurRepository.php" ;
    $mail  = '';
    $mdp = '';
    $utilisateurData = null ;
    $erreurs = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mail = trim($_POST['email'] ?? '');
        $pseudo = htmlspecialchars(trim($_POST['pseudo'] ?? ''));
        $mdp = trim($_POST['mot_de_passe'] ?? '');

        // Validations
        if (empty($mail)) {
            $erreurs['email'] = "L'adresse email est obligatoire.";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "L'adresse email n'a pas un format valide.";
        } else {
            $utilisateurData = findUtilisateurByEmail($mail);
            if (!$utilisateurData) {
                $erreurs['email'] = "L'adresse mail ou le mot de passe est incorrect.";
            }
        }
        if (empty($mdp)) {
            $erreurs['mdp'] = "Le mot de passe est obligatoire.";
        } elseif ($utilisateurData && password_verify($mdp, $utilisateurData['mot_de_passe']) === false) {
            $erreurs['email'] = "L'adresse mail ou le mot de passe est incorrect.";
            $erreurs['mdp'] = "L'adresse mail ou le mot de passe est incorrect.";
        }
        if (empty($erreurs)) {
            $_SESSION['utilisateur'] = [
            'id' => $utilisateurData['id'],
            'pseudo' => $utilisateurData['pseudo'],
            'email' => $utilisateurData['email'],
            'mot_de_passe' => $utilisateurData['mdp']
        ];
            header('Location: index.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <main class="connexion-main">
        <div class="connexion-container">
            <h1 class="connexion-title">Connexion</h1>
            <p class="connexion-subtitle">Accédez à votre espace membre CinéSIO.</p>
            <form action="" method="post" novalidate class="connexion-form">
                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <input type="email" name="email" id="email" required value="<?php $mail ?? '' ?>" placeholder="votre@email.com">
                    <?php if (isset($erreurs['email'])): ?>
                        <small class="form-error"><?= $erreurs['email'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe" required>
                    <?php if (isset($erreurs['mdp'])): ?>
                        <small class="form-error"><?= $erreurs['mdp'] ?></small>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn-connexion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                    </svg>
                    Se connecter
                </button>
            </form>
            <p class="connexion-signup">Pas encore de compte ? <a href="inscription.php">Créer un compte</a></p>
        </div>
    </main>
</body>

</html>


<?php 
    include __DIR__ . "/../src/includes/footer.php"
?>