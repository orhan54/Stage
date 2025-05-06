<?php

namespace App\Controller;

use App\Model\DAO\UserDAO;
use App\Model\Entity\UserEntity;
use App\Utils\PasswordValidator;
use App\Router;

/**
 * Contrôleur responsable de l'inscription d'un nouvel utilisateur
 */
class RegisterUserController implements ControllerInterface
{
    /**
     * Instance de la classe UserDAO
     * @var UserDAO $model
     */
    private UserDAO $model;

    /**
     * Construit une nouvelle instance
     */
    public function __construct()
    {
        $this->model = new UserDAO();
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode GET
     * @return void
     */
    public function doGET(): void
    {
        // Affiche le formulaire d'inscription
        $title = "Inscription";
        include("./src/view/register.php");
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void
    {
        try {
            $this->validerEntree();

            $user = $this->creerUtilisateurDepuisPost();

            // Appelle la méthode create
            $this->model->create($user);
            Router::redirect('GET', "home");
        } catch (\Exception $e) {
            // Gérer les exceptions (par exemple, enregistrer l'erreur, afficher un message convivial)
            die("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }

    /**
     * Crée une instance de UserEntity à partir des données POST
     * @return UserEntity
     */
    private function creerUtilisateurDepuisPost(): UserEntity
    {
        $user = new UserEntity();
        $user->setUserNom($_POST["user_nom"]);
        $user->setUserPrenom($_POST["user_prenom"]);
        $user->setUserEmail($_POST["user_email"]);
        $user->setUserTelephone($_POST["user_telephone"]);
        $user->setUserNaissance($_POST["user_naissance"]);
        $user->setUserArriverFrance($_POST["user_arriver_france"]);
        $user->setIdVilleFR($this->model->getVilleId($_POST["villeFrance"]));
        $user->setUserVilleUkraine($_POST["user_ville_ukraine"]);
        $user->setUserLangueFrancaise($_POST["user_langue_francaise"]);
        $user->setUserExperience($_POST["user_experience"]);
        $user->setUserNiveauEtude($_POST["user_niveau_etude"]);
        $user->setUserDernierPosteUkraine($_POST["user_dernier_poste_ukraine"]);
        $user->setUserDernierPosteFrance($_POST["user_dernier_poste_france"]);
        $user->setUserPseudonyme($_POST["user_pseudonyme"]);
        $user->setUserMp($_POST["user_mp"]);

        return $user;
    }

    /**
     * Valide les données d'entrée
     * @throws \Exception
     */
    private function validerEntree(): void
    {
        if (empty($_POST['user_nom']) || empty($_POST['user_prenom']) || empty($_POST['user_email']) ||
            empty($_POST['user_telephone']) || empty($_POST['user_naissance']) || empty($_POST['user_arriver_france']) ||
            empty($_POST['villeFrance']) || empty($_POST['user_ville_ukraine']) || empty($_POST['user_langue_francaise']) ||
            empty($_POST['user_niveau_etude']) || empty($_POST['user_dernier_poste_ukraine']) || empty($_POST['user_dernier_poste_france']) ||
            empty($_POST['user_pseudonyme']) || empty($_POST['user_mp'])) {
            throw new \Exception("Tous les champs sont obligatoires.");
        }

        if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Adresse e-mail invalide.");
        }

        // Valider le mot de passe
        if (empty($_POST['user_mp']) || !PasswordValidator::valider($_POST['user_mp_confirm'])) {
            throw new \Exception("Le mot de passe doit contenir au moins 12 caractères, une lettre majuscule et un caractère spécial.");
        }
    }
}
