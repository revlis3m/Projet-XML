<?php
// Charger le fichier XML
$messagerie = simplexml_load_file('testContact.xml');

// Récupérer le dernier ID de message
$lastMessageId = $messagerie->xpath("//message[last()]/@id");
$newMessageId = intval($lastMessageId[0]) + 1;

// Récupérer les valeurs du formulaire
$expediteur = $_POST['expediteur'];
$destinataireType = $_POST['destinataire'];
$receveur = $_POST['receveur'];
$nomAudio = $_POST['nom_audio'];
$contenu = $_POST['contenu'];

// Vérifier si l'expéditeur existe dans les contacts ou groupes
if ($expediteur !== 'group') {
    $expediteurExiste = false;
    foreach ($messagerie->contacts->contact as $contact) {
        if ((string)$contact['id'] === $expediteur) {
            $expediteurExiste = true;
            break;
        }
    }
} else {
    $expediteurExiste = false;
    foreach ($messagerie->groups->group as $group) {
        if ((string)$group['id'] === $expediteur) {
            $expediteurExiste = true;
            break;
        }
    }
}

// Vérifier si le destinataire existe dans les contacts ou groupes
if ($receveur !== 'group') {
    $destinataireExiste = false;
    foreach ($messagerie->contacts->contact as $contact) {
        if ((string)$contact['id'] === $receveur) {
            $destinataireExiste = true;
            break;
        }
    }
} else {
    $destinataireExiste = false;
    foreach ($messagerie->groups->group as $group) {
        if ((string)$group['id'] === $receveur) {
            $destinataireExiste = true;
            break;
        }
    }
}

// Vérifier si l'expéditeur et le destinataire existent
if ($expediteurExiste && $destinataireExiste) {
    // Créer l'élément <message>
    $message = $messagerie->messages->addChild('message');
    $message->addAttribute('id', $newMessageId);
    $message->addAttribute('sender', $expediteur);
    if ($destinataireType === 'group') {
        $message->addAttribute('group', $receveur);
    } else {
        $message->addAttribute('recipient', $receveur);
    }
    $message->addAttribute('timestamp', date('Y-m-d\TH:i:s'));

    // Créer l'élément <content> avec l'attribut type="audio"
    $content = $message->addChild('content');
    $content->addAttribute('type', 'audio');

    // Ajouter la balise <texte> avec le contenu
    $texte = $content->addChild('text', $contenu);

    // Ajouter la balise <audio> avec le nom du fichier audio
    $audio = $content->addChild('audio', $nomAudio);

    // Enregistrer les modifications dans le fichier XML
    $messagerie->asXML('testContact.xml');

    header('Location: affichageHTML.php');
    exit();
} else {
    echo "Erreur : l'expéditeur ou le destinataire est introuvable.";
}
