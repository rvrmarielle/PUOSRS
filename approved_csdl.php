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
                    <h4 class="m-0"><?php echo $row['username']; ?></h4>
                    <p class="font-weight-normal text-muted mb-0">CSDL Administrator</p>
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
                    <a class="nav-link" href="stat_csdl.php">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="approved_csdl.php">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approved_csdl.php">Deactivate</a>
                </li>
                
                </ul>
            </div>
            <div class="card-body">
            <div class="table-responsive">
            <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0" width="100%" height="300px" style="font-size:13px">
                <thead>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Student No.</th>
                    <th>Email</th>
                    <th>College</th>
                    <th></th>
            </thead>
            </tbody>
            <?php
                        $query = "SELECT * FROM `listofmembers` WHERE type='2'";
                        $result = mysqli_query($db_link, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr style="font-size:13px">
                            <td><?php echo $count++; ?></td>
                            <td><?php echo strtoupper ($row['fname']);?></td>
                            <td><?php echo strtoupper ($row['lname']);?></td>
                            <td><?php echo strtoupper ($row['snum']);?></td>
                            <td><?php echo ($row['email']);?></td>
                            <td><?php echo strtoupper ($row['college']);?></td>
                            <td>

                              <td></td>
                        </tr>
                       
                        <?php } ?>
                        <footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
                        </tbody>
            </table>
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

        </div>
            </div>
            </div>
         </div>
         <?php } ?>
</body>
</html>

