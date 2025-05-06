<?php
// Inclure l'autoloader de Composer pour charger automatiquement les classes
require_once '../../vendor/autoload.php'; 

// Utiliser la classe Database via l'autoloader
use App\Config\Database;

header('Content-Type: application/json');

try {
    $db = Database::getInstance();
    $stmt = $db->query("
        SELECT 
            association_logo AS logo,
            association_nom AS nom,
            association_description_FR AS descriptif,
            association_site_web AS siteWeb,
            association_instagram AS instagram,
            association_facebook AS facebook,
            association_telegram AS telegram
        FROM association
    ");

    $associations = $stmt->fetchAll();
    
    // Modifier les chemins des logos pour les rendre accessibles via HTTP
    foreach ($associations as &$association) {
        // Corriger le chemin des logos
        $association['logo'] = 'http://localhost/PHP/Stage/uploads/' . basename($association['logo']);
    }

    echo json_encode($associations, JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur serveur: ' . $e->getMessage()]);
}
