<?php 
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['expire_time']) && time() < $_SESSION['expire_time'] ) {
  // User is already logged in, redirect to the new page
}
else{
  header("Location: admin_login.php");
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
    body {}
    .navbar {
      height: 80px;
      /* Adjust the height as needed */
      position: sticky;
      /* Make the navbar sticky */
      top: 0;
      /* Stick it to the top of the viewport */
      z-index: 100;
      /* Ensure it's above other elements */
    }



    .nav {
      padding-top: 15px;
      /* Adjust the top padding as needed to vertically center the content */
      padding-bottom: 15px;
      /* Adjust the bottom padding as needed to vertically center the content */

    }

    

    /* CSS */
    

    .navbar-right {
      margin-left: 30%;

    }

    .navbar {

      font-family: 'Times New Roman', Times, serif:
    }

    nav {
      font-family: 'Times New Roman', Times, serif;
      font-size: 20px;
    }
    .card-header{
        margin-top: 30px;
    }
</style>

<body >
    <!-- THIS WILL BE THE HOME PAGE -->
   <?php include('navbar.html')?>
   <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-header bg-dark text-white text-center" style="height: 50px; text-align: center;" >
                    <span class="align-middle" >Admin Panel</span>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-3 ">
                <div class="card-header bg-dark text-white text-center" style="height: 50px;">
                    <span class="align-middle">View all Orders</span>
                </div>
                <div class="card-body">
                    <span><p>Click to View orders </p></span>
                    <a href="admin_orders.php">
                        <button> <i class="fa fa-edit"></i></button>
                    </a>
                </div>
                <div class="card-footer shadow-none p-3 mb-5 bg-light rounded"></div>
            </div>
            <div class="col-lg-3 ">
                <div class="card-header bg-dark text-white text-center"style="height: 50px;" >
                    <span class="align-middle">Update Ship coordinates</span>
                </div>
                <div class="card-body">
                    <span><p>Click to update coordinates </p></span>
                        <a href="update_coordinates.php">
                        <button> <i class="fa fa-edit"></i></button>
                    </a>
                </div>
                <div class="card-footer shadow-none p-3 mb-5 bg-light rounded"></div>
            </div>
            <div class="col-lg-3 ">
                <div class="card-header bg-dark text-white text-center"style="height: 50px;" >
                    <span class="align-middle">Others</span>
                </div>
                <div class="card-body">
                    <span><p>Others </p></span>
                    <a href="approve_products_services.php">
                        <button> <i class="fa fa-edit"></i></button>
                    </a>
                </div>
                <div class="card-footer shadow-none p-3 mb-5 bg-light rounded"></div>
            </div>
            <div class="col-lg-3 ">
                <div class="card-header bg-dark text-white text-center"style="height: 50px;" >
                    <span class="align-middle">Others</span>
                </div>
                <div class="card-body   ">
                    <span><p>Others </p></span>
                    <a href="approve_products_services.php">
                        <button> <i class="fa fa-edit"></i></button>
                    </a>
                </div>
                <div class="card-footer shadow-none p-3 mb-5 bg-light rounded"></div>
            </div>
        </div>
        
    </div>

   
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>

    
    
        

</body>
</html>