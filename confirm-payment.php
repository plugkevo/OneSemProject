<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['expire_time']) && time() < $_SESSION['expire_time']) {
  // User is already logged in, you can store the username in a variable
  $userName = $_SESSION['username'];
} else {
  header("Location: login.php");
  exit(); // Make sure to exit after the redirect
}

// Initialize variables
$orderNo = '';
$message = '';
$phone_number = ''; // Initialize phone_number variable

// Check if the order number is set in the session
if (isset($_SESSION["orderNo"])) {
    $orderNo = $_SESSION["orderNo"];
}

// Database connection
include('connection.php');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the Confirm Payment button was pressed
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_Payment"])) {
    // Prepare and execute the SQL statement to check if the order ID exists
    $stmt = $conn->prepare("SELECT * FROM orders WHERE OrderNo = ?");
    $stmt->bind_param("s", $orderNo); // "s" indicates the type is string
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the order ID exists
    if ($result->num_rows > 0) {
        // Order ID exists
        $order = $result->fetch_assoc(); // Fetch the first row as an associative array
        $phone_number = $order['Phone']; // Ensure this matches your database column name
        
        $message = "<h1>Payment Confirmed</h1>";
        $message .= "<p>Your order ID is: <strong>" . htmlspecialchars($orderNo) . "</strong></p>";
    } else {
        // Order ID does not exist
        $message = "<h1>Order Not Found</h1>";
        $message .= "<p>The order ID you provided does not exist.</p>";
    }

    // Close the statement
    $stmt->close();

    // Send SMS logic
    require_once 'sms.php';
    $livesms = new SMS();
    @$phone = $phone_number;
    @$text = "Your Payment has been received for Order ID: " . htmlspecialchars($orderNo) . ". More updates will follow.";
    @$result = $livesms->send($phone, $text);
    
    // Handle SMS sending result
    if (@$result['success'] && !empty($result['message'])) {
        echo '<div class="alert alert-primary" role="alert">' . @$result['message'] . '</div>';
    } elseif (!@$result['success'] && !empty($result['message'])) {
        echo '<div class="alert alert-danger" role="alert">' . @$result['message'] . '</div>';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>African Shipping</title>
</head>
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 70px;
    }
</style>
<body>
    <?php include('navbar.html');?>
   
    
    <div class="container">
        <div class="content">
            <h1>Confirm Payment</h1>
            <p>Once you have received the M-PESA message, click on Confirm Payment to proceed</p>

            <!-- Form for confirming payment -->
            <form method="post" action="">
                <button class="btn btn-primary" name="confirm_Payment">Confirm Payment</button>
            </form>

            <!-- Display the message after checking the order ID -->
            <?php
            if ($message) {
                echo $message;
                // Display the button to return to the home page
                echo '<form action="home.php" method="get">';
                echo '<button class="btn btn-success" type="submit">Go Back to Home</button>';
                echo '</form>';
            }
            ?>
        </div>
    </div>
</body>
</html>