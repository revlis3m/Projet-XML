<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un message - Fichier</title>
</head>

<body>
    <h1>Ajouter un message - Fichier</h1>
    <form action="traitement_ajout_fichier.php" method="post">
        <label for="expediteur">Expéditeur :</label>
        <input type="text" name="expediteur" id="expediteur" required>
        <br />
        <label for="destinataire">Destinataire :</label>
        <input type="radio" name="destinataire" value="contact" checked> Contact
        <input type="radio" name="destinataire" value="group"> Groupe
        <br />
        <label for="receveur">Récepteur :</label>
        <input type="text" name="receveur" id="receveur" required>
        <br />
        <label for="nom_fichier">Nom du fichier :</label>
        <input type="text" name="nom_fichier" id="nom_fichier" required>
        <br />
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea>
        <br />
        <input type="submit" value="Ajouter">
        <br />
    </form>
</body>

</html>