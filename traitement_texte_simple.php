<?php
// Charger le fichier XML
$messagerie = simplexml_load_file('testContact.xml');

// Récupérer les données du formulaire
$sender = isset($_POST['sender']) ? $_POST['sender'] : '';
$destinataireType = isset($_POST['destinataire']) ? $_POST['destinataire'] : '';
$destinataireId = isset($_POST['id']) ? $_POST['id'] : '';
$contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';

// Vérifier si l'expéditeur existe
$expediteurExiste = false;
foreach ($messagerie->contacts->contact as $contact) {
    if ((string)$contact['id'] === $sender) {
        $expediteurExiste = true;
        break;
    }
}

if (!$expediteurExiste) {
    echo "<p>L'expéditeur avec l'ID $sender n'existe pas.</p>";
    exit();
}

// Vérifier si le destinataire existe dans la catégorie choisie
$destinataireExiste = false;
if ($destinataireType === 'contact') {
    foreach ($messagerie->contacts->contact as $contact) {
        if ((string)$contact['id'] === $destinataireId) {
            $destinataireExiste = true;
            break;
        }
    }
} elseif ($destinataireType === 'group') {
    foreach ($messagerie->groups->group as $group) {
        if ((string)$group['id'] === $destinataireId) {
            $destinataireExiste = true;
            break;
        }
    }
}

if (!$destinataireExiste) {
    echo "<p>Le destinataire avec l'ID $destinataireId n'existe pas dans la catégorie $destinataireType.</p>";
    exit();
}

// Générer l'ID du nouveau message
$lastMessageId = $messagerie->messages->message[count($messagerie->messages->message) - 1]['id'];
$newMessageId = intval($lastMessageId) + 1;

// Créer l'élément <message>
$message = $messagerie->messages->addChild('message');
$message->addAttribute('id', $newMessageId);
$message->addAttribute('sender', $sender);
if ($destinataireType === 'contact') {
    $message->addAttribute('recipient', $destinataireId);
} elseif ($destinataireType === 'group') {
    $message->addAttribute('group', $destinataireId);
}
$message->addAttribute('timestamp', date('Y-m-d\TH:i:s'));

// Créer l'élément <content>
$content = $message->addChild('content');
$content->addAttribute('type', 'text');

// Ajouter le contenu texte
$texte = $content->addChild('text', $contenu);

// Enregistrer les modifications dans le fichier XML
$messagerie->asXML('testContact.xml');

header('Location: affichageHTML.php');
exit();