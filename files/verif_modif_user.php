<?php
session_start();
include 'includes/userInfo.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    header('location: editProfil.php?message=Email invalide');
    exit;
}

$prenom = htmlspecialchars($_POST['prenom']);
$nom = htmlspecialchars($_POST['nom']);
$email = htmlspecialchars($_POST['email']);
$phone = intval($_POST['phone']);
$entreprise = htmlspecialchars($_POST['entreprise']);
$poste = htmlspecialchars($_POST['poste']);

include '../includes/dB.php';

$q = 'SELECT id FROM users WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_SESSION['email']]);

$results = $req->fetchAll(); 
$id = $results[0]['id'];

if($_POST['email'] == $_SESSION['email']){
    $update = 'UPDATE users SET firstName= :prenom, lastName= :nom, email= :email, phone= :phone, entreprise= :entreprise, poste= :poste WHERE email= :email';

    $send = $bdd->prepare($update);
    $send->execute(array(':prenom'=>$prenom, ':nom'=>$nom,'email'=>$email, ':phone'=>$phone, ':entreprise'=>$entreprise, ':poste'=>$poste));
    header('location: adminUsers.php?message=Informations modifiés avec succès');
    exit;
}

if($_POST['email'] != $_SESSION['email']){

    $q = 'SELECT id FROM users WHERE email = ?';
    $req = $bdd->prepare($q);
    $req->execute([$_POST['email']]);

    $results = $req->fetchAll(); 

    if(count($results) != 0){
        header('location: verifProfil.php?message=Cet email est déjà utilisé.');
        exit;
    }

    $update = 'UPDATE users SET firstName= :prenom, lastName= :nom, email= :email, phone= :phone, entreprise= :entreprise, poste= :poste WHERE id= :id';

    $send = $bdd->prepare($update);
    $send->execute(array(':id'=>$id[0]['id'], ':prenom'=>$prenom, ':nom'=>$nom,'email'=>$email, ':phone'=>$phone, ':entreprise'=>$entreprise, ':poste'=>$poste));
    $_SESSION['email'] = $email;
    header('location: adminUsers.php?message=Informations modifiés avec succès');
    exit;
}


?>