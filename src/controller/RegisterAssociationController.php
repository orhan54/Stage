<?php

namespace App\Controller;

use App\Model\DAO\AssociationDAO;
use App\Model\Entity\AssociationEntity;
use App\Utils\PasswordValidator;
use App\Router;

/**
 * Contrôleur responsable de l'inscription d'une nouvelle association
 */
class RegisterAssociationController implements ControllerInterface
{
    /**
     * Instance de la classe AssociationDAO
     * @var AssociationDAO $model
     */
    private AssociationDAO $model;

    /**
     * Erreurs de validation
     * @var array
     */
    private array $errors = [];

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
        // Affiche le formulaire d'inscription
        $title = "Inscription";
        include("./src/view/registerAssociation.php");
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void
    {
        try {
            $this->validerEntrees();

            if (!empty($this->errors)) {
                // Si des erreurs existent, les afficher à l'utilisateur
                throw new \Exception("Des erreurs de validation sont présentes.");
            }

            $nomAssociation = $_POST['association_nom'];
            $nomPresident = $_POST['association_president'];
            $adresseEmail = $_POST['association_email'];
            $numeroSiret = $_POST['association_siret'];
            $telephone = $_POST['association_telephone'];
            $instagram = $_POST['association_instagram'];
            $facebook = $_POST['association_facebook'];
            $telegram = $_POST['association_telegram'];
            $siteWeb = $_POST['association_site_web'];
            $description = $_POST['association_description'];
            $associationMp = $_POST['association_mp'];
            $villeNom = $_POST['villeFrance'];

            $logoFolder = $this->gererTelechargementFichier('association_logo');
            $associationPhotosSerialized = $this->gererTelechargementsMultiples('association_photo');

            $idVilleFR = $this->model->getVilleId($villeNom);

            $nouvelleAssociation = new AssociationEntity();
            $nouvelleAssociation
                ->setAssociationNom($nomAssociation)
                ->setAssociationPresident($nomPresident)
                ->setAssociationTelephone($telephone)
                ->setAssociationEmail($adresseEmail)
                ->setAssociationDate(date("Y-m-d H:i:s"))
                ->setAssociationFacebook($facebook)
                ->setAssociationInstagram($instagram)
                ->setAssociationTelegram($telegram)
                ->setAssociationDescriptionFR($description)
                ->setAssociationSiret($numeroSiret)
                ->setAssociationSiteWeb($siteWeb)
                ->setAssociationLogo($logoFolder)
                ->setAssociationPhoto($associationPhotosSerialized)
                ->setAssociationMp($associationMp)
                ->setIdVilleFR($idVilleFR);

            $this->model->create($nouvelleAssociation);

            Router::redirect("POST", "home");
        } catch (\Exception $e) {
            // Gérer les exceptions (par exemple, enregistrer l'erreur, afficher un message convivial)
            die("Erreur : " . $e->getMessage());
        }
    }

    /**
     * Valide les données d'entrée
     * @throws \Exception
     */
    private function validerEntrees(): void
    {
        // Vérification que chaque champ obligatoire est rempli
        if (empty($_POST['association_nom'])) {
            $this->errors['nomAssociation'] = "Le nom de l'association est obligatoire.";
        }
        if (empty($_POST['association_president'])) {
            $this->errors['nomPresident'] = "Le nom du président est obligatoire.";
        }
        if (empty($_POST['association_telephone'])) {
            $this->errors['telephone'] = "Le téléphone est obligatoire.";
        }
        if (empty($_POST['association_email']) || !filter_var($_POST['association_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['adresseEmail'] = "L'adresse e-mail est invalide.";
        }
        if (empty($_POST['association_description'])) {
            $this->errors['description'] = "La description est obligatoire.";
        }
        if (empty($_POST['association_mp']) || !PasswordValidator::valider($_POST['association_mp'])) {
            $this->errors['association_mp'] = "Le mot de passe doit contenir au moins 12 caractères, une lettre majuscule et un caractère spécial.";
        }
        if (empty($_POST['association_mp_confirm']) || $_POST['association_mp'] !== $_POST['association_mp_confirm']) {
            $this->errors['association_mp_confirm'] = "Les mots de passe ne correspondent pas.";
        }
        if (empty($_POST['association_siret'])) {
            $this->errors['numeroSiret'] = "Le numéro de SIRET est obligatoire.";
        }
        if (empty($_POST['association_site_web'])) {
            $this->errors['siteWeb'] = "Le site web est obligatoire.";
        }
        if (empty($_POST['association_instagram'])) {
            $this->errors['instagram'] = "Le lien Instagram est obligatoire.";
        }
        if (empty($_POST['association_facebook'])) {
            $this->errors['facebook'] = "Le lien Facebook est obligatoire.";
        }
        if (empty($_POST['association_telegram'])) {
            $this->errors['telegram'] = "Le lien Telegram est obligatoire.";
        }
        if (empty($_POST['villeFrance'])) {
            $this->errors['villeFrance'] = "La ville est obligatoire.";
        }
        if (empty($_FILES['association_logo']['name'])) {
            $this->errors['association_logo'] = "Le logo est obligatoire.";
        }
        if (empty($_FILES['association_photo']['name'][0])) {
            $this->errors['association_photo'] = "Au moins une photo est obligatoire.";
        }

        // Si des erreurs ont été trouvées, on lève une exception
        if (!empty($this->errors)) {
            throw new \Exception("Des erreurs sont présentes dans le formulaire.");
        }
    }

    /**
     * Gère le téléchargement d'un fichier unique
     * @param string $cleFichier La clé dans le tableau $_FILES
     * @return string Le chemin vers le fichier téléchargé
     * @throws \Exception
     */
    private function gererTelechargementFichier(string $cleFichier): string
    {
        if (empty($_FILES[$cleFichier]) || $_FILES[$cleFichier]['error'] === UPLOAD_ERR_NO_FILE) {
            throw new \Exception("Aucun fichier téléchargé pour $cleFichier.");
        }

        if ($_FILES[$cleFichier]['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception("Échec du téléchargement du fichier pour $cleFichier.");
        }

        $nomTemporaire = $_FILES[$cleFichier]['tmp_name'];
        if (!file_exists($nomTemporaire)) {
            throw new \Exception("Fichier temporaire introuvable pour $cleFichier.");
        }

        $typesMimeAutorises = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $typeMime = finfo_file($finfo, $nomTemporaire);
        finfo_close($finfo);

        if (!in_array($typeMime, $typesMimeAutorises)) {
            throw new \Exception("Type de fichier invalide pour $cleFichier.");
        }

        $repertoireTelechargement = $this->creerRepertoireTelechargement();
        $cheminFichier = $repertoireTelechargement . basename($_FILES[$cleFichier]['name']);

        if (!move_uploaded_file($nomTemporaire, $cheminFichier)) {
            throw new \Exception("Échec du déplacement du fichier téléchargé pour $cleFichier.");
        }

        return $cheminFichier;
    }

    /**
     * Gère le téléchargement de plusieurs fichiers
     * @param string $cleFichier La clé dans le tableau $_FILES
     * @return string Le chemin sérialisé vers les fichiers téléchargés
     * @throws \Exception
     */
    private function gererTelechargementsMultiples(string $cleFichier): string
    {
        $repertoireTelechargement = $this->creerRepertoireTelechargement();
        $cheminsFichiers = [];

        foreach ($_FILES[$cleFichier]['name'] as $key => $photo) {
            if ($_FILES[$cleFichier]['error'][$key] !== UPLOAD_ERR_OK) {
                throw new \Exception("Échec du téléchargement de l'une des photos.");
            }

            $nomTemporairePhoto = $_FILES[$cleFichier]['tmp_name'][$key];
            if (!file_exists($nomTemporairePhoto)) {
                throw new \Exception("Fichier temporaire introuvable pour l'une des photos.");
            }

            $dossierPhoto = $repertoireTelechargement . basename($photo);
            if (!move_uploaded_file($nomTemporairePhoto, $dossierPhoto)) {
                throw new \Exception("Échec du déplacement de la photo téléchargée.");
            }
            $cheminsFichiers[] = $dossierPhoto;
        }

        return serialize($cheminsFichiers);
    }

    /**
     * Crée le répertoire de téléchargement s'il n'existe pas
     * @return string Le chemin vers le répertoire de téléchargement
     * @throws \Exception
     */
    private function creerRepertoireTelechargement(): string
    {
        $repertoireTelechargement = __DIR__ . '/../../uploads/';
        if (!is_dir($repertoireTelechargement)) {
            if (!mkdir($repertoireTelechargement, 0777, true) && !is_dir($repertoireTelechargement)) {
                throw new \Exception("Échec de la création du répertoire de téléchargement.");
            }
        }
        return $repertoireTelechargement;
    }
}
