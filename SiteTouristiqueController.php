<?php
require_once 'models/SiteTouristique.php';

class SiteTouristiqueController
{
    public function index()
    {
        $sites = SiteTouristique::getAll();
        include 'views/sites_touristiques/index.php';
    }

    public function create()
    {
        include 'views/sites_touristiques/create.php';
    }

    public function store()
    {
        if (!empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['localisation'])) {
            SiteTouristique::create($_POST);
            header('Location: index.php?controller=site&action=index');
        } else {
            echo "Tous les champs sont obligatoires !";
        }
    }

    public function edit($id)
    {
        $site = SiteTouristique::findById($id);
        if ($site) {
            include 'views/sites_touristiques/edit.php';
        } else {
            echo "Site touristique introuvable.";
        }
    }

    public function update($id)
    {
        if (!empty($_POST['nom']) && !empty($_POST['description']) && !empty($_POST['localisation'])) {
            SiteTouristique::update($id, $_POST);
            header('Location: index.php?controller=site&action=index');
        } else {
            echo "Tous les champs sont obligatoires pour la mise à jour !";
        }
    }

    public function destroy($id)
    {
        if (SiteTouristique::findById($id)) {
            SiteTouristique::delete($id);
            header('Location: index.php?controller=site&action=index');
        } else {
            echo "Impossible de supprimer, site touristique introuvable.";
        }
    }
}
