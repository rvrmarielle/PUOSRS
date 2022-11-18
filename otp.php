<?php
include_once("forgotpassAction.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Code Verification</title>
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
    <h4 class=" font-weight-bold text-center">CODE VERIFICATION</h4>
    <p style="font-size:12px" class="text-center">Please enter the code we've sent <br>We'll send you an email with your email and reset token to recover your account.</p><br>

            
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-secondary">Enter Code</label>
                    <input type="text" class="form-control form-control-sm" name="reset_token" required>
                </div>
                <input type="submit" class="btn btn-primary btn-sm  btn-success "  name="verify" value="Send">

            </form>
    </div>
    </div>
    </body>
</html>