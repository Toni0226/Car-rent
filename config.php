<?php
error_reporting(0);

// 
define("HOST", 'awseb-e-9qrrxegevc-stack-awsebrdsdatabase-zoqg4gk6bsil.cuosx1v6k7yt.us-east-1.rds.amazonaws.com');
define("USER", 'root');
define("PASS", '12345678');
define("DBNAME", 'assignment2');

$link = @mysqli_connect(HOST, USER, PASS);
if (!$link) {
    echo "<script>alert('Database connection failed!');window.history.back(-1)</script>";
    exit;
}
mysqli_select_db($link, DBNAME);
mysqli_set_charset($link, 'utf8');

// 加载JSON数据
$jsonData = file_get_contents('cars.json');
$carsdata = json_decode($jsonData, true);

// 热门列表
$hotList = [];
foreach ($carsdata as $car) {
    $hotList[] = '"' . $car['carmodel'] . '"';
}

include("functions.php");
?>
