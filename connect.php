<?php
// Configuration de la connexion à la base de données
$host = 'localhost';         // Hôte de la base de données (généralement localhost)
$dbname = 'user';  // Nom de la base de données
$username = 'root';          // Nom d'utilisateur de la base de données (par défaut 'root' sur XAMPP)
$password = '';              // Mot de passe de la base de données (vide par défaut sur XAMPP)

// Tentative de connexion à la base de données via PDO (PHP Data Objects)
try {
    // Créer une instance PDO
    $pdo = new PDO("mysql:host=localhost;dbname=user", $username, $password);
    
    // Définir le mode d'erreur PDO sur exception pour mieux gérer les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Afficher un message si la connexion est réussie
    // echo "Connexion réussie!";
} catch (PDOException $e) {
    // En cas d'échec de la connexion, afficher l'erreur
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>
