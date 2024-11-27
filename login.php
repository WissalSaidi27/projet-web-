<form method="POST" action="login.php">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
      background-color: #f4f4f9;
    }

    .container {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      color: white;
      cursor: pointer;
    }

    .signup-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
  </style>
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const loginForm = document.getElementById("loginForm");

      loginForm.addEventListener("submit", (event) => {
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        // Validation côté client
        if (!email) {
          alert("Le champ 'username' est obligatoire.");
          event.preventDefault();
        } else if (!password) {
          alert("Le champ 'Password' est obligatoire.");
          event.preventDefault();
        }
      });
    });
  </script>
</head>
<body>
  <div class="container">
    <h2>Login</h2>
    <form id="loginForm" method="POST" action="login.php">
      <div class="form-group">
        <label for="email">Username</label>
        <input type="text" id="email" name="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
      </div>
      <button type="submit">Login</button>
    </form>
    <div class="signup-link">
      <p>Don't have an account? <a href="signup.php" class="link-button">Sign Up</a></p>
    </div>
  </div>
</body>
</html>

<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données utilisateur
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validation côté serveur
    if (empty($email) || empty($password)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    // Rechercher l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id'];
        echo "Connexion réussie ! Bienvenue.";
    } else {
        // Échec de la connexion
        echo "Email ou mot de passe incorrect.";
    }
}
?>
<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    // Rechercher l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie - créer une session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['logged_in'] = true;

        // Rediriger vers la page d'accueil
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

