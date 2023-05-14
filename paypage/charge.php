<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../src/bootstrap.php';
	require_once '../src/calendar/reservations.php';

	$pdo = get_pdo();
	$reservations = new \calendar\reservations($pdo);
	
	$reservation = $reservations->find($_GET['id']);
	$participants = array();

  
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51MnBkQDeQWk0eOlIiSbrkSJD9zFJQSm4gYJwQ8MrFhg9yp7dnUzYQDlb0mHpFpNqjdNuscMPlY3iJFY1OqrYSMEC007oLQb00c');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $token = $_POST['stripeToken'];
  $first_name = $_POST['first_name'];
  // $last_name = $_POST['entreprise'];
  // $email = $_POST['email'];

  $email = $_SESSION['email'];

  $price = $_SESSION['total'] * 100;

  $customer = \Stripe\Customer::create(array(
    'email' => $email,
    'name' => $first_name,
    'source'  => $token
  ));
  $charge = \Stripe\Charge::create(array(
      'amount' => $price,
      'currency' => 'eur',
      'description' => 'Example charge',
      'customer' => $customer->id
  ));

  $emails_participants = $_SESSION ['emails'];
  $nom_activite = $_SESSION ['nom_activite'];
  $total_activite = $_SESSION ['total'];
  $today= date("Y-m-d H:i:s");
  
  

  if ($charge->status == 'succeeded') {
    $succeeded = 1;
    $entreprise = $_POST['entreprise'];

    include '../includes/dB.php';
    $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

    $date_debut = (new DateTime($reservation['debut']))->format('Y-m-d') . ' ' . (new DateTime($reservation['debut']))->format('H:i:s');
    $date_fin = (new DateTime($reservation['fin']))->format('Y-m-d') . ' ' . (new DateTime($reservation['fin']))->format('H:i:s');
    // $heure_debut= (new DateTime($reservation['debut']))->format('H:i:s');
    // $heure_fin= (new DateTime($reservation['fin']))->format('H:i:s');

    var_dump($heure_debut);
    var_dump($heure_fin);

    foreach ($emails_participants as $participant) {
        $sql = "INSERT INTO commandes (email_organisateur, email, total, activite, date_debut, date_fin, commande_date, entreprise) VALUES ('$email', '$participant', '$total_activite', '$nom_activite', '$date_debut', '$date_fin', '$today', '$entreprise')";
        $result = mysqli_query($conn, $sql);
    }

    $sql = "UPDATE reservation SET reserve = 1 WHERE debut = '$date_debut' AND fin = '$date_fin'";
    $result = mysqli_query($conn, $sql);

    // $sql = "INSERT INTO paiements (nom, prenom, email, total, date, status) VALUES ('$email', '$total_activite', '$today', '$succeeded')";
    // $result = mysqli_query($conn, $sql);

    $fidelite = "SELECT fidelite FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $fidelite);
    $row = mysqli_fetch_assoc($result);

    $fidelite = $row['fidelite'] + 1;

    $sql = "UPDATE users SET fidelite = '$fidelite' WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);


    $code = $_SESSION['code'];
    $total_before = $_SESSION['total_before'];

    $used = "SELECT * FROM reductions WHERE code = '$code'";
    $result = mysqli_query($conn, $used);
    $row = mysqli_fetch_assoc($result);

    if ($total_activite != $total_before){
        $update_used = "UPDATE reductions SET utilise = 1 WHERE code = '$code'";
        $result = mysqli_query($conn, $update_used);
    }

    mysqli_close($conn);

    header('Location: index.php?id='.$reservation['id'].''  . '&message=Paiement réussi !');
    exit;
  } else {
    header('Location: index.php'  . '?message=Paiement Non réussi !');
    exit;
  }
  
}
?>