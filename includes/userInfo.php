<?php

include('dB.php');
$userInfSelect = 'SELECT firstName, lastName, email, userStatus, phone, entreprise, poste FROM users WHERE email = :email';
$req = $bdd->prepare($userInfSelect);
$req->execute([
        'email' => $_SESSION['email']
]);
    $userInfo = $req->fetchAll(); 

    $role = $userInfo[0]['userStatus'];

    // $logReq = $bdd->prepare('SELECT usersEmail,idLog, pageName, dateLog FROM log,users WHERE idUser = usersId ORDER BY dateLog DESC LIMIT 100');
    // $logReq->execute();
    // $log = $logReq->fetchAll(); 

    // $ConReq = $bdd->prepare('SELECT COUNT(idLog) FROM log');
    // $ConReq->execute();
    // $Connexion = $ConReq->fetchAll();

    // $ConCurReq = $bdd->prepare('SELECT COUNT(idLog) FROM log WHERE DATE(dateLog) = CURDATE()');
    // $ConCurReq->execute();
    // $currentConnexion = $ConCurReq->fetchAll(); 

    // $Con30Req = $bdd->prepare('SELECT COUNT(idLog) FROM log WHERE MONTH(dateLog) = ?');
    // $Con30Req->execute(array(date('m')));
    // $connexion30 = $Con30Req->fetchAll(); 

    $userSelect = 'SELECT id, firstName, lastName, email, userStatus, phone, entreprise, poste FROM users ';
    $userReq = $bdd->prepare($userSelect);
    $userReq->execute();

    $user = $userReq->fetchAll(); 

    $idReq = $bdd->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
    $idReq->execute([
        'email' => $_SESSION['email']
    ]); 
    $idUser = $idReq->fetchAll(); 
?>
