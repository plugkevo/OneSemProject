<?php 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AFRICAN SHIPPING</title>
    <link rel="stylesheet" href="bootstrap-5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
        }
        .container {
            width: 100%;
            height: 100vh;
            padding: 0 8px;
        }
        .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            grid-gap: 30px;
        }
        .service {
            text-align: center;
            padding: 25px 10px;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            background: transparent;
            transition: transform 0.5s, background 0.5s;
        }
        .service h2 {
            font-weight: 600;
            margin-bottom: 8px;
        }
        .service:hover {
            background: #303ef7;
            color: #fff;
            transform: scale(1.05);
        }
        .wrapper {
            padding-top: 2cm;
        }
    </style>
</head>
<body>
    <!-- navigation bar starts here -->
    <nav class="navbar navbar-expand-lg bg-light fixed-top shadow">
        <a class="navbar-brand" href="home.php">
            <img src="images/WhatsApp Image 2023-05-21 at 14.53.12.jpeg" class="rounded-circle" alt="" width="40" height="40">
        </a>
        <a href="home.php" class="navbar-brand"> <i>AFRICAN SHIPPING</i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbardisplaynavigations" aria-controls="navbardisplaynavigations" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbardisplaynavigations">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a href="home.php" class="nav-link" style="font-size: 20px;">Home</a></li>
                <li><a href="services.php" class="nav-link" style="font-size: 20px;">Services</a></li>
                <li><a href="map.php" class="nav-link" style="font-size: 20px;">Tracking</a></li>
                <li><a href="contact_us.php" class="nav-link" style="font-size: 20px;">Contact Us</a></li>
                <li><a href="#" class="nav-link" style="font-size: 20px;">More</a>
                    <ul class="submenu">
                        <li><a href="mission.php" class="nav-link">Mission</a></li>
                        <li><a href="vision.php" class="nav-link">Vision</a></li>
                        <li><a href="aboutus.php" class="nav-link">About Us</a></li>
                        <li><a href="admin_login.php" class="nav-link">Admin Panel</a></li>
                    </ul>
                </li>                     
            </ul>           
        </div>
    </nav>

    <div class="container">
        <h1 style="text-align: center; padding: 70px; font-size: 40px; font-weight: bold;">Our Services</h1>
        <div class="row">
            <div class="service">
                <a href="goods.php" style="color:black; text-decoration:none;">
                    <h2>International Shipping</h2>
                    <p>We offer shipping outside the country and also globally. It enables new possibilities and 
                        better services.
                    </p>
                </a>
            </div>
            <div class="service">
                <a href="delivery.php" style="color:black; text-decoration:none;">
                    <h2>Customer Delivery</h2>
                    <p>We deliver and transport goods for our customers even when they order their goods through the online mode. The delivery 
                        process is typically managed by our company which picks up the package from the retailer and transports it to the customer's address.
                    </p>
                </a>
            </div>
            <div class="service">
                <h2>Means Of Transport</h2>
                <p>Our company can transport goods in many ways which are through air, land, sea, and rail. In both these means of transport, we mostly use the means of shipping through
                    air because it is the fastest means and it is very reliable. In this shipping through air, we use aircraft to move goods.
                </p>
            </div>
            <div class="service">
                <h2>Marketing</h2>
                <p>Our marketing of shipping companies is not only concerned with the development and implementation of successful strategies. For our marketing to be successful, there
                    needs to be a marketing orientation, which fosters the marketing concepts.
                </p>
            </div>
            
        </div>

       
    </div>
</body>
</html>