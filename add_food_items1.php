<?php
include('session_m.php');

if(!isset($login_session)){
    header('Location: managerlogin.php'); 
    exit;
}

$name = $_POST['name'];
$price = $_POST['price'];
$description = $_POST['description'];
$images_path = $_POST['images_path'];

// Validate inputs
if(empty($name) || empty($price) || empty($description) || empty($images_path)) {
    // Handle empty inputs
    header('Location: add_food_items.php?error=empty');
    exit;
}

$user_check = $_SESSION['login_user1'];

// Fetch R_ID
$R_IDsql = "SELECT RESTAURANTS.R_ID FROM RESTAURANTS, MANAGER WHERE RESTAURANTS.M_ID='$user_check'";
$R_IDresult = mysqli_query($conn, $R_IDsql);
$R_IDrs = mysqli_fetch_array($R_IDresult, MYSQLI_BOTH);
$R_ID = $R_IDrs['R_ID'];

// Prepare and execute the SQL query using a prepared statement
$query = "INSERT INTO FOOD(name, price, description, R_ID, images_path) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssis", $name, $price, $description, $R_ID, $images_path);
$success = $stmt->execute();
$stmt->close();

if (!$success) {
    // Log the error internally
    error_log("Failed to insert food item: " . $conn->error);
    // Redirect to an error page
    header('Location: add_food_items.php?error=db');
    exit;
} else {
    // Redirect to success page
    header('Location: add_food_items.php?success=true');
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html>
	<head>
	  <link rel="stylesheet" type = "text/css" href ="css/add_food_items.css">
	</head>
	<body>
    <nav class="navbar">
      <img src="images/logo.webp" class="logo" width="200px">
      <a class="navbar-brand" href="index.php">HungryClicks</a>
      <ul class="navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
        <li class="active"> <a href="managerlogin.php">MANAGER CONTROL PANEL</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
      </ul>
    </nav>

    <div class="container">
      <div class="jumbotron">
      <h1>Oops...!!! </h1>
      <p>Kindly enter your Restaurant details before adding food items.</p>
      <p><a href="myrestaurant.php"> Click Me </a></p>
      </div>
    </div>
      <br><br><br><br><br><br><br><br><br><br><br><br>
	</body>
</html>
