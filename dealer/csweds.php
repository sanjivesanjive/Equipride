<div class="ec-single-quickview">
                                                <a href="#" class="ec-btn-group quickview" data-link-action="quickview"
                                                    title="Quick view" data-bs-toggle="modal"
                                                    data-bs-target="#ec_quickview_modal<?php echo $product_id ?>"><i class="fi-rr-eye"></i></a>
                                            </div>
                                            <!-- Modal -->
    <div class="modal fade" id="ec_modal<?php echo $product_id ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="quickview-pro-content">
                                <h5 class="ec-quick-title"><a href="product-left-sidebar.html">Product Name : <?php echo $pd['name'] ?></a>
                                </h5>

                                <div class="ec-quickview-desc"><?php echo $pd['description'] ?></div>
                                <div class="ec-pro-variation">
                                    <!-- <div class="ec-pro-variation-inner ec-pro-variation-color">
                                        <span>Color</span>
                                        <div class="ec-pro-color">
                                            <ul class="ec-opt-swatch">
                                                <li><span style="background-color:#696d62;"></span></li>
                                                <li><span style="background-color:#d73808;"></span></li>
                                                <li><span style="background-color:#577023;"></span></li>
                                                <li><span style="background-color:#2ea1cd;"></span></li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <div class="ec-pro-variation-inner ec-pro-variation-size ec-pro-size">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Size</th>
                                                    <th>Color</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                        $image = mysqli_query($con, "SELECT * FROM `stock` WHERE  `sub_category`='$subcategoy' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                                        if (mysqli_num_rows($image) > 0) {
                                                        while ($i = mysqli_fetch_array($image)) {
                                                    ?>  
                                                    <tr>
                                                        <td><?php echo $i['size'] ?></td>
                                                        <td>
                                                            <?php echo $i['color'] ?>
                                                            <!-- <td><input class=" btn-primary" type="number" name="ec_qtybtn" value="<?php echo $i['quantity'] ?>"  /></td> -->
                                                    </td>
                                                    </tr>
                                                <?php }} ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <?php
                                                        $image = mysqli_query($con, "SELECT * FROM `stock` WHERE  `sub_category`='$subcategoy' AND `type_1`='Dealer'") or die(mysqli_error($con));
                                                  $i = mysqli_fetch_array($image);
                                                    ?>
                                        stock : <?php echo $i['quantity'] ?>
                                <div class="ec-quickview-qty">
                                    <div class="qty-plus-minus">
                                        <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                    </div>
                                    <div class="ec-quickview-cart ">
                                        <button class="btn btn-primary"><i class="fi-rr-heart"></i> Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->