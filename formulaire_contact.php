<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un message - Contact</title>
</head>

<body>
    <h1>Ajouter un message - Contact</h1>
    <form action="traitement_ajout_contacte.php" method="post">
        <label for="expediteur">Expéditeur :</label>
        <input type="text" name="expediteur" id="expediteur" required>

        <label for="destinataire">Destinataire :</label>
        <input type="radio" name="destinataire" value="contact" checked> Contact
        <input type="radio" name="destinataire" value="group"> Groupe

        <label for="receveur">Récepteur :</label>
        <input type="text" name="receveur" id="receveur" required>

        <label for="nom_contact">Nom du contact :</label>
        <input type="text" name="nom_contact" id="nom_contact" required>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>