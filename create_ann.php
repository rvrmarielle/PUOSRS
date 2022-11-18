<?php 
include ("db.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Committee</title>
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
                <img loading="lazy" src="images/user-profile.jpeg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
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
                <a class="nav-link text-white bg-success" href="announcement_csdl.php">
                    <i class="fa fa-bell mr-3 text-white fa-fw"></i>announcement
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

        <div class="content-body">

        <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">ANNOUNCEMENT</p>

        <div class="content-body">

<div class="container-fluid mt-2">
<div class="row">
<div class="col-md-12">

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link" href="announcement_csdl.php">Recent Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="create_ann.php">Create</a>
        </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="m-3 p-1">
            <p class="font-weight-bold text-secondary">CREATE ANNOUNCEMENT</p>
            <form action="functions.php" method="POST">
            <div class="mb-3 row">
                
            <label for="title" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
            <input type="text" class="form-control form-control-sm" name="title" style="width:330px;font-size:12px" required>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="description" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
            <textarea class="form-control rounded-0" rows="3" type ="text" name="description" style="width:330px; height:150px; font-size:12px" required></textarea>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="date" class="col-sm-2 col-form-label">Deadline Date</label>
            <div class="col-sm-10">
            <input type="date" id="date" name="dldate" required/>
            </div>
        </div>
        

        <div class="mb-3 row">
            <p style="font-size:12px">*all the posted announcement will be send to HK Scholars only</p>
            <div class="col-sm-10">
            <button type="submit" name="post" class="btn btn-success btn-sm" style="width:140px">Submit</button>
            </div>
        </div>
  
    </div>
    </div>
    </div>
    </form>
    <?php } ?>
</body>
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

</html>