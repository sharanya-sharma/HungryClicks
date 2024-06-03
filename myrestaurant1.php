<?php
include('session_m.php');

if(!isset($login_session)){
    header('Location: managerlogin.php'); 
    exit;
}

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$contact = $conn->real_escape_string($_POST['contact']);
$address = $conn->real_escape_string($_POST['address']);


$query = "INSERT INTO RESTAURANTS(name,email,contact,address,M_ID) VALUES('" . $name . "','" . $email . "','" . $contact . "','" . $address ."','" . $_SESSION['login_user1'] ."')";
$success = $conn->query($query);

if (!$success){
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>change</title>
    <link rel="stylesheet" type = "text/css" href ="css/add_food_items.css">
	</head>
	<body>
    <nav class="navbar">
      <img src="images/logo.webp" class="logo" width="200px">
      <a class="navbar-brand" href="index.php">HungryClicks</a>
      <ul class="navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul><br><br>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
        <li class="active"> <a href="managerlogin.php">MANAGER CONTROL PANEL</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
      </ul>
    </nav>
    <div class="container">
      <div class="jumbotron" style="text-align: center;">
        <h1>Your already have one restaurant.</h1>
        <p>Go back to your <a href="view_food_items.php">Restaurant</a></p>
      </div>
    </div>
	</body>
</html>

	<?php
}
else {
	header('Location: myrestaurant.php');
}

$conn->close();


?>