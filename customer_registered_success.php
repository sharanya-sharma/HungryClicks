<html>
  <head>
    <title> Manager Login | HungryClicks </title>
    <link rel="stylesheet" type = "text/css" href ="css/manager_registered_success.css">
  </head>
  <body>
    <nav class="navbar">
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

    <?php
    require 'connection.php';
    $conn = Connect();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $contact = $conn->real_escape_string($_POST['contact']);
        $address = $conn->real_escape_string($_POST['address']);
        $password = $conn->real_escape_string($_POST['password']);

        $query = "INSERT INTO CUSTOMER (fullname, username, email, contact, address, password) 
                  VALUES ('$fullname', '$username', '$email', '$contact', '$address', '$password')";

        if ($conn->query($query) === TRUE) {
            // Redirect to login page after successful registration
            header('Location: customerlogin.php');
            exit();
        } else {
            // Display an error message if registration fails
            echo "Error: " . $query . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        // If form is not submitted, redirect to appropriate page or handle accordingly
        header('Location: customersignup.php');
        exit();
    }
    ?>

    <div class="container">
      <div class="jumbotron" style="text-align: center;">
        <h2> <?php echo "Welcome $fullname!" ?> </h2>
        <h1>Your account has been created.</h1>
        <p>Login Now from <a href="customerlogin.php">HERE</a></p>
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