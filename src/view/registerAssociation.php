<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>

<h2 class="offset-2">Inscription Association</h2>
<main>
    <form class="row" action="../../index.php?route=registerAssociation" method="post" enctype="multipart/form-data">
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="nomAssociation">Nom association</label>
            <input type="text" class="form-control mb-3" id="nomAssociation" name="nomAssociation" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="nomPresident">Nom Président</label>
            <input type="text" class="form-control mb-3" id="nomPresident" name="nomPresident" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="adresseEmail">Adresse mail</label>
            <input type="email" class="form-control mb-3" id="adresseEmail" name="adresseEmail" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="villeFrance">Ville en France</label>
            <input type="text" class="form-control mb-3" id="villeFrance" name="villeFrance" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="numeroSiret">Numéro siret</label>
            <input type="number" class="form-control mb-3" id="numeroSiret" name="numeroSiret" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="telephone">Téléphone</label>
            <input type="tel" class="form-control mb-3" id="telephone" name="telephone" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="instagram">Saisir lien Instagram</label>
            <input type="url" class="form-control mb-3" id="instagram" name="instagram" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="facebook">Saisir lien Facebook</label>
            <input type="url" class="form-control mb-3" id="facebook" name="facebook" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="telegram">Saisir lien Telegram</label>
            <input type="url" class="form-control mb-3" id="telegram" name="telegram" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="siteWeb">Saisir vôtre site internet</label>
            <input type="url" class="form-control mb-3" id="siteWeb" name="siteWeb" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="associationLogo">Télécharger le logo de l'association</label>
            <input type="file" class="form-control mb-3" id="associationLogo" name="associationLogo" accept="image/*" required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="associationPhoto">Télécharger jusqu'à 3 photos de l'association</label>
            <input type="file" class="form-control mb-3" id="associationPhoto" name="associationPhoto[]" accept="image/*" multiple required>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
            <label for="description">Description association</label>
            <textarea class="form-control mb-3" id="description" name="description" rows="10" required></textarea>
        </div>
        <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1 offset-xxl-2">
            <label for="association_mp">Mot de passe association</label>
            <input type="password" class="form-control mb-3" id="association_mp" name="association_mp" required>
        </div>

        <div class="row">
            <div class="form-group col-10 col-lg-5 col-xxl-4 offset-1">
                <a href="/PHP/Stage/src/view/createChoose.php" class="btn btn-danger col-md-5 col-lg-6 offset-md-1 offset-lg-11 mt-3 mb-3 me-3">Retour</a>
            </div>
            <div class="form-group col-10 col-lg-4 col-xxl-1 offset-1">
                <button type="submit" class="btn btn-success mt-3 mb-4 col-sm-4 col-lg-2 offset-sm-8">Valider</button>
            </div>
        </div>
    </form>
</main>

<?php
$content = ob_get_clean();
include("layout.php");
?>