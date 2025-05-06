<?php

namespace App\Controller;

use App\Router;
use App\Exceptions\ControllerException;

/**
 * Contrôleur responsable de la déconnexion utilisateur
 */
class LogoutController implements ControllerInterface
{
    public function __construct() {}

    /**
     * Méthode appelée lors d'une requête POST
     * @return void
     */
    public function doPOST(): void
    {
        throw new \Exception("Cette action n'est pas supportée.");
    }

    /**
     * Méthode appelée lors d'une requête GET
     * @return void
     */
    public function doGET(): void
    {
        // Démarre la session si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Détruit la session si elle est active
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = []; // Vide toutes les données de session

            // Supprime le cookie de session si nécessaire
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }

            session_destroy(); // Détruit la session
        }

        // Redirige vers la page d'accueil
        Router::redirect("GET", "home");
    }
}