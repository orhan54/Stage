<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = $_GET['error'] ?? null;
ob_start();
?>

<h2 class="offset-2">Se connecter</h2>

<main>
    <form class="row" action="/PHP/Stage/index.php?route=login" method="post">
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-5">
            <label for="email">Email</label>
            <input type="email" class="form-control mb-3" id="email" name="email" placeholder="Entrez votre email" required>
        </div>
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-5">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Entrez votre mot de passe" required>
        </div>

        <!-- Affiche un message d'erreur si nécessaire -->
        <?php if ($error): ?>
            <div class="alert alert-danger col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-5 d-flex justify-content-between">
            <a href="index.php?route=home" class="btn btn-danger mt-3 mb-3 me-2 w-50">Retour</a>
            <button type="submit" class="btn btn-success mt-3 mb-3 ms-2 w-50">Se connecter</button>
        </div>

    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>