<?php
// Vérifier si l'identifiant du contact est passé dans l'URL
if (isset($_GET['id'])) {
    $contactId = $_GET['id'];

    // Charger le fichier XML
    $messagerie = simplexml_load_file('testContact.xml');

    // Trouver le contact correspondant à l'identifiant
    $contact = $messagerie->contacts->xpath("//contact[@id='$contactId']");

    // Vérifier si le contact existe
    if ($contact) {
        $contact = $contact[0];
    } else {
        // Rediriger vers une page d'erreur si le contact n'existe pas
        header('Location: erreur.php');
        exit;
    }
} else {
    // Rediriger vers une page d'erreur si l'identifiant du contact n'est pas spécifié
    header('Location: erreur.php');
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles valeurs du formulaire
    $newName = $_POST['name'];
    $newTelephone = $_POST['telephone'];

    // Mettre à jour les données du contact
    $contact->name = $newName;
    $contact->telephone = $newTelephone;

    // Sauvegarder les modifications dans le fichier XML
    $messagerie->asXML('testContact.xml');

    // Rediriger vers la page des contacts après la modification
    header('Location: affichageHTML.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier contact</title>
</head>

<body>
    <h1>Modifier contact</h1>

    <form method="POST" action="">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="<?php echo $contact->name; ?>" required><br>

        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" id="telephone" value="<?php echo $contact->telephone; ?>" required><br>

        <input type="submit" value="Modifier">
    </form>
</body>

</html>