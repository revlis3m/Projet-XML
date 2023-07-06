<?php
// Charger le fichier XML
$messagerie = simplexml_load_file('testContact.xml');

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

// Récupérer l'ID du message à partir du paramètre de requête
$messageId = isset($_GET['id']) ? $_GET['id'] : '';

// Rechercher le message correspondant dans le fichier XML
$message = $messagerie->xpath("//message[@id='$messageId']");

// Vérifier si le message a été trouvé
if (!empty($message)) {
    $message = $message[0]; // Prendre le premier élément du tableau (il ne devrait y en avoir qu'un)
    $messageType = $message->content->attributes()['type'];

    echo "<h2>Type du message: $messageType</h2>";
    echo "<h3>Texte du message:</h3>";

    // Afficher les données spécifiques en fonction du type du message
    if ((string)$messageType === 'sondage') {
        echo "<h3>Question:</h3>";
        echo "<p>" . $message->content->sondage->question . "</p>";
        echo "<h3>Choix proposés:</h3>";
        foreach ($message->content->sondage->reponses->choix as $choix) {
            echo "<label><input type='radio' name='choix' value='" . $choix . "'>" . $choix . "</label><br>";
        }
    } elseif ((string)$messageType === 'localisation') {
        $latitude = $message->content->attributes()['latitude'];
        $longitude = $message->content->attributes()['longitude'];
        echo "<h3>Localisation:</h3>";
        echo "<table>";
        echo "<tr><th>Latitude</th><th>Longitude</th></tr>";
        echo "<tr><td>$latitude</td><td>$longitude</td></tr>";
        echo "</table>";
    } else {
        // Autres types de message
        echo "<p><strong>Text:</strong> " . $message->content->text . "</p>";
        foreach ($message->content->children() as $attribute => $value) {
            if ($attribute !== 'text') {
                echo "<p><strong>$attribute:</strong> $value</p>";
            }
        }
    }
} else {
    echo "<p>Message introuvable.</p>";
}
