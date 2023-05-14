<?php

include '../includes/dB.php';

$id = $_GET['id'];

$q = "DELETE FROM reservation WHERE id = $id";
$req = $bdd->prepare($q);
$req->execute();

header('Location: adminReservations.php');

?>
