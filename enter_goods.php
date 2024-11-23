<?php 
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['expire_time']) && time() < $_SESSION['expire_time']) {
  // User is already logged in, you can store the username in a variable
  $userName = $_SESSION['username'];
} else {
  header("Location: admin_login.php");
  exit(); // Make sure to exit after the redirect
}

include('connection.php');

$response = "";
$error = "";
$goodNo="";
$goodName="";
$storeName="";
$description="";

if (isset($_POST['enter_goods_btn'])) {
    // Fetch items
    $goodNo = $_POST['goodNo'];
    $goodName = $_POST['goodName'];
    $storeName = $_POST['storeName'];
    $description = $_POST['description'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO warehousegoods(goodNo, goodName, storeName, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $goodNo, $goodName, $storeName, $description);

    // Execute the statement
    if ($stmt->execute()) {
        $response = "Data submitted successfully";
    } else {
        $error = "Not submitted: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

if (isset($_POST['search_goods_btn'])) {
    $goodNo = $_POST['goodNo'];
    
    // Search for the good using the goodNo
    $stmt = $conn->prepare("SELECT goodName, storeName, description FROM warehousegoods WHERE goodNo = ?");
    $stmt->bind_param("s", $goodNo);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $goodName = $row['goodName'];
        $storeName = $row['storeName'];
        $description = $row['description'];
    } else {
        $error = "No data found for the given goodNo.";
    }

    // Close the statement
    $stmt->close();
}

if (isset($_POST['update_goods_btn'])) {
    $goodNo = $_POST['goodNo'];
    $goodName = $_POST['goodName'];
    $storeName = $_POST['storeName'];
    $description = $_POST['description'];

    // Update the record in the database
    $stmt = $conn->prepare("UPDATE warehousegoods SET goodName = ?, storeName = ?, description = ? WHERE goodNo = ?");
    $stmt->bind_param("ssss", $goodName, $storeName, $description, $goodNo);

    if ($stmt->execute()) {
        $response = "Data updated successfully";
    } else {
        $error = "Update failed: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

if (isset($_POST['delete_goods_btn'])) {
    $goodNo = $_POST['goodNo'];

    // Delete the record from the database
    $stmt = $conn->prepare("DELETE FROM warehousegoods WHERE goodNo = ?");
    $stmt->bind_param("s", $goodNo);

    if ($stmt->execute()) {
        $response = "Data deleted successfully";
        // Clear the form fields after deletion
        $goodNo = '';
        $goodName = "";
        $storeName = "";
        $description = "";
    } else {
        $error = "Delete failed: " . $stmt->error;
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
    <form action="enter_goods.php" method="POST">
        <div class="main">
        <a href="admin_home.php" style="color: black; text-decoration: none;"><i class="fas fa-backward fa-2x"></i></a>
        <h1 style="text-align: center;">Goods</h1>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="packageName" class="label">Package Number</label>
                    <input type="text" class="form-control" name="goodNo" value="<?php echo ?>" placeholder="Enter package number...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="Package Name" class="label">Package Name</label>
                    <input type="text" class="form-control" name="goodName" value="<?php echo htmlspecialchars($goodName); ?>" placeholder="Enter package name...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="storeName" class="label">Storage Warehouse</label>
                    <select name="storeName" id="storeName" class="form-select">
                        <option selected  value="<?php echo htmlspecialchars($storeName); ?>"><?php echo htmlspecialchars($storeName); ?></option>
                        <option value="Store A">Store A</option>
                        <option value="Store B">Store B</option>
                    </select>
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="description" class="label">Package Description</label>
                    <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($description); ?>" placeholder="Enter package description...">
                </div>
                
                <div class="col-lg-6 mb-3">
                    <button class="btn btn-success" disabled><?php echo $response; ?></button>
                </div>
                <div class="col-lg-6 mb-3">
                    <button class="btn btn-primary" name="enter_goods_btn">Enter</button>
                    <button class="btn btn-warning" name="search_goods_btn">Search</button>
                    <button class="btn btn-success" name="update_goods_btn">Update</button>
                    <button class="btn btn-danger" name="delete_goods_btn">Delete</button>
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