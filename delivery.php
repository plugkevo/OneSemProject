<?php 
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['expire_time']) && time() < $_SESSION['expire_time']) {
  // User is already logged in, you can store the username in a variable
  $userName = $_SESSION['username'];
} else {
  header("Location: login.php");
  exit(); // Make sure to exit after the redirect
}

include('connection.php');

$response = "";
$error = "";
$orderNo = "";
$fullName = "";
$phoneNo = "";
$pin = "";

if (isset($_POST['enter_btn'])) {
    // Fetch items
    $orderNo = $_POST['orderNo'];
    $fullName = $_POST['fullName'];
    $phoneNo = $_POST['phoneNo'];
    $pin = $_POST['pin'];

    // Check if the orderNo already exists
    $stmt = $conn->prepare("SELECT * FROM deliveries WHERE orderNo = ?");
    $stmt->bind_param("s", $orderNo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Error: The orderNo already exists. Delivery already booked.";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO deliveries(orderNo, fullName, phoneNo, pin) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $orderNo, $fullName, $phoneNo, $pin);

        // Execute the statement
        if ($stmt->execute()) {
            $response = "Data submitted successfully";
            // Clear the form fields after submission
            $orderNo = '';
            $fullName = '';
            $phoneNo = '';
            $pin = '';
        } else {
            $error = "Not submitted: " . $stmt->error;
        }
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFRICAN SHIPPING</title>
    <link rel="stylesheet" href="bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style12.css">
</head>
<style>
    .main {
        margin-top: 80px;
        margin-left: 20px;
    }
</style>
<body>
    <?php include('navbar.html'); ?>
    <form action="delivery.php" method="POST">
        <div class="main">
        <a href="services.php" style="color: black; text-decoration: none;"><i class="fas fa-backward fa-2x"></i></a>
        <h1 style="text-align: center;">Book for delivery</h1>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="orderNo" class="label">Order Number</label>
                    <input type="text" class="form-control" name="orderNo" value="<?php echo htmlspecialchars($orderNo); ?>" placeholder="Enter order number...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="fullName" class="label">Full Name</label>
                    <input type="text" class="form-control" name="fullName" value="<?php echo htmlspecialchars($fullName); ?>" placeholder="Enter full name...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="phoneNo" class="label">Phone Number</label>
                    <input type="text" class="form-control" name="phoneNo" value="<?php echo htmlspecialchars($phoneNo); ?>" placeholder="Enter phone number...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="pin" class="label">PIN</label>
                    <input type="text" class="form-control" name="pin" value="<?php echo htmlspecialchars($pin); ?>" placeholder="Enter PIN...">
                </div>
                
                <div class="col-lg-6 mb-3">
                    <button class="btn btn-success" disabled><?php echo $response; ?></button>
                </div> 
                <div class="col-lg-6 mb-3">
                    <button class="btn btn-primary" name="enter_btn">Enter</button>
                </div>
                <?php if ($error): ?>
                    <div class="col-lg-12 mb-3">
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
</body>
</html>