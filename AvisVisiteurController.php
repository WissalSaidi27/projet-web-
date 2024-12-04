<?php
require_once 'models/AvisVisiteur.php';
require_once 'models/SiteTouristique.php';  // Ajouté pour la gestion des sites
require_once 'templates/header.php'; 

class AvisVisiteurController
{
    public function index()
    {
        // Vérifie si le paramètre site_id est présent dans l'URL
        if (isset($_GET['site_id'])) {
            // Récupère les avis pour le site touristique spécifié
            $avis = AvisVisiteur::getBySiteId($_GET['site_id']);
            include 'views/avis_visiteurs/index.php';  // Inclut la vue pour afficher les avis
        } else {
            // Si le site_id est absent, affiche un message d'erreur
            echo "Site ID non spécifié.";
        }
    }

    public function create()
    {
        if (isset($_GET['site_id'])) {
            $siteId = $_GET['site_id'];

            // Récupérer les informations du site
            $site = SiteTouristique::findById($siteId);

            // Déboguer l'objet $site pour voir si les données sont bien récupérées
            if ($site) {
                include 'views/avis_visiteurs/create.php';
            } else {
                echo "Site avec l'ID $siteId introuvable.";
            }
        } else {
            echo "Le paramètre 'site_id' est manquant dans l'URL.";
        }
    }

    public function store()
    {
        // Logic to save the new review
        if (!empty($_POST['texte']) && !empty($_POST['auteur']) && isset($_POST['site_id'])) {
            AvisVisiteur::create($_POST['site_id'], $_POST);
            header('Location: index.php?controller=avis&action=index&site_id=' . $_POST['site_id']);
        } else {
            echo "Tous les champs sont obligatoires !";
        }
    }

    public function edit($id)
    {
        // Logic to edit an existing review
        $avis = AvisVisiteur::getById($id);
        if ($avis) {
            include 'views/avis_visiteurs/edit.php';
        } else {
            echo "Avis introuvable.";
        }
    }

    public function update($id)
    {
        // Vérifiez si l'ID existe dans la base de données
        $avis = AvisVisiteur::getById($id);

        if ($avis) {
            // On met à jour seulement l'avis spécifique avec l'ID donné
            AvisVisiteur::update($id, $_POST);
            header("Location: index.php?controller=avis&action=index&site_id=" . $_POST['site_touristique_id']);
        } else {
            echo "Avis introuvable.";
        }
    }

    public function destroy($id)
    {
        // Utiliser getById() ou une méthode similaire pour récupérer l'avis
        $avis = AvisVisiteur::getById($id);

        if ($avis) {
            // Si l'avis existe, on le supprime
            AvisVisiteur::delete($id);
            // On redirige vers la liste des avis pour ce site
            header("Location: index.php?controller=avis&action=index&site_id=" . $avis->site_touristique_id);
        } else {
            // Si l'avis n'est pas trouvé, on affiche un message
            echo "Avis introuvable.";
        }
    }
}
