<?php
include "connection.php";

if(isset($_POST['query'])){
    $search_value = '%' . $_POST['query'] . '%'; // Add wildcard characters for a partial search

    // Use a prepared statement to prevent SQL injection
    $search_sql = "SELECT id, product_id, name FROM product WHERE name LIKE ?";

    $stmt = mysqli_prepare($con, $search_sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $search_value); // Bind the parameter
        mysqli_stmt_execute($stmt); // Execute the prepared statement
        mysqli_stmt_bind_result($stmt, $product_id, $product_product_id, $product_name); // Bind the result

        $resultsArray = array();

        while (mysqli_stmt_fetch($stmt)) {
            // Include id, product_id, and name in the results
            $resultsArray[] = array(
                'id' => $product_id,
                'product_id' => $product_product_id,
                'name' => $product_name
            );
        }

        mysqli_stmt_close($stmt);

        // Return the results as JSON
        echo json_encode($resultsArray);
    }
}
?>