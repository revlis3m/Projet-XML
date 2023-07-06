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
$question = $_POST['question'];
$choixList = $_POST['choix'];

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

    // Créer l'élément <content> avec l'attribut type="sondage"
    $content = $message->addChild('content');
    $content->addAttribute('type', 'sondage');

    // Ajouter la balise <texte> avec la question
    $texte = $content->addChild('text', $question);

    // Ajouter la balise <sondage> avec la question et les choix
    $sondage = $content->addChild('sondage');
    $sondage->addChild('question', $question);
    $reponses = $sondage->addChild('reponses');

    // Ajouter les balises <choix> pour chaque choix
    foreach ($choixList as $choix) {
        $reponses->addChild('choix', $choix);
    }

    // Enregistrer les modifications dans le fichier XML
    $messagerie->asXML('testContact.xml');

    header('Location: affichageHTML.php');
    exit();
} else {
    echo "Erreur : l'expéditeur ou le destinataire est introuvable.";
}
