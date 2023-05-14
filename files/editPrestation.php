<title>Modification Profil</title>
<?php 
session_start();
if(!isset($_SESSION['email'])){
  header('location: index.php');
  exit;
}

ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
// include '../includes/userInfo.php';
include '../includes/head.php' ;
$actual_page = 'editActivite.php';
// include '../includes/logVerif.php';
?>

<link rel="stylesheet" href="../CSSs/editActivite.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <button class="cta">
            <a href="adminPrestations.php">Page admin</a>
            <svg viewBox="0 0 13 10" height="10px" width="15px">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button>

        <div class="title container">
            <h1>Modifiez la prestation :</h1> 
        </div>

        <?php 
            include '../includes/dB.php';
            $conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);
            $id = $_GET['id_prestation'];
            $id_activite = $_GET['id_activite'];

            var_dump($id);

            $q = 'SELECT nom, prix FROM prestations WHERE id_prestation = '.$id.'';
            $result = mysqli_query($conn, $q);
            $row = mysqli_fetch_assoc($result);

            $nom = $row['nom'];
            $prix = $row['prix'];

        ?>

        <div class="all container">
            <div class="row">
                <div class="col-md-8 border-right">
                    
                    <div class="col-md-12">
                        <div class="p-3 py-5">
                            <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                    <a href="profil.php" class="link-dark"><h6> Retour au profil</h6></a>
                                </div>
                                <h6 class="text-right">Edit Profile</h6>
                            </div> -->
                            
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row mt-2">
                                    <?php
                                        echo'<div class="col-md-6"><input type="text" name="prenom" placeholder="Prénom" value="' . $nom . '"></div>';
                                        echo'<div class="col-md-6"><input type="number" placeholder="prix" required="" name="prix" min="0" value="' . $prix .'"></div>';
                                    ?>
                                </div>
                                <?php include '../includes/message.php'; ?>
                                <div class="text-right"><button class="change_infos" type="submit">Enregitrer les modifications</button></div>
                            </form>

                            <?php
                                
                                if(isset($_POST['prenom'])){
                                    $nom = $_POST['prenom'];
                                    $prix = $_POST['prix'];
                                    
                                    $q = 'UPDATE prestations SET nom = "'.$nom.'", prix ="' . $prix .'"  WHERE id_prestation = '.$id.'';
                                    $result = mysqli_query($conn, $q);
                                    header('location: adminPrestations.php?id_activite='.$id_activite.'');
                                }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>