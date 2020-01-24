<?php
	ob_start();
	session_start();
	include("../library/initialize.php");
	if(isset($_SESSION['controller_email']) && isset($_SESSION['controller_password']) && isset($_SESSION['controller_id']))
	{
		header("Location: vt_index.php");
	}
?>
<!DOCTYPE html>

<html>
	<head>
		<title><?php echo $website_title; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../images/<?php echo $website_logo; ?>">
		<link rel="stylesheet" href="../css/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="../css/main.css">
		<script src="../js/zenscroll-min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	</head>
	
	<body>
		<div class="w3-container w3-display-container" style="padding:0px;min-height:510px;height:auto;width:100%;margin:0px 0px 0px 0px;background-image: url('../images/<?php echo $backend_image; ?>');background-repeat: repeat;background-attachment: fixed;top:0;">
			<!-- Navbar (sit on top) -->
			<div class="w3-container" style="padding:0px;margin:0px;">
			
				<div class="w3-bar w3-light-gray w3-card" style="padding: 4px 5px;">
					<div class="w3-row" style="">
						<div class="w3-col w3-hide-small" style="width:17%;min-width:100px;">
							<a href="index.php" style="padding:0px;margin:0px;"><img class="w3-image" style="" src="../images/<?php echo $website_logo; ?>" alt="<?php echo $website_title; ?>" title="<?php echo $website_title; ?>"></a>
						</div>
						<div class="w3-col w3-hide-medium w3-hide-large" style="width:17%;min-width:60px;">
							<a href="index.php" style="padding:0px;margin:0px;"><img class="w3-image" style="" src="../images/<?php echo $website_logo; ?>" alt="<?php echo $website_title; ?>" title="<?php echo $website_title; ?>"></a>
						</div>
						<div class="w3-col w3-hide-small" style="width:70%;">
							<h1 class="w3-bold" style="padding:0px;margin:0px 0px 0px 10px;font-size:4.3vw;font-family: 'Comic Sans MS', cursive, sans-serif;"><?php echo $website_title; ?></h1>
						</div>
						<div class="w3-col w3-hide-medium w3-hide-large" style="width:65%;">
							<h1 class="w3-bold" style="padding:0px;margin:0px 0px 0px 5px;font-size:4.6vw;font-family: 'Comic Sans MS', cursive, sans-serif;"><?php echo $website_title; ?></h1>
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			<div class="w3-clear" style="margin: 20px 0px;"> </div>
			
			
			<?php
				$fll=0;
				if(isset($_REQUEST['sign_in']))
				{ 
					$controller_email=trim($_REQUEST['controller_email']);
					$controller_password=trim($_REQUEST['controller_password']);
					
					//echo '<script>console.log("'.$controller_password.'");</script>';
					$controller_password=sha1($controller_password);
					//echo '<script>console.log("'.$controller_email.'");</script>';
					//echo '<script>console.log("'.$controller_password.'");</script>';
					try
					{
						$stmt=$conn->prepare("select * from vt_controller where email=:email and password=:password order by controller_id asc ");
						$stmt->execute(array('email'=>$controller_email, 'password'=>$controller_password));
						$list=$stmt->fetchAll();
						if(count($list)>0) //Logged In Successfull
						{
							if($list[0]['status']=='active')
							{
								//If login successful
								if(!empty($_REQUEST["recontroller"])) {
									setcookie ("controller_login",$controller_email,time()+ (10 * 365 * 24 * 60 * 60));
									setcookie ("controller_password",trim($_REQUEST['controller_password']),time()+ (10 * 365 * 24 * 60 * 60));
								} else {
									if(isset($_COOKIE["controller_login"])) {
										setcookie ("controller_login","");
									}
									if(isset($_COOKIE["controller_password"])) {
										setcookie ("controller_password","");
									}
								}
								
								$_SESSION['controller_id']=$list[0]['controller_id'];
								$_SESSION['controller_email']=$controller_email;
								$_SESSION['controller_password']=$controller_password;
								header("Location: vt_index.php");
							}
							else
							{
								$fll=2;
							}
						}
						else  //Not successfull show error message
						{
							$fll=1;
						}
					}
					catch(PDOException $e)
					{
						echo "Error: " . $e->getMessage();
					}
					
				}
			?>
			
			
			
			<div class="w3-container" style="margin:0px;">
				<div class="w3-container w3-card-4 w3-animate-zoom w3-light-gray" style="max-width:450px;font-family:Arial;margin: 0 auto;">
				
					<div class="w3-container" style="margin:0px;padding:0px;">

						<div class="w3-container"><br>
							<h2  style="margin-bottom:0px;font-family: 'Comic Sans MS', cursive, sans-serif;" class="w3-xlarge w3-bold w3-center" >System Controller</h2>
						</div>

						<form style="margin-top:0px;" class="w3-container w3-margin-bottom" action="index.php" method="post">
							
							<div id="invalid_msg" style="display:none;" class="w3-section w3-border w3-padding w3-center w3-bold w3-text-red">
								Invalid Email or Password
							</div>
							
							<div id="active_msg" style="display:none;" class="w3-section w3-border w3-padding w3-center w3-bold w3-text-teal">
								Please Contact with Developer (ID Inactive)
							</div>
							
							<div class="w3-section w3-border w3-padding">
							  <label><b>Email</b></label>
							  <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email" name="controller_email" value="<?php if(isset($_COOKIE["controller_login"])) { echo $_COOKIE["controller_login"]; } ?>" required>
							  <label><b>Password</b></label>
							  <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Enter Password" name="controller_password" value="<?php if(isset($_COOKIE["controller_password"])) { echo $_COOKIE["controller_password"]; } ?>" required>
							  
							  <?php 
								//spam Check 
								$aaa=rand(1,20);
								$bbb=rand(1,20);
								$ccc=$aaa+$bbb;
							  ?>
							  <label><b>Captcha</b></label>
							  <div class="w3-row" style="margin:0px;padding:0px;">
								<div class="w3-col" style="width:40%;">
									<input class="w3-input w3-border w3-center" type="text" value="<?php echo $aaa.' + '.$bbb.' = '; ?>" disabled>
								</div>
								<div class="w3-col" style="margin-left:2%;width:58%;">
									<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha4"  required>
								</div>
							  </div>
							  
							  <button class="w3-button w3-block w3-green w3-margin-top w3-padding" type="submit" name="sign_in">Sign In</button>
							</div>
							
							<div class="w3-container w3-border w3-light-grey w3-margin-bottom">
								<input style="margin:0px 0px 10px 0px;" class="w3-check" type="checkbox" name="recontroller" <?php if(isset($_COOKIE["controller_login"])) { ?> checked <?php } ?>> Remember me	
							</div>
						</form>
						<script>
							//Captcha Validation for create new password
							var reservation_captcha4 = document.getElementById("captcha4");
							var sol4=<?php echo $ccc; ?>;
							function reservation_captcha_val4(){
							  
							  //console.log(reservation_captcha.value);
							  //console.log(sol);
							  if(reservation_captcha4.value != sol4) {
								reservation_captcha4.setCustomValidity("Please Enter Valid Answer.");
							  } else {
								reservation_captcha4.setCustomValidity('');
							  }
							}
							reservation_captcha4.onchange=reservation_captcha_val4;
						</script>
					</div>
				</div>
			</div>
			
			
			<?php
				if($fll==1)
				{
					echo '<script>document.getElementById("invalid_msg").style.display="block";</script>';
					$fll=0;
				}
				else if($fll==2)
				{
					echo '<script>document.getElementById("active_msg").style.display="block";</script>';
					$fll=0;
				}
			?>
			
			<div class="w3-clear"  style="margin: 20px 0px;"> </div>
			
			
		</div>
		<!-- Footer -->
		<footer class="w3-center w3-black w3-padding-16">
		  <!-- Social link -->
		  <div class="w3-xlarge w3-section">
			<?php
				if($facebook_link!="")
				{
					echo '<a style="margin: 0px 4px;" href="'.$facebook_link.'" target="_blank" title="Follow us on Facebbok" ><i class="fa fa-facebook-official w3-hover-opacity"></i></a>';
				}
				if($instagram_link!="")
				{
					echo '<a style="margin: 0px 4px;" href="'.$instagram_link.'" target="_blank" title="Follow us on Instagram" ><i class="fa fa-instagram w3-hover-opacity"></i></a>';
				}
				if($snapchat_link!="")
				{
					echo '<a style="margin: 0px 4px;" href="'.$snapchat_link.'" target="_blank" title="Follow us on Snapchat" ><i class="fa fa-snapchat w3-hover-opacity"></i></a>';
				}
				if($pinterest_link!="")
				{
					echo '<a style="margin: 0px 4px;" href="'.$pinterest_link.'" target="_blank" title="Follow us on Pinterest" ><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>';
				}
				if($twitter_link!="")
				{
					echo '<a style="margin: 0px 4px;" href="'.$twitter_link.'" target="_blank" title="Follow us on Twitter" ><i class="fa fa-twitter w3-hover-opacity"></i></a>';
				}
				if($linkedin_link!="")
				{
					echo '<a style="margin: 0px 4px;" href="'.$linkedin_link.'" target="_blank" title="Follow us on Linkedin" ><i class="fa fa-linkedin w3-hover-opacity"></i></a>';
				}
			?>
		  </div>
		  
		  <p>Copyright &copy <?php echo Date("Y").' '.$copyright_title; ?></p>
		  <p>Website Developed By <a href="<?php echo $developer_link; ?>" target="_blank"><img class="w3-image" style="width:20%;max-width:80px;" src="../images/system/<?php echo $developer_logo; ?>"  alt="<?php echo $developer_title; ?>" title="<?php echo $developer_title; ?>"></a></p>
		</footer>
	</body>
</html>