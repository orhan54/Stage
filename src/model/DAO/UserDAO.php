<?php

namespace App\Model\DAO;

use App\Config\Database;
use App\Model\Entity\AbstractEntity;
use App\Model\Entity\UserEntity;
use App\Model\ModelException;

class UserDAO implements DAOInterface
{
    public function getVilleId(string $ville): int
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT Id_villeFR FROM VilleFR WHERE ville_nom = ?"); // Utilisation de 'ville_nom'
            $query->execute([$ville]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                return (int)$result['Id_villeFR'];
            } else {
                // Si la ville n'existe pas, insérez-la dans la base de données
                $insertQuery = $db->prepare("INSERT INTO VilleFR (ville_nom, Id_departement) VALUES (?, ?)");
                $insertQuery->execute([$ville, 1]); // Remplacez 1 par l'ID du département par défaut
                return (int)$db->lastInsertId();
            }
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la récupération ou de l'insertion de l'ID de la ville : " . $e->getMessage());
        }
    }

    public function getTypeUserId(string $typeUser): int
    {
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT Id_TypeUser FROM TypeUser WHERE type_user_nom = ?");
            $query->execute([$typeUser]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                return (int)$result['Id_TypeUser'];
            } else {
                // Si le type d'utilisateur n'existe pas, insérez-le dans la base de données
                $insertQuery = $db->prepare("INSERT INTO TypeUser (type_user_nom) VALUES (?)");
                $insertQuery->execute([$typeUser]);
                return (int)$db->lastInsertId();
            }
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la récupération ou de l'insertion de l'ID du type d'utilisateur : " . $e->getMessage());
        }
    }

    public function create(AbstractEntity $entity): AbstractEntity
    {
        /** @var UserEntity $user */
        $user = $entity;
        try {
            $db = Database::getInstance();

            // Définir une valeur par défaut pour Id_TypeUser si elle est manquante
            $idTypeUser = $user->getIdTypeUser() ?: 1; // Assurez-vous que 1 existe dans la table typeuser

            // Vérifiez si Id_TypeUser existe dans la table typeuser
            $query = $db->prepare("SELECT COUNT(*) FROM typeuser WHERE Id_TypeUser = ?");
            $query->execute([$idTypeUser]);
            if ($query->fetchColumn() == 0) {
                // Si le type d'utilisateur n'existe pas, insérez un type par défaut
                $defaultTypeUser = 'Utilisateur Standard';
                $idTypeUser = $this->getTypeUserId($defaultTypeUser);
            }

            // Insérer l'utilisateur dans la table users
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
            user_mp,
            Id_TypeUser
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
                password_hash($user->getUserMp(), PASSWORD_BCRYPT), // Utilisation de password_hash pour le mot de passe
                $idTypeUser
            ]);
            $user->setIdUser((int)$db->lastInsertId());
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
                ->setIdUser((int)$data['id_user'])
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
                ->setUserMp($data['user_mp']);
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
                hash('sha512', $user->getUserMp()),
                $user->getIdUser()
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
            return $query->execute([$user->getIdUser()]);
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
                ->setIdUser((int)$data['id_user'])
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
                ->setUserMp($data['user_mp']);
            return $user;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la connexion de l'utilisateur : " . $e->getMessage());
        }
    }

    public function findByEmail(string $email): ?UserEntity
    {
        try {
            // Prépare la requête pour rechercher un utilisateur par email
            $query = $this->getConnection()->prepare("SELECT * FROM users WHERE user_email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            // Récupère le résultat
            $result = $query->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                // Vérifie si la clé 'id_user' existe dans le tableau $result
                if (isset($result['Id_user'])) {
                    $user = new UserEntity();
                    $user->setIdUser((int)$result['Id_user']);
                    $user->setUserEmail($result['user_email']);
                    $user->setUserMp($result['user_mp']);
                    $user->setUserNom($result['user_nom']);
                    $user->setUserPrenom($result['user_prenom']);
                    return $user;
                } else {
                    throw new ModelException("La colonne 'id_user' est manquante dans la base de données.");
                }
            }

            return null;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la recherche de l'utilisateur par email : " . $e->getMessage());
        }
    }


    /**
     * Gets the database connection.
     *
     * @return \PDO
     */
    private function getConnection(): \PDO
    {
        $pdo = new \PDO('mysql:host=localhost;dbname=ukraine', 'root', '');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}