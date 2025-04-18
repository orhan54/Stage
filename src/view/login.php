<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>

<h2 class="offset-2">Se connecter</h2>

<main>
    <form class="row" action="inscription.php" method="post">
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-4">
            <label for="email">email</label>
            <input type="email" class="form-control mb-3" id="email" name="email" required>
        </div>
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-4">
            <label for="mp">Mot de passe</label>
            <input type="passeword" class="form-control mb-3" id="mp" name="mp" required>
        </div>
        <a href="/PHP/Stage/src/view/home.php" class="btn btn-danger col-md-5 col-lg-3 offset-md-1 offset-lg-5 mt-3 mb-3 me-3">Retour</a>
        <a href="login.php" class="btn btn-success col-md-5 col-lg-3 mt-3 mb-3">Connecter</a>
    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>