<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>

<div class="container row mt-5">
    <h1 class="text-center col-12 col-md-8 mb-4">Choisissez le type de compte à créer</h1>
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Créer un compte Association</h3>
                    <p class="card-text">Si vous représentez une association, créez un compte pour accéder à des fonctionnalités spécifiques aux associations.</p>
                </div>
                <div class="card-footer">
                <a href="/PHP/Stage/src/view/registerAssociation.php" class="btn btn-primary w-100">Créer un compte Association</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card">
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