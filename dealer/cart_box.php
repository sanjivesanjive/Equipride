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
                    $cart_box = mysqli_query($con, "SELECT * FROM `cart` WHERE `userid` = '$userid' AND `status`= '1' ") or die(mysqli_error($con));
                        if (mysqli_num_rows($cart_box) > 0) {
                        while ($c = mysqli_fetch_array($cart_box)) {
                            ?>
                    <li>
                        <a href="product_details.php?id=<?php echo $c['id'] ?>&&product_id=<?php echo $c['pro_id'] ?>" class="sidecart_pro_img"><img
                                src="../admin/file/<?php echo $c['s_image'] ?>" alt="product"></a>
                        <div class="ec-pro-content">
                            <a href="product_details.php?id=<?php echo $c['id'] ?>&&product_id=<?php echo $c['pro_id'] ?>" class="cart_pro_title"><?php echo $c['p_name'] ?></a>
                            £<span class="unitPrice-<?php echo $c['pro_id'] ?>"><?php echo $c['price'] ?></span>
                            <div class="qty-plus-minus">
                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                            </div>
                            <a href="#" class="remove">×</a>
                        </div>
                    </li>
                    <?php }} ?>
                </ul>
            </div>
            <div class="ec-cart-bottom">
                <!-- <div class="cart-sub-total">
                    <table class="table cart-table">
                        <tbody>
                            <tr>
                                <td class="text-left">Sub-Total :</td>
                                <td class="text-right">$300.00</td>
                            </tr>
                            <tr>
                                <td class="text-left">VAT (20%) :</td>
                                <td class="text-right">$60.00</td>
                            </tr>
                            <tr>
                                <td class="text-left">Total :</td>
                                <td class="text-right primary-color">$360.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
                <!-- <div class="cart_btn">
                    <a href="cart.html" class="btn btn-primary">View Cart</a>
                    <a href="checkout.html" class="btn btn-secondary">Checkout</a>
                </div> -->
            </div>
        </div>
    </div>