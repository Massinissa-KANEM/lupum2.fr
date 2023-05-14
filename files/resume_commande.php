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


include '../includes/dB.php';

$nom_activite = $_SESSION['nom_activite'];
$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

echo '<h2>Résumé de votre commande :</h2>';
echo '<h3>Activité : ' . $nom_activite . '</h3>';

if (isset($_SESSION['prestations']) && !empty($_SESSION['prestations'])) {
    $sql = "SELECT id_prestation, nom, prix FROM prestations WHERE id_prestation IN (" . implode(',', $_SESSION['prestations']) . ")";
    $result = mysqli_query($conn, $sql);


    if ($result) {
        echo '<h3>Prestations :</h3>';
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row['nom'] . ' (' . $row['prix'] . ' €)</li>';
        }
        echo '</ul>';
    } else {
        echo "	Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
}

if (isset($_SESSION['materiaux']) && !empty($_SESSION['materiaux'])) {
    $sql = "SELECT id_materiel, nom_materiel, prix FROM materiaux WHERE id_materiel IN (" . implode(',', $_SESSION['materiaux']) . ")";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<h3>Materiaux :</h3>';
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row['nom_materiel'] . ' (' . $row['prix'] . ' €)</li>';
        }
        echo '</ul>';
    } else {
        echo "	Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
    }
}

// $sql = "SELECT id_materiel, nom_materiel, prix FROM materiaux WHERE id_materiel IN (" . implode(',', $_SESSION['materiaux']) . ")";
// $result = mysqli_query($conn, $sql);

// if ($result) {
// 	echo '<h3>Materiaux :</h3>';
// 	echo '<ul>';
// 	while ($row = mysqli_fetch_assoc($result)) {
// 		echo '<li>' . $row['nom_materiel'] . ' (' . $row['prix'] . ' €)</li>';
// 	}
// 	echo '</ul>';
// } else {
// 	echo "	Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
// }

$emails = $_POST['emails'];
    //affichage des emails non vides
    foreach ($emails as $email) {
        if (!empty($email)) {
            $tab_emails[] = $email;
        }
    }

    //affichage des emails non vides
    foreach ($tab_emails as $email) {
        echo $email.'<br>';
    }

    //nombre de participants (emails non vides)
    $nbr_participants = 0;
    foreach ($emails as $email) {
        if (!empty($email)) {
            $nbr_participants++;
        }
    }
    

echo '<h2>Total prestations : ' . $_SESSION['total_prestations'] . ' €</h2>';
echo '<h2>Total materiaux : ' . $_SESSION['total_materiaux'] . ' €</h2>';

echo '<h2>Nombre de participants : '.$nbr_participants.'</h2>';

$getPrice = $pdo->prepare('SELECT prix FROM reservation WHERE id = :id_prestation');
$getPrice->execute(['id_prestation' => $reservation['id']]);
$price = $getPrice->fetch();

echo '<h2>Prix par participant : '.$price['prix'].'</h2>';
$_SESSION['prix_participant'] = $price['prix'];

$total_participants = $nbr_participants * $price['prix'];
echo '<h2>Total à payer pour les participants : '. $total_participants .'</h2>';

$nbr_places = count($emails);
echo '<h2>Nombre de places : '.$nbr_places.'</h2>';
$total_a_payer = $_SESSION['total_activite'] + $total_participants;

echo '<h1>Total à payer : ' . $total_a_payer  . ' €</h1>';

$_SESSION['total'] = $total_a_payer;
$_SESSION['total_before'] = $total_a_payer;

    $_SESSION['emails'] = $tab_emails;

    // $_SESSION['nom_activite'] = $nom_activite;
    // $_SESSION['total_prestations'] = $_SESSION['total_prestations'];
    // $_SESSION['total_materiaux'] = $_SESSION['total_materiaux'];
    // $_SESSION['total_activite'] = $_SESSION['total_activite'];
    // $_SESSION['nbr_places'] = $nbr_places;
    // $_SESSION['total'] = $total_a_payer;
    // $_SESSION['total_before'] = $total_a_payer;
    $_SESSION['total_participants'] = $total_participants;
    $_SESSION['nbr_participants'] = $nbr_participants;

    echo '<a href="devis.php?id=' . $reservation['id'] . '" target="_blank">Telecharger le pdf</a><br>';
    
echo '<a href="prestations.php">Retour</a><br>';
echo '<a href="verif_reduction.php?id='. $reservation['id'] . '">code promo</a><br>';
echo '<a href="../paypage/index.php?id='.$reservation['id'].'">Proceder au paiement</a>'
?> 
</body>
</html>