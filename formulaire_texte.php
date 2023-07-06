<!DOCTYPE html>
<html>

<head>
    <title>Formulaire - Message texte simple</title>
</head>

<body>
    <h1>Ajouter un message texte simple</h1>
    <form action="traitement_texte_simple.php" method="post">
        <label for="sender">ID de l'expéditeur :</label>
        <input type="text" name="sender" id="sender" required>
        <br>
        <label>
            <input type="radio" name="destinataire" value="contact" required> Contact
        </label>
        <label>
            <input type="radio" name="destinataire" value="group"> Groupe
        </label>
        <br>
        <label for="id">ID du destinataire :</label>
        <input type="text" name="id" id="id" required>
        <br>
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" rows="5" required></textarea>
        <br>
        <input type="submit" value="Ajouter">
    </form>
</body>

</html>