<html>
<head>
    <meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="/css/calendrier.css">
</head>
<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<nav>

<nav class="navbar navbar-dark bg-primary mb-3">
     <a href="calendrier.php" class="navbar-brand">Calendrier</a>
</nav>

<?php
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
        <h1><?= $month->toString(); ?></h1>
    <div>
        <a href="calendrier.php?month=<?= $month->previousMonth()->month?>&year=<?=$month ->previousMonth()->year ?>" class="btn btn-primary">&lt;</a>
        <a href="calendrier.php?month=<?= $month->nextMonth()->month?>&year=<?=$month ->nextMonth()->year?>" class="btn btn-primary">&gt;</a>
    </div>
    </div>

<style>
    .calendar__table{
        width: 600px;
        height: 400px;
        font-size: 14px;
    }

    .calendar__table td {
        padding: 10px;
        border: 1px solid #ccc;
        vertical-align: top;
        height: 20%;


    }
    .calendar__table--5weeks td{
        height: calc(100% / 5);
    }

    .calendar__weekday{
        font-weight: bold;
        color: #000;
        font-size: 1.2em;
    }

    .calendar__othermonth .calendar__day{
        opacity: 0.3;
    }
</style>

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

                <?= (new DateTime($reservation['debut']))-> format('H:i:s') ?> - <a href="reservation.php?id=<?= $reservation['id'];?>" ><?= h($reservation['name']); ?></a>
            </div>
            <?php endforeach; ?>


        </td>
        <?php endforeach; ?>
    </tr>
        <?php endfor; ?>

</table>

</body>
</html>