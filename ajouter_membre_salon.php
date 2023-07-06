<!DOCTYPE html>
<html>

<head>
    <title>Ajouter un membre au salon</title>
</head>

<body>
    <h1>Ajouter un membre au salon</h1>

    <?php
    // Charger le fichier XML
    $messagerie = simplexml_load_file('testContact.xml');

    // Récupérer les données du formulaire depuis l'URL
    $groupId = $_GET['group_id'];
    $salonId = $_GET['salon_id'];

    // Vérifier si le groupe et le salon existent
    $group = $messagerie->xpath("//group[@id='$groupId']");
    $salon = $messagerie->xpath("//group[@id='$groupId']/salons/salon[@id='$salonId']");
    if ($group && $salon) {
        $group = $group[0];
        $salon = $salon[0];
    } else {
        echo "Erreur : Le groupe ou le salon n'existe pas.";
        exit();
    }

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $memberIds = $_POST['members'];

        // Ajouter les membres au salon
        foreach ($memberIds as $memberId) {
            $member = $messagerie->xpath("//contacts/contact[@id='$memberId']");
            if ($member) {
                $member = $member[0];

                // Vérifier si le membre n'est pas déjà présent dans le salon
                $existingMember = $salon->xpath("members/member[@contactId='$memberId']");
                if (!$existingMember) {
                    $newMember = $salon->members->addChild('member');
                    $newMember->addAttribute('contactId', $memberId);
                }
            }
        }

        // Enregistrer les modifications dans le fichier XML
        $messagerie->asXML('testContact.xml');

        // Rediriger vers la page du groupe avec le salon
        header("Location: modifier_groupe.php?id=$groupId");
        exit();
    }
    ?>

    <form action="" method="POST">
        <input type="hidden" name="group_id" value="<?php echo $groupId; ?>">
        <input type="hidden" name="salon_id" value="<?php echo $salonId; ?>">

        <label for="members">Membres :</label>
        <select name="members[]" id="members" multiple>
            <?php foreach ($messagerie->contacts->contact as $contact) : ?>
                <option value="<?php echo $contact['id']; ?>"><?php echo $contact->name; ?></option>
            <?php endforeach; ?>
        </select>

        <br><br>
        <input type="submit" value="Ajouter">
    </form>

</body>

</html>