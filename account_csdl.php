<?php 
include 'db.php';
session_start();
if(!isset($_SESSION["id"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logout.php");
}
error_reporting(0);
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
            <img src="images/header.jpg" alt="" class="" style="margin-left:330px">
        </div>
        <?php 
                    $user_id = $_SESSION['id'];

                    $query = "SELECT * FROM tbl_admin WHERE id='$user_id'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img loading="lazy" src="uploads/<?= $row['img_csdl'] ?>" alt="No profile" width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0"><?php echo $row['username']; ?></h4>
                    <p class="font-weight-normal text-muted mb-0">HK Administrator</p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_csdl.php" class="nav-link text-secondary">
                    <i class="fa fa-th-large mr-3 text-secondary fa-fw"></i>
                    home
                </a>
            </li>
            <li class="nav-item">
                <a href="scholars_csdl.php" class="nav-link text-secondary">
                    <i class="fa fa-address-card mr-3 text-secondary fa-fw"></i>
                    scholars
                </a>
            </li>
            <li class="nav-item">
                <a href="committee_csdl.php" 
                class="nav-link text-secondary">
                    <i class="fa fa-cubes mr-3 text-secondary fa-fw"></i>
                    committee
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="announcement_csdl.php">
                    <i class="fa fa-bell mr-3 text-secondary fa-fw"></i>annoucement
                </a>
            </li>
        </ul>

        <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Menu</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="account_csdl.php" class="nav-link text-white bg-success">
                    <i class="fa fa-user mr-3 text-white fa-fw"></i>
                    User Account
                </a>
            </li>
            <li class="nav-item">
                <a href="userlogs.php" class="nav-link text-secondary">
                    <i class="fa fa-cog mr-3 text-secondary fa-fw"></i>
                    User Logs
                </a>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link text-secondary">
                    <i class="fa fa-sign-out mr-3 text-secondary fa-fw"></i>
                    Settings
                </a>
            </li>

        </ul>
    </div>


    <div class="page-content pt-4 pl-4" id="content">

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">USER ACCOUNT</p>

    <div class="container-fluid">
    <div class="card">

      <div class="card-body border" style="margin:20px;">

                    <div class="col-sm-2 m-3">
                    
                    <img src="uploads/<?= $row['img_csdl'] ?>" alt="No profile" style="width: 40px; height:40px; border-radius: 100%;" class="img-circle">
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
                    <i class="fa fa-user" aria-hidden="true"></i> Username
                    </div><div class="col-sm-6">
                    : <?php echo $row['username']; ?> 
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
                    : <?php echo strtoupper ($row['cnum']); ?>
                    </div>
                  </div>
                  <div class="row ">
                    <div class="col-sm-2">
                    <i class="fa fa-map-marker" aria-hidden="true"></i> Address
                    </div><div class="col-sm-6">
                    : <?php echo strtoupper ($row['address_user']); ?> 
                    </div>
                  </div><br>
                  <p>Last update: <?php echo $row['updated_date']; ?></p>
                  <a href="" data-toggle="modal" data-target="#editcsdl<?php echo $row['id']; ?>">edit profile</a> | 
                  <a href="changepass.php" >change password</a> |
                  <a href="logout.php" >logout</a>
                  
                  
                  
      </div>
    </div>
    <?php
                    if(isset($_SESSION['status']))
                    {
                        echo $_SESSION['status'];
                        unset($_SESSION['status']);
                    }
                    ?>
    </div>
                    
        <!--Modal for Edit Profile-->

    <div class="modal fade" id="editcsdl<?php echo $row['id']; ?>">
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
                    <label for="name" style="margin-top: 10px;">Change Profile</label>
                    <!-- <input type="hidden" name="photo"> -->
                <input type="file" name="img_csdl" class="custom-file" required>
                </div></div>

                    <div class="row">
                        <div class="col">
                    <label for="name" style="margin-top: 10px;">Firstname</label>
                    <input style="margin: -5px;" type="text" name="fname" class="form-control form-control-sm p-2" value="<?php echo strtoupper ($row['fname']); ?>" required>
    </div>
                    <div class="col">
                    <label for="name" style="margin-top: 10px;">Lastname</label>
                    <input style="margin-top: -5px;" type="text" name="lname" class="form-control form-control-sm" value="<?php echo strtoupper ($row['lname']); ?>" required>
    </div>
    </div>
                    <label style="margin-top: 10px;" for="disabledTextInput">Email</label>
                    <input style="margin-top: -5px;" type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email']; ?>" required>
                    
                    <label for="contacts" style="margin-top: 10px;">Contacts</label>
                    <input style="margin-top: -5px;" type="tel" name="cnum" class="form-control form-control-sm" value="<?php echo $row['cnum']; ?>" required>

                    <label for="name" style="margin-top: 10px;">City</label>
                    <input style="margin-top: -5px;" type="text" name="address_user" class="form-control form-control-sm" value="<?php echo strtoupper ($row['address_user']); ?>" required>
   </br>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          <button type="submit" name="editcsdl" class="btn btn-success btn-sm">Save Changes</button>
        </div>
        </form>
    </div>
    </div>
    </div>
    </div>

        
<?php } ?>
<footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>

</body>




</body>

</html>
