<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/config.php';
if(isset($_POST['email']) && !empty($_POST['email'])){
	setcookie('email', $_POST['email'], time() + 24 * 60 * 60);
}

if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password2']) || empty($_POST['firstName']) || empty($_POST['lastName'])){
	header('location: inscription.php?message=Vous devez remplir tous les champs.');
	exit;
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	header('location: inscription.php?message=Email invalide.');
	exit;
}

if(strlen($_POST['password']) < 8){
	header('location: inscription.php?message=Le mot de passe doit faire au moins 8 caractères.');
	exit;
}

if($_POST['password'] != $_POST['password2']){
	header('location: inscription.php?message=Veuillez saisir un mot de passe identique pour les 2 champs.');
	exit;
}

// if($_POST['status'] == 'salarié'){
// 	$status = 0; // Salarié
// }else{
// 	$status = 1; // Responsable
// }
$status = 0;

include('../includes/dB.php'); 

$q = 'SELECT id FROM users WHERE email = ?';
$req = $bdd->prepare($q);
$req->execute([$_POST['email']]);

$results = $req->fetchAll(); 

if(count($results) != 0){
	header('location: inscription.php?message=Cet email est déjà utilisé.');
	exit;
}

$q = 'INSERT INTO users (firstName, lastName, email, password1, password2, userStatus) VALUES (:firstName, :lastName, :email, :password1, :password2, :status)';
$req = $bdd->prepare($q);
$result = $req->execute([
    'firstName' => $_POST['firstName'],
    'lastName' => $_POST['lastName'],
    'email' => $_POST['email'],
    'password1' => hash('sha512', $_POST['password']),
    'password2' => hash('sha512', $_POST['password']),
    'status' => $status
]);




// $empreinte = hash('sha512', $mdp);
// $salt = 'hdiufyzq!qitèçdkfgdzifg';
// $empreinteSalee = hash('sha512', $salt . $mdp);


if($result){
	header('location: connexion.php?message=Compte créé avec succès');
	exit;
}
else{
	header('location: inscription.php?message=Erreur lors de l\'inscription.');
	exit;
}


?>