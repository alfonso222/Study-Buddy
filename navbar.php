<div class='navbar navbar-default '>
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class='navbar-header'>

				<!-- Button that toggles the navbar on and off on small screens -->
				<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>

				<!-- Hides information from screen readers -->
				<span class='sr-only'></span>

				<!-- Draws 3 bars in navbar button when in small mode -->
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				</button>
	 
				<!-- You'll have to add padding in your image on the top and right of a few pixels (CSS Styling will break the navbar) -->
				<a class='pull-left' href='#'></a>
	  
				<span><img id='profile' class='img-circle' src=<?php echo $_SESSION['user_image']; ?>></span>
				<span class='site-name'><b><?php echo $_SESSION['user_firstname']; ?></b> <?php echo $_SESSION['user_lastname']; ?></span>
				<span class='site-description'><?php if($_SESSION['user_major'] != "") echo $_SESSION['user_major'];?></span>
			</div>
				
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
			<div class='btn-group'>
			
	
			
			<a href='home.php' id='linkbutton' class='btn navbar-btn btn-lg'><i class='fa fa-home'> Home</i></a>
			<a href='showmessages.php' id='linkbutton' class='btn navbar-btn btn-lg'><i class='fa fa-envelope'> 
			Messages <span class="label label-danger" style="top: -7px;"><?php echo messagesNotRead($_SESSION['user_id'])?></span></i></i></a>
			<div class="btn-group">
				<button type='button' id='linkbutton' class="btn navbar-btn btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class='fa fa-users'> 
				Buddies <span class="label label-danger" style="top: -7px;"><?php echo pendingRequests($_SESSION['user_id'])?></span></i></button>
				<div class="dropdown-menu">
					<center>
					<a href="requests.php" id='linkbutton' class="btn btn-md">Requests <span class="label label-danger" style="top: -7px;"><?php echo pendingRequests($_SESSION['user_id'])?></span></a><br>
					<a href="buddies.php" id='linkbutton' class="btn btn-md">Buddies</a><br>
					<a href="tutors.php" id='linkbutton' class="btn btn-md">Tutors</a>
					</center>						
				</div>
			</div>
			
			
			
		
			
			
	
			<!-- Trigger search modal with a button-------------------------------------------------------------------------------------- -->
			<button type='button' class='btn btn-basic btn-md navbar-btn btn-lg' data-toggle='modal' data-target='#searchModal'><i class='fa fa-search'> Search</i></button>
						
			<!-- Modal -->
			<div id='searchModal' class='modal fade' role='dialog'>
				<div class='modal-dialog modal-sm'>

					<!-- Modal content-->
					<div class='modal-content'>
						<!-- Modal Body -->
						<div class='modal-body'>
							<form action='results.php' method='get'>
								<select name='searchtype' class='form-control'>
									<option value='buddy'>Buddy</option>
									<option value='tutor' selected>Tutor</option>
									<option value='item' disabled>Item</option>
								</select><br><br>
								
								<div class='form-group'>						
									<input type='text' class='form-control' name='searchterm' placeholder='Enter a class. Example: "CSC126"' required>
								</div>
								<!-- Submit Form -->
								<div class='form-group '>
									<button type='submit' class='btn btn-primary btn-md'><i class='fa fa-search'> Search</i></button>
								</div>	
							</form>
						</div>

						<div class='modal-footer'>
						<center><button type='button' class='btn btn-default' data-dismiss='modal'>Close</button></center>
						</div>
					</div>
				</div>
			</div> <!-- end modal----------------------------------------------------------------------------------------------- -->
			
			<!-- Trigger edit modal with a button-------------------------------------------------------------------------------------- -->
			<button type='button' class='btn btn-basic btn-md navbar-btn btn-lg' data-toggle='modal' data-target='#editModal'><i class='fa fa-pencil-square-o'> Edit</i></button>
						
			<!-- Modal -->
			<div id='editModal' class='modal fade' role='dialog'>
				<div class='modal-dialog modal-md'>

					<!-- Modal content-->
					<div class='modal-content'>
						<!-- Modal Body -->
						<div class='modal-body'>
							<form method='post' action='editprofile.php' name='editprofileform' enctype='multipart/form-data'>
								<div class='row'>
									<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
										<center><h3>Information</h3></center>
										<hr>
										<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
										
											<div class='form-group'>					
												<span>First Name</span>	
												<input type='text' class='form-control' name='firstname' id='firstname' value='<?php echo $_SESSION['user_firstname']; ?>' placeholder='First Name' required>
												<label id='firstnamelabel'></label>	
											</div>
										
											<div class='form-group'>
												<span>Last Name</span>
												<input type='text' class='form-control' name='lastname' id='lastname' value='<?php echo $_SESSION['user_lastname']; ?>' placeholder='Last Name' required>
												<label id='lastnamelabel'></label>
											</div>
												
											
											<div class='form-group'>	
												<span>Email</span>
												<input type='email' class='form-control' name='email' id='email' value='<?php echo $_SESSION['user_email']; ?>' placeholder='Email' required>	<label id='emaillabel'></label>		
											</div>
											
											
											<div class='form-group'>	
												<span>EmpleID</span>
												<input type='text' class='form-control' name='empleID' id='empleID' value='<?php if($_SESSION['user_empleID'] != 0) echo $_SESSION['user_empleID'];?>' maxlength='8' placeholder='EmpleID' >		
												<label id='emplelabel'></label>	
											</div>
											
											
											<div class='form-group'>		
												<span>Major</span>
												<input type='text' class='form-control' name='major' id='major' value='<?php if($_SESSION['user_major'] != "") echo $_SESSION['user_major'];?>' placeholder='Major' >		
												<label id='majorlabel'></label>	
											</div>
											
											
											<label class='btn btn-primary' for='my-file-selector'>
											<input id='my-file-selector' type='file' name='fileToUpload' style='text-decoration: none; 	overflow: hidden;'  onchange='$('#upload-file-info').html($(this).val());'>
											Choose Avatar
											</label>
											<span class='label label-info' id='upload-file-info'></span><br><br>
											
											
										</div>
						
										<div class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>
											<div class='form-group'>
												<span>About</span>
												<textarea class='form-control' name='about' rows="6" maxlength='300' placeholder="About..." style='resize: vertical;'><?php if($_SESSION['user_about'] != "") echo $_SESSION['user_about'];?></textarea>
											</div>
											<div class='form-group'>
												<span>Interests</span>
												<textarea class='form-control' name='interests' rows="6" maxlength='300' placeholder="Interests..." style='resize: vertical;'><?php if($_SESSION['user_interests'] != "") echo $_SESSION['user_interests'];?></textarea>
											</div>
										</div>
										
									</div>	
								</div>
											
								<div class='modal-footer'>
									<!-- Submit Form -->
									<center>
									<div class='form-group '>
									
										<button type='button' onclick='submitEditProfileForm()' class='btn btn-primary btn-md'><i class='fa fa-search'> Save Changes</i></button>
										<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
									</div>	
									</center>
									
								</div>
							</form>
						</div>

						
					</div>
				</div>
			</div> <!-- end modal----------------------------------------------------------------------------------------------- -->
		
		
			<a href='logout.php' id='linkbutton' class='btn navbar-btn btn-lg'><i class='fa fa-power-off'> Logout</i></a>
			
			</div>
			
			</div><!-- /.navbar-collapse -->	
		</nav>
		</div>