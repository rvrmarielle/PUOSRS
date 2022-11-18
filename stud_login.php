<?php
session_start();
error_reporting();
$db_link = mysqli_connect('localhost','root','','db') or die("ERROR" . mysqli_error($db_link));

if(isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$q = mysqli_query($db_link, "SELECT * FROM listofmembers WHERE email = '$email' AND lname = '$password'");
	$row = mysqli_fetch_array($q);

	if(is_array($row))
	{
		$_SESSION['id'] = $row['id'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['lname'] = $row['lname'];
		$_SESSION['snum'] = $row['snum'];
		$_SESSION['last_time'] = time();

	}else{
		$_SESSION['committee'] = "Your email or password is incorrect!";
		header("Location: stud_login.php");
	}
}
if(isset($_SESSION['email'])){

	$db_link->query("INSERT INTO userlogs (email, postdate, type, ipadd) VALUES('$email', now(), 'Student', 'Successfully Login')") or die($db_link->error);
	header("Location: home_student.php");
}
?>