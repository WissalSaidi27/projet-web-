<?php
require_once 'config.php';

class SiteTouristique
{
    // Récupérer tous les sites touristiques avec leurs avis associés
    public static function getAll()
    {
        global $db;
        // Jointure entre sites_touristiques et avis_visiteurs
        $query = $db->query('
            SELECT s.id, s.nom, s.description, s.localisation, COUNT(a.id) AS nb_avis
            FROM sites_touristiques s
            LEFT JOIN avis_visiteurs a ON s.id = a.site_touristique_id
            GROUP BY s.id
        ');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un site touristique par son ID avec ses avis associés
    public static function findById($id)
    {
        global $db;
        $query = $db->prepare('SELECT * FROM sites_touristiques WHERE id = :id');
        $query->execute(['id' => $id]);
    
        // Vérifiez si la requête retourne un résultat
        $site = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($site) {
            return $site; // Retourne le site si trouvé
        } else {
            // Si le site n'est pas trouvé, retourner false et afficher un message d'erreur
            return false;
        }
    }
    

    // Ajouter un nouveau site touristique
    public static function create($data)
    {
        global $db;
        $query = $db->prepare('INSERT INTO sites_touristiques (nom, description, localisation) VALUES (:nom, :description, :localisation)');
        $query->execute([
            'nom' => $data['nom'],
            'description' => $data['description'],
            'localisation' => $data['localisation'],
        ]);
    }

    // Mettre à jour un site touristique
    public static function update($id, $data)
    {
        global $db;
        $query = $db->prepare('UPDATE sites_touristiques SET nom = :nom, description = :description, localisation = :localisation WHERE id = :id');
        $query->execute([
            'nom' => $data['nom'],
            'description' => $data['description'],
            'localisation' => $data['localisation'],
            'id' => $id,
        ]);
    }

    // Supprimer un site touristique
    public static function delete($id)
    {
        global $db;
        $query = $db->prepare('DELETE FROM sites_touristiques WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}
