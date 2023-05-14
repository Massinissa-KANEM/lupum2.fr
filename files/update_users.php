<?php

if (isset($_GET['update']) && !empty($_GET['update'])) {

    include '../includes/dB.php';

    $id = $_GET['update'];
    $q = 'SELECT * FROM users WHERE id = :id';
    $req = $bdd->prepare($q);
    $req->execute([
        'id' => $id
    ]);
    $user = $req->fetch(PDO::FETCH_ASSOC);
    ?>

    <form action="verif_update_users.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="email" value="<?php echo $user['email']; ?>">
        <input type="text" name="nom" value="<?php echo $user['lastName']; ?>">
        <input type="text" name="prenom" value="<?php echo $user['firstName']; ?>">
        <input type="text" name="fonction" value="<?php echo $user['poste']; ?>">
        <input type="submit" value="Modifier">
    </form>

    <?php


}