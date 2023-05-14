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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSSs/paiement_page.css">
    <?php include '../includes/head.php' ?>
    <title>Pay Page</title>
</head>
<body>
<?php $price = $_SESSION['total'] ?>
    

    <div class="bloc">
        <div class="pay">
            
            <form action="./charge.php?id=<?php echo $reservation['id']; ?>" method="post" id="payment-form">
                <?php   if(isset($_GET['message'])): ?>
                    <div class="alert alert-success">
                        <h3 class="text-center"><?php echo $_GET['message']; ?></h3>
                    </div>
                <?php endif; ?>
                <h1 class="text-center">Page de paiement</h1>
                
                <h2>Card number</h2>
                <h4>Entrez les 16 chiffres de votre carte </h4>
                <div class="form-row">
                    <div id="card-element" class="cardnbr form-control" name="carte"></div>
                    <div id="card-errors" role="alert"></div>
                </div>
                <div class="name_bloc">
                    <div class="text">
                        <h2>Votre Nom</h2>
                        <h4>Nom sur la carte </h4>
                    </div>
                    <input type="text"  name="first_name" class="mb-3 StripeElement StripeElement--empty" placeholder="Nom" require> 
                    <input type="text" name="entreprise" class="mb-3 StripeElement StripeElement--empty" placeholder="Entreprise" require>
                </div>
 
                <h2 class="email_title">Votre courriel</h2>
                <h4>Saisissez un email à utilisation régulière</h4>
                <div class="email_bloc form-row">
                    <input type="email" name="email" class="cardnbr mb-3 StripeElement StripeElement--empty" placeholder="addresse Mail " require>
                </div>

                
                
                <button type="submit">Payer Maintenant</button>

                <div class="a_payer">
                    <div class="prix_payer">
                        <div class="text">
                            <h2>Vous devez payer </h2>
                            <!-- <php $total_a_payer = $_GET['price']; ?> -->
                            <h2 class="price"><?php echo $price; ?>  €</h2>
                        </div>
                        <ion-icon name="receipt-outline"></ion-icon>
                    </div>
                </div>
            </form>
        </div>

        <div class="description">
            <img src="../images/pay.png" alt="">
            <h3>Sécurisez vos transactions en ligne avec notre plateforme de paiement fiable !</h3>
        </div>

        <button class="cta">
            <a href="../files/index_user.php">Accueil</a>
            <svg viewBox="0 0 13 10" height="10px" width="15px">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="js/charge.js"></script>
</body>
</html>