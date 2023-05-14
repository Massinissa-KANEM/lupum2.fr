<?php

if (isset($_GET['update']) && !empty($_GET['update'])) {

    include '../includes/dB.php';

    $id = $_GET['update'];
    $q = 'SELECT * FROM reservation WHERE id = :id';
    $req = $bdd->prepare($q);
    $req->execute([
        'id' => $id
    ]);
    $user = $req->fetch(PDO::FETCH_ASSOC);
    ?>

    <form action="verif_update_reservation.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="name" value="<?php echo $user['name']; ?>">
        <input type="datetime-local" name="debut" value="<?php echo $user['debut']; ?>">
        <input type="datetime-local" name="fin" value="<?php echo $user['fin']; ?>">
        <input type="int" name="nbr_places" value="<?php echo $user['nbr_places']; ?>">
        <input type="int" name="id_users" value="<?php echo $user['id_users']; ?>">
        <input type="int" name="id_activite" value="<?php echo $user['id_activite']; ?>">
        <input type="submit" value="Modifier">
    </form>

    <?php


}