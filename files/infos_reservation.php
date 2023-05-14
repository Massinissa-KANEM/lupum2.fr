<?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  // session_start();

  // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //   $emails = $_POST['emails'];
  //   $_SESSION['emails'] = $emails;
  //   header('Location: validate_reservation.php');
  //   exit();
  // }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link href="../CSSs/infos_reservation.css" rel="stylesheet">
  <title>infos reservation</title>
  <script src="../js/transition.js"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
  <main>
    <?php 
      include '../includes/head.php';
      require_once '../src/bootstrap.php';
      require_once '../src/calendar/reservations.php';

      $pdo = get_pdo();
      $reservations = new \calendar\reservations($pdo);
      
      $reservation = $reservations->find($_GET['id']);
      $participants = array();

    ?>
    
    <div class="infos">
      <h1>Liste Team building</h1>
      <h3>Date :&nbsp;<p><?=(new DateTime($reservation['debut']))->format('d/m/Y');?>&nbsp;&nbsp;&nbsp;<?= (new DateTime($reservation['debut']))->format('H:i');?> - <?= (new DateTime($reservation['fin']))->format('H:i');?></p></h3>   
      <h4>Salle N°:&nbsp;<p><?= ($reservation['nmr_salle']) ?></p></h4>
    </div>

    <div class="cadre">
    <form method="POST" action="resume_commande.php?id=<?php echo $reservation['id']; ?>">
        <div id="participant_emails">
          <button type="button" id="add_email_button"><ion-icon name="add-circle-outline"></ion-icon>Ajoutez les participants</button>
          <?php
            // nombre maximum d'emails à afficher
            $nbr_input = ($reservation['nbr_places']);

            // affichage des champs email
            for ($i = 1; $i <= $nbr_input; $i++) {
                echo '<input type="email" class="participant_email" id="email_'.$i.'" name="emails[]" placeholder="Email du participant '.$i.'">';
            }
          ?>
          <div class="submit"><button type="submit" class="valider">Enregistrer</button></div>
        </div>
      </form>
    </div>
    
    <script>

  const form = document.querySelector('form');
  const emailInputs = document.querySelectorAll('.participant_email');

  form.addEventListener('submit', function(event) {

    let isEmailFieldsEmpty = true;
    emailInputs.forEach(function(input) {
      if (input.value !== '') {
        isEmailFieldsEmpty = false;
      }
    });

    if (isEmailFieldsEmpty) {
      event.preventDefault();
      alert('Veuillez ajouter au moins une adresse e-mail');
      return;
    }

    let emails = [];
    let duplicateEmails = [];
    emailInputs.forEach(function(input) {
      if (input.value !== '') {
        if (emails.includes(input.value)) {
          duplicateEmails.push(input.value);
        } else {
          emails.push(input.value);
        }
      }
    });

    if (duplicateEmails.length > 0) {
      event.preventDefault();
      let message = 'Vous avez saisi plusieurs fois l\'adresse e-mail suivante : ' + duplicateEmails.join(', ');
      alert(message);
      return;
    }
  });
</script>
    

  </main>
</body>
</html>
