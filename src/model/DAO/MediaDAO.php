<?php

namespace App\Model\DAO;

use App\Config\Database;
use App\Model\Entity\AbstractEntity;
use App\Model\Entity\MediaEntity;
use App\Model\ModelException;
use PDO;

class MediaDAO implements DAOInterface
{
    public function create(AbstractEntity $entity): AbstractEntity
    {
        if (!$entity instanceof MediaEntity) {
            throw new ModelException("Invalid entity type. Expected MediaEntity.");
        }

        $query = "INSERT INTO Media (media_chemin, Id_type_media, Id_evenement, Id_hebergement)
                    VALUES (:media_chemin, :Id_type_media, :Id_evenement, :Id_hebergement)";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':media_chemin', $entity->getMediaChemin(), PDO::PARAM_STR);
        $stmt->bindValue(':Id_type_media', $entity->getIdTypeMedia(), PDO::PARAM_INT);
        $stmt->bindValue(':Id_evenement', $entity->getIdEvenement(), PDO::PARAM_INT);
        $stmt->bindValue(':Id_hebergement', $entity->getIdHebergement(), PDO::PARAM_INT);
        $stmt->execute();

        $entity->setIdMedia((int) Database::getInstance()->lastInsertId());
        return $entity;
    }

    public function readOne(int $id): AbstractEntity
    {
        $query = "SELECT * FROM Media WHERE Id_media = :id";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchObject(MediaEntity::class) ?: null;
    }

    public function readAll(): array
    {
        $query = "SELECT * FROM Media";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, MediaEntity::class);
    }

    public function update(AbstractEntity $entity): bool
    {
        if (!$entity instanceof MediaEntity) {
            throw new ModelException("Invalid entity type. Expected MediaEntity.");
        }

        $query = "UPDATE Media SET media_chemin = :media_chemin, Id_type_media = :Id_type_media,
                    Id_evenement = :Id_evenement, Id_hebergement = :Id_hebergement WHERE Id_media = :id";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':media_chemin', $entity->getMediaChemin(), PDO::PARAM_STR);
        $stmt->bindValue(':Id_type_media', $entity->getIdTypeMedia(), PDO::PARAM_INT);
        $stmt->bindValue(':Id_evenement', $entity->getIdEvenement(), PDO::PARAM_INT);
        $stmt->bindValue(':Id_hebergement', $entity->getIdHebergement(), PDO::PARAM_INT);
        $stmt->bindValue(':id', $entity->getIdMedia(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete(AbstractEntity $entity): bool
    {
        if (!$entity instanceof MediaEntity) {
            throw new ModelException("Invalid entity type. Expected MediaEntity.");
        }

        $query = "DELETE FROM Media WHERE Id_media = :id";
        $stmt = Database::getInstance()->prepare($query);
        $stmt->bindValue(':id', $entity->getIdMedia(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function findByEvenementId(int $evenementId): array
    {
        $sql = "SELECT * FROM Media WHERE Id_evenement = :evenementId";
        $stmt = Database::getInstance()->prepare($sql);
        $stmt->bindValue(':evenementId', $evenementId, PDO::PARAM_INT);
        $stmt->execute();

        $medias = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $media = new MediaEntity();
            $media->setIdMedia($row['Id_media'])
                ->setMediaChemin($row['media_chemin'])
                ->setIdTypeMedia($row['Id_type_media'])
                ->setIdEvenement($row['Id_evenement']);

            if (isset($row['Id_hebergement'])) {
                $media->setIdHebergement($row['Id_hebergement']);
            }

            $medias[] = $media;
        }

        return $medias;
    }
}