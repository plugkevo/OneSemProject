<?php
session_start();

// Initialize variables
$orderNo = '';
$message = '';

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
        $message = "<h1>Payment Confirmed</h1>";
        $message .= "<p>Your order ID is: <strong>" . htmlspecialchars($orderNo) . "</strong></p>";
    } else {
        // Order ID does not exist
        $message = "<h1>Order Not Found</h1>";
        $message .= "<p>The order ID you provided does not exist.</p>";
    }

    // Close the statement
    $stmt->close();
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
    .container{
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 70px;
    }
</style>
<body>
    <?php include('navbar.html')?>
    
    <div class="container">
        <div class="content">
            <h1>Confirm Payment</h1>
            <p>Once you have received the mpesa message, click on Confirm Payment to proceed</p>

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
                echo '<button class="btn btn-success "type="submit">Go Back to Home</button>';
                echo '</form>';
            }
            ?>
        </div>
    </div>
</body>
</html>