<?php

namespace App\controller;

use App\model\DAO\AssociationDAO;
use App\model\Entity\AssociationEntity;
use App\Router;

/**
 *  Contrôlleur responsable de l'inscription d'une nouvelle association
 */
class RegisterAssociationController implements ControllerInterface {

    /**
     * Instance de la classe AssociationDAO
     * @var AssociationDAO $model
     */
    private AssociationDAO $model;

    /**
     * Construit une nouvelle instance
     */
    public function __construct(){
        $this->model = new AssociationDAO();
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode GET
     * @return void
     */
    public function doGET(): void {
        // affiche le formulaire d'inscription
        $title = "Inscription";
        include("./src/view/registerAssociation.php");
    }
    
    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void {

        $nomAssociation = $_POST['nomAssociation'];
        $nomPresident = $_POST['nomPresident'];
        $adresseEmail = $_POST['adresseEmail'];
        $numeroSiret = $_POST['numeroSiret'];
        $telephone = $_POST['telephone'];
        $instagram = $_POST['instagram'];
        $facebook = $_POST['facebook'];
        $telegram = $_POST['telegram'];
        $siteWeb = $_POST['siteWeb'];
        $logoAssociation = $_FILES['logoAssociation']['name'];
        $photoAssociation = $_FILES['photoAssociation']['name'];

        // Gérer le téléchargement des fichiers
        $logoTmpName = $_FILES['logoAssociation']['tmp_name'];
        $logoFolder = "/path/to/upload/directory/" . basename($logoAssociation);
        move_uploaded_file($logoTmpName, $logoFolder);

        $photosAssociation = [];
        foreach ($_FILES['photoAssociation']['name'] as $key => $photo) {
            $photoTmpName = $_FILES['photoAssociation']['tmp_name'][$key];
            $photoFolder = "/path/to/upload/directory/" . basename($photo);
            move_uploaded_file($photoTmpName, $photoFolder);
            $photosAssociation[] = $photoFolder;
        }
        $photosAssociationSerialized = serialize($photosAssociation);

        $newAssociation = new AssociationEntity();
        $newAssociation
            ->setNomAssociation($nomAssociation)
            ->setNomPresident($nomPresident)
            ->setAdresseEmail($adresseEmail)
            ->setNumeroSiret($numeroSiret)
            ->setTelephone($telephone)
            ->setInstagram($instagram)
            ->setFacebook($facebook)
            ->setTelegram($telegram)
            ->setSiteWeb($siteWeb)
            ->setLogoAssociation($logoFolder)
            ->setPhotoAssociation($photosAssociationSerialized);
        $this->model->create($newAssociation);
        Router::redirect("POST", "home");
    }
}