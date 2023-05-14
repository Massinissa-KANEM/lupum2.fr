<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/dB.php';
$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $debut = $_POST['debut'];
    $fin = $_POST['fin'];
    $nbr_places = $_POST['nbr_places'];
    $nmr_salle = $_POST['nmr_salle'];
    $prix = $_POST['prix'];

    $q = "UPDATE reservation SET debut = '$debut', fin = '$fin', nbr_places = '$nbr_places', nmr_salle = '$nmr_salle', prix = '$prix' WHERE id = " . $_GET['id'];
    $req = $bdd->prepare($q);
    $req->execute();

    header('Location: adminReservations.php');
    exit();
}

$q = "SELECT * FROM reservation WHERE id = " . $_GET['id'];
$req = $bdd->prepare($q);
$req->execute();
$reservation = $req->fetch();

$debut = isset($_POST['debut']) ? $_POST['debut'] : $reservation['debut'];
$fin = isset($_POST['fin']) ? $_POST['fin'] : $reservation['fin'];
$nbr_places = isset($_POST['nbr_places']) ? $_POST['nbr_places'] : $reservation['nbr_places'];
$nmr_salle = isset($_POST['nmr_salle']) ? $_POST['nmr_salle'] : $reservation['nmr_salle'];
$reserve = $reservation['reserve'];
$prix = isset($_POST['prix']) ? $_POST['prix'] : $reservation['prix'];
?>

<form class="add_reservation" action="modifReservation.php?id=<?php echo $_GET['id']; ?>" method="POST">
    <h1 class="h3 mb-3 fw-normal">Modifier une réservation</h1>

    <div class="form-floating">
        <input type="number" class="form-control" id="nmr_salle" placeholder="nmr_salle" required="" name="nmr_salle" min="1" max="6" value="<?php echo $nmr_salle; ?>">
        <label for="exampleFormControlInput1" class="form-label">Numero de la salle</label>
    </div>

    <div class="form-floating">
        <input type="datetime-local" class="form-control" id="debut" placeholder="" required="" name="debut" min="<?php echo date('Y-m-d\TH:i'); ?>" value="<?php echo date('Y-m-d\TH:i', strtotime($debut)); ?>">
        <label for="exampleFormControlInput1" class="form-label">Date et Heure de debut</label>
    </div>

    <div class="form-floating">
        <input type="datetime-local" class="form-control" id="fin" placeholder="" required="" name="fin" min="<?php echo date('Y-m-d\TH:i'); ?>" value="<?php echo date('Y-m-d\TH:i', strtotime($fin)); ?>">
        <label for="exampleFormControlInput1" class="form-label">Date et Heure de fin</label>
    </div>

    <div class="form-floating">
        <input type="number" class="form-control" id="nbr_places" placeholder="<?php $nbr_places ?>" required="" name="nbr_places" min="0" value="<?php echo $nbr_places; ?>">
        <label for="exampleFormControlInput1" class="form-label">Places</label>
    </div>

    <div class="form-floating">
        <input type="number" class="form-control" id="prix" placeholder="<?php $prix ?>" required="" name="prix" min="0" value="<?php echo $prix; ?>">
        <label for="exampleFormControlInput1" class="form-label">Prix par personne</label>
    </div>

    <button type="submit" class="btn btn-primary">Modifier</button>
</form>