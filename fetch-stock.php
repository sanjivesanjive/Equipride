<?php
require_once "connection.php";

if (isset($_POST['size_query'])) {
    // Check if 'size_query' is set
    $sizeQuery = $_POST['size_query'];

    if ($sizeQuery === 'true') {
        // Perform the PHP code only when 'size_query' is set to 'true'
        if (isset($_POST['product_id']) && isset($_POST['color'])) {
            $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
            $color = mysqli_real_escape_string($con, $_POST['color']);

            // Fetch size options based on the selected color and product ID
            $result = mysqli_query($con, "SELECT * FROM `stock` WHERE `product_id` = '$product_id' AND `type_1` = 'Customer' AND `color` = '$color'");
            
            $options = '<option value="">Please Choose Size</option>'; // Always include the "Please Choose Size" option

            $numRows = mysqli_num_rows($result);

            while ($row = mysqli_fetch_array($result)) {
                $options .= '<option value="' . $row["size"] . '">' . $row["size"] . '</option>';
            }

            // if ($numRows == 1) {
            //     // If there's only one size option, set it as selected
            //     $options = preg_replace('/<option value="([^"]*)">([^>]*)<\/option>/', '<option value="$1" selected>$2</option>', $options);
            // }

            echo $options;
        }
    }
}

if (isset($_POST['quantity_query'])) {
    $quantityQuery = $_POST['quantity_query'];

    if ($quantityQuery === 'true' && isset($_POST['size'])) {
        // Perform the PHP code for fetching quantity
        $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
        $color = mysqli_real_escape_string($con, $_POST['color']);
        $size = mysqli_real_escape_string($con, $_POST['size']);
    
        $result = mysqli_query($con, "SELECT quantity FROM `stock` WHERE `product_id` = '$product_id' AND `type_1` = 'Customer' AND `color` = '$color' AND `size` = '$size'");
    
        if ($row = mysqli_fetch_array($result)) {
            echo $row["quantity"];
        } else {
            echo "Quantity not found";
        }
    }
}
?>
