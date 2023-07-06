<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un message audio</title>
</head>

<body>
    <h1>Ajouter un message audio</h1>
    <form action="traitement_ajout_audio.php" method="post">
        <label for="expediteur">Expéditeur :</label>
        <input type="text" name="expediteur" id="expediteur" required>
        <br />

        <label for="destinataire">Destinataire :</label>
        <input type="radio" name="destinataire" value="contact" checked> Contact
        <input type="radio" name="destinataire" value="group"> Groupe
        <br />

        <label for="receveur">ID destinataire :</label>
        <input type="text" name="receveur" id="receveur" required>
        <br />

        <label for="nom_audio">Nom de l'audio :</label>
        <input type="text" name="nom_audio" id="nom_audio" required>
        <br />

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" rows="4" required></textarea>
        <br />
        
        <input type="submit" value="Ajouter">
    </form>
</body>

</html>