<?php

namespace App\Controller;

use App\Config\Database;
use App\Model\Entity\EvenementEntity;
use App\Model\Entity\MediaEntity;
use App\Model\DAO\EvenementDAO;
use App\Model\DAO\MediaDAO;
use App\Router;
use PDOException;

class EvenementController implements ControllerInterface
{
    private $evenementDAO;
    private $mediaDAO;

    public function __construct()
    {
        $this->evenementDAO = new EvenementDAO();
        $this->mediaDAO = new MediaDAO();
    }

    /**
     * Gère la méthode GET : affiche le formulaire d'ajout d'événement
     */
    public function doGET(): void
    {
        include 'App/View/evenement.php';
    }

    /**
     * Gère la méthode POST : enregistre l'événement et les médias
     */
    public function doPOST(): void
    {
        try {
            $this->validerEntree();

            $evenement = $this->creerEvenementDepuisPost();
            $createdEvenement = $this->evenementDAO->create($evenement);
            $this->enregistrerMedias($createdEvenement);

            Router::redirect("POST", "home");
        } catch (\Exception $e) {
            http_response_code(400);
            die("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }

    /**
     * Crée une instance EvenementEntity depuis $_POST
     */
    private function creerEvenementDepuisPost(): EvenementEntity
    {
        $evenement = new EvenementEntity();
        $evenement->setEvenementTitre($_POST["evenement_titre"]);
        $evenement->setEvenementDescription($_POST["evenement_description"]);
        $evenement->setEvenementDate($_POST["evenement_date"]);

        $villeName = $_POST["Id_villeFR"];
        $villeId = $this->evenementDAO->getVilleId($villeName);

        if ($villeId === null) {
            throw new \Exception("La ville spécifiée n'existe pas.");
        }

        $evenement->setIdVilleFR($villeId);
        return $evenement;
    }

    /**
     * Valide les données envoyées via le formulaire
     */
    private function validerEntree(): void
    {
        if (empty($_POST['evenement_titre']) || empty($_POST['evenement_description']) || empty($_POST['evenement_date']) || empty($_POST['Id_villeFR'])) {
            throw new \Exception("Tous les champs sont obligatoires.");
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['evenement_date'])) {
            throw new \Exception("Format de date invalide. Utilisez YYYY-MM-DD.");
        }
    }

    /**
     * Enregistre les fichiers photo et vidéo liés à un événement
     */
    private function enregistrerMedias(EvenementEntity $evenement): void
    {
        $photoPath = $this->gererUpload('evenement_photo', 'uploads/photos/');
        $videoPath = $this->gererUpload('evenement_video', 'uploads/videos/');

        if ($photoPath) {
            $mediaPhoto = new MediaEntity();
            $mediaPhoto->setMediaChemin($photoPath);
            $mediaPhoto->setIdTypeMedia($this->getTypeMediaId('photo'));
            $mediaPhoto->setIdEvenement($evenement->getIdEvenement());
            $this->mediaDAO->create($mediaPhoto);
        }

        if ($videoPath) {
            $mediaVideo = new MediaEntity();
            $mediaVideo->setMediaChemin($videoPath);
            $mediaVideo->setIdTypeMedia($this->getTypeMediaId('video'));
            $mediaVideo->setIdEvenement($evenement->getIdEvenement());
            $this->mediaDAO->create($mediaVideo);
        }
    }

    /**
     * Retourne l'ID du type de média (photo ou vidéo)
     */
    private function getTypeMediaId(string $typeName): int
    {
        $typeMediaIds = [
            'photo' => 1,
            'video' => 2
        ];

        if (array_key_exists($typeName, $typeMediaIds)) {
            return $typeMediaIds[$typeName];
        }

        throw new \Exception("Type de média inconnu : $typeName");
    }

    /**
     * Gère l'upload d'un fichier et retourne son chemin ou null
     */
    private function gererUpload(string $inputName, string $uploadDir): ?string
    {
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $_FILES[$inputName]['tmp_name'];
            $fileName = basename($_FILES[$inputName]['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            $allowedExtensions = [
                'photo' => ['jpg', 'jpeg', 'png', 'gif'],
                'video' => ['mp4', 'mov', 'avi']
            ];

            $type = str_contains($inputName, 'photo') ? 'photo' : 'video';

            if (!in_array($fileExtension, $allowedExtensions[$type])) {
                throw new \Exception("Fichier $fileName : extension non autorisée.");
            }

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $finalPath = $uploadDir . uniqid() . '.' . $fileExtension;
            move_uploaded_file($tmpPath, $finalPath);
            return $finalPath;
        }
        return null;
    }

    /**
     * Fournit tous les événements + médias au format JSON pour appel AJAX
     */
    public function getAllEventsJSON(): void
    {
        header('Content-Type: application/json');

        try {
            $events = $this->evenementDAO->readAll();
            $result = [];

            foreach ($events as $event) {
                if (!$event->getIdEvenement())
                    continue;

                $medias = $this->mediaDAO->findByEvenementId($event->getIdEvenement());

                $result[] = [
                    'id' => $event->getIdEvenement(),
                    'titre' => $event->getEvenementTitre(),
                    'description' => $event->getEvenementDescription(),
                    'date' => $event->getEvenementDate(),
                    'medias' => array_map(function ($media) {
                        return [
                            'id' => $media->getIdMedia(),
                            'chemin' => $media->getMediaChemin(),
                            'type' => $media->getIdTypeMedia()
                        ];
                    }, $medias)
                ];
            }

            echo json_encode($result);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erreur lors de la récupération : ' . $e->getMessage()]);
        }

        exit;
    }
}
