<?php

namespace App\Controller;

use App\Router;

/**
 *  Contrôlleur responsable de la gestion des finances
 */
class FinanceController implements ControllerInterface {
    public function __construct() {

    }

    public function doGET() {
        $title = "Finance";
        include("./src/view/finance.php");
    }
    
    public function doPOST() {

    }
}