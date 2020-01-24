<?php 
	ob_start();
	session_start();
	include("../library/initialize.php"); 
	//Checking  
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
	if(isset($_REQUEST['logout'])) //Log Out 
	{
		unset($_SESSION['admin_email']);
		unset($_SESSION['admin_id']);
		unset($_SESSION['admin_password']);
		header("Location: index.php");
	}
?>	
	<div id="expired" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:99;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
		<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Your site subscription expired !!!</b></p>
	</div>
	
	<div id="today_expired" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:99;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
		<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Your site subscription will expire today !!!</b></p>
	</div>
	
	<div id="will_expired" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:99;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
		<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Your site subscription will expire within <font id="sub_days" class="w3-bold"></font> !!!</b></p>
	</div>
<?php
	$today=get_coupon_date();
	//echo $today.' --- ';
	$date1=date_create($today);
	$stmt = $conn->prepare("select * from subscription order by subscription_id desc "); 
	$stmt->execute();
	$list = $stmt->fetchAll();
	$sub_date=$list[0]['date'];
	$sub_end=$sub_date[6].$sub_date[7].$sub_date[8].$sub_date[9].'-'.$sub_date[0].$sub_date[1].'-'.$sub_date[3].$sub_date[4];
	//echo $sub_end.' --- ';
	$date2=date_create($sub_end);
	$diff=date_diff($date1,$date2);
	$remaining_date=$diff->format("%R%a");
	if($remaining_date<0)
		echo '<script> document.getElementById("expired").style.display="block"; </script>';
	else if($remaining_date>0 && $remaining_date<3)
	{
		$remaining_date=$remaining_date[1]+1;
		echo '<script> document.getElementById("sub_days").innerHTML="'.$remaining_date.' days"; document.getElementById("will_expired").style.display="block"; </script>';
	}
	else if($remaining_date==0)
		echo '<script> document.getElementById("today_expired").style.display="block"; </script>';
		
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $website_title.' Admin'; ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" type="image/png" href="../images/<?php echo $website_logo; ?>">
		<link rel="stylesheet" href="../css/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
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
		.w3-new-text-color{color: #2c3e50;}
	</style>
	
	<body>
	
	
	<div id="main_content">
	
		<!-- Sidebar/menu -->
		<nav class="w3-sidebar w3-flat-midnight-blue w3-collapse w3-top w3-large w3-padding w3-rightbar" style="z-index:3;width:320px;font-weight:bold;" id="mySidebar"><br>
			<span onclick="w3_close()" class="w3-button w3-hide-large w3-display-topright"><i class="fa fa-close"></i></span>
			<div class="w3-container w3-topbar w3-bottombar" style="padding:10px 16px;margin:20px 0px 30px 0px;">
				<a href="ow_index.php" style="padding:0px;margin:0px;"><img class="w3-image" style="" src="../images/<?php echo $website_logo; ?>" alt="<?php echo $website_title; ?>" title="<?php echo $website_title; ?>"></a>
				<h3 style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b><?php echo $website_title.' Admin'; ?></b></h3>
			</div>
			<div class="w3-bar-block w3-medium" style="margin-bottom:50px;">
				<a href="#home" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-home"></i> Home</a> 
				<a href="#opening_time" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-calendar"></i> Opening Time</a> 
				<a href="#home_slides" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-caret-square-o-right"></i> Home Slides</a> 
				<a href="#gallery" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-file-image-o"></i> Gallery</a> 
				<a href="#customers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-group"></i> Customers</a> 
				<a href="#food_menu" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-bookmark-o"></i> Food Menu</a> 
				<a href="#food_items" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-cutlery"></i> Food Items</a>
				<a href="#orders" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-shopping-basket"></i> Orders</a>
				<a href="#offers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-certificate"></i> Offers</a>
				<a href="#promotions" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-ticket"></i> Promotions</a>
				<a href="#edit_profile" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-edit"></i> Edit Profile</a> 
				<a href="ow_index.php?logout=YES" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-border-bottom"><i class="fa fa-sign-out"></i> Log Out</a> 
				
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
			<?php include("lib/home_details.php");  ?>
			
			
			
			<!-- Opening Time Details -->
			<?php include("lib/opening_time.php");  ?>			
			


			<!-- Home Slides Details -->
			<?php include("lib/home_slides.php");  ?>		
			
			
			
			<!-- Gallery Details -->
			<?php include("lib/gallery_details.php");  ?>			
			
			
			
			<!-- Customer Details -->
			<?php include("lib/customers.php");  ?>			
			
			
			<!-- Food Menu -->
			<?php include("lib/food_menu.php");  ?>			
			
			
			
			<!-- Food Item -->
			<?php include("lib/food_item.php");  ?>			
			
		
		
			<!-- Promotions -->
			<?php include("lib/orders.php");  ?>
		

			<!-- Promotions -->
			<?php include("lib/offers.php");  ?>			
			
		
			
			<!-- Promotions -->
			<?php include("lib/promotions.php");  ?>			
			
			
			
			<!-- Edit Profile Details -->
			<?php include("lib/edit_profile.php");  ?>
		
		
		
		</div>
		
		<!-- W3.CSS Container -->
		<div class="w3-black w3-hide-medium w3-hide-small w3-container w3-padding-16 w3-topbar w3-bottombar w3-rightbar w3-leftbar" style="margin-top:75px;padding-right:40px">
			<div class="w3-right">
				<p>Copyright &copy <?php echo Date("Y").' '.$copyright_title; ?></p>
				<p>Website Developed By <a href="<?php echo $developer_link; ?>" target="_blank"><img class="w3-image" style="width:20%;max-width:80px;" src="../images/system/<?php echo $developer_logo; ?>"  alt="<?php echo $developer_title; ?>" title="<?php echo $developer_title; ?>"></a></p>
			</div>
		</div>
		
		<div class="w3-black w3-hide-large w3-container w3-padding-16 w3-topbar w3-bottombar w3-rightbar w3-leftbar w3-center" style="margin-top:35px;">
				<p>Copyright &copy <?php echo Date("Y").' '.$copyright_title; ?></p>
				<p>Website Developed By <a href="<?php echo $developer_link; ?>" target="_blank"><img class="w3-image" style="width:20%;max-width:80px;" src="../images/system/<?php echo $developer_logo; ?>"  alt="<?php echo $developer_title; ?>" title="<?php echo $developer_title; ?>"></a></p>
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

		
	</div>	
		
	</body>
</html>
		