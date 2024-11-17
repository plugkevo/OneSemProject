
<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['expire_time']) || time() >= $_SESSION['expire_time']) {
	// User is not logged in or session has expired, redirect to login page
	header("Location: index.php"); // Change to your login page
	exit();
  }


if(isset ($_POST['submit'])) {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
  
    // Check if the username and password match a record in the database
    $sql = "SELECT * FROM login WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
  
    if ($result->num_rows == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['expire_time'] = time() + (120); // Set session expiration time to 20 minutes from now

      // The username and password are correct, so log the user in
    
      header("Location: home.php");
    } else {
      // The username and password are incorrect, so display an error message
      $error = "Invalid username or password";
    }
  }
  



?>




