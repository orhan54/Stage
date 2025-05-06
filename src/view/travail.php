<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;

// Démarrer la mise en tampon de sortie
ob_start();
?>

<h2 class="col-lg-6 offset-lg-3 offset-xxl-3">Travail</h2>

<section>
    <p class="col-10 col-lg-8 offset-1 offset-lg-1 mt-5">
        Chers membres de la communauté ukrainienne, nous vous proposons diverses opportunités d'emploi adaptées à vos compétences
        et expériences. Que vous soyez à la recherche d’un poste dans l’artisanat, le commerce, l’industrie ou les services, nous
        mettons à votre disposition une sélection d’offres variées. Vous avez également la possibilité de déposer votre CV en
        mentionnant votre parcours et vos compétences afin d’être mis en relation avec des employeurs potentiels. Notre objectif
        est de vous aider à trouver un emploi qui correspond à votre profil et à faciliter votre intégration professionnelle.
        N’hésitez pas à nous contacter pour plus d’informations ou pour bénéficier d’un accompagnement personnalisé.
    </p>
</section>

<h4 class="col-lg-6 offset-lg-3 offset-xxl-3 mt-5 text-center">Les offres d'emploi</h4>

<section id="travail" class="row mt-5">
    <div class="col-10 offset-1 col-md-4 offset-md-1">
        <a href="#" style="text-decoration: none; color: inherit;">
            <div class="card mt-5">
                <div class="ms-3 mt-3">
                    <h5><strong>Manager relation Client F/H</strong></h5>
                    <p>Auchan Hypermarché SAS <strong>3,6 </strong><i class="bi bi-star-fill"></i></p>
                    <p>54000 Nancy</p>
                    <div class="row">
                        <p id="card-salaire" class="col-5 ms-3"><strong>De 29 000€ à 36 000€ par an</strong></p>
                        <p id="card-contrat" class="col-3 ms-2 text-center"><strong>Temps plein</strong></p>
                    </div>
                    <div class="mb-5">
                        <ul>
                            <li class="col-10">Auchan retail France, une entreprise de distribution de plus de 50 000 collaborateurs au service de millions de clients chaque année.</li>
                        </ul>
                    </div>
                    <p class="text-muted" style="position: absolute; bottom: 0; left: 10;">Annonce</p>
                </div>
            </div>
        </a>

        <a href="#" style="text-decoration: none; color: inherit;">
            <div class="card">
                <div class="ms-3 mt-3">
                    <h5><strong>Technicien courant faible en sécurité incendie H/F</strong></h5>
                    <p>Desautel</p>
                    <p>Nancy(54)</p>
                    <p id="card-reponse" class="col-8"><i class="bi bi-lightning-charge-fill"></i>Réponse généralement dans un délai de 1 jour.</p>
                    <div class="row">
                        <p id="card-salaire" class="col-5 ms-3"><strong>De 25 000€ à 30 000€ par an</strong></p>
                        <p id="card-contrat" class="col-3 ms-2 text-center"><strong>Temps plein</strong></p>
                    </div>
                    <a href="" style="text-decoration: none;">
                        <p><i class="bi bi-send-fill"></i> Candidature simplifiée</p>
                    </a>
                    <div class="mb-5">
                        <ul>
                            <li class="col-10">Entité de rattachement spécialisée dans le domaine de la protection incendie depuis 1932, DESAUTEL est un groupe familial employant plus de 1600 salariés.</li>
                        </ul>
                    </div>
                    <p class="text-muted" style="position: absolute; bottom: 0; left: 10;">Annonce</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-10 offset-1 col-md-5 d-none d-md-block">
        <div class="card mt-5">
            <div class="ms-3 mt-3">
                <h5><strong>Manager relation Client F/H</strong></h5>
                <a href="https://www.auchan.fr/magasins/hypermarche/auchan-hypermarche-laxou/s-119?utm_source=gmb">
                    <p>Auchan Hypermarché SAS <i class="bi bi-box-arrow-up-right"></i></p>
                </a>
                <strong>3,6 </strong><i class="bi bi-star-fill"></i></p>
                <p>54000 Nancy</p>
                <div class="row">
                    <p class="col-5"><strong>De 29 000€ à 36 000€ par an - Temps plein</strong></p>
                    <p>Crée un compte avant de continuer sur le site web de l'entreprise</p>
                    <div class="col-4 ms-3">
                        <a class="btn btn-primary" href="">Continuer pour postuler<i class="bi bi-box-arrow-up-right ms-2"></i></a>
                    </div>
                </div>
                <hr>
                <div id="detail-emploi" class="scroll-container" style="max-height: 420px; overflow-y: auto;">
                    <h5><strong>Détails de l'emploi</strong></h5>
                    <p><i class="bi bi-cash me-4"></i><strong> Salaire</strong></p>
                    <p id="card-salaire" class="col-3 ms-5 text-center"><strong>De 29 000€ à 36 000€ par an</strong></p>
                    <p><i class="bi bi-briefcase-fill me-4"></i> <strong>Type de poste</strong></p>
                    <p id="card-contrat" class="col-2 ms-5 text-center"><strong>Temps plein</strong></p>
                    <hr>
                    <h5><strong>Lieu</strong></h5>
                    <p><i class="bi bi-geo-alt-fill me-4"></i> 54000 Nancy</p>
                    <hr>
                    <h5><strong>Avantages</strong></h5>
                    <p>Extraits de la description complète du poste</p>
                    <ul>
                        <li>Intéressement et participation</li>
                    </ul>
                    <hr>
                    <h5><strong>Description du poste</strong></h5>
                    <p><i style="color: orange;" class="bi bi-stars"></i> Nous sommes...</p>
                    <p><strong>Auchan Retail France, une entreprise de distribution de plus de 50 000 collaborateurs au service de millions de clients chaque année.</strong></p>
                    <p>Ce que nous voulons, c’est aider nos clients à bien manger et vivre mieux, tout en préservant la planète.</p>
                    <p>Que l’on soit en entrepôt, en magasin ou sur des fonctions support, notre point commun à tous, c’est de faire en sorte que nos clients aient plaisir à faire leurs courses chez nous.</p>
                    <p>Parce que nos collaborateurs sont aussi nos premiers clients, nous veillons chaque jour à leur bien-être et leur évolution professionnelle.</p>
                    <p><strong>Ensemble, nous améliorons le quotidien !</strong></p>
                    <p><strong>Vous avez envie de...</strong></p>
                    <ul>
                        <li><strong>Manager une équipe,</strong> les aider à s'épanouir et à développer leurs compétences.</li>
                        <li><strong>Garantir un service client de qualité,</strong> en étant moteur du développement de l'expérience client, et en accompagnant les collaborateurs dans le style relationnel Auchan au travers d'une relation authentique et de proximité.</li>
                        <li><strong>Assurer la fidélisation et le respect des engagements clients,</strong> vous traitez les réclamations et analysez les enquêtes clients dans le but de mettre en place des actions améliorant la satisfaction client.</li>
                        <li><strong>Piloter au quotidien votre ligne de caisses,</strong> en maintenant le matériel en bon état de fonctionnement, en facilitant le passage en caisse, et en veillant à la propreté de la ligne. Vous êtes également garant de la tenue quotidienne du coffre : comptabilité, gestion du fonds de caisse, respect des procédures, etc.</li>
                    </ul>
                    <p><strong>Vous êtes...</strong></p>
                    <p>Diplômé de niveau Bac+3 en lien avec la relation clients et/ou le management ou avez une expérience de 2 ans minimum à un niveau de responsabilité similaire.</p>
                    <p>Le poste de <strong>Manager de la Relation Client F/H</strong> est fait pour vous.</p>
                    <p><strong>Rencontrons-nous</strong></p>
                    <p>Chez Auchan, nous sommes convaincus que la diversité fait la richesse d’une entreprise. Nous étudions à compétences égales chaque candidature et toutes nos offres peuvent faire l’objet d’aménagements spécifiques en cas de handicap - #tous égaux, tous différents !</p>
                    <p><strong>Vous voulez en savoir plus sur nos engagements ?</strong></p>
                    <p>Nous nous mobilisons au quotidien autour de 4 piliers de responsabilité sociétale et environnementale majeurs : Offre responsable, Environnement, Solidarité, Humain.</p>
                    <p>Rendez-vous sur : https://www.auchan-agit.fr.</p>
                    <hr>
                    <a class="btn btn-secondary text-black mb-3" href=""><i class="bi bi-flag-fill me-3" ;"></i><strong>Signaler l'offre</strong></a>
                </div>
            </div>
        </div>
    </div>
</section>



<?php
// Récupérer le contenu et inclure le layout
$content = ob_get_clean();
include("layout.php");
?>