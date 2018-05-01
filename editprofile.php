<?php include 'studybuddyfunctions.php';
	checkIfLogin();
	
	if(!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']))
	{
		header("Location: home.php");
	} 
	else
	{
		$userID = $_SESSION['user_id'];
		$firstname= trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$email = trim($_POST['email']);
		$empleID = trim($_POST['empleID']);
		$major = trim($_POST['major']);
		$about = trim($_POST['about']);
		$interests= trim($_POST['interests']);
			
		// Connect to database	
		$database = connectToDatabase();
			
		// Upload image CODE
		$target_dir = "useruploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		/* Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}*/
		
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 10000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
	
		if($uploadOk == 1)
		{
			echo "we here";
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
		}
		else
		{
			$target_file = $_SESSION['user_image'];
		}
			
		// Code to update all personal information and then set session varibales to newly entered inputs.
		$query2 = "UPDATE user SET firstName = ?, lastName = ?, email = ?, empleID = ?, major = ?, image = ?, about = ?, interests = ?   
		WHERE userID = ?";
				
		$stmt = $database -> prepare($query2);
		$stmt->bind_param('sssissssi',$firstname, $lastname, $email, $empleID, $major, $target_file, $about, $interests, $userID);
		$stmt->execute();	
		$_SESSION['user_firstname'] = $firstname;
		$_SESSION['user_lastname'] = $lastname;
		$_SESSION['user_email'] = $email;
		$_SESSION['user_empleID'] = $empleID;
		$_SESSION['user_major'] = $major;
		$_SESSION['user_image'] = $target_file;
		$_SESSION['user_about'] = $about;
		$_SESSION['user_interests'] = $interests;
			
		echo $target_file;
		
		// Closes connection to MySQL
		$stmt->free_result();
		$database->close();		
		
		header("Location: home.php");
	
	}
	
	
	

?>