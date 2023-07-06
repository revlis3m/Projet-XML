<!DOCTYPE html>
<html>

<head>
    <title>Ajouter des membres</title>
</head>

<body>
    <h1>Ajouter des membres</h1>
    <form action="traitement_ajout_membre.php" method="post">
        <label for="groupe_id">ID du groupe :</label>
        <input type="text" name="groupe_id" id="groupe_id" value="<?php echo $_GET['id']; ?>" readonly>

        <label for="nouveaux_membres">Nouveaux membres (séparés par des virgules) :</label>
        <input type="text" name="nouveaux_membres" id="nouveaux_membres" required>

        <input type="submit" value="Ajouter">
    </form>
</body>

</html>