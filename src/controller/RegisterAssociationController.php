<?php

namespace App\controller;

use App\model\DAO\AssociationDAO;
use App\model\Entity\AssociationEntity;
use App\Router;

/**
 *  Contrôlleur responsable de l'inscription d'une nouvelle association
 */
class RegisterAssociationController implements ControllerInterface
{

    /**
     * Instance de la classe AssociationDAO
     * @var AssociationDAO $model
     */
    private AssociationDAO $model;

    /**
     * Construit une nouvelle instance
     */
    public function __construct()
    {
        $this->model = new AssociationDAO();
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode GET
     * @return void
     */
    public function doGET(): void
    {
        // affiche le formulaire d'inscription
        $title = "Inscription";
        include("./src/view/registerAssociation.php");
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void
    {

        $nomAssociation = $_POST['nomAssociation'];
        $nomPresident = $_POST['nomPresident'];
        $adresseEmail = $_POST['adresseEmail'];
        $numeroSiret = $_POST['numeroSiret'];
        $telephone = $_POST['telephone'];
        $instagram = $_POST['instagram'];
        $facebook = $_POST['facebook'];
        $telegram = $_POST['telegram'];
        $siteWeb = $_POST['siteWeb'];
        $associationLogo = $_FILES['associationLogo']['name'] ?? null;

        // Vérification si un fichier a été téléchargé
        if (empty($_FILES['associationLogo']) || $_FILES['associationLogo']['error'] === UPLOAD_ERR_NO_FILE) {
            die("Erreur : Aucun fichier de logo n'a été téléchargé.");
        }

        // Vérification du logo
        if ($_FILES['associationLogo']['error'] !== UPLOAD_ERR_OK) {
            die("Erreur : Le fichier du logo n'a pas été correctement téléchargé.");
        }

        $logoTmpName = $_FILES['associationLogo']['tmp_name'] ?? null;
        if ($logoTmpName === null || !file_exists($logoTmpName)) {
            die("Erreur : Le fichier temporaire du logo est introuvable.");
        }

        // Vérification du type MIME avec une méthode plus fiable
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $logoTmpName);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimeTypes)) {
            die("Erreur : Le fichier du logo doit être une image valide (JPEG, PNG, WEBP).");
        }

        // Gérer le téléchargement des fichiers
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                die("Erreur : Impossible de créer le répertoire de téléchargement.");
            }
        }

        $logoFolder = $uploadDir . basename($associationLogo);
        if (!move_uploaded_file($logoTmpName, $logoFolder)) {
            die("Erreur : Impossible de déplacer le fichier du logo téléchargé.");
        }

        $associationPhoto = $_FILES['associationPhoto']['name'];
        $description = $_POST['description'];
        $associationMp = $_POST['association_mp'];

        // Gérer le téléchargement des fichiers
        $uploadDir = __DIR__ . '/../../uploads/';
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                die("Erreur : Impossible de créer le répertoire de téléchargement.");
            }
        }

        // Téléchargement des photos
        $associationPhotos = [];
        foreach ($_FILES['associationPhoto']['name'] as $key => $photo) {
            if ($_FILES['associationPhoto']['error'][$key] !== UPLOAD_ERR_OK) {
                die("Erreur : Une des photos n'a pas été correctement téléchargée.");
            }

            $photoTmpName = $_FILES['associationPhoto']['tmp_name'][$key];
            if (!file_exists($photoTmpName)) {
                die("Erreur : Le fichier temporaire d'une des photos est introuvable.");
            }

            $photoFolder = $uploadDir . basename($photo);
            if (!move_uploaded_file($photoTmpName, $photoFolder)) {
                die("Erreur : Impossible de déplacer une des photos téléchargées.");
            }
            $associationPhotos[] = $photoFolder;
        }
        $associationPhotosSerialized = serialize($associationPhoto);

        // Création de l'entité Association
        $villeNom = $_POST['villeFrance']; // Nom de la ville envoyé par le formulaire
        $idVilleFR = $this->model->getVilleId($villeNom); // Récupère ou insère l'ID de la ville

        $newAssociation = new AssociationEntity();
        $newAssociation
            ->setAssociationNom($nomAssociation)
            ->setAssociationPresident($nomPresident)
            ->setAssociationTelephone($telephone)
            ->setAssociationEmail($adresseEmail)
            ->setAssociationDate(date("Y-m-d H:i:s"))
            ->setAssociationFacebook($facebook)
            ->setAssociationInstagram($instagram)
            ->setAssociationTelegram($telegram)
            ->setAssociationDescriptionFR("description")
            ->setAssociationSiret($numeroSiret)
            ->setAssociationSiteWeb($siteWeb)
            ->setAssociationLogo($logoFolder)
            ->setAssociationPhoto($associationPhotosSerialized)
            ->setAssociationMp($_POST['association_mp'])
            ->setIdVilleFR($idVilleFR);

        // Enregistrement dans la base de données
        $this->model->create($newAssociation);

        // Redirection après succès
        Router::redirect("POST", "home");
    }
}
