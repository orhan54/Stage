<?php

namespace App\Controller;

use App\Model\DAO\UserDAO;
use App\Model\DAO\AssociationDAO;
use App\Model\ModelException;
use App\Router;

/**
 * Contrôleur responsable de la connexion utilisateur
 */
class LoginController implements ControllerInterface
{
    /**
     * Instances des DAO pour les utilisateurs et les associations
     * @var UserDAO $userModel
     * @var AssociationDAO $associationModel
     */
    private UserDAO $userModel;
    private AssociationDAO $associationModel;

    /**
     * Construit une nouvelle instance
     */
    public function __construct()
    {
        $this->userModel = new UserDAO();
        $this->associationModel = new AssociationDAO();
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode GET
     * @return void
     */
    public function doGET(): void
    {
        // Affiche le formulaire de connexion
        $title = "Connexion";
        include __DIR__ . '/../view/login.php';
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        if (empty($email) || empty($password)) {
            header("Location: index.php?route=login&error=Tous%20les%20champs%20doivent%20être%20remplis.");
            exit;
        }

        try {
            // Tente de récupérer un utilisateur
            $user = $this->userModel->findByEmail($email);
            $type = 'user';

            // Si aucun utilisateur trouvé, tente une association
            if ($user === null) {
                $user = $this->associationModel->findByEmail($email);
                $type = 'association';
            }

            // Si toujours rien => erreur
            if ($user === null) {
                header("Location: index.php?route=login&error=Identifiants%20invalides.");
                exit;
            }

            // Vérifie le mot de passe selon le type d'utilisateur
            if ($type === 'association') {
                // Si l'utilisateur est une association, on utilise getAssociationMp
                if (!password_verify($password, $user->getAssociationMp())) {
                    header("Location: index.php?route=login&error=Mot%20de%20passe%20incorrect.");
                    exit;
                }
            } else {
                // Si l'utilisateur est un user classique, on utilise getUserMp
                if (!password_verify($password, $user->getUserMp())) {
                    header("Location: index.php?route=login&error=Mot%20de%20passe%20incorrect.");
                    exit;
                }
            }

            // Stocke les infos dans la session, selon le type
            if ($type === 'association') {
                $_SESSION[$type] = [
                    'id' => $user->getIdAssociation(), // Assurez-vous que la méthode getId() existe dans votre entité AssociationEntity
                    'email' => $user->getAssociationEmail(),
                    'nom' => $user->getAssociationNom(),
                    'prenom' => null, // Les associations n'ont généralement pas de prénom
                ];
            } else {
                $_SESSION[$type] = [
                    'id' => $user->getIdUser(), // Assurez-vous que la méthode getId() existe dans votre entité UserEntity
                    'email' => $user->getUserEmail(),
                    'nom' => $user->getUserNom(),
                    'prenom' => $user->getUserPrenom(),
                ];
            }

            Router::redirect("GET", "home");
            return;
        } catch (ModelException $e) {
            header("Location: index.php?route=login&error=" . urlencode("Une erreur est survenue : " . $e->getMessage()));
            exit;
        }
    }
}