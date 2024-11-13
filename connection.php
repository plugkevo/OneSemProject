<?php
    $response="";
    $error="";
    $server="localhost";
    $username="root";
    $password="";
    $database="african_shipping_short";

    $conn = mysqli_connect($server, $username, $password, $database);
    if($conn){
        echo "";
    }
    else{
        echo "failed";
    }
?>