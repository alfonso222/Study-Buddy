<?php include 'studybuddyfunctions.php';
	checkIfLogin();
	checkIfSubmit();
	
	$userID = $_SESSION['user_id'];
	
	$coursechoices = array();
	$courses = array();
	$courseDescription = "default";

	
	
		
	$database = connectToDatabase();
	
	for ($i = 0; $i< 5; $i++)
	{
		if(isset($_POST['course'.$i]) && $_POST['coursenumber'.$i] != null && isset($_POST['coursechoice'.$i]))
		{		
			$coursechoices[$i] = $_POST['coursechoice'.$i];
			$courses[$i] = "".$_POST['course'.$i]."".$_POST['coursenumber'.$i]."";	
		
			
			// Query that checks if course exists. Inserts course only if its not already there
			// !!!!!!!!!!!!Query does not work if the table is empty!!!!!!!!!!!!!!!!!
			$query1 = "INSERT INTO `course` (courseID, subjectName) 
			SELECT ?, ? FROM `course` 
			WHERE NOT EXISTS (SELECT * FROM `course` 
			WHERE courseID = ?) 
			LIMIT 1";
			$stmt = $database -> prepare($query1);
			$stmt->bind_param('sss',$courses[$i], $courseDescription, $courses[$i]);
			$stmt->execute();	
			
			
			// Query that inserts into buddy/tutor only if it is not already there
			// !!!!!!!!!!!!Query does not work if the table is empty!!!!!!!!!!!!!!!!!
			$query2 = "INSERT INTO ".$coursechoices[$i]." (userID, courseID) 
			SELECT ?, ? FROM ".$coursechoices[$i]." 
			WHERE NOT EXISTS (SELECT userID, courseID FROM ".$coursechoices[$i]." 
			WHERE userID = ? AND courseID = ?) 
			LIMIT 1 
			";
			if($stmt2 = $database -> prepare($query2))
				echo"prepared<br>";
			if($stmt2->bind_param('isis', $_SESSION['user_id'], $courses[$i], $_SESSION['user_id'], $courses[$i]))
				echo "binded<br>";
			if($stmt2->execute())
				echo"executed<br>";
			
			
			$database->close();	
			
			header("Location: home.php");
			
		}
			
		
	}
	header("Location: home.php");	

?>