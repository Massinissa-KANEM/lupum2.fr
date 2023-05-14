<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['email'])){
  header('location: index.php');
  exit;
}
include '../includes/userInfo.php';
include '../includes/head.php';
include '../includes/dB.php';
?>
<head>
    <title>Fidélité</title>
    <link rel="stylesheet" href="../CSSs/fidelite.css">
</head>
<?php
$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);

$email = $_SESSION['email'];

$fidelite = "SELECT fidelite FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $fidelite);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$fidelite = mysqli_fetch_assoc($result);

$fidelite = $fidelite['fidelite'];

?>

<h1 class="text-center">Votre fidélité</h1>



<div class="all">
  <?php
  $tab = "SELECT * FROM reductions WHERE email = ?";
  $stmt = mysqli_prepare($conn, $tab);
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
      echo '<div class="codes">';
      echo '<h2> Vos codes de réduction sont : </h2>';
      //tableau 
      echo '<table class="table table-striped">';
      echo '<thead>';
      echo '<tr>';
      echo '<th scope="col">Code</th>';
      echo '<th scope="col">Réduction</th>';
      echo '<th scope="col">Utilisé</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td><button class="btn btn-link show-code" data-code="' . $row['code'] . '">Afficher le code</button></td>';
          echo '<td>' . $row['reduction'] . '€</td>';
          if ($row['utilise'] == 0) {
              echo '<td>Non</td>';
          } else {
              echo '<td>Oui</td>';
          }
          echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';
  }

  echo '<div class="fidelite">';
        echo '<img src="../images/logo_lupum.png" alt="fidelite">';
        echo '<div class="cartes">';
          for ($i = 0; $i < $fidelite; $i++) {
            echo '<input type="text" id="fidelite" value="🌟" disabled>';
          }
          $reste = 6 - $fidelite;
          for ($i = 0; $i < $reste; $i++) {
              echo '<input type="text" id="fidelite" value="⚫" disabled>';
          }
        echo '</div>';
  echo '</div>';

  if ($fidelite >= 6) {
      $code = substr(md5(uniqid(rand(), true)), 0, 6);
      $code = strtoupper($code);

      $q = "INSERT INTO reductions (code, reduction, email) VALUES (?, 250, ?)";
      $stmt = mysqli_prepare($conn, $q);
      mysqli_stmt_bind_param($stmt, "ss", $code, $email);
      $result = mysqli_stmt_execute($stmt);

      if ($result && mysqli_affected_rows($conn) > 0) {
          echo '<h2> Votre code de réduction est : <span id="code">' . $code . '</span></h2>';
      } else {
          echo "Erreur lors de la création du code de réduction : " . mysqli_error($conn);
      }

      $q = "UPDATE users SET fidelite = 0 WHERE email = ?";
      $stmt = mysqli_prepare($conn, $q);
      mysqli_stmt_bind_param($stmt, "s", $email);
      $result = mysqli_stmt_execute($stmt);
  }
  ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('.show-code').click(function() {
    var code = $(this).data('code');
    if ($(this).text() == code) {
      $(this).text('Afficher le code');
    } else {
      $(this).text(code);
    }
  });
});
</script>