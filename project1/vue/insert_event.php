<?php
// Inclure le fichier de connexion à la base de données
require 'db_connection.php';

$response = []; // Pour stocker les messages d'erreur ou de succès

// Déterminer la méthode HTTP utilisée
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // **C - Create (Créer)**

    // Récupérer les données du formulaire
    $eventName = htmlspecialchars($_POST['eventName']);
    $eventDescription = htmlspecialchars($_POST['eventDescription']);
    $eventDate = htmlspecialchars($_POST['eventDate']);
    $userId = 1; // ID de l'utilisateur connecté (par exemple via $_SESSION['user_id'])

    // Vérification des champs obligatoires
    if (empty($eventName) || empty($eventDate)) {
        $response[] = "Le nom de l'événement et la date sont obligatoires.";
    } else {
        // Dossier pour stocker les fichiers uploadés
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crée le dossier si nécessaire
        }

        // Gestion des fichiers uploadés
        $uploadedFiles = [];
        if (!empty($_FILES['eventMedia']['name'][0])) {
            $files = $_FILES['eventMedia'];
            $fileCount = count($files['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = basename($files['name'][$i]);
                $fileTmpPath = $files['tmp_name'][$i];
                $fileType = $files['type'][$i];

                // Générer un nom unique pour chaque fichier
                $uniqueName = uniqid() . '_' . $fileName;
                $targetPath = $uploadDir . $uniqueName;

                // Vérification du type MIME (images et vidéos uniquement)
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'video/mp4', 'video/mpeg'];
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($fileTmpPath, $targetPath)) {
                        $uploadedFiles[] = $targetPath; // Ajouter le chemin du fichier à la liste
                    } else {
                        $response[] = "Erreur lors du téléchargement du fichier : $fileName";
                    }
                } else {
                    $response[] = "Type de fichier non pris en charge : $fileName";
                }
            }
        }

        // Insérer les données dans la base
        try {
            $stmt = $pdo->prepare("
                INSERT INTO events (event_name, event_description, event_date, media_paths, user_id) 
                VALUES (:eventName, :eventDescription, :eventDate, :mediaPaths, :userId)
            ");
            $stmt->execute([
                ':eventName' => $eventName,
                ':eventDescription' => $eventDescription,
                ':eventDate' => $eventDate,
                ':mediaPaths' => json_encode($uploadedFiles), // Convertir les chemins en JSON
                ':userId' => $userId
            ]);

            $response[] = "Événement ajouté avec succès !";
        } catch (PDOException $e) {
            $response[] = "Erreur d'insertion dans la base : " . $e->getMessage();
        }
    }
} elseif ($method === 'GET') {
    // **R - Read (Lire)**

    try {
        $stmt = $pdo->query("SELECT * FROM events");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($events) {
            foreach ($events as $event) {
                $response[] = "Nom : " . $event['event_name'] . "<br>"
                    . "Description : " . $event['event_description'] . "<br>"
                    . "Date : " . $event['event_date'] . "<br>"
                    . "Média : " . $event['media_paths'] . "<br><hr>";
            }
        } else {
            $response[] = "Aucun événement trouvé.";
        }
    } catch (PDOException $e) {
        $response[] = "Erreur lors de la récupération des événements : " . $e->getMessage();
    }
} elseif ($method === 'PUT') {
    // **U - Update (Mettre à jour)**

    // Récupérer les données du body (PHP ne gère pas automatiquement PUT comme POST)
    parse_str(file_get_contents("php://input"), $putData);
    $eventId = htmlspecialchars($putData['eventId'] ?? '');
    $eventName = htmlspecialchars($putData['eventName'] ?? '');
    $eventDescription = htmlspecialchars($putData['eventDescription'] ?? '');

    if (empty($eventId) || empty($eventName)) {
        $response[] = "L'ID et le nom de l'événement sont obligatoires pour la mise à jour.";
    } else {
        try {
            $stmt = $pdo->prepare("
                UPDATE events 
                SET event_name = :eventName, event_description = :eventDescription 
                WHERE id = :eventId
            ");
            $stmt->execute([
                ':eventName' => $eventName,
                ':eventDescription' => $eventDescription,
                ':eventId' => $eventId
            ]);

            $response[] = "Événement mis à jour avec succès.";
        } catch (PDOException $e) {
            $response[] = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
} elseif ($method === 'DELETE') {
    // **D - Delete (Supprimer)**

    // Récupérer les données du body (PHP ne gère pas automatiquement DELETE comme POST)
    parse_str(file_get_contents("php://input"), $deleteData);
    $eventId = htmlspecialchars($deleteData['eventId'] ?? '');

    if (empty($eventId)) {
        $response[] = "L'ID de l'événement est obligatoire pour la suppression.";
    } else {
        try {
            $stmt = $pdo->prepare("DELETE FROM events WHERE id = :eventId");
            $stmt->execute([':eventId' => $eventId]);

            $response[] = "Événement supprimé avec succès.";
        } catch (PDOException $e) {
            $response[] = "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
} else {
    $response[] = "Méthode non autorisée.";
}

// Afficher la réponse
echo implode('<br>', $response);
