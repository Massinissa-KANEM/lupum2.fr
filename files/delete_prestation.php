<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/dB.php';
$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

$id = $_GET['id_prestation'];
$id_activite = $_GET['id_activite'];

$q = 'DELETE FROM prestations WHERE id_prestation = '.$id.'';
$result = mysqli_query($conn, $q);

header('Location: adminPrestations.php?id_activite='.$id_activite.'');