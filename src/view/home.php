<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>

<h2 class="col-lg-6 offset-lg-3 offset-xxl-3">Bienvenue sur mon site</h2>
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

<section class="row offset-xl-1">
    <div class="col-12 col-xl-6 col-xxl-5 mt-5 offset-lg-1 offset-xl-0">
        <div class="row evenement">
            <div class="col-5 col-md-5 col-lg-4 offset-1">
                <p><strong>22 Février 2025</strong></p>
            </div>
            <div class="col-2 col-lg-3 offset-3 offset-lg-0">
                <p class="offset-xl-2"><strong>Nancy</strong></p>
            </div>
            <div class="col-10 col-lg-4 col-xl-6 offset-1"><img class="col-md-12" src="/PHP/Stage/public/image/un-an.webp"
                    alt="place stanislas"></div>
            <p class="col-10 offset-1 offset-lg-0 offset-xxl-0 mt-2 col-lg-4">
                porrexerat dominari valles dominari umentia imagine metusque quarum circumdare rectumque
                montibus meis vix mundum illi traxit distinxit sibi possedit diffundi
            </p>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-xxl-5 mt-5 offset-lg-1 offset-xl-0">
        <div class="row evenement">
            <div class="col-5 col-md-5 col-lg-4 offset-1">
                <p><strong>20 Janvier 2025</strong></p>
            </div>
            <div class="col-2 col-lg-3 offset-3 offset-lg-0">
                <p class="offset-xl-2"><strong>Paris</strong></p>
            </div>
            <div class="col-10 col-lg-4 col-xl-6 offset-1"><img class="col-md-12" src="/PHP/Stage/public/image/Capture d’écran.png"
                    alt="place stanislas"></div>
            <p class="col-10 offset-1 offset-lg-0 offset-xxl-0 mt-2 col-lg-4">
                porrexerat dominari valles dominari umentia imagine metusque quarum circumdare rectumque
                montibus meis vix mundum illi traxit distinxit sibi possedit diffundi
            </p>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-xxl-5 mt-5 offset-lg-1 offset-xl-0">
        <div class="row evenement">
            <div class="col-5 col-md-5 col-lg-4 offset-1">
                <p><strong>18 Octobre 2024</strong></p>
            </div>
            <div class="col-2 col-lg-3 offset-3 offset-lg-0">
                <p class="offset-xl-2"><strong>Nancy</strong></p>
            </div>
            <div class="col-10 col-lg-4 col-xl-6 offset-1"><img class="col-md-12" src="/PHP/Stage/public/image/ukraineStane.jpg"
                    alt="place stanislas"></div>
            <p class="col-10 offset-1 offset-lg-0 offset-xxl-0 mt-2 col-lg-4">
                porrexerat dominari valles dominari umentia imagine metusque quarum circumdare rectumque
                montibus meis vix mundum illi traxit distinxit sibi possedit diffundi
            </p>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-xxl-5 mt-5 offset-lg-1 offset-xl-0">
        <div class="row evenement">
            <div class="col-5 col-md-5 col-lg-4 offset-1">
                <p><strong>25 Février 2025</strong></p>
            </div>
            <div class="col-2 col-lg-3 offset-3 offset-lg-0">
                <p class="offset-xl-2"><strong>Lyon</strong></p>
            </div>
            <div class="col-10 col-lg-4 col-xl-6 offset-1"><img class="col-md-12" src="/PHP/Stage/public/image/Capture d’écran2.png"
                    alt="place stanislas"></div>
            <p class="col-10 offset-1 offset-lg-0 offset-xxl-0 mt-2 col-lg-4">
                porrexerat dominari valles dominari umentia imagine metusque quarum circumdare rectumque
                montibus meis vix mundum illi traxit distinxit sibi possedit diffundi
            </p>
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
include("layout.php");
?>