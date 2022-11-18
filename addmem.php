<?php 
require("db.php");
session_start();
if(!isset($_SESSION["username"]))
{
    header("Location:login.php");
}elseif((time() - $_SESSION['last_time']) > 400){

    header("Location:logout.php");
}
error_reporting(0);
?>
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
                    <p class="font-weight-normal text-muted mb-0">HK Administrator</p>
                </div>
            </div>
        </div>

        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Navigation</p>

        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item">
                <a href="home_csdl.php" class="nav-link text-secondary" name="home">
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
                class="nav-link bg-success text-white">
                    <i class="fa fa-cubes mr-3 text-white fa-fw"></i>
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
    <?php } ?>
    <div class="page-content pt-4 pl-4" id="content">
    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">CSDL ASSISTANTS</p>
        
    <div class="container-fluid mt-2">
        <div class="row">
        <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="committee_csdl.php">Committee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="addmem.php">Add Member</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
            <form action="functions.php" method="POST" enctype="multipart/form-data" style="margin-right:50%">

            <div class="form-group">
                <input type="text" name="name" class="form-control form-control-sm" placeholder="Enter first name" required>
            </div>

            <div class="form-group">
                <input type="text" name="lname" class="form-control form-control-sm" placeholder="Enter last name" required>
            </div>

            <div class="form-group">
                <input type="email" name="email" class="form-control form-control-sm" placeholder="Enter e-mail" required>
            </div>

            <div class="form-group">
                <input id="phone" type="tel" name="contacts" class="form-control form-control-sm" style="width: 100% !important;" required>
            </div>
            
            <div class="form-group ">
                <select id="inputgender" name="gender" class="form-control form-control-sm">
                    <option selected>Select Gender</option>
                    <option value="female">Female</option>
                    <option value="male">Male</option>
                    <option value="other">Other</option>
                </select>
            </div>
                
            <div class="form-group">
                <label for="date">Enter Birthdate</label>
            <input type="date" id="date" name="bdate" required/>
            </div>

            <div class="form-group">
                <input type="text" name="address" class="form-control form-control-sm" placeholder="Enter barangay, city/province" required>
            </div>
            
            <div class="form-group">
                <!-- <input type="hidden" name="photo"> -->
                <input type="file" name="my_image" class="custom-file" required>
                <img src="" width="120" class="rounded-circle img-thumbnail">
            </div>
            <div class="form-group">
            <button type="submit" name="add" class="btn btn-success btn-sm" value="Upload" style="padding-left:30px;padding-right:30px">Add</button>
            </form>
                                    </div>
                                </div>
                            </div>
                    </tbody>
                </table>



    </div>

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
    $('#myDataTable').DataTable();
} );
</script>

</html>