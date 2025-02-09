<?php
session_start();
if (!isset($_SESSION["userId"])) {
    $_SESSION["userId"] = session_id();
}

$category = "";
if (!empty($_GET['category'])) {
    $category = trim($_GET['category']);
}

include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Car Rent</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .ui-menu-item .ui-menu-item-wrapper {
            display: flex;
        }
        .ui-state-highlight {
            font-weight: bold;
            background-color: transparent !important; /* 确保移除背景色 */
            color: #000; /* 设置文本颜色 */
        }
    </style>
    <script>
        $(function() {
            $.ui.autocomplete.prototype._renderItem = function(ul, item) {
                var term = this.term.split(' ').join('|');
                var re = new RegExp("(" + term + ")", "gi");
                var t = item.label.replace(re, "<span class='ui-state-highlight'>$1</span>");
                return $("<li>")
                    .append("<div>" + t + "</div>")
                    .appendTo(ul);
            };

            $("#keywords").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "search_suggestions.php",
                        type: "GET",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response($.map(JSON.parse(data), function(item) {
                                return {
                                    label: item.name,
                                    value: item.name
                                };
                            }));
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {
                    window.location.href = "index.php?keywords=" + ui.item.value;
                }
            });
        });
    </script>
</head>
<body>
<?php include('nav.php'); ?>
<div id="contenter">
    <p class="h1">Cars List</p>
    <ul class="piclist">
        <?php
        $list = [];

        $keywords = isset($_GET['keywords']) ? $_GET['keywords'] : '';

        if ($keywords) {
            $keywords = strtolower(trim($keywords));
            $_SESSION['hotkeywords'][] = $keywords;
            $_SESSION['hotkeywords'] = array_unique($_SESSION['hotkeywords']);
        }

        foreach ($carsdata as $car) {
            if ($category && $keywords) {
                if ($category == $car['category'] && (strpos("," . strtolower($car['category']), $keywords) || strpos("," . strtolower($car['brand']), $keywords) || strpos("," . strtolower($car['carmodel']), $keywords))) {
                    $list[] = $car;
                }
            } elseif ($category) {
                if ($category == $car['category']) {
                    $list[] = $car;
                }
            } elseif ($keywords) {
                if (strpos("," . strtolower($car['category']), $keywords) || strpos("," . strtolower($car['brand']), $keywords) || strpos("," . strtolower($car['carmodel']), $keywords)) {
                    $list[] = $car;
                }
            } else {
                $list[] = $car;
            }
        }

        foreach ($list as $row) {
            $flag = $row['quantity'] > 0;
            ?>
            <li class="menu-item" item-id="<?php echo $row['id']; ?>">
                <div class="product_item item-wrap">
                    <div class="product_img">
                        <a href="details.php?id=<?php echo $row['id']; ?>">
                            <img class="photo" src="assets/cars/<?php echo $row['image']; ?>" width="200" height="131"
                                 alt="<?php echo $row['carmodel']; ?>"/>
                        </a>
                    </div>
                    <div class="product_text item-detail">
                        <h4><a href="details.php?id=<?php echo $row['id']; ?>" class="storename name"><?php echo $row['carmodel']; ?></a></h4>
                        <h5>$ <span class="price" item-price="<?php echo $row['price']; ?>"><?php echo $row['price']; ?></span> / <span class="unit">Day</span></h5>
                        Quantity: <span class="stock" item-stock="<?php echo $row['quantity']; ?>"><?php echo $row['quantity']; ?></span>
                        <?php if ($flag) { ?>
                            <img class="buy" src="images/icon_buy.png">
                        <?php } else { ?>
                            <img src="images/icon_buy_out.png">
                        <?php } ?>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>

    <?php if (empty($list)) { ?>
        <div style="color: #ff0000; text-align: center">No Record</div>
    <?php } ?>
</div>
<?php include('foot.php'); ?>
</body>
</html>
