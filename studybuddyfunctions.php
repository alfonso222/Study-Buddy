<?php
function connectToDatabase()
{
	$database = new mysqli("localhost", "alfonso222", "*********", "studybuddydb");
			
	if(mysqli_connect_errno())
	{
		echo mysqli_connect_error();
		exit();
	}
	else
		return $database;
}

function checkIfSubmit()
{
	if(!isset($_POST['submit']))
	{
		header("Location: home.php");
	}
}

function generateLoginForm($errormessage)
{	
	echo
	"
	
	
	<div class='container' id='login'>
		
		<center><img src='studybuddyimages/csilogox50.png' id='loginlogo'></center>
		
		<div class='row'>
		
			<div class='col-md-4 col-lg-4 col-xs-4 col-sm-4 col-md-offset-4 col-lg-offset-4 col-sm-offset-4 col-xs-offset-4'>			
				<form class='form-horizontal' method='post' action='studybuddy.php'>
					<!-- Username -->
					<div class='form-group'>
						<label for='usernamelogin' class='cols-sm-2 control-label'>Username</label>
						<div class='cols-sm-10'>
							<div class='input-group'>
								<span class='input-group-addon'><i class='fa fa-user fa' aria-hidden='true'></i></span>
								<input type='text' class='form-control' name='username' id='usernamelogin'  placeholder='Username' >
							</div>
						</div>
					</div>
					
					<!-- Password -->
					<div class='form-group'>
						<label for='passwordlogin' class='cols-sm-2 control-label'>Password</label>
						<div class='cols-sm-10'>
							<div class='input-group'>
								<span class='input-group-addon'><i class='fa fa-lock fa-lg' aria-hidden='true'></i></span>
								<input type='password' class='form-control' name='password' id='passwordlogin'  placeholder='Password' >
							</div>
						</div>
					</div>
					<!-- Submit Form -->
					".$errormessage."
					<div class='form-group '>
						<button type='submit' name='submit' class='btn btn-primary btn-lg btn-block login-button'>Sign in</button>
					</div>			
				</form>	
			</div>
		</div>	
	</div>


	<!-- Create Account -->
	<div class='row'>
		<!-- Trigger the modal with a button -->
		<center><button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>Create Account</button></center>
					
		<!-- Modal -->
		<div id='myModal' class='modal fade' role='dialog'>
			<div class='modal-dialog modal-md'>

				<!-- Modal content-->
				<div class='modal-content'>
					<div class='modal-header'>
					<h2 class='modal-title'>Create Account</h2>
					<p id='createaccounterrors'></p>
					</div>

					<div class='modal-body'>
						<form name='createaccountform' method='post' action='createaccount.php'>
						
							<div class='form-group'>	
								<label>Username</label>									
								<input type='text' class='form-control' name='username' maxlength='20' id='username'  required>
								<label id='usernamelabel'></label>	
							</div>
							
							<div class='form-group'>	
								<label>Password</label>
								<input type='password' class='form-control' name='password' id='password' maxlength='20' required>
								<label id='passwordlabel'></label>
							</div>
							
							<div class='form-group'>	
								<label>Email</label>
								<input type='email' class='form-control' name='email' id='email' required>		
								<label id='emaillabel'></label>
							</div>
							
							<div class='form-group'>	
								<label>First Name</label>
								<input type='text' class='form-control' name='firstname' id='firstname' maxlength='25' required>
								<label id='firstnamelabel'></label>
							</div>
							
							<div class='form-group'>
								<label>Last Name</label>
								<input type='text' class='form-control' name='lastname' id='lastname' maxlength='25' required>
								<label id='lastnamelabel'></label>
							</div>
							
							<!-- Submit Form -->
							<div class='form-group '>
							<center><button type='button' onclick='submitCreateAccount()' class='btn btn-primary btn-lg'>Create Account</button></center>
							</div>					
						</form>
					</div>

					<div class='modal-footer'>
					<center><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></center>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>><br>><br>><br>
	";
}	


function openModal()
{
	echo
	"
	<script type='text/javascript'>
    $(document).ready(function(){
        $('#myModal').modal('show');
    });
	</script>
	";
}

function generateMessage($message)
{
	echo
	"
		<div class='panel panel-default' id='absolutecenter'>
			<div class='panel-heading'><h4>".$message."</h4></div>
			<div class='panel-body'><center><a href='studybuddy.php' class='btn btn-default btn-lg'><i class='fa fa-arrow-left'> Back</i></a></center></div>
		</div>
	";
}

function checkIfLogin()
{
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		header("Location: studybuddy.php");
		exit();
	} 
}


function findBuddyTutor($searchElement, $buddyORtutor, $numOfResults)
	{
		$db = connectToDatabase();

		$query = "SELECT user.userID, firstName, lastName, image
			FROM user, ".$buddyORtutor."
			WHERE user.userID = ".$buddyORtutor.".userID 
			AND courseID = ? AND user.userID != ".$_SESSION['user_id']."
			ORDER BY firstName DESC LIMIT ".$numOfResults."";
			
		$stmt = $db -> prepare($query);
		$stmt->bind_param('s', $searchElement);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($userID, $firstName, $lastName, $picture);

		$i=0;
		$buddiesTutors=array();
		while ($stmt->fetch()) 
		{
			$buddiesTutors[$i]['userID']=$userID;
			$buddiesTutors[$i]['firstName']=$firstName;
			$buddiesTutors[$i]['lastName']=$lastName;
			$buddiesTutors[$i]['picture']=$picture;
			$i=$i+1;
		}
		
		$stmt->free_result();
		$db->close();
				
		return $buddiesTutors;
		

	}

	function findCourseTeaching_Learning($userID, $teachingORlearning, $numOfResults)
	{
		$db = connectToDatabase();

		$query = "SELECT course.courseID, subjectName
			FROM course, ".$teachingORlearning."
			WHERE course.courseID = ".$teachingORlearning.".courseID 
			AND userID = ? LIMIT ".$numOfResults;
			
		$stmt = $db -> prepare($query);
		$stmt->bind_param('s', $userID);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($courseID, $subjectName);

		$i=0;
		$courses=array();
		while ($stmt->fetch()) 
		{
			$courses[$i]['courseID']=$courseID;
			$courses[$i]['subjectName']=$subjectName;

			$i=$i+1;
		}
		
		$stmt->free_result();
		$db->close();
				
		return $courses;
		

	}
	
	function messagesNotRead($userID)
	{
		$db = connectToDatabase(); 

		$query = "SELECT messageID FROM message WHERE userIDReceive = ".$userID." AND isRead = 0;";
		$result = $db->query($query);
		
		$db->close();
		if($result->num_rows > 0)
			return $result->num_rows;
			
	}

	
	function pendingRequests($userID)
	{
		$db = connectToDatabase();
		
		

		//$query = "SELECT count(messageID) FROM message WHERE userIDReceive = ".$userID." AND isRead = 0;";
		$query = "SELECT requestID FROM myrequest WHERE userIDReceive = ".$userID.";";
		$result = $db->query($query);
		if($result->num_rows > 0)
			return $result->num_rows;
	}






	
	


		
	
	function getConversation($pUserID, $pUserID2, $listOrder, $num_of_messages) 
    {   
         $database = connectToDatabase();
         $query =   "SELECT messageID, content, isRead, userIDSend, userIDReceive, dateSend
                     FROM message
                     WHERE userIDReceive = ? AND userIDSend = ? OR userIDReceive = ? AND userIDSend = ?
                     ORDER BY dateSend ".$listOrder." LIMIT ".$num_of_messages.""; 
    
         $stmt = $database-> prepare($query);
         $stmt->bind_param('iiii', $pUserID, $pUserID2, $pUserID2, $pUserID);
         $stmt->execute();   
         $stmt->store_result();
         $stmt->bind_result($messageID, $content, $isRead, $userIDSend, $userIDReceive,  $dateSend);
         $i = 0;
		 
         $messages = array();
         while ($stmt->fetch()) {
             $date = date_create($dateSend);
             $messages[$i]['messageID']= $messageID;
             $messages[$i]['content']= $content;
             $messages[$i]['isRead']= $isRead;
             $messages[$i]['userIDSend']= $userIDSend;
             $messages[$i]['userIDReceive']= $userIDReceive;
             $messages[$i]['dateSend']= date_format($date, 'F d h:ia');// Formats date in anyway you want
             $i=$i+1;
         }   
    
         $stmt->free_result();
         $database->close();
    
         return $messages;
    
     }
	 
	 
	 function getMessages($pUserID, $listOrder, $num_of_messages) 
    {   
         $database = connectToDatabase();
         $query =   "SELECT messageID, content, isRead, userIDSend, userIDReceive, dateSend
                     FROM message
                     WHERE userIDReceive = ? 
                     ORDER BY dateSend ".$listOrder." LIMIT ".$num_of_messages.""; 
    
         $stmt = $database-> prepare($query);
         $stmt->bind_param('i', $pUserID);
         $stmt->execute();   
         $stmt->store_result();
         $stmt->bind_result($messageID, $content, $isRead, $userIDSend, $userIDReceive,  $dateSend);
         $i = 0;
		 
         $messages = array();
         while ($stmt->fetch()) {
             $date = date_create($dateSend);
             $messages[$i]['messageID']= $messageID;
             $messages[$i]['content']= $content;
             $messages[$i]['isRead']= $isRead;
             $messages[$i]['userIDSend']= $userIDSend;
             $messages[$i]['userIDReceive']= $userIDReceive;
             $messages[$i]['dateSend']= date_format($date, 'F d h:ia');// Formats date in anyway you want
             $i=$i+1;
         }   
    
         $stmt->free_result();
         $database->close();
    
         return $messages;
    
     }
	 
	 
	 function getName($pUserID) {
        $database = connectToDatabase();
        $query =   "SELECT firstname, lastname
                    FROM user 
                    WHERE userID = ?";

        $stmt = $database-> prepare($query);
        $stmt->bind_param('i', $pUserID);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($firstName, $lastName);
        while ($stmt->fetch()) {
            return ($name = array($firstName, $lastName));
        }   

        $stmt->free_result();
        $database->close();
        //var_dump($name);

        return $name;
    }

    function getImage($pUserID) 
	{
        $database = connectToDatabase();
        $query =   "SELECT image 
                    FROM user 
                    WHERE userID = ?";

        $stmt = $database-> prepare($query);
        $stmt->bind_param('i', $pUserID);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($image);


        while ($stmt->fetch()) {
            return $image;
        }
       
        //var_dump($image);
    }

	

	function findMyBuddies($userID, $numOfResults)
	{
		$db = connectToDatabase();

		$query = " SELECT mybuddies.userID_myBuddies, firstName, lastName, image
		FROM user, mybuddies
		WHERE user.userID = mybuddies.userID_myBuddies 
		AND mybuddies.userID = ? ORDER BY firstName DESC LIMIT ".$numOfResults."";

			
		$stmt = $db -> prepare($query);
		$stmt->bind_param('s', $userID);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($userID, $firstName, $lastName, $image);

		$i=0;
		$MYbuddiesTutors=array();
		while ($stmt->fetch()) {
	
			$MYbuddiesTutors[$i]['userID']=$userID;
			$MYbuddiesTutors[$i]['firstName']=$firstName;
			$MYbuddiesTutors[$i]['lastName']=$lastName;
			$MYbuddiesTutors[$i]['image']=$image;

			$i=$i+1;
		}
		
		$stmt->free_result();
		$db->close();
				
		return $MYbuddiesTutors;
		

	}


	function getRequests($userID, $listOrder, $num_of_requests)
	{
		$database = connectToDatabase();

		$query =   "SELECT requestID, isAccepted, userIDSend, userIDReceive, dateSend 
		FROM myrequest 
		WHERE userIDReceive = ?
		ORDER BY dateSend ".$listOrder." LIMIT ".$num_of_requests."
		"; 

		$stmt = $database-> prepare($query);
		$stmt->bind_param('i', $userID);
		$stmt->execute();   
		$stmt->store_result();
		$stmt->bind_result($requestID, $isAccepted, $userIDSend, $userIDReceive, $dateSend);
		$i = 0;

		$requests = array();
		while ($stmt->fetch()) {
		 $date = date_create($dateSend);
		 $requests[$i]['requestID']= $requestID;
		 $requests[$i]['isAccepted']= $isAccepted;
		 $requests[$i]['userIDSend']= $userIDSend;
		 $requests[$i]['userIDReceive']= $userIDReceive;
		 $requests[$i]['dateSend']= date_format($date, 'F d h:ia');// Formats date in anyway you want
		 $i=$i+1;
		}   

		$stmt->free_result();
		$database->close();

		return $requests;			
		
	}


	function isBuddy($userID, $userID2)
	{
		$database = connectToDatabase();
		
		$query = "SELECT count(*) FROM mybuddies WHERE userID = ? AND userID_myBuddies = ?"; 
		
		$stmt = $database-> prepare($query);
        $stmt->bind_param('ii', $userID, $userID2);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($isBuddy);

        while ($stmt->fetch()) 
		{
            return $isBuddy;
        }
		
		$database->close();
	}

	function setAllMessagesRead($userID)
	{
		$database = connectToDatabase();
		
		$query = "UPDATE message
		SET isRead = 1
		WHERE userIDReceive= ?"; 
		
		$stmt = $database-> prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
		
		$database->close();
	}


	function getUsersImConversingWith($userID)
	{
				
			
		$db = connectToDatabase();

		$query = "SELECT DISTINCT user.userID, firstName, lastName, image
		FROM user, message
		WHERE user.userID = message.userIDSend 	
		AND message.userIDReceive = ?
		UNION
		SELECT DISTINCT user.userID, firstName, lastName, image
		FROM user, message
		WHERE user.userID = message.userIDReceive
		AND message.userIDSend = ?";

			
		$stmt = $db -> prepare($query);
		$stmt->bind_param('ii', $userID, $userID);
		$stmt->execute();
		$stmt->store_result();
		$stmt->bind_result($userID, $firstName, $lastName, $image);

		$i=0;
		$users=array();
		while ($stmt->fetch()) {
	
			$users[$i]['userID']=$userID;
			$users[$i]['firstName']=$firstName;
			$users[$i]['lastName']=$lastName;
			$users[$i]['image']=$image;

			$i=$i+1;
		}
		
		$stmt->free_result();
		$db->close();
				
		return $users;
		
	}









?>



























