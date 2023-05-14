
<div class="error">
    <?php 
    if(isset($_GET['message']) && !empty($_GET['message'])){
        $error = htmlspecialchars($_GET['message']);
        if($error == 'Compte créé avec succès' || $error == 'Informations modifiés avec succès'){
            echo '<div class="alert alert-success">' . $error . '</div>';
        }
        else{
        echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    }
    ?>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>