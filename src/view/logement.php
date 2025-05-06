<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
?>

<h2 class="offset-md-2">Logement</h2>

<main class="row">
    <h5 class="col-10 offset-lg-2 offset-xxl-1 mb-3 mt-5"><strong>Les réfugiés Ukrainiens hébergés près de Toul tentent de se projeter</strong></h5>
    <div class= "col-xxl-4">
        <img class="mb-5 col-10 col-md-10 offset-1 offset-md-2 me-xxl-5 mt-3" src="/PHP/Stage/public/image/olana-et-son-mari.jpg" alt="réfugiés Ukrainiens">
    </div>
    <div class="col-xxl-6 me-xxl-5">
        <p class="col-10 offset-1 offset-lg-2 mt-3 mb-5">Une trentaine de réfugiés ukrainiens sont hébergés dans un bâtiment de l’ex-campus de l’ONF à Bois-de-Haye, près de Toul. Un autre centre d’hébergement
            transitoire va ouvrir juste à côté. Accompagnées par Arelia, les familles souhaiteraient un logement personnel et travailler pour se projeter un peu plus.
        </p>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <img class="mt-4 mb-3 col-md-8 col-lg-12 offset-md-2" src="/PHP/Stage/public/image/solo.png" alt="logement">
            <h5 class="offset-md-2">Logement 1 chambre</h5>
            <p class="offset-md-2">Appartement</p>
            <p class="offset-md-2">Capacité d'accueil: 2</p>
        </div>
        <div class="col-lg-4">
            <img class="mt-4 mb-3 col-md-8 col-lg-12 offset-md-2" src="/PHP/Stage/public/image/solo.png" alt="logement">
            <h5 class="offset-md-2">Une chambre dans belle apparte...</h5>
            <p class="offset-md-2">Chambre</p>
            <p class="offset-md-2">Capacité d'accueil: 2</p>
        </div>
        <div class="col-lg-4 mb-5">
            <img class="mt-4 mb-3 col-md-8 col-lg-12 offset-md-2" src="/PHP/Stage/public/image/solo.png" alt="logement">
            <h5 class="offset-md-2">Donne a famille Ukrainien</h5>
            <p class="offset-md-2">Maison</p>
            <p class="offset-md-2">Capacité d'accueil: 5</p>
        </div>
    </div>
</main>
<?php
$content = ob_get_clean();
include("layout.php");
?>