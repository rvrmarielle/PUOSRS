<?php 
include ("db.php");
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
    <title>Settings</title>
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
                    <h4 class="m-0"><?php echo strtoupper ($row['username']); ?></h4>
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
                <a href="settings.php" class="nav-link bg-success text-white">
                    <i class="fa fa-sign-out mr-3 text-white fa-fw"></i>
                    Settings
                </a>
            </li>

        </ul>
    </div>
    <div class="page-content pt-4 pl-4" id="content">
    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">LIST OF HK SCHOLARS</p>
    
        
    <div class="container-fluid bg-white p-3">

            <form action="" method="GET">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" name="from_date" class="form-control form-control-sm" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>To Date</label>
                            <input type="date" name="to_date" class="form-control form-control-sm" placeholder="mm/dd/yyyy" >
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Click to Filter</label><br>
                            <input type="submit" name="filter" class="btn btn-success btn-sm" value="Submit">
                        </div>
                    </div>
                </div><br>
            </form>

                <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
                    <thead class="bg-dark text-white" style="font-size:12px">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Student No.</th>
                            <th>HK</th>
                            <th>Year Level</th>
                            <th>Course</th>
                            <th>College</th>
                            <th></th>
                        </tr>
                        </thead>
                        <?php
                        if(isset($_GET['from_date']) && isset($_GET['to_date']))
                        {
                            $from_date = $_GET['from_date'];
                            $to_date = $_GET['to_date'];
                
                            $query = "SELECT * FROM listofmembers WHERE first_date BETWEEN '$from_date' AND '$to_date'";
                            $query_run = mysqli_query($db_link, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= strtoupper ($row['fname']) ?></td>
                                                <td><?= strtoupper ($row['lname']) ?></td>
                                                <td><?= strtoupper ($row['snum']) ?></td>
                                                <td><?= strtoupper ($row['hkcategory']) ?></td>
                                                <td><?= strtoupper ($row['ylevel']) ?></td>
                                                <td><?= strtoupper ($row['ccode']) ?></td>
                                                <td><?= strtoupper ($row['college']) ?></td>
                                                <td><a type="button" class="" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>" style="font-size:12px">view</a></td>

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
                             
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "No Record Found";
                                    }
                                }
                            ?>
                            
                    <tbody>
            </div>
            </div>

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
<script src="jquery-3.6.0.min.js"></script>
<script src="jquery.dataTables.min.js" crossorigin="anonymous"></script>

<script>
    $(document).ready( function () {
    $('#myDataTable').DataTable();
} );
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>