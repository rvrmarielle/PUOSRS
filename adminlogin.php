<?php
session_start();
$db_link = mysqli_connect('localhost','root','','db') or die("ERROR" . mysqli_error($db_link));

if(isset($_POST['login']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$q = mysqli_query($db_link, "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'");
	$row = mysqli_fetch_array($q);

	if(is_array($row))
	{
		$_SESSION['id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['last_time'] = time();

	}else{
		$_SESSION['wrongalert'] = "Your email is incorrect!";
		header("Location: csdl_login.php");

	}
}if(isset($_SESSION['username'])){

	
	header("Location: home_csdl.php");
}

?>