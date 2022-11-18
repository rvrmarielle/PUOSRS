<?php 
require("db.php");
session_start();
if(!isset($_SESSION["id"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logout.php");
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
                    $query = "SELECT * FROM members WHERE id='$user_id'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-3 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img src="uploads/<?= $row['img_url'] ?>" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0"><?php echo $row['name']; ?>
                    </h4>
                    <p class="font-weight-normal text-muted mb-0">HK Committee</p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_committee.php" class="nav-link text-secondary">
                    <i class="fa fa-th-large mr-3 text-secondary fa-fw"></i>
                    home
                </a>
            </li>
            <li class="nav-item">
                <a href="pending_committee.php" class="nav-link text-secondary">
                    <i class="fa fa-address-card mr-3 text-secondary fa-fw"></i>
                    pending
                </a>
            </li>
            <li class="nav-item">
                <a href="status_committee.php" 
                class="nav-link text-secondary">
                    <i class="fa fa-cubes mr-3 text-secondary fa-fw"></i>
                    status
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white bg-success" href="account_committee.php">
                    <i class="fa fa-user mr-3 text-white fa-fw"></i>account
                </a>
            </li>
            <li class="nav-item">
                <a href="logoutcom.php" class="nav-link text-secondary">
                    <i class="fa fa-sign-out mr-3 text-secondary fa-fw"></i>
                    logout
                </a>
            </li>

        </ul>
    </div>



    <div class="page-content pt-4 pl-4" id="content">

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">USER ACCOUNT</p>

    <div class="container-fluid">
    <div class="card">
      <div class="card-body border" style="margin:20px;">
      <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-id-card-o" aria-hidden="true"></i> Full Name
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['name']); ?> <?php echo strtoupper ($row['lname']); ?>
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
                    <i class="fa fa-phone-square" aria-hidden="true"></i> Contacts
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['mobileNumber']); ?>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-user" aria-hidden="true"></i> Gender
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['gender']); ?> 
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-birthday-cake" aria-hidden="true"></i> Birthdate
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['bdate']); ?> 
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Address
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['address']); ?> 
                    </div>
                  </div>
                  
                  <br>
                  <a href="" data-toggle="modal" data-target="#editprofile<?php echo $row['id']; ?>">edit profile</a> | 
                  <a href="" data-toggle="modal" data-target="#changepass">change password</a>
                  
                  
                  
      </div>
    </div>
    </div>


        <!--Modal for Edit Profile-->

    <div class="modal fade" id="editprofile<?php echo $row['id']; ?>">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

                <form action="functions.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div class="row">
                        <div class="col">
                    
                    <label for="name" style="margin-top: 10px;">Firstname</label>
                    <input style="margin-top: -5px;" type="text" name="name" class="form-control form-control-sm" value="<?php echo strtoupper ($row['name']); ?>" required>
    </div>
                    <div class="col">
                    <label for="name" style="margin-top: 10px;">Lastname</label>
                    <input style="margin-top: -5px;" type="text" name="lname" class="form-control form-control-sm" value="<?php echo strtoupper ($row['lname']); ?>" required>
    </div>
    </div>
                    <fieldset disabled>                    
                    <label style="margin-top: 10px;" for="disabledTextInput">Email</label>
                    <input style="margin-top: -5px;" type="email" id="disabledTextInput" class="form-control form-control-sm" value="<?php echo $row['email']; ?>" required></fieldset>
                    
                    <label for="contacts" style="margin-top: 10px;">Contacts</label>
                    <input style="margin-top: -5px;" type="tel" name="contacts" class="form-control form-control-sm" value="<?php echo $row['mobileNumber']; ?>" required>

                    <div class="row">
                        <div class="col">
                    
                    <label for="name" style="margin-top: 10px;">Gender</label>
                    <input style="margin-top: -5px;" type="text" name="gender" class="form-control form-control-sm" value="<?php echo strtoupper ($row['gender']); ?>" required>
    </div>
                    <div class="col">
                    <label for="name" style="margin-top: 10px;">Birthdate</label>
                    <input style="margin-top: -5px;" type="date" name="bdate" class="form-control form-control-sm" value="<?php echo strtoupper ($row['bdate']); ?>" required>
    </div>
    </div>
                    <label for="contacts" style="margin-top: 10px;">Address</label>
                    <input style="margin-top: -5px;" type="text" name="address" class="form-control form-control-sm" value="<?php echo $row['address']; ?>" required>

        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <button type="submit" name="editcom" class="btn btn-success btn-sm">Save Changes</button>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>

    <!--Modal for Change Password-->
    <div class="modal fade" id="changepass">
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
                    <input type="hidden" name="id" value="">
                    
                    <label for="password">Old Password</label>
                    <input style="margin-top: -5px;" type="password" name="name" class="form-control form-control-sm" value="" required>
                                                
                    <label style="margin-top: 10px;" for="password">New Password</label>
                    <input style="margin-top: -5px;" type="password" name="lname" class="form-control form-control-sm" value="" required>

                    <label for="password" style="margin-top: 10px;">Confirm Password</label>
                    <input style="margin-top: -5px;" type="password" name="contacts" class="form-control form-control-sm" value="" required>
            </div>
        
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Save Changes</button>
        </div>

    </div>
    </div>
    </div>
    </div>>



<?php } ?>
<footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
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
</body>

</html>