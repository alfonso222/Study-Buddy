<?php setAllMessagesRead($_SESSION['user_id']); ?>
<div class="panel-group col-lg-8 col-md-8 col-sm-8 col-xs-8" id="messengerbox">
						<div class="panel panel-dafault" style="border: 1px  solid #cccccc; ">
						
						
							
							<div class="panel-heading" style="background-color: #cccccc;">
								
								<center>									
									<?php
										
										$image = getImage($_SESSION['currentUserMessaging']);
										$name = getName($_SESSION['currentUserMessaging']);
									
										echo
										"
											<img id='centeravatar' class='img-circle' src=".$image."><br>
											<b>
												".$name[0]." ".$name[1]."
											</b>
										";										
																	
									?>
								</center>
											
							</div>
						
							
							<div class="panel-body">	
							
							
								<?php
								
									$messages = getConversation($_SESSION['user_id'], $_SESSION['currentUserMessaging'], 'DESC', 10);
									
									$messages = array_reverse($messages);
									
									if(!empty($messages))
									{
										foreach($messages as $key => $value)
										{		
											if($messages[$key]['userIDReceive'] == $_SESSION['user_id'])
											{
												echo
												"
													<div class='row'>
														<p class='col-lg-6 col-md-6 col-sm-6 col-xs-6 col ' id='messagereceive'>
														".$messages[$key]['dateSend']."<br>												
														".$messages[$key]['content']."
														</p>
													</div>										
												";	
											}
											else
											{																																				
												echo
												"
													<div class='row'>
														<p class='col-lg-offset-6 col-md-offset-6 col-sm-offset-6 col-xs-offset-6' id='messagesent'>
														".$messages[$key]['dateSend']."<br>												
														".$messages[$key]['content']."
														</p>
													</div>										
												";	
											}
																																							
										}
									}
									else				
										echo "<tr><td><center><br>(No Results)<br><br></td></tr>";	
								
								
								?>
					
									
								<div>
									<form method="POST" action="sendmessage.php">
									<input type='hidden' name='userIDSend' value=<?php echo $_SESSION['currentUserMessaging']; ?> >
									<div class="form-group">
										<textarea class="form-control" rows="3" style='resize: none;' maxlength="250" name='message' placeholder="comment:" required></textarea>
									</div>
										
									<div class="form-group">
										<button type="submit" name='submit' class="btn btn-primary btn-lg" >Send</button>
									</div>
										
									
									</form>
								</div>
						
								</div>
					
							
							</div>
						</div>