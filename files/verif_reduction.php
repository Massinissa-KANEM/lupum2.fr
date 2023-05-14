
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

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../CSSs/prestations.css">
	<title>Liste déroulante de choix</title>
</head>
<body>
    <div class="name_bloc">
        <?php $total = $_SESSION['total']; ?>

        <h4>Montant total à payer : <?php echo $total; ?> €</h4>

        <?php 
            include '../includes/dB.php';
            $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

            $sql = "SELECT reduction FROM reductions WHERE id = 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $reduction = $row['reduction'];
        ?>
        <div class="text">
            <h2>Code de réduction</h2>
            <h4><?php echo $reduction ?> € dès la 5ème commande </h4>
        </div>
        <form action="verif_reduction.php?id=<?php echo $reservation['id']; ?>" method="post">
            <input type="text" name="code" class="mb-3 StripeElement StripeElement--empty" placeholder="Code promo" require>
            <input type="submit" name="submit" value="Appliquer" class="btn btn-primary">
        </form>


    </div>
</body>
</html>

<?php

if (isset($_POST['submit'])) {
    $code = $_POST['code'];

    include '../includes/dB.php';
    $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

    $sql = "SELECT * FROM reductions WHERE code = '$code'";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $utilise = $row['utilise'];

    if($row && ($utilise == 0 || $utilise == NULL) ){
        $total = $total - $row['reduction'];
        echo '<h4>Montant total apres reduction : ' . $total . ' €</h4>';
    }else if( $utilise == 1) {
        echo '<h4>Code de reduction déja utilisé</h4>';
    }else if(!$row){
        echo '<h4>Code de reduction invalide</h4>';
    }
    mysqli_close($conn);

    $_SESSION['total'] = $total;
    $_SESSION['code'] = $code;
    
    echo '<a href="../paypage/index.php?id='.$reservation['id'].'">Proceder au paiement</a>';
}

?>
