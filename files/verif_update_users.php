<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['email']) && !empty($_POST['email'])) {
    setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
}

if (empty($_POST['email']) || empty($_POST['fonction']) || empty($_POST['nom']) || empty($_POST['prenom'])) {
    header('location: allUsers.php?message=Vous devez remplir tous les champs.');
    exit;
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header('location: allUsers.php?message=Email invalide.');
    exit;
}

include('../includes/dB.php');


$query = 'UPDATE users SET email = :email,  = :nom, prenom = :prenom, fonction = :fonction WHERE id = :id';
$req = $bdd->prepare($query);
$result = $req->execute([
    'email' => $_POST['email'],
    'nom' => $_POST['lastName'],
    'prenom' => $_POST['firstName'],
    'fonction' => $_POST['fonction'],
    'id' => $_POST['id']
]);




if ($result) {
    header('location: allUsers.php?message=Modifié avec succès');
    exit;
} else {
    header('location: allUsers.php?message=Erreur lors de la modification.');
    exit;
}



