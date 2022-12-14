<?php 
session_start();

if (isset($_SESSION['id'])) {

    include "db.php";

if (isset($_POST['op']) && isset($_POST['np'])
    && isset($_POST['c_np'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$op = validate($_POST['op']);
	$np = validate($_POST['np']);
	$c_np = validate($_POST['c_np']);
    
    if(empty($op)){
      header("Location: changepass.php?error=Old Password is required");
	  exit();
    }else if(empty($np)){
      header("Location: changepass.php?error=New Password is required");
	  exit();
    }else if($np !== $c_np){
      header("Location: changepass.php?error=The confirmation password  does not match");
	  exit();
    }else {
    	// hashing the password
    	$op = md5($op);
    	$np = md5($np);
        $id = $_SESSION['id'];

        $sql = "SELECT password
                FROM tbl_admin WHERE 
                id='$id' AND password='$op'";
        $result = mysqli_query($db_link, $sql);
        if(mysqli_num_rows($result) === 1){
        	
        	$sql_2 = "UPDATE tbl_admin
        	          SET password='$np'
        	          WHERE id='$id'";
        	mysqli_query($db_link, $sql_2);
        	header("Location: changepass.php?success=Your password has been changed successfully");
	        exit();

        }else {
        	header("Location: changepass.php?error=Incorrect password");
	        exit();
        }

    }

    
}else{
	header("Location: changepass.php");
	exit();
}

}else{
     header("Location: home_csdl.php");
     exit();
}