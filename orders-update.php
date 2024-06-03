<?php
// Start session if not already started
session_start();

// Include database connection
require 'connection.php';
$conn = Connect();

// Check if the form was submitted
if (isset($_POST['confirm_order'])) {
    // Check if cart exists in session
    if (!isset($_SESSION['cart'])) {
        echo "No items in the cart.";
        exit(); // Exit if cart is empty
    }

    // Get the user's email from the session
    if (!isset($_SESSION["username"])) {
        echo "User session not set.";
        exit();
    }
    $user = $_SESSION["username"];

    // Prepare the statement for inserting into the orders table
    $query_insert_order = "INSERT INTO orders (product_code, product_name, product_desc, price, units, total, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert_order = $conn->prepare($query_insert_order);

    // Check if statement preparation succeeded
    if (!$stmt_insert_order) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind parameters
    $stmt_insert_order->bind_param("sssdiis", $product_code, $product_name, $product_desc, $price, $units, $total_cost, $user);

    // Loop through each item in the cart
    foreach ($_SESSION['cart'] as $F_ID => $quantity) {
        // Retrieve food details from database
        $query_food = "SELECT * FROM FOOD WHERE id = ?";
        $stmt_food = $conn->prepare($query_food);

        // Check if statement preparation succeeded
        if (!$stmt_food) {
            echo "Error preparing statement: " . $conn->error;
            exit();
        }

        // Bind parameters
        $stmt_food->bind_param("i", $F_ID);

        // Execute statement
        $stmt_food->execute();

        // Get result
        $result_food = $stmt_food->get_result();

        // Check if there are rows returned
        if ($result_food->num_rows > 0) {
            $obj = $result_food->fetch_object();
            $cost = $obj->price * $quantity;

            // Bind parameters for the order details
            $product_code = $obj->product_code;
            $product_name = $obj->product_name;
            $product_desc = $obj->product_desc;
            $price = $obj->price;
            $units = $quantity;
            $total_cost = $cost;

            // Execute the statement to insert into the orders table
            if ($stmt_insert_order->execute()) {
                // Update quantity in FOOD table
                $new_qty = $obj->qty - $quantity;
                $query_update_food = "UPDATE FOOD SET qty = ? WHERE id = ?";
                $stmt_update_food = $conn->prepare($query_update_food);

                // Check if statement preparation succeeded
                if (!$stmt_update_food) {
                    echo "Error preparing statement: " . $conn->error;
                    exit();
                }

                // Bind parameters
                $stmt_update_food->bind_param("ii", $new_qty, $F_ID);

                // Execute statement
                if (!$stmt_update_food->execute()) {
                    echo "Error updating quantity in FOOD table: " . $stmt_update_food->error;
                    exit();
                }
            } else {
                echo "Error inserting into orders table: " . $stmt_insert_order->error;
                exit();
            }
        } else {
            echo "No rows returned for food id: " . $F_ID;
            exit();
        }
    }

    // Redirect after processing orders
    header("location: foodlist.php");
    exit(); // Ensure no further code execution after redirection
} else {
    // Redirect the user back to the COD page if the form wasn't submitted
    header("location: COD.php");
    exit(); // Ensure no further code execution after redirection
}
?>
