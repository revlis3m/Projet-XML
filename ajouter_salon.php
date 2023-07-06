<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un salon</title>
</head>

<body>
    <h1>Ajouter un salon</h1>
    <?php
    // Charger le fichier XML
    $messagerie = simplexml_load_file('testContact.xml');

    // Récupérer l'ID du groupe depuis l'URL
    $groupId = $_GET['group_id'];

    // Vérifier si un salon existe dans le groupe
    $salonExists = $messagerie->xpath("//group[@id='$groupId']/salons/salon");

    // Récupérer le dernier ID de salon du groupe ou attribuer l'ID 1 si aucun salon n'existe
    $newSalonId = $salonExists ? intval($messagerie->xpath("max(//group[@id='$groupId']/salons/salon/@id)")[0]) + 1 : 1;

    // Récupérer la liste des membres du groupe
    $members = $messagerie->xpath("//group[@id='$groupId']/members/member");

    // Vérifier si des membres existent pour le groupe
    if (count($members) > 0) {
    ?>
        <form action="traitement_ajout_salon.php" method="post">
            <input type="hidden" name="group_id" value="<?php echo $groupId; ?>">
            <label for="nom_salon">Nom du salon :</label>
            <input type="text" name="nom_salon" id="nom_salon" required><br>

            <label for="membres">Membres :</label><br>
            <?php foreach ($members as $member) : ?>
                <input type="checkbox" name="membres[]" value="<?php echo $member['contactId']; ?>">
                <?php echo $messagerie->contacts->contact[intval($member['contactId'])]->name; ?><br>
            <?php endforeach; ?>

            <input type="submit" value="Ajouter">
        </form>
    <?php
    } else {
        echo "Aucun membre disponible pour ce groupe.";
    }
    ?>
</body>

</html>