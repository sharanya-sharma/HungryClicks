<?php
include('session_m.php');

if(!isset($login_session)) {
    header('Location: managerlogin.php');
    exit;
}

// Check if checkboxes are set and not empty
if(isset($_POST['checkbox']) && !empty($_POST['checkbox'])) {
    // Sanitize the checkbox values
    $checkboxes = array_map('intval', $_POST['checkbox']);
    
    // Create a comma-separated list of IDs
    $ids = implode(',', $checkboxes);
    
    // Prepare the SQL statement using a parameterized query
    $sql = "UPDATE FOOD SET `options` = 'DISABLE' WHERE F_ID IN ($ids)";
    
    // Execute the prepared statement
    $stmt = $conn->prepare($sql);
    if($stmt) {
        $stmt->execute();
        $stmt->close();
        // Redirect after successful update
        header('Location: delete_food_items.php');
        exit;
    } else {
        // Handle errors if the prepared statement fails
        // For security reasons, avoid exposing detailed error messages to users
        // Log the error instead
        error_log("Error in prepared statement: " . $conn->error);
        // Redirect to an error page
        header('Location: error_page.php');
        exit;
    }
} else {
    // Handle the case where no checkboxes are selected
    // Redirect back to the delete_food_items.php page or display an error message
    header('Location: delete_food_items.php?error=no_selection');
    exit;
}

// Close the database connection
$conn->close();
?>
