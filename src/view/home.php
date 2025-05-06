<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
ob_start();
?>

<?php
if (isset($_SESSION['user'])) {
    $message = "Vous êtes connecté en tant que " . htmlspecialchars($_SESSION['user']['prenom']) . " " . htmlspecialchars($_SESSION['user']['nom']) . ".";
} elseif (isset($_SESSION['association'])) {
    $message = "Vous êtes connecté en tant qu'association " . htmlspecialchars($_SESSION['association']['nom']) . ".";
} else {
    $message = "Vous êtes déconnecté.";
}
?>

<div id="message" style="padding:10px; background-color:#f0f0f0; border:1px solid #ccc;">
    <?php echo $message; ?>
</div>

<h2 class="col-10 col-lg-6 offset-1 offset-lg-3 offset-xxl-3">Bienvenue sur mon site</h2>
<main>
    <div class="container-fluid">
        <div class="row">
            <p class="col-10 col-lg-10 col-xxl-10 offset-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Laboriosam,
                accusamus! Debitis architecto accusamus
                delectus esse molestiae mollitia, repellat sit culpa, qui at, dolore harum maxime in quod itaque
                praesentium
                tenetur?
                Commodi corporis impedit repudiandae culpa veritatis! Aspernatur error laudantium perferendis eaque
                ut rem
                magni ullam commodi ipsum vitae mollitia alias, voluptatum molestiae et debitis tenetur ad quos odio
                minima
                corrupti.
                Consequatur maxime nihil exercitationem necessitatibus consequuntur, itaque eaque asperiores
                voluptatum et
                repudiandae dignissimos similique hic at, nobis dolorum iusto natus recusandae animi, ipsam quas.
                Non harum
                debitis consectetur corporis magni.
                Omnis et, eligendi voluptas incidunt velit nobis neque repellendus quia aliquid fugit consequuntur,
                est vel
                pariatur! Tenetur molestiae, atque accusamus est asperiores corrupti mollitia ex nam id magnam
                pariatur.
                Autem!
                Quisquam suscipit qui recusandae explicabo fugit laboriosam quis veritatis aspernatur aliquam odit.
                Excepturi minima rerum esse doloribus, labore necessitatibus harum quo voluptatibus fuga nostrum
                perspiciatis laborum. Perspiciatis laudantium voluptates obcaecati!
            </p>
        </div>
    </div>
</main>

<h2>Evenement</h2>

<section id="evenements-container" class="row">
            <!-- Les événements seront chargés ici dynamiquement -->
</section>

<?php
$content = ob_get_clean();
include("layout.php");
?>