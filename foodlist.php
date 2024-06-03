<?php
session_start();

if(!isset($_SESSION['login_user2'])){
header("location: customerlogin.php"); 
}

?>

<html>
  <head>
    <title> Explore | Food HungryClicks </title>
    <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <img src="images/logo.webp" class="logo" width="200px">
      <a class="navbar-brand" href="index.php">HungryClicks</a>
      <ul class="navbar-nav">
        <li><a href="index.php">Home</a></li><br><br>
      </ul>

      <?php
      if(isset($_SESSION['login_user1'])){
      ?>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
        <li><a href="myrestaurant.php">MANAGER CONTROL PANEL</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
      </ul>

      <?php
      }
      else if (isset($_SESSION['login_user2'])) {
        ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li class="active" ><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>) </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
        <?php        
      }
      else {
        ?>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
            <ul class="dropdown-menu">
          <li> <a href="customersignup.php"> User Sign-up</a></li>
          <li> <a href="managersignup.php"> Manager Sign-up</a></li>
          <li> <a href="#"> Admin Sign-up</a></li>
        </ul>
        </li>

        <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li> <a href="customerlogin.php"> User Login</a></li>
          <li> <a href="managerlogin.php"> Manager Login</a></li>
          <li> <a href="#"> Admin Login</a></li>
        </ul>
        </li>
      </ul>

      <?php
      }
      ?>
    </nav>

    <div class="jumbotron">
      <div class="container text-center">
        <h1>Welcome To HungryClicks</h1>      
      </div>
    </div>

    <div class="container" style="width:95%;">
      <?php
      require 'connection.php';
      $conn = Connect();

      $sql = "SELECT * FROM FOOD WHERE options = 'ENABLE' ORDER BY F_ID";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          echo "<div class='row'>";
          while ($row = mysqli_fetch_assoc($result)) {
              ?>
              <div class="col-md-3">
                  <form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">
                      <div class="mypanel" align="center">
                          <img src="<?php echo $row["images_path"]; ?>" class="img-responsive">
                          <h4 class="text-dark"><?php echo $row["name"]; ?></h4>
                          <h5 class="text-info"><?php echo $row["description"]; ?></h5>
                          <h5 class="text-danger">&#8377; <?php echo $row["price"]; ?>/-</h5>
                          <h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
                          <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
                          <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
                          <input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
                          <input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
                      </div>
                  </form>
              </div>
              <?php
          }
          echo "</div>"; // Close the row
      } else {
          ?>
          <div class="container">
              <div class="jumbotron">
                  <center>
                      <label style="margin-left: 5px;color: red;"> <h1>Oops! No food is available.</h1> </label>
                      <p>Stay Hungry...! :P</p>
                  </center>
              </div>
          </div>
          <?php
      }
      ?>
    </div>

  </body>
</html>