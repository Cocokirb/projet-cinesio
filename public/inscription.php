<?php
    include __DIR__ . "/../src/includes/header.php" ;
    require_once __DIR__ . "/../src/repositories/utilisateurRepository.php" ;
?>

<main>
    <div class="inscription-container">
        <h1>Créer un compte</h1>
        <p class="inscription-subtitle">Rejoignez la communauté CinéSIO pour accéder à toutes les fonctionnalités.</p>

        <div class="form-wrapper">
            <form action="" method="post" autocomplete="off" novalidate>
                <div class="form-group">
                    <label for="email">Adresse Email <span class="required">*</span></label>
                    <input type="email" name="email" id="email" required placeholder="Ex: jean.dupont@email.com">
                </div>

                <div class="form-group">
                    <label for="pseudo">Pseudonyme <span class="required">*</span></label>
                    <input type="text" name="pseudo" id="pseudo" required placeholder="Ex: JeanD88">
                    <small class="form-hint">3 caractères minimum.</small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="mot_de_passe">Mot de passe <span class="required">*</span></label>
                        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
                    </div>

                    <div class="form-group">
                        <label for="confirmation">Confirmation <span class="required">*</span></label>
                        <input type="password" name="confirmation" id="confirmation" required>
                    </div>
                </div>
                <p class="form-hint">8 caractères minimum </p>

                <button type="submit" class="btn-submit"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                    </svg>
                    M'inscrire maintenant
                </button>

                <p class="form-link">Déjà un compte ? <a href="connection.php">Connectez-vous</a></p>
            </form>
        </div>
    </div>
</main>

<?php 
    include __DIR__ . "/../src/includes/footer.php"
?>