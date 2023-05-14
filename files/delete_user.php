<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/dB.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";
    $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

    $result = mysqli_query($conn, $sql);
    // header("Location: adminUsers.php?message=Utilisateur supprimé avec succès !");
    echo "<script>window.location.href='adminUsers.php?message=Utilisateur supprimé avec succès !';</script>";
}

?>