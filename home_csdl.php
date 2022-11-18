<?php 
include 'db.php';
session_start();

if(!isset($_SESSION["id"]))
{
    header("Location: adminlogin.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logout.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="icon" href="images/loginlogo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="e-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script type="text/javascript" src="Chart.min.js"></script>
    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    
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
                    <h4 class="m-0"><?php echo $row['username'] ?></h4>
                    <p class="font-weight-normal text-muted mb-0">HK Administrator</p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <form action="data.php" method="POST">
                <a href="home_csdl.php" class="nav-link text-white bg-success" name="home" >
                    <i class="fa fa-th-large mr-3 text-white fa-fw" ></i>
                    home</form>
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

        <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">DASHBOARD</p>

<div class="container-fluid mt-2 mb-3">
    <div class="row">
        <div class="col-4 p-1">
            <div class="card bg-white p-0 card border border-primary" style="height:90px">
                <div class="card-body">
                <span class="float-right display-5 opacity-5"><img src="images/icon-users.png" alt="" class="float-right" width="50px"></span>
                <div class="d-inline-block">
                <?php 
                        $dash_users_query = "SELECT id FROM members UNION ALL SELECT id FROM listofmembers ";
                        $dash_users_query_run = mysqli_query($db_link,$dash_users_query);

                        if($total_users = mysqli_num_rows($dash_users_query_run))
                        {
                            echo '<h5 class="font-weight-bold"  style="color:#206fe6">'.$total_users.'</h5>';
                        }else{
                            echo '<h5 class="font-weight-bold text-success">0</h5>';
                        }
                        ?>
                    </div>
                    <p class="card-title " style="color:#206fe6"> Users</p>
                </div>
            </div>
        </div>
        
        <div class="col-4 p-1">
            <div class="card bg-white card border border-success" style="height:90px">
                <div class="card-body">
                <span class="float-right display-5 opacity-5"><img src="images/icon-committee.png" alt="" class="float-right" width="45px"></span>
                <div class="d-inline-block">
                <?php 
                        $dash_mem_query = "SELECT * FROM members";
                        $dash_mem_query_run = mysqli_query($db_link,$dash_mem_query);

                        if($total_mem = mysqli_num_rows($dash_mem_query_run))
                        {
                            echo '<h5 class="font-weight-bold text-success">'.$total_mem.'</h5>';
                        }else{
                            echo '<h5 class="font-weight-bold text-success">0</h5>';
                        }
                        ?>
                
                    </div>
                    <p class="card-title text-success">HK Committee</p>
                </div>
            </div>
        </div>
        <div class="col-4 p-1">
            <div class="card bg-white card border border-danger" style="height:90px">
                <div class="card-body">
                <span class="float-right display-5 opacity-5"><img src="images/icon-scholars.png" alt="" class="float-right" width="50px"></span>
                <div class="d-inline-block">
                <?php 
                        $dash_stu_query = "SELECT * FROM listofmembers";
                        $dash_stu_query_run = mysqli_query($db_link,$dash_stu_query);

                        if($total_stu = mysqli_num_rows($dash_stu_query_run))
                        {
                            echo '<h5 class="font-weight-bold text-danger">'.$total_stu.'</h5>';
                        }else{
                            echo '<h5 class="font-weight-bold text-danger">0</h5>';
                        }
                        ?>
                    </div>
                    <p class="card-title" style="color:#da3535">HK Scholars</p>
                </div>
    </div>
    </div>
    </div>

        <div class="row">
        
            <div class="col p-1">
            <div class="card bg-white pt-2 ">
                <div class="card-body">
            <table class="table table-borderless col-4" style="margin-top:30px">
                
                    <tr>
                    <td scope="col" class="p-0"><span><i class="fa fa-circle text-warning" aria-hidden="true"></i></span></td>
                    <td scope="col" class="p-0">Pending Request</td>
                    <td scope="col" class="p-0">
                        <?php 
                        $pending_query = "SELECT * FROM listofmembers WHERE type='1'";
                        $pending_query_run = mysqli_query($db_link,$pending_query);

                        if($total_pending = mysqli_num_rows($pending_query_run))
                        {
                            echo '<p>'.$total_pending.'</p>';
                        }else{
                            echo '<p>0</p>';
                        }
                        ?>
                </td>
                    </tr>
                    <tr data-toggle="modal" data-target="#approvedmodal">
                    <td scope="col" class="p-0"><span><i class="fa fa-circle text-success" aria-hidden="true"></i></span></td>
                    <td scope="col" class="p-0">Approved</td>
                    <td scope="col" class="p-0">
                    <?php 
                        $approved_query = "SELECT * FROM listofmembers WHERE type='2'";
                        $approved_query_run = mysqli_query($db_link,$approved_query);

                        if($total_approved = mysqli_num_rows($approved_query_run))
                        {
                            echo '<p>'.$total_approved.'</p>';
                        }else{
                            echo '<p>0</p>';
                        }
                        ?>
                    </td>
                    </tr>
                    <tr>
                    <td scope="col" class="p-0"><span><i class="fa fa-circle text-danger" aria-hidden="true"></i></span></td>
                    <td scope="col" class="p-0">Disapproved</td>
                    <td scope="col" class="p-0">
                    <?php 
                        $dapproved_query = "SELECT * FROM listofmembers WHERE type='3'";
                        $dapproved_query_run = mysqli_query($db_link,$dapproved_query);

                        if($total_dapproved = mysqli_num_rows($dapproved_query_run))
                        {
                            echo '<p>'.$total_dapproved.'</p>';
                        }else{
                            echo '<p>0</p>';
                        }
                        ?>
                    </td>
                    </tr>
                    <tr>
                    <td scope="col" class="p-0"><span><i class="fa fa-circle text-dark" aria-hidden="true"></i></span></th>
                    <td scope="col" class="p-0">Inactive Scholars</th>
                    </tr>
                    <?php 
   
                        $cite_query = "SELECT * FROM listofmembers WHERE college='CITE'";
                        $cite_query_run = mysqli_query($db_link,$cite_query);

                        if($cite = mysqli_num_rows($cite_query_run))
                        {
                            //echo '<p>'.$cite.'</p>';
                                
                        }
                        $CAS_query = "SELECT * FROM listofmembers WHERE college='CAS'";
                        $CAS_query_run = mysqli_query($db_link,$CAS_query);

                        if($CAS = mysqli_num_rows($CAS_query_run))
                        {
                            //echo '<p>'.$CAS.'</p>';
                        }
                        $CEA_query = "SELECT * FROM listofmembers WHERE college='CEA'";
                        $CEA_query_run = mysqli_query($db_link,$CEA_query);

                        if($CEA = mysqli_num_rows($CEA_query_run))
                        {
                            //echo '<p>'.$CEA.'</p>';
                        }
                        $CHS_query = "SELECT * FROM listofmembers WHERE college='CHS'";
                        $CHS_query_run = mysqli_query($db_link,$CHS_query);

                        if($CHS = mysqli_num_rows($CHS_query_run))
                        {
                            //echo '<p>'.$CHS.'</p>';
                        }
                        $CMA_query = "SELECT * FROM listofmembers WHERE college='CMA'";
                        $CMA_query_run = mysqli_query($db_link,$CMA_query);

                        if($CMA = mysqli_num_rows($CMA_query_run))
                        {
                            //echo '<p>'.$CMA.'</p>';
                        }
                        $CSS_query = "SELECT * FROM listofmembers WHERE college='CSS'";
                        $CSS_query_run = mysqli_query($db_link,$CSS_query);

                        if($CSS = mysqli_num_rows($CSS_query_run))
                        {
                            //echo '<p>'.$CSS.'</p>';
                        }
                        $SGPS_query = "SELECT * FROM listofmembers WHERE college='SGPS'";
                        $SGPS_query_run = mysqli_query($db_link,$SGPS_query);

                        if($SGPS = mysqli_num_rows($SGPS_query_run))
                        {
                            //echo '<p>'.$SGPS.'</p>';
                        }
                        $LAWJD_query = "SELECT * FROM listofmembers WHERE college='LAWJD'";
                        $LAWJD_query_run = mysqli_query($db_link,$LAWJD_query);

                        if($LAWJD = mysqli_num_rows($LAWJD_query_run))
                        {
                            //echo '<p>'.$LAWJD.'</p>';
                        }
                        ?>

    </div>


	    </div>
</div>
                    </div>
                    <style>
                        #chart-container{
                            width:"200px";
                            height:"200px";
                            margin-left:350px;
                            margin-right:350px;
                        }
                    </style>
<div id="chart-container">
<canvas id="myChart"></canvas>
</div>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['CAS', 'CEA', 'CHS', 'CITE', 'CMA', 'CSS', 'SGPS', 'LAWJD'],
        datasets: [{
            label: 'Scholars per Department',
            data: [<?php echo $CAS ?>,<?php echo $CEA ?>,<?php echo $CHS ?>,<?php echo $cite ?>,<?php echo $CMA ?>,<?php echo $CSS ?>,<?php echo $SGPS ?>,<?php echo $LAWJD ?>],
            backgroundColor: [
                'rgba(255, 99, 132,0.2)',
                'rgba(147,196,125,0.2)',
                'rgb(255,217,102,0.2)',
                'rgb(111,168,220,0.2)',
                'rgb(224,102,102,0.2)',
                'rgb(142,124,195,0.2)',
                'rgb(153,153,153, 0.2)',
                'rgb(193,137,0,0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgb(147,196,125)',
                'rgb(255,217,102)',
                'rgb(111,168,220)',
                'rgb(224,102,102)',
                'rgb(142,124,195)',
                'rgb(153,153,153)',
                'rgb(193,137,0)',

            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 
	</body>
    <?php } ?>
    <footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>
</html>
</body>




<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        preferredCountries: ["ph", "us", "ca", "it"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });
</script>
</body>

</html>