<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<?php
include('../includes/dB.php');


$query = 'UPDATE activites SET nom= :nom, numero = :numero WHERE id_activite = :id';
$req = $bdd->prepare($query);
$result = $req->execute([
    'nom' => $_POST['nom'],
    'numero' => $_POST['numero'],
    'id' => $_POST['id']
]);




if ($result) {
    header('location: allActivites.php?message=Modifié avec succès');
    exit;
} else {
    header('location: allActivites.php?message=Erreur lors de la modification.');
    exit;
}
?>