<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=141.94.76.8;dbname=lupum2; charset=utf8', 'massi', 'massilupum2', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

$userIdReq = $bdd->prepare('SELECT id_users FROM users WHERE email = ?');
$userIdReq->execute(array($_SESSION["email"]));
$userId = $userIdReq->fetch(PDO::FETCH_ASSOC);

if ($userId !== false) {
    $last_user_log = $bdd->prepare('SELECT pageName FROM log WHERE idUser = ? ORDER BY dateLog DESC LIMIT 1');
    $last_user_log->execute(array($userId['id_users']));
    $last_user_activity = $last_user_log->fetch(PDO::FETCH_ASSOC);

    if ($last_user_activity === false || $last_user_activity['pageName'] != $actual_page) {
        $add_user_log = $bdd->prepare('INSERT INTO log (pageName, idUser) VALUES (?, ?)');
        $add_user_log->execute(array($actual_page, $userId['id_users']));
    }
}