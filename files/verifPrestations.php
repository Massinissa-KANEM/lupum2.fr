<!-- <php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../includes/head.php';
$actual_page = 'prestations.php';
include '../includes/dB.php';

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=lupum2; charset=utf8', 'root', 'root', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$activite = $_POST['activite'];

echo '<h1>Choisissez une prestation :</h1>';
switch ($activite) {
	case 'escape_game':
		$stmt = $pdo->query('SELECT * FROM prestations_escape_game');
		break;
	case 'evenements_caritatifs':
		$stmt = $pdo->query('SELECT * FROM prestations_evenements_caritatifs');
		break;
    case 'karaoké_chorégraphie_théâtre':
        $stmt = $pdo->query('SELECT * FROM prestations_karaoke_choregraphie_theatre');
        break;
    case 'realite_virtuelle':
        $stmt = $pdo->query('SELECT * FROM prestations_realite_virtuelle');
        break;
    case 'creation_artistique':
        $stmt = $pdo->query('SELECT * FROM prestations_creation_artistique');
        break;
    case 'competition_sportive':
        $stmt = $pdo->query('SELECT * FROM prestations_competition_sportive');
        break;
    case 'apero_cocktail_repas':
        $stmt = $pdo->query('SELECT * FROM prestations_apero_cocktail_repas');
        break;
    case 'atelier_culinaire':
        $stmt = $pdo->query('SELECT * FROM prestations_atelier_culinaire');
        break;
    case 'tournoi_babyfoot_ping_pong_autre':
        $stmt = $pdo->query('SELECT * FROM prestations_tournoi_babyfoot_ping_pong_autre');
        break;
    case 'jeux_de_societe':
        $stmt = $pdo->query('SELECT * FROM prestations_jeux_de_societe');
        break;
    case 'randonnee':
        $stmt = $pdo->query('SELECT * FROM prestations_randonnee');
        break;
    case 'voyage_weekend':
        $stmt = $pdo->query('SELECT * FROM prestations_voyage_weekend');
        break;
    default:
        echo 'Activité non reconnue';
        $stmt = null;
        break;
    }
            
    if ($stmt) {
        echo '<form action="traitement3.php" method="post">';
            echo '<select name="prestation">';
                while ($row = $stmt->fetch()) {
                    echo '<option value="'.$row['id'].'">'.$row['nom'].' - '.$row['prix'].'€</option>';
                }
            echo '</select>';
            echo '<input type="hidden" name="activite" value="'.$activite.'">';
            echo '<input type="submit" value="Choisir">';
        echo '</form>';
        $pdo = null;
    }
?> -->