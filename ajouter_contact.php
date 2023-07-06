<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un contact</title>
</head>

<body>
    <h1>Ajouter un contact</h1>
    <form action="traitement_ajout_contact.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" id="telephone" required>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>