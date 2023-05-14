<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])){
    
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        
        $allowed_extensions = array("jpg", "png");
        $file_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        if(in_array($file_extension, $allowed_extensions)){
            
            $image = $_FILES["image"]["tmp_name"];
            $imgContent = addslashes(file_get_contents($image));
 
            $sql = "UPDATE users SET profile_image = '$imgContent' WHERE id = ?";
             
            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("i", $param_id);
                $param_id = $_SESSION["id"];
                if($stmt->execute()){
                    header("location: profile.php");
                } else{
                    echo "Une erreur s'est produite. Veuillez réessayer plus tard.";
                }
                $stmt->close();
            }
        } else{
            echo "Les types de fichiers autorisés sont : jpg, png.";
        }
    } else{
        echo "Le fichier n'est pas une image.";
    }
}
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer la photo de profil</title>
</head>
<body>
    <h2>Changer la photo de profil</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*">
        <br><br>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>