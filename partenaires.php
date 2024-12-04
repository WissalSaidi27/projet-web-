<?php
require_once '../../config.php'; // Inclure le fichier de configuration pour la connexion PDO

try {
    $db = Config::getConnexion(); // Utilisez votre méthode de connexion via PDO
    // Récupérer les partenaires
    $sql = "SELECT * FROM partenaire";
    $stmt = $db->query($sql); // Prépare et exécute la requête
    $partenaires = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les partenaires
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage()); // Affiche l'erreur en cas d'échec
}
?>
<?php
require_once '../../controllers/contratControlleur.php';
$controller = new ContratController();
$contrats = $controller->getAllContrats(); // Pas d'erreur ici si $this->pdo est bien initialisé
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Gestion des Partenaires</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Filtrer et Rechercher</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Liens Bootstrap CSS et JS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- À placer dans le head -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



    <style>
             
        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin: 20px;
        }
        .icon-btn {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .icon-btn:hover {
            background-color: #e0e0e0;
        }
        .icon-btn i {
            margin-right: 5px;
        }
        .search-input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }
        .partner-list {
            margin-top: 20px;
            
        }
        .partner-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        .action-buttons .btn {
            margin: 0 5px;
            
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.9em;
        }
    
    </style>
    
    
    
</head>

<body>
    
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">Creative Tim</a>
            </div>
            <ul class="nav">
                
                <li class="active"><a href="partenaires.php"><i class="pe-7s-users"></i><p>Partenaires</p></a></li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Gestion des Partenaires</a>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <!-- Section Partenaire -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Partenaires</h4>
                                <p class="category">Liste des partenaires existants</p>
                            </div>
                            <div class="content table-responsive">
                            <div class="actions">
        <!-- Barre de recherche -->
        <input type="text" id="search" class="search-input" placeholder="Rechercher un partenaire...">
        <div id="filter" class="icon-btn">
            <i class="fas fa-filter"></i>
            <span>Filtrer</span>
        </div>
    </div>

    <!-- Liste des partenaires -->
    <div class="partner-list" id="partnerList">
        <?php foreach ($partenaires as $partner): ?>
            <div class="partner-item" data-name="<?= htmlspecialchars($partner['nom']) ?>">
                <strong><?= htmlspecialchars($partner['nom']) ?></strong> - <?= htmlspecialchars($partner['email']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const partnerList = document.getElementById('partnerList');
            const filterButton = document.getElementById('filter');

            // Fonction de recherche
            searchInput.addEventListener('input', function () {
                const query = searchInput.value.toLowerCase();
                const partners = partnerList.querySelectorAll('.partner-item');

                partners.forEach(partner => {
                    const name = partner.getAttribute('data-name').toLowerCase();
                    if (name.includes(query)) {
                        partner.style.display = ''; // Affiche l'élément
                    } else {
                        partner.style.display = 'none'; // Cache l'élément
                    }
                });
            });

            // Exemple de fonction de filtrage
            filterButton.addEventListener('click', function () {
                alert('Fonctionnalité de filtre à implémenter selon vos besoins!');
            });
        });
       
    </script>
    
                                <table class="table table-hover">
                                    <thead>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Adresse</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody id="partnerTable">
                                       <?php
                                        include "../../controllers/partenaireControlleur.php";
                                        $controller = new partenaireController();
                                        $partenaires = $controller->getAllPartenaires(); // Méthode pour récupérer les partenaires
                                    ?>
                                    <?php foreach ($partenaires as $partner): ?>
        <tr data-id="<?= $partner['id_part']; ?>">
            <td><?= $partner['id_part']; ?></td>
            <td><?= $partner['nom']; ?></td>
            <td><?= $partner['email']; ?></td>
            <td><?= $partner['adr']; ?></td>
            <td>
            <button class="btn btn-info btn-sm edit-partner" 
            data-id="<?= $partner['id_part']; ?>" 
            data-nom="<?= $partner['nom']; ?>" 
            data-email="<?= $partner['email']; ?>" 
            data-adr="<?= $partner['adr']; ?>">
    Modifier
</button>

<button class="btn btn-danger btn-sm delete-partner" data-id="<?= $partner['id_part']; ?>">
    Supprimer
</button>

            </td>
        </tr>
    <?php endforeach; ?>
    

  

                                       
   
   
</tbody>

                                   
                                    
                                </table>
                                <button class="btn btn-success" data-toggle="modal" data-target="#partnerModal">Ajouter un Partenaire</button>

                            </div>
                        </div>
                    </div>
                </div>

                

        <!-- Modals -->
        <!-- Partenaire Modal -->
       <!-- Modal Ajouter un Partenaire -->
<div class="modal fade" id="partnerModal" tabindex="-1" role="dialog" aria-labelledby="partnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <button id="openModalButton" class="btn btn-success">Ajouter un Partenaire</button>

                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="partnerForm" method="POST" action="manage.php">
                <input type="hidden" name="action" value="add">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="partnerName">Nom</label>
                        <input type="text" class="form-control" id="partnerName" name="nom" placeholder="Nom du partenaire" required>
                    </div>
                    <div class="form-group">
                        <label for="partnerEmail">Email</label>
                        <input type="email" class="form-control" id="partnerEmail" name="email" placeholder="Email du partenaire" required>
                    </div>
                    <div class="form-group">
                        <label for="partnerAddress">Adresse</label>
                        <input type="text" class="form-control" id="partnerAddress" name="adr" placeholder="Adresse du partenaire" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

       
<!-- Modal EDIT-->
<div class="modal fade" id="editPartnerModal" tabindex="-1" aria-labelledby="editPartnerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editPartnerForm" method="POST">
                <input type="hidden" id="editPartnerId" name="id_part">
                <div class="modal-header">
                <button class="edit-partner" data-id="1" data-nom="Partenaire1" data-email="email@exemple.com" data-adr="Adresse1">Modifier</button>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editPartnerName">Nom</label>
                        <input type="text" class="form-control" id="editPartnerName" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="editPartnerEmail">Email</label>
                        <input type="email" class="form-control" id="editPartnerEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editPartnerAddress">Adresse</label>
                        <input type="text" class="form-control" id="editPartnerAddress" name="adr" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Liste des contrats du partenaire -->
<div class="container mt-4">
        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestion des Contrats</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContratModal">
                <i class="fas fa-plus"></i> Nouveau Contrat
            </button>
        </div>

        <!-- Tableau des Contrats -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Partenaire</th>
                        <th>Type</th>
                        <th>Durée</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../controllers/contratControlleur.php';
                    $controller = new ContratController();
                    $contrats = $controller->getAllContrats();
                    foreach($contrats as $contrat) {
                        // Calculer le statut
                        $today = new DateTime();
                        $dateDebut = new DateTime($contrat['date_debut']);
                        $dateFin = new DateTime($contrat['date_fin']);
                        
                        if ($today < $dateDebut) {
                            $status = '<span class="status-badge bg-warning text-dark">À venir</span>';
                        } elseif ($today > $dateFin) {
                            $status = '<span class="status-badge bg-danger text-white">Expiré</span>';
                        } else {
                            $status = '<span class="status-badge bg-success text-white">Actif</span>';
                        }

                        echo "<tr>
                                <td>".$contrat['id_c']."</td>
                                <td>".$contrat['id_part']."</td>
                                <td>".$contrat['type_c']."</td>
                                <td>".$contrat['duree']."</td>
                                <td>".date('d/m/Y', strtotime($contrat['date_debut']))."</td>
                                <td>".date('d/m/Y', strtotime($contrat['date_fin']))."</td>
                                <td>".$status."</td>
                                <td class='action-buttons'>
                                    <button class='btn btn-sm btn-warning' onclick='editContrat(".$contrat['id_c'].")'><i class='fas fa-edit'></i></button>
                                    <button class='btn btn-sm btn-danger' onclick='deleteContrat(".$contrat['id_c'].")'><i class='fas fa-trash'></i></button>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Ajout/Modification Contrat -->
    <div class="modal fade" id="addContratModal" tabindex="-1" aria-labelledby="addContratModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContratModal">
    <i class="fas fa-plus"></i> Nouveau Contrat
</button>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="manageContrat.php" method="POST">
                <input type="hidden" name="action" value="create">
                    <div class="modal-body">
                        <input type="hidden" name="id_c" value="contrat_id">
                        <div class="mb-3">
                            <label for="id_part">Partenaire</label>
                            <select name="id_part" class="form-select">
                                <?php 
                                    $partenaires = $controller->getPartenaires();
                                    foreach($partenaires as $partenaire) {
                                        echo "<option value='".$partenaire['id_part']."'>".$partenaire['nom']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Type de Contrat</label>
                            <select name="type_c" class="form-select" >
                                <option value="Standard">Standard</option>
                                <option value="Premium">Premium</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="duree">Durée</label>
                            <input type="text" name="duree" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="date_debut">Date de début</label>
                            <input type="date" name="date_debut" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="date_fin">Date de fin</label>
                            <input type="date" name="date_fin" class="form-control" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <<button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="assets/js/jquery.3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
<script src="assets/js/demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
    // ADD PARTENAIRES
    document.addEventListener('DOMContentLoaded', function () {
    // Ouvrir le modal lorsqu'on clique sur le bouton
    const openModalButton = document.getElementById('openModalButton');
    
    openModalButton.addEventListener('click', function () {
        // Utilisation de Bootstrap pour ouvrir le modal
        $('#partnerModal').modal('show');
    });
});

    //delete partenaires
    document.querySelectorAll('.delete-partner').forEach(button => {
    button.addEventListener('click', function () {
        const partnerId = this.getAttribute('data-id');

        if (confirm('Voulez-vous vraiment supprimer ce partenaire ?')) {
            fetch('manage.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `action=delete&id_part=${partnerId}`
            })
                .then(response => response.text()) // Utilise `text()` ici aussi
                .then(data => {
                    alert(data);
                    this.closest('tr').remove(); // Supprime la ligne du tableau
                })
                .catch(error => console.error('Erreur :', error));
        }
    });
});


//modifier partenaire
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les boutons "Modifier" pour le partenaire
    const editButtons = document.querySelectorAll('.edit-partner');

    // Ajouter un événement à chaque bouton de modification
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer les données à partir des attributs data-* du bouton
            const partnerId = this.getAttribute('data-id');
            const partnerName = this.getAttribute('data-nom');
            const partnerEmail = this.getAttribute('data-email');
            const partnerAddress = this.getAttribute('data-adr');

            // Remplir les champs du modal avec ces données
            document.getElementById('editPartnerId').value = partnerId;
            document.getElementById('editPartnerName').value = partnerName;
            document.getElementById('editPartnerEmail').value = partnerEmail;
            document.getElementById('editPartnerAddress').value = partnerAddress;
        });
    });

    // Ajouter l'événement de soumission du formulaire
    document.getElementById('editPartnerForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêche l'envoi immédiat du formulaire

        // Récupérer les valeurs du formulaire
        const id = document.getElementById('editPartnerId').value;
        const name = document.getElementById('editPartnerName').value;
        const email = document.getElementById('editPartnerEmail').value;
        const address = document.getElementById('editPartnerAddress').value;

        // Créez un objet avec les données du formulaire
        const formData = new FormData();
        formData.append('id_part', id);
        formData.append('nom', name);
        formData.append('email', email);
        formData.append('adr', address);

        // Envoi de la requête AJAX pour mettre à jour les données (vous pouvez utiliser fetch ou jQuery pour l'ajax)
        fetch('/votre-endpoint-de-modification', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Traitez la réponse du serveur
            if (data.success) {
                // Fermer le modal
                const myModal = new bootstrap.Modal(document.getElementById('editPartnerModal'));
                myModal.hide();

                // Rafraîchir ou mettre à jour la page (par exemple, recharger la liste des partenaires)
                alert('Partenaire mis à jour avec succès!');
            } else {
                alert('Erreur lors de la mise à jour');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de réseau ou serveur');
        });
    });
});


//contrat
$(document).ready(function() {
    loadContracts(); // Charge les contrats au démarrage

    $('#contractForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'contratController.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    $('#contractModal').modal('hide');
                    $('#contractForm')[0].reset();
                    loadContracts(); // Recharge la liste après ajout
                    alert('Contrat ajouté avec succès');
                } else {
                    alert('Erreur lors de l\'ajout du contrat');
                }
            },
            error: function() {
                alert('Erreur de communication avec le serveur');
            }
        });
    });
});

// Fonction de suppression
function deleteContrat(id) {
    if(confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')) {
        $.ajax({
            url: 'contratController.php',
            type: 'POST',
            data: {
                action: 'delete',
                id_c: id
            },
            dataType: 'json',
            success: function(response) {
                if(response.success) {
                    loadContracts(); // Recharge la liste après suppression
                    alert('Contrat supprimé avec succès');
                } else {
                    alert('Erreur lors de la suppression');
                }
            },
            error: function() {
                alert('Erreur de communication avec le serveur');
            }
        });
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Sélectionner le formulaire
    const submitButton = form.querySelector('button[type="submit"]'); // Sélectionner le bouton de soumission

    submitButton.addEventListener('click', function (event) {
        // Empêcher la soumission par défaut du formulaire
        event.preventDefault();

        // Récupérer les valeurs des champs
        const idPart = form.querySelector('select[name="id_part"]').value;
        const typeContrat = form.querySelector('select[name="type_c"]').value;
        const duree = form.querySelector('input[name="duree"]').value;
        const dateDebut = form.querySelector('input[name="date_debut"]').value;
        const dateFin = form.querySelector('input[name="date_fin"]').value;

        // Initialiser un tableau d'erreurs
        let errors = [];

        // Vérifier que tous les champs sont remplis
        if (!idPart) {
            errors.push("Le champ 'Partenaire' est obligatoire.");
        }
        if (!duree) {
            errors.push("Le champ 'Durée' est obligatoire.");
        }
        if (!dateDebut) {
            errors.push("Le champ 'Date de début' est obligatoire.");
        }
        if (!dateFin) {
            errors.push("Le champ 'Date de fin' est obligatoire.");
        }

        // Vérification que la date de début est avant la date de fin
        if (dateDebut && dateFin && new Date(dateDebut) >= new Date(dateFin)) {
            errors.push("La 'Date de début' doit être avant la 'Date de fin'.");
        }

        // Si des erreurs existent, les afficher et ne pas soumettre le formulaire
        if (errors.length > 0) {
            alert(errors.join('\n')); // Afficher les erreurs
        } else {
            form.submit(); // Si tout est valide, soumettre le formulaire
        }
    });
});





/*function editContrat(id) {
            // Charger les données du contrat et ouvrir le modal
            fetch(`contrats.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.querySelector('[name="id_part"]').value = data.id_part;
                    document.querySelector('[name="type_c"]').value = data.type_c;
                    document.querySelector('[name="duree"]').value = data.duree;
                    document.querySelector('[name="date_debut"]').value = data.date_debut;
                    document.querySelector('[name="date_fin"]').value = data.date_fin;
                    
                    document.querySelector('[name="action"]').value = 'update';
                    const modal = new bootstrap.Modal(document.getElementById('addContratModal'));
                    modal.show();
                });
        }

        /*function deleteContrat(id) {
    if(confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')) {
        // Créer un formulaire dynamique pour la suppression
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'manageContrat.php';  // L'action qui gère la suppression
        
        // Créer un champ caché pour l'action
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = 'delete';  // Spécifie l'action 'delete'
        
        // Créer un champ caché pour l'ID du contrat à supprimer
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id_c';
        idInput.value = id;  // L'ID du contrat à supprimer
        
        // Ajouter les champs au formulaire
        form.appendChild(actionInput);
        form.appendChild(idInput);
        
        // Ajouter le formulaire à la page
        document.body.appendChild(form);
        
        // Soumettre le formulaire
        form.submit();
        
        // Supprimer le formulaire après soumission pour garder le DOM propre
        document.body.removeChild(form);
    }
}


        function viewContrat(id) {
            // Implémenter la vue détaillée du contrat
            window.location.href = `viewContrat.php?id=${id}`;
        }*/



</script>

</body>
</html>
