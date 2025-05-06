<?php
session_start();

$user = $_SESSION['user'] ?? null;
$association = $_SESSION['association'] ?? null;
?>

<h2 class="col-lg-6 offset-lg-3 offset-xxl-3">Finances</h2>

<section class="offset-1">
    <div class="row">
        <div>
            <h5><strong>Allocation des demandeurs d'asile</strong></h5>
        </div>
        <div class="col-lg-10 mt-3">
            <p>
                A compter de la mise en place de la réforme de l’asile c'est-à-dire le 1er
                novembre 2015, les demandeurs d’asile perçoivent toujours une allocation
                financière versée durant leur procédure d’asile en France : l’allocation
                pour demandeur d’asile (ADA). Celle-ci remplace et fusionne les deux
                anciens dispositifs d’aide financière :
            </p>
        </div>
        <div class="mb-5 col-lg-10">
            <p>L’allocation temporaire d’attente (ATA) qui était versée par le Pôle Emploi
                aux personnes en demande d’asile non hébergées dans un CADA L’allocation
                mensuelle de subsistance (AMS) qui était versée par les gestionnaires
                de CADA à ceux qu’ils hébergeaient.
            </p>
        </div>

        <div class="offset-lg-1 mb-3">
            <h5><strong>Conditions d’obtention</strong></h5>
        </div>
        <div class="row">
            <div class="col-lg-11 col-xl-6 offset-lg-1">
                <p>L’allocation pour demandeur est conditionnée à l’acceptation par les
                    personnes en demande d’asile d’une offre de prise en charge (OPC) des
                    conditions matérielles d’accueil (CMA) faite par l’OFII en début de
                    procédure d’asile. Cette offre comprend également une proposition
                    d’hébergement en centre d’hébergement dédié (CADA, HUDA et AT-SA).
                    L’allocation est également versée sous conditions d’âge, il faut avoir
                    18 ans révolus (Art. D744-18).
                </p>
                <p>
                    La personne doit justifier de ressources mensuelles inférieurs au montant
                    du revenu de solidarité active (Art. D744-20)
                </p>
                <p>
                    Cette offre de prise en charge des conditions matérielles d’accueil n’est
                    plus seulement subordonnée à l’acceptation d’hébergement mais également
                    à l’acceptation d’une orientation directive vers une autre région déterminée
                    par l’OFII.
                </p>
                <p>
                    L’OPC prend fin au terme du mois au cours duquel le droit du demandeur
                    d’asile de se maintenir sur le territoire.
                </p>
            </div>
            <div class="col-lg-10 col-xl-4 offset-lg-1 mt-3">
                <img class="w-100" id="ada" src="../../public/image/ADA.png" alt="ada">
            </div>
        </div>
    </div>
</section>


<?php
$content = ob_get_clean();
include("layout.php");
?>