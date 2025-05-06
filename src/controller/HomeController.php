<?php

namespace App\Controller;

use App\Exceptions\ControllerException;

class HomeController implements ControllerInterface
{

    public function __construct()
    {
    }

    public function doGET(): void
    {
        $title = "Accueil";
        include __DIR__ . '/../view/home.php';
    }

    public function doPOST()
    {
        throw new ControllerException("Cette action n'est pas supportée");
    }

}