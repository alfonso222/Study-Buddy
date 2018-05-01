<?php include 'studybuddyfunctions.php';
	checkIfLogin();
	checkIfSubmit();
	
	$userIDSend = $_SESSION['user_id'];
	$userIDReceive = $_POST['userIDSend'];
	$message = htmlspecialchars(trim($_POST['message']));
	$isread = 0;
	$dateSent =  date("Y-m-d H:i:s");
	
	
	$database = connectToDatabase();
	
	$query = "INSERT INTO message (content, isRead, userIDSend, userIDReceive, dateSend) VALUES (?,?,?,?,?)";
	 
	$stmt = $database -> prepare($query);
	$stmt->bind_param('siiis', $message, $isread, $userIDSend, $userIDReceive, $dateSent);
	$stmt->execute();	
	
	$database->close();	

	header("Location: showmessages.php");
?>