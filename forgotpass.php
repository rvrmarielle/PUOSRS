<?php
include_once("forgotpassAction.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reset your password</title>
        <link rel="icon" href="images/loginlogo.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" href="e-style.css">

    </head>

    <body>

    <div class="container-fluid" style="margin:0; padding:0">
        <img src="images/header.jpg" alt="header_image">
    </div>


    <div class="container " style="margin-top:30px" method="POST" action="login.php">
    
    <form class="card p-3 m-3 " method="POST" style="width:400px">
    <h4 class=" font-weight-bold text-center">RESET YOUR PASSWORD</h4>
    <p style="font-size:12px" class="text-center">Enter your email address that is registered to this system. <br>We'll send you an email with your email and reset token to recover your account.</p><br>

            
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-secondary">Email Address</label>
                    <input type="email" class="form-control form-control-sm" name="email" required>
                </div>
                <input type="submit" class="btn btn-primary btn-sm  btn-success "  name="forgotPass" value="Send">

            </form>
    </div>
    </div>
    </body>
</html>