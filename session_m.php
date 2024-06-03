<?php
require 'connection.php';
$conn = Connect();

session_start();

// Check if the 'login_user1' session variable is set
if(isset($_SESSION['login_user1'])) {
  $user_check = $_SESSION['login_user1'];

  // SQL Query To Fetch Complete Information Of User
  $query = "SELECT username FROM MANAGER WHERE username = '$user_check'";
  $ses_sql = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($ses_sql);

  // Check if the username is found in the database
  if($row) {
    $login_session = $row['username'];
  } else {
    // Redirect to the login page if the username is not found
    header('Location: managerlogin.php');
    exit;
  }
} else {
  // Redirect to the login page if the session variable is not set
  header('Location: managerlogin.php');
  exit;
}
?>