    <?php
include('login_m.php'); // Includes Login Script

if(isset($_SESSION['login_user1'])){
header("location: myrestaurant.php"); //Redirecting to myrestaurant Page
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title> Manager Login | HungryClicks </title>
    <link rel="stylesheet" type = "text/css" href ="css/managerlogin.css">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <img src="images/logo.webp" class="logo" width="200px">
      <a class="navbar-brand" href="index.php">HungryClicks</a>
      <ul class="navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>
      <div class="container_signup">
        <a href="#" class="nav-a" id="signup-link" tabindex="0">
          <span>Sign Up</span>
          <span class="nav-icon nav-arrow" style="visibility: visible;"></span>
        </a>
        <ul class="dropdown-menu" id="signup-dropdown">
          <li><a href="customersignup.php">User Sign-up</a></li>
          <li><a href="managersignup.php">Manager Sign-up</a></li>
        </ul>
      </div>
      <div class="container_login">
        <a href="#" class="nav-a" id="login-link" tabindex="0">
          <span>Login</span>
          <span class="nav-icon nav-arrow" style="visibility: visible;"></span>
        </a>
        <ul class="dropdown-menu" id="login-dropdown">
          <li><a href="customerlogin.php">User Login</a></li>
          <li><a href="managerlogin.php">Manager Login</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <div class="panel-body">
        <form action="" method="POST" class="form">
          <div class="panel-heading"> Manager Login </div>
          <div class="row">
            <div class="form-group col-xs-12">
              <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Username: </label>
              <div class="input-group">
                <input class="form-control" id="username" type="text" name="username" placeholder="Username" required="" autofocus="">
              </div>           
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-12">
              <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
              <div class="input-group">
                <input class="form-control" id="password" type="password" name="password" placeholder="Password" required="">
              </div>           
            </div>
          </div>

          <div class="row">
            <div class="form-group col-xs-4">
              <button class="btn btn-primary" name="submit" type="submit" value=" Login ">Submit</button>
            </div>
          </div>
          <label style="margin-left: 5px;">or</label> <br><br>
          <label style="margin-left: 5px;" class="btn-primary"><a href="managersignup.php">Create a new account.</a></label>
        </form>
      </div>  
    </div>
 
    <script>
      document.addEventListener("DOMContentLoaded", function() {
      var signupLink = document.getElementById("signup-link");
      var signupDropdown = document.getElementById("signup-dropdown");
      var loginLink = document.getElementById("login-link");
      var loginDropdown = document.getElementById("login-dropdown");

      function toggleDropdown(link, dropdown) {
        dropdown.classList.toggle("show");
      }

      // Toggle signup dropdown menu when clicking on the "Sign Up" link
      signupLink.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior
        toggleDropdown(signupLink, signupDropdown);
      });

      // Toggle login dropdown menu when clicking on the "Login" link
      loginLink.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default link behavior
        toggleDropdown(loginLink, loginDropdown);
      });

      // Close dropdowns when clicking outside of them
      document.addEventListener("click", function(event) {
        var isClickInsideSignup = signupLink.contains(event.target) || signupDropdown.contains(event.target);
        var isClickInsideLogin = loginLink.contains(event.target) || loginDropdown.contains(event.target);

        if (!isClickInsideSignup && !isClickInsideLogin) {
          signupDropdown.classList.remove("show");
          loginDropdown.classList.remove("show");
        }
      });
    });
    </script>
  </body>
</html>