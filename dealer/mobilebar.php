    <div class="ec-nav-toolbar">
        <div class="container">
            <div class="ec-nav-panel">
                <div class="ec-nav-panel-icons">
                    <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><i
                            class="fi-rr-menu-burger"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                <?php 
                                        $userid = $_SESSION['guest_id'];
                                        $cart =mysqli_query($con,"SELECT * FROM `cart` WHERE `userid` = '$userid' AND `status`= '1'") or die(mysqli_error($con));
                                        $c = mysqli_num_rows($cart);
                                        // print_r($w);
                                        ?>
                    <a href="#ec-side-cart" class="toggle-cart ec-header-btn ec-side-toggle"><i
                            class="fi-rr-shopping-bag"></i><span
                            class="ec-cart-noti ec-header-count cart-count-lable"><?php echo $c ?></span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="dealer_panal.php" class="ec-header-btn"><i class="fi-rr-home"></i></a>
                </div>
                <div class="ec-nav-panel-icons">
                <?php 
                            $userid = $_SESSION['guest_id'];
                            $wishlist =mysqli_query($con,"SELECT * FROM `wishlist` WHERE `type` = 'Dealer' AND `userid` = '$userid'") or die(mysqli_error($con));
                            $w = mysqli_num_rows($wishlist);
                            ?>
                    <a href="wishlist.php" class="ec-header-btn"><i class="fi-rr-heart"></i><span
                            class="ec-cart-noti"><?php echo $w ?></span></a>
                </div>
                <div class="ec-nav-panel-icons">
                    <a href="login.php" class="ec-header-btn"><i class="fi-rr-user"></i></a>
                </div>

            </div>
        </div>
    </div>