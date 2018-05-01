<?php include 'studybuddyfunctions.php';
	checkIfLogin();
?>

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
	<div class="row">
	<header id="header">
	<!--Carousel-->
	<div class="slider">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
			<div class="item active">
			<img class="center-block" id="carouselpic" src="studybuddyimages/csibanner.png">
			</div>
			<div class="item">
			<img class="center-block" id="carouselpic" src="studybuddyimages/csibanner.png">
			</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="fa fa-angle-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="fa fa-angle-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
			</a>
		</div>
	</div><!--slider-->
	</div>
			
	<!----------------------- Navigation Bar -------------------------------->		
	<?php  include 'navbar.php' ?>
				
		
	</header><!--/#HEADER-->	
		
	
	
	<!-- End of Header-->




	<!-- Main Content -->
	
	<div class="row" style="background-color: #999999;">
		<div class="container"><br>				
			<div class="well" id="messagebox">	
				<table class="table " style="width: 80%; margin: auto;">					 				
	
						<?php 

							$searchterm = trim($_GET['searchterm']);
							$searchtype = trim($_GET['searchtype']);

							$array = findBuddyTutor(strtoupper($searchterm), $searchtype, 100);
							echo
							"
								<tbody>															
									<th>Users found: ".sizeof($array)."</th>																																		
							";
							
							
							foreach($array as $key => $value)
							{
								
							echo
							"																											
								<tr>
									<td style='line-height: 50px;'>										
										<img  id='avatar' class='img-circle' src=".$array[$key]['picture'].">
										<span>
										<b>".$array[$key]['firstName']." ".$array[$key]['lastName']."</b>						
										</span>															
									</td>";
							
									echo"<td style='vertical-align: middle;'>";	
										if(isBuddy($_SESSION['user_id'], $array[$key]['userID']) == 0)
										echo
										"
										<form method='POST' action='sendrequest.php'  style='display:inline;'>
												<button type='submit' name='submit' class='btn btn-md'>
													<input type='hidden' name='userfound' value=".$array[$key]['userID'].">
													<i class='fa fa-user-plus' aria-hidden='true'></i> Request
												</button>												
										</form>
										";
										echo"																						
										<form method='GET' action='showmessages.php' name='submit' style='display:inline;'>
											<button type='submit' class='btn btn-md'>
												<input type='hidden' name='currentUserMessaging' value=".$array[$key]['userID'].">
												<i class='fa fa-comment' aria-hidden='true'></i> Message
											</button>																													
										</form>
																																
										<form method='GET' action='home.php'  style='display:inline;'>
											<button type='submit' class='btn btn-md'>
												<input type='hidden' name='userfound' value=".$array[$key]['userID'].">
												<i class='fa fa-user-circle-o' aria-hidden='true'></i> Profile	
											</button>																													
										</form>																					
									</td>
								</tr>																																						
							";		
								
																						
							}
							echo"</tbody>";
						?>
					
				</table>			
			</div>						
		</div>
	</div>
	
	
	

	<!-- End of Main Content-->
			
	<!-- Footer-->
		<div class="well text-center">
			<div class="copyrights">
				<p>Staten Island © 2016, All Rights Reserved<br>	
				Web Design By: Alfonso Rayo
				</p>	
			</div>
		</div>	
	<!-- End of Footer-->

</body>
</html>