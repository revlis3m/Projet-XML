<?php
// Récupérer le type de message choisi dans le formulaire
$messageType = $_POST['messageType'];

// Rediriger l'utilisateur vers le formulaire correspondant en fonction du type de message
if ($messageType === 'text') {
    header('Location: formulaire_texte.php');
} elseif ($messageType === 'audio') {
    header('Location: formulaire_audio.php');
} elseif ($messageType === 'file') {
    header('Location: formulaire_file.php');
} elseif ($messageType === 'link') {
    header('Location: formulaire_lien.php');
} elseif ($messageType === 'localisation') {
    header('Location: formulaire_localisation.php');
} elseif ($messageType === 'sondage') {
    header('Location: formulaire_sondage.php');
} elseif ($messageType === 'contacte') {
    header('Location: formulaire_contact.php');
} else {
    // Type de message invalide
    echo "Type de message invalide.";
}
