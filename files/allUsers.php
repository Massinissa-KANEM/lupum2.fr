
<html>
<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<?php
if(isset($_GET['message']) && !empty($_GET['message']) && isset($_GET['type'])){
    echo '<div class="alert alert-' . $_GET['type'] . '">' . htmlspecialchars($_GET['message']) . '</div>';
}


?>

<div class="row">
    <div class="col-md-8">
    <h3 class="text-center">Users</h3>
        <table class="table">
            <thead>
    <tr>
                    <th>id</th>
                    <th>email</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>fonction</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include('../includes/dB.php');
                $q = 'SELECT * FROM users';
                $req = $bdd->prepare($q);
                $req->execute();
                $valeure = $req->fetchAll();
                $a = 0;

                while($a < count($valeure)){


                    ?><tr>
                        <td><?php echo $valeure[$a]['id']; ?></td>
                        <td><?php echo $valeure[$a]['email']; ?></td>
                        <td><?php echo $valeure[$a]['firstName']; ?></td>
                        <td><?php echo $valeure[$a]['lastName']; ?></td>
                        <td><?php echo $valeure[$a]['poste']; ?></td>

                        <td>
                            <a class="btn btn-primary btn-sm me-2" href="update_users.php?update=<?php echo $valeure[$a]['id']; ?>">Modifier </a>
                            <a class="btn btn-danger btn-sm" href="delete_users.php?delete=<?php echo $valeure[$a]['id']; ?>">Supprimer </a>
                        </td>

                <?php
                    $a = $a + 1;
                } ?>
            </tr>
            </tbody>
        </table>
</div>

</div>
<div class="col-md-4">
    <h3 class="text-center">Ajouter users</h3>
    <div class="form-group">

        <form action="verif_inscription.php" method="POST">
            <a href="index.php">

            </a>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="name@example.com" required="" name="email">
                <label for="exampleFormControlInput1" class="form-label">Adresse mail</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="nom" placeholder="Votre nom" required="" name="nom">
                <label for="exampleFormControlInput1" class="form-label">Nom</label>
            </div>

            <div class="form-floating">
                <input type="text" class="form-control" id="prenom" placeholder="Votre prénom" required="" name="prenom">
                <label for="exampleFormControlInput1" class="form-label">Prénom</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="name@example.com" required="" name="password">
                <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="password2"  required="" name="password2">
                <label for="exampleFormControlInput1" class="form-label"> Confirmez votre Mot de passe</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="fonction" placeholder="Votre fonction" required="" name="fonction">
                <label for="exampleFormControlInput1" class="form-label">fonction</label>
            </div>

            <button type="submit" class="btn btn-primary">S'inscrire</button>

        </form>
</div></html>