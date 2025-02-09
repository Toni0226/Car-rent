<?php
session_start();

include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="js/jquery-ui-1.13.3.custom/jquery-ui.min.css"/>
    <title>Order</title>
</head>
<body>
<?php
include('nav.php');
?>
<div id="contenter">

        <div class="order-confirm-content">
            <div class="checkout-info" style=" overflow-x: hidden">
                <div class="checkout-title">
                    <h2>Order</h2>
                    <a onclick="JavaScript:history.go(-1);">&lt; Back
                    </a>
                </div>
                <div class="checkout-tablehead">
                    <div class="cell itemname">Car</div><div class="cell itemquantity">Quantity</div><div class="cell itemtotal">Subtotal</div>
                </div>
                <ul class="checkout-body">
                </ul>
                <div class="checkout-bottom">
                <span>Total: <a style="color:#f74342;">$</a><a class="checkout-bottom-price"></a>
                </span>
                </div>
            </div>

            <div class="checkout-content">

                <input  type="hidden" id="subtotal" name="subtotal"  value=""  >
                <input  type="hidden" id="totalqty" name="totalqty"  value=""  >
                <input  type="hidden" id="total" name="total"  value=""  >
                <input  type="hidden" id="days" name="days"  value="0"  >

                <div class="checkout-select">
                    <h2>Name</h2>

                    <input  required class="liuyan-txt" id="name" name="name"  value=""  >

                </div>
                <div class="checkout-select">
                    <h2>Phone</h2>

                    <input  required class="liuyan-txt" id="phone" name="phone"  value=""  >

                </div>
                <div class="checkout-select">
                    <h2>Email</h2>

                    <input  required class="liuyan-txt" id="email" name="email" value=""  >

                </div>
                <div class="checkout-select">
                    <h2>Startdate</h2>

                    <input  required class="liuyan-txt datepicker settotal" id="startdate" name="startdate"  value=""  >

                </div>
                <div class="checkout-select">
                    <h2>Enddate</h2>

                    <input  required class="liuyan-txt datepicker settotal" id="enddate" name="enddate"  value=""  >

                </div>

                <div class="checkout-select">
                    <h2>Driver's license</h2>
                    <select name="license" id="license" required>
                        <option value="">Select</option>
                        <option value="Yes"   >Yes</option>
                        <option value="No"    >No</option>

                    </select>
                </div>

                <div class="checkout-select">
                    <a class="commit-btn btn"  href="javascript://" >Submit</a>

                    <a href="javascript://" class="removeAllItem btn" >Cancel</a>
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
