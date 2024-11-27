<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation d'Événements avec Hawes</title>
    <script src="https://cdn.tiny.cloud/1/f2fibicddey0hqx0ibu3ise8st470znlc6hsgp03bttg2ggo/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    

    <header>
        <h1>Réservez Votre Événement Avec Hawes</h1>
        <p>Publiez et réservez des événements pour les agences, hôtels, et discothèques</p>
    </header>

    <div class="container">
        <h2>Publier un Nouvel Événement</h2>
        <form id="eventForm" action="insert_event.php" enctype="multipart/form-data" method="post">
            <label for="eventName">Nom de l'Événement</label>
            <input type="text" id="eventName" name="eventName" required>
        
            <label for="eventDescription">Description de l'Événement</label>
            <textarea id="eventDescription" name="eventDescription"></textarea>
        
            <label for="eventDate">Date de l'Événement</label>
            <input type="date" id="eventDate" name="eventDate" required>
        
            
            <label for="eventMedia">Ajouter une image ou un fichier publicitaire</label>
            <input type="file" id="eventMedia" name="eventMedia[]" accept="image/*,video/*" multiple>
        
            <button type="submit">Publier l'Événement</button>
        </form>
        
        

        <div class="event-list">
            <h2>Événements Publies</h2>
            <div id="events"></div>
        </div>
    </div>


</body>

</html>
