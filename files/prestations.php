
<?php 
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	require_once '../src/bootstrap.php';
	require_once '../src/calendar/reservations.php';

	$pdo = get_pdo();
	$reservations = new \calendar\reservations($pdo);
	
	$reservation = $reservations->find($_GET['id']);
	$participants = array();

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../CSSs/prestations.css">
	<title>Liste déroulante de choix</title>
</head>
<body>
	<div class="bloc">
		<div class="lists">
			<h1>Choisissez une activité :</h1>
			<form class="" method="post">
				<select name="activite" onchange="this.form.submit()">
					<option value="">-- Sélectionnez une activité --</option>
					<?php
					include 'dB.php';
					$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);


					$sql = "SELECT id_activite, nom FROM activites";
					$result = mysqli_query($conn, $sql);

					while ($row = mysqli_fetch_assoc($result)) {
						echo '<option value="' . $row['id_activite'] . '"';
						if (isset($_POST['activite']) && $_POST['activite'] == $row['id_activite']) {
							echo ' selected';
						}
						echo '>' . $row['nom'] . '</option>';
					}

					mysqli_close($conn);
					?>
				</select>
			</form>

			<?php 
			if(isset($_POST['activite'])) {
				$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);


				$sql = "SELECT nom FROM activites WHERE id_activite = " . $_POST['activite'];
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$activite = $row['nom'];

				// echo '<h1>Activité : ' . $activite . '</h1>';
				$_SESSION['nom_activite'] = $activite;
			}
			?>
			
			<?php

			if (isset($_POST['activite'])) {
				include '../includes/dB.php';

				$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);


				$sql = "SELECT id_prestation, nom, prix FROM prestations WHERE id_activite = " . $_POST['activite'];
				$result = mysqli_query($conn, $sql);

				echo '<h1>Prestations disponibles :</h1>';
				echo '<form method="post">';
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<label><input type="checkbox" name="prestations[]" value="' . $row['id_prestation'] . '"> ' . $row['nom'] . ' (' . $row['prix'] . ' €)</label><br>';
						//quantite pour les prestataires
					}

					$sql = "SELECT id_materiel, nom_materiel, prix FROM materiaux WHERE id_activite = " . $_POST['activite'];
					$result = mysqli_query($conn, $sql);

					echo '<h1>Selectionnez votre materiel :</h1>';
					echo '<form method="post">';
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<label><input type="checkbox" name="materiaux[]" value="' . $row['id_materiel'] . '"> ' . $row['nom_materiel'] . ' (' . $row['prix'] . ' €)</label><br>';
					}
					
					echo '<br><input type="submit" value="Valider">';
					
				echo '</form>';
			}
			
			include '../includes/dB.php';

			$conn = mysqli_connect("141.94.76.8", "massi", "massilupum2", "lupum2", 3306);


			$prestations = isset($_POST['prestations']) ? $_POST['prestations'] : [];
			$materiaux = isset($_POST['materiaux']) ? $_POST['materiaux'] : [];

			$_SESSION['prestations'] = $prestations;
			$_SESSION['materiaux'] = $materiaux;

			$total_activite = 0;
			$total_prestations = 0; 
			$total_materiaux = 0;
			$nb_participants = 0;

			foreach ($prestations as $id_prestation) {
				$sql = "SELECT prix FROM prestations WHERE id_prestation = " . $id_prestation;
				$result = mysqli_query($conn, $sql);

				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$total_prestations += $row['prix'];
				} else {
					echo "	Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
				}
			}

			foreach ($materiaux as $id_materiel) {
				$sql = "SELECT prix FROM materiaux WHERE id_materiel = " . $id_materiel;
				$result = mysqli_query($conn, $sql);

				if ($result) {
					$row = mysqli_fetch_assoc($result);
					$total_materiaux += $row['prix'];
				} else {
					echo "	Erreur : " . $sql . "<br>" . mysqli_error($conn) . "<br>";
				}
			}

				

				$total_activite = $total_prestations + $total_materiaux;

				if (isset($_POST['prestations'])) {
					$_SESSION['total_activite'] = $total_activite;
					$_SESSION['total_prestations'] = $total_prestations;
					$_SESSION['total_materiaux'] = $total_materiaux;
					$_SESSION['prestations'] = $prestations;
					$_SESSION['materiaux'] = $materiaux;
					
					header("Location: infos_reservation.php?id=" . $reservation['id']);
					exit;
				}

				// $emails = $_SESSION['emails'];

				// //affichage des emails non vides
				// foreach ($emails as $email) {
				// 	if (!empty($email)) {
				// 		echo $email.'<br>';
				// 	}
				// }
					
			?>
		</div>
		<div class="description">
			<img src="../images/inscription-removebg-preview.png" alt="inscription image">
			<h3>Rejoignez notre communauté de passionnés pour des activités de team building inoubliables !</h3>
			</div>
			<button class="cta">
			<a href="index.php">Accueil</a>
			<svg viewBox="0 0 13 10" height="10px" width="15px">
				<path d="M1,5 L11,5"></path>
				<polyline points="8 1 12 5 8 9"></polyline>
			</svg>
		</div>
	</div>
</body>
</html>