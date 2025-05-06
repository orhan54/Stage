<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;

ob_start();
?>
<h2 class="offset-2">Inscription Association</h2>

<main>
    <form class="row" id="associationForm" action="../../index.php?route=registerAssociation" method="post" enctype="multipart/form-data">
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_nom">Nom association</label>
            <input type="text" class="form-control mb-3" id="association_nom" name="association_nom" required>
            <small id="nomAssociationError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="association_president">Nom Président</label>
            <input type="text" class="form-control mb-3" id="association_president" name="association_president" required>
            <small id="nomPresidentError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_email">Adresse mail</label>
            <input type="email" class="form-control mb-3" id="association_email" name="association_email" required>
            <small id="adresseEmailError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="villeFrance">Ville en France</label>
            <input type="text" class="form-control mb-3" id="villeFrance" name="villeFrance" required>
            <small id="villeFranceError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_siret">Numéro siret</label>
            <input type="number" class="form-control mb-3" id="association_siret" name="association_siret" required>
            <small id="numeroSiretError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="association_telephone">Téléphone</label>
            <input type="tel" class="form-control mb-3" id="association_telephone" name="association_telephone" required>
            <small id="telephoneError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_instagram">Saisir lien Instagram</label>
            <input type="url" class="form-control" id="association_instagram" name="association_instagram">
            <small id="instagramError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="association_facebook">Saisir lien Facebook</label>
            <input type="url" class="form-control" id="association_facebook" name="association_facebook">
            <small id="facebookError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_telegram">Saisir lien Telegram</label>
            <input type="url" class="form-control" id="association_telegram" name="association_telegram">
            <small id="telegramError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="association_site_web">Saisir votre site internet</label>
            <input type="url" class="form-control" id="association_site_web" name="association_site_web">
            <small id="siteWebError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_logo">Télécharger le logo de l'association</label>
            <input type="file" class="form-control" id="association_logo" name="association_logo" accept="image/*">
            <small id="associationLogoError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="association_photo">Télécharger jusqu'à 3 photos de l'association</label>
            <input type="file" class="form-control" id="association_photo" name="association_photo[]" accept="image/*" multiple>
            <small id="associationPhotoError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_description">Description association</label>
            <textarea class="form-control" id="association_description" name="association_description" rows="10" required></textarea>
            <small id="descriptionError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="association_mp">Mot de passe association</label>
            <input type="password" class="form-control mb-3" id="association_mp" name="association_mp" required>
            <small id="associationMpError" class="text-danger"></small>
        </div>

        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_mp_confirm">Confirmer le mot de passe</label>
            <input type="password" class="form-control mb-3" id="association_mp_confirm" name="association_mp_confirm" required>
            <small id="associationMpConfirmError" class="text-danger"></small>
        </div>

        <div class="row mb-5 mt-5">
            <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xl-5 d-flex flex-column flex-md-row justify-content-between">
                <a href="/PHP/Stage/src/view/createChoose.php" class="btn btn-danger mt-3 mb-3 w-100 me-md-4">Retour</a>
                <button type="submit" class="btn btn-success mt-3 mb-3 w-100">Valider</button>
            </div>
        </div>
    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>