<?php include 'studybuddyfunctions.php';
	checkIfLogin();
	checkIfSubmit();		
	
	
	$userIDReceive = $_SESSION['user_id'];
	$userIDSend = $_POST['userrequestID'];
	$answer = $_POST['answer'];
	
	$database = connectToDatabase();
	
	$query = "DELETE FROM myrequest 
	WHERE userIDSend = ? AND userIDReceive = ? OR userIDSend = ? AND userIDReceive = ?;";
	 
	$stmt = $database -> prepare($query);
	$stmt->bind_param('iiii', $userIDSend, $userIDReceive, $userIDReceive, $userIDSend);
	$stmt->execute();	
	
	
	if($answer == 1)
	{
		$query2 = "INSERT INTO mybuddies (userID, userID_myBuddies) 
		VALUES (?,?)";
		$stmt2 = $database -> prepare($query2);
		$stmt2->bind_param('ii', $userIDReceive, $userIDSend);
		$stmt2->execute();	
		
		$query3 = "INSERT INTO mybuddies (userID, userID_myBuddies) 
		VALUES (?,?)";
		$stmt3 = $database -> prepare($query3);
		$stmt3->bind_param('ii', $userIDSend, $userIDReceive);
		$stmt3->execute();
	}
	
	
	$database->close();	
	header("Location: buddies.php");
	
	
	
?>