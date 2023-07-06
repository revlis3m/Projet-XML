<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un sondage</title>
</head>

<body>
    <h1>Ajouter un sondage</h1>
    <form action="traitement_sondage.php" method="post">
        <label for="expediteur">Expéditeur :</label>
        <input type="text" name="expediteur" id="expediteur" required>
        <br/>
        <label>Type de destinataire :</label>
        <input type="radio" name="destinataire" id="contact" value="contact" checked>
        <label for="contact">Contact</label>
        <input type="radio" name="destinataire" id="group" value="group">
        <label for="group">Groupe</label>
        <br/>
        <label for="receveur">Destinataire :</label>
        <input type="text" name="receveur" id="receveur" required>
        <br/>
        <label for="question">Question :</label>
        <input type="text" name="question" id="question" required>
        <br/>
        <label for="choix">Choix :</label>
        <ul id="choix-list">
            <li>
                <input type="text" name="choix[]" required>
                <button type="button" onclick="ajouterChoix()">Ajouter un choix</button>
            </li>
        </ul>
        <br/>
        <input type="submit" value="Ajouter">
    </form>

    <script>
        function ajouterChoix() {
            var choixList = document.getElementById('choix-list');
            var newChoix = document.createElement('li');
            newChoix.innerHTML = '<input type="text" name="choix[]" required>';
            choixList.appendChild(newChoix);
        }
    </script>
</body>

</html>