<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>

<h2 class="offset-2">Création de compte</h2>

<main>
    <form class="row" action="../../index.php?route=registerUser" method="post">
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="nom">Nom</label>
            <input type="text" class="form-control mb-3" id="nom" name="nom" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control mb-3" id="prenom" name="prenom" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="email">Adresse mail</label>
            <input type="email" class="form-control mb-3" id="email" name="email" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="telephone">Téléphone</label>
            <input type="telephone" class="form-control mb-3" id="telephone" name="telephone" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="naissance">Année de naissance</label>
            <input type="date" class="form-control mb-3" id="naissance" name="naissance" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="anneeFrance">Date d'arriver en France</label>
            <input type="date" class="form-control mb-3" id="anneeFrance" name="anneeFrance" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="villeFrance">Ville en France</label>
            <input type="text" class="form-control mb-3" id="villeFrance" name="villeFrance" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="villeUkraine">Ville d'Ukraine</label>
            <input type="text" class="form-control mb-3" id="villeUkraine" name="villeUkraine" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="niveauLangue">Niveau de langue Française</label>
            <input type="text" class="form-control mb-3" id="niveauLangue" name="niveauLangue" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="niveauEtude">Niveau d'étude</label>
            <input type="text" class="form-control mb-3" id="niveauEtude" name="niveauEtude" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="dernierPosteUkraine">Dernier poste occupér en Ukraine</label>
            <input type="text" class="form-control mb-3" id="dernierPosteUkraine" name="dernierPosteUkraine" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="dernierPosteFrance">Dernier poste occupér en France</label>
            <input type="text" class="form-control mb-3" id="dernierPosteFrance" name="dernierPosteFrance" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="experience">Expérience</label>
            <input type="text" class="form-control mb-3" id="experience" name="experience" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="pseudo">pseudonyme</label>
            <input type="text" class="form-control mb-3" id="pseudo" name="pseudo" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="prenom">Mot de passe</label>
            <input type="password" class="form-control mb-3" id="mp" name="mp" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="prenom">Mot de passe</label>
            <input type="password" class="form-control mb-3" id="mp" name="mp" required>
        </div>
        <hr class="mt-5 mb-5">
        <h4 class="offset-1 offset-lg-2 offset-xxl-6 mb-5">Information complémentaire</h4>
        <p class="offset-1 offset-lg-2 offset-xxl-3">Combien de personne qui vous accompagne</p>

        <div class="form-group col-10 col-lg-8 col-xxl-7 offset-1 offset-lg-2 offset-xxl-3">
            <label for="nomAccompagne">Nom</label>
            <input type="text" class="form-control mb-3" id="nomAccompagne" name="nomAccompagne">
        </div>
        <div class="form-group col-10 col-lg-8 col-xxl-7 offset-1 offset-lg-2 offset-xxl-3">
            <label for="prenomAccompagne">Prénom</label>
            <input type="text" class="form-control mb-3" id="prenomAccompagne" name="prenomAccompagne">
        </div>
        <div class="form-group col-10 col-lg-8 col-xxl-7 offset-1 offset-lg-2 offset-xxl-3">
            <label for="anneeAccompagne">Année de naissance</label>
            <input type="date" class="form-control mb-3" id="anneeAccompagne" name="anneeAccompagne">
        </div>
        <div class="row">
            <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
                <a href="/PHP/Stage/src/view/createChoose.php" class="btn btn-danger col-md-5 col-lg-6 offset-md-1 offset-lg-11 mt-3 mb-3 me-3">Retour</a>
            </div>
            <div class="form-group col-10 col-lg-4 col-xxl-4 offset-1">
                <button type="submit" class="btn btn-success mt-3 mb-4 col-sm-4 col-lg-6 offset-lg-2">Valider</button>
            </div>
        </div>
    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>