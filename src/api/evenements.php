<?php
// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Adapter le chemin selon votre structure de projet
require_once '../../vendor/autoload.php';

// Utiliser la classe Database via l'autoloader
use App\Config\Database;

// En-têtes pour CORS et type de contenu
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

try {
    // Obtenir l'instance de la base de données
    $db = Database::getInstance();

    // Requête SQL pour récupérer les événements, les médias et les villes associés
    $query = "
        SELECT 
            e.id_evenement,
            e.evenement_titre AS titre,
            e.evenement_description AS description,
            e.evenement_date AS date,
            e.evenement_description AS descriptif,
            e.id_villeFR, 
            v.ville_nom,
            m.media_chemin AS chemin
        FROM evenement e
        INNER JOIN media m ON e.id_evenement = m.id_evenement
        LEFT JOIN VilleFR v ON e.id_villeFR = v.Id_villeFR
    ";

    // Exécuter la requête
    $stmt = $db->query($query);

    // Récupérer tous les résultats
    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Modifier les chemins des médias pour les rendre accessibles via HTTP
    foreach ($evenements as &$evenement) {
        if (isset($evenement['chemin']) && !empty($evenement['chemin'])) {
            // Ajouter le chemin complet pour l'accès HTTP
            $evenement['chemin'] = 'http://localhost/PHP/Stage/uploads/photos/' . basename($evenement['chemin']);
        }
    }

    // Renvoyer les données au format JSON
    echo json_encode($evenements, JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    // En cas d'erreur, renvoyer un code d'erreur HTTP 500 et le message d'erreur
    http_response_code(500);
    echo json_encode([
        'error' => 'Erreur serveur: ' . $e->getMessage()
    ]);
}