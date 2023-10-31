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
                // Construct the SQL query to select cart items
                $sql = "SELECT c.*, p.id AS product_id FROM `cart` c
                INNER JOIN `product` p ON c.pro_id = p.product_id
                WHERE c.`userid` = '$userid' AND c.`status` = '1'";

                // Execute the SQL query
                $cart_box = mysqli_query($con, $sql) or die(mysqli_error($con));

                // Check if there are rows returned
                if (mysqli_num_rows($cart_box) > 0) {
                    // Create an array to store product details
                    $productDetails = array();

                    // Iterate through the cart items and display them
                    while ($c = mysqli_fetch_array($cart_box)) {
                        // Store relevant product details in the array
                        $productDetails[] = array(
                            'product_id' => $c['product_id'],
                            'pro_id' => $c['pro_id'],
                            'p_name' => $c['p_name'],
                            'price' => $c['price'],
                            's_image' => $c['s_image']
                        );
                        ?>
                        <li>
                            <a href="product_details_guest.php?id=<?php echo $c['product_id'] ?>&product_id=<?php echo $c['pro_id'] ?>" class="sidecart_pro_img">
                                <img src="admin/file/<?php echo $c['s_image'] ?>" alt="product">
                            </a>
                            <div class="ec-pro-content">
                                <a href="product_details_guest.php?id=<?php echo $c['product_id'] ?>&product_id=<?php echo $c['pro_id'] ?>" class="cart_pro_title">
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
            // Now, you can access the product details and generate the "View Cart" link
            if (!empty($productDetails)) {
                $firstProduct = $productDetails[0]; // You can choose the first product or any other as needed
                ?>
                <div class="cart_btn">
                    <a href="cart_guest.php?id=<?php echo $firstProduct['product_id'] ?>&product_id=<?php echo $firstProduct['pro_id']?>" class="btn btn-primary" style="margin: 25px 0px 0px 100px;">View Cart</a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>