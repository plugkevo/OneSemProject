<?php 
session_start();

$errors  = array();
$errmsg  = '';

$config = array(
    "env"              => "sandbox",
    "BusinessShortCode"=> "174379",
    "key"              => "IyT7syN6aGg5usbEwzcrLcthUVwb3mfNtjo7RBiWFrCvl6c2", //Enter your consumer key here
    "secret"           => "4A29MkSvT5xLbwJ3eCuloA4tDVjnFGuPAa9HPTQqY5f5sQLFJHgK4MdaSCxmWJPd", //Enter your consumer secret here
    "username"         => "apitest",
    "TransactionType"  => "CustomerPayBillOnline",
    "passkey"          => "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919", //Enter your passkey here
    "CallBackURL"      => "https://98fa-102-220-231-101.ngrok-free.app/callback.php", //When using localhost, Use Ngrok to forward the response to your Localhost
    "AccountReference" => "African Shipping",
    "TransactionDesc"  => "Payment for Shipping" ,
);



if (isset($_POST['phone_number'])) {

    $phone = $_POST['phone_number'];
    $amount = $_POST['totalAmount'];
    

    $phone = (substr($phone, 0, 1) == "+") ? str_replace("+", "", $phone) : $phone;
    $phone = (substr($phone, 0, 1) == "0") ? preg_replace("/^0/", "254", $phone) : $phone;
    $phone = (substr($phone, 0, 1) == "7") ? "254{$phone}" : $phone;

    $conn = mysqli_connect("localhost", "root", "", "african_shipping_short");
    $result = $conn->query("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'african_shipping_short' AND TABLE_NAME = 'orders'");
    $row = $result->fetch_assoc();
    $nextId = $row['AUTO_INCREMENT'];
    $orderNo = "ORD" . str_pad($nextId, 5, '0', STR_PAD_LEFT);



    $access_token = ($config['env']  == "live") ? "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials"; 
    $credentials = base64_encode($config['key'] . ':' . $config['secret']); 
    
    $ch = curl_init($access_token);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response); 
    $token = isset($result->{'access_token'}) ? $result->{'access_token'} : "N/A";

    $timestamp = date("YmdHis");
    $password  = base64_encode($config['BusinessShortCode'] . "" . $config['passkey'] ."". $timestamp);

    $curl_post_data = array( 
        "BusinessShortCode" => $config['BusinessShortCode'],
        "Password" => $password,
        "Timestamp" => $timestamp,
        "TransactionType" => $config['TransactionType'],
        "Amount" => $amount,
        "PartyA" => $phone,
        "PartyB" => $config['BusinessShortCode'],
        "PhoneNumber" => $phone,
        "CallBackURL" => $config['CallBackURL'],
        "AccountReference" => $config['AccountReference'],
        "TransactionDesc" => $config['TransactionDesc'],
    ); 

    $data_string = json_encode($curl_post_data);

    $endpoint = ($config['env'] == "live") ? "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest"; 

    $ch = curl_init($endpoint );
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response     = curl_exec($ch);
    curl_close($ch);

    $result = json_decode(json_encode(json_decode($response)), true);

    if(!preg_match('/^[0-9]{10}+$/', $phone) && array_key_exists('errorMessage', $result)){
        $errors['phone'] = $result["errorMessage"];
    }

    if($result['ResponseCode'] === "0"){         //STK Push request successful

        $MerchantRequestID = $result['MerchantRequestID'];
        $CheckoutRequestID = $result['CheckoutRequestID'];

        //Saves your request to a database
        $conn = mysqli_connect("localhost","root","","african_shipping_short");
       
        $sql = "INSERT INTO `orders`(`ID`, `OrderNo`, `Amount`, `Phone`, `CheckoutRequestID`, `MerchantRequestID`) VALUES ('','".$orderNo."','".$amount."','".$phone."','".$CheckoutRequestID."','".$MerchantRequestID."');";
        
        if ($conn->query($sql) === TRUE){
            $_SESSION["MerchantRequestID"] = $MerchantRequestID;
            $_SESSION["CheckoutRequestID"] = $CheckoutRequestID;
            $_SESSION["phone"] = $phone;
            $_SESSION["orderNo"] = $orderNo;

            header('location: confirm-payment.php');
        }else{
            $errors['database'] = "Unable to initiate your order: ".$conn->error;;  
            foreach($errors as $error) {
                $errmsg .= $error . '<br />';
            } 
        }
        
    }else{
        $errors['mpesastk'] = $result['errorMessage'];
        foreach($errors as $error) {
            $errmsg .= $error . '<br />';
        }
    }
    
}

?>