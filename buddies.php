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
			<div class="panel-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="friendsbox">
				<div class="panel panel-dafault" style="border: 1px  solid #cccccc;">
					<div class="panel-heading" style="background-color: #cccccc;">
						<center><h4>My Buddies</h4></center>
					</div>
					<div class="panel-body">
						<?php
						
							$buddies = findMyBuddies($_SESSION['user_id'], 100);
						
							if(!empty($buddies))
							{
								foreach($buddies as $key => $value)
								{																					
									echo
									"
										<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
											<form method='GET' action='showmessages.php'>
												<button type='submit' class='btn btn-lg btn-block'>
												<img  id='avatar' class='img-circle' src=".$buddies[$key]['image']."> 
													<input type='hidden' name='currentUserMessaging' value=".$buddies[$key]['userID']." >
													<span style='overflow:hidden; text-align: center;'  >
													<b style='line-height: 50px;'>".$buddies[$key]['firstName']." ".$buddies[$key]['lastName']."</b>									
													</span>					
												</button>
											</form>
										</div>	
									";																													
								}
							}
							else				
								echo "<tr><td><center><br>(No Buddies)<br><br></td></tr>";	
							
						?>
													
					
					</div>				
				</div>					
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