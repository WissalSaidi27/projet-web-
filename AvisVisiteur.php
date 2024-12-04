<?php
require_once 'config.php';

class AvisVisiteur
{
   
    public static function getBySiteId($siteId) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM avis_visiteurs WHERE site_touristique_id = ?");
        $stmt->execute([$siteId]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);  // Assurez-vous de ne récupérer que les avis
    }
    


    // Récupérer un avis par son ID
    public static function findById($id)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM avis_visiteurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);  // Retourne un seul avis ou false si non trouvé
    }

    // Autres méthodes comme create, update, delete, etc.



    // Ajouter un nouvel avis
    public static function create($siteId, $data)
    {
        global $db;
        $stmt = $db->prepare("INSERT INTO avis_visiteurs (texte, auteur, site_touristique_id) VALUES (?, ?, ?)");
        return $stmt->execute([$data['texte'], $data['auteur'], $siteId]);
    }

    // Modifier un avis
    public static function update($id, $data)
    {
        global $db;
        $stmt = $db->prepare("UPDATE avis_visiteurs SET texte = ?, auteur = ? WHERE id = ?");
        return $stmt->execute([$data['texte'], $data['auteur'], $id]);
    }

    // Supprimer un avis
    public static function delete($id)
    {
        global $db;
        $stmt = $db->prepare("DELETE FROM avis_visiteurs WHERE id = ?");
        return $stmt->execute([$id]);
    }
    


    // Récupérer un avis par son ID
    public static function getById($id)
    {
        global $db;
        $stmt = $db->prepare("SELECT * FROM avis_visiteurs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

