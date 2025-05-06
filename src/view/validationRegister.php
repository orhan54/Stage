<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
?>

<h2 class="offset-2">Création de compte</h2>

<main>
    <form class="row" action="home.php" method="post">
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-2">
            <label for="pseudo">pseudo</label>
            <input type="text" class="form-control mb-3" id="pseudo" name="pseudo" required>
        </div>
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-2">
            <label for="prenom">Mot de passe</label>
            <input type="passeword" class="form-control mb-3" id="mp" name="mp" required>
        </div>
        <div class="form-group col-10 col-lg-8 col-xxl-8 offset-1 offset-lg-2">
            <label for="prenom">Mot de passe</label>
            <input type="passeword" class="form-control mb-3" id="mp" name="mp" required>
        </div>
        <a href="/PHP/Stage/src/view/registerUser.php" class="btn btn-danger col-md-5 col-lg-3 offset-md-1 offset-lg-3 mt-3 mb-3 me-3">Retour</a>
        <button type="submit" class="btn btn-success col-md-5 col-lg-3 mt-3 mb-3">Terminer</button>
    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>