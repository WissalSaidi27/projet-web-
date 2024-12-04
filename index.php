<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Sites Touristiques</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fb;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Header */
        h1 {
            font-size: 2.5em;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Links */
        a {
            color: #5c6bc0;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Table Styles */
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5c6bc0;
            color: white;
            font-weight: 600;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        .btn {
            background-color: #5c6bc0;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #3f4f8d;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions a {
            background-color: #ff9800;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .actions a:hover {
            background-color: #f57c00;
        }

        /* Footer Button */
        .add-site-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #5c6bc0;
            color: white;
            font-size: 1.2em;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .add-site-btn:hover {
            background-color: #3f4f8d;
        }

        /* Media Queries for responsiveness */
        @media (max-width: 768px) {
            table th, table td {
                font-size: 0.9em;
                padding: 12px;
            }

            .actions a {
                font-size: 0.9em;
            }

            .add-site-btn {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <h1>Liste des Sites Touristiques</h1>
    <a href="index.php?controller=site&action=create" class="add-site-btn">Ajouter un nouveau site touristique</a>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Localisation</th>
                <th>Actions</th>
                <th>Avis</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sites as $site): ?>
            <tr>
                <td><?php echo $site['nom']; ?></td>
                <td><?php echo $site['description']; ?></td>
                <td><?php echo $site['localisation']; ?></td>
                <td>
                    <div class="actions">
                        <a href="index.php?controller=site&action=edit&id=<?php echo $site['id']; ?>">Modifier</a>
                        <a href="index.php?controller=site&action=destroy&id=<?php echo $site['id']; ?>">Supprimer</a>
                    </div>
                </td>
                <td>
                    <!-- Affichage du nombre d'avis pour chaque site -->
                    <?php echo $site['nb_avis'] > 0 ? $site['nb_avis'] . " Avis" : "Aucun avis"; ?>
                    <a href="index.php?controller=avis&action=index&site_id=<?php echo $site['id']; ?>">Voir les avis</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
