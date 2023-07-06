<?php
// Charger le fichier XML
$messagerie = simplexml_load_file('testContact.xml');

// Récupérer les données du formulaire
$groupId = $_POST['group_id'];
$nomSalon = $_POST['nom_salon'];
$membres = isset($_POST['membres']) ? $_POST['membres'] : [];

// Vérifier si un salon existe dans le groupe
$salonExists = $messagerie->xpath("//group[@id='$groupId']/salons/salon");

// Récupérer le dernier ID de salon du groupe ou attribuer l'ID 1 si aucun salon n'existe
$newSalonId = $salonExists ? intval($messagerie->xpath("max(//group[@id='$groupId']/salons/salon/@id)")[0]) + 1 : 1;

// Créer l'élément <salon>
$salons = $messagerie->xpath("//group[@id='$groupId']/salons");
if (!empty($salons)) {
    $salon = $salons[0]->addChild('salon');
    // Reste du code pour ajouter les attributs et les valeurs du salon
} else {
    echo "Aucun salon trouvé pour ce groupe.";
}
$salons = $messagerie->xpath("//group[@id='$groupId']/salons");
if (empty($salons)) {
    // Créer l'élément <salons> s'il n'existe pas
    $group = $messagerie->xpath("//group[@id='$groupId']")[0];
    $salonsElement = $group->addChild('salons');
    $salon = $salonsElement->addChild('salon');
} else {
    $salon = $salons[0]->addChild('salon');
}

// Ajouter les attributs et les valeurs du salon
$salon->addAttribute('id', $newSalonId);
$salon->addChild('name', $nomSalon);

// Ajouter les membres du salon
if (!empty($membres)) {
    $membersElement = $salon->addChild('members');
    foreach ($membres as $membre) {
        $memberElement = $membersElement->addChild('member');
        $memberElement->addAttribute('contactId', $membre);
    }
}

// Enregistrer les modifications dans le fichier XML
$messagerie->asXML('testContact.xml');

header('Location: affichageHTML.php');
exit();
