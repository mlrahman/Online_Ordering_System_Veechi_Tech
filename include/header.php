<!DOCTYPE html>
<?php
	ob_start();
	include("library/initialize.php");
?>
<html>
<head>
<title><?php echo $website_title; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/<?php echo $website_logo; ?>">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="js/main.js"></script>
<script src="js/zenscroll-min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
	$( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+1M" });
});

</script>
</head>
<script src="js/jquery.timepicker.min.js"></script>
<body>
	<div class="w3-container w3-display-container" style="padding:0px;width:100%;margin:-22px 0px 0px 0px;background-image: url('images/<?php echo $backend_image; ?>');background-repeat: repeat;background-attachment: fixed;top:0;">
		<!-- Navbar (sit on top) -->
		<div class="w3-container" style="padding:0px;margin:0px;">
		
		  <div class="w3-bar w3-light-gray w3-card " id="myNavbar">
			<a href="index.php" class=""><img class="w3-image w3-padding-small" style="width:17%;min-width:100px;" src="images/<?php echo $website_logo; ?>" alt="<?php echo $website_title; ?>" title="<?php echo $website_title; ?>"></a>
		
		
		
		<!-- Reservations Modal -->
		<div id="reservation" class="w3-modal" style="z-index:99999999;">
			<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
				
				<div class="w3-container"><br>
					<span onclick="document.getElementById('reservation').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
					<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Reservation</h2>
				</div>
				
				
				<form method="post" style="margin:0px;padding:0px;">
					<div class="w3-container w3-border w3-padding w3-margin-bottom w3-light-gray" style="margin:0px;">
						
						<div class="w3-row" style="margin:0px;padding:0px;">
							<div class="w3-col" style="width:49%;">
								<input class="w3-input w3-border" type="text" placeholder="First Name *" name="first_name" value="<?php if(isset($_SESSION['logged_in'])){ echo $_SESSION['customer_first_name']; }  ?>" maxlength="20" required>
							</div>
							<div class="w3-col" style="margin-left:2%;width:49%;">
								<input class="w3-input w3-border" type="text" placeholder="Last Name *" name="last_name" value="<?php if(isset($_SESSION['logged_in'])){ echo $_SESSION['customer_last_name']; } ?>"  maxlength="20" required>
							</div>
						</div>
						
						<?php
							if(isset($_SESSION['logged_in']))
							{
								$stmty = $conn->prepare("select * from customer where customer_id='$_SESSION[customer_id]' order by customer_id asc "); 
								$stmty->execute();
								$listy = $stmty->fetchAll();
							
							}
						?>
						
						<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
							<div class="w3-col" style="width:30%;">
								<input class="w3-input w3-border w3-center" type="text" value="UK (+44)" disabled>
							</div>
							<div class="w3-col" style="margin-left:2%;width:68%;">
								<input class="w3-input w3-border" type="text"  maxlength="11"  placeholder="Mobile Number (11 digits) * " value="<?php if(isset($_SESSION['logged_in'])){ echo $listy[0]['mobile']; } ?>" name="mobile" id="reservation_mobile" required>
							</div>
						</div>
						
						<input class="w3-input w3-border" type="text" placeholder="Telephone Number"  maxlength="15" value="<?php if(isset($_SESSION['logged_in'])){ echo $listy[0]['telephone']; } ?>"  name="telephone" style="margin:8px 0px 0px 0px;">
						
						<input class="w3-input w3-border" type="email" placeholder="Your Email Address *" value="<?php if(isset($_SESSION['logged_in'])){ echo $_SESSION['customer_email']; } ?>" name="email" style="margin:8px 0px 0px 0px;" required />
						
						<input class="w3-input w3-border" type="text" id="datepicker" placeholder="Reservation Date (MM/DD/YYYY) *" name="reserve_date" style="margin:8px 0px 0px 0px;" required />
						
						<input class="w3-input w3-border timepicker" placeholder="Reservation Time (HH:MM AM/PM) *" name="reserve_time" style="margin:8px 0px 0px 0px;" required />
						<script>
						$(document).ready(function(){
							$('input.timepicker').timepicker({
								timeFormat: 'HH:mm p',
								dropdown: true,
								scrollbar: true							
								});
						});
						</script>
						
						<input class="w3-input w3-border" type="number" placeholder="Number of Guest *" name="reserve_guest" style="margin:8px 0px 0px 0px;" required>
						
						<input class="w3-input w3-border" type="text" placeholder="Special Request" name="reserve_request" style="margin:8px 0px 0px 0px;">
						
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
								<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha"  required>
							</div>
						</div>
						
						<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 5px 0px;" name="reserve_table" value="reserve"><i class="fa fa-book"></i> Submit Request</button>
						
						<script>
							var reservation_mobile = document.getElementById("reservation_mobile");
							function reservation_validateMobile(){
							  
							  //console.log(mobile.value.length);
							  if(reservation_mobile.value.length != 11) {
								reservation_mobile.setCustomValidity("Please Enter Valid Mobile Number (11 digits).");
							  } else {
								reservation_mobile.setCustomValidity('');
							  }
							}
							reservation_mobile.onchange=reservation_validateMobile;
							
							var reservation_captcha = document.getElementById("captcha");
							var sol=<?php echo $c; ?>;
							function reservation_captcha_val(){
							  
							  //console.log(reservation_captcha.value);
							  //console.log(sol);
							  if(reservation_captcha.value != sol) {
								reservation_captcha.setCustomValidity("Please Enter Valid Answer.");
							  } else {
								reservation_captcha.setCustomValidity('');
							  }
							}
							reservation_captcha.onchange=reservation_captcha_val;
						</script>
					</div>
				</form>
				
			</div>
		</div>
		
		
		
		<div id="reserve_request" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
			<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Thanks. Reservation Request Submitted Successfully.</b></p>
		</div>
		<script>
			function stop_reserve_request()
			{
				document.getElementById('reserve_request').style.display='none';
			}
		</script>
		
		<?php
			
			if(isset($_SESSION['reserve_request']))
			{
				echo '<script>document.getElementById("reserve_request").style.display="block"; setTimeout(stop_reserve_request,2500);</script>';				
				unset($_SESSION['reserve_request']);
			}
			
			//Reservation Request Received
			if(isset($_POST['reserve_table']))
			{
				
				$first_name=trim($_POST['first_name']);
				$last_name=trim($_POST['last_name']);
				$name=$first_name.' '.$last_name;
				$mobile=trim($_POST['mobile']);
				$telephone=trim($_POST['telephone']);
				$email=trim($_POST['email']);
				$date=trim($_POST['reserve_date']);
				$time=trim($_POST['reserve_time']);
				$p_number=trim($_POST['reserve_guest']);
				$special=trim($_POST['reserve_request']);
				
				$_SESSION['reserve_request']='YES';
				
				//Email Portion
				$subject="Reservation Request";
				$to=$website_email;
				$from=$email;
				
				$message = '<html><body>';
				$message .= '<h1>Reservation Request - '.$website_title.'</h1><p>  </p>';
				$message .= '<p>Reservation Request Details:</p>';
				$message .= '<table width="1000" border="0" cellpadding="0" cellspacing="0" vspace="0" hspace="0" align="LEFT">
								<tbody>
									<tr>
										<td style="padding:4px 0px;"><b>First Name</b></td>
										<td>: '.$first_name.'</td>
									</tr>
									<tr>
										<td style="padding:4px 0px;"><b>Last Name</b></td>
										<td>: '.$last_name.'</td>
									</tr>
									<tr>
										<td style="padding:4px 0px;"><b>Mobile</b> </td>
										<td>: '.$mobile.'</td>
									</tr>
									<tr>
										<td style="padding:4px 0px;"><b>Telephone</b> </td>
										<td>: '.$telephone.'</td>
									</tr>
									<tr>
										<td style="padding:4px 0px;"><b>Email</b></td>
										<td>: '.$email.'</td>
									</tr>
									<tr style="color:red;">
										<td style="padding:4px 0px;"><b>Reservation Date</b></td>
										<td>: '.$date.'</td>
									</tr>
									<tr style="color:red;">
										<td style="padding:4px 0px;"><b>Reservation Time</b></td>
										<td>: '.$time.'</td>
									</tr>
									<tr style="color:green;">
										<td style="padding:4px 0px;"><b>Number of People</b></td>
										<td>: '.$p_number.'</td>
									</tr>
									<tr style="">
										<td valign="top" style="padding:4px 0px;"><b>Special Requirements</b></td>
										<td>: '.$special.'</td>
									</tr>
								</tbody>
							</table></body></html>';
				
				sent_mail_personal($to,$from,$name,$subject,$message);
				
			}
			
			if(isset($_SESSION['reserve_request']))
			{
				header("Location: ".$website_url.$_SERVER['REQUEST_URI']);
			}
		?>


		
		<!-- The Modal -->
		<div id="subscription_over" class="w3-modal">
			<div class="w3-modal-content w3-animate-top w3-card-4">
				<header class="w3-container w3-pale-red w3-bottombar w3-topbar"> 
					<h2 class="w3-bold"><i class="fa fa-bell-slash"> Subscription Expired</i></h2>
				</header>
				<div class="w3-container">
					<p class="w3-large w3-text-black w3-bold">Dear valuable customer, We are sorry for this inconvenience. Our service is not available right now. But very soon it will active. Please stay in touch.</p>
					<p class="w3-text-black w3-large w3-bold">Thanks</br><?php echo $website_title.' Authority'; ?></p>
				</div>
				<footer class="w3-container w3-pale-red w3-topbar w3-bottombar">
					&nbsp
				</footer>
			</div>
		</div>
		<?php
			
			
			//subscription check
			try
			{
				$stmt = $conn->prepare("select * from subscription order by subscription_id desc "); 
				$stmt->execute();
				$list = $stmt->fetchAll();
				$today=get_coupon_date();
				//echo $today.' --- ';
				$today=strtotime($today);
				//echo $today.' --- End of Today ----';
				$sub_date=$list[0]['date'];
				//echo $sub_date.' --- ';
				$sub_end=$sub_date[6].$sub_date[7].$sub_date[8].$sub_date[9].'-'.$sub_date[0].$sub_date[1].'-'.$sub_date[3].$sub_date[4];
				//echo $sub_end.' --- ';
				$sub_end=strtotime($sub_end);
				//echo $sub_end.' --- ';
				if($today>$sub_end)
				{
					echo '<script> document.getElementById("subscription_over").style.display="block"; console.log("'.$sub_end.'"); </script>';
				}
			
			}catch(PDOException $e)
			{
				echo 'Error: '.$e->getMessage();
			}
			
		?>
		
		 