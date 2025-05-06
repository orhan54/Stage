<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;

ob_start();
?>

<h2 class="mb-0 offset-1 text-center mb-4">Création de compte</h2>

<main>
    <form id="userForm" class="row" action="../../index.php?route=registerUser" method="post">
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_nom">Nom</label>
            <input type="text" class="form-control" id="user_nom" name="user_nom" required>
            <small id="nomError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_prenom">Prénom</label>
            <input type="text" class="form-control" id="user_prenom" name="user_prenom" required>
            <small id="prenomError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_email">Adresse mail</label>
            <input type="email" class="form-control" id="user_email" name="user_email" required>
            <small id="emailError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_telephone">Téléphone</label>
            <input type="tel" class="form-control" id="user_telephone" name="user_telephone" required>
            <small id="telephoneError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_naissance">Année de naissance</label>
            <input type="number" class="form-control" id="user_naissance" name="user_naissance" min="1900" max="2099" step="1" required>
            <small id="naissanceError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_arriver_france">Année d'arrivée en France</label>
            <input type="number" class="form-control" id="user_arriver_france" name="user_arriver_france" min="1900" max="2099" step="1" required>
            <small id="anneeFranceError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="villeFrance">Ville en France</label>
            <input type="text" class="form-control" id="villeFrance" name="villeFrance" required>
            <small id="villeFranceError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_ville_ukraine">Ville d'Ukraine</label>
            <input type="text" class="form-control" id="user_ville_ukraine" name="user_ville_ukraine" required>
            <small id="villeUkraineError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_langue_francaise">Niveau de langue Française</label>
            <input type="text" class="form-control" id="user_langue_francaise" name="user_langue_francaise" required>
            <small id="niveauLangueError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_niveau_etude">Niveau d'étude</label>
            <input type="text" class="form-control" id="user_niveau_etude" name="user_niveau_etude" required>
            <small id="niveauEtudeError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_dernier_poste_ukraine">Dernier poste occupé en Ukraine</label>
            <input type="text" class="form-control" id="user_dernier_poste_ukraine" name="user_dernier_poste_ukraine" required>
            <small id="dernierPosteUkraineError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_dernier_poste_france">Dernier poste occupé en France</label>
            <input type="text" class="form-control" id="user_dernier_poste_france" name="user_dernier_poste_france" required>
            <small id="dernierPosteFranceError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_experience">Expérience</label>
            <input type="text" class="form-control" id="user_experience" name="user_experience" required>
            <small id="experienceError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_pseudonyme">Pseudonyme</label>
            <input type="text" class="form-control" id="user_pseudonyme" name="user_pseudonyme" required>
            <small id="pseudoError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="user_mp">Mot de passe</label>
            <input type="password" class="form-control" id="user_mp" name="user_mp" required>
            <small id="userMpError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="user_mp_confirm">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="user_mp_confirm" name="user_mp_confirm" required>
            <small id="userMpConfirmError" class="text-danger"></small>
        </div>

        <hr class="mt-5 mb-5">

        <h4 class="form-group col-10 offset-1 col-lg-7 offset-lg-3">Information complémentaire</h4>

        <div class="form-group col-10 offset-1 col-lg-7 offset-lg-3 mb-4">
            <label for="nbAccompagne">Nombre d'accompagnants</label>
            <input type="number" class="form-control" id="nbAccompagne" name="nbAccompagne" min="1" max="20">
            <small id="nbAccompagneError" class="text-danger"></small>
        </div>

        <div class="row" id="accompagnants-container">
            <!-- Champs des personnes qui accompagne -->
        </div>


        <div class="row justify-content-center mb-5 mt-5">
            <div class="col-10 col-md-4 offset-1 d-flex justify-content-center mb-3">
                <a href="/PHP/Stage/src/view/createChoose.php" class="btn btn-danger w-50 me-4">Retour</a>
                <button type="submit" class="btn btn-success w-50">Valider</button>
            </div>
        </div>

    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>