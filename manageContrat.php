<?php
require_once '../../controllers/ContratControlleur.php';

header('Content-Type: application/json');

$controller = new ContratController();
$response = ['success' => false, 'message' => '', 'data' => null];

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
        $id_part = $_POST['id_part'];
        $type_c = $_POST['type_c'];
        $duree = $_POST['duree'];
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
    
        // Vérifier les données (pour la sécurité)
        if (!empty($id_part) && !empty($type_c) && !empty($duree) && !empty($date_debut) && !empty($date_fin)) {
            // Insérer le contrat dans la base de données
            $sql = "INSERT INTO contrat (id_part, type_c, duree, date_debut, date_fin) 
                    VALUES (:id_part, :type_c, :duree, :date_debut, :date_fin)";
    
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id_part' => $id_part,
                ':type_c' => $type_c,
                ':duree' => $duree,
                ':date_debut' => $date_debut,
                ':date_fin' => $date_fin
            ]);
    
            // Redirection ou confirmation après insertion
            header("Location: page_de_confirmation.php");
            exit;
        } else {
            echo "Tous les champs sont obligatoires.";
        }
    }
    
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>