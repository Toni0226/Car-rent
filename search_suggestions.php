<?php
session_start();

$jsonData = file_get_contents('cars.json');
$carsdata = json_decode($jsonData, true);

$term = strtolower(trim($_GET['term']));
$suggestions = [];

foreach ($carsdata as $car) {
    if (strpos(strtolower($car['carmodel']), $term) !== false || strpos(strtolower($car['brand']), $term) !== false) {
        $suggestions[] = ['name' => $car['carmodel']];
    }
}

echo json_encode($suggestions);
?>
