<?php 
session_start();

  
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

  body{
  background-color: whitesmoke;
    
  }
  img{
      border-radius: 1cm;
      height: 1.2cm;
      width: 1.2cm;
  }
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }
    
    nav ul li {
      display: inline-block;
      position: relative;
    }
    
    nav ul li a {
      display: block;
      padding: 10px;
      text-decoration: none;
    }
    
    nav ul li:hover .submenu {
      display: block;
    }
    
    .submenu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      padding: 10px;
    }
    .container{
      padding-top: 2.5cm;
    
      max-width: max-content;
      
    }
    .header{
      background-image: url(images/ship1.jpg);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      height: 10cm;
      border-radius: 1.5cm;
      padding-top: 0.5cm;
      
    }
    .section1{
      
      max-width: max-content;
      height: 9cm;
      width: 9cm;
      border-radius: 1.5cm;
      background-color: #00008B;
      text-align: center;
      font-size: 35px;
      color: white;
      padding-top: 1cm;
      
    }
    .section1 img:hover{

    }
    
    .section2{
      background-image: url(images/ship2.jpg);
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      height: 10cm;
      border-radius: 1.5cm;
      padding-top: 0.5cm;
      text-align: center;
      color: black;
      
    
    }
    .section2 ul{
      align-items: center;
      list-style: none;
      align-content: center;
      overflow: hidden;
      
    }
    .section2 ul a li{
      display: inline;
      color: black;
    }
    .header{
      display: flex;
      justify-content: center;
      align-items: center;
    }




</style>
<body >
    <!-- THIS WILL BE THE HOME PAGE -->
   <?php include('navbar.html')?>
    
    

    
    <div class="container-fluid" style="padding-top: 3cm;">
      <div class="header"> 
        <div class="section1">
          <p>Welcome to African shipping</p>
          <img src="images/WhatsApp Image 2023-05-21 at 14.53.12.jpeg" style="height: 3cm; width: 3cm; " alt="">
        </div>
      </div>   
      
         </div> <div class="row" style="padding-top: 1cm; padding-left: 3cm;">
            <!-- column 1 -->
              <div class=" column1 col-lg-4">
                <img src="images/ship3.jpg" style="height: 9cm; width: 9cm;"  alt="">
                <h3 style="color: #1ecbe1;">Shipping Services</h3>
                <p style="color: black; font-size: 20px;">We offer shipping services to various <br> parts of the world</p>
              </div>
            <!-- column 2 -->
              <div class=" col-lg-4">   
                <img src="images/loading-the-container-in-the-cargo-airplane.jpg" style="height: 9cm; width: 9cm;"  alt="">
                <h3 style="color: #1ecbe1;">Freight Services</h3>
                <p style="color: black; font-size: 20px;">Freight services for perishable goods</p>
              </div>
              <!-- column 3 -->
              <div class="col-lg-4">
                <img src="images/looking-for-a-specific-item.jpg" style="height: 9cm; width: 9cm;" alt="">
                <h3 style="color: #1ecbe1;">Packaging and Storage</h3>
                <p style="color: black; font-size: 20px;">Safe packaging before mailing</p>
              </div>
        </div>
        <div class="section2">
          <h3 style="padding-top: 1cm;">Find Out More About Us In The Following Platforms</h3>
          <ul style="align-items: center;">
              <a href="#"><li><span class="fab fa-facebook fa-3x"></span></li></a>
              <a href="#"><li><span class="fab fa-whatsapp fa-3x"></span></li></a>
              <a href="#"><li><span class="fab fa-instagram fa-3x" ></span></li></a>
              <a href="#"><li><span class="fab fa-twitter fa-3x"></span></li></a>
              <a href="#"><li><span class="fab fa-tiktok fa-3x"></span></li></a>
              <a href="#"><li><span class="fab fa-linkedin-in fa-3x"></span></li></a>       
              
           </ul>


        </div>
    
        <footer>
          &copy; Company 2023
      </footer>

</body>
</html>