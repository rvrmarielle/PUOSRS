<?php 
    include("db.php");
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
    <title>Pending</title>
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
                    $users_id = $_SESSION['id'];

                    $query = "SELECT * FROM members WHERE id='$users_id'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-3 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img src="uploads/<?= $row['img_url'] ?>" alt="images/user-profile.jpeg" width="80" height="50" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0"><?php echo ucwords ($row['name']); ?></h4>
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
                <a href="pending_committee.php" class="nav-link bg-success text-white">
                    <i class="fa fa-address-card mr-3 text-white fa-fw"></i>
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

    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">PENDING APPLICATION</p>
    <div class="card mb-3">
            <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="status_committee.php">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="records.php">Complete</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " href="records.php">Incomplete</a>
                </li>
                </ul>
            </div>
        <div class="container-fluid bg-white p-3 pr-3">

                <?php
			if(isset($_SESSION['label']))
			{
				?>
					<div class="alert alert-success" role="alert">
  						Thank you for submitting your form!
					</div>
				<?php
				
				unset($_SESSION['label']);
				
			}
			?>


                    <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
                    <thead>
                        <tr >
                        <th class="th-sm">ID
                        </th>
                        <th class="th-sm">Fullname
                        </th>
                        <th class="th-sm">Student No.
                        </th>
                        <th class="th-sm">HK Category
                        </th>
                        <th class="th-sm">Date Submitted
                        </th>
                        <th class="th-sm">Actions</th>
                        <th class="th-sm">
                        </th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
                        $query = "SELECT * FROM listofmembers WHERE type='1'";
                        $result = mysqli_query($db_link, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            
                            <tr style="font-size:13px">
                                <td ><?php echo $count++; ?></td>
                                <td><?php echo strtoupper ($row['fname']); ?> <?php echo strtoupper ($row['lname']); ?></td>
                                <td><?php echo  $row['snum']; ?></td>
                                <td><?php echo strtoupper ($row['snum']); ?></td>
                                <td><?php echo strtoupper ($row['cnum']); ?></td>
                                <td><?php echo strtoupper ($row['first_date']); ?></td>
                                <td>
                                  
                                    <a href="" class="badge badge-primary p-2" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="see details"><span><i class="fa fa-info" aria-hidden="true" style="width:10px;"></i></span></span></a>

                                    <a href="" class="badge badge-success p-2" data-toggle="modal" data-target="#approved<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="approved"><span><i class="fa fa-thumbs-up" aria-hidden="true" style="width:10px;"></i></span></span></a>

                                    <a href="" class="badge badge-danger p-2" data-toggle="modal" data-target="#disapproved<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="disapproved"><span><i class="fa fa-thumbs-down" aria-hidden="true" style="width:10px;"></i></span></span></a>
                                    
                                </td>
                            </tr> 

                             <!--modal approved-->

                             <div class="modal fade" id="approved<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approved</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             
                                            </div>
                                            <div class="modal-body">
                                                <p> Are you sure you want to approved this?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                
                                                <form action="accept.php?id=<?php echo $row['id']; ?>" method="POST">
                                                <input type="hidden" name="appid" value="<?php echo $row['id']; ?>">
                                                <input type="submit" class="btn btn-sm btn-success" name="approve" value="Approve">
                                            </form>

                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                         <!--modal disapproved-->
                             <div class="modal fade" id="disapproved<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Disapproved</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold"> Are you sure you want to disapproved this?</p><p class="text-sm"> Send a message why disapproving the application. <br>
                                                
                                                <div class="row">
                                                    <div class="col-1">
                                                <i class="fa fa-phone fa-md" aria-hidden="true"></i> 
                                                </div>
                                                <div class="col-3"><?php echo $row['cnum'];?><br></div></div>
                                                
                                                <div class="row">
                                                    <div class="col-1">
                                                        <i class="fa fa-envelope-o" aria-hidden="true"></i> </div>
                                                        <div class="col-3">
                                                            <?php echo $row['email']; ?> </p>
                                                            </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                
                                                <form action="reject.php?id=<?php echo $row['id']; ?>" method="POST">
                                                <input type="hidden" name="dispid" value="<?php echo $row['id']; ?>">
                                                <input type="submit" class="btn btn-sm btn-danger" name="reject" value="Reject">
                                            </form>

                                            </div>
                                            </div>
                                        </div>
                                        </div>

                        <!-- modal details -->
                        <div class="modal fade" id="details<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            
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
                                                    <img src="uploads/<?= $row['orphoto'] ?>" alt="" style="width: 60px; height:60px;" id="orphoto">
                                                    </div>
                                                </div><br>
                                                <div class="row">
                                                    <div class="col-5">
                                                    <p class="font-weight-bold">COM Photo</p>
                                                    </div>
                                                    <div class="col-7">
                                                    <img src="uploads/<?= $row['comphoto'] ?>" alt="" style="width: 60px; height:60px;" id="comphoto">
                                                    </div>
                                                </div>

                                                        
                                                </div>
                                                                
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                   
                    
                <?php } ?>

              

                        </div>
<?php } ?>
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
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/jquery-3.5.1.js"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myDataTable').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
</script>

</html>