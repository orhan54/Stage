<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
?>

<h2 class="col-lg-6 offset-lg-3 offset-xxl-3">Association</h2>
<section>
    <div>
        <p class="col-10 col-lg-8 offset-1 offset-lg-1">
            Chers membres de la communauté ukrainienne, restez connectés et informés grâce à nos différents réseaux
            sociaux ! 📢✨ Rejoignez-nous sur Telegram
            pour recevoir des mises à jour en temps réel et échanger facilement avec la communauté. Suivez-nous sur
            Facebook
            , où nous partageons des actualités, des événements et des moments forts de notre culture. Et pour découvrir
            du contenu visuel inspirant et rester au cœur de notre dynamique, retrouvez-nous sur Instagram
            ! 📲💙💛 Ensemble, renforçons nos liens et diffusons notre message au-delà des frontières. #Україна
            #CommunautéUkrainienne
        </p>
    </div>

    <h4 class="col-lg-6 offset-lg-3 offset-xxl-3 mt-5 text-center">Voici les différentes associations</h4>

    <div id="associations-container" class="row justify-content-center mx-0">
        <!-- Les cartes seront générées ici -->
    </div>

</section>


<?php
$content = ob_get_clean();
include("layout.php");
?>