<?php

namespace App\Model\DAO;

use App\Config\Database;
use App\Model\Entity\AbstractEntity;
use App\Model\Entity\EvenementEntity;
use App\Model\ModelException;
use PDO;
use PDOException;

class EvenementDAO implements DAOInterface
{
    public function create(AbstractEntity $entity): AbstractEntity
    {
        if (!$entity instanceof EvenementEntity) {
            throw new ModelException("Invalid entity type. Expected EvenementEntity.");
        }

        $query = "INSERT INTO Evenement (evenement_titre, evenement_description, evenement_date, Id_villeFR)
                    VALUES (:evenement_titre, :evenement_description, :evenement_date, :Id_villeFR)";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':evenement_titre', $entity->getEvenementTitre(), PDO::PARAM_STR);
        $stmt->bindValue(':evenement_description', $entity->getEvenementDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':evenement_date', $entity->getEvenementDate(), PDO::PARAM_STR);
        $stmt->bindValue(':Id_villeFR', $entity->getIdVilleFR(), PDO::PARAM_INT);
        $stmt->execute();

        $entity->setIdEvenement((int) Database::getInstance()->lastInsertId());
        return $entity;
    }

    public function readOne(int $id): AbstractEntity
    {
        $query = "SELECT * FROM Evenement WHERE Id_evenement = :id";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(EvenementEntity::class) ?: null;
    }

    public function readAll(): array
    {
        $query = "SELECT * FROM Evenement";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, EvenementEntity::class);
    }

    public function update(AbstractEntity $entity): bool
    {
        if (!$entity instanceof EvenementEntity) {
            throw new ModelException("Invalid entity type. Expected EvenementEntity.");
        }

        $query = "UPDATE Evenement SET evenement_titre = :evenement_titre, evenement_description = :evenement_description,
                    evenement_date = :evenement_date, Id_villeFR = :Id_villeFR WHERE Id_evenement = :id";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':evenement_titre', $entity->getEvenementTitre(), PDO::PARAM_STR);
        $stmt->bindValue(':evenement_description', $entity->getEvenementDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':evenement_date', $entity->getEvenementDate(), PDO::PARAM_STR);
        $stmt->bindValue(':Id_villeFR', $entity->getIdVilleFR(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $entity->getIdEvenement(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(AbstractEntity $entity): bool
    {
        if (!$entity instanceof EvenementEntity) {
            throw new ModelException("Invalid entity type. Expected EvenementEntity.");
        }

        $query = "DELETE FROM Evenement WHERE Id_evenement = :id";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $entity->getIdEvenement(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Obtient l'ID de la ville à partir de son nom
     * @param string $villeName
     * @return int|null
     */
    public function getVilleId(string $villeName): ?int
    {
        $query = "SELECT Id_villeFR FROM VilleFR WHERE ville_nom = :nom"; // Utilisez le nom correct de la colonne
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':nom', $villeName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result ? (int) $result : null;
    }
}
