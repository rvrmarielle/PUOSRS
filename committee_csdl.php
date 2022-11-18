<?php 
include ("db.php");
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
            <img src="images/header.jpg" alt="" class="" style="margin-left:310px">
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
    <div class="page-content pt-4 pl-4" id="content">
    <p class="text-dark font-weight-bold text-uppercase small px-2 p-3 bg-white">CSDL ASSISTANTS</p>
        
    <div class="container-fluid mt-2">
        <div class="row">
        <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="committee_csdl.php">Committee</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addmem.php">Add Member</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-striped table-sm border" cellspacing="0"
                    width="100%" height="300px" style="font-size:13px">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contacts</th>
                            <th>Date Joined</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM members";
                        $result = mysqli_query($db_link, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td style="text-align: center;">

                                    <img src="uploads/<?= $row['img_url'] ?>" alt="" style="width: 40px; height:40px; border-radius: 100%;" class="img-circle">
                                </td>
                                <td><?php echo strtoupper ($row['name']);?></td>
                                <td><?php echo strtoupper ($row['lname']); ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['mobileNumber']; ?></td>
                                <td><?php echo $row['created_date']; ?></td>
                                <td>
                                  
                                    <a href="" class="badge badge-primary p-2" data-toggle="modal" data-target="#details<?php echo $row['id']; ?>"><span class="badge-action" data-placement="top" title="details" ><i class="fa fa-info" aria-hidden="true" style="width:10px;"></i></span></a>
                                    <a href="" class="badge badge-warning p-2" data-toggle="modal" data-placement="top" title="edit" data-target="#edit<?php echo $row['id']; ?>"><span><i class="fa fa-pencil" aria-hidden="true" style="width:10px; color:white;"></i></span></a>
                                    <a href="" class="badge badge-danger p-2" data-toggle="modal" data-placement="top" title="delete" data-target="#delete<?php echo $row['id']; ?>"><span><i class="fa fa-trash" aria-hidden="true" style="width:10px;"></i></span></a>
                                    
                                </td>
                                <td></td>
                            </tr>

                            <!-- modal delete -->
                            <div class="modal fade" id="delete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                            <a type="button" class="btn btn-danger btn-sm" href="functions.php?delete=<?php echo $row["id"] ?>">Confirm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <!-- modal edit -->
                            <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="functions.php" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Date created</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['created_date'] ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Last update</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['updated_date'] ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                
                                                <label for="name">First Name</label>
                                                <input style="margin-top: -5px;" type="text" name="name" class="form-control form-control-sm" value="<?php echo strtoupper ($row['name']) ?>" required>
                                                
                                                <label style="margin-top: 10px;" for="name">Last Name</label>
                                                <input style="margin-top: -5px;" type="text" name="lname" class="form-control form-control-sm" value="<?php echo strtoupper ($row['lname']) ?>" required>
                                                
                                                <fieldset disabled>
                                                <label for="contacts" style="margin-top: 10px;">Email</label>
                                                <input style="margin-top: -5px;" type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email'] ?>" required></fieldset>

                                                <label for="contacts" style="margin-top: 10px;">Contact No.</label>
                                                <input style="margin-top: -5px;" type="tel" name="contacts" class="form-control form-control-sm" value="<?php echo $row['mobileNumber'] ?>" required>

                                                <label for="contacts" style="margin-top: 10px;">Gender</label>
                                                <input style="margin-top: -5px;" type="text" name="gender" class="form-control form-control-sm" value="<?php echo strtoupper ($row['gender']) ?>" required>

                                                <label for="contacts" style="margin-top: 10px;">Birthdate</label>
                                                <input style="margin-top: -5px;" type="date" name="bdate" class="form-control form-control-sm" value="<?php echo $row['bdate'] ?>" required>

                                                <label for="contacts" style="margin-top: 10px;">Address</label>
                                                <input style="margin-top: -5px;" type="text" name="address" class="form-control form-control-sm" value="<?php echo strtoupper ($row['address']) ?>" required>
                                                

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                            <button type="submit" name="update" class="btn btn-success btn-sm">Save Changes</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- modal details -->
                            <div class="modal fade" id="details<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                        <div class="card-body" style="font-size:13px">
                                            <div class="row ">
                                                            <div class="col-sm-4">
                                                            <div class="image-cropper">
                                                            <img src="uploads/<?= $row['img_url'] ?>"  alt="" style="float: center; width: 100px;" class="img-circle"></div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row ">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Full Name</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary" name="name">
                                                            <?php echo strtoupper ($row['name']) ?> <?php echo strtoupper ($row['lname']) ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Email</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['email']?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Mobile</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo strtoupper ($row['mobileNumber']) ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">gender</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['gender'] ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Birthdate</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['bdate'] ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px">Address</h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo strtoupper ($row['address']) ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px"><u>Date created</u></h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['created_date'] ?>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                            <h6 class="mb-0" style="font-size:13px"><u>Last updated</u></h6>
                                                            </div>
                                                            <div class="col-sm-8 text-secondary">
                                                            <?php echo $row['updated_date'] ?>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        } ?>
                    </tbody>
                </table>



    </div>

<?php } ?>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-print-2.2.2/datatables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myDataTable').DataTable({
       dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                messageTop: 'List of HK Committee',
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

</html>