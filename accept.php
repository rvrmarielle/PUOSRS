<?php
	include'db.php'; 
	if (isset($_POST['approve'])){
		$appid = $_POST['appid'];
		$sql = "UPDATE listofmembers SET type='2' WHERE id = '$appid'";
		$run = mysqli_query($db_link,$sql);
		if($run == true){
			
			echo "<script> 
					alert('Application Approved');
					window.open('pending_committee.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Approved');
			</script>";
		}
	}

	if (isset($_POST['read'])){
		$appidre = $_POST['appidre'];
		$sql = "UPDATE annoucement SET type='1' WHERE id = '$appidre'";
		$run = mysqli_query($db_link,$sql);
	}
	
 ?>