<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/PHP/Stage/public/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script type="module" src="/PHP/Stage/public/js/app.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <title>Les lumiéres d'Ukraine</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-3">
                <img id="coeur" src="/PHP/Stage/public/image/coeur.png" alt="coeur">
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-center">
                <img id="logo" src="/PHP/Stage/public/image/logo.png" alt="logo" class="w-100">
            </div>
            <div id="btnCreeCompte" class="col-3 d-flex justify-content-end">
                <?php if (isset($_SESSION['user']) || isset($_SESSION['association'])): ?>
                    <div class="d-flex gap-2">
                        <button class="btn btn-secondary dropdown-toggle me-2" type="button" id="btnSettings" data-bs-toggle="dropdown" aria-expanded="false">
                            Paramètres
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="btnSettings">
                            <li><a class="dropdown-item" href="/PHP/Stage/src/view/account.php">Mon compte</a></li>
                            <li><a class="dropdown-item" href="/PHP/Stage/src/view/evenement.php">Ajouter un événement</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a id="btnCreateAccount" href="/PHP/Stage/src/view/createChoose.php" class="btn btn-primary me-2 w-100 w-md-50">Créer compte</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['user']) || isset($_SESSION['association'])): ?>
                    <a id="btnLogout" href="/PHP/Stage/index.php?route=logout" class="btn btn-danger me-2 w-50 w-md-25">
                        Déconnexion
                    </a>
                <?php else: ?>
                    <a id="btnConnexion" href="/PHP/Stage/index.php?route=login" class="btn btn-primary me-2 w-100 w-md-50">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-primary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/home.php">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/logement.php">Logement</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/finance.php">Finances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/association.php">Association</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/communication.php">Vos démarches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/travail.php">Travail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/PHP/Stage/src/view/etude.php">Etude</a>
                    </li>
                </ul>
                <div id="btnHamburgerCompte">
                    <a href="/PHP/Stage/src/view/createChoose.php" class="btn btn-primary col-12 mb-2">Créer compte</a>
                    <a href="/PHP/Stage/src/view/login.php" class="btn btn-primary col-12">Connexion</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="col-12 col-md-12 col-lg-3 col-xxl-2 mb-3" style="height: 300px;" id="map"></div>

    <?= $content ?>

    <footer>
        <img id="drapeau" src="/PHP/Stage/public/image/drapeau-france-ukraine.avif" alt="drapeau">
    </footer>

</body>

</html>