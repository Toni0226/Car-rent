<?php

function getStock($id)
{
    global $carsdata;


    $stock=0;
    foreach($carsdata as $car){

        if($car['id']==$id){
            $stock=$car['quantity'];
            break;
        }

    }
    return $stock;
}


function updateStock($id,$stock)
{
    $jsonData = file_get_contents('cars.json');
    $carsdata = json_decode($jsonData, true);

    $new=[];

    foreach($carsdata as $car){

        if($car['id']==$id){
            $car['quantity']=$car['quantity']-$stock;
        }


        $new[]=$car;
    }


    $new = json_encode($new);


    file_put_contents('cars.json',$new);



}


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
    $theValue = addslashes($theValue) ;

    switch ($theType) {
        case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "long":
            $theValue = ($theValue != ""||$theValue==0) ? doubleval($theValue) : "NULL";
            break;
        case "int":
            $theValue = ($theValue != ""||$theValue==0) ? intval($theValue) : "NULL";
            break;
        case "double":
            $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
            break;
        case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
        default:
            $theValue = ($theValue != "") ? $theValue: "NULL";
            break;
    }
    return $theValue;
}

