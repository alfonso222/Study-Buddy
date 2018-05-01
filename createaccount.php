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
	<?php include 'studybuddyfunctions.php';

		if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']))
		{
			generateMessage("<i class='fa fa-window-close' style='color: red;'></i> Pls Stop! >:(");
		} 
		else
		{
			$username = $_POST['username'];
			$password = password_hash($_POST['password'],PASSWORD_DEFAULT);
			$email = $_POST['email'];
			$firstname = $_POST['firstname'];	
			$lastname = $_POST['lastname'];	
			$empleID = 0;
			$major = "";
			$about = ""; 
			$interests = "";
			$image = "studybuddyimages/defaultprofile.png";
			
			
			// Connects to MySQL
			$database = connectToDatabase();
					
			// Checks if username is in database		
			$query1 = "SELECT COUNT(username) FROM user WHERE username = ?";
			$stmt = $database -> prepare($query1);	
			$stmt->bind_param('s',$username);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($numRows);
			$stmt->fetch();
			
			if($numRows > 0)
			{
				generateMessage("<i class='fa fa-window-close' style='color: red;'></i> This username already exists!");
			}
			else
			{
				
				//Inserts user into database
				$query2 = "INSERT INTO user (username, password, email, firstname, lastname, empleID, major, about, interests, image) 
				VALUES (?,?,?,?,?,?,?,?,?,?)";
				$stmt = $database -> prepare($query2);	
				$stmt->bind_param('sssssissss',$username,$password,$email,$firstname,$lastname,$empleID,$major,$about,$interests,$image);
				$stmt->execute();
	
				generateMessage("<i class='fa fa-check-square-o' style='color: green;'></i> You have successfully created an account!");
			}
						
	
			// Closes connection to MySQL
			$stmt->free_result();
			$database->close();
		
		
		}	
		


	?>
	</body>

</html>