<?php include 'studybuddyfunctions.php';
	checkIfLogin();
	
	
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">				
					<div class="panel panel-default">
						<div class="panel-heading"><center><b>Courses Tutoring</b> </center></div>
						<table class="table table-condensed">
							<tbody>
								<?php 						
									$courses = findCourseTeaching_Learning($_SESSION['user_id'], "tutor", 10);									
											
									if(!empty($courses))
									{
										foreach($courses as $key => $value)
											echo"<tr><td>".$courses[$key]['courseID']."</td></tr>";								
									}
									else
										echo "<tr><td><center>(empty)</td></tr>";						
								?>								
							</tbody>
						</table>		
						<div class="panel-body">
							<!-- Trigger addcourse modal with a button-------------------------------------------------------------------------------------- -->
							<center>
							<button type='button' class='btn btn-basic btn-md navbar-btn' data-toggle='modal' data-target='#addcourseModal'><i class='fa fa-plus'> Add</i></button>
							</center>			
							<!-- Modal -->
							<div id='addcourseModal' class='modal fade' role='dialog'>
								<div class='modal-dialog modal-md'>

									<!-- Modal content-->
									<div class='modal-content'>
										<!-- Modal Body -->
										<div class='modal-body'>
											<form method='post' action='addcourses.php'>										
												<div class='row'>
													<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>	
														<center><h3>Add a Course</h3><br>(up to 5 courses)</center>
														<hr>																						
														<?php
															for ($i = 0; $i< 5; $i++)
															{
																echo
																"
																	<div class='row'>
																		<div class='form-group col-lg-5 col-md-5 col-sm-5 col-xs-5'>	
																			
																			<select name='course".$i."' class='form-control'>
																				<option value='null'>Select Course</option>
																				<option value='CSC'>CSC - Computer Science (Recommended)</option>
																				<option value='MTH'>MTH - Mathematics</option>
																				<option value='BIO'>BIO - Biology</option>
																				<option value='ENS'>ENS - Engineering</option>
																				<option value='BUS'>BUS - Business</option>
																			</select>
																		</div>
																	
																		<div class='form-group col-lg-3 col-md-3 col-sm-3 col-xs-3'>
																			<input type='text' name='coursenumber".$i."' class='form-control' maxlength='3' placeholder='Course#'>						
																			
																		</div>
																		
																		<div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-4'>
																			<div class='btn-group' data-toggle='buttons'>
																				<label class='btn btn-basic btn-md active'>
																				<input type='radio' value='buddy' name='coursechoice".$i."' autocomplete='off' checked>Learning
																				</label>
																				
																				<label class='btn btn-basic btn-md'>
																				<input type='radio' value='tutor' name='coursechoice".$i."' autocomplete='off'>Tutoring
																				</label>
																			</div>
																		</div>
																	</div>
																";											
															}	
															
														?>																				
													</div>	
												</div><br>	
													
												<div class='modal-footer'>
													<!-- Submit Form -->
													<center>
													<div class='form-group '>
														<button type='submit' name='submit' class='btn btn-primary btn-md'><i class='fa fa-search'> Save Changes</i></button>
														<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
													</div>	
													</center>										
												</div>										
											</form>
										</div>
									</div>	
								</div>
							</div>	<!-- end modal----------------------------------------------------------------------------------------------- -->

						</div>
						
					</div>	
					
					<div class="panel panel-default">
						<div class="panel-heading"><center><b>Courses Learning</b> </center></div>
						<table class="table table-condensed">
							<tbody>
								<?php 						
									$courses = findCourseTeaching_Learning($_SESSION['user_id'], "buddy", 10);																			
									if(!empty($courses))
									{
										foreach($courses as $key => $value)
										{
											echo"<tr><td>".$courses[$key]['courseID']."</td></tr>";
										}
									}
									else				
										echo "<tr><td><center>(empty)</td></tr>";							
								?>								
							</tbody>
						</table>		
						<div class="panel-body">
							<!-- Trigger addcourse modal with a button-------------------------------------------------------------------------------------- -->
							<center>
							<button type='button' class='btn btn-basic btn-md navbar-btn' data-toggle='modal' data-target='#addcourseModal'><i class='fa fa-plus'> Add</i></button>
							</center>			
							<!-- Modal -->
							<div id='addcourseModal' class='modal fade' role='dialog'>
								<div class='modal-dialog modal-md'>

									<!-- Modal content-->
									<div class='modal-content'>
										<!-- Modal Body -->
										<div class='modal-body'>
											<form method='POST' action='addcourses.php'>										
												<div class='row'>
													<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>	
														<center><h3>Add a Course</h3><br>(up to 5 courses)</center>
														<hr>																						
														<?php
															for ($i = 0; $i< 5; $i++)
															{
																echo
																"
																	<div class='row'>
																		<div class='form-group col-lg-5 col-md-5 col-sm-5 col-xs-5'>	
																			
																			<select name='course".$i."' class='form-control'>
																				<option value='null'>Select Course</option>
																				<option value='CSC'>CSC - Computer Science (Recommended)</option>
																				<option value='MTH'>MTH - Mathematics</option>
																				<option value='BIO'>BIO - Biology</option>
																				<option value='ENS'>ENS - Engineering</option>
																				<option value='BUS'>BUS - Business</option>
																			</select>
																		</div>
																	
																		<div class='form-group col-lg-3 col-md-3 col-sm-3 col-xs-3'>
																			<input type='text' name='coursenumber".$i."' class='form-control' maxlength='3' placeholder='Course#'>						
																			
																		</div>
																		
																		<div class='form-group col-lg-4 col-md-4 col-sm-4 col-xs-4'>
																			<div class='btn-group' data-toggle='buttons'>
																				<label class='btn btn-basic btn-md active'>
																				<input type='radio' value='buddy' name='coursechoice".$i."' autocomplete='off' checked>Learning
																				</label>
																				
																				<label class='btn btn-basic btn-md'>
																				<input type='radio' value='tutor' name='coursechoice".$i."' autocomplete='off'>Tutoring
																				</label>
																			</div>
																		</div>
																	</div>
																";											
															}	
															
														?>																				
													</div>	
												</div><br>	
													
												<div class='modal-footer'>
													<!-- Submit Form -->
													<center>
													<div class='form-group '>
														<button type='submit' name='submit' class='btn btn-primary btn-md'><i class='fa fa-search'> Save Changes</i></button>
														<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
													</div>	
													</center>										
												</div>										
											</form>
										</div>
									</div>	
								</div>
							</div>	<!-- end modal----------------------------------------------------------------------------------------------- -->

						</div>
						
					</div>	
				</div>
				
				
				
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">							
					<div class="panel panel-default">
						<div class="panel-heading"><center><b>Recent Messages</b></center></div>
						<table class="table table-bordered">
							<tbody>																								
								<?php
								
									$messages = getMessages($_SESSION['user_id'],'DESC',20);
									
																		
									if(!empty($messages))
									{		
								
										foreach($messages as $key => $value)
										{																				
											
											$image = getImage($messages[$key]['userIDSend']);
											$name = getName($messages[$key]['userIDSend']);
											
											echo
											"
											<tr>
												<td>																												
													<div class='col-lg-2 col-md-2 col-sm-2'>
														<img id='avatar' class='img-circle' src=".$image.">																
													</div>		
													<div class='col-lg-10 col-md-10 col-sm-10'>	
														<b style='font-size: 18px;'>".$name[0]." ".$name[1]." </b> <font color='#8c8c8c'>".$messages[$key]['dateSend']."</font><br>
														".$messages[$key]['content']."
													</div>	
												</td>						
											</tr>
											";																													
										}
									}
									else				
										echo "<tr><td><center><br>(No Recent Activity)<br><br></td></tr>";		
									
								?>													
							</tbody>
						</table>								
					</div>	
							
				</div>
				
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">	
					<div class="panel panel-default">
						<div class="panel-heading"><center><b>About</b></center></div>
						<div class="panel-body">
						<?php 
							if($_SESSION['user_about'] != "") 
								echo $_SESSION['user_about'];
							else
								echo "(empty)";						
						?>
						</div>
					</div>	
					
					<div class="panel panel-default">
						<div class="panel-heading"><center><b>Interests</b></center></div>
						<div class="panel-body">
						<?php 
							if($_SESSION['user_interests'] != "") 
								echo $_SESSION['user_interests'];
							else
								echo "(empty)";						
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