<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
?>

<div class="container row mt-5">
    <h1 class="text-center col-12 col-md-8 mb-4 offset-lg-2">Choisissez le type de compte à créer</h1>
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-3 mb-4 offset-1 offset-lg-0">
            <div class="card" style="min-height: 400px;">
                <div class="card-body">
                    <h3 class="card-title">Créer un compte Association</h3>
                    <p class="card-text">Si vous représentez une association, créez un compte pour accéder à des fonctionnalités spécifiques aux associations.</p>
                </div>
                <div class="card-footer">
                    <a href="/PHP/Stage/src/view/registerAssociation.php" class="btn btn-primary w-100">Créer un compte Association</a>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-3 mb-4 offset-1 offset-lg-0">
            <div class="card" style="min-height: 400px;">
                <div class="card-body">
                    <h3 class="card-title">Créer un compte Utilisateur</h3>
                    <p class="card-text">Si vous êtes un utilisateur individuel, créez un compte pour accéder à toutes les fonctionnalités de notre site.</p>
                </div>
                <div class="card-footer">
                    <a href="/PHP/Stage/src/view/registerUser.php" class="btn btn-primary w-100">Créer un compte Utilisateur</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include("layout.php");
?>