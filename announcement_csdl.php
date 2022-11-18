<?php 
    include 'db.php';
    session_start();
    error_reporting(0);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Announcement</title>
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
            <a class="nav-link active" href="announcement_csdl.php">Recent Posts</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="create_ann.php">Create</a>
        </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="m-3 p-1">

        <?php
			if(isset($_SESSION['wrongalert']))
			{
				?>
  						<p style="font-size:13px; width:100%" class="p-2 m-2 text-white text-centered">Succesfully posted!</p>
                          
					</div>
				<?php
				
				unset($_SESSION['wrongalert']);
				
			}
			?>

        <p class="font-weight-bold text-secondary">RECENT POSTS</p>
        <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
            <thead>
            <th>
            </th>
    </thead>
            <tbody>
        <?php 
                 $query = "SELECT * FROM  annoucement ORDER BY id desc";
                 $result = mysqli_query($db_link, $query);
                 $count = 1;
                 while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td style="font-size:13px; padding:15px">HK Administrator posted an announcement <span class="float-right"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $row['post_created']; ?></span> <br>
                <span class="font-weight-bold text-secondary border-bottom"><?php echo $row['title']; ?></span> <br><span class="badge badge-danger">deadline date </span> <?php echo $row['dldate']; ?><br>
                <span class="ml-3 mt-3 float-left"><?php echo $row['description']; ?></span><td>
                 </tr>

                  
    <?php } ?>
    <?php } ?>
    </div>
    </div>
    </div>
</body>
<footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>
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
    $('#myDataTable').DataTable({
        "pageLength": 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    });
} );
</script>
</html>