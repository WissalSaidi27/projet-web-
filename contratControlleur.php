<?php
require_once '../../config.php';

class ContratController {
    private $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function getAllContrats() {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT c.*, p.nom as partenaire_nom 
                 FROM contrat c 
                 JOIN partenaire p ON c.id_part = p.id_part 
                 ORDER BY c.id_c DESC"
            );
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllContrats: " . $e->getMessage());
            return [];
        }
    }

    public function getPartenaires() {
        try {
            $stmt = $this->pdo->prepare("SELECT id_part, nom FROM partenaire ORDER BY nom");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getPartenaires: " . $e->getMessage());
            return [];
        }
    }

    public function getContratById($id) {
        try {
            $stmt = $this->pdo->prepare(
                "SELECT c.*, p.nom as partenaire_nom 
                 FROM contrat c 
                 JOIN partenaire p ON c.id_part = p.id_part 
                 WHERE c.id_c = :id"
            );
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getContratById: " . $e->getMessage());
            return null;
        }
    }

    public function createContrat($data) {
        try {
            $stmt = $this->pdo->prepare(
                "INSERT INTO contrat (id_part, type_c, duree, date_debut, date_fin) 
                 VALUES (:id_part, :type_c, :duree, :date_debut, :date_fin)"
            );
            
            return $stmt->execute([
                ':id_part' => $data['id_part'],
                ':type_c' => $data['type_c'],
                ':duree' => $data['duree'],
                ':date_debut' => $data['date_debut'],
                ':date_fin' => $data['date_fin']
            ]);
        } catch (PDOException $e) {
            error_log("Erreur createContrat: " . $e->getMessage());
            return false;
        }
    }

    public function deleteContrat($id_c) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM contrat WHERE id_c = :id_c");
            return $stmt->execute([':id_c' => $id_c]);
        } catch (PDOException $e) {
            error_log("Erreur deleteContrat: " . $e->getMessage());
            return false;
        }
    }

    public function updateContrat($data) {
        try {
            $stmt = $this->pdo->prepare(
                "UPDATE contrat 
                 SET id_part = :id_part, 
                     type_c = :type_c, 
                     duree = :duree, 
                     date_debut = :date_debut, 
                     date_fin = :date_fin 
                 WHERE id_c = :id_c"
            );
            
            return $stmt->execute([
                ':id_part' => $data['id_part'],
                ':type_c' => $data['type_c'],
                ':duree' => $data['duree'],
                ':date_debut' => $data['date_debut'],
                ':date_fin' => $data['date_fin'],
                ':id_c' => $data['id_c']
            ]);
        } catch (PDOException $e) {
            error_log("Erreur updateContrat: " . $e->getMessage());
            return false;
        }
    }
}