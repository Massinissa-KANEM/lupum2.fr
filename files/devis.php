<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../includes/fpdf/fpdf.php');
include '../includes/dB.php';

$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

$pdf->Image('../images/logo_lupum.png', 20, 92, 160, 65, 'png');
$pdf->Image('../images/cachet.png', 125, 235, 85, 50, 'png');

$pdf->Cell(0, 10, 'Devis pour l\'activite : ' . utf8_decode($_SESSION['nom_activite']), 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Details', 1, 0, 'C');
$pdf->Cell(40, 10, 'Prix unitaire', 1, 0, 'C');
$pdf->Cell(40, 10, 'Quantite', 1, 0, 'C');
$pdf->Cell(40, 10, 'Total', 1, 1, 'C');
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 12);

// Affichage des prestations
if (isset($_SESSION['prestations'])) {
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Prestataires choisies :', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $total_prestations = 0;
    foreach ($_SESSION['prestations'] as $id_prestation) {
        $sql = "SELECT prix, nom FROM prestations WHERE id_prestation = " . $id_prestation;
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $total_prestations += $row['prix'];
            $pdf->MultiCell(90, 8, utf8_decode($row['nom']), 1, 'L');
            $pdf->SetY($pdf->GetY() - 8);
            $pdf->SetX(100);
            $pdf->Cell(40, 8, number_format($row['prix'], 2) . ' eur', 1, 0, 'C');
            $pdf->Cell(10, 8, '1', 1, 0, 'C');
            $pdf->Cell(40, 8, number_format($row['prix'], 2) . ' eur', 1, 1, 'C');
        } else {
            echo "    Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
        }
    }
}else {
    $pdf->Cell(90, 10, 'Aucune prestation choisie', 1, 0, 'C');
}
$pdf->Ln(8);
// Affichage des matériaux

if (isset($_SESSION['materiaux'])) {
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Materiaux choisis :', 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $total_materiaux = 0;
    foreach ($_SESSION['materiaux'] as $id_materiel) {
        $sql = "SELECT prix, nom_materiel FROM materiaux WHERE id_materiel = " . $id_materiel;
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $total_materiaux += $row['prix'];
            $pdf->Cell(60, 10, utf8_decode($row['nom_materiel']), 1, 0);
            $pdf->Cell(40, 10, number_format($row['prix'], 2) . ' eur', 1, 0, 'C');
            $pdf->Cell(10, 10, '1', 1, 0, 'C');
            $pdf->Cell(40, 10, number_format($row['prix'], 2) . ' eur', 1, 1, 'C');
        } else {
            echo "    Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
        }
    }
}else {
    $pdf->Cell(90, 10, 'Aucun materiel choisi', 1, 0, 'C');
}
$pdf->Ln(8);


$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Participants :', 0, 1);
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(60, 10, 'Nombre de participants', 1, 0);
$pdf->Cell(40, 10, number_format($_SESSION['prix_participant'], 2) . ' eur', 1, 0, 'C');
$pdf->Cell(40, 10, $_SESSION['nbr_participants'], 1, 0, 'C');

$pdf->Cell(40, 10, number_format($_SESSION['prix_participant'] * $_SESSION['nbr_participants'], 2) . ' eur', 1, 1, 'C');
$pdf->Ln(8);

$total_devis = $total_prestations + $total_materiaux + ($_SESSION['prix_participant'] * $_SESSION['nbr_participants']);
$pdf->Cell(60, 10, 'Total activite', 1, 0);

$pdf->Cell(40, 10, number_format($total_devis, 2) . ' eur', 1, 1, 'C');

$pdf->Output();
// $pdf->Output('D', 'devis.pdf');
?>