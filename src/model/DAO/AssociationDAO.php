<?php

namespace App\model\DAO;

use App\config\Database;
use App\model\Entity\AbstractEntity;
use App\model\Entity\AssociationEntity;
use App\model\ModelException;

class AssociationDAO implements DAOInterface {

    public function create(AbstractEntity $entity): AbstractEntity {
        /** @var AssociationEntity $association */
        $association = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("INSERT INTO association (
                nom_association,
                nom_president,
                adresse_email,
                numero_siret,
                telephone,
                instagram,
                facebook,
                telegram,
                site_web,
                logo_association,
                photo_association
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute([
                $association->getNomAssociation(),
                $association->getNomPresident(),
                $association->getAdresseEmail(),
                $association->getNumeroSiret(),
                $association->getTelephone(),
                $association->getInstagram(),
                $association->getFacebook(),
                $association->getTelegram(),
                $association->getSiteWeb(),
                $association->getLogoAssociation(),
                $association->getPhotoAssociation()
            ]);
            $association->setId($db->lastInsertId());
            return $association;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de l'enregistrement de l'association: " . $e->getMessage());
        }
    }

    public function readOne(int $id): AbstractEntity {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM association WHERE id = ?");
            $query->execute([$id]);
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            $association = new AssociationEntity();
            $association
                ->setId($data['id'])
                ->setNomAssociation($data['nom_association'])
                ->setNomPresident($data['nom_president'])
                ->setAdresseEmail($data['adresse_email'])
                ->setNumeroSiret($data['numero_siret'])
                ->setTelephone($data['telephone'])
                ->setInstagram($data['instagram'])
                ->setFacebook($data['facebook'])
                ->setTelegram($data['telegram'])
                ->setSiteWeb($data['site_web'])
                ->setLogoAssociation($data['logo_association'])
                ->setPhotoAssociation($data['photo_association']);
            return $association;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture de l'association: " . $e->getMessage());
        }
    }

    public function readAll(): array {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM association");
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_CLASS, AssociationEntity::class);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture des associations: " . $e->getMessage());
        }
    }

    public function update(AbstractEntity $entity): bool {
        /** @var AssociationEntity $association */
        $association = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("UPDATE association SET 
                nom_association = ?,
                nom_president = ?,
                adresse_email = ?,
                numero_siret = ?,
                telephone = ?,
                instagram = ?,
                facebook = ?,
                telegram = ?,
                site_web = ?,
                logo_association = ?,
                photo_association = ?
                WHERE id = ?");
            return $query->execute([
                $association->getNomAssociation(),
                $association->getNomPresident(),
                $association->getAdresseEmail(),
                $association->getNumeroSiret(),
                $association->getTelephone(),
                $association->getInstagram(),
                $association->getFacebook(),
                $association->getTelegram(),
                $association->getSiteWeb(),
                $association->getLogoAssociation(),
                $association->getPhotoAssociation(),
                $association->getId()
            ]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la mise à jour de l'association: " . $e->getMessage());
        }
    }

    public function delete(AbstractEntity $entity): bool {
        /** @var AssociationEntity $association */
        $association = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("DELETE FROM association WHERE id = ?");
            return $query->execute([$association->getId()]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la suppression de l'association: " . $e->getMessage());
        }
    }

}
