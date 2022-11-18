<?php 
include("db.php");
session_start();
if(!isset($_SESSION["id"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logoutstud.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Account</title>
    <link rel="icon" href="images/loginlogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="e-style.css">
    <link rel="stylesheet" href="jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

    <style>
        .iti {
            display: block !important;
        }
    </style>
</head>

<body>

        <div class="container-fluid bg-white">
            <img src="images/header.jpg" alt="" class="" style="margin-left:80px">
        </div>
        <?php 
                    $user_id = $_SESSION['id'];

                    $query = "SELECT * FROM listofmembers WHERE id='$user_id'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img loading="lazy" src="images/user-profile.jpeg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h6 class="m-0"><?php echo ucwords ($row['fname']) ?> <?php echo ucwords ($row['lname']) ?></h6>
                    <p class="font-weight-normal text-muted mb-0"><?php echo ucwords ($row['snum']) ?></p>
                </div>
            </div>
        </div>


        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_student.php" class="nav-link text-secondary">
                    <i class="fa fa-th-large mr-3 text-secondary fa-fw"></i>
                    home
                </a>
            </li>
            <li class="nav-item">
                <a href="view.php" class="nav-link text-secondary">
                    <i class="fa fa-address-card mr-3 text-secondary fa-fw"></i>
                    view application
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-success" href="account_student.php">
                    <i class="fa fa-user mr-3 text-white  fa-fw"></i>account
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link text-secondary">
                    <i class="fa fa-sign-out mr-3 text-secondary fa-fw"></i>
                    logout
                </a>
            </li>

        </ul>
    </div>



    <div class="page-content pt-4 pl-4" id="content">

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">PROFILE ACCOUNT</p>

    <div class="container-fluid">
    <div class="card">
      <div class="card-body border" style="margin:20px;">
      <div class="row ">
                    <div class="col-sm-4">
                    <img src="uploads/<?= $row['profilepic'] ?>" alt="image/profile pic" width="100" height="auto" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                    </div>
                     </div>
                     <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i> Full Name
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['fname']); ?> <?php echo strtoupper ($row['lname']); ?>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i> Email
                    </div><div class="col-sm-6">
                    : <?php echo $row['email']; ?> 
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-phone-square" aria-hidden="true"></i> Student No.
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['snum']); ?>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-user" aria-hidden="true"></i> HK Category
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['hkcategory']); ?> 
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-birthday-cake" aria-hidden="true"></i> Department
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['college']); ?> 
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Address
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['hnum']); ?> <?php echo strtoupper ($row['brgy']); ?> <?php echo strtoupper ($row['city']); ?>  <?php echo strtoupper ($row['province']); ?>
                    </div>
                  </div><br>
                  <a href="" data-toggle="modal" data-target="#editstud<?php echo $row['id']; ?>">edit profile</a> | 
                  <a href="" data-toggle="modal" data-target="#changepass<?php echo $row['id']; ?>">change password</a>
                  
                  
                  
      </div>
    </div>
    </div>


       <!-- modal edit -->
       <div class="modal fade" id="editstud<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="edit.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                                <label for="name">First Name</label>
                                                <input style="margin-top: -5px;" type="text" name="fname" class="form-control form-control-sm" value="<?php echo ucwords ($row['fname']) ?>" required>
                                                
                                                <label style="margin-top: 10px;" for="name">Last Name</label>
                                                <input style="margin-top: -5px;" type="text" name="lname" class="form-control form-control-sm" value="<?php echo ucwords ($row['lname']) ?>" required>
                                                
                                                <label for="contacts" style="margin-top: 10px;">Email</label>
                                                <input style="margin-top: -5px;" type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email'] ?>" required>
                                            <fieldset disabled>

                                                <label for="contacts" style="margin-top: 10px;">Student No.</label>
                                                <input style="margin-top: -5px;" type="text" name="snum" class="form-control form-control-sm" value="<?php echo $row['snum'] ?>" required>
                                             </fieldset>
                                                <label for="contacts" style="margin-top: 10px;">HK Category</label>
                                                <input style="margin-top: -5px;" type="text" name="hkcategory" class="form-control form-control-sm" value="<?php echo $row['hkcategory'] ?>" required>
                    
                                                <label for="contacts" style="margin-top: 10px;">Department</label>
                                                <input style="margin-top: -5px;" type="text" name="college" class="form-control form-control-sm" value="<?php echo $row['college'] ?>" required>

                                                <label for="contacts" style="margin-top: 10px;">Address</label>
                                                <input style="margin-top: -5px;" type="text" name="city" class="form-control form-control-sm" value="<?php echo $row['city'] ?>" required>
                                                

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="editstud" class="btn btn-success btn-sm">Save Changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

    <!--Modal for Change Password-->
    <div class="modal fade" id="changepass<?php echo $row['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Change Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form action="functions.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    
                    <label for="name">Old Password</label>
                    <input style="margin-top: -5px;" type="text" name="old_pass" class="form-control form-control-sm" value="" required>
                                                
                    <label style="margin-top: 10px;" for="name">New Password</label>
                    <input style="margin-top: -5px;" type="text" name="new_pass" class="form-control form-control-sm" value="" required>

                    <label for="contacts" style="margin-top: 10px;">Confirm Password</label>
                    <input style="margin-top: -5px;" type="tel" name="confirm_pass" class="form-control form-control-sm" value="" required>
            </div>
        
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <button type="button" id="change" class="btn btn-success btn-sm" data-dismiss="modal">Save Changes</button>
        </div>

    </div>
    </div>
    </div>
    </div>

<?php } ?>
</body>




<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["ph", "us", "ca", "it"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
<script src="jquery-3.5.1.min.js"></script>
<script type="text/javascript">

		$('#change').on('click', function(){
			var old_pass = $('#old_pass').val();
			var new_pass = $('#new_pass').val();
			var confirm_pass = $('#confirm_pass').val();
			
			if(old_pass == "" || new_pass == "" || confirm_pass == ""){
				alert("Please complete the required field!");
			}else{
				$.ajax({
					url: 'edit.php',
					type: 'POST',
					data: {old_pass: old_pass, new_pass: new_pass, confirm_pass: confirm_pass, user_id: <?php echo $_SESSION['user_id']?>},
					success: function(data){
						if(data == "success"){
							$("#display").html("<center class='alert-success'>You successfully change the password</center>");
							$('#old_pass').val('');
							$('#new_pass').val('');
							$('#confirm_pass').val('');
						}else if(data == "error1"){
							$("#display").html("<center class='alert-danger'>Current password does not match</center>");
						}else if(data == "error2"){
							$("#display").html("<center class='alert-danger'>New password does not match</center>");
						}
					}
				});
			}
		});
	});
</script>	
</body>

</html>