<?php
header("Content-type: text/html; charset=utf-8");//
session_start();//

include('config.php');//


$orderno=date("YmdHis");

$name    = $_POST['name'];
$phone   = $_POST['phone'];
$email   = $_POST['email'];
$license   = $_POST['license'];
$startdate   = $_POST['startdate'];
$enddate  = $_POST['enddate'];
$days  = $_POST['days'];

$amount = $_POST['amount'];
$items = $_POST['items'];
$totalqty = $_POST['totalqty'];



if($amount && $items){



    $arrObj=json_decode($items);
    $flag=1;
    $outofstock="";

    if(empty($arrObj)){
        $obj = new stdClass();
        $obj->code="0";
        $obj->msg="Shopping cart is empty, order failed!";
        echo urldecode(json_encode($obj));
        exit;
    }
    foreach ( $arrObj as $obj ){

        $stock=getStock($obj->itemId);

        if($stock - $obj->count < 0 ){
            $flag=0;
            $outofstock=decodeUnicode($obj->name).",Stock(".$stock.") is insufficient, please readjust";
            break;
        }
    }

    if($flag==0){
        $obj = new stdClass();
        $obj->code="0";
        $obj->msg=$outofstock;
        echo urldecode(json_encode($obj));
        exit;
    }


    $now=time();
    $sql = sprintf("INSERT INTO orders(totalqty,startdate,enddate,orderno,days,amount, name,phone,email,license,addtime,updatetime,status) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
        GetSQLValueString($totalqty, "text"),
        GetSQLValueString($startdate, "text"),
        GetSQLValueString($enddate, "text"),
        GetSQLValueString($orderno, "text"),
        GetSQLValueString($days, "text"),
        GetSQLValueString($amount, "text"),
        GetSQLValueString($name, "text"),
        GetSQLValueString($phone, "text"),
        GetSQLValueString($email, "text"),
        GetSQLValueString($license, "text"),
        GetSQLValueString($now, "text"),
        GetSQLValueString($now, "text"),
        GetSQLValueString('unconfirmed', "text"));




$result = mysqli_query($link, $sql);
$id=mysqli_insert_id($link);
if ($id>0) {


    foreach ( $arrObj as $obj ){




        $sql3 = sprintf("INSERT INTO orderitems(orders_id,product_id,name,photo,price,qty, subtotal) values (%s,%s,%s,%s,%s,%s,%s)",
            GetSQLValueString($id, "text"),
            GetSQLValueString($obj->itemId, "text"),
            GetSQLValueString($obj->name, "text"),
            GetSQLValueString($obj->photo, "text"),
            GetSQLValueString($obj->uprice, "text"),
            GetSQLValueString($obj->count, "text"),
            GetSQLValueString($obj->price, "text"));

            mysqli_query($link, $sql3);

     //   updateStock($obj->itemId,$obj->count);
    }


    $obj = new stdClass();
    $obj->code="1";
    $obj->msg="Order successful, please wait!";
    $obj->order_id=$id;
    echo urldecode(json_encode($obj));
    exit;

}else{
    $obj = new stdClass();
    $obj->code="0";
    $obj->msg="Order failed!";
    echo urldecode(json_encode($obj));
    exit;
}


}


mysqli_close($link);
@mysqli_free_result($result);