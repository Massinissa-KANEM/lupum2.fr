<?php

namespace calendar;


use PDO;

class reservations{

public function __construct(PDO $pdo){

    $this->pdo = $pdo;



}

    public function getReservationsBetween(\DateTime $start, \DateTime $end): array{

        $bdd = new PDO('mysql:host=141.94.76.8;dbname=lupum2; charset=utf8', 'massi', 'massilupum2', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$sql = "SELECT * FROM reservation WHERE debut BETWEEN '{$start->format('Y-m-d 00:00:00')}' AND '{$end->format('Y-m-d 23:59:59')}'";

$statement = $this->pdo->query($sql);
$results = $statement->fetchAll();


return $results;

}

    public function getReservationsBetweenByDay(\DateTime $start, \DateTime $end): array{

        $reservations = $this->getReservationsBetween($start, $end);
        $days = [];
        foreach($reservations as $reservation){
            $date = explode(' ', $reservation['debut'])[0];
            if(!isset($days[$date])){
                $days[$date] = [$reservation];
            }else{
                $days[$date][] = $reservation;
            }
        }
        return $days;
    }


    public function find(int $id): array
    {


        return  $this->pdo->query("SELECT * FROM reservation WHERE id = $id LIMIT 1")->fetch();

    }

}