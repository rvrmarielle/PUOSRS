<?php
include("db.php");
session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<title>Application Form</title>
	<link rel="icon" href="images/loginlogo.png">
	<link rel="stylesheet" href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
                    $user_id= $_SESSION['id'];

                    $query = "SELECT * FROM listofmembers WHERE id='$user_id'";
                    $result = mysqli_query($db_link, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        
                    ?>
	<div class="container pt-5">
		<a href="home_student.php" class="float-left">Go Back to Home</a>
    <form action="form_function.php" method="POST" class="row g-2" enctype="multipart/form-data">
			<h4 class="display-5 text-center">Renewal Application</h4>

            <p class="text-center
            " style="font-size:11px">Before you fill up, you understood that the Information and content you provide. We collect the content, communications and other information you provide when you use our PUOSRS system, including when you apply for renewal in scholarship, upload content, and message or communicate with others. This can include information in or about the content you provide, such as the photo or the date a file was created. <br>For full information click <a href="https://www.privacy.gov.ph/data-privacy-act/" style="font-size:11px">data privacy act</a>, If you are agreeing to our terms click submit.</p> 
        <label class="heading mt-3">Personal Information</label>
            <div class="row mb-2">
            <div class="col-md-6">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="floatingInput">First Name</label>
            <fieldset disabled>
            <input type="fname" 
                class="form-control" 
                name="fname" 
                autocomplete="off" value="<?php echo ucwords ($row['fname']) ?>" required>
            </div></fieldset>

            <div class="col-md-6">
            
            <label for="lname">Last Name</label>
            <fieldset disabled>
            <input type="lname" 
                class="form-control" 
                name="lname" 
                autocomplete="off" value="<?php echo ucwords ($row['lname']) ?>" required></fieldset>
            </div>
            </div><br>

            <fieldset disabled>
			<div class="row mb-2">
            <label for="email">Email</label>
            
            <div class="col-md-12">
            <input type="email" 
                class="form-control" 
                name="email"   
                autocomplete="off" value="<?php echo ucwords ($row['email']) ?>" required>
            </div></div></fieldset><br>

            <div class="row mb-2">
            <div class="col-md-6">
            <label for="num">Contact Number</label>
            
            <input type="tel" 
                class="form-control" 
                name="cnum"   
                autocomplete="off"required>
            </div>

            <div class="col-md-6">
            <label for="snum">Student Number</label>
            <fieldset disabled>
            <input type="snum" 
                class="form-control" 
                name="snum"   
                autocomplete="off" value="<?php echo ucwords ($row['snum']) ?>" required></fieldset>
            </div>
            </div><br>

            <div class="row mb-2">
            <div class="col-md-6">
            <label for="ccode">Course Code ex. BSIT </label>
            
			<input type="ccode" 
                class="form-control" 
                name="ccode"   
                autocomplete="off" required>
            </div>

            <div class="col-md-6">
            <label for="college">College</label>
            
			<select class="form-control browser-default custom-select " name="college">
				<option selected>Click to select</option>
				<option value="CAS">CAS</option>
				<option value="CEA">CEA</option>
				<option value="CHS">CHS</option>
				<option value="CITE">CITE</option>
				<option value="CMA">CMA</option>
				<option value="CSS">CSS</option>
				<option value="SGPS">SGPS</option>
				<option value="LAWJD">LAWJD</option>
				</select>
            </div>
            </div><br>


            <div class="row mb-2">
            <div class="col-md-6">
            <label for="ccode">Year Level</label>
            
			<select class="form-control browser-default custom-select " name="ylevel">
				<option selected>Click to select</option>
				<option value="1">First Year</option>
				<option value="2">Second Year</option>
				<option value="3">Third Year</option>
				<option value="4">Fourth Year</option>
				</select>
            </div>

            <div class="col-md-6">
            <label for="college">HK Category</label>
            
            <input type="text" 
                class="form-control" 
                name="hkcategory"   
                autocomplete="off" required>

            </div>
            </div><br>


            <label class="heading">Complete Home Address</label>

            <div class="row mb-2">
            <div class="col-md-6">
            <label for="hnum">House #</label>
            
            <input type="hnum" 
                class="form-control" 
                name="hnum" 
                autocomplete="off" required
                placeholder="">

            </div>

            <div class="col-md-6">
            <label for="text">Barangay</label>
            
            <input type="brgy" 
                class="form-control" 
                name="brgy" 
                autocomplete="off" required
                placeholder="">
            </div>
            </div><br>

            <div class="row mb-2">
            <div class="col-md-6">
            <label for="text">City/Municipality</label>
            
            <input type="city" 
                class="form-control" 
                name="city"   
                autocomplete="off" required
                placeholder="">  
            </div>

            <div class="col-md-6">
            <label for="text">Province</label>
            
            <input type="prvnc" 
                class="form-control" 
                name="province"   
                autocomplete="off" required
                placeholder="">
                <br>
            </div>
            </div>
			 <label class="heading mt-3">Required Attachments</label><br>
			 <p style="font-size:12px">Upload pictures only with an extension of .jpg, .jpeg, and .png</p>
			 
			 <label> Official Receipt for Registration</label>

			 <div class="input-group mb-3">
				<input type="file" 
				class="form-control" 
				id="inputGroupFile01"
				name="orphoto">
			</div>

			<label>COM/Official Registration Form (or screenshot from portal)</label>

			 <div class="input-group mb-3">
				<input type="file" 
				class="form-control" 
				name="comphoto">
			</div>

		
  			<button type="submit" 
  					class="btn btn-success"
  					name="submit">Submit</button>

		</form>

<?php } ?>
		<footer class="bg-light fixed-bottom p-2" style="text-align:center; font-size:12px;">All Rights Reserved @ 2022 PUOSRS</footer>
</body>

	</div>
</body>
</html>