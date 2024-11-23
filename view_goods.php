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
$result = null;

$search_goods_no = ""; // Initialize the search input variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_goods_no = $_POST["search_goods_no"]; // Get the entered item_no from the form
}

// Step 4: Fetch data from the selected table
$sql = "SELECT * FROM warehousegoods";
if (!empty($search_goods_no)) {
    // If a search item_no is provided, add a WHERE clause to filter results
    $sql .= " WHERE goodNo LIKE '%$search_goods_no%'";
}
$result = $conn->query($sql);
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
    .main{
        margin-top: 80px;
        margin-left: 20px;
    }
</style>

<body >
    <!-- THIS WILL BE THE HOME PAGE -->
   <?php include('navbar.html')?>
   <form action="view_goods.php" method="POST">

        <div class="main">
        <a href="admin_home.php" style="color: black; text-decoration: none;"><i class="fas fa-backward fa-2x"></i></a>

            <div class="form-group">
                <label for="search_item_no">Search by Order Number:</label>
                <input type="text" class="form-control" id="search_order_no" name="search_goods_no" value="<?php echo $search_goods_no; ?>" placeholder="Enter order number....">
            </div>
            <button type="submit" style="margin-top: 10px;" class="btn btn-primary">Search</button>

            <table class="table table-stripped table-hover table-responsive">
                <!-- ... (your existing table headers) ... -->
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scpoe ="col">Package Number</th>
                        <th scope ="col">Package Name</th>
                        <th scope ="col">Warehouse Name</th>
                        <th scope ="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0) { ?>
                        <?php while ($fetchrecord = $result->fetch_assoc()) { ?>
                            <!-- ... (your existing table rows) ... -->
                            <tr>
                        <td><?php echo $fetchrecord['ID']?></td>
                        <td><?php echo $fetchrecord['goodNo']?></td>
                        <td><?php echo $fetchrecord['goodName']?></td>
                        <td><?php echo $fetchrecord['storeName']?></td>
                        <td><?php echo $fetchrecord['description']?></td>
                        
                    </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
    
    

    
    
        

</body>
</html>