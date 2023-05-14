<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<?php
include('../includes/dB.php');


$query = 'UPDATE reservation SET name= :name, debut= :debut, fin=:fin, nbr_places=:nbr_places, id_users = :id_users, id_activite = :id_activite WHERE id = :id';
$req = $bdd->prepare($query);
$result = $req->execute([
'name' => $_POST['name'],
'debut' => $_POST['debut'],
'fin' => $_POST['fin'],
'nbr_places' => $_POST['nbr_places'],
'id_users' => $_POST['id_users'],
'id_activite' => $_POST['id_activite'],
'id' => $_POST['id']
]);


if ($result) {
header('location: allReservations.php?message=Modifié avec succès');
exit;
} else {
header('location: allReservations.php?message=Erreur lors de la modification.');
exit;
}
?>