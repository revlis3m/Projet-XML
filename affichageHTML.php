<?php
// Charger le fichier XML
$messagerie = simplexml_load_file('testContact.xml');

// Récupérer tous les messages
$messages = $messagerie->messages->message;

// Récupérer tous les contacts
$contacts = $messagerie->contacts->contact;

// Récupérer tous les groupes
$groups = $messagerie->groups->group;

// Fonction pour obtenir le nom d'un contact en fonction de son ID
function getContactName($contacts, $contactId)
{
    foreach ($contacts as $contact) {
        if ((string)$contact['id'] === $contactId) {
            return (string)$contact->name;
        }
    }
    return 'Inconnu';
}

// Fonction pour obtenir le nom d'un groupe en fonction de son ID
function getGroupName($groups, $groupId)
{
    foreach ($groups as $group) {
        if ((string)$group['id'] === $groupId) {
            return (string)$group->name;
        }
    }
    return 'Inconnu';
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Contacts</title>
</head>

<body>
    <h1>Liste des contacts</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($messagerie->contacts->contact as $contact) : ?>
            <tr>
                <td><?php echo $contact['id']; ?></td>
                <td><?php echo $contact->name; ?></td>
                <td><?php echo $contact->telephone; ?></td>
                <td>
                    <a href="modifier_contact.php?id=<?php echo $contact['id']; ?>">Modifier</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button onclick="window.location.href = 'ajouter_contact.php';">Ajouter contact</button>

    <h1>Liste des groupes</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Membres</th>
            <th colspan="3">Salons</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($messagerie->groups->group as $group) : ?>
            <tr>
                <td><?php echo $group['id']; ?></td>
                <td><?php echo $group->name; ?></td>
                <td>
                    <?php foreach ($group->members->member as $member) : ?>
                        <li><?php echo $messagerie->contacts->contact[intval($member['contactId'])]->name; ?><br></li>
                    <?php endforeach; ?>
                </td>
                <td colspan="3">
                    <?php if ($group->salons->count() > 0) : ?>
                        <?php foreach ($group->salons->salon as $salon) : ?>
                            <div>
                                <strong>Nom du salon:</strong> <?php echo $salon->name; ?><br>
                                <strong>Membres du salon:</strong>
                                <li>
                                    <?php foreach ($salon->members->member as $salonMember) : ?>
                                        <?php echo $messagerie->contacts->contact[intval($salonMember['contactId'])]->name; ?><br>
                                    <?php endforeach; ?>
                                </li>
                                <a href="ajouter_membre_salon.php?group_id=<?php echo $group['id']; ?>&salon_id=<?php echo $salon['id']; ?>">Ajouter Membre Salon</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        Aucun salon disponible.
                    <?php endif; ?>
                </td>
                <td>
                    <a href="modifier_groupe.php?id=<?php echo $group['id']; ?>">Modifier</a>
                </td>
                <td>
                    <a href="ajouter_membre.php?group_id=<?php echo $group['id']; ?>&salon_id=<?php echo $salon['id']; ?>">Ajouter Membre Groupe</a>
                </td>
                <td>
                    <a href="ajouter_salon.php?group_id=<?php echo $group['id']; ?>">Ajouter Salon</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button onclick="window.location.href = 'ajouter_groupe.php';">Ajouter groupe</button>

    <h1>Messages</h1>

    <table>
        <thead>
            <tr>
                <th>ID du message</th>
                <th>Expéditeur</th>
                <th>Destinataire</th>
                <th>Nom du groupe</th>
                <th>Timestamp</th>
                <th>Lire le message</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message) : ?>
                <tr>
                    <td><?php echo $message['id']; ?></td>
                    <td>
                        <?php
                        $senderName = getContactName($contacts, (string)$message['sender']);
                        echo $senderName !== 'Inconnu' ? $senderName : '';
                        ?>
                    </td>
                    <td>
                        <?php
                        $recipients = explode(',', $message['recipient']);
                        $recipientNames = array();

                        foreach ($recipients as $recipientId) {
                            $recipientName = getContactName($contacts, (string)$recipientId);
                            if ($recipientName !== 'Inconnu') {
                                $recipientNames[] = $recipientName;
                            }
                        }

                        echo implode(', ', $recipientNames);
                        ?>
                    </td>
                    <td>
                        <?php
                        $groupId = (string)$message['group'];
                        $groupName = getGroupName($groups, $groupId);
                        echo $groupName !== 'Inconnu' ? $groupName : '';
                        ?>
                    </td>
                    <td><?php echo $message['timestamp']; ?></td>
                    <td>
                        <?php $messageId = $message['id']; ?>
                        <a href="lire_message.php?id=<?php echo $messageId; ?>">Lire</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button onclick="window.location.href = 'ajouter_message.php';">Ajouter un message </button>

</body>

</html>