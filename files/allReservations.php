
<div class="row">
    <div class="col-md-8">
        <h3 class="text-center">Users</h3>
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>debut</th>
                <th>fin</th>
                <th>nbr_places</th>
                <th>id_users</th>
                <th>id_activite</th>
            </tr>
            </thead>
            <tbody>

            <?php
            include('../includes/dB.php');
            $q = 'SELECT * FROM reservation';
            $req = $bdd->prepare($q);
            $req->execute();
            $valeure = $req->fetchAll();
            $a = 0;

            while($a < count($valeure)){

            ?><tr>
                <td><?php echo $valeure[$a]['id']; ?></td>
                <td><?php echo $valeure[$a]['name']; ?></td>
                <td><?php echo $valeure[$a]['debut']; ?></td>
                <td><?php echo $valeure[$a]['fin']; ?></td>
                <td><?php echo $valeure[$a]['nbr_places']; ?></td>
                <td><?php echo $valeure[$a]['id_users']; ?></td>
                <td><?php echo $valeure[$a]['id_activite']; ?></td>
                <td>
                    <a class="btn btn-primary btn-sm me-2" href="update_reservation.php?update=<?php echo $valeure[$a]['id']; ?>">Modifier </a>
                    <a class="btn btn-danger btn-sm" href="delete_reservation.php?delete=<?php echo $valeure[$a]['id']; ?>">Supprimer </a>
                </td>

                <?php
                $a = $a + 1;
                } ?>
            </tr>
            </tbody>
        </table>
    </div>