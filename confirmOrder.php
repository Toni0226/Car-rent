<?php
header("Content-type: text/html; charset=utf-8");//
session_start();//

include('config.php');//


$orderno=date("YmdHis");

$id    = $_POST['id'];



if($id ){



    $sql = sprintf("update orders set status=%s where id=%s",
        GetSQLValueString('confirmed', "text"),
        GetSQLValueString($id, "text"));
    $result = mysqli_query($link, $sql);


    $sql = "select * from orderitems where orders_id=".$id."  order by id asc ";
    $result = mysqli_query($link,$sql);
    while($obj = mysqli_fetch_assoc($result)){
        updateStock($obj['product_id'],$obj['qty']);
    }


    $obj = new stdClass();
    $obj->code="1";
    $obj->msg="Confirm successful!";
    $obj->order_id=$id;
    echo urldecode(json_encode($obj));
    exit;


}


mysqli_close($link);
@mysqli_free_result($result);