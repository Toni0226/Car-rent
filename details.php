<?php
session_start();
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Car Detail</title>
</head>
<body>
<?php
include('nav.php');
?>
<div id="contenter">

    <div class="sort" style="margin-bottom: 20px">
        <h3>Car Detail</h3>
        <a href="index.php" class="back">Back</a>
    </div>
    <div id="contenter">
        <?php

        $id=$_GET['id'];

        $row=[];

        foreach($carsdata as $car){
            if($car["id"]==$id){
                $row=$car;
                break;
            }
        }



        $now=time();


        $flag=true;
        if($row['quantity']<=0){
            $flag=false;
        }




        ?>
        <div class="top">
            <img src="assets/cars/<?php echo $row['image']; ?>" width="400"  height="280" id="bigimg"/>
            <div class="main menu-item" item-id="<?php echo $row['id']; ?>">
                <div class="item-wrap">
                    <p class="desc">Category: <a href="index.php?category=<?php echo $row['category'];?>" ><?php echo $row['category']; ?></a></p>
                    <p class="desc">Brand: <?php echo $row['brand']; ?></p>
                    <p class="desc">Car Model: <span class="storename name"><?php echo $row['carmodel']; ?></span> </p>
                    <p class="desc">Mileage: <?php echo $row['mileage']; ?></p>
                    <p class="desc">Seats: <?php echo $row['seats']; ?></p>
                    <p class="desc">Fuel Type: <?php echo $row['fueltype']; ?></p>
                    <p class="desc">Quantity: <span class="stock"  item-stock="<?php echo $row['quantity']; ?>" ><?php echo $row['quantity']; ?></span></p>

                    <p class="desc">Description: <?php echo $row['description']; ?></p>
                <div class="bottom">
                    <p class="price"  item-price="<?php echo $row['price']; ?>">$ <?php echo $row['price']; ?> / Day</p>

                    <br>
                    <div  style="clear: both"></div>
                    <?php if($flag){ ?>   <a data-photo="assets/cars/<?php echo $row['image']; ?>" href="javascript://" class=" buy buybtn">Order Now</a>
                    <?php } ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('foot.php');
?>


</body>
</html>
