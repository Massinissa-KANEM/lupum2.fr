<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/dB.php';
$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

$id_activite = $_GET['id_activite'];
$delete_activite = $bdd->prepare('DELETE FROM prestations WHERE id_activite = ?');
$delete_activite->execute(array($id_activite));

$id_activite = $_GET['id_activite'];
$delete_activite = $bdd->prepare('DELETE FROM materiaux WHERE id_activite = ?');
$delete_activite->execute(array($id_activite));

$delete_activite = $bdd->prepare('DELETE FROM activites WHERE id_activite = ?');
$delete_activite->execute(array($id_activite));

header('Location: adminActivites.php');