<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<?php
  require_once '../src/bootstrap.php';
  require_once '../src/calendar/reservations.php';

  $pdo    = get_pdo();
  $reservations = new \calendar\reservations($pdo);

  if (!isset($_GET['id'])){
      header('Location: 404.php');
  }
  $reservation = $reservations->find($_GET['id']);
?>


<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<ul class="reservation-details">
  <li>Date de début : <?=(new DateTime($reservation['debut']))->format('d/m/Y');?> <?= (new DateTime($reservation['debut']))->format('H:i');?></li>
  <li>Date de fin : <?=(new DateTime($reservation['fin']))->format('d/m/Y');?> <?= (new DateTime($reservation['fin']))->format('H:i');?></li>
  <li>Nombre de places : <?= ($reservation['nbr_places']) ?></li>
  <li>Numéro de la salle : <?= ($reservation['nmr_salle']) ?></li>
  <?php 
    include '../includes/dB.php';
    $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

    $q = "SELECT * FROM reservation WHERE id = " . $reservation['id'];
    $req = $bdd->prepare($q);
    $req->execute();
    $user = $req->fetch();

    $debut = $user['debut'];
    $fin = $user['fin'];

    if($user['reserve'] == 1){

            include '../includes/dB.php';
            $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

            $sql = "SELECT activite, total, email_organisateur, date_debut, date_fin, GROUP_CONCAT(email) AS emails FROM commandes WHERE date_debut = '$debut' AND date_fin = '$fin' GROUP BY activite, total, email_organisateur, date_debut, date_fin";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<div class="commande">';
                    echo '<button class="afficher-plus"><ion-icon name="git-branch-outline"></ion-icon></button>';
                    echo '<div class="popup">';
                      echo "<h4>Participants : <ul>";
                      $emails = explode(',', $row["emails"]);
                      foreach ($emails as $email) {
                        echo "<li>" . $email . "</li>";
                      }
                      echo "</ul></h4>";

                      echo "<h4>Organisateur : <p>" . $row["email_organisateur"] . "</p></h4>";
                      echo "<h4>Total : <p>" . $row["total"] . " €</p></h4>";
                    echo '</div>';
                    
                    echo "<h2>Activité : " . $row["activite"] . "</h2>";
                    echo "<h4 class=\"debut\">Date de début : <p>" . $row["date_debut"] . "</p></h4>";
                    echo "<h4 class=\"fin\">Date de fin : <p>" . $row["date_fin"] . "</p></h4>";
                  echo '</div>';
                }
            } else {
                echo "Aucun résultat trouvé.";
            }

            // echo '<a href="liberer.php?id=' . $reservation['id'] . '">Liberer la reservation</a>';
            
            mysqli_close($conn);

    }else if (($user['reserve'] == NULL && ((new DateTime($reservation['fin']))->format('Y-m-d H:i:s') < date('Y-m-d H:i:s'))) || ($user['reserve'] == 0 && ((new DateTime($reservation['fin']))->format('Y-m-d H:i:s') < date('Y-m-d H:i:s')))){
      echo '<li>Non réservée - Date limite dépassée</li>';
    }else if (($user['reserve'] == NULL && ((new DateTime($reservation['fin']))->format('Y-m-d H:i:s') > date('Y-m-d H:i:s'))) || ($user['reserve'] == 0 && ((new DateTime($reservation['fin']))->format('Y-m-d H:i:s') > date('Y-m-d H:i:s')))){
      echo '<li>Non réservée - Toujours disponible</li>';
      echo '<a href="modifReservation.php?id=' . $reservation['id'] . '">modifier la reservation</a>';
    }
  ?>
</ul>

<div class="reservation-actions">
  <a href="delete_reservation.php?id=<?= $reservation['id'] ?>" class="btn btn-danger">Supprimer</a>
</div>