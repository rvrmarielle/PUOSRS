<?php
include("db.php");
session_start();
error_reporting(0);

// add
if (isset($_POST['add']) && isset($_FILES['my_image'])) {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $lname = $_POST['lname'];
 $contacts = $_POST['contacts'];
 $gender = $_POST['gender'];
 $bdate = $_POST['bdate'];
 $address = $_POST['address'];
 $my_image = $_POST['my_image'];

 
 // img validation
 $img_name = $_FILES['my_image']['name'];
 $img_size = $_FILES['my_image']['size'];
 $tmp_name = $_FILES['my_image']['tmp_name'];
 $error = $_FILES['my_image']['error'];

 $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
 $img_ex_lc = strtolower($img_ex);
 $allowed_exs = array("jpg", "jpeg", "png");
 $_SESSION['status']="Data Inserted Successfully";
 if (in_array($img_ex_lc, $allowed_exs)) {
  $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
  $img_upload_path = 'uploads/' . $new_img_name;
  move_uploaded_file($tmp_name, $img_upload_path);}

  $db_link->query("INSERT INTO members (name, lname,email, mobileNumber, gender, bdate, address, img_url, password,created_date) VALUES('$name','$lname', '$email', '$contacts','$gender','$bdate','$address', '$new_img_name', '$lname',CURDATE())") or die($db_link->error);
  $db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('$username', now(), 'Admin', 'Added a HK Committee')") or die($db_link->error);
  header('location: committee_csdl.php');
 }


// delete
if (isset($_GET['delete'])) {
 $id = $_GET['delete'];
 $db_link->query("DELETE FROM members WHERE id=$id") or die($db_link->error);
 header("Location: committee_csdl.php");
}

//delete scholar
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $db_link->query("DELETE FROM listofmembers WHERE id=$id") or die($db_link->error);
    header("Location: scholars_csdl.php");
   }

//delete all scholars
if (isset($_GET['deleteall'])) {
    $id = $_GET['deleteall'];
    $db_link->query("TRUNCATE TABLE listofmembers") or die($db_link->error);
    $db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('Admin', now(), 'Admin', 'Deleted list of HK scholars')") or die($db_link->error);
    header("Location: scholars_csdl.php");
   }
   //delete all userlogs
if (isset($_GET['reset'])) {
    $id = $_GET['reset'];
    $db_link->query("TRUNCATE TABLE userlogs") or die($db_link->error);
    header("Location: userlogs.php");
   }


// edit
if (isset($_POST['update'])) {
 $id = $_POST['id'];
 $name = $_POST['name'];
 $lname = $_POST['lname'];
 $email = $_POST['email'];
 $contacts = $_POST['contacts'];
 $gender = $_POST['gender'];
 $bdate = $_POST['bdate'];
 $address = $_POST['address'];

 $db_link->query("UPDATE members SET name='$name', lname='$lname', mobileNumber='$contacts', gender='$gender',bdate='$bdate',address='$address',updated_date=CURDATE() WHERE id=$id") or die($db_link->error);
 $db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('$username', now(), 'Admin', 'Update the HK committee profile')") or die($db_link->error);
 header("Location: committee_csdl.php");
}
// edit committee profile
if (isset($_POST['editcom'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $contacts = $_POST['contacts'];
   
    $db_link->query("UPDATE members SET name='$name', lname='$lname', mobileNumber='$contacts' WHERE id='$id'") or die($db_link->error);
    $db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('$email', now(), 'Committee', 'Update the HK committee profile')") or die($db_link->error);
    header("Location: account_committee.php");
   }


// account edit
if (isset($_POST['editme'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $yrlvl = $_POST['yrlvl'];
    $course = $_POST['course'];
    $snum = $_POST['snum'];
    $address = $_POST['address'];
    $db_link->query("UPDATE members SET name='$name', lname='$lname',email='$email', mobileNumber='$contacts' WHERE id=$id") or die($db_link->error);
    header("Location: committee_csdl.php");
   }

   // account edit
    if (isset($_POST['editScholars'])) {
    $id = $_POST['id'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $email = $_POST['email'];
    $studentnum = $_POST['snum'];
    $hk = $_POST['hkcategory'];
    $college = $_POST['college'];

    $db_link->query("UPDATE listofmembers SET fname='$fname', lname='$lname',email='$email', snum='$snum', hkcategory='$hkcategory', college='$college' WHERE id=$id") or die($db_link->error);
    header("Location: scholars_csdl.php");
   }


   if (isset($_POST['post']))
    {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $dldate = date('Y-m-d', strtotime($_POST['dldate']));

        $_SESSION['wrongalert'] = "Successfully posted!";
        $db_link->query ("INSERT INTO annoucement (title, description, post_created,status, dldate) VALUES ('$title','$description',now(),'0','$dldate')")or die($db_link->error);
        header("Location: announcement_csdl.php");
        
    }

    //add exisitng scholar
    if (isset($_POST['uploadBtn'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $studentnum = $_POST['studentnum'];
        $hk = $_POST['hk'];
        $college = $_POST['college'];
        
         $db_link->query("INSERT INTO listofmembers (fname, lname, email, snum, hkcategory, college, profilepic) VALUES('$firstname','$lastname', '$email', '$studentnum', '$hk', '$college','images/user-profile.jpeg')") or die($db_link->error);
         $db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('$username', now(), 'Admin', 'Import HK scholars')") or die($db_link->error);
         header("Location: scholars_csdl.php");
        }

        //account csdl edit
        if (isset($_POST['editcsdl'])) {
            $id = $_POST['id'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email = $_POST['email'];
            $cnum = $_POST['cnum'];
            $address_user = $_POST['address_user'];
            $img_csdl = $_POST['img_csdl'];

 
            // img validation
            $img_name = $_FILES['img_csdl']['name'];
            $img_size = $_FILES['img_csdl']['size'];
            $tmp_name = $_FILES['img_csdl']['tmp_name'];
            $error = $_FILES['img_csdl']['error'];

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            $_SESSION['status']="Data Inserted Successfully";
            if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $img_upload_path = 'uploads/' . $new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);}
           
            $db_link->query("UPDATE tbl_admin SET fname='$fname', lname='$lname', email='$email', cnum='$cnum', address_user='$address_user',updated_date=CURDATE(), img_csdl='$new_img_name' WHERE id='$id'") or die($db_link->error);
            $db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('$username', now(), 'Admin', 'Edit profile successfully')") or die($db_link->error);
             header("Location: account_csdl.php");
        }?>
