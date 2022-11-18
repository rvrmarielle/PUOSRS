<?php
include_once("forgotpassAction.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Create new password</title>
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
    <h4 class=" font-weight-bold text-center">CREATE NEW PASSWORD</h4>
    

            
                <div class="form-group">
                    <label for="newpass" class="text-secondary">New password</label>
                    <input type="password" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="pass" class="text-secondary">Repeat New password</label>
                    <input type="password" class="form-control form-control-sm" required>
                </div>
                <input type="submit" class="btn btn-primary btn-sm  btn-success "  name="newPass" value="Submit">

            </form>
    </div>
    </div>
    </body>
</html>