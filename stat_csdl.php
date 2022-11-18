<?php 
    include("db.php");
    session_start();
    if(!isset($_SESSION["username"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logout.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Scholars</title>
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
                    $user_email = $_SESSION['username'];

                    $query = "SELECT * FROM tbl_admin WHERE username='$user_email'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img loading="lazy" src="images/user-profile.jpeg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0"><?php echo ucwords ($row['username']) ?></h4>
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
                <a href="scholars_csdl.php" class="nav-link bg-success text-white">
                    <i class="fa fa-address-card mr-3 text-white fa-fw"></i>
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
                    <i class="fa fa-bell mr-3 text-secondary fa-fw"></i>announcement
                </a>
            </li>
        </ul>

        <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Menu</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="account_csdl.php" class="nav-link text-secondary">
                    <i class="fa fa-user mr-3 text-secondary fa-fw"></i>
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

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">HANDOG KAIBIGAN SCHOLARS</p>

        <div class="content-body" style="margin-bottom:30px;">

        <div class="container-fluid mt-2">
        <div class="row">
        <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="scholars_csdl.php">Previous Scholars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addimport.php">Import/Add</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="stat_csdl.php">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approved_csdl.php">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approved_csdl.php">Deactivate</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
            <div class="table-responsive">
            <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
                    <thead>
                        <tr>
                        <th class="th-sm">ID
                        </th>
                        <th class="th-sm">Name
                        </th>
                        <th class="th-sm">Email
                        </th>
                        <th class="th-sm">Student No.
                        </th>
                        <th class="th-sm">Department
                        </th>
                        <th class="th-sm">Action
                        </th>
                        <th class="th-sm">Status
                        </th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
                        $query = "SELECT * FROM ListOfMembers ORDER BY id DESC";
                        $result = mysqli_query($db_link, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr style="font-size:13px">
                                <td><?php echo $count++; ?></td>
                                <td><?php echo strtoupper ($row['fname']); ?> <?php echo strtoupper ($row['lname']); ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo strtoupper ($row['snum']); ?></td>
                                <td><?php echo strtoupper ($row['college']); ?></td>
                                <td>
                                  <?php if ($row['type'] == 0){ ?>
                                <a type="hidden" class="" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>" style="font-size:12px"></a>
                                 <?php }else{?>
                                    <a type="button" class="" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>" style="font-size:12px">view</a>
                                 <?php } ?>
                                </td>
                                <td><?php 
							 			if ($row['type'] == 1) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else if ($row['type'] == 2){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
                                         elseif ($row['type'] == 3){
                                            echo "<span class='badge badge-danger'>Disapproved</span>";
                                         }else{
                                            echo "<span class='badge badge-primary'>Null</span>";
                                         }
							 		
							 		 ?></td>
                                      <td></td>
                            </tr> 

                         <!-- modal details -->
                         <div class="modal fade" id="details<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title modal-title-sm" id="exampleModalLongTitle">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="container-fluid" style="font-size:14px">
                            <p class="text-primary">Form submitted:
                                    <?php echo strtoupper ($row['first_date']) ?></p>
                            <div class="row p-2">

                                <div class="col-6 rounded border col-sm">
                                    <p class="font-weight-bold pt-2">BASIC INFORMATION</p>

                                <div class="row pt-3">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Full Name</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['fname']) ?> <?php echo strtoupper ($row['lname']) ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Email Address</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo $row['email'] ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Contacts</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo $row['cnum'] ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Student Number</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo $row['snum'] ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Year Level</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['ylevel']) ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Course</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['ccode']) ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">College</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['college']) ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">HK Category</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['hkcategory']) ?>
                                    </div>
                                </div>
                            </div>

                                
                                <div class="col-6 rounded border col-sm">
                                    <p class="font-weight-bold pt-2">COMPLETE ADDRESS</p>
                                <div class="row pt-3">
                                    <div class="col-5">
                                    <p class="font-weight-bold">House No.</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['hnum']) ?> 
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Barangay</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['brgy']) ?>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">City</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['city']) ?>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Province</p>
                                    </div>
                                    <div class="col-7">
                                    <?php echo strtoupper ($row['province']) ?>
                                    </div>
                                </div><br>
                                <p class="font-weight-bold pt-2">REQUIREMENTS</p>
                                
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">Official Receipt</p>
                                    </div>
                                    <div class="col-7">
                                    <u class="text-primary " style="font-size:12px;">see photo</u>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                    <p class="font-weight-bold">COM Photo</p>
                                    </div>
                                    <div class="col-7">
                                    <u class="text-primary " style="font-size:12px;">see photo</u>
                                    </div>
                                </div>


                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                            </div>
                        </div>
                        </div>
                              <?php } ?> 
                              <?php } ?>          

                

            </div>
            </div>

      

                        </div>
                        <footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["ph", "us", "ca", "it"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/datatables.min.js"></script>
 <script>
     $(document).ready( function () {
     $('#myDataTable').DataTable({
        dom: 'Bfrtip',
         buttons: [
             {
                 extend: 'print',
                 messageTop: 'List of Existing Scholars',
                 exportOptions: {
                     columns: ':visible'
                 }
             },
             'colvis'
         ],
         columnDefs: [ {
             targets: -1,
             visible: false
         } ]
     });
     
 } );
 </script>

</body>

</html>

