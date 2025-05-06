<?php

namespace App\Controller;

use App\Model\DAO\AssociationDAO;
use App\Model\Entity\AssociationEntity;
use App\Controller\ControllerInterface;

class AssociationController implements ControllerInterface
{
    private AssociationDAO $model;

    public function __construct()
    {
        $this->model = new AssociationDAO();
    }

    public function doGET()
    {
        try {
            $associations = $this->model->readAll();
            header('Content-Type: application/json');
            echo json_encode(['associations' => $associations]);
        } catch (\Exception $e) {
            error_log("Error fetching associations: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
    }


    public function doPOST()
    {
        try {
            // Récupérer les données POST
            $data = json_decode(file_get_contents('php://input'), true);

            // Valider les données
            if (!isset($data['association_nom']) || !isset($data['association_president'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Nom et président de l\'association sont requis']);
                return;
            }

            // Créer une nouvelle entité Association
            $association = new AssociationEntity();
            $association->setAssociationNom($data['association_nom'])
                ->setAssociationPresident($data['association_president'])
                ->setAssociationTelephone($data['association_telephone'] ?? '')
                ->setAssociationEmail($data['association_email'] ?? '')
                ->setAssociationFacebook($data['association_facebook'] ?? '')
                ->setAssociationInstagram($data['association_instagram'] ?? '')
                ->setAssociationTelegram($data['association_telegram'] ?? '')
                ->setAssociationDescriptionFR($data['association_description_FR'] ?? '')
                ->setAssociationSiret($data['association_siret'] ?? '')
                ->setAssociationSiteWeb($data['association_site_web'] ?? '')
                ->setAssociationLogo($data['association_logo'] ?? '')
                ->setAssociationPhoto($data['association_photo'] ?? '')
                ->setAssociationMp($data['association_mp'] ?? '')
                ->setIdVilleFR($this->model->getVilleId($data['ville']));

            // Enregistrer l'association dans la base de données
            $this->model->create($association);

            header('Content-Type: application/json');
            echo json_encode(['message' => 'Association ajoutée avec succès']);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
    }
}
