<?php

ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Chargement de l'autoloader Composer
require_once('./vendor/autoload.php');

// Chargement des variables d'environnement
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Router;
use App\Controller\HomeController;
use App\Controller\RegisterUserController;
use App\Controller\RegisterAssociationController;
use App\Controller\LoginController;
use App\Controller\LogoutController;
use App\Controller\AssociationController;
use App\Controller\FinanceController;
use App\Controller\EvenementController;

// Enregistrement des routes
Router::addRoute("home", new HomeController());
Router::addRoute("registerUser", new RegisterUserController());
Router::addRoute("registerAssociation", new RegisterAssociationController());
Router::addRoute("login", new LoginController());
Router::addRoute("logout", new LogoutController());
Router::addRoute("association", new AssociationController());
Router::addRoute("finance", new FinanceController());
Router::addRoute("evenement", new EvenementController());

// Délégation au routeur
Router::delegate();
