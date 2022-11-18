
<?php
include 'db.php';
session_start();

// account edit

   if (isset($_POST['editstud'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $hkcategory = $_POST['hkcategory'];
    $college = $_POST['college'];
	$city = $_POST['city'];

    $db_link->query("UPDATE listofmembers SET fname='$fname', lname='$lname',email='$email', hkcategory='$hkcategory', college='$college',city='$city' WHERE id=$id") or die($db_link->error);
    header("Location: account_student.php");
   }
   //change password

    $old_pass = md5($_POST['old_pass']);
	$new_pass = $_POST['new_pass'];
	$confirm_pass = $_POST['confirm_pass'];
	$user_id = $_POST['id'];
	
	$query = mysqli_query($db_link, "SELECT * FROM `scholars` WHERE `lastname` = '$old_pass' && `user_id` = '$user_id'") or die(mysqli_error());
	$rows = mysqli_num_rows($query);
	
	if($rows > 0){
		if($new_pass === $confirm_pass){
			$encrypt_pass = md5($new_pass);
			mysqli_query($db_link, "UPDATE `scholars` SET `lastname` = '$encrypt_pass' WHERE `user_id` = '$user_id'") or die(mysqli_error());
			echo "success";
		}else{
			echo "error2";
		}
	}else{
		echo "error1";
	}