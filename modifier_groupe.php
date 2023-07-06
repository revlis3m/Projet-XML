<?php
// Vérifier si l'identifiant du groupe est passé dans l'URL
if (isset($_GET['id'])) {
    $groupId = $_GET['id'];

    // Charger le fichier XML
    $messagerie = simplexml_load_file('testContact.xml');

    // Trouver le groupe correspondant à l'identifiant
    $group = $messagerie->groups->xpath("//group[@id='$groupId']");

    // Vérifier si le groupe existe
    if ($group) {
        $group = $group[0];
    } else {
        // Rediriger vers une page d'erreur si le groupe n'existe pas
        header('Location: erreur.php');
        exit;
    }
} else {
    // Rediriger vers une page d'erreur si l'identifiant du groupe n'est pas spécifié
    header('Location: erreur.php');
    exit;
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer la nouvelle valeur du formulaire
    $newName = $_POST['name'];

    // Mettre à jour le nom du groupe
    $group->name = $newName;

    // Sauvegarder les modifications dans le fichier XML
    $messagerie->asXML('testContact.xml');

    // Rediriger vers la page des groupes après la modification
    header('Location: affichageHTML.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier groupe</title>
</head>

<body>
    <h1>Modifier groupe</h1>

    <form method="POST" action="">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name" value="<?php echo $group->name; ?>" required><br>

        <input type="submit" value="Modifier">
    </form>
</body>

</html>