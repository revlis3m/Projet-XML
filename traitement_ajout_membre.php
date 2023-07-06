<?php
// Charger le fichier XML
$messagerie = simplexml_load_file('testContact.xml');

// Récupérer l'ID du groupe depuis le formulaire
$groupeId = $_POST['groupe_id'];

// Récupérer les ID des nouveaux membres depuis le formulaire
$nouveauxMembresIds = explode(',', $_POST['nouveaux_membres']);

// Vérifier si le groupe existe dans la liste des groupes
$groupeExiste = false;
foreach ($messagerie->groups->group as $group) {
    if ((string) $group['id'] === $groupeId) {
        $groupeExiste = true;

        // Ajouter les nouveaux membres au groupe
        foreach ($nouveauxMembresIds as $membreId) {
            $member = $group->members->addChild('member');
            $member->addAttribute('contactId', $membreId);
        }

        break;
    }
}

// Enregistrer les modifications dans le fichier XML
if ($groupeExiste) {
    $messagerie->asXML('testContact.xml');
    header('Location: affichageHTML.php');
    exit();
} else {
    echo "Erreur : l'expéditeur ou le destinataire est introuvable.";
}
