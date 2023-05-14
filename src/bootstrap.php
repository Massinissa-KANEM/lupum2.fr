<?php


function dd(...$var){
    foreach ($var as $v){
    echo '<pre>';
    var_dump($v);
    echo '</pre>';}

}



function get_pdo(): PDO{
    return new PDO('mysql:host=141.94.76.8;dbname=lupum2; charset=utf8', 'massi', 'massilupum2', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

}

function h(?string $value): string{
    if ($value === null){
        return '';
    }
    return htmlspecialchars($value);
}