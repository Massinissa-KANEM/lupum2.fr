<?php
    
    $emails = $_POST['emails'];
    //affichage des emails non vides
    foreach ($emails as $email) {
        if (!empty($email)) {
            echo $email.'<br>';
        }
    }

    //nombre de participants (emails non vides)
    $nbr_participants = 0;
    foreach ($emails as $email) {
        if (!empty($email)) {
            $nbr_participants++;
        }
    }
    echo 'Nombre de participants : '.$nbr_participants.'<br>';

    $nbr_places = count($emails);
    echo 'Nombre de participants : '.$nbr_places.'<br>';

    
?>