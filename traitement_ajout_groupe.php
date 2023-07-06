<?php
    $nom = $_POST['nom'];
    $ids = $_POST['ids'];

    // Charger le fichier XML et obtenir le dernier ID attribué
    $messagerie = simplexml_load_file('testContact.xml');
    $lastId = $messagerie->xpath('//contact[last()]')[0]['id'];
    $newId = $lastId + 1;

    // Convertir les IDs des contacts en tableau
    $idsArray = explode(',', $ids);

    // Vérifier et ajouter les contacts au groupe
    $newGroup = $messagerie->groups->addChild('group');
    $newGroup->addAttribute('id', $newId);
    $newGroup->addChild('name', $nom);

    $members = $newGroup->addChild('members');

    foreach ($idsArray as $id) {
        $contact = $messagerie->contacts->xpath("//contact[@id='$id']");

        if ($contact) {
            // Le contact existe, ajouter au groupe
            $member = $members->addChild('member');
            $member->addAttribute('contactId', $id);
        }
    }

    // Enregistrer les modifications dans le fichier XML
    $messagerie->asXML('testContact.xml');

    echo "Le groupe a été ajouté avec succès.";
    // Rediriger vers la page principale des contacts
    header('Location: affichageHTML.php');
    exit();
