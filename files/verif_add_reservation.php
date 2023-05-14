<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['nmr_salle']) && empty($_POST['nmr_salle'])){
    header('location: addReservation.php?message=Vous devez remplir tous les champs : Numero de la salle.');
    exit;
}

if(isset($_POST['debut']) && empty($_POST['debut'])){
    header('location: addReservation.php?message=Vous devez remplir tous les champs : debut.');
    exit;
}

if(isset($_POST['fin']) && empty($_POST['fin'])){
    header('location: addReservation.php?message=Vous devez remplir tous les champs : fin.');
    exit;
}

if(isset($_POST['nbr_places']) && empty($_POST['nbr_places'])){
    header('location: addReservation.php?message=Vous devez remplir tous les champs : places.');
    exit;
}

include('../includes/dB.php');

$q = 'INSERT INTO reservation (nmr_salle, debut, fin, nbr_places, prix) VALUES (:nmr_salle, :debut, :fin, :nbr_places, :prix)';
$req = $bdd->prepare($q);
$result = $req->execute([
    'nmr_salle' => $_POST['nmr_salle'],
    'debut' => $_POST['debut'],
    'fin' => $_POST['fin'],
    'nbr_places' => $_POST['nbr_places'],
    'prix' => $_POST['prix']
]);

if($result){
    header('location: adminReservations.php?message=Reservation ajoutée avec succès');
    exit;
}
else{
    header('location: adminReservations.php?message=Erreur lors de l\'ajout de la reservation.');
    exit;
}

?>