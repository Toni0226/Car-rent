<div id="nav">
    <div class="nav-box">
        <div class="sort" >
            <div></div>
            <form action="index.php" id="searchForm" method="get">
                <div class="ui-widget" style="display: inline-block"> <input type="text" name="keywords" id="keywords" placeholder="Search..."
                       value="<?php echo isset($_GET['keywords']) ? $_GET['keywords'] : ''; ?>">
                </div>
                <input type="hidden" name="category"  value="<?php echo $category; ?>" >

                <input type="submit" value="Go">
            </form>


        </div>

        <div class="nav-body">
            <a href="index.php" class="logo">
                <img src="images/logo.png" alt="Logo" style="height: 20px; vertical-align: middle;">
                Car Rent
            </a>
            
            <div class="nav-banner">
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">Cars  </a>
                            <ul>
                                <li><a href="index.php?category=Sedan"  >Sedan</a></li>
                                <li><a href="index.php?category=SUV"  >SUV</a></li>
                                <li><a href="index.php?category=Sports Car"  >Sports Car</a></li>

                            </ul>
                        </li>
                        <li><a href="index.php">Brand  </a>
                            <ul>
                                <li><a href="index.php?keywords=Audi"  >Audi</a></li>
                                <li><a href="index.php?keywords=BMW"  >BMW</a></li>
                                <li><a href="index.php?keywords=Ferrari"  >Ferrari</a></li>
                                <li><a href="index.php?keywords=Honda"  >Honda</a></li>
                                <li><a href="index.php?keywords=Hyundai"  >Hyundai</a></li>
                                <li><a href="index.php?keywords=Mahindra"  >Mahindra</a></li>

                            </ul>
                        </li>
                        <li><a href="order.php">Order</a></li>
                    </ul>
                </nav>

                <div class="hots">
                    <?php if(isset($_SESSION['hotkeywords'])){ ?>
                 Recnet:
                        <?php foreach($_SESSION['hotkeywords'] as $kk){ ?>
                        <a href="javascript://" class="hot"><?=$kk?></a>     <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

