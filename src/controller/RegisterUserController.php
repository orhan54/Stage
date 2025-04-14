<?php

namespace App\controller;

use App\model\DAO\UserDAO;
use App\model\Entity\UserEntity;
use App\Router;

/**
 *  Contrôlleur responsable de l'inscription d'un nouvel utilisateur
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
        // affiche le formulaire d'inscription
        $title = "Inscription";
        include("./src/view/register.php");
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void
    {

        $user = new UserEntity();
        $user->setUserNom($_POST["nom"]);
        $user->setUserPrenom($_POST["prenom"]);
        $user->setUserEmail($_POST["email"]);
        $user->setUserTelephone($_POST["telephone"]);
        $user->setUserNaissance($_POST["naissance"]);
        $user->setUserArriverFrance($_POST["anneeFrance"]);
        $user->setIdVilleFR($this->model->getVilleId($_POST["villeFrance"]));
        $user->setUserVilleUkraine($_POST["villeUkraine"]);
        $user->setUserLangueFrancaise($_POST["niveauLangue"]);
        $user->setUserExperience($_POST["experience"]);
        $user->setUserNiveauEtude($_POST["niveauEtude"]);
        $user->setUserDernierPosteUkraine($_POST["dernierPosteUkraine"]);
        $user->setUserDernierPosteFrance($_POST["dernierPosteFrance"]);
        $user->setUserPseudonyme($_POST["pseudo"]);
        $user->setUserPassword($_POST["mp"]);

        // Appelle la méthode create
        try {
            $this->model->create($user);
            Router::redirect("POST", "home");
        } catch (\Exception $e) {
            die("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }
}
