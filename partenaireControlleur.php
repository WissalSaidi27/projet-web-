<?php
require_once '../../config.php';

class PartenaireController {
    private $conn;

    public function __construct() {
        $this->conn = Config::getConnexion();
    }

    // Récupérer tous les partenaires
    public function getAllPartenaires() {
        $query = "SELECT * FROM partenaire ORDER BY nom";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupérer un partenaire par ID
    public function getPartenaireById($id) {
        $query = "SELECT * FROM partenaire WHERE id_part = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Ajouter un nouveau partenaire
    public function createPartenaire($data) {
        $query = "INSERT INTO partenaire (nom, adresse, telephone, email) 
                  VALUES (:nom, :adresse, :telephone, :email)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Mettre à jour un partenaire existant
    public function updatePartenaire($data) {
        $query = "UPDATE partenaire 
                  SET nom = :nom, adresse = :adresse, telephone = :telephone, email = :email 
                  WHERE id_part = :id_part";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Supprimer un partenaire
    public function deletePartenaire($id) {
        $query = "DELETE FROM partenaire WHERE id_part = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
?>
