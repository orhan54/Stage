<?php

namespace App;

use App\Exceptions\RouterException;
use App\Exceptions\ControllerException;
use App\Controller\ControllerInterface;

/**
 * La classe Router implémente un routeur simple basé sur le paramètre GET nommé "route"
 */
class Router
{
    /**
     * Stocke le mapping entre nom de routes et contrôleurs
     * @var array
     */
    private static array $routes = [];

    /**
     * Enregistre une route dans le système
     * @param string $route Nom de la route utilisé en paramètre GET dans l'URL
     * @param \App\Controller\ControllerInterface $controller Instance du contrôleur en charge de cette route
     * @return void
     */
    public static function addRoute(string $route, ControllerInterface $controller): void
    {
        self::$routes[$route] = $controller;
    }

    /**
     * Redirige l'application vers une route avec la méthode spécifiée
     * @param string $method Méthode HTTP
     * @param string $route
     * @throws \App\Exceptions\ControllerException
     * @return void
     */
    public static function redirect(string $method, string $route)
    {
        if (array_key_exists($route, self::$routes)) {
            $controller = self::$routes[$route];
            if ($method === "POST") {
                $controller->doPOST();
            } else {
                $controller->doGET();
            }
        } else {
            throw new ControllerException("La route demandée n'existe pas");
        }
    }

    /**
     * Délegue le traitement de la requête au contrôleur et à sa méthode appropriée
     * @throws \App\Exceptions\ControllerException Si la route demandée n'existe pas
     * @return void
     */
    public static function delegate()
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $route  = isset($_GET["route"]) ? $_GET["route"] : "home";
        self::redirect($method, $route);
    }
}
