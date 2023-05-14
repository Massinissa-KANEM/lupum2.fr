<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


	if(isset($_POST['email']) && !empty($_POST['email'])){
		setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
	}

	if(empty($_POST['email']) || empty(htmlspecialchars($_POST['password']))){
		header('location: connexion.php?message=Vous devez remplir les 2 champs'); 
		exit;
	}


	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		header('location: connexion.php?message=Email invalide');
		exit;
	}

	include('../includes/dB.php'); 

	$q = 'SELECT id FROM users WHERE email = :email AND password1 = :password';
	$req = $bdd->prepare($q);
	$req->execute([
					'email' => $_POST['email'],
					'password' => hash('sha512', $_POST['password'])
				]);
	$results = $req->fetchAll(); 

	if(count($results) == 0){
		header('location: connexion.php?message=Identifiants incorrects'); 
		exit;
	}



	// $q = 'SELECT id FROM users WHERE email = :email AND password1 = :password1';
	// $req = $bdd->prepare($q);
	// $req->execute([
	// 	'email' => $_POST['email'],
	// 	'password1' => hash('sha512', $_POST['password1'])
	// ]);
	// $results = $req->fetchAll(); 

	session_start();
	$_SESSION['email'] = $_POST['email'];

	$q = 'SELECT userStatus FROM users WHERE email = :email';
	$req = $bdd->prepare($q);
	$req->execute([
		'email' => $_POST['email']
	]);
	$userStatus = $req->fetchColumn();

	if($userStatus == 1){
		header('location: adminUsers.php');
		exit;
	}else if($userStatus == 0){
		header('location: index_user.php');
		exit;
	}
?>
