<?php
include("db.php");

session_start();


// add
if (isset($_POST['submit'])) {
    $id= $_POST['id'];
    $cnum= $_POST['cnum'];
 
    $ccode= $_POST['ccode'];
    $ylevel= $_POST['ylevel'];
    $hkcategory= $_POST['hkcategory'];
    $college= $_POST['college'];
    $hnum= $_POST['hnum'];
    $brgy= $_POST['brgy'];
    $city= $_POST['city'];
    $province= $_POST['province'];

    $orphoto= $_FILES['orphoto'];
    $comphoto= $_FILES['comphoto'];

    

    $img_name = $_FILES['orphoto']['name'];
    $img_size = $_FILES['orphoto']['size'];
    $tmp_name = $_FILES['orphoto']['tmp_name'];
    $error = $_FILES['orphoto']['error'];

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");
   
    if (in_array($img_ex_lc, $allowed_exs)) {
     $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
     $img_upload_path = 'uploads/' . $new_img_name;
     move_uploaded_file($tmp_name, $img_upload_path);

    $img_name1 = $_FILES['comphoto']['name'];
    $img_size1 = $_FILES['comphoto']['size'];
    $tmp_name1 = $_FILES['comphoto']['tmp_name'];
    $error1 = $_FILES['comphoto']['error'];

    $img_ex1 = pathinfo($img_name1, PATHINFO_EXTENSION);
    $img_ex_lc1 = strtolower($img_ex1);
    $allowed_exs1 = array("jpg", "jpeg", "png");
   
    if (in_array($img_ex_lc1, $allowed_exs1)) {
     $new_img_name1 = uniqid("IMG-", true) . '.' . $img_ex_lc1;
     $img_upload_path1 = 'uploads/' . $new_img_name1;
     move_uploaded_file($tmp_name1, $img_upload_path1);


     $_SESSION['statusapp'] = "Form Submitted!";
     $db_link->query("UPDATE listofmembers SET  cnum='$cnum' , hkcategory='$hkcategory', ccode='$ccode', college='$college', ylevel='$ylevel', hnum='$hnum', city='$city', brgy='$brgy', province='$province', orphoto='$new_img_name', comphoto='$new_img_name1', type='1', first_date='now()' WHERE id=$id") or die($db_link->error);
     
     header('location: view.php');
    }
}
    }




//edit account profile
if (isset($_POST['editprofile'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $mobileNumber = $_POST['mobileNumber'];
   
    $db_link->query("UPDATE members SET name='$name', lname='$lname', mobileNumber='$mobileNumber', updated_date=CURDATE() WHERE id='$id'") or die($db_link->error);
 header("Location: account_committee.php");
}

?>
