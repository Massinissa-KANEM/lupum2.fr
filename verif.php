<?php
 phpinfo();
// // $bdd = new PDO('mysql:host=34.163.125.71;dbname=test; charset=utf8', 'root','Lupum2#2023_');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// try{
//   $bdd = new PDO('mysql:host=141.94.76.8;dbname=lupum2; charset=utf8', 'massi', 'massilupum2', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
// }
// catch(Exception $e){
//   die('Erreur : ' . $e->getMessage());
// }


// //afficher un utilisateur
// $q = 'SELECT * FROM users WHERE id = 3';
// $req = $bdd->prepare($q);
// $req->execute();

// $results = $req->fetchAll();

// if (count($results) == 0) {
//   echo 'Aucun utilisateur trouvé';
//   exit;
// }else {
//   echo 'Utilisateur trouvé';
//   echo '<pre>';
//   print_r($results);
//   echo '</pre>';
// }
// ?>