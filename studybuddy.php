<?php include 'studybuddyfunctions.php';?>
<html>
<head>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- Optional theme -->
   
	
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="studybuddy.css">
	<script src="studybuddy.js"></script>

</head>

<body>
	

	
	<?php 
				
	
		if (!isset($_POST['submit']))
		{
			$errormessage = " ";
			generateLoginForm($errormessage);
		}
		else
		{
		
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);
			// Connects to MySQL
			$database = connectToDatabase();
			
			
			$query = "SELECT password FROM user WHERE username = ?";
			$stmt =  $database -> prepare($query);	
			$stmt->bind_param('s',$username);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($hash);
			$stmt->fetch();
			
				
			if(password_verify($password, $hash))	
			{
				// Checks if username is in database		
				$query1 = "SELECT userID, firstname, lastname, email, empleID, major, image, about, interests 
				FROM user WHERE username = ?";
				$stmt = $database -> prepare($query1);	
				$stmt->bind_param('s',$username);
				$stmt->execute();
				$stmt->store_result();
				$stmt->bind_result($user, $user_firstname, $user_lastname, $user_email, $user_empleID, $user_major, $user_image, $user_about, $user_interests);
				$stmt->fetch();
				
			
				session_start();
				$_SESSION['user_id'] = $user;
				$_SESSION['user_firstname'] = $user_firstname;
				$_SESSION['user_lastname'] = $user_lastname;
				$_SESSION['user_email'] = $user_email;
				$_SESSION['user_empleID'] = $user_empleID;
				$_SESSION['user_major'] = $user_major;
				$_SESSION['user_image'] = $user_image;
				$_SESSION['user_about'] = $user_about;
				$_SESSION['user_interests'] = $user_interests;
			
						
				// Closes connection to MySQL
				$stmt->free_result();
				$database->close();	
				
				
				header("Location:home.php");
						
				
					
			}	
			else
			{		
				// Closes connection to MySQL
				$stmt->free_result();
				$database->close();	
				generateLoginForm("<center><span class='label label-danger' ><i class='fa fa-window-close'></i>  The information you entered is incorrect please try again!</span><br><br></center>");
			}
		
		
				
			
		}
	?>

		
</body>

</html>
