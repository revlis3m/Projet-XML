<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un message - Lien</title>
</head>

<body>
    <h1>Ajouter un message - Lien</h1>
    <form action="traitement_ajout_lien.php" method="post">
        <label for="expediteur">Expéditeur :</label>
        <input type="text" name="expediteur" id="expediteur" required>

        <label for="destinataire">Destinataire :</label>
        <input type="radio" name="destinataire" value="contact" checked> Contact
        <input type="radio" name="destinataire" value="group"> Groupe

        <label for="receveur">Récepteur :</label>
        <input type="text" name="receveur" id="receveur" required>

        <label for="lien">Lien :</label>
        <input type="text" name="lien" id="lien" required>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>