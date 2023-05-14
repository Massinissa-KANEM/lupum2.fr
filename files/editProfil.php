<title>Modification Profil</title>
<?php 
session_start();
if(!isset($_SESSION['email'])){
  header('location: index.php');
  exit;
}
include '../includes/userInfo.php';
include '../includes/head.php' ;
$actual_page = 'editProfil.php';
// include '../includes/logVerif.php';
?>

<link rel="stylesheet" href="../CSSs/editProfil.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <button class="cta">
            <a href="profil.php">Page profile</a>
            <svg viewBox="0 0 13 10" height="10px" width="15px">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button>

        <div class="title container">
            <h1>Modifiez votre profil :</h1> 
            <!-- <hr> -->
        </div>
        <div class="all container">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="profil_infos d-flex flex-column align-items-center text-center p-3 py-5">
                        <img src="../images/3551739.jpg" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <?php
                            echo '<span class="name font-weight-bold">' . $userInfo[0]['firstName'] . ' ' . $userInfo[0]['lastName'] . '</span>
                                <span class="text-black-50">';
                                
                                if($userInfo[0]['userStatus'] == 1) {
                                    echo '<span class="poste text-black-50">' . "Responsable". '</span>';
                                }else if($userInfo[0]['userStatus'] == 0){
                                    echo '<span class="poste text-black-50">' . "Salarié" . '</span>';
                                    }; 
                                echo '</span></div>';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="p-3 py-5">
                            <!-- <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-row align-items-center back"><i class="fa fa-long-arrow-left mr-1 mb-1"></i>
                                    <a href="profil.php" class="link-dark"><h6> Retour au profil</h6></a>
                                </div>
                                <h6 class="text-right">Edit Profile</h6>
                            </div> -->
                            
                            <form action="verifProfil.php" method="POST" enctype="multipart/form-data">
                                <div class="row mt-2">
                                    <?php
                                        echo'<div class="col-md-6"><input type="text" name="prenom" placeholder="Prénom" value="' . $userInfo[0]['firstName'] . '"></div>
                                                <div class="col-md-6"><input type="text" name="nom" placeholder="Nom" value="' . $userInfo[0]['lastName'] . '"></div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6"><input type="email" name="email" placeholder="Email" value="' . $userInfo[0]['email'] . '"></div>
                                                <div class="col-md-6"><input type="text" name="phone" placeholder="Numero de téléphone" value="' . $userInfo[0]['phone'] . '"></div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-6"><input type="text" name="entreprise" placeholder="entreprise" value="' . $userInfo[0]['entreprise'] . '"></div>
                                                <div class="col-md-6"><input type="text" name="poste" placeholder="poste" value="' . $userInfo[0]['poste'] . '"></div>
                                            </div>';
                                    ?>
                                </div>
                                <?php include '../includes/message.php'; ?>
                                <div class="text-right"><button class="change_infos" type="submit">Enregitrer les modifications</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>