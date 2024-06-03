<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); // Redirecting To Home Page
}

?>
<!DOCTYPE html>
<html>

  <head>
    <title> Manager Login | HungryClicks </title>
    <link rel="stylesheet" type = "text/css" href ="css/myrestaurant.css">
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
      <div class="col-xs-3" style="text-align: center;">
    	  <div class="list-group">
          <a href="myrestaurant.php" class="list-group-item active">My Restaurant</a>
          <a href="view_food_items.php" class="list-group-item ">View Food Items</a>
          <a href="add_food_items.php" class="list-group-item ">Add Food Items</a>
          <a href="edit_food_items.php" class="list-group-item ">Edit Food Items</a>
          <a href="delete_food_items.php" class="list-group-item ">Delete Food Items</a>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="col-xs-9">
        <div class="form-area">
          <form action="myrestaurant1.php" method="POST" class="form">
            <br style="clear: both">
            <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> MY RESTAURANT</h3>

            <div class="form-group">
              <input type="text" class="form-control" id="name" name="name" placeholder="Your Restaurant's Name" required="">
            </div>

            <div class="form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Your Restaurant's Email" required="">
            </div>     

            <div class="form-group">
              <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required="">
            </div>

            <div class="form-group">
              <input type="text" class="form-control" id="address" name="address" placeholder="Your Restaurant's Address" required="">
            </div>

            <div class="form-group">
              <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right"> ADD RESTAURANT </button>    
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>