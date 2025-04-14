<?php

namespace App\model\DAO;

use App\config\Database;
use App\model\Entity\AbstractEntity;
use App\model\Entity\UserEntity;
use App\model\ModelException;

class UserDAO implements DAOInterface
{
    public function getVilleId(string $ville): int
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT Id_villeFR FROM VilleFR WHERE ville_nom_france = ?");
            $query->execute([$ville]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                return (int)$result['Id_villeFR'];
            } else {
                // Si la ville n'existe pas, insérez-la dans la base de données
                $insertQuery = $db->prepare("INSERT INTO VilleFR (ville_nom_france, Id_departement) VALUES (?, ?)");
                $insertQuery->execute([$ville, 1]); // Remplacez 1 par l'ID du département par défaut
                return (int)$db->lastInsertId();
            }
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la récupération ou de l'insertion de l'ID de la ville : " . $e->getMessage());
        }
    }

    public function create(AbstractEntity $entity): AbstractEntity
    {
        /** @var UserEntity $user */
        $user = $entity;
        try {
            $db = Database::getInstance();

            // Si l'ID de la ville est 0, essayez de le récupérer à partir du nom de la ville
            if ($user->getIdVilleFR() === 0 && !empty($user->getUserVilleUkraine())) {
                $query = $db->prepare("SELECT ville_nom_france FROM VilleFR WHERE Id_villeFR = ?");
                $query->execute([$user->getUserVilleUkraine()]);
                $ville = $query->fetch(\PDO::FETCH_ASSOC);

                if (!$ville) {
                    // Insérez la ville si elle n'existe pas
                    $insertQuery = $db->prepare("INSERT INTO VilleFR (ville_nom_france, Id_departement) VALUES (?, ?)");
                    $insertQuery->execute([$user->getUserVilleUkraine(), 1]); // Remplacez 1 par l'ID du département par défaut
                    $user->setIdVilleFR((int)$db->lastInsertId());
                } else {
                    $user->setIdVilleFR((int)$ville['Id_villeFR']);
                }
            }

            // Insérez l'utilisateur
            $query = $db->prepare("INSERT INTO users (
            user_nom, 
            user_prenom, 
            user_email,
            user_telephone, 
            user_naissance, 
            user_arriver_france, 
            Id_villeFR,
            user_langue_francaise, 
            user_experience, 
            user_niveau_etude, 
            user_dernier_poste_ukraine, 
            user_dernier_poste_france,
            user_ville_ukraine,
            user_pseudonyme,
            user_mp
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->execute([
                $user->getUserNom(),
                $user->getUserPrenom(),
                $user->getUserEmail(),
                $user->getUserTelephone(),
                $user->getUserNaissance(),
                $user->getUserArriverFrance(),
                $user->getIdVilleFR(),
                $user->getUserLangueFrancaise(),
                $user->getUserExperience(),
                $user->getUserNiveauEtude(),
                $user->getUserDernierPosteUkraine(),
                $user->getUserDernierPosteFrance(),
                $user->getUserVilleUkraine(),
                $user->getUserPseudonyme(),
                hash('sha512', $user->getUserPassword())
            ]);
            $user->setUserId((int)$db->lastInsertId());
            return $user;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de l'enregistrement de l'utilisateur : " . $e->getMessage());
        }
    }

    public function readAll(): array
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM users");
            $query->execute();

            return $query->fetchAll(\PDO::FETCH_CLASS, UserEntity::class);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture des utilisateurs en BDD : " . $e->getMessage());
        }
    }

    public function readOne(int $id): AbstractEntity
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM users WHERE id_user = ?");
            $query->execute([$id]);
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                throw new ModelException("Aucun utilisateur ne correspond à l'identifiant fourni.");
            }

            $user = new UserEntity();
            $user
                ->setUserId((int)$data['id_user'])
                ->setUserNom($data['user_nom'])
                ->setUserPrenom($data['user_prenom'])
                ->setUserEmail($data['user_email'])
                ->setUserTelephone($data['user_telephone'])
                ->setUserNaissance($data['user_naissance'])
                ->setUserArriverFrance($data['user_arriver_france'])

                ->setUserLangueFrancaise($data['user_langue_francaise'])
                ->setUserExperience($data['user_experience'])
                ->setUserNiveauEtude($data['user_niveau_etude'])
                ->setUserDernierPosteUkraine($data['user_dernier_poste_ukraine'])
                ->setUserDernierPosteFrance($data['user_dernier_poste_france'])
                ->setUserVilleUkraine($data['user_ville_ukraine'])
                ->setUserPseudonyme($data['user_pseudonyme'])
                ->setUserPassword($data['user_mp']);
            return $user;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture de l'utilisateur en BDD : " . $e->getMessage());
        }
    }

    public function update(AbstractEntity $entity): bool
    {
        /** @var UserEntity $user */
        $user = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("UPDATE users SET 
                user_nom = ?,
                user_prenom = ?,
                user_email = ?,
                user_telephone = ?,
                user_naissance = ?,
                user_arriver_france = ?,
                user_id_ville_fr = ?,
                user_langue_francaise = ?,
                user_experience = ?,
                user_niveau_etude = ?,
                user_dernier_poste_ukraine = ?,
                user_dernier_poste_france = ?,
                user_ville_ukraine = ?,
                user_pseudonyme = ?,
                user_mp = ?
                WHERE id_user = ?");

            return $query->execute([
                $user->getUserNom(),
                $user->getUserPrenom(),
                $user->getUserEmail(),
                $user->getUserTelephone(),
                $user->getUserNaissance(),
                $user->getUserArriverFrance(),
                $user->getUserLangueFrancaise(),
                $user->getUserExperience(),
                $user->getUserNiveauEtude(),
                $user->getUserDernierPosteUkraine(),
                $user->getUserDernierPosteFrance(),
                $user->getUserVilleUkraine(),
                $user->getUserPseudonyme(),
                hash('sha512', $user->getUserPassword()),
                $user->getUserId()
            ]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la mise à jour de l'utilisateur : " . $e->getMessage());
        }
    }

    public function delete(AbstractEntity $entity): bool
    {
        /** @var UserEntity $user */
        $user = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("DELETE FROM users WHERE id_user = ?");
            return $query->execute([$user->getUserId()]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
        }
    }

    public function login(string $email, string $password): UserEntity
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM users WHERE user_email = ?");
            $query->execute([$email]);
            $data = $query->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                throw new ModelException("Identifiants incorrects.");
            }

            if (!password_verify($password, $data['user_mp'])) {
                throw new ModelException("Mot de passe incorrect.");
            }

            $user = new UserEntity();
            $user
                ->setUserId((int)$data['id_user'])
                ->setUserNom($data['user_nom'])
                ->setUserPrenom($data['user_prenom'])
                ->setUserEmail($data['user_email'])
                ->setUserTelephone($data['user_telephone'])
                ->setUserNaissance($data['user_naissance'])
                ->setUserArriverFrance($data['user_arriver_france'])
                ->setUserLangueFrancaise($data['user_langue_francaise'])
                ->setUserExperience($data['user_experience'])
                ->setUserNiveauEtude($data['user_niveau_etude'])
                ->setUserDernierPosteUkraine($data['user_dernier_poste_ukraine'])
                ->setUserDernierPosteFrance($data['user_dernier_poste_france'])
                ->setUserVilleUkraine($data['user_ville_ukraine'])
                ->setUserPseudonyme($data['user_pseudonyme'])
                ->setUserPassword($data['user_mp']);
            return $user;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la connexion de l'utilisateur : " . $e->getMessage());
        }
    }
}
