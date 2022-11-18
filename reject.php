<?php
	include'db.php'; 
	if (isset($_POST['reject'])){
		$dispid = $_POST['dispid'];
		$sql = "UPDATE listofmembers SET type='3' WHERE id = '$dispid'";
		$run = mysqli_query($db_link,$sql);
		if($run == true){
			
			echo "<script> 
					alert('Application Disapproved');
					window.open('pending_committee.php','_self');
				  </script>";
		}else{
			echo "<script> 
			alert('Failed To Dispproved');
			</script>";
		}
	}
	
 ?>