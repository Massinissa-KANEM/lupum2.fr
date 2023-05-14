
<?php 
session_start();
if(!isset($_SESSION['email'])){
  header('location: index.php');
  exit;
}
include '../includes/userInfo.php';
include '../includes/head.php' ;

$actual_page = 'profil.php';
// include '../includes/logVerif.php';

include '../includes/dB.php';
?>


<script src="js/profil.js" defer></script>
<link rel="stylesheet" href="../CSSs/profil.css">
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<title>Mon profil</title>
</head>
<html>
    <body>
        <!-- <php include '../includes/header.php' ?> -->
      <main>
            <!-- <div class="alert" role="alert">  
            <php
            if($userInfo[0]['mailVerif'] == 0){
            echo '<div class="alert alert-warning" role="alert">';
              $s = 'Mail de verification';
              $mail = $userInfo[0]['usersEmail'];
              echo '<p style="margin:0;">Votre compte n\'est pas activé ! Pour l\'activer avec votre mail ( ' . $userInfo[0]['usersEmail'] . ' ) <button class=\'btn btn-link\' onClick="sendmail(\''.$s.'\',\''.$m.'\',\''.$mail.'\')"> cliquer ici </button> </p>';
              }
            ?>
            </div> -->
          <div class="cont1 container">

            <button class="cta">
              <a href="index_user.php"><ion-icon name="home-outline"></ion-icon>Accueil</a>
              <svg viewBox="0 0 13 10" height="10px" width="15px">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
              </svg>
            </button>
            

            <?php  
            include '../includes/message.php';
            ?>
            <div class="col-lg-5">
              <div class="profil col-lg-12 text-center">
                <a href="deconnexion.php" class="logout"><ion-icon name="log-out-outline"></ion-icon></a>
                <img src="../images/3551739.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                <?php 
                  echo '<h3 class="name">' .  ucfirst(strtolower($userInfo[0]['firstName'])) . ' ' . strtoupper($userInfo[0]['lastName']) . '</h3>';

                  if($userInfo[0]['poste'] == NULL){
                        echo '<p class="poste">' . 'poste' . " - Responsable". '</p>';
                    }else{
                      echo '<p class="poste">' . $userInfo[0]['poste'] . " - Responsable" . '</p>';
                    }
                  
                    if($userInfo[0]['entreprise'] == NULL){
                      echo '<p class="entreprise">Entreprise</p>';
                    }else{
                      echo '<p class="entreprise">' . $userInfo[0]['entreprise'] . '</p>';
                    }

                    echo '<div class="btns d-flex justify-content-center mb-2">';
                      echo '<a href="editProfil.php"><button type="button">Modifier le profil</button></a>';
                      echo '<a class="fidelite" href="fidelite.php"><button type="button">Ma fidélité</button></a>';
                    echo '</div>';
                ?> 
              </div>
            </div>

            <!-- line -->        
            <div class="col-lg-7">
              <div class="infos card-body">
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">Nom complet</p>
                  </div>
                  <div class="col-sm-8">
                    <?php echo '<p class="output text-muted mb-0">' .  ucfirst(strtolower($userInfo[0]['firstName'])) . ' ' . strtoupper($userInfo[0]['lastName']) . '</p>'; ?>
                  </div>
                </div>
                <hr>
                <!-- line -->
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">Email</p>
                  </div>
                  <div class="col-sm-8">
                    <?php echo '<p class="output text-muted mb-0">' . $userInfo[0]['email'] . '</p>'; ?>
                  </div>
                </div>
                <hr>
                <!-- line -->
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">Telephone</p>
                  </div>
                  <div class="col-sm-8">
                    <?php 
                      if($userInfo[0]['phone'] == NULL){
                        echo '<p class="output text-muted mb-0">Telephone</p>';
                      }else{
                        echo '<p class="output text-muted mb-0">' . '0' . $userInfo[0]['phone'] . '</p>';
                      }
                    ?>               
                  </div>
                </div>
                <!-- line -->             
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">Entreprise</p>
                  </div>
                  <div class="col-sm-8">
                    <?php 
                      if($userInfo[0]['entreprise'] == NULL){
                        echo '<p class="output text-muted mb-0">Entreprise</p>';
                      }else{
                        echo '<p class="output text-muted mb-0">' . $userInfo[0]['entreprise'] . '</p>';
                      }
                    ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-4">
                    <p class="mb-0">Poste</p>
                  </div>
                  <div class="col-sm-8">
                  <?php 
                    if($userInfo[0]['poste'] == NULL){
                      echo '<p class="output text-muted mb-0">Poste</p>';
                    }else{
                      if($userInfo[0]['userStatus'] == 1) {
                        echo '<p class="output text-muted mb-0">' . $userInfo[0]['poste'] . " - Responsable". '</p>';
                      }else if($userInfo[0]['userStatus'] == 0){
                        echo '<p class="output text-muted mb-0">' . $userInfo[0]['poste'] . " - Salarié" . '</p>';
                      }
                    }
                  ?>
                </div>
              </div>
            </div>                 
          </div>
        </div>
        
          <div class="container history">
            <h1>Historique des Teams buildings :</h1>
            <hr>
            <div class="all_cards">

              <!-- <div class="card">
                <a href="index.php"><ion-icon name="information-outline"></ion-icon></a>
                <h1 class="title_game">Bowling party</h1>
                <h3>Date : <p>15/02/2023</p></h3>
                <h3>Organisateur : <p>Massinissa KANEM</p></h3>
                <h3>Participants : <p>8</p></h3>
              </div> -->
                    
              <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                include '../includes/dB.php';
                $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);
 
                $sql = "SELECT activite, commande_date, total, email_organisateur, date_debut, date_fin, GROUP_CONCAT(email) AS emails FROM commandes WHERE email_organisateur = ? GROUP BY activite, commande_date, total, email_organisateur, date_debut, date_fin ORDER BY commande_date DESC";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)){
                      $participants = 0;
                      echo '<div class="commande">';
                        echo '<button class="afficher-plus"><ion-icon name="git-branch-outline"></ion-icon></button>';
                        ?>
                        <div class="popup">
                          <div class="popup-header">
                            <h4 class="popup-title">Détails de la commande</h4>
                            <button class="popup-close"><i class="fas fa-times"></i></button>
                          </div>
                          <div class="popup-content">
                            <div class="popup-section">
                              <h4 class="popup-section-title">Date de début :</h4>
                              <p class="popup-section-text"><?php echo $row["date_debut"]; ?></p>
                            </div>
                            <div class="popup-section">
                              <h4 class="popup-section-title">Date de fin :</h4>
                              <p class="popup-section-text"><?php echo $row["date_fin"]; ?></p>
                            </div>
                            <div class="popup-section">
                              <h4 class="popup-section-title">Participants :</h4>
                              <ul class="popup-section-list">
                                <?php
                                  $emails = explode(',', $row["emails"]);
                                  foreach ($emails as $email) {
                                    $participants++;
                                    echo "<li>" . $email . "</li>";
                                  }
                                ?>
                              </ul>
                            </div>
                            <div class="popup-section">
                              <h4 class="popup-section-title">Total :</h4>
                              <p class="popup-section-text"><?php echo $row["total"]; ?> €</p>
                            </div>
                          </div>
                        </div>
                        <?php


                        echo "<h2>" . $row["activite"] . "</h2>";

                        echo '<div class="debut"><h4>Date :</h4><p>' . $row["date_debut"] . '</p></div>';
                        // echo "<h4 class=\"fin\">Date de fin : <p>" . $row["date_fin"] . "</p></h4>";
                        echo '<div class="date"><h4>Commande :</h4><p>' . $row["commande_date"] . '</p></div>';
                        echo '<div class="participants"><h4>Participants :</h4><p>' . $participants . '</p></div>';

                        echo '<form action="pdf.php?commande_date=' . $row["commande_date"] . '" target="_blank" method="post">
                                <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" type="submit" name="telecharger">
                                    <i class="fi fi-rr-file-pdf"></i>
                                </button>
                              </form>';

                      echo '</div>';
                    }
                } else {
                    echo "Aucun résultat trouvé.";
                }
                mysqli_close($conn);
                ?>
            </div>
          </div>   
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script>
            $(document).ready(function(){
              $('.afficher-plus').on('click', function(){
                const popup = $(this).next('.popup');
                popup.toggleClass('visible');
              });
            });
          </script>
      </main>
    </body>
</html>