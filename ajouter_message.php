<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un message</title>
</head>

<body>
    <h1>Ajouter un message</h1>
    <form action="traitement_ajout_message.php" method="post">
        <label for="messageType">Type de message :</label>
        <select name="messageType" id="messageType">
            <option value="text">Texte</option>
            <option value="audio">Audio</option>
            <option value="file">Fichier</option>
            <option value="link">Lien</option>
            <option value="localisation">Localisation</option>
            <option value="sondage">Sondage</option>
            <option value="contacte">Contact</option>
        </select>
        <input type="submit" value="Choisir">
    </form>
</body>

</html>