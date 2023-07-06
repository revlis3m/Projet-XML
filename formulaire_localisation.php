<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un message de localisation</title>
</head>

<body>
    <h1>Ajouter un message de localisation</h1>
    <form action="traitement_localisation.php" method="post">
        <label for="expediteur">Expéditeur :</label>
        <input type="text" name="expediteur" id="expediteur" required>
        <br />
        <label for="destinataire">Destinataire :</label>
        <input type="radio" name="destinataire" id="contact" value="contact" checked>
        <label for="contact">Contact</label>
        <input type="radio" name="destinataire" id="group" value="group">
        <label for="group">Groupe</label>
        <br />
        <label for="receveur">Récepteur :</label>
        <input type="text" name="receveur" id="receveur" required>
        <br />
        <label for="latitude">Latitude :</label>
        <input type="text" name="latitude" id="latitude" required>
        <br />
        <label for="longitude">Longitude :</label>
        <input type="text" name="longitude" id="longitude" required>
        <br />
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea>
        <br />
        <input type="submit" value="Ajouter">
        <br />
    </form>
</body>

</html>