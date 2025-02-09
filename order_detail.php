<?php
session_start();
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Confirm Order</title>
    <style>
        .checkout-select {
            font-size: 18px;
        }
    </style>
</head>

<body>
<?php
include('nav.php');
?>
<div id="contenter">

    <?php

    $sql = "select * from orders where  id=" . $_GET['id'];
    $result = mysqli_query($link, $sql);
    @$row = mysqli_fetch_assoc($result);


    ?>

        <div class="order-confirm-content">
            <div class="checkout-info">
                <div class="checkout-title">
                    <h2>Order Information</h2>
                    <a href="index.php">&lt; Back</a>
                </div>
                <div class="checkout-tablehead">
                    <div class="cell itemname">Car</div><div class="cell itemquantity">Quantity</div><div class="cell itemtotal">Subtotal</div>
                </div>
                <ul class="checkout-body">

                    <?php


                    $total=0;
                    $count=0;

                    $sql = "select * from orderitems where orders_id=".$row['id']."  order by id asc ";
                    $result = mysqli_query($link,$sql);
                    while($obj = mysqli_fetch_assoc($result)){
                    ?>
                    <li class='checkout-tablerow'>
                        <div class='cell itemname'><div class='fl'><img src="<?php echo $obj['photo'];?>" width='50' /></div><div class='fl' style='width: 100px'><?php echo $obj['name'];?> <?php echo $obj['uprice'];?> <?php echo $obj['unit'];?></div></div>

                        <div class='cell itemquantity'><?php echo $obj['qty'];?></div>
                        <div class='cell itemtotal'>$ <?php echo $obj['subtotal']; ?></div>
                    </li>

                    <?php
                        $total+=$obj['subtotal'];
                        $count+=$obj['qty'];

                       }
                    ?>
                    <li class='checkout-tablerow'>
                        <div class='cell itemname'>Total</div>
                        <div class='cell itemquantity'><?php echo $count;?></div>
                        <div class='cell itemtotal'>$<?php echo $total; ?></div>
                    </li>
                </ul>
                <div class="checkout-bottom">
                <span>Total:<a style="color:#f74342;">$</a><a class="checkout-bottom-price"><?php echo $row['amount']; ?></a>
                </span>
                </div>
            </div>

            <div class="checkout-content">


                <div class="checkout-select">
                    <h2>Name</h2>

                    <?php echo $row['name']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Phone</h2>

                    <?php echo $row['phone']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Email</h2>

                    <?php echo $row['email']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Startdate</h2>

                    <?php echo $row['startdate']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Enddate</h2>

                    <?php echo $row['enddate']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Driver's license</h2>

                    <?php echo $row['license'] ?>

                </div>



                <div class="checkout-select">
                   Please confirm the order, we will contact you as soon as possible, thank you!
                </div>

                <div class="checkout-select">
                    <a class="confirm btn"  data-id="<?=$row['id']?>" href="javascript://" >Confirm</a>

                    <a  class=" btn" href="index.php">Back</a>

                </div>
            </div>
            <div class="clear"></div>
        </div>


</div>
<?php
include('foot.php');
?>

</body>
</html>
