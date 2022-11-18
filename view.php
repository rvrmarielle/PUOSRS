<?php 
    include("db.php") ;
    session_start();
    if(!isset($_SESSION["id"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 600){

    header("Location:logout.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Application</title>
    <link rel="icon" href="images/loginlogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="e-style.css">
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
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="view.php" class="nav-link text-white bg-success">
                    <i class="fa fa-address-card mr-3 text-white fa-fw"></i>
                    View Application
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a href="account_student.php" class="nav-link text-secondary">
                    <i class="fa fa-user mr-3 text-secondary fa-fw"></i>
                    profile
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link text-secondary">
                    <i class="fa fa-sign-out mr-3 text-secondaryy fa-fw"></i>
                    logout
                </a>
            </li>

        </ul>
    </div>

    <div class="page-content pt-4 pl-4" id="content">

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">VIEW APPLICATION</p>

    <div class="container-fluid bg-white p-3 pr-3">

        <span><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span><i> Scholarship Status</i>
                        <?php 
							 			if ($row['type'] == 1) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else if ($row['type'] == 2){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
                                         else if ($row['type'] == 3){
                                            echo "<span class='badge badge-danger'>Disapproved</span>";
                                         }else {
                                            echo "<span class='badge badge-primary'>Null</span>";
                                         }
							 		
							 		 ?>
        <?php
			if(isset($_SESSION['statusapp']))
			{
				?>
  						<p style="font-size:13px; width:100%" class="bg-success p-2 m-2 text-white text-centered">Successfully Submitted!</p>
                          
					</div>
				<?php
				
				unset($_SESSION['statusapp']);
				
			}
			?>
        <div class="card mt-3" style="margin-left:100px; margin-right:100px; padding:20px">
        <label class="heading">Personal Information</label>
            <div class="row">
            <div class="col-md-6">
            
            <label for="floatingInput">First Name</label>
            <fieldset disabled>
            <input type="fname" 
                class="form-control" 
                name="fname" 
                autocomplete="off" value="<?php echo ucwords ($row['fname']) ?>" required>
            </div></fieldset>

            <div class="col-md-6">
            
            <label for="lname">Last Name</label>
            <fieldset disabled>
            <input type="lname" 
                class="form-control" 
                name="lname" 
                autocomplete="off" value="<?php echo ucwords ($row['lname']) ?>" required></fieldset>
            </div>
            </div><br>

            <label for="email">Email</label>
            <fieldset disabled>
            <div class="input-group mb-3">
            <input type="email" 
                class="form-control" 
                name="email"   
                autocomplete="off" value="<?php echo $row['email'] ?>"  required>
            <span class="input-group-text">@example.com</span>
            </div><br></fieldset>

            <div class="row">
            <div class="col-md-6">
            <label for="num">Contact Number</label>
            <fieldset disabled>
            <input type="num" 
                class="form-control" 
                name="cnum"   
                autocomplete="off" value="<?php echo ucwords ($row['cnum']) ?>"  required></fieldset>
            </div>

            <div class="col-md-6">
            <label for="snum">Student Number</label>
            <fieldset disabled>
            <input type="snum" 
                class="form-control" 
                name="snum"   
                autocomplete="off" value="<?php echo ucwords ($row['snum']) ?>" required></fieldset>
            </div>
            </div><br>

            <div class="row">
            <div class="col-md-6">
            <label for="ccode">Course Code ex. BSIT </label>
            <fieldset disabled>
            <input type="course" 
                class="form-control" 
                name="ccode"   
                autocomplete="off" value="<?php echo strtoupper ($row['ccode']) ?>" required></fieldset>
            </div>

            <div class="col-md-6">
            <label for="college">College</label>
            <fieldset disabled>
            <input type="text" 
                class="form-control" 
                name="college"   
                autocomplete="off" value="<?php echo strtoupper ($row['college']) ?>"  required></fieldset>

            </div>
            </div><br>


            <div class="row">
            <div class="col-md-6">
            <label for="ccode">Year Level</label>
            <fieldset disabled>
            <input type="text" 
                class="form-control" 
                name="ylevel"   
                autocomplete="off" value="<?php echo ucwords ($row['ylevel']) ?>" required></fieldset>
            </div>

            <div class="col-md-6">
            <label for="college">HK Category</label>
            <fieldset disabled>
            <input type="text" 
                class="form-control" 
                name="hkcategory"   
                autocomplete="off" value="<?php echo ucwords ($row['hkcategory']) ?>"  required></fieldset>

            </div>
            </div><br>


            <label class="heading">Complete Home Address</label>

            <div class="row">
            <div class="col-md-6">
            <label for="college">House #</label>
            <fieldset disabled>
            <input type="hnum" 
                class="form-control" 
                name="hnum" 
                autocomplete="off" value="<?php echo ucwords ($row['hnum']) ?>" required
                placeholder="House No."></fieldset>

            </div>

            <div class="col-md-6">
            <label for="college">Barangay</label>
            <fieldset disabled>
            <input type="brgy" 
                class="form-control" 
                name="brgy" 
                autocomplete="off" value="<?php echo ucwords ($row['brgy']) ?>" required
                placeholder="Barangay">
            </div></fieldset>
            </div><br>

            <div class="row">
            <div class="col-md-6">
            <label for="college">City/Municipality</label>
            <fieldset disabled>
            <input type="city" 
                class="form-control" 
                name="city"   
                autocomplete="off" value="<?php echo ucwords ($row['city']) ?>" required
                placeholder="City/Municiplaity">  
            </div></fieldset>

            <div class="col-md-6">
            <label for="college">Province</label>
            <fieldset disabled>
            <input type="prvnc" 
                class="form-control" 
                name="province"   
                autocomplete="off" value="<?php echo ucwords ($row['province']) ?>" required
                placeholder="Province">
                <br></fieldset>
            </div>
            </div>

            <label class="heading">Required Attachments</label><br>

            <label> Official Receipt for Registration</label>

            <div class="input-group mb-3">
            <div class="image-cropper">
            <img src="uploads/<?= $row['orphoto'] ?>"  alt="" style="float: center; width: 300px;" class="img-thumbnail"></div>             
            </div>

            <label>COM/Official Registration Form (or screenshot from portal)</label>

            <div class="input-group mb-3">
            <div class="image-cropper">
            <img src="uploads/<?= $row['comphoto'] ?>"  alt="" style="float: center; width: 300px;" class="img-thumbnail"></div>    
            </div>
            
    </div>
    </div>

    <?php } ?>

    <footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready( function () {
        $("notifications").on("click", function() {
            $.ajax({
                url: "readNotif.php"
                success: function(res){
                    console.log(res);
                }
            });
        });
    });
</script>

<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["ph", "us", "ca", "it"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>

</body>

</html>