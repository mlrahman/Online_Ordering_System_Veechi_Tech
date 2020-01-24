<?php
	include("include/header.php");
?>
<a id="home" style="padding:0px;margin:0px;"></a>			
<!-- Back to top --> 
<a href="#home" id="scroll_btn" style="display:none;position:fixed;z-index:999;bottom:47px;right:15px;text-decoration:none;" class="w3-button w3-round-large w3-black w3-padding-small w3-hover-gray w3-border w3-border-white"><i class="fa fa-arrow-up"></i></a>	  
<!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small w3-hide-medium">
		<h3 style="text-align:right;font-family: Times New Roman, Times, serif;margin:10px 10px 0px 0px;padding:0px;"><?php echo $telephone; ?></h3>
		<div>
		  <a href="#home" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
		  <a href="#about" class="w3-bar-item w3-button"><i class="fa fa-info"></i> ABOUT US</a>
		  <a href="order_online.php" class="w3-bar-item w3-button"><i class="fa fa-shopping-cart"></i> ORDER ONLINE</a>
		  <a onclick="document.getElementById('reservation').style.display='block';" class="w3-bar-item w3-button"><i class="fa fa-th"></i> RESERVATION</a>
		  <a href="#gallery" class="w3-bar-item w3-button"><i class="fa fa-photo"></i> GALLERY</a>
		  <a href="#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT US</a>
		</div>
	</div> 
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
	
	<div class="w3-right w3-hide-large" style="padding: 4px 0px 0px 0px;">
		<h6 class="w3-bar-item w3-hide-medium" style="font-family: Times New Roman, Times, serif;margin:0px;padding:6px 0px 0px 0px;"><?php echo $telephone; ?></h6>
		<h2 class="w3-bar-item w3-hide-small" style="font-family: Times New Roman, Times, serif;margin:0px;padding:0px 0px 0px 0px;"><?php echo $telephone; ?></h2>
		<a href="javascript:void(0)" class="w3-bar-item" style="" onclick="w3_open()">
		   <i class="w3-large w3-hide-medium fa fa-bars"></i>
		   <i class="w3-xxlarge w3-hide-small fa fa-bars"></i>
		</a>
	</div>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-large" style="display:none" id="mySidebar">
  <span onclick="w3_close()" class="w3-button w3-display-topright"><i class="fa fa-close"></i></span>
  <a href="#home" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
  <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-info"></i> ABOUT US</a>
  <a href="order_online.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-shopping-cart"></i> ORDER ONLINE</a>
  <a onclick="document.getElementById('reservation').style.display='block';w3_close();" class="w3-bar-item w3-button"><i class="fa fa-th"></i> RESERVATION</a>
  <a href="#gallery" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-photo"></i> GALLERY</a>
  <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT US</a>
</nav>


<script>
	
	// Toggle between showing and hiding the sidebar when clicking the menu icon
	var mySidebar = document.getElementById("mySidebar");

	function w3_open() {
		if (mySidebar.style.display === 'block') {
			mySidebar.style.display = 'none';
		} else {
			mySidebar.style.display = 'block';
		}
	}

	// Close the sidebar with the close button
	function w3_close() {
		mySidebar.style.display = "none";
	}

</script>


<!-- clear -->
<div class="w3-container w3-margin" style="margin:3% 0px 0px 0px;">

</div>


<!--Home Slides -->
<?php
	$hs_fl=0;
	try
	{
		$stmt = $conn->prepare("select * from home_slides where status='active' order by slide_id asc ");
		$stmt->execute();
		$list = $stmt->fetchAll();
		if(count($list)>0)
			$hs_fl=1;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	if($hs_fl==1)
	{
?>
<div class="w3-container w3-display-container" style="padding:0px;">
	<div style="width:96%;max-height:450px;margin:0 auto;padding:0px;overflow:hidden;" class="w3-container w3-display-container w3-light-gray w3-border w3-border-shadow w3-round">
		<?php include("include/slides.php"); ?>
	</div>
</div>
<?php
	}
?>

<!--clear -->
<div class="w3-container w3-margin" id="about">

</div>


<!-- About Section -->
<div class="w3-container w3-light-gray w3-round w3-border w3-border-shadow" style="padding:30px 16px 30px 16px; width:96%;margin:0 auto;">
  <h2 class="w3-center w3-bold">ABOUT US</h2>
  <p class="w3-center w3-large">Key features of our company</p>
  <div class="w3-row-padding w3-center" style="margin-top:64px">
    <div class="w3-quarter">
      <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">Responsive</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Passion</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Design</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Support</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
  </div>
</div>


<!--clear -->
<div class="w3-container w3-margin" id="gallery">
	
</div>



<!-- gallery Section -->
<?php
	$gl_fl=0;
	try
	{
		$stmt = $conn->prepare("select * from gallery where status='active' order by image_id asc ");
		$stmt->execute();
		$list = $stmt->fetchAll();
		if(count($list)>0)
			$gl_fl=1;
	}
	catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	if($gl_fl==1)
	{
?>
<div id="gallery1" class="w3-container w3-center w3-light-gray w3-round w3-border w3-border-shadow" style="padding:30px 16px 30px 16px; width:96%;margin:0 auto;">
  <h2 class="w3-center w3-bold">Gallery</h2>
  <div id="gallery2" style="overflow:hidden;width:100%;height:250px;padding:14px 0px 0px 0px;">
	  <div id="gallery3" onmouseover="stop_slide()" onmouseout="start_slide()" style="position: relative;white-space: nowrap;overflow-x: auto;height:280px;width:100%;padding:0px 20px 0px 20px;">
		  <?php
			include("include/gallery.php"); 
		  ?>
	  </div>
  </div>
</div>
<?php
	}
?>


<!--Clear -->
<div class="w3-container w3-margin"  id="contact">

</div>

<!-- Contact Section -->
<div id="contact_us_request" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Thanks for your message. We will reply you soon.</b></p>
</div>
<script>
	function stop_contact_us_request()
	{
		document.getElementById('contact_us_request').style.display='none';
	}
</script>
<?php
	if(isset($_SESSION['contact_us_request']))
	{
		echo '<script>document.getElementById("contact_us_request").style.display="block"; setTimeout(stop_contact_us_request,2500);</script>';				
		unset($_SESSION['contact_us_request']);
	}
	
	if(isset($_REQUEST['contact_msg']))
	{
		$name=trim($_REQUEST['Name']);
		$email=trim($_REQUEST['Email']);
		$subject=trim($_REQUEST['Subject']);
		$msg=trim($_REQUEST['Message']);

		$to=$website_email;
		$from=$email;
		
		$message = '<html><body>';
		$message .= '<h1>Contact Us Feedback - '.$website_title.'</h1><p>  </p>';
		$message .= '<p><b>Message Details:</b></p>';
		$message .= '<p>'.$msg.'</p></body></html>';
		
		sent_mail_personal($to,$from,$name,$subject,$message);
		
		$_SESSION['contact_us_request']='YES';
		
	}
	if(isset($_SESSION['contact_us_request']))
	{
		header("Location: index.php");
	}

?>
<div class="w3-container w3-light-grey w3-round w3-border w3-border-shadow" style="padding:30px 16px 30px 16px; width:96%;margin:0 auto;">
	<h2 class="w3-center w3-bold">CONTACT US</h2>
	<p class="w3-center w3-large"><?php echo $contact_us_msg; ?></p>
	<div class="w3-row-padding" style="margin-top:64px">
		<div class="w3-half">
			<p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> <?php echo $contact_us_address; ?></p>
			<p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Phone: <?php echo $contact_us_phone; ?></p>
			<p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: <?php echo $contact_us_email; ?></p>
			<br>
			<form action="index.php#contact" method="post">
				<p><input class="w3-input w3-border" type="text" placeholder="Your Name" required name="Name" maxlength="35"></p>
				<p><input class="w3-input w3-border" type="email" placeholder="Your Email" required name="Email"></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Your Subject" required name="Subject" maxlength="60"></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Your Message" required name="Message"></p>
				<p>
					<button class="w3-button w3-black" type="submit" name="contact_msg">
						<i class="fa fa-paper-plane"></i> SEND MESSAGE
					</button>
				</p>
			</form>
		</div>
		<div class="w3-half">
			<!-- Add Google Maps -->
			<div class="w3-hide-medium w3-hide-large" style="margin-top:30px;"></div>
			<div id="googleMap" class="w3-border w3-topbar w3-bottombar w3-leftbar w3-rightbar w3-border-black w3-round-xxlarge" style="width:100%;height:510px;"></div>
		</div>
		
	</div>
</div>

<script>
//Google Map API
	function myMap()
	{
	  myCenter=new google.maps.LatLng(<?php echo $contact_us_lat; ?>, <?php echo $contact_us_lng; ?>);
	  var mapOptions= {
		center:myCenter,
		zoom:<?php echo $map_zoom; ?>, scrollwheel: false, draggable: false,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

	  var marker = new google.maps.Marker({
		position: myCenter,
	  });
	  marker.setMap(map);
	}
</script>
	<!-- Add Google Maps -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlE7JzatxSvdryDG7nE7Pun6FyrfW9Xw8&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

<?php
	include("include/footer.php");
?>
