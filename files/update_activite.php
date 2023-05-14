<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['update']) && !empty($_GET['update'])) {

    include '../includes/dB.php';

    $id = $_GET['update'];
    $q = 'SELECT * FROM activites WHERE id_activite = :id';
    $req = $bdd->prepare($q);
    $req->execute([
        'id' => $id
    ]);
    $user = $req->fetch(PDO::FETCH_ASSOC);
    ?>

    <form action="verif_update_activite.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $user['id_activite']; ?>">
        <input type="text" name="nom" value="<?php echo $user['nom']; ?>">
        <input type="int" name="numero" value="<?php echo $user['numero']; ?>">
        <input type="submit" value="Modifier">
    </form>

    <?php


}