
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
        body {
          scroll-behavior: smooth;
          display: flex;
          align-items: center;
          justify-content: center;
          height: 100vh;
          width: 100vw;
          background: rgba(35, 201, 223, 0.3);
          overflow-y: scroll;
      }
      .flex-row {
          display: flex;
      }
      .wrapper {
          border: 1px solid #4b00ff;
          border-right: 0;
      }
      
    
      *{
      box-sizing: border-box;
      }

      input[type=text], select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
      }
      input[type=email], select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
      }

      label {
        padding: 12px 12px 12px 0;
        display: inline-block;
      }

      input[type=submit] {
        background-color: #0489aa;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        float: right;
      }

    .container {
        border-radius: 10px;
        background-color: #f2f2f2;
        padding: 50px;
        height: 500px;
        overflow: auto;
        margin-top: 90px;
      
      }
      
    </style>

</head>
<body>
    <!-- navigation bar here -->
    <?php include('navbar.html')?>

    <!-- main starts here -->
    <main>
        <div class="container" style="background-color: whitesmoke;margin-top:0px;">
            <h3><div class="title">Contact us!</div></h3>
            <br>
            <div class="title-info">We'll get back to you soon!</div>
            <?php if (isset($_GET['status'])): ?>
                <div class="alert alert-<?php echo ($_GET['status'] == 'success') ? 'success' : 'danger'; ?>">
                    <?php 
                        echo ($_GET['status'] == 'success') ? 'Message sent successfully!' : 'Failed to send message. Please try again.';
                    ?>
                </div>
            <?php endif; ?>
        
        
            <form action="send_email.php" method="POST" class="form">
                <div class="input-group">
                    <label for="first-name">First name</label>
                    <input type="text" name="fullname" id="full-name" placeholder="Full name">
                </div>
                
                <div class="input-group">
                    <label for="last-name">Subject</label>
                    <input type="text" name="subject" id="subject" placeholder="Subject">
                   
                </div>
                <div class="input-group">
                    <label for="last-name">Phone Number</label>
                    <input type="text" name="phoneNo" id="subject" placeholder="+2547......">
                   
                </div>

                <div class="input-group">
                    <label for="e-mail">e-mail</label>
                    <input type="email" name="email" id="e-mail" placeholder="e-mail">
                    
                </div>

                <div class="textarea-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="5" placeholder="Please share with us you're feedback..."></textarea>
                </div>
                <div class="input-group">
                    <p>
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I accept the <a href="terms.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a>.</label>
                    </p
                </div>
                <div class="button-div">
                    <button class="btn btn-primary" name="submit" type="submit">Send</button>
                </div>
        </div>
            </form>
    </main>

    


</body>
</html>