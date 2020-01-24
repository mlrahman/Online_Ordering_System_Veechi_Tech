<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
			<div id="edit_profile_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Your Profile updated successfully.</p>
			</div>
			<script>
			
				function stop_notification()
				{
					document.getElementById('edit_profile_notification').style.display='none';
				}
			
			</script>
			
			<?php
				if(isset($_SESSION['profile_update_successful']))
				{
					echo "<script>document.getElementById('edit_profile_notification').style.display='block';setTimeout(stop_notification,1500);</script>";
					unset($_SESSION['profile_update_successful']);
				}
			
				if(isset($_REQUEST['confirmed_edit_profile']))
				{
					$email=trim($_REQUEST['email']);
					$mobile=trim($_REQUEST['mobile']);
					$password=trim($_REQUEST['password']);
					$admin_id=$_SESSION['admin_id'];
					
					if($password=="") //Password not changed
					{
						try
						{
							$stmt=$conn->prepare("update ow_admin set email=:email, mobile=:mobile where owner_id='$admin_id' ");
							$stmt->execute(array('email'=>$email, 'mobile'=>$mobile));
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
						//echo '<script>console.log("YESS");</script>';
					}
					
					else
					{
						try
						{
							$password=sha1($password);
							$stmt=$conn->prepare("update ow_admin set email=:email, mobile=:mobile, password=:password where owner_id='$admin_id' ");
							$stmt->execute(array('email'=>$email, 'mobile'=>$mobile, 'password'=>$password));
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
						//echo '<script>console.log("YESS");</script>';
					}
					$_SESSION['profile_update_successful']='YES';
					header("Location: ow_index.php#edit_profile");
				}
			?>
			
			<!-- Confirm Modal -->
			<div id="edit_profile_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('edit_profile_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to make the changes in your Admin Profile?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['edit_profile'])){
								$email=trim($_REQUEST['email']);
								$mobile=trim($_REQUEST['mobile']);
								$password=trim($_REQUEST['password']);
					
						?>
								<a href="ow_index.php?confirmed_edit_profile=YES&email=<?php echo $email; ?>&mobile=<?php echo $mobile; ?>&password=<?php echo $password; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('edit_profile_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<?php
				
				if(isset($_REQUEST['edit_profile']))
				{
					echo '<script>document.getElementById("edit_profile_confirm").style.display="block";</script>';
				}
			
			?>
			
			<!-- Main Edit Profile Panel -->
			<div class="w3-container" style="margin-top:80px" id="edit_profile">
				<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Edit Profile</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p>This option is used for <font color="red">Edit Admin</font> details for <?php echo $website_title; ?></p>  
				<div class="w3-container" style="margin:0px;padding:0px;width:100%;max-width:700px;">
				
					<form style="margin-top:0px;" action="ow_index.php#edit_profile" method="post">
						<?php
							try
							{
								$stmt=$conn->prepare("select * from ow_admin where owner_id='$_SESSION[admin_id]' ");
								$stmt->execute();
								$list=$stmt->fetchAll();
							}
							catch(PDOException $e)
							{
								echo "Error: ".$e->getMessage();
							}
						?>
						<div class="w3-section" style="margin:0px;padding:0px;">
						  <label><b>Email</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Your Email *" value="<?php echo $list[0]['email']; ?>" name="email" required>
						  <label><b>Mobile</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Your Mobile Number *" value="<?php echo $list[0]['mobile']; ?>" name="mobile" required> 
						  <label><b>Change Password</b></label>
						  <div class="w3-row" style="margin:0px 0px 0px 0px;padding:0px;">
							<div class="w3-col" style="width:49%;">
								<input class="w3-input w3-border" type="password" name="password" placeholder="Password" onclick="document.getElementById('pass_up').style.display='block';" onfocusout="document.getElementById('pass_up').style.display='none';" id="ch_password" maxlength="30">
							</div>
							<div class="w3-col" style="margin-left:2%;width:49%;">
								<input class="w3-input w3-border" type="password" placeholder="Re-type Password" onclick="document.getElementById('pass_up').style.display='block';" onfocusout="document.getElementById('pass_up').style.display='none';" id="ch_confirm_password" maxlength="30">
							</div>
						  </div>
						  <p id="pass_up" class="w3-tiny w3-text-red w3-bold" style="display:none;margin:0px 0px 0px 0px;">* Use only for change password.</p>
					   
						  <?php 
							//spam Check 
							$aaa=rand(1,20);
							$bbb=rand(1,20);
							$ccc=$aaa+$bbb;
						  ?>
						  <p style="margin:10px 0px 0px 0px;padding:0px;"></p>
						  <label><b>Captcha</b></label>
						  <div class="w3-row" style="margin:0px;padding:0px;">
							<div class="w3-col" style="width:40%;">
								<input class="w3-input w3-border w3-center" type="text" value="<?php echo $aaa.' + '.$bbb.' = '; ?>" disabled>
							</div>
							<div class="w3-col" style="margin-left:2%;width:58%;">
								<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha5"  required>
							</div>
						  </div>
						  
						  <button class="w3-button w3-block w3-green w3-round w3-margin-top w3-padding" type="submit" name="edit_profile"><i class="fa fa-edit"></i> Update Profile</button>
						</div>
					</form>
					<script>
						//Captcha Validation for create new password
						var reservation_captcha5 = document.getElementById("captcha5");
						var sol5=<?php echo $ccc; ?>;
						function reservation_captcha_val5(){
						  
						  //console.log(reservation_captcha.value);
						  //console.log(sol);
						  if(reservation_captcha5.value != sol5) {
							reservation_captcha5.setCustomValidity("Please Enter Valid Answer.");
						  } else {
							reservation_captcha5.setCustomValidity('');
						  }
						}
						reservation_captcha5.onchange=reservation_captcha_val5;
						
						//Password Checking
						var ch_password = document.getElementById("ch_password"), ch_confirm_password = document.getElementById("ch_confirm_password");

						function ch_validatePassword(){
						  if(ch_password.value.length<6)
						  {
							mir=1;
							ch_password.setCustomValidity("Passwords must be greater than 6 characters");
						  }
						  else if(ch_password.value != ch_confirm_password.value) {
							mir=1;
							ch_password.setCustomValidity('');
							ch_confirm_password.setCustomValidity("Passwords Don't Match");
						  } else {
							mir=0;
							ch_confirm_password.setCustomValidity('');
							ch_password.setCustomValidity('');
						  }
						}

						ch_password.onchange = ch_validatePassword;
						ch_confirm_password.onkeyup = ch_validatePassword;
					
					</script>
				</div>	
			</div>