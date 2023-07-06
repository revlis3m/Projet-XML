<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un groupe</title>
</head>

<body>
    <h1>Ajouter un groupe</h1>
    <form action="traitement_ajout_groupe.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="ids">IDs des contacts (séparés par des virgules) :</label>
        <input type="text" name="ids" id="ids" required>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>