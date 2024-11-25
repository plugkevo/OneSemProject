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
$ship_name = "";
$ship_imo = "";
$latitude = "";
$longitude = "";

if (isset($_POST['enter_coordinates_btn'])) {
    // Fetch items
    $ship_name = $_POST['ship_name'];
    $ship_imo = $_POST['ship_imo'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    $insertdata = mysqli_query($conn, "INSERT INTO location_tab (locationLatitude, locationLongitude, ship_imo, ship_name) VALUES ('$latitude', '$longitude', '$ship_imo', '$ship_name')");

    if ($insertdata) {
        $response = "Data submitted successfully";
    } else {
        $error = "Not submitted";
    }
}

if (isset($_POST['search_coordinates_btn'])) {
    $ship_imo = $_POST['ship_imo'];
    
    // Search for the ship using the IMO number
    $query = mysqli_query($conn, "SELECT ship_name, locationLatitude, locationLongitude FROM location_tab WHERE ship_imo = '$ship_imo'");
    
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $ship_name = $row['ship_name'];
        $latitude = $row['locationLatitude'];
        $longitude = $row['locationLongitude'];
    } else {
        $error = "No data found for the given IMO number.";
    }
}

if (isset($_POST['update_coordinates_btn'])) {
    $ship_name = $_POST['ship_name'];
    $ship_imo = $_POST['ship_imo'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Update the record in the database
    $updateQuery = mysqli_query($conn, "UPDATE location_tab SET ship_name = '$ship_name', locationLatitude = '$latitude', locationLongitude = '$longitude' WHERE ship_imo = '$ship_imo'");

    if ($updateQuery) {
        $response = "Data updated successfully";
    } else {
        $error = "Update failed";
    }
}

if (isset($_POST['delete_coordinates_btn'])) {
    $ship_imo = $_POST['ship_imo'];

    // Delete the record from the database
    $deleteQuery = mysqli_query($conn, "DELETE FROM location_tab WHERE ship_imo = '$ship_imo'");

    if ($deleteQuery) {
        $response = "Data deleted successfully";
        // Clear the form fields after deletion
        $ship_imo = '';
        $ship_name = "";
        $latitude = "";
        $longitude = "";
    } else {
        $error = "Delete failed";
    }
}
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
    <form action="update_coordinates.php" method="POST">
        <div class="main">
        <a href="admin_home.php" style="color: black; text-decoration: none;"><i class="fas fa-backward fa-2x"></i></a>
        <h1 style="text-align: center;">Update Coordinates</h1>
            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label for="shipName" class="label">Ship Name</label>
                    <input type="text" class="form-control" name="ship_name" value="<?php echo htmlspecialchars($ship_name); ?>" placeholder="Enter ship name...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="shipIMO" class="label">IMO Number</label>
                    <input type="number" class="form-control" name="ship_imo" value="<?php echo htmlspecialchars($ship_imo); ?>" placeholder="Enter IMO no...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="latitude" class="label">Latitude</label>
                    <input type="number" class="form-control" name="latitude" value="<?php echo htmlspecialchars($latitude); ?>" placeholder="Enter latitude...">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="longitude" class="label">Longitude</label>
                    <input type="number" class="form-control" name="longitude" value="<?php echo htmlspecialchars($longitude); ?>" placeholder="Enter longitude...">
                </div>
                
                <div class="col-lg-6 mb-3">
                    <button class="btn btn-success" disabled><?php echo $response; ?></button>
                </div>
                <div class="col-lg-6 mb-3">
                    <button class="btn btn-primary" name="enter_coordinates_btn">Enter</button>
                    <button class="btn btn-warning" name="search_coordinates_btn">Search</button>
                    <button class="btn btn-success" name="update_coordinates_btn">Update</button>
                    <button class="btn btn-danger" name="delete_coordinates_btn">Delete</button>
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