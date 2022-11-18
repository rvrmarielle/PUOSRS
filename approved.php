<?php 
include 'db.php';
session_start();
if(!isset($_SESSION["email"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logout.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Approved Scholars</title>
    <link rel="icon" href="images/loginlogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="e-style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
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
                    $users_email = $_SESSION['email'];

                    $query = "SELECT * FROM members WHERE email='$users_email'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-3 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img src="uploads/<?= $row['img_url'] ?>" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0"><?php echo ucwords ($row['name']); ?></h4>
                    <p class="font-weight-normal text-muted mb-0">CSDL Committee</p>
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
                class="nav-link text-white bg-success">
                    <i class="fa fa-cubes mr-3 text-white fa-fw"></i>
                    status
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-secondary" href="account_committee.php">
                    <i class="fa fa-user mr-3 text-secondary fa-fw"></i>profile
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

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">APPLICATION STATUS</p>

        <div class="container-fluid bg-white p-3 pr-3">
               

        <div class="card mb-3">
            <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="status_committee.php">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="approved.php">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rejected.php"> Rejected</a>
                </li>
                </ul>
            </div>
            <div class="card-body">

                    <table id="myDataTable" class="display table table-striped table-bordered" cellspacing="0"
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
                        <th class="th-sm">Approved Date
                        </th>
                        <th class="th-sm">Action
                        </th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
                        $query = "SELECT * FROM ListOfMembers WHERE type='2'";
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

                                <td><?php 
							 			if ($row['type'] == 1) {
											echo "<span class='badge badge-warning'>Pending</span>";
							 			}
							 			else if ($row['type'] == 2){
											echo "<span class='badge badge-success'>Approved</span>";
							 			}
                                         else {
                                            echo "<span class='badge badge-danger'>Reject</span>";
                                         }
							 		
							 		 ?></td>
                                      <td> 
                                <a type="button" class="" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>" style="font-size:12px">view</a></td>
                            </tr> 

                         <!-- modal details -->
                        <div class="modal fade" id="details<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                            
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
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                    <?php } ?>
                

                    <footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
              


                        </div>
<?php } ?>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["ph", "us", "ca", "it"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myDataTable').DataTable({
       dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                messageTop: 'List of Approved HK Scholars',
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

</html>