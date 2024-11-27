<?php
session_start();
require 'connect.php';

// Récupérer les utilisateurs pour l'affichage
$stmt = $pdo->query("SELECT id, email, nom, prenom FROM user");
$user = $stmt->fetchAll();

// Traitement de l'action d'insertion (création d'utilisateur)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');

    // Validation côté PHP
    if (empty($email) || empty($password) || empty($confirm_password) || empty($nom) || empty($prenom)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }
    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Hasher le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO user (email, password, nom, prenom) VALUES (?, ?, ?, ?)");
    $stmt->execute([$email, $hashed_password, $nom, $prenom]);
    echo "Utilisateur créé avec succès.";
}

// Traitement de l'action de suppression
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo "Utilisateur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression.";
    }
}

// Traitement de l'action de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update') {
    $id = $_POST['id'];
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    if (empty($email) || empty($nom) || empty($prenom)) {
        echo "L'email, le nom et le prénom sont obligatoires.";
        exit;
    }

    $query = "UPDATE user SET email = ?, nom = ?, prenom = ?";
    $params = [$email, $nom, $prenom];

    if ($hashed_password) {
        $query .= ", password = ?";
        $params[] = $hashed_password;
    }

    $query .= " WHERE id = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($query);
    if ($stmt->execute($params)) {
        echo "Utilisateur modifié avec succès.";
    } else {
        echo "Erreur lors de la modification.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs</title>
    <style>
        /* Style de base */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-size: 14px;
            color: #555;
        }
        input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        .link-button {
            text-decoration: none;
            color: #007BFF;
        }
        .link-button:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Formulaire de création d'utilisateur -->
    <div class="container">
        <h2>Créer un utilisateur</h2>
        <form method="POST">
            <input type="hidden" name="action" value="create">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer le mot de passe">
            </div>
            <button type="submit">Créer un compte</button>
        </form>
    </div>

    <!-- Liste des utilisateurs -->
    <div class="container">
        <h2>Liste des utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['nom']); ?></td>
                        <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?php echo $user['id']; ?>" class="link-button">Modifier</a> |
                            <a href="index.php?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr ?');" class="link-button">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Formulaire de modification d'utilisateur -->
    <?php if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])): ?>
        <?php
        $id = $_GET['id'];
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        ?>
        <div class="container">
            <h2>Modifier l'utilisateur</h2>
            <form method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" placeholder="Nouveau mot de passe">
                </div>
                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    <?php endif; ?>
    <?php>


</body>
</html>
