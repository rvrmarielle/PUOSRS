<?php 
include ("db.php");
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="icon" href="images/loginlogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"></script>
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
            <img src="images/header.jpg" alt="" class="" style="margin-left:140px">
        </div>
        <?php 
                    $user_snum = $_SESSION['snum'];

                    $query = "SELECT * FROM listofmembers WHERE snum='$user_snum'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img loading="lazy" src="images/user-profile.jpeg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h6 class="m-0"><?php echo strtoupper ($row['fname']) ?> <?php echo strtoupper ($row['lname']) ?></h6>
                    <p class="font-weight-normal text-muted mb-0"><?php echo ucwords ($row['snum']) ?></p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_student.php" class="nav-link bg-success text-white">
                    <i class="fa fa-th-large mr-3 text-white fa-fw"></i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="view.php" class="nav-link text-secondary">
                    <i class="fa fa-address-card mr-3 text-secondary fa-fw"></i>
                    View Application
                </a>
            </li>
            </li>
            <li class="nav-item">
            <a href="account_student.php" class="nav-link text-secondary">
                    <i class="fa fa-user mr-3 text-secondary fa-fw"></i>
                    Account
                </a>
            </li>
            <li class="nav-item">
            <a href="logout.php" class="nav-link text-secondary">
                    <i class="fa fa-sign-out mr-3 text-secondary fa-fw"></i>
                    Logout
                </a>
            </li>

        </ul>
    </div>


    <div class="page-content pt-4 pl-4 mb-3" id="content">

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">HELLO STUDENT.</p>

 
    <div class="container-fluid bg-white p-3 pr-3 mb-3">
        <h4>HANDOG KAIBIGAN <br> SCHOLARSHIP</h4>
        <p class="text-bold">Ready to achieve your potential?</p>

        <a href="form.php"><input type="button" class="btn btn-success btn-sm mb-3" value="Apply Scholarship"></a>
        <?php
		if(isset($_SESSION['status']))
			{
				?>
					<div class="alert alert-success" role="alert">
  						<strong>Successfully Submmited!</strong> Your application form is now pending for approval.
						  
					</div>
				<?php
				
				unset($_SESSION['status']);
				
			}
			?>	


        <p class="font-weight-bold text-secondary">ANNOUNCEMENT</p>
        <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
            <thead>
            <th>
            </th>
    </thead>
            <tbody>
        <?php 
                 $query = "SELECT * FROM annoucement ORDER BY id DESC";
                 $result = mysqli_query($db_link, $query);
                 $count = 1;
                 while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td style="font-size:13px; padding:15px">HK Administrator posted an announcement <span class="float-right">
                <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $row['post_created']; ?></span> <br>

                <span class="font-weight-bold text-secondary border-bottom"><?php echo $row['title']; ?></span> 
                <br><span class="badge badge-danger">deadline date </span> <?php echo $row['dldate']; ?><br>
                <span class="ml-3 mt-3 float-left"><?php echo $row['description']; ?></span><td>
                 </tr>

                  
    <?php } ?>
    <?php } ?>
    </div>
    </div>
    </div>



        
    </div>

    </div>

<footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>
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
<?php

if (isset($_SESSION['status']) && $_SESSION['status'] != '')
{
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
            button: "Okay!",
        });
    </script>
    <?php
    unset($_SESSION['status']);
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/datatables.min.css"/>
 
 <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/datatables.min.js"></script>
 <script>
     $(document).ready( function () {
     $('#myDataTable').DataTable()
     
 } );
 </script>
</body>

</html>