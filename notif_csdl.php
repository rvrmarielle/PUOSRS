<?php 
    include "db.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Notification</title>
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
    <div class="vertical-nav bg-white" id="sidebar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center">
                <img loading="lazy" src="images/user-profile.jpeg" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0">Nayeon</h4>
                    <p class="font-weight-normal text-muted mb-0">Student</p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_student.php" class="nav-link text-secondary">
                    <i class="fa fa-th-large mr-3 text-secondary fa-fw"></i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="view.php" class="nav-link text-secondary">
                    <i class="fa fa-address-card mr-3 text-secondary fa-fw"></i>
                    View Application
                </a>
            </li>
            <li class="nav-item">
                <?php 
                
                $sql = mysqli_query ($db_link,"SELECT * FROM annoucement WHERE status='0'");
                $count = mysqli_num_rows($sql); ?>

                <a class="nav-link text-white bg-success" href="notif_csdl.php">
                    <i class="fa fa-bell mr-3 text-white fa-fw"></i>notification
                    <span class="badge badge-danger" id="count"><?php echo $count; ?></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="account_student.php" class="nav-link text-secondary">
                    <i class="fa fa-user mr-3 text-secondary fa-fw"></i>
                    profile
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-secondary">
                    <i class="fa fa-sign-out mr-3 text-secondaryy fa-fw"></i>
                    logout
                </a>
            </li>

        </ul>
    </div>



    <div class="page-content pt-4 pl-4" id="content">

        <div class="content-body">

        <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">NOTIFICATION</p>


    <div class="container-fluid mt-2">
    <div class="row">
        <div class="col-12">
            <div class="card bg-white p-0">
                <div class="card-body" style="padding-left:100px;padding-right:100px">
                

                <table id="myDataTable" class="table table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
                    <thead class="bg-success text-white">
                        <tr>
                            <td></td>
                        </tr>
                    </thead>

                <?php
                        $query = "SELECT * FROM annoucement ORDER BY title DESC";
                        $result = mysqli_query($db_link, $query);
                        while ($row = mysqli_fetch_array($result)) {
                        $id=$row['id'];
                        ?>
                    <tr>
                        <td >
                    <div class="card">
                        <span class="p-3">
                            <p style="font-size:12px"><span class="font-weight-bold" style="font-size:14px">HK Committee </span>posted an announcement
                            <i class="fa fa-calendar-o float-right" style="font-size:12px" aria-hidden="true"> 
                                <?php echo $row['post_created']?></i></span></p>
                            <blockquote class="blockquote mb-0">
                            <p class="font-weight-bold m-0 p-0" style="font-size:13px"><?php echo $row['title'] ?>
                            <form action="accept.php?id=<?php echo $row['id']; ?>" method="POST">
                            <input type="hidden" name="appidre" value="<?php echo $row['id']; ?>">
                            <input type="submit" class="btn btn-sm btn-outline-secondary float-right" name="read" value="open" style="font-size:10px">
                        </td>
                        </tr>
                <?php }?>
                </div>
            </div>
         </div>
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
    $(document).ready( function () {
    $('#myDataTable').DataTable({
        "pageLength": 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
    });
} );
</script>
</html>