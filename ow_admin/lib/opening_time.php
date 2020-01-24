<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
			<div id="update_opening_time_confirmed_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Restaurant opening time updated successfully.</p>
			</div>
			<script>
			
				function stop_update_opening_time_confirmed_notification()
				{
					document.getElementById('update_opening_time_confirmed_notification').style.display='none';
				}
			
			</script>
			<?php
				if(isset($_SESSION['update_opening_time_confirmed_successful']))
				{
					echo "<script>document.getElementById('update_opening_time_confirmed_notification').style.display='block';setTimeout(stop_update_opening_time_confirmed_notification,1500);</script>";
					unset($_SESSION['update_opening_time_confirmed_successful']);
				}
			
				if(isset($_REQUEST['update_opening_time_confirmed']))
				{
					$saturday=trim($_REQUEST['saturday']);
					$sunday=trim($_REQUEST['sunday']);
					$monday=trim($_REQUEST['monday']);
					$tuesday=trim($_REQUEST['tuesday']);
					$wednesday=trim($_REQUEST['wednesday']);
					$thursday=trim($_REQUEST['thursday']);
					$friday=trim($_REQUEST['friday']);
					try
					{
						$stmt=$conn->prepare("update opening_time set
							saturday=:saturday,
							sunday=:sunday,
							monday=:monday,
							tuesday=:tuesday,
							wednesday=:wednesday,
							thursday=:thursday,
							friday=:friday
							where opening_id='1'
						");
						$stmt->execute(array('saturday'=>$saturday, 'sunday'=>$sunday, 'monday'=>$monday, 'tuesday'=>$tuesday, 'wednesday'=>$wednesday, 'thursday'=>$thursday, 'friday'=>$friday ));
					}
					catch(PDOException $e)
					{
						echo 'Error: '.$e->getMessage();
					}
					$_SESSION['update_opening_time_confirmed_successful']='YES';
					header("Location: ow_index.php#opening_time");
				}
			?>
			<!-- Confirm Modal -->
			<div id="update_opening_time_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('update_opening_time_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to make the changes in your restaurant opening time?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['update_opening_time'])){
								$saturday=trim($_REQUEST['saturday']);
								$sunday=trim($_REQUEST['sunday']);
								$monday=trim($_REQUEST['monday']);
								$tuesday=trim($_REQUEST['tuesday']);
								$wednesday=trim($_REQUEST['wednesday']);
								$thursday=trim($_REQUEST['thursday']);
								$friday=trim($_REQUEST['friday']);
					
						?>
								<a href="ow_index.php?update_opening_time_confirmed=YES&saturday=<?php echo $saturday; ?>&sunday=<?php echo $sunday; ?>&monday=<?php echo $monday; ?>&tuesday=<?php echo $tuesday; ?>&wednesday=<?php echo $wednesday; ?>&thursday=<?php echo $thursday; ?>&friday=<?php echo $friday; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('update_opening_time_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<?php
				
				if(isset($_REQUEST['update_opening_time']))
				{
					echo '<script>document.getElementById("update_opening_time_confirm").style.display="block";</script>';
				}
			
			?>
			<!-- Opening Time Form -->
			<div class="w3-container" style="margin-top:80px" id="opening_time">
				<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Opening Time</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p>This option is used for <font color="red">update weekly opening time</font> for <?php echo $website_title; ?></p>  
				<div class="w3-container" style="margin:0px;padding:0px;width:100%;max-width:700px;">
				
					<form style="margin-top:0px;" action="ow_index.php#opening_time" method="post">
						<?php
							try
							{
								$stmt=$conn->prepare("select * from opening_time order by opening_id desc ");
								$stmt->execute();
								$list=$stmt->fetchAll();
							}
							catch(PDOException $e)
							{
								echo "Error: ".$e->getMessage();
							}
						?>
						<div class="w3-section" style="margin:0px;padding:0px;">
						  <label><b>Saturday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Saturday opening time *" value="<?php echo $list[0]['saturday']; ?>" name="saturday" required>
						  <label><b>Sunday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Sunday opening time *" value="<?php echo $list[0]['sunday']; ?>" name="sunday" required> 
						  <label><b>Monday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Monday opening time *" value="<?php echo $list[0]['monday']; ?>" name="monday" required> 
						  <label><b>Tuesday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Tuesday opening time *" value="<?php echo $list[0]['tuesday']; ?>" name="tuesday" required> 
						  <label><b>Wednesday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Wednesday opening time *" value="<?php echo $list[0]['wednesday']; ?>" name="wednesday" required> 
						  <label><b>Thursday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Thursday opening time *" value="<?php echo $list[0]['thursday']; ?>" name="thursday" required> 
						  <label><b>Friday</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Friday opening time *" value="<?php echo $list[0]['friday']; ?>" name="friday" required> 
						  
						  <?php 
							//spam Check 
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
								<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha6"  required>
							</div>
						  </div>
						  
						  <button class="w3-button w3-block w3-green w3-round w3-margin-top w3-padding" type="submit" name="update_opening_time"><i class="fa fa-calendar"></i> Update Opening Time</button>
						</div>
					</form>
					<script>
						//Captcha Validation for create new password
						var reservation_captcha6 = document.getElementById("captcha6");
						var sol6=<?php echo $ccc; ?>;
						function reservation_captcha_val6(){
						  
						  //console.log(reservation_captcha.value);
						  //console.log(sol);
						  if(reservation_captcha6.value != sol6) {
							reservation_captcha6.setCustomValidity("Please Enter Valid Answer.");
						  } else {
							reservation_captcha6.setCustomValidity('');
						  }
						}
						reservation_captcha6.onchange=reservation_captcha_val6;
					
					</script>
				</div>	
			</div>
