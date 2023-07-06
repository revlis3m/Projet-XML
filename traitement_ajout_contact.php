<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Charger le fichier XML
    $messagerie = simplexml_load_file('testContact.xml');

    // Obtenir le dernier ID et calculer le nouvel ID
    $dernierId = 0;
    foreach ($messagerie->contacts->contact as $contact) {
        $id = (int) $contact['id'];
        if ($id > $dernierId) {
            $dernierId = $id;
        }
    }
    $nouvelId = $dernierId + 1;

    // Créer un nouvel élément contact
    $nouveauContact = $messagerie->contacts->addChild('contact');
    $nouveauContact['id'] = $nouvelId;
    $nouveauContact->addChild('name', $_POST['nom']);
    $nouveauContact->addChild('telephone', $_POST['telephone']);

    // Enregistrer les modifications dans le fichier XML
    $messagerie->asXML('testContact.xml');

    // Rediriger vers la page principale des contacts
    header('Location: affichageHTML.php');
    exit();
}
