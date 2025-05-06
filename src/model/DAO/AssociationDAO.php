<?php

namespace App\Model\DAO;

use App\Config\Database;
use App\Model\Entity\AbstractEntity;
use App\Model\Entity\AssociationEntity;
use App\Model\ModelException;


class AssociationDAO implements DAOInterface
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    public function getVilleId(string $ville): int
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT Id_villeFR FROM VilleFR WHERE ville_nom = ?");
            $query->execute([$ville]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                return (int)$result['Id_villeFR'];
            } else {
                // Si la ville n'existe pas, insérez-la dans la base de données
                $insertQuery = $db->prepare("INSERT INTO VilleFR (ville_nom, Id_departement) VALUES (?, ?)");
                $insertQuery->execute([$ville, 1]); // Remplacez `1` par l'ID de département approprié
                return (int)$db->lastInsertId();
            }
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la récupération ou de l'insertion de l'ID de la ville : " . $e->getMessage());
        }
    }

    public function create(AbstractEntity $entity): AbstractEntity
    {
        /** @var AssociationEntity $association */
        $association = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("INSERT INTO Association (
            association_nom,
            association_president,
            association_telephone,
            association_email,
            association_date,
            association_facebook,
            association_instagram,
            association_telegram,
            association_description_FR,
            association_siret,
            association_site_web,
            association_logo,
            association_photo,
            association_mp,
            Id_villeFR
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute([
                $association->getAssociationNom(),
                $association->getAssociationPresident(),
                $association->getAssociationTelephone(),
                $association->getAssociationEmail(),
                date('Y-m-d H:i:s'), // Date actuelle
                $association->getAssociationFacebook(),
                $association->getAssociationInstagram(),
                $association->getAssociationTelegram(),
                $association->getAssociationDescriptionFR(),
                $association->getAssociationSiret(),
                $association->getAssociationSiteWeb(),
                $association->getAssociationLogo(),
                $association->getAssociationPhoto(),
                password_hash($association->getAssociationMp(), PASSWORD_BCRYPT), // Hash du mot de passe
                $association->getIdVilleFR()
            ]);
            $association->setIdAssociation($db->lastInsertId());
            return $association;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de l'enregistrement de l'association: " . $e->getMessage());
        }
    }

    public function readOne(int $id): AbstractEntity
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM Association WHERE id = ?");
            $query->execute([$id]);
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            $idVilleFR = $_POST['Id_villeFR'];
            $association = new AssociationEntity();
            $association
                ->setIdAssociation($data['Id_association'])
                ->setAssociationNom($data['association_nom'])
                ->setAssociationPresident($data['association_president'])
                ->setAssociationTelephone($data['association_telephone'])
                ->setAssociationEmail($data['association_email'])
                ->setAssociationDate($data['association_date'])
                ->setAssociationFacebook($data['association_facebook'])
                ->setAssociationInstagram($data['association_instagram'])
                ->setAssociationTelegram($data['association_telegram'])
                ->setAssociationDescriptionFR($data['association_description_FR'])
                ->setAssociationSiret($data['association_siret'])
                ->setAssociationSiteWeb($data['association_site_web'])
                ->setAssociationLogo($data['association_logo'])
                ->setAssociationPhoto($data['association_photo'])
                ->setAssociationMp($data['association_mp'])
                ->setIdVilleFR($idVilleFR);
            return $association;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture de l'association: " . $e->getMessage());
        }
    }

    public function readAll(): array
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM association");
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_CLASS, AssociationEntity::class);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture des associations: " . $e->getMessage());
        }
    }

    public function update(AbstractEntity $entity): bool
    {
        /** @var AssociationEntity $association */
        $association = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("UPDATE Association SET 
                association_nom = ?,
                association_president = ?,
                association_telephone = ?,
                association_email = ?,
                association_date = ?,
                association_facebook = ?,
                association_instagram = ?,
                association_telegram = ?,
                association_description_FR = ?,
                association_siret = ?,
                association_site_web = ?,
                association_logo = ?,
                association_photo = ?,
                association_mp = ?,
                Id_villeFR = ?
            )
                WHERE id = ?");
            return $query->execute([
                $association->getAssociationNom(),
                $association->getAssociationPresident(),
                $association->getAssociationTelephone(),
                $association->getAssociationEmail(),
                $association->getAssociationDate(),
                $association->getAssociationFacebook(),
                $association->getAssociationInstagram(),
                $association->getAssociationTelegram(),
                $association->getAssociationDescriptionFR(),
                $association->getAssociationSiret(),
                $association->getAssociationSiteWeb(),
                $association->getAssociationLogo(),
                $association->getAssociationPhoto(),
                password_hash($association->getAssociationMp(), PASSWORD_BCRYPT), // Hash du mot de passe
                $association->getIdVilleFR(),
                $association->getIdAssociation()
            ]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la mise à jour de l'association: " . $e->getMessage());
        }
    }

    public function delete(AbstractEntity $entity): bool
    {
        /** @var AssociationEntity $association */
        $association = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("DELETE FROM Association WHERE id = ?");
            return $query->execute([$association->getIdAssociation()]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la suppression de l'association: " . $e->getMessage());
        }
    }

    public function login(string $email, string $password): ?array
    {
        if ($email === "association@example.com" && $password === "password123") {
            return [
                "id" => 1,
                "name" => "Example Association",
                "email" => $email
            ];
        }
        return null;
    }

    public function findByEmail(string $email): ?AssociationEntity
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM Association WHERE association_email = ?");
            $query->execute([$email]);
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            if ($data) {
                return (new AssociationEntity())
                    ->setIdAssociation($data['Id_association'])
                    ->setAssociationNom($data['association_nom'])
                    ->setAssociationEmail($data['association_email'])
                    ->setAssociationMp($data['association_mp']);
            }
            return null;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la recherche par email: " . $e->getMessage());
        }
    }
}
