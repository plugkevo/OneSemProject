<?php
include('express-stk.php');



if (isset($_POST['total_amount'])) {
    $total_amount = $_POST['total_amount'];
    // Proceed with checkout logic

    
}


  


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
            <h1>Checkout</h1>
            <h1><?php  echo $total_amount;?></h1>
            
            <img src="images/download.png" height="80px" alt="">
            <p>1. Enter the phone number and press <b>Confirm & Pay</b> </p>
            <p>2. You will recieve a pop up on you phone. Enter you M-PESA pin</p>

            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <label for="phone_number">Phone number</label>
                <input type="number" name="phone_number" class="form-control" placeholder="0700000000" maxlength="10" required>
                <input type="number" name= "totalAmount" hidden value="<?php echo $total_amount;?>">
                <br>
                <button class="btn btn-primary float-right"  type="submit" <i class="ion-locked"></i>Confirm and Pay</button>


            </form>


        </div>
    </div>
</body>
</html>
