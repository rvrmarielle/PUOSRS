<?php 
include 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student Login</title>
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
        <img src="images/header.jpg" alt="header_image" style="margin-left:330px">
    </div>
    <div class="bg-white text-dark text-center font-weight-bold">PHINMA University of Pangasinan Online Scholarship Renewal System</div>
    <div class="container bg-light" style="margin-top:30px">
        <div class="row">
            <div class="col-sm-6 p-0">
                <img src="images/login_image.jpg" alt="login_image" class="img-thumbnail" width="360px" style="padding:0;margin:0">
            </div>

            <form action="stud_login.php" method="POST" style="margin:0" class="col-sm-6" >
            <a href="login.php" class="float-right">Back</a>
                <p class="text-secondary font-weight-bold" style="font-size:18px">LOGIN AS STUDENT</p>
                <p class="text-secondary" style="font-size:13px">Please fill your correct credentials.</p>
                <div class="row-sm-6">
                    <div class="col">

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-secondary">Email address</label>
                            <input type="email" class="form-control form-control-sm"  aria-describedby="emailHelp" placeholder="Enter email" name="email"  required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="text-secondary">Password</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Password" name="password" required>
                        </div>
                        <span><a href="forgot.php" style="font-size:12px" class="text-dark"><u>Forgot Password</u></a></span><br>
                        <input type="submit" class="btn btn-primary btn-sm btn-block btn-success mt-2"  name="login" value="Log in">
                    </div>
                    </div>
                    
</form>
            </div>
            <?php
			if(isset($_SESSION['wrongalert']))
			{
				?>
  						<p style="font-size:13px; width:100%" class="bg-danger p-2 m-2 text-white text-centered">Your email or password is incorrect!</p>
                          
					</div>
				<?php
				
				unset($_SESSION['wrongalert']);
				
			}
			?>
        </div>
    </div>
    </body>
</html>