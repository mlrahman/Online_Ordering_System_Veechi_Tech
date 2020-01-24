<?php 
	ob_start();
	session_start();
	include("../library/initialize.php"); 
	//Checking  
	if(!isset($_SESSION['controller_email']) || !isset($_SESSION['controller_password']) || !isset($_SESSION['controller_id']) || $_SESSION['controller_password']=='' || $_SESSION['controller_email']=='' || $_SESSION['controller_id']=='')
	{
		header("Location: index.php");
	}
	if(isset($_REQUEST['logout'])) //Log Out 
	{
		unset($_SESSION['controller_email']);
		unset($_SESSION['controller_id']);
		unset($_SESSION['controller_password']);
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $website_title.' Controller'; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" id="shortcut_image" type="image/png" href="../images/<?php echo $website_logo; ?>">
		<link rel="stylesheet" href="../css/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="../js/zenscroll-min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
		$(document).ready(function(){
			$( "#datepicker" ).datepicker({ minDate: "-12M", maxDate: "+12M" });
		});
		
		// Script to open and close sidebar
		function w3_open() {
			document.getElementById("mySidebar").style.display = "block";
		}
		 
		function w3_close() {
			document.getElementById("mySidebar").style.display = "none";
		}
		</script>
	</head>
	<style>
		body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
		body {font-size:16px;}
		.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
		.w3-half img:hover{opacity:1}
	</style>

	<body>

		<!-- Sidebar/menu -->
		<nav class="w3-sidebar w3-brown w3-collapse w3-top w3-large w3-padding w3-rightbar" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
			<span onclick="w3_close()" class="w3-button w3-hide-large w3-display-topright"><i class="fa fa-close"></i></span>
			<div class="w3-container w3-topbar w3-bottombar" style="padding:10px 16px;margin:20px 0px 30px 0px;">
				<a href="vt_index.php" style="padding:0px;margin:0px;"><img class="w3-image" style="" id="main_image" src="../images/<?php echo $website_logo; ?>" id="" alt="<?php echo $website_title; ?>" title="<?php echo $website_title; ?>"></a>
				<h3 style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b><?php echo $website_title.' Controller'; ?></b></h3>
			</div>
			<div class="w3-bar-block">
				<a href="#home" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-home"></i> Home</a> 
				<a href="#edit_details" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-tasks"></i> Edit Details</a> 
				<a href="#edit_admin" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-user-plus"></i> Edit Admin</a> 
				<a href="#subscription" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-television"></i> Subscription</a> 
				<a href="#edit_profile" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-edit"></i> Edit Profile</a> 
				<a href="vt_index.php?logout=YES" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-sign-out"></i> Log Out</a> 
				
			</div>
		</nav>

		<!-- Top menu on small screens -->
		<header class="w3-container w3-top w3-hide-large w3-black w3-xlarge w3-padding-small">
			<a href="javascript:void(0)" class="w3-button w3-black" onclick="w3_open()"><i class="fa fa-bars"></i></a>
			<span class="w3-xlarge w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><?php echo $website_title; ?></span>
		</header>

		
		<!-- Back To Top -->
		<a href="#home" id="scroll_btn" style="display:none;position:fixed;z-index:999;bottom:47px;right:15px;text-decoration:none;" class="w3-button w3-round-large w3-black w3-padding-small w3-hover-gray w3-border w3-border-white"><i class="fa fa-arrow-up"></i></a>
		
		
		<!-- !PAGE CONTENT! -->
		<div class="w3-main" style="margin-left:340px;margin-right:40px;min-height:480px;height:auto;">
			
			
			
			
			<!-- Home Details -->
			<div class="w3-container" style="margin-top:80px" id="home">
				<h1 class="w3-jumbo w3-text-brown" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Welcome</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p>Welcome to the <font color="red">Controller Panel</font> of <?php echo $website_title; ?>.</p>
				<p>
					Here you can change the system details. Basically this site designed for online restaurant management system. Where a user or
					customer can order different types of food with online payment. There are two types of payment available for this site one is Card Payment
					and another one is Paypal. This site also has the capbility to maintain discount through coupon code. This site also has the facility of Reservation system.
					Where a customer can send a Reservation request to admin through email. This site also maintain a user friendly and responsive environment for both Customer and Admin. This site has few attractive features like gallery, home screen slide show, Contact Us and About Us. 
					This site also handle subscription method for controller or developer. The maximum subscription period is one year. This site also has few dynamic content changing facility from controller panel.
					A controller can Edit Basic Details from <b>"Edit Details"</b> menu. A controller can Add, Delete or Update Admin details from <b>"Edit Admin"</b> menu. A controller
					can update subscription period from <b>"Edit subscription"</b> menu. A controller can update his own profile from <b>"Edit Profile"</b> menu. This site is fully secured with dynamic captcha calculation and 
					encryption technology. For any type of error or system failure feel free to contact with the developers.
				</p>
				<p>
					Website admin panel can be accessed at <a href="<?php echo $website_url.'/ow_admin'; ?>" target="_blank" style="text-decoration:none;"><font color="blue"><?php echo $website_url.'/ow_admin'; ?></font></a>
				</p>
				
			</div>
			
			
			
			
			
			
			<!-- Edit Details -->
			<div id="details_updated_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Website details updated successfully.</p>
			</div>
			<script>
			
				function stop_details_updated_notification()
				{
					document.getElementById('details_updated_notification').style.display='none';
				}
			
			</script>
			<?php
				if(isset($_SESSION['details_updated']))
				{
					echo "<script>document.getElementById('details_updated_notification').style.display='block';setTimeout(stop_details_updated_notification,1500);</script>";
					unset($_SESSION['details_updated']);
				}
			
				if(isset($_REQUEST['edit_confirmed_details'])){
					$website_title=trim($_REQUEST['website_title']);
					$website_url=trim($_REQUEST['website_url']);
					$website_email=trim($_REQUEST['website_email']);
					$website_telephone=trim($_REQUEST['website_telephone']);
					$website_contact_us_message=trim($_REQUEST['website_contact_us_message']);
					$website_contact_us_address=trim($_REQUEST['website_contact_us_address']);
					$website_contact_us_phone=trim($_REQUEST['website_contact_us_phone']);
					$website_contact_us_email=trim($_REQUEST['website_contact_us_email']);
					$contact_us_lat=trim($_REQUEST['contact_us_lat']);
					$contact_us_lng=trim($_REQUEST['contact_us_lng']);
					$map_zoom=trim($_REQUEST['map_zoom']);
					$copyright_title=trim($_REQUEST['copyright_title']);
					$developer_title=trim($_REQUEST['developer_title']);
					$developer_url=trim($_REQUEST['developer_url']);
					$facebook_link=trim($_REQUEST['facebook_link']);
					$instagram_link=trim($_REQUEST['instagram_link']);
					$snapchat_link=trim($_REQUEST['snapchat_link']);
					$pinterest_link=trim($_REQUEST['pinterest_link']);
					$twitter_link=trim($_REQUEST['twitter_link']);
					$linkedin_link=trim($_REQUEST['linkedin_link']);
					
					$stmt = $conn->prepare("update website_basic_info set
						title=:website_title,
						url=:website_url,
						email=:website_email,
						telephone=:website_telephone,
						contact_us_message=:website_contact_us_message,
						contact_us_address=:website_contact_us_address,
						contact_us_phone=:website_contact_us_phone,
						contact_us_email=:website_contact_us_email,
						map_lat=:contact_us_lat,
						map_lng=:contact_us_lng,
						map_zoom=:map_zoom,
						copyright_title=:copyright_title,
						developer_title=:developer_title,
						developer_url=:developer_url,
						facebook_link=:facebook_link,
						instagram_link=:instagram_link,
						snapchat_link=:snapchat_link,
						pinterest_link=:pinterest_link,
						twitter_link=:twitter_link,
						linkedin_link=:linkedin_link
						where id='1'
					");
					$stmt->execute(array('website_title'=>$website_title, 'website_url'=>$website_url, 'website_email'=>$website_email, 'website_telephone'=>$website_telephone, 'website_contact_us_message'=>$website_contact_us_message, 'website_contact_us_address'=>$website_contact_us_address, 'website_contact_us_phone'=>$website_contact_us_phone, 'website_contact_us_email'=>$website_contact_us_email, 'contact_us_lat'=>$contact_us_lat, 'contact_us_lng'=>$contact_us_lng, 'map_zoom'=>$map_zoom, 'copyright_title'=>$copyright_title, 'developer_title'=>$developer_title, 'developer_url'=>$developer_url, 'facebook_link'=>$facebook_link, 'instagram_link'=>$instagram_link, 'snapchat_link'=>$snapchat_link, 'pinterest_link'=>$pinterest_link, 'twitter_link'=>$twitter_link, 'linkedin_link'=>$linkedin_link ));
					
					
					$_SESSION['details_updated']='YES';
					header("Location: vt_index.php#edit_details");
				}
			?>
			
			<div id="edit_details_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-brown"> 
						<span onclick="document.getElementById('edit_details_confirm').style.display='none'" class="w3-button w3-brown w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to update the website details?
						</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['update_website_details'])){
								$website_title=trim($_REQUEST['website_title']);
								$website_url=trim($_REQUEST['website_url']);
								$website_email=trim($_REQUEST['website_email']);
								$website_telephone=trim($_REQUEST['website_telephone']);
								$website_contact_us_message=trim($_REQUEST['website_contact_us_message']);
								$website_contact_us_address=trim($_REQUEST['website_contact_us_address']);
								$website_contact_us_phone=trim($_REQUEST['website_contact_us_phone']);
								$website_contact_us_email=trim($_REQUEST['website_contact_us_email']);
								$contact_us_lat=trim($_REQUEST['contact_us_lat']);
								$contact_us_lng=trim($_REQUEST['contact_us_lng']);
								$map_zoom=trim($_REQUEST['map_zoom']);
								$copyright_title=trim($_REQUEST['copyright_title']);
								$developer_title=trim($_REQUEST['developer_title']);
								$developer_url=trim($_REQUEST['developer_url']);
								$facebook_link=trim($_REQUEST['facebook_link']);
								$instagram_link=trim($_REQUEST['instagram_link']);
								$snapchat_link=trim($_REQUEST['snapchat_link']);
								$pinterest_link=trim($_REQUEST['pinterest_link']);
								$twitter_link=trim($_REQUEST['twitter_link']);
								$linkedin_link=trim($_REQUEST['linkedin_link']);
								
							
						?>
								<a href="vt_index.php?edit_confirmed_details=YES&website_title=<?php echo $website_title; ?>&website_url=<?php echo $website_url; ?>&website_email=<?php echo $website_email; ?>&website_telephone=<?php echo $website_telephone; ?>&website_contact_us_message=<?php echo $website_contact_us_message; ?>&website_contact_us_address=<?php echo $website_contact_us_address; ?>&website_contact_us_phone=<?php echo $website_contact_us_phone; ?>&website_contact_us_email=<?php echo $website_contact_us_email; ?>&contact_us_lat=<?php echo $contact_us_lat; ?>&contact_us_lng=<?php echo $contact_us_lng; ?>&map_zoom=<?php echo $map_zoom; ?>&copyright_title=<?php echo $copyright_title; ?>&developer_title=<?php echo $developer_title; ?>&developer_url=<?php echo $developer_url; ?>&facebook_link=<?php echo $facebook_link; ?>&instagram_link=<?php echo $instagram_link; ?>&snapchat_link=<?php echo $snapchat_link; ?>&pinterest_link=<?php echo $pinterest_link; ?>&twitter_link=<?php echo $twitter_link; ?>&linkedin_link=<?php echo $linkedin_link; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('edit_details_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<?php
				if(isset($_REQUEST['update_website_details']))
				{
					echo '<script>document.getElementById("edit_details_confirm").style.display="block";</script>';
				}
			?>
			
			
			<div class="w3-container" style="margin-top:80px" id="edit_details">
				<h1 class="w3-jumbo w3-text-brown" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Edit Details</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p>This option is used for <font color="red">Edit Basic Details</font> of <?php echo $website_title; ?>.</br>
				Any simple change in this section will effect in whole system.</p>
				<div class="w3-container" style="margin:0px;padding:0px;width:100%;max-width:700px;">
					<form style="margin-top:0px;" action="vt_index.php" method="post" enctype="multipart/form-data">
						<div class="w3-section" style="margin:0px;padding:0px;">
							<label><b>Title</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website Title *" value="<?php echo $website_title; ?>" name="website_title" required>
							<label><b>URL</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website URL (https://..) *" value="<?php echo $website_url; ?>" name="website_url" required>
							<label><b>Email</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Website Email *" value="<?php echo $website_email; ?>" name="website_email" required>
							<label><b>Telephone</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website Telephone *" value="<?php echo $telephone; ?>" name="website_telephone" required>
							<label><b>Contact Us Message</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website Contact Us Message" value="<?php echo $contact_us_msg; ?>" name="website_contact_us_message">
							<label><b>Contact Us Address</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website Contact Us Address *" value="<?php echo $contact_us_address; ?>" name="website_contact_us_address" required>
							<label><b>Contact Us Phone</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website Contact Us Phone *" value="<?php echo $contact_us_phone; ?>" name="website_contact_us_phone" required>
							<label><b>Contact Us Email</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Website Contact Us Email *" value="<?php echo $contact_us_email; ?>" name="website_contact_us_email" required>
							<label><b>Map Details</b></label>
							<div class="w3-row" style="margin:0px 0px 10px 0px;padding:0px;">
								<div class="w3-col" style="width:32%;">
									<input class="w3-input w3-border" type="text" placeholder="Map Latitude Value *" value="<?php echo $contact_us_lat; ?>" name="contact_us_lat" required>
								</div>
								<div class="w3-col" style="margin-left:2%;width:32%;">
									<input class="w3-input w3-border" type="text" placeholder="Map Longitude Value *" value="<?php echo $contact_us_lng; ?>" name="contact_us_lng" required>
								</div>
								<div class="w3-col" style="margin-left:2%;width:32%;">
									<input class="w3-input w3-border" type="text" placeholder="Map Zoom Value *" value="<?php echo $map_zoom; ?>" name="map_zoom" required>
								</div>
							</div>
							<label><b>Copyright Title</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Copyright Title *" value="<?php echo $copyright_title; ?>" name="copyright_title" required>
							
							<label><b>Developer Title</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Developer Title *" value="<?php echo $developer_title; ?>" name="developer_title" required>
							
							<label><b>Developer URL</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Developer URL (https:// ...) *" value="<?php echo $developer_link; ?>" name="developer_url" required>
							
							<label><b>Facebook Link</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Facebook Link (https:// ...)" value="<?php echo $facebook_link; ?>" name="facebook_link">
							
							<label><b>Instagram Link</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Instagram Link (https:// ...)" value="<?php echo $instagram_link; ?>" name="instagram_link">
							
							<label><b>Snapchat Link</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Snapchat Link (https:// ...)" value="<?php echo $snapchat_link; ?>" name="snapchat_link">
							
							<label><b>Pinterest Link</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Pinterest Link (https:// ...)" value="<?php echo $pinterest_link; ?>" name="pinterest_link">
							
							<label><b>Twitter Link</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Twitter Link (https:// ...)" value="<?php echo $twitter_link; ?>" name="twitter_link">
							
							<label><b>Linkedin Link</b></label>
							<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Linkedin Link (https:// ...)" value="<?php echo $linkedin_link; ?>" name="linkedin_link">
							
							<label><b>Website Logo</b></label>
							<div class="w3-row w3-margin-bottom" style="padding:0px;">
								<div class="w3-col" style="width:40%;">
									<img id="view_image1" src="../images/<?php echo $website_logo; ?>" style="width:100%;height:90px;" class="w3-image w3-round w3-border w3-border-gray">
								</div>
								<div id="image1_block1" class="w3-col" style="margin-left:2%;width:58%;">
									<div class="w3-border w3-center w3-button w3-red w3-round" onclick="document.getElementById('selectedFile1').click();" style="opacity:0.9;width:100%;">
										<input class="w3-input" id="selectedFile1" style="display: none;"  onclick="document.getElementById('image_up1').style.display='block';document.getElementById('image1_error').style.display='none'" onchange="image1_upload()" type="file"/>
										<i class="fa fa-image"></i> Select New (375x147) pixels
									</div>
									<p id="image_up1" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Use only for change picture. Best upload ( 375 x 147 ) pixels.</p>
									
									<p id="image1_error" class="w3-medium w3-text-teal w3-bold w3-margin-left" style="display:none;">* Please upload correct image</p>
								</div>
								<!-- Progess Bar Container -->
								<div id="image1_block2" class="w3-col" style="margin-left:2%;width:58%;display:none;">
									<div class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom">
										<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="image1_progress_id" style="width:0%;">0%</div>
									</div>
								</div>
							</div>
							
							<label><b>Developer Logo</b></label>
							<div class="w3-row w3-margin-bottom" style="padding:0px;">
								<div class="w3-col" style="width:40%;">
									<img id="view_image2" src="../images/system/<?php echo $developer_logo; ?>" style="width:100%;height:90px;" class="w3-image w3-round w3-border w3-border-gray">
								</div>
								<div id="image2_block1" class="w3-col" style="margin-left:2%;width:58%;">
									<div class="w3-border w3-center w3-button w3-red w3-round" onclick="document.getElementById('selectedFile2').click();" style="opacity:0.9;width:100%;">
										<input class="w3-input" id="selectedFile2" style="display: none;"  onclick="document.getElementById('image_up2').style.display='block';document.getElementById('image2_error').style.display='none'" onchange="image2_upload()" type="file"/>
										<i class="fa fa-image"></i> Select New (375x147) pixels
									</div>
									<p id="image_up2" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Use only for change picture. Best upload ( 375 x 147 ) pixels.</p>
									
									<p id="image2_error" class="w3-medium w3-text-teal w3-bold w3-margin-left" style="display:none;">* Please upload correct image</p>
								</div>
								<!-- Progess Bar Container -->
								<div id="image2_block2" class="w3-col" style="margin-left:2%;width:58%;display:none;">
									<div class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom">
										<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="image2_progress_id" style="width:0%;">0%</div>
									</div>
								</div>
							</div>
							
							<label><b>Background Image</b></label>
							<div class="w3-row w3-margin-bottom" style="padding:0px;">
								<div class="w3-col" style="width:40%;">
									<img id="view_image3" src="../images/<?php echo $backend_image; ?>" style="width:100%;height:90px;" class="w3-image w3-round w3-border w3-border-gray">
								</div>
								<div id="image3_block1" class="w3-col" style="margin-left:2%;width:58%;">
									<div class="w3-border w3-center w3-button w3-red w3-round" onclick="document.getElementById('selectedFile3').click();" style="opacity:0.9;width:100%;">
										<input class="w3-input" id="selectedFile3" style="display: none;"  onclick="document.getElementById('image_up3').style.display='block';document.getElementById('image3_error').style.display='none'" onchange="image3_upload()" type="file"/>
										<i class="fa fa-image"></i> Select New (375x147) pixels
									</div>
									<p id="image_up3" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Use only for change picture. Best upload ( 375 x 147 ) pixels.</p>
									
									<p id="image3_error" class="w3-medium w3-text-teal w3-bold w3-margin-left" style="display:none;">* Please upload correct image</p>
								</div>
								<!-- Progess Bar Container -->
								<div id="image3_block2" class="w3-col" style="margin-left:2%;width:58%;display:none;">
									<div class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom">
										<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="image3_progress_id" style="width:0%;">0%</div>
									</div>
								</div>
							</div>
							
							
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
									<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha7"  required>
								</div>
							</div>
						  
							<button id="main_submit_btn" class="w3-button w3-block w3-green w3-round w3-margin-top w3-padding" type="submit" name="update_website_details"><i class="fa fa-send"></i> Update Details</button>
							
							
							
						</div>
					</form>
							<button id="temp_submit_btn" class="w3-button w3-block w3-green w3-round w3-margin-top w3-padding" style="display:none;" name="update_website_details"><i class="fa fa-refresh w3-spin"></i> Please Wait ...</button>
						
					
					<script>
						//Profile Pic Validity Checking
						var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png", ".heic"];    
						function file_validate(dataaa) {
							
							var sFileName = dataaa;
							if (sFileName.length > 0) {
								var blnValid = false;
								for (var j = 0; j < _validFileExtensions.length; j++) {
									var sCurExtension = _validFileExtensions[j];
									if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
										blnValid = true;
										break;
									}
								}
								if (!blnValid) {
									 return false;
								}
							}
							return true;
						}
						
						function image1_upload()
						{
							document.getElementById("image1_block1").style.display='none';
							document.getElementById("image1_block2").style.display='block';
							document.getElementById("main_submit_btn").style.display='none';
							document.getElementById("temp_submit_btn").style.display='block';
							document.getElementById("image1_error").style.display='none';
							document.getElementById("image_up1").style.display='none';
							
							//Image info
							var image=document.getElementById('selectedFile1').files[0];
							var image2=document.getElementById('selectedFile1').value;
							
							var fd_image=new FormData();
							var link='selectedFile1';
							fd_image.append(link, image);
							
							if(image2!="" && file_validate(image2)==false) //Image file extention not write
							{
								
								document.getElementById("image1_error").style.display='block';
								
								document.getElementById("image1_block2").style.display='none';
								document.getElementById("image1_block1").style.display='block';
								document.getElementById("temp_submit_btn").style.display='none';
								document.getElementById("main_submit_btn").style.display='block';
							}
							else if(image2!="" &&  file_validate(image2)==true) //Image extention correct
							{
								//Ajax for image upload
								var xhttp1 = new XMLHttpRequest();
								xhttp1.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
										//retrive image_name
										var image_name=this.responseText.trim();
										image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
										
										if(image_name=="Ok")
										{
											var tmppath = URL.createObjectURL(image);
													$("#view_image1").fadeIn("fast").attr('src',tmppath);
													$("#main_image").fadeIn("fast").attr('src',tmppath);
													$("#shortcut_image").fadeIn("fast").attr('src',tmppath);
											
											document.getElementById("image1_block2").style.display='none';
											document.getElementById("image1_block1").style.display='block';
											document.getElementById("temp_submit_btn").style.display='none';
											document.getElementById("main_submit_btn").style.display='block';
							
										}
										else
										{
											document.getElementById("image1_error").style.display='block';
								
											document.getElementById("image1_block2").style.display='none';
											document.getElementById("image1_block1").style.display='block';
											document.getElementById("temp_submit_btn").style.display='none';
											document.getElementById("main_submit_btn").style.display='block';
										}
										
									}};
									xhttp1.upload.onprogress = function(e) {
										if (e.lengthComputable) {
										  var percentComplete = Math.round((e.loaded / e.total) * 100);
										  percentComplete=percentComplete.toFixed(2);
										  if(percentComplete==100)
										  {
											 document.getElementById('image1_progress_id').style.width=percentComplete+'%';
										     document.getElementById('image1_progress_id').innerHTML= percentComplete+'%';
										  }
										  else
										  {
										     document.getElementById('image1_progress_id').style.width=percentComplete+'%';
										     document.getElementById('image1_progress_id').innerHTML= percentComplete+'%';
										  }
										}
									};
									xhttp1.open("POST", "../include/website_logo_update.php?update_logo=yes&image="+link, true);
									xhttp1.send(fd_image);
							}
							
						}
						
						
						
						function image2_upload()
						{
							document.getElementById("image2_block1").style.display='none';
							document.getElementById("image2_block2").style.display='block';
							document.getElementById("main_submit_btn").style.display='none';
							document.getElementById("temp_submit_btn").style.display='block';
							document.getElementById("image2_error").style.display='none';
							document.getElementById("image_up2").style.display='none';
							
							//Image info
							var image=document.getElementById('selectedFile2').files[0];
							var image2=document.getElementById('selectedFile2').value;
							
							var fd_image=new FormData();
							var link='selectedFile2';
							fd_image.append(link, image);
							
							if(image2!="" && file_validate(image2)==false) //Image file extention not write
							{
								
								document.getElementById("image2_error").style.display='block';
								
								document.getElementById("image2_block2").style.display='none';
								document.getElementById("image2_block1").style.display='block';
								document.getElementById("temp_submit_btn").style.display='none';
								document.getElementById("main_submit_btn").style.display='block';
							}
							else if(image2!="" &&  file_validate(image2)==true) //Image extention correct
							{
								//Ajax for image upload
								var xhttp1 = new XMLHttpRequest();
								xhttp1.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
										//retrive image_name
										var image_name=this.responseText.trim();
										image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
										
										if(image_name=="Ok")
										{
											var tmppath = URL.createObjectURL(image);
													$("#view_image2").fadeIn("fast").attr('src',tmppath);
													$("#dev_image1").fadeIn("fast").attr('src',tmppath);
													$("#dev_image2").fadeIn("fast").attr('src',tmppath);
													
											document.getElementById("image2_block2").style.display='none';
											document.getElementById("image2_block1").style.display='block';
											document.getElementById("temp_submit_btn").style.display='none';
											document.getElementById("main_submit_btn").style.display='block';
							
										}
										else
										{
											document.getElementById("image2_error").style.display='block';
								
											document.getElementById("image2_block2").style.display='none';
											document.getElementById("image2_block1").style.display='block';
											document.getElementById("temp_submit_btn").style.display='none';
											document.getElementById("main_submit_btn").style.display='block';
										}
										
									}};
									xhttp1.upload.onprogress = function(e) {
										if (e.lengthComputable) {
										  var percentComplete = Math.round((e.loaded / e.total) * 100);
										  percentComplete=percentComplete.toFixed(2);
										  if(percentComplete==100)
										  {
											 document.getElementById('image2_progress_id').style.width=percentComplete+'%';
										     document.getElementById('image2_progress_id').innerHTML= percentComplete+'%';
										  }
										  else
										  {
										     document.getElementById('image2_progress_id').style.width=percentComplete+'%';
										     document.getElementById('image2_progress_id').innerHTML= percentComplete+'%';
										  }
										}
									};
									xhttp1.open("POST", "../include/developer_logo_update.php?update_logo=yes&image="+link, true);
									xhttp1.send(fd_image);
							}
							
						}
						
						
						function image3_upload()
						{
							document.getElementById("image3_block1").style.display='none';
							document.getElementById("image3_block2").style.display='block';
							document.getElementById("main_submit_btn").style.display='none';
							document.getElementById("temp_submit_btn").style.display='block';
							document.getElementById("image3_error").style.display='none';
							document.getElementById("image_up3").style.display='none';
							
							//Image info
							var image=document.getElementById('selectedFile3').files[0];
							var image2=document.getElementById('selectedFile3').value;
							
							var fd_image=new FormData();
							var link='selectedFile3';
							fd_image.append(link, image);
							
							if(image2!="" && file_validate(image2)==false) //Image file extention not write
							{
								
								document.getElementById("image3_error").style.display='block';
								
								document.getElementById("image3_block2").style.display='none';
								document.getElementById("image3_block1").style.display='block';
								document.getElementById("temp_submit_btn").style.display='none';
								document.getElementById("main_submit_btn").style.display='block';
							}
							else if(image2!="" &&  file_validate(image2)==true) //Image extention correct
							{
								//Ajax for image upload
								var xhttp1 = new XMLHttpRequest();
								xhttp1.onreadystatechange = function() {
									if (this.readyState == 4 && this.status == 200) {
										//retrive image_name
										var image_name=this.responseText.trim();
										image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
										
										if(image_name=="Ok")
										{
											var tmppath = URL.createObjectURL(image);
													$("#view_image3").fadeIn("fast").attr('src',tmppath);
													
											document.getElementById("image3_block2").style.display='none';
											document.getElementById("image3_block1").style.display='block';
											document.getElementById("temp_submit_btn").style.display='none';
											document.getElementById("main_submit_btn").style.display='block';
							
										}
										else
										{
											document.getElementById("image3_error").style.display='block';
								
											document.getElementById("image3_block2").style.display='none';
											document.getElementById("image3_block1").style.display='block';
											document.getElementById("temp_submit_btn").style.display='none';
											document.getElementById("main_submit_btn").style.display='block';
										}
										
									}};
									xhttp1.upload.onprogress = function(e) {
										if (e.lengthComputable) {
										  var percentComplete = Math.round((e.loaded / e.total) * 100);
										  percentComplete=percentComplete.toFixed(2);
										  if(percentComplete==100)
										  {
											 document.getElementById('image3_progress_id').style.width=percentComplete+'%';
										     document.getElementById('image3_progress_id').innerHTML= percentComplete+'%';
										  }
										  else
										  {
										     document.getElementById('image3_progress_id').style.width=percentComplete+'%';
										     document.getElementById('image3_progress_id').innerHTML= percentComplete+'%';
										  }
										}
									};
									xhttp1.open("POST", "../include/backend_logo_update.php?update_logo=yes&image="+link, true);
									xhttp1.send(fd_image);
							}
							
						}
						
						
					
						//Captcha Validation for create new password
						var reservation_captcha7 = document.getElementById("captcha7");
						var sol7=<?php echo $ccc; ?>;
						function reservation_captcha_val7(){
						  
						  //console.log(reservation_captcha.value);
						  //console.log(sol);
						  if(reservation_captcha7.value != sol7) {
							reservation_captcha7.setCustomValidity("Please Enter Valid Answer.");
						  } else {
							reservation_captcha7.setCustomValidity('');
						  }
						}
						reservation_captcha7.onchange=reservation_captcha_val7;
					</script>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			<!-- Add Admin Details -->
			<div id="admin_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Admin added successfully.</p>
			</div>
			<div id="admin_notification2" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Sorry email or mobile already in use.</p>
			</div>
			<div id="admin_notification3" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Admin removed successfully.</p>
			</div>
			<div id="admin_notification4" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Admin details updated successfully.</p>
			</div>
			
			<script>
			
				function stop_admin_notification()
				{
					document.getElementById('admin_notification').style.display='none';
					document.getElementById('admin_notification2').style.display='none';
					document.getElementById('admin_notification3').style.display='none';
					document.getElementById('admin_notification4').style.display='none';
				}
			
			</script>
			<?php
				if(isset($_SESSION['admin_successful']))
				{
					echo "<script>document.getElementById('admin_notification').style.display='block';setTimeout(stop_admin_notification,1500);</script>";
					unset($_SESSION['admin_successful']);
				}
				if(isset($_SESSION['admin_unsuccessful']))
				{
					echo "<script>document.getElementById('admin_notification2').style.display='block';setTimeout(stop_admin_notification,1500);</script>";
					unset($_SESSION['admin_unsuccessful']);
				}
				if(isset($_REQUEST['confirmed_admin']))
				{
					$name=trim($_REQUEST['name']);
					$mobile=trim($_REQUEST['mobile']);
					$email=trim($_REQUEST['email']);
					$password=trim($_REQUEST['passkey']);
					$date=get_date();
					
					try{
						$stmt=$conn->prepare("select * from ow_admin where email=:email OR mobile=:mobile order by owner_id asc ");
						$stmt->execute(array('email'=>$email,'mobile'=>$mobile));
						$list=$stmt->fetchAll();
					}
					catch(PDOException $e)
					{
						echo "Error: ".$e->getMessage();
					}
					if(count($list)>0) //email or mobile in used
					{
						$_SESSION['admin_unsuccessful']='YES';
					}
					else
					{
						
						try
						{
							$stmt=$conn->prepare("insert into ow_admin(name,email,password,mobile,date,status) VALUES (?, ?, ?, ?, '$date' ,'active') ");
							$stmt->execute([$name,$email,$password,$mobile]);
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
						//echo '<script>console.log("YESS");</script>';
						$_SESSION['admin_successful']='YES';
					}
					header("Location: vt_index.php#edit_admin");
				}
			
			?>
			
			<!-- Add Admin Confirm Modal -->
			<div id="admin_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-brown"> 
						<span onclick="document.getElementById('admin_confirm').style.display='none'" class="w3-button w3-brown w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to add a new admin
						<?php 
							if(isset($_REQUEST['add_admin'])){
								$email=trim($_REQUEST['email']);
						?>
						( <font color="blue"><?php echo $email; ?></font> )
						<?php 
							}
						?>
						?
						</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['add_admin'])){
								$name=trim($_REQUEST['full_name']);
								$mobile=trim($_REQUEST['mobile']);
								$email=trim($_REQUEST['email']);
								$password=trim($_REQUEST['password']);
								$password=sha1($password);
						?>
								<a href="vt_index.php?confirmed_admin=YES&name=<?php echo $name; ?>&mobile=<?php echo $mobile; ?>&email=<?php echo $email; ?>&passkey=<?php echo $password; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('admin_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<?php
				if(isset($_REQUEST['add_admin']))
				{
					echo '<script>document.getElementById("admin_confirm").style.display="block";</script>';
				}
			?>
			
			
			
			<!-- Edit Admin Confirm Modal -->
			<?php	
				if(isset($_SESSION['edit_admin_successful']))
				{
					echo "<script>document.getElementById('admin_notification4').style.display='block';setTimeout(stop_admin_notification,1500);</script>";
					unset($_SESSION['edit_admin_successful']);
				}
				
				if(isset($_REQUEST['edit_confirmed_admin']))
				{
					$name=trim($_REQUEST['name']);
					$mobile=trim($_REQUEST['mobile']);
					$email=trim($_REQUEST['email']);
					$status=trim($_REQUEST['status']);
					$password=trim($_REQUEST['passkey']);
					if($password=="")
					{
						try
						{
							if($status=="")
							{
								$stmt=$conn->prepare("update ow_admin set name=:name where email='$email' AND mobile='$mobile' ");
								$stmt->execute(array('name'=>$name));
							}
							else
							{
								$stmt=$conn->prepare("update ow_admin set name=:name, status=:status where email='$email' AND mobile='$mobile' ");
								$stmt->execute(array('name'=>$name, 'status'=>$status));
							}
							
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
					}
					else
					{
						try
						{
							if($status=="")
							{
								$stmt=$conn->prepare("update ow_admin set name=:name, password=:password where email='$email' AND mobile='$mobile' ");
								$stmt->execute(array('name'=>$name, 'password'=>$password));
							}
							else
							{
								$stmt=$conn->prepare("update ow_admin set name=:name, password=:password, status=:status where email='$email' AND mobile='$mobile' ");
								$stmt->execute(array('name'=>$name, 'password'=>$password, 'status'=>$status));
							
							}
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
					}
						
					
					$_SESSION['edit_admin_successful']='YES';
					header("Location: vt_index.php#edit_admin");
				}
			
			?>
			
			<div id="edit_admin_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-brown"> 
						<span onclick="document.getElementById('edit_admin_confirm').style.display='none'" class="w3-button w3-brown w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to modify admin
						<?php 
							if(isset($_REQUEST['edit_admin_details2'])){
								$email=trim($_REQUEST['email']);
						?>
						( <font color="blue"><?php echo $email; ?></font> )
						<?php 
							}
						?>
						?
						</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['edit_admin_details2'])){
								$name=trim($_REQUEST['name']);
								$mobile=trim($_REQUEST['mobile']);
								$email=trim($_REQUEST['email']);
								$status=trim($_REQUEST['status']);
								$password=trim($_REQUEST['password']);
								if($password!="")
									$password=sha1($password);
						?>
								<a href="vt_index.php?edit_confirmed_admin=YES&name=<?php echo $name; ?>&mobile=<?php echo $mobile; ?>&email=<?php echo $email; ?>&passkey=<?php echo $password; ?>&status=<?php echo $status; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('edit_admin_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<?php
				if(isset($_REQUEST['edit_admin_details2']))
				{
					echo '<script>document.getElementById("edit_admin_confirm").style.display="block";</script>';
				}
			?>
			
			<div id="edit_admin_details" class="w3-modal" style="z-index:99999999;">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
					
					<div class="w3-container"><br>
						<span onclick="document.getElementById('edit_admin_details').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
						<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;margin:0px;">Edit Admin</h2>
					</div>
					
					<form action="vt_index.php#edit_admin" method="post" style="martgin:0px;padding:0px;">
					
						<div class="w3-section w3-border w3-padding">
									  
							<input class="w3-input w3-border" style="margin:8px 0px 0px 0px;" type="text" name="name" value="<?php if(isset($_REQUEST['edit_admin_details'])){ echo $_REQUEST['name']; } ?>" placeholder="Enter Admin Full Name *"  maxlength="35" required>
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:30%;">
									<input class="w3-input w3-border w3-center" type="text" value="UK (+44)" disabled>
								</div>
								<div class="w3-col" style="margin-left:2%;width:68%;">
									<input class="w3-input w3-border" type="text"  maxlength="11" value="<?php if(isset($_REQUEST['edit_admin_details'])){ echo $_REQUEST['mobile']; } ?>"  placeholder="Mobile Number (11 digits) * " disabled>
									<input class="w3-input w3-border" type="hidden" value="<?php if(isset($_REQUEST['edit_admin_details'])){ echo $_REQUEST['mobile']; } ?>"  name="mobile">
								</div>
							</div>
							
							<input class="w3-input w3-border" type="email" style="margin:8px 0px 0px 0px;" value="<?php if(isset($_REQUEST['edit_admin_details'])){ echo $_REQUEST['email']; } ?>" placeholder="Enter Email Address *" disabled>
							<input class="w3-input w3-border" type="hidden" style="margin:8px 0px 0px 0px;" name="email" value="<?php if(isset($_REQUEST['edit_admin_details'])){ echo $_REQUEST['email']; } ?>">
							
							
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:49%;">
									<input class="w3-input w3-border" name="password" type="password" placeholder="Password *" id="ccch_password" onclick="document.getElementById('pass_up2').style.display='block';" onfocusout="document.getElementById('pass_up2').style.display='none';" maxlength="30">
								</div>
								<div class="w3-col" style="margin-left:2%;width:49%;">
									<input class="w3-input w3-border" type="password" placeholder="Re-type Password *" id="ccch_confirm_password" onclick="document.getElementById('pass_up2').style.display='block';" onfocusout="document.getElementById('pass_up2').style.display='none';" maxlength="30">
								</div>
							</div>
						    <p id="pass_up2" class="w3-tiny w3-text-red w3-bold" style="display:none;margin:0px 0px 0px 0px;">* Use only for change password.</p>
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:40%;">
									<input class="w3-input w3-border w3-center <?php if(isset($_REQUEST['edit_admin_details'])){ $status=$_REQUEST['status']; if($status=='active'){ echo 'w3-green'; } else { echo 'w3-red'; } } ?>" type="text" value="<?php if(isset($_REQUEST['edit_admin_details'])){ $status=$_REQUEST['status']; if($status=='active'){ echo 'Active'; } else{ echo 'Inactive'; } }?>" disabled>
								</div>
								<div class="w3-col" style="margin-left:2%;width:58%;">
									<select name='status' class="w3-input w3-border">
										<?php 
											echo '<option value="">Change ...</option>';
											if(isset($_REQUEST['edit_admin_details']))
											{ 
												$status=$_REQUEST['status'];
												if($status=='active')
												{
													echo '<option value="inactive">Inactive</option>';
												}
												else
												{
													echo '<option value="active">Active</option>';
												}
											} 
										?>
									</select>
								</div>
							</div>
							
					   
							<?php 
								//spam Check 
								$a=rand(1,20);
								$b=rand(1,20);
								$c=$a+$b;
							?>
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:40%;">
									<input class="w3-input w3-border w3-center" type="text" value="<?php echo $a.' + '.$b.' = '; ?>" disabled>
								</div>
								<div class="w3-col" style="margin-left:2%;width:58%;">
									<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="ccaptcha2"  required>
								</div>
							</div>
							
							<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 8px 0px;" name="edit_admin_details2"><i class="fa fa-user-plus"></i> Edit Admin</button>
							
						</div>
					</form>
					<script>
						//Password Checking
						var ccch_password = document.getElementById("ccch_password"), ccch_confirm_password = document.getElementById("ccch_confirm_password");

						function ccch_validatePassword(){
						  if(ccch_password.value.length<6)
						  {
							ccch_password.setCustomValidity("Passwords must be greater than 6 characters");
						  }
						  else if(ccch_password.value != ccch_confirm_password.value) {
							
							ccch_password.setCustomValidity('');
							ccch_confirm_password.setCustomValidity("Passwords Don't Match");
						  } else {
							ccch_confirm_password.setCustomValidity('');
							ccch_password.setCustomValidity('');
						  }
						}

						ccch_password.onchange = ccch_validatePassword;
						ccch_confirm_password.onkeyup = ccch_validatePassword;
						
						
						//Captch checking for sign up
						var creservation_captcha2 = document.getElementById("ccaptcha2");
						var csol2=<?php echo $c; ?>;
						function creservation_captcha_val2(){
						  
						  //console.log(reservation_captcha.value);
						  //console.log(sol);
						  if(creservation_captcha2.value != csol2) {
							creservation_captcha2.setCustomValidity("Please Enter Valid Answer.");
						  } else {
							creservation_captcha2.setCustomValidity('');
						  }
						}
						creservation_captcha2.onchange=creservation_captcha_val2;
					
					</script>
				</div>
			</div>
			<?php 
				if(isset($_REQUEST['edit_admin_details']))
				{ 
					 echo '<script>document.getElementById("edit_admin_details").style.display="block";</script>';
				} 
			?>
			
			
			<!-- Delete Admin confirm model -->
			<?php 
				if(isset($_SESSION['remove_confirm']))
				{
					echo "<script>document.getElementById('admin_notification3').style.display='block';setTimeout(stop_admin_notification,1500);</script>";
					unset($_SESSION['remove_confirm']);
				}
			
				if(isset($_REQUEST['remove_admin']))
				{
					$mobile=trim($_REQUEST['mobile']);
					$email=trim($_REQUEST['email']);
					try
					{
						$stmt=$conn->prepare("delete from ow_admin where mobile='$mobile' AND email='$email' ");
						$stmt->execute();
					}
					catch(PDOException $e) 
					{
						echo 'Error: '.$e-getMessage();
					}
					$_SESSION['remove_confirm']='YES';
					header("Location: vt_index.php#edit_admin");
				}
			?>	
			<div id="delete_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-brown"> 
						<span onclick="document.getElementById('delete_confirm').style.display='none'" class="w3-button w3-brown w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>
					
					<div class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to remove this admin
						<?php 
							if(isset($_REQUEST['delete_admin'])){
								$email=trim($_REQUEST['email']);
						?>
						( <font color="blue"><?php echo $email; ?></font> )
						<?php 
							}
						?>
						</p><br>
					</div>
					
					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['delete_admin'])){
								$mobile=trim($_REQUEST['mobile']);
								$email=trim($_REQUEST['email']);
						?>
								<a href="vt_index.php?remove_admin=YES&email=<?php echo $email; ?>&mobile=<?php echo $mobile; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('delete_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
			<?php 
				if(isset($_REQUEST['delete_admin']))
				{
					echo '<script>document.getElementById("delete_confirm").style.display="block";</script>';
				}
			?>
					
			<?php
				if(isset($_REQUEST['update_subscription']))
				{
					echo '<script>document.getElementById("subscription_confirm").style.display="block";</script>';
				}
			
			?>
			<!-- Admin Add modal confirm window code ends here -->
			<div id="add_admin" class="w3-modal" style="z-index:99999999;">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
					
					<div class="w3-container"><br>
						<span onclick="document.getElementById('add_admin').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
						<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;margin:0px;">Add Admin</h2>
					</div>
					
					<form action="vt_index.php#edit_admin" method="post" style="martgin:0px;padding:0px;">
					
						<div class="w3-section w3-border w3-padding">
									  
							<input class="w3-input w3-border" style="margin:8px 0px 0px 0px;" type="text" name="full_name" placeholder="Enter Admin Full Name *"  maxlength="35" required>
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:30%;">
									<input class="w3-input w3-border w3-center" type="text" value="UK (+44)" disabled>
								</div>
								<div class="w3-col" style="margin-left:2%;width:68%;">
									<input class="w3-input w3-border" type="text"  maxlength="11"  placeholder="Mobile Number (11 digits) * " name="mobile" id="up_mobile" required>
								</div>
							</div>
							
							<input class="w3-input w3-border" type="email" style="margin:8px 0px 0px 0px;" name="email" placeholder="Enter Email Address *" required>
							
							
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:49%;">
									<input class="w3-input w3-border" name="password" type="password" placeholder="Password *" id="cch_password" maxlength="30" required>
								</div>
								<div class="w3-col" style="margin-left:2%;width:49%;">
									<input class="w3-input w3-border" type="password" placeholder="Re-type Password *" id="cch_confirm_password" maxlength="30" required>
								</div>
							</div>
						   
							<?php 
								//spam Check 
								$a=rand(1,20);
								$b=rand(1,20);
								$c=$a+$b;
							?>
							
							<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
								<div class="w3-col" style="width:40%;">
									<input class="w3-input w3-border w3-center" type="text" value="<?php echo $a.' + '.$b.' = '; ?>" disabled>
								</div>
								<div class="w3-col" style="margin-left:2%;width:58%;">
									<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha2"  required>
								</div>
							</div>
							
							<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 8px 0px;" name="add_admin"><i class="fa fa-user-plus"></i> Add Admin</button>
							
						</div>
					</form>
					<script>
						//Password Checking
						var cch_password = document.getElementById("cch_password"), cch_confirm_password = document.getElementById("cch_confirm_password");

						function cch_validatePassword(){
						  if(cch_password.value.length<6)
						  {
							cch_password.setCustomValidity("Passwords must be greater than 6 characters");
						  }
						  else if(cch_password.value != cch_confirm_password.value) {
							
							cch_password.setCustomValidity('');
							cch_confirm_password.setCustomValidity("Passwords Don't Match");
						  } else {
							cch_confirm_password.setCustomValidity('');
							cch_password.setCustomValidity('');
						  }
						}

						cch_password.onchange = cch_validatePassword;
						cch_confirm_password.onkeyup = cch_validatePassword;
						
						//Mobile no checking
						var up_mobile = document.getElementById("up_mobile");
						function up_validateMobile(){
						  
						  //console.log(mobile.value.length);
						  if(up_mobile.value.length != 11) {
							up_mobile.setCustomValidity("Please Enter Valid Mobile Number (11 digits).");
						  } else {
							up_mobile.setCustomValidity('');
						  }
						}
						up_mobile.onchange=up_validateMobile;
						
						
						//Captch checking for sign up
						var reservation_captcha2 = document.getElementById("captcha2");
						var sol2=<?php echo $c; ?>;
						function reservation_captcha_val2(){
						  
						  //console.log(reservation_captcha.value);
						  //console.log(sol);
						  if(reservation_captcha2.value != sol2) {
							reservation_captcha2.setCustomValidity("Please Enter Valid Answer.");
						  } else {
							reservation_captcha2.setCustomValidity('');
						  }
						}
						reservation_captcha2.onchange=reservation_captcha_val2;
					
					</script>
				</div>
			</div>
	
			<!-- Admin Table -->
			<div class="w3-container" style="margin-top:80px" id="edit_admin">
				<h1 class="w3-jumbo w3-text-brown" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Edit Admin</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p>This option is used for <font color="red">Edit, Update or Delete</font> Admin Details of <?php echo $website_title; ?>.</p>  
				<div class="w3-container" style="padding:0px;margin:0px 0px 10px 0px;width:100%;max-width:700px;">
					<button class="w3-button w3-green w3-round w3-padding-small w3-right w3-small" onclick="document.getElementById('add_admin').style.display='block';"><i class="fa fa-user-plus"></i> Add Admin</button>
				</div>
				<div class="w3-container w3-brown w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="margin:0px;padding:0px;width:100%;max-width:700px;">
					<table style="width:100%;text-align:center;">
						<tbody>
							<tr>
								<td style="width:15%;border:2px solid white;">S.L.</td>
								<td style="width:60%;border:2px solid white;">Email</td>
								<td style="width:25%;border:2px solid white;">Action</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar" style="height:350px;overflow:auto;width:100%;max-width:700px;padding: 4px 0px;">
					<table class="w3-medium w3-hide-medium w3-hide-small" style="width:100%;text-align:center;">
						<tbody>
							<?php
							
								$sl=0;
								try
								{
									$stmt=$conn->prepare("select * from ow_admin order by owner_id desc");
									$stmt->execute();
									$list=$stmt->fetchAll();
									foreach($list as $row)
									{
										$sl++;
							?>
										<tr class="<?php if($sl%2==0){ echo 'w3-sand'; } else { echo 'w3-light-gray'; } ?>"> 
											<td style="width:15%;border:2px solid white;"><?php echo $sl; ?></td>
											<td style="width:60%;border:2px solid white;"><?php echo $row['email']; ?></td>
											<td style="width:25%;border:2px solid white;">
												<a class="w3-margin-right" href="vt_index.php?edit_admin_details=YES&name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>&mobile=<?php echo $row['mobile']; ?>&status=<?php echo $row['status']; ?>"><i class="fa fa-edit w3-bold w3-medium w3-text-green w3-hover-white" style="cursor:pointer;" Title="Edit Details"></i></a>
												<a href="vt_index.php?delete_admin=YES&email=<?php echo $row['email']; ?>&mobile=<?php echo $row['mobile']; ?>"><i class="fa fa-close w3-bold w3-medium w3-text-red w3-hover-white" style="cursor:pointer;" Title="Delete"></i></a>
											</td>
										</tr>
							<?php
									}
								}
								catch(PDOException $e)
								{
									echo "Error: ".$e->getMessage();
								}
								if($sl==0)
									echo '<td colspan="3" style="color:red;padding-top:120px;">No Admin Added Yet</td>';
							?>
						</tbody>
					</table>
					
					<table class="w3-small w3-hide-large w3-hide-small" style="width:100%;text-align:center;">
						<tbody>
							<?php
							
								$sl=0;
								try
								{
									$stmt=$conn->prepare("select * from ow_admin order by owner_id desc");
									$stmt->execute();
									$list=$stmt->fetchAll();
									foreach($list as $row)
									{
										$sl++;
							?>
										<tr class="<?php if($sl%2==0){ echo 'w3-sand'; } else { echo 'w3-light-gray'; } ?>"> 
											<td style="width:15%;border:2px solid white;"><?php echo $sl; ?></td>
											<td style="width:60%;border:2px solid white;"><?php echo $row['email']; ?></td>
											<td style="width:25%;border:2px solid white;">
												<a class="w3-margin-right" href="vt_index.php?edit_admin_details=YES&name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>&mobile=<?php echo $row['mobile']; ?>&status=<?php echo $row['status']; ?>"><i class="fa fa-edit w3-bold w3-medium w3-text-green w3-hover-white" style="cursor:pointer;" Title="Edit Details"></i></a>
												<a href="vt_index.php?delete_admin=YES&email=<?php echo $row['email']; ?>&mobile=<?php echo $row['mobile']; ?>"><i class="fa fa-close w3-bold w3-medium w3-text-red w3-hover-white" style="cursor:pointer;" Title="Delete"></i></a>
											</td>
										</tr>
							<?php
									}
								}
								catch(PDOException $e)
								{
									echo "Error: ".$e->getMessage();
								}
								if($sl==0)
									echo '<td colspan="3" style="color:red;padding-top:120px;">No Admin Added Yet</td>';
							?>
						</tbody>
					</table>
					
					<table class="w3-tiny w3-hide-medium w3-hide-large" style="width:100%;text-align:center;">
						<tbody>
							<?php
							
								$sl=0;
								try
								{
									$stmt=$conn->prepare("select * from ow_admin order by owner_id desc");
									$stmt->execute();
									$list=$stmt->fetchAll();
									foreach($list as $row)
									{
										$sl++;
							?>
										<tr class="<?php if($sl%2==0){ echo 'w3-sand'; } else { echo 'w3-light-gray'; } ?>"> 
											<td style="width:15%;border:2px solid white;"><?php echo $sl; ?></td>
											<td style="width:60%;border:2px solid white;"><?php echo $row['email']; ?></td>
											<td style="width:25%;border:2px solid white;">
												<a class="w3-margin-right" href="vt_index.php?edit_admin_details=YES&name=<?php echo $row['name']; ?>&email=<?php echo $row['email']; ?>&mobile=<?php echo $row['mobile']; ?>&status=<?php echo $row['status']; ?>"><i class="fa fa-edit w3-bold w3-medium w3-text-green w3-hover-white" style="cursor:pointer;" Title="Edit Details"></i></a>
												<a href="vt_index.php?delete_admin=YES&email=<?php echo $row['email']; ?>&mobile=<?php echo $row['mobile']; ?>"><i class="fa fa-close w3-bold w3-medium w3-text-red w3-hover-white" style="cursor:pointer;" Title="Delete"></i></a>
											</td>
										</tr>
							<?php
									}
								}
								catch(PDOException $e)
								{
									echo "Error: ".$e->getMessage();
								}
								if($sl==0)
									echo '<td colspan="3" style="color:red;padding-top:120px;">No Admin Added Yet</td>';
							?>
						</tbody>
					</table>
					
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			
			<!-- Subscription Details -->
			<div id="subscription_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
				<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Subscription validity updated successfully.</p>
			</div>
			<script>
			
				function stop_subscription_notification()
				{
					document.getElementById('subscription_notification').style.display='none';
				}
			
			</script>
			
			<?php
				if(isset($_SESSION['subscription_successful']))
				{
					echo "<script>document.getElementById('subscription_notification').style.display='block';setTimeout(stop_subscription_notification,1500);</script>";
					unset($_SESSION['subscription_successful']);
				}
			
				if(isset($_REQUEST['confirmed_subscription']))
				{
					$date=trim($_REQUEST['date']);
					try
					{
						$stmt=$conn->prepare("update subscription set date=:date where subscription_id='1' ");
						$stmt->execute(array('date'=>$date));
					}
					catch(PDOException $e)
					{
						echo "Error: ".$e->getMessage();
					}
					//echo '<script>console.log("YESS");</script>';
					$_SESSION['subscription_successful']='YES';
					header("Location: vt_index.php#subscription");
				}
			?>
			<!-- Confirm Modal -->
			<div id="subscription_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-brown"> 
						<span onclick="document.getElementById('subscription_confirm').style.display='none'" class="w3-button w3-brown w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to update the subscription date 
						<?php
							if(isset($_REQUEST['update_subscription'])){
								$date=trim($_REQUEST['date']);
								$sub_date=$date;
					
								$month=$sub_date[0].$sub_date[1]; $day=$sub_date[3].$sub_date[4]; $year=$sub_date[6].$sub_date[7].$sub_date[8].$sub_date[9];
								$monthNum  = $month;
								$dateObj   = DateTime::createFromFormat('!m', $monthNum);
								$monthName = $dateObj->format('F'); // March
						?>
						 ( <font color="red"><?php echo $day.' '.$monthName.', '.$year; ?></font> ) ?
						<?php
							}
						?>
						</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['update_subscription'])){
								$date=trim($_REQUEST['date']);
					
						?>
								<a href="vt_index.php?confirmed_subscription=YES&date=<?php echo $date; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('subscription_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>		
			<?php
				if(isset($_REQUEST['update_subscription']))
				{
					echo '<script>document.getElementById("subscription_confirm").style.display="block";</script>';
				}
			
			?>
			
			<div class="w3-container" style="margin-top:80px" id="subscription">
				<h1 class="w3-jumbo w3-text-brown" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Subscription</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<?php
					//Getting current subscription details from db
					try
					{
						$stmt=$conn->prepare("select * from subscription where status='active' order by subscription_id asc ");
						$stmt->execute();
						$list=$stmt->fetchAll();
						$sub_date=$list[0]['date'];
					
						$month=$sub_date[0].$sub_date[1]; $day=$sub_date[3].$sub_date[4]; $year=$sub_date[6].$sub_date[7].$sub_date[8].$sub_date[9];
						$monthNum  = $month;
						$dateObj   = DateTime::createFromFormat('!m', $monthNum);
						$monthName = $dateObj->format('F'); // March
					}
					catch(PDOException $e)
					{
						echo "Error: ".$e->getMessage();
					}
				?>
				<p>This option is used for update subscription of <?php echo $website_title; ?>.</br> Current subscription expire date: <font color="red"><?php echo $day.' '.$monthName.', '.$year.'.'; ?></font></p>  
				
				<div class="w3-container" style="margin:0px;padding:0px;width:100%;max-width:700px;">
				
					<form style="margin-top:0px;" action="vt_index.php" method="post">
						
						<div class="w3-section" style="margin:0px;padding:0px;">
						  <label><b>Update Subscription</b></label>
						  <input class="w3-input w3-border w3-margin-bottom" id="datepicker" type="text" placeholder="Enter New Date (MM/DD/YYYY) *" name="date" required> 
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
						  
						  <button class="w3-button w3-block w3-green w3-round w3-margin-top w3-padding" type="submit" name="update_subscription"><i class="fa fa-send"></i> Update Subscription</button>
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
			
			
			
			
			
			
			
			
			
			
			<!-- Edit Profile Details -->
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
					$controller_id=$_SESSION['controller_id'];
					
					if($password=="") //Password not changed
					{
						try
						{
							$stmt=$conn->prepare("update vt_controller set email=:email, mobile=:mobile where controller_id='$controller_id' ");
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
							$stmt=$conn->prepare("update vt_controller set email=:email, mobile=:mobile, password=:password where controller_id='$controller_id' ");
							$stmt->execute(array('email'=>$email, 'mobile'=>$mobile, 'password'=>$password));
						}
						catch(PDOException $e)
						{
							echo "Error: ".$e->getMessage();
						}
						//echo '<script>console.log("YESS");</script>';
					}
					$_SESSION['profile_update_successful']='YES';
					header("Location: vt_index.php#edit_profile");
				}
			?>
			
			<!-- Confirm Modal -->
			<div id="edit_profile_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-brown"> 
						<span onclick="document.getElementById('edit_profile_confirm').style.display='none'" class="w3-button w3-brown w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to make the changes in Controller Profile?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['edit_profile'])){
								$email=trim($_REQUEST['email']);
								$mobile=trim($_REQUEST['mobile']);
								$password=trim($_REQUEST['password']);
					
						?>
								<a href="vt_index.php?confirmed_edit_profile=YES&email=<?php echo $email; ?>&mobile=<?php echo $mobile; ?>&password=<?php echo $password; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
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
				<h1 class="w3-jumbo w3-text-brown" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Edit Profile</b></h1>
				<hr style="width:50px;border:5px solid black;" class="w3-round">
				<p>This option is used for <font color="red">Edit Controller</font> details for <?php echo $website_title; ?></p>  
				<div class="w3-container" style="margin:0px;padding:0px;width:100%;max-width:700px;">
				
					<form style="margin-top:0px;" action="vt_index.php#edit_profile" method="post">
						<?php
							try
							{
								$stmt=$conn->prepare("select * from vt_controller where controller_id='$_SESSION[controller_id]' ");
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
				
		</div>

		<!-- W3.CSS Container -->
		<div class="w3-black w3-hide-medium w3-hide-small w3-container w3-padding-16 w3-topbar w3-bottombar w3-rightbar w3-leftbar" style="margin-top:75px;padding-right:40px">
			<div class="w3-right">
				<p>Copyright &copy <?php echo Date("Y").' '.$copyright_title; ?></p>
				<p>Website Developed By <a href="<?php echo $developer_link; ?>" target="_blank"><img id="dev_image1" class="w3-image" style="width:20%;max-width:80px;" src="../images/system/<?php echo $developer_logo; ?>"  alt="<?php echo $developer_title; ?>" title="<?php echo $developer_title; ?>"></a></p>
			</div>
		</div>
		
		<div class="w3-black w3-hide-large w3-container w3-padding-16 w3-topbar w3-bottombar w3-rightbar w3-leftbar w3-center" style="margin-top:35px;">
				<p>Copyright &copy <?php echo Date("Y").' '.$copyright_title; ?></p>
				<p>Website Developed By <a href="<?php echo $developer_link; ?>" target="_blank"><img id="dev_image2" class="w3-image" style="width:20%;max-width:80px;" src="../images/system/<?php echo $developer_logo; ?>"  alt="<?php echo $developer_title; ?>" title="<?php echo $developer_title; ?>"></a></p>
		</div>

		<script>
			
			
			//Scroll Back To Top
			window.onscroll = function() {scrollFunction()};
			
			function scrollFunction() {
				if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
					document.getElementById("scroll_btn").style.display = "block";
				} else {
					document.getElementById("scroll_btn").style.display = "none";
				}
			}
		</script>

	</body>
</html>
