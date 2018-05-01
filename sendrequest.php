<?php include 'studybuddyfunctions.php';
	checkIfLogin();
	checkIfSubmit();
	
	$userIDSend = $_SESSION['user_id'];
	$userIDReceive = $_GET['userfound'];
	$dateSent =  date("Y-m-d H:i:s");
	$isAccepted = 0;
	
	$database = connectToDatabase();
	
	
	// Query that checks if request exists. Inserts request only if its not already there
	// !!!!!!!!!!!!Query does not work if the table is empty!!!!!!!!!!!!!!!!!
	$query = "INSERT INTO myrequest (isAccepted, userIDSend, userIDReceive, dateSend)
	SELECT ?, ?, ?, ? FROM myrequest 
	WHERE NOT EXISTS (SELECT userIDReceive, userIDSend FROM myrequest 
	WHERE userIDReceive = ? AND userIDSend = ?) 
	LIMIT 1";
	 
	$stmt = $database -> prepare($query);
	$stmt->bind_param('iiisii', $isAccepted, $userIDSend, $userIDReceive, $dateSent, $userIDReceive, $userIDSend);
	$stmt->execute();	
	
	$database->close();	
	
	
	header("Location: home.php");
	
	
?>