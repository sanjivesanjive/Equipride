<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    <div class="ec-cart-inner">
        <div class="ec-cart-top">
            <div class="ec-cart-title">
                <span class="cart_title">My Cart</span>
                <button class="ec-close">×</button>
            </div>
            <ul class="eccart-pro-items">
                <?php
                $userid = $_SESSION['admin_id'];
                $sql = "SELECT c.*, p.id AS product_id FROM `cart` c
                INNER JOIN `product` p ON c.pro_id = p.product_id
                WHERE c.`userid` = '$userid' AND c.`status` = '1'";
                $cart_box = mysqli_query($con, $sql) or die(mysqli_error($con));

                if (mysqli_num_rows($cart_box) > 0) {
                    while ($c = mysqli_fetch_array($cart_box)) {

                        ?>
                        <li>
                            <a href="product_details_guest.php?id=<?php echo $c['id'] ?>&product_id=<?php echo $c['pro_id'] ?>" class="sidecart_pro_img">
                                <img src="admin/file/<?php echo $c['s_image'] ?>" alt="product">
                            </a>
                            <div class="ec-pro-content">
                                <a href="product_details_guest.php?id=<?php echo $c['id'] ?>&product_id=<?php echo $c['pro_id'] ?>" class="cart_pro_title">
                                    <?php echo $c['p_name'] ?>
                                </a>
                                £<span class="unitPrice-<?php echo $c['pro_id'] ?>"><?php echo $c['price'] ?></span>
                                <div class="qty-plus-minus">
                                    <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                </div>
                                <a href="#" class="remove">×</a>
                            </div>
                        </li>
                        <?php
                    }
                } else {
                    echo "No items in the cart.";
                }
                ?>
                
            </ul>
            <?php
                if (!empty($c['pro_id'])) {
                    $product_id = $c['pro_id'];
                    $sql = "SELECT id FROM product WHERE product_id=$product_id";
                    $query = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($query);
                    ?>
                    <div class="cart_btn">
                        <a href="cart_guest.php?id=<?php echo $row['id'] ?>&product_id=<?php echo $c['pro_id'] ?>" class="btn btn-primary" style="margin: 25px 0px 0px 100px;">View Cart</a>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>