<?php 
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['expire_time']) && time() < $_SESSION['expire_time'] ) {
  // User is already logged in, redirect to the new page
}
else{
  header("Location: index.php");
}

include('connection.php');
$result = null;

$search_order_no = ""; // Initialize the search input variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_order_no = $_POST["search_order_no"]; // Get the entered item_no from the form
}

// Step 4: Fetch data from the selected table
$sql = "SELECT * FROM orders";
if (!empty($search_order_no)) {
    // If a search item_no is provided, add a WHERE clause to filter results
    $sql .= " WHERE OrderNo LIKE '%$search_order_no%'";
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
   <form action="admin_orders.php" method="POST">

        <div class="main">
        <a href="admin_home.php" style="color: black; text-decoration: none;"><i class="fas fa-backward fa-2x"></i></a>

            <div class="form-group">
                <label for="search_item_no">Search by Order Number:</label>
                <input type="text" class="form-control" id="search_order_no" name="search_order_no" value="<?php echo $search_order_no; ?>" placeholder="Enter order number....">
            </div>
            <button type="submit" style="margin-top: 10px;" class="btn btn-primary">Search</button>

            <table class="table table-stripped table-hover table-responsive">
                <!-- ... (your existing table headers) ... -->
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scpoe ="col">Order Number</th>
                        <th scope ="col">Amount</th>
                        <th scope ="col">Phone</th>
                        <th scope ="col">Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0) { ?>
                        <?php while ($fetchrecord = $result->fetch_assoc()) { ?>
                            <!-- ... (your existing table rows) ... -->
                            <tr>
                        <td><?php echo $fetchrecord['ID']?></td>
                        <td><?php echo $fetchrecord['OrderNo']?></td>
                        <td><?php echo $fetchrecord['Amount']?></td>
                        <td><?php echo $fetchrecord['Phone']?></td>
                        <td><?php echo $fetchrecord['CreatedAt']?></td>
                        
                    </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
    
    

    
    
        

</body>
</html>