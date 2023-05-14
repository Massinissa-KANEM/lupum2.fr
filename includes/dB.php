<?php

try{
  $bdd = new PDO('mysql:host=141.94.76.8;dbname=lupum2; charset=utf8', 'massi', 'massilupum2', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch(Exception $e){
  die('Erreur : ' . $e->getMessage());
}

?>