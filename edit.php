<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le Site Touristique</title>
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
            padding: 40px 20px;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            color: #4CAF50;  /* Couleur spécifique pour le titre */
        }

        /* Form Container */
        .form-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form Elements */
        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus, textarea:focus {
            border-color: #5c6bc0;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button[type="submit"] {
            background-color: #5c6bc0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #3f4f8d;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Modifier le Site Touristique</h1>
        <form method="post" action="index.php?controller=site&action=update&id=<?= $site['id'] ?>">
            <label>Nom : 
                <input type="text" name="nom" value="<?= htmlspecialchars($site['nom']) ?>" required>
            </label><br>

            <label>Description : 
                <textarea name="description" required><?= htmlspecialchars($site['description']) ?></textarea>
            </label><br>

            <label>Localisation : 
                <input type="text" name="localisation" value="<?= htmlspecialchars($site['localisation']) ?>" required>
            </label><br>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
