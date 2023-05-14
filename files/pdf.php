<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../includes/fpdf/fpdf.php');
include '../includes/dB.php';

$date_commande = $_GET['commande_date'];

$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

$sql = "SELECT activite, entreprise, total, commande_date, email_organisateur, date_debut, date_fin, GROUP_CONCAT(email) AS emails FROM commandes WHERE commande_date = '" . $date_commande . "' GROUP BY activite, entreprise, total, commande_date, email_organisateur, date_debut, date_fin";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();


$pdf->Image('../images/logo_lupum.png', 20, 92, 160, 65, 'png');
$pdf->Image('../images/cachet.png', 125, 235, 85, 50, 'png');


$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Commandes du ' . $date_commande, 0, 1, 'C');
$pdf->Ln(10);

//afficher le nom de entreprise
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Entreprise : ' . $row['entreprise']);
$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Activite', 1, 0, 'C');
$pdf->Cell(130, 10, $row['activite'], 1, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(60, 10, 'Organisateur', 1, 0, 'C');
$pdf->Cell(130, 10, $row['email_organisateur'], 1, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(60, 10, 'Date de debut', 1, 0, 'C');
$pdf->Cell(130, 10, $row['date_debut'], 1, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(60, 10, 'Date de fin', 1, 0, 'C');
$pdf->Cell(130, 10, $row['date_fin'], 1, 0, 'C');
$pdf->Ln(10);
$pdf->Cell(60, 10, 'Prix de l\'activite', 1, 0, 'C');
$pdf->Cell(130, 10, $row['total'] . ' eur', 1, 0, 'C');
$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Participants : ');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Ln(10);
foreach (explode(',', $row['emails']) as $email) {

    $pdf->Cell(70, 10, $email, 1, 1, 'C');
}


$pdf->Output();


?>