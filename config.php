<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'tourism_tunisie';
$username = 'root';
$password = '';

try {
    // Création de la connexion PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Configuration des erreurs PDO pour lever des exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    die('Erreur de connexion : ' . $e->getMessage());
}

// Fonction de chargement automatique des classes
spl_autoload_register(function ($class_name) {
    $paths = ['models/', 'controllers/'];
    foreach ($paths as $path) {
        $file = __DIR__ . '/' . $path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});
?>
