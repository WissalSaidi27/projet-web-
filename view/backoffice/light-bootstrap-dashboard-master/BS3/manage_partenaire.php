<?php
// Configuration de la connexion à la base de données
$host = 'localhost';
$dbname = 'partenaires';
$username = 'root'; // Remplace si nécessaire
$password = ''; // Remplace si nécessaire

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Gestion des opérations CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'create_partner') {
        // Ajouter un partenaire
        $id =$_POST['id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $adr = $_POST['adr'];

        $stmt = $pdo->prepare("INSERT INTO partenaire (id,nom, email, adr) VALUES ($id,$nom, $nom, $email)");
        $stmt->execute([$id,$nom, $email, $adr]);
        echo "Partenaire ajouté avec succès.";
    
?>
