<?php

namespace App\controller;

use App\Exceptions\ControllerException;

class HomeController implements ControllerInterface {

    public function __construct() {}

    public function doGET() {
        $title = "Accueil";
        // sql: liste les 10 derniers events
        include("./src/view/home.php");
    }
    public function doPOST() {
        throw new ControllerException("Cette action n'est pas supportée");
    }

}