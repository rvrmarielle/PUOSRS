<?php 
    include("db.php");
    session_start();
    error_reporting(0);

if((time() - $_SESSION['last_time']) > 400){

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="e-style.css" >

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

        <div class="content-body">

        <div class="container-fluid mt-2">
        <div class="row">
        <div class="col-md-12">

        <div class="card ">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="scholars_csdl.php">Previous Scholars</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="addimport.php">Import/Add</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stat_csdl.php">Status</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approved_csdl.php">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="approved_csdl.php">Deactivate</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
            <p class="font-weight-bold">IMPORT FILE</p>
            <div class="p-3" style="width:300px">
                    <form  action="upload.php" method="POST" enctype="multipart/form-data"> 
                    <input type="file" name="excelDoc" id="excelDoc" /><br>
                    <i style="font-size:12px">only .csv file type is allowed to import</i><br></div>
                    <input type="submit" class="btn btn-success btn-sm mt-3" name="uploadBtn" id="uploadBtn" style="width:120px;font-size:12px"/><br><br>
                        </form>
                    <span>
                    <p style="font-size:12px">Required column format: firstname, <br>lastname, studentnum, email, hk, college</p>
                    </span></div>
                        <style>
                        .vl {
                        border-left: 1px solid green;
                        height: 240px;
                        position: absolute;
                        left: 50%;
                        margin-left: -3px;
                        margin-top: 100px;
                        top: 0;
                        }
                        </style>
                        <div class="vl"></div>

                        
                        <div class="col">
                        <form action="functions.php" method="POST">
                        <p class="font-weight-bold">ADD SCHOLAR</p>
                        <input type="text" 
                                class="form-control form-control-sm m-2" 
                                name="firstname" placeholder="Firstname"
                                autocomplete="off" required>
                        </input>
                        <input type="text" 
                                class="form-control form-control-sm m-2" 
                                name="lastname" placeholder="Lastname"
                                autocomplete="off" required>
                        </input>
                        <input type="email" 
                                class="form-control form-control-sm m-2" 
                                name="email" placeholder="Email Address"
                                autocomplete="off" required>
                        </input>
                        <input type="text" 
                                class="form-control form-control-sm m-2" 
                                name="studentnum" placeholder="Student Number"
                                autocomplete="off" required>
                        </input>
                        <select name="hk" class="form-control form-control-sm m-2">
                        <option>Hk Category</option>
                        <option value="HK25">Hk25</option>
                        <option value="HK50">Hk50</option>
                        <option value="HK75">Hk75</option>
                        </select>
                        <select name="college" class="form-control form-control-sm m-2">
                        <option>College</option>
                        <option value="CAS">CAS</option>
                        <option value="CEA">CEA</option>
                        <option value="CHS">CHS</option>
                        <option value="CITE">CITE</option>
                        <option value="CMA">CMA</option>
                        <option value="CSS">CSS</option>
                        <option value="SGPS">SGPS</option>
                        <option value="LAWJD">LAW JD</option>
                        </select>
                        
                        <input type="submit" class="btn btn-success btn-sm m-2" name="uploadBtn" id="uploadBtn" style="width:120px;font-size:12px"/>
                        </div>
                    </form>


            </div>
            </div>

      <?php } ?>

                        </div>
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
<script src="jquery-3.6.0.min.js"></script>
<script src="jquery.dataTables.min.js" crossorigin="anonymous"></script>

<script>
    $(document).ready( function () {
    $('#myDataTable').DataTable();
} );
</script>
<script>
    $('.btnprint').click(function){
        var prime = document.getElementById('myDataTable');
        var wme = window.open("","","width=900,height=700");
        wme.document.write(printme.outerHTML);
        wme.document.close();
        wme.focus();
        wme.print();
        wme.close();
    })
</script>

</body>

</html>

