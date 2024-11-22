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
    } elseif ($action === 'create_contract') {
        // Ajouter un contrat
        $id_part = $_POST['id_part'];
        $type_c = $_POST['type_c'];
        $duree = $_POST['duree'];

        $stmt = $pdo->prepare("INSERT INTO contrat (id_part, type_c, duree) VALUES (?, ?, ?)");
        $stmt->execute([$id_part, $type_c, $duree]);
        echo "Contrat ajouté avec succès.";
    } elseif ($action === 'delete_partner') {
        // Supprimer un partenaire et ses contrats associés
        $id_part = $_POST['id_part'];

        $stmt = $pdo->prepare("DELETE FROM partenaire WHERE id_part = ?");
        $stmt->execute([$id_part]);
        echo "Partenaire supprimé avec succès.";
    } elseif ($action === 'delete_contract') {
        // Supprimer un contrat
        $id_c = $_POST['id_c'];

        $stmt = $pdo->prepare("DELETE FROM contrat WHERE id_c = ?");
        $stmt->execute([$id_c]);
        echo "Contrat supprimé avec succès.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && $_POST['type'] === 'contracts') {
        // Lecture des contrats
        $stmt = $pdo->query("SELECT contrat.*, partenaire.nom AS partenaire_nom FROM contrat 
                             JOIN partenaire ON contrat.id_part = partenaire.id_part");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    } else {
        // Lecture des partenaires
        $stmt = $pdo->query("SELECT * FROM partenaire");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
}
?>
