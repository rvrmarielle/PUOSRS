<?php 
include ("db.php");
session_start();

if(!isset($_SESSION['username']))
{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Userlogs</title>
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
                    <h4 class="m-0"><?php echo strtoupper ($row['username']); ?></h4>
                    <p class="font-weight-normal text-muted mb-0">HK Administrator</p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_csdl.php" class="nav-link text-secondary" >
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
                <a href="userlogs.php" class="nav-link bg-success text-white">
                    <i class="fa fa-cog mr-3 text-white fa-fw"></i>
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

        <div class="content-body">

        <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">USER LOGS</p>

<div class="container-fluid mt-2">
        <div class="card mb-3">
            <div class="card-body">
            <a type="button" class="btn btn-outline-danger btn-sm float-right mb-3" data-toggle="modal" data-placement="top" title="delete all" data-target="#reset" style="font-size:12px;">Delete all data</a>
            <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
                    <thead>
                        <tr>
                            <th style="text-align: left;">#</th>
                            <th style="text-align: left;">Email</th>
                            <th style="text-align: left;">User</th>
                            <th style="text-align: left;">DateTime</th>
                            <th style="text-align: left;">Activity</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM userlogs ORDER BY id DESC";
                        $result = mysqli_query($db_link, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr >
                                <td style="text-align: left;"><?php echo $count++; ?></td>
                                <td style="text-align: left;"><?php echo ucwords ($row['email']);?></td>
                                <td style="text-align: left;"><?php echo ucwords ($row['type']);?></td>
                                <td style="text-align: left;"><?php echo ucwords ($row['postdate']); ?></td>
                                <td style="text-align: left;"><?php echo ucwords ($row['ipadd']); ?></td>
                                <td></td>
            </div>
        </div>
         <!-- modal delete all -->
         <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete All</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            Please enter your password to confirm delete
                                            </i><input type="password" name="password"/>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                            <a type="button" class="btn btn-danger btn-sm" href="functions.php?reset">Confirm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
        <?php } ?>
        <footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
	</body>
</html>
</body>

<?php } ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                 messageTop: 'Userlogs Details',
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