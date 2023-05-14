<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <link rel="stylesheet" href="../CSSs/planning.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="title">
            <h1>Calendrier</h1>
        </div>

        <button class="cta">
            <a href="index_user.php">Page profile</a>
            <svg viewBox="0 0 13 10" height="10px" width="15px">
            <path d="M1,5 L11,5"></path>
            <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </button>

        <div class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <?php
        date_default_timezone_set('Europe/Paris');

        ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require '../src/bootstrap.php';
    require '../src/calendar/month.php';
    require '../src/calendar/reservations.php';
    $pdo = get_pdo();
    $reservations = new calendar\reservations($pdo);

    $month = new calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
    $start = $month->getStartingDay();
    $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
    $weeks = $month->getWeeks();
    $end = (clone $start)->modify("+" . (6 + 7 * ($weeks - 1)) . "days");

    $reservations = $reservations->getReservationsBetweenByDay($start, $end);

?>
    
    <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">

        <h4><?= $month->toString(); ?></h4>
    <div>
        <a href="planning.php?month=<?= $month->previousMonth()->month?>&year=<?=$month ->previousMonth()->year ?>" class="btn btn-primary">&lt;</a>
        <a href="planning.php?month=<?= $month->nextMonth()->month?>&year=<?=$month ->nextMonth()->year?>" class="btn btn-primary">&gt;</a>
    </div>
    </div>

<table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
<?php for($i = 0; $i < $weeks; $i++): ?>
    <tr>
        <?php
        foreach ($month->days as $k => $day):
        $date = (clone $start)->modify("+" . ($k + $i *7) . "days");
        $reservationsForDay = $reservations[$date->format('Y-m-d')] ?? [];
        ?>
        <td class="<?= $month->WithinMonth($date) ? '' : 'calendar__othermonth'; ?>">
            <?php if($i === 0): ?>
            <div class="calendar__weekday"><?= $day; ?></div>
            <?php endif; ?>
            <div class="calendar__day"><?=$date->format('d'); ?></div>
            <?php foreach($reservationsForDay as $reservation): ?>
                <div class="calendar__reservation"> 
                    <?php
                        if ($reservation['reserve'] == 1 || (new DateTime($reservation['fin']))->format('Y-m-d H:i:s') < date('Y-m-d H:i:s')) {
                            echo'<a href="?id=' . $reservation['id'] . '" class="btn btn-danger"> Salle ' . $reservation['nmr_salle'] . '<br>' . (new DateTime($reservation['debut']))->format('H:i') . ' - ' . (new DateTime($reservation['fin']))->format('H:i') . '</a>';
                        }else{
                            echo'<a href="prestations.php?id=' . $reservation['id'] . '" class="btn btn-success"> Salle ' . $reservation['nmr_salle'] . '<br>' . (new DateTime($reservation['debut']))->format('H:i') . ' - ' . (new DateTime($reservation['fin']))->format('H:i') . '</a>';
                        }
                    ?>
                </div>
            <?php endforeach; ?>


        </td>
        <?php endforeach; ?>
    </tr>
        <?php endfor; ?>
    
</table>
        </div>
    </main>
</body>
</html>