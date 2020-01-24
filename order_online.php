<?php
	include("include/header.php"); 
?>
<script>
	order_online_active=1;
</script>

<a id="order_online" style="padding:0px;margin:0px;"></a>

<!-- Mobile Items Menu -->
<div id="scroll_menu_show" style="display:none;position:fixed;z-index:9999;top:0px;left:0px;padding:0px;" class="w3-bar w3-card w3-animate-top w3-light-gray w3-hide-large">
	<div class="w3-container w3-left w3-bold w3-medium">
		<h2 id="menu_text" class="w3-medium w3-bold w3-animate-top" id="food_menu_text"></h2>
	</div>
	<div class="w3-container w3-right" style="padding:0px;">
		<a href="javascript:void(0)" class="w3-bar-item" style="" onclick="food_menu_open()">
		   <i class="w3-xlarge fa fa-bars"></i>
		</a>
	</div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-large w3-small" style="display:none" id="menuSidebar">
		<span onclick="food_menu_close()" class="w3-button w3-display-topright"><i class="fa fa-close"></i></span>	
		<?php
			try
			{
				$stmt = $conn->prepare("select * from food_category where status='active' order by category_id asc ");
				$stmt->execute();
				$list = $stmt->fetchAll(); 
				foreach($list as $row)
				{
		?>
			  <a href="#mo<?php echo $row['category_id']; ?>" onclick="food_menu_close()" class="w3-bar-item w3-button"><i class="fa fa-arrow-right"></i> <?php echo $row['category_name']; ?></a>
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		?>	
</nav>  	

<!-- Back to top -->
<a href="#order_online" id="scroll_btn" style="display:none;position:fixed;z-index:999;bottom:47px;right:15px;text-decoration:none;" class="w3-button w3-round-large w3-black w3-padding-small w3-hover-gray w3-border w3-border-white"><i class="fa fa-arrow-up"></i></a>	  

<!-- Right-sided navbar links --> 
    <div class="w3-right w3-hide-small w3-hide-medium">
		<h3 style="text-align:right;font-family: Times New Roman, Times, serif;margin:10px 10px 0px 0px;padding:0px;"><?php echo $telephone; ?></h3>
		<div>
		  <a href="index.php?#home" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
		  <a href="index.php?#about" class="w3-bar-item w3-button"><i class="fa fa-info"></i> ABOUT US</a>
		  <a href="#order_online" class="w3-bar-item w3-button"><i class="fa fa-shopping-cart"></i> ORDER ONLINE</a>
		  
		  <a onclick="document.getElementById('reservation').style.display='block';" class="w3-bar-item w3-button"><i class="fa fa-th"></i> RESERVATION</a>
		  
		  <a href="index.php?#gallery" class="w3-bar-item w3-button"><i class="fa fa-photo"></i> GALLERY</a>
		  <a href="index.php?#contact" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT US</a>
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
  <a href="index.php?#home" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-home"></i> HOME</a>
  <a href="index.php?#about" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-info"></i> ABOUT US</a>
  <a href="#order_online" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-shopping-cart"></i> ORDER ONLINE</a>
  
  <a onclick="document.getElementById('reservation').style.display='block';w3_close();" class="w3-bar-item w3-button"><i class="fa fa-th"></i> RESERVATION</a>
  
  <a href="index.php?#gallery" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-photo"></i> GALLERY</a>
  <a href="index.php?#contact" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> CONTACT US</a>
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


<!-- Sign Up Message or Notification -->
<div id="account_confirm" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i>Account Confirmed Successfully</b></p>
</div>
<div id="account_confirm_already" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i>Account Already Confirmed</b></p>
</div>
<div id="signup_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Sign Up Successful. <b>Please check your email for confirm account</b></p>
</div>
<div id="signup_notification_invalid" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Email or Mobile already in use</p>
</div>

<!-- Forgot password-->
<div id="forgot_password_request" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Thanks. Please Check Your Email.</b></p>
</div>
<div id="password_changed" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congrats. Password updated successfully.</b></p>
</div>
<div id="forgot_password_request2" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Sorry. Invalid Email Address.</b></p>
</div>
<div id="invalid_recover" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Sorry. The Recovery Link Expired.</b></p>
</div>

<div id="on_progress" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999999999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Please wait for complete the current process.</b></p>
</div>

<div id="error_occured" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999999999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Sorry some error occured with your data.</b></p>
</div>

<div id="updated" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999999999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congrats. Profile Updated Successfully.</b></p>
</div>

<script>
	function stop_forgot_password_request()
	{
		document.getElementById('forgot_password_request').style.display='none';
		document.getElementById('forgot_password_request2').style.display='none';
		document.getElementById('invalid_recover').style.display='none';
		document.getElementById('password_changed').style.display='none';
		document.getElementById('error_occured').style.display='none';
		
	}
	function stop_on_progress()
	{
		document.getElementById('on_progress').style.display='none';
		document.getElementById('updated').style.display='none';
	}
</script>

<!-- Sign In message -->
<div id="pls_sign_in" class="w3-bar w3-red w3-animate-opacity" style="position:fixed;z-index:9999999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Please Sign In for Checkout Process</b></p>
</div>

<!-- Card payment successfull -->
<div id="card_paid_msg" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congrats!! Your order placed successful.</b></p>
</div>

<!-- Paypal payment successfull -->
<div id="paypal_paid_msg" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congrats!! Your order placed successful.</b></p>
</div>

<script>
	function stop_payment_msg()
	{
		document.getElementById('card_paid_msg').style.display='none';
		document.getElementById('paypal_paid_msg').style.display='none';
	}

	function stop_pls_sign_in()
	{
		document.getElementById('pls_sign_in').style.display='none';
	}

	function stop_signup()
	{
		document.getElementById('signup_notification').style.display='none';
		document.getElementById('account_confirm').style.display='none';
		document.getElementById('account_confirm_already').style.display='none';
		document.getElementById('signup_notification_invalid').style.display='none';
	}
</script>
<?php
	
	//current link check
	//echo '<script>console.log("'.$website_url.$_SERVER['REQUEST_URI'].'");</script>';
	$sign_in_flag=0; //not requested
	//Sign In goes here
	if(isset($_REQUEST['sign_in']))
	{
		$sign_in_flag=1; //requested
		$customer_email=trim($_REQUEST['customer_email']);
		$customer_password=sha1(trim($_REQUEST['customer_password']));
		//check by js
		//echo '<script>console.log("'.$customer_email.'");</script>';
		//echo '<script>console.log("'.$customer_password.'");</script>';
		try
		{
			$stmt = $conn->prepare("select * from customer where email=:customer_email and password=:customer_password order by customer_id asc "); 
			$stmt->execute(array('customer_email' => $customer_email, 'customer_password' => $customer_password ));
			$list = $stmt->fetchAll();
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		if(count($list)>0) //Account Available logged in pls
		{
			$sign_in_flag=2; //account available
			//check by js
			//echo '<script>console.log("okok'.$list[0]['status'].'");</script>';
			if($list[0]['status']=='active' && $list[0]['block_status']==0) //Account Active
			{
				//Storing information in Session
				$_SESSION['logged_in']='YES';
				$_SESSION['customer_id']=$list[0]['customer_id'];
				$_SESSION['customer_email']=$list[0]['email'];
				$_SESSION['customer_image']=$list[0]['image'];
				$_SESSION['customer_first_name']=$list[0]['first_name'];
				$_SESSION['customer_last_name']=$list[0]['last_name'];
			
			
				//If login successful
				if(!empty($_REQUEST["remember"])) {
					setcookie ("member_login",$_REQUEST["customer_email"],time()+ (10 * 365 * 24 * 60 * 60));
					setcookie ("member_password",$_REQUEST["customer_password"],time()+ (10 * 365 * 24 * 60 * 60));
				} else {
					if(isset($_COOKIE["member_login"])) {
						setcookie ("member_login","");
					}
					if(isset($_COOKIE["member_password"])) {
						setcookie ("member_password","");
					}
				}
				header("Location: order_online.php");
				
			}
			else if($list[0]['status']=='inactive' && $list[0]['block_status']==0) //Account Inactive
			{
				$sign_in_flag=3; //account inactive
				//Send email for verification
				//set up sender
				$email=$list[0]['email'];
				//set up subject
				$subject="Confirm Your Account";
				//Retreiving ID
				$id=sha1($list[0]['customer_id']).'-'.$website_title; 
				//set up message
				$message = '<html><body>';
				$message .= '<h1>Confirm Your Account - '.$website_title.'</h1><p>  </p>';
				$message .= '<p>Dear valuable customer,</p>';
				$message .= '<p>Thanks for Sign Up in '.$website_title.'. Please confirm your account by clicking the following button.<p>  </p> Thanks.</p>'.$website_title.'<p>  </p><p>  </p>';
				$message .= '<div style="width:100%;">';
				$message .= '<a style="border-radius:5px;padding: 16px 32px;text-align: center;font-size: 16px;margin: 4px 2px;opacity: 1.0;transition: 0.3s;display: inline-block;text-decoration: none;cursor: pointer;color:#fff!important;background-color:#009688!important" href="'.$website_url.$_SERVER['REQUEST_URI'].'?account_confirm=YES&link='.$id.'">Confirm Your Account</a>';
				$message .= '</div></body></html>';
				sent_mail($email,$subject,$message);
			}
			else
			{
				$sign_in_flag=5; //account blocked
			}
		}
		else //Account Not Available invalid
		{
			$sign_in_flag=4; //invalid request
		}
	}
	
	
	//Sign Up goes here
	if(isset($_REQUEST['sign_up']))
	{
		$first_name=trim($_REQUEST['first_name']);
		$last_name=trim($_REQUEST['last_name']);
		$mobile=trim($_REQUEST['mobile']);
		$telephone=trim($_REQUEST['telephone']);
		$email=trim($_REQUEST['email']);
		$password=sha1(trim($_REQUEST['password']));
		$address=trim($_REQUEST['address']);
		$post_code=trim($_REQUEST['post_code']);
		$join_date=get_date();
		try
		{
			$stmt2 = $conn->prepare("select * from customer where email=:email or mobile=:mobile order by customer_id asc "); 
			$stmt2->execute(array('email'=>$email, 'mobile'=>$mobile));
			$list2 = $stmt2->fetchAll(); 
			if(count($list2)>0) //ID already in use
			{
				echo '<script>document.getElementById("signup_notification_invalid").style.display="block"; setTimeout(stop_signup,2000);</script>';
			}
			else
			{
				$stmt = $conn->prepare("insert into customer(first_name,last_name,mobile,telephone,email,password,address,post_code,date,status) VALUES(?,?,?,?,?,?,?,?,?,'inactive')");
				$stmt->execute([$first_name,$last_name,$mobile,$telephone,$email,$password,$address,$post_code,$join_date]);
				
				//Send email for verification
				//set up subject
				$subject="Confirm Your Account";
				//Retreiving ID
				$stmt3 = $conn->prepare("select * from customer where email=:email and mobile=:mobile order by customer_id asc "); 
				$stmt3->execute(array('email'=>$email, 'mobile'=>$mobile));
				$list3 = $stmt3->fetchAll();
				foreach($list3 as $row2)
				{
					$id=sha1($row2['customer_id']).'-'.$website_title; 
				}
				//set up message
				$message = '<html><body>';
				$message .= '<h1>Confirm Your Account - '.$website_title.'</h1><p>  </p>';
				$message .= '<p>Dear valuable customer,</p>';
				$message .= '<p>Thanks for Sign Up in '.$website_title.'. Please confirm your account by clicking the following button.<p>  </p> Thanks.</p>'.$website_title.'<p>  </p><p>  </p>';
				$message .= '<div style="width:100%;">';
				$message .= '<a style="border-radius:5px;padding: 16px 32px;text-align: center;font-size: 16px;margin: 4px 2px;opacity: 1.0;transition: 0.3s;display: inline-block;text-decoration: none;cursor: pointer;color:#fff!important;background-color:#009688!important" href="'.$website_url.$_SERVER['REQUEST_URI'].'?account_confirm=YES&link='.$id.'">Confirm Your Account</a>';
				$message .= '</div></body></html>';
				sent_mail($email,$subject,$message);
				
				
				echo '<script>document.getElementById("signup_notification").style.display="block"; setTimeout(stop_signup,2500);</script>';
			}
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
	
	//Account confirm from mail link
	if(isset($_REQUEST['account_confirm']))
	{
		$link=$_REQUEST['link'];
		$id="";
		for($i=0;$i<strlen($link);$i++)
		{
			if($link[$i]=='-')
				break;
			$id .= $link[$i];
		}
		//echo '<script>console.log("'.$id.'");</script>';
		$stmt3 = $conn->prepare("select * from customer order by customer_id asc "); 
		$stmt3->execute();
		$list3 = $stmt3->fetchAll();
		$f=0;
		foreach($list3 as $row2)
		{
			if(sha1($row2['customer_id'])==$id && $row2['status']=='inactive')
			{
				$f=1;
				$stmt = $conn->prepare("update customer set status='active' where customer_id='$row2[customer_id]' ");
				$stmt->execute();
				echo '<script>document.getElementById("account_confirm").style.display="block"; setTimeout(stop_signup,2500);</script>';
				break;
			}
		}
		if($f==0)
		{
			echo '<script>document.getElementById("account_confirm_already").style.display="block"; setTimeout(stop_signup,2500);</script>';
		}
	}
	
?>

<!-- Password Change modal -->
<?php
	if(isset($_SESSION['password_changed']))
	{
		echo '<script>document.getElementById("password_changed").style.display="block"; setTimeout(stop_forgot_password_request,2500);</script>';				
		unset($_SESSION['password_changed']);
	}


	if(isset($_REQUEST['change_password']))
	{
		//Update new pass
		$customer_id=$_REQUEST['customer_id'];
		$password=trim($_REQUEST['password']);
		$password=sha1($password);
		
		$stmtzz = $conn->prepare(" update customer set password=:password where customer_id='$customer_id' "); 
		$stmtzz->execute(array('password'=>$password));
		
		$_SESSION['password_changed']='YES';
		
		header("Location: order_online.php");
	}
	if(isset($_REQUEST['recover']) && isset($_REQUEST['link']) && isset($_REQUEST['email']) && isset($_REQUEST['c_id']))
	{
		$flag2=0;
		
		$stmtz = $conn->prepare("select * from customer where email=:email order by customer_id asc "); 
		$stmtz->execute(array('email'=>$_REQUEST['email']));
		$listz = $stmtz->fetchAll();
		if(sha1($listz[0]['customer_id'])==$_REQUEST['c_id'] && $listz[0]['recover_link']==$_REQUEST['link'])
		{
			$id=$listz[0]['customer_id'];
			$link=rand(111111,999999);
			$link=$link.date("d-m-Y");
			$link=sha1($link);
			
			//Update sql of customer with recover link
			$stmtzz = $conn->prepare(" update customer set recover_link='$link' where customer_id='$id' "); 
			$stmtzz->execute();
			$flag2=1;
		}
		
		
		if($flag2==1) //Valid Recover Request
		{
?>

			<div id="recover_password" class="w3-modal" style="z-index:99999999;">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px;font-family:Arial;">
					
					<div class="w3-container"><br>
						<span onclick="document.getElementById('recover_password').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
						<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Change Password</h2>
					</div>
					
					<form class="w3-container w3-border w3-padding" style="margin:0px 0px 20px 15px;" action="order_online.php" method="post">
						
						<input class="w3-input w3-border" type="email" placeholder="Your Email Address *" value="<?php echo $_REQUEST['email']; ?>" name="email" style="margin:8px 0px 0px 0px;" disabled/>
						
						<input type="hidden" name="customer_id" value="<?php echo $id; ?>">
						
						<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
							<div class="w3-col" style="width:49%;">
								<input class="w3-input w3-border" type="password" placeholder="Password *" id="create_password" name="password" maxlength="30" pattern=".{6,}" required>
							</div>
							<div class="w3-col" style="margin-left:2%;width:49%;">
								<input class="w3-input w3-border" type="password" placeholder="Re-type Password *" id="create_confirm_password" maxlength="30" name="repassword" pattern=".{6,}" required>
							</div>
						</div>
						
						<?php 
							//spam Check 
							$aaa=rand(1,20);
							$bbb=rand(1,20);
							$ccc=$aaa+$bbb;
						?>
						
						<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
							<div class="w3-col" style="width:40%;">
								<input class="w3-input w3-border w3-center" type="text" value="<?php echo $aaa.' + '.$bbb.' = '; ?>" disabled>
							</div>
							<div class="w3-col" style="margin-left:2%;width:58%;">
								<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha4"  required>
							</div>
						</div>
						
						<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 5px 0px;" name="change_password"><i class="fa fa-send"></i> Save Changes</button>
						
					</form>
					<div class="w3-container">
						&nbsp
					</div>
				</div>
			</div>
			<script>				
				
				//Show recover form
				document.getElementById('recover_password').style.display='block';
				
				//Password Validity check
				var password5 = document.getElementById("create_password"), confirm_password5 = document.getElementById("create_confirm_password");

				function validatePassword5(){
				  if(password5.value != confirm_password5.value) {
					confirm_password5.setCustomValidity("Passwords Don't Match");
				  } else {
					confirm_password5.setCustomValidity('');
				  }
				}

				password5.onchange = validatePassword5;
				confirm_password5.onkeyup = validatePassword5;
			
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

<?php
		}
		else  //Invalid Recover Request
		{
			echo '<script>document.getElementById("invalid_recover").style.display="block"; setTimeout(stop_forgot_password_request,2500);</script>';				
		}
	}
?>


<!-- sign In or Up Form Modal -->
<div id="sign_form" class="w3-modal" style="z-index:99999999;">
	
	<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px;font-family:Arial;">
	
		<div id="sign_in_form" class="w3-container" style="margin:0px;padding:0px;">

			<div class="w3-container"><br>
				<span onclick="document.getElementById('forgot_password_form').style.display='none';document.getElementById('sign_in_main_form').style.display='block';document.getElementById('sign_form').style.display='none';document.getElementById('sign_in_main_title').innerHTML='Sign In';document.getElementById('invalid_msg').style.display='none';document.getElementById('block_msg').style.display='none';document.getElementById('active_msg').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
				<h2 class="w3-xlarge w3-bold w3-left-align" id="sign_in_main_title" style="font-family:Arial;">Sign In</h2>
			</div>

			<form id="sign_in_main_form" class="w3-container w3-margin-bottom" action="order_online.php" method="post">
				
				<div class="w3-container w3-border w3-padding">
					<div class="w3-row">
						<div class="w3-col w3-button w3-red" style="width:50%;"> Sign In </div>
						<div class="w3-col w3-button" onclick="document.getElementById('sign_in_form').style.display='none';document.getElementById('sign_up_form').style.display='block';" style="width:50%;"> Sign Up </div>
					</div>
				</div>
				
				<div id="invalid_msg" style="display:none;" class="w3-section w3-border w3-padding w3-center w3-bold w3-text-red">
					Invalid Email or Password
				</div>
				
				<div id="block_msg" style="display:none;" class="w3-section w3-border w3-padding w3-center w3-bold w3-text-red">
					Oops!! Your ID was Blocked by Admin
				</div>
				
				<div id="active_msg" style="display:none;" class="w3-section w3-border w3-padding w3-center w3-bold w3-text-teal">
					Please Check Your Email and Confirm Account
				</div>
				
				<div class="w3-section w3-border w3-padding">
				  <label><b>Email</b></label>
				  <input class="w3-input w3-border w3-margin-bottom" type="email" placeholder="Enter Email" name="customer_email" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" required>
				  <label><b>Password</b></label>
				  <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="customer_password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" required>
				  <button class="w3-button w3-block w3-green w3-margin-top w3-padding" type="submit" name="sign_in">Sign In</button>
				</div>
			

				<div class="w3-container w3-border w3-light-grey w3-margin-bottom">
					<div class="w3-row">
						<div class="w3-col" style="width:50%;">
							<input class="w3-check" type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>> Remember me
						</div>
						<div class="w3-col" style="width:50%;">
							<span class="w3-right w3-padding w3-text-blue" style="cursor:pointer;" onclick="show_forgot_password()">Forgot <a href="#">password?</a></span>
						</div>
					</div>
				</div>
			
			</form>
			
			<script>
				//show_forgot_password form
				function show_forgot_password() 
				{
					document.getElementById('sign_in_main_form').style.display='none';
					document.getElementById('sign_in_main_title').innerHTML='Recover Password';
					document.getElementById('forgot_password_form').style.display='block';
				}
			</script>
			
			<?php
				// Password Recovery System
				if(isset($_SESSION['forgot_password_request_2']))
				{
					echo '<script>document.getElementById("forgot_password_request").style.display="block"; setTimeout(stop_forgot_password_request,2500);</script>';				
					//echo '<script>console.log("'.$_SESSION['link'].'")</script>';
					unset($_SESSION['forgot_password_request_2']);
				}
				
				if(isset($_SESSION['forgot_password_request_3']))
				{
					echo '<script>document.getElementById("forgot_password_request2").style.display="block"; setTimeout(stop_forgot_password_request,2500);</script>';				
					unset($_SESSION['forgot_password_request_3']);
				}
				
				if(isset($_REQUEST['forgot_password']))
				{
					$flag=0;
					$email=trim($_REQUEST['email']);
					
					$stmtz = $conn->prepare("select * from customer where email=:email order by customer_id asc "); 
					$stmtz->execute(array('email'=>$email));
					$listz = $stmtz->fetchAll();
					//Email match or not
					$id=$listz[0]['customer_id'];
					if(count($listz)>0)
					{
						$flag=1;
						$link=rand(111111,999999);
						$link=$link.date("d-m-Y");
						$link=sha1($link);
						
						//Update sql of customer with recover link
						$stmtzz = $conn->prepare(" update customer set recover_link='$link' where customer_id='$id' "); 
						$stmtzz->execute();
						
						//echo '<script>console.log("'.$link.'");</script>';
						//Send mail
						$subject = 'Password Recovery Option';
						$message = '<html><body>';
						$message .= '<h1>Password Recovery Option - '.$website_title.'</h1><p>  </p>';
						$message .= '<p>Dear valuable customer,</p>';
						$message .= '<p>Please recover your password by clicking the following button.<p>  </p> Thanks.</p>'.$website_title.'<p>  </p><p>  </p>';
						$message .= '<div style="width:100%;">';
						$message .= '<a style="border-radius:5px;padding: 16px 32px;text-align: center;font-size: 16px;margin: 4px 2px;opacity: 1.0;transition: 0.3s;display: inline-block;text-decoration: none;cursor: pointer;color:#fff!important;background-color:#009688!important" href="'.$website_url.$_SERVER['REQUEST_URI'].'?recover=YES&link='.$link.'&email='.$email.'&c_id='.sha1($id).'">Recover Your Password</a>';
						$message .= '</div></body></html>';
						sent_mail($email,$subject,$message);
						
						
						//Please comment below instruction its for tsting purpose
						//$_SESSION['link']=$website_url.$_SERVER['REQUEST_URI'].'?recover=YES&link='.$link.'&email='.$email.'&c_id='.sha1($id);
						
					}
					
					
					if($flag==1) //Successfull Request flagging
					{
						$_SESSION['forgot_password_request_2']='YES';
					}
					else //wrong Email
					{
						$_SESSION['forgot_password_request_3']='YES';
					}
				}
				if(isset($_SESSION['forgot_password_request_2']))
				{
					header("Location: order_online.php");
				}
				if(isset($_SESSION['forgot_password_request_3']))
				{
					header("Location: order_online.php");
				}
			
			?>
			
			
			<!-- Forgot Password Form -->
			<form id="forgot_password_form" class="w3-container w3-border w3-padding" style="display:none;margin:0px 15px 30px 15px;" action="order_online.php" method="post">
				
				<input class="w3-input w3-border" type="email" placeholder="Your Email Address *" value="<?php if(isset($_SESSION['logged_in'])){ echo $_SESSION['customer_email']; } ?>" name="email" style="margin:8px 0px 0px 0px;" required />
						
				<?php 
					//spam Check 
					$aa=rand(1,20);
					$bb=rand(1,20);
					$cc=$aa+$bb;
				?>
				
				<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
					<div class="w3-col" style="width:40%;">
						<input class="w3-input w3-border w3-center" type="text" value="<?php echo $aa.' + '.$bb.' = '; ?>" disabled>
					</div>
					<div class="w3-col" style="margin-left:2%;width:58%;">
						<input class="w3-input w3-border" type="text"  maxlength="2"  placeholder=" * " id="captcha3"  required>
					</div>
				</div>
				
				<script>
					//Captcha Validation for forgot password
					var reservation_captcha3 = document.getElementById("captcha3");
					var sol3=<?php echo $cc; ?>;
					function reservation_captcha_val3(){
					  
					  //console.log(reservation_captcha.value);
					  //console.log(sol);
					  if(reservation_captcha3.value != sol3) {
						reservation_captcha3.setCustomValidity("Please Enter Valid Answer.");
					  } else {
						reservation_captcha3.setCustomValidity('');
					  }
					}
					reservation_captcha3.onchange=reservation_captcha_val3;
					
				</script>
				<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 5px 0px;" name="forgot_password"><i class="fa fa-send"></i> Submit Request</button>
			</form>
			
		</div>
		
		<!-- Sign Up form -->
		<div id="sign_up_form" class="w3-container" style="margin:0px;padding:0px;">
			
			<div class="w3-container"><br>
				<span onclick="document.getElementById('sign_form').style.display='none';document.getElementById('invalid_msg').style.display='none';document.getElementById('active_msg').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
				<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">Sign Up</h2>
			</div>
			
			<form class="w3-container w3-margin-bottom" action="order_online.php" method="post">
				
				<div class="w3-container w3-border w3-padding">
					<div class="w3-row">
						<div class="w3-col w3-button" onclick="document.getElementById('sign_up_form').style.display='none';document.getElementById('sign_in_form').style.display='block';" style="width:50%;"> Sign In </div>
						<div class="w3-col w3-button w3-red" style="width:50%;"> Sign Up </div>
					</div>
				</div>
				
				<div class="w3-section w3-border w3-padding">
				  
					<div class="w3-row" style="margin:0px;padding:0px;">
						<div class="w3-col" style="width:49%;">
							<input class="w3-input w3-border" type="text" placeholder="First Name *" name="first_name"  maxlength="20" required>
						</div>
						<div class="w3-col" style="margin-left:2%;width:49%;">
							<input class="w3-input w3-border" type="text" placeholder="Last Name *" name="last_name"  maxlength="20" required>
						</div>
					</div>
					
					<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
						<div class="w3-col" style="width:30%;">
							<input class="w3-input w3-border w3-center" type="text" value="UK (+44)" disabled>
						</div>
						<div class="w3-col" style="margin-left:2%;width:68%;">
							<input class="w3-input w3-border" type="number"  maxlength="11"  placeholder="Mobile Number (11 digits) * " name="mobile" id="mobile" required>
						</div>
					</div>
					
					<input class="w3-input w3-border" type="number" placeholder="Telephone Number"  maxlength="15"  name="telephone" style="margin:8px 0px 0px 0px;">
					
					<input class="w3-input w3-border" type="email" placeholder="Email Address *" name="email" style="margin:8px 0px 0px 0px;" required>
					
					<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
						<div class="w3-col" style="width:49%;">
							<input class="w3-input w3-border" type="password" placeholder="Password *" id="password" name="password" maxlength="30" pattern=".{6,}" required>
						</div>
						<div class="w3-col" style="margin-left:2%;width:49%;">
							<input class="w3-input w3-border" type="password" placeholder="Re-type Password *" id="confirm_password" maxlength="30" name="repassword" pattern=".{6,}" required>
						</div>
					</div>
				   
					<input class="w3-input w3-border" type="text" placeholder="Address *" name="address" style="margin:8px 0px 0px 0px;" required>
					
					<input class="w3-input w3-border" type="text" placeholder="Post Code *" name="post_code" style="margin:8px 0px 0px 0px;" required>
				    
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
					
					<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 0px 0px;" name="sign_up">Sign Up</button>
				
				</div>
			
			</form>
			
			
			<script>
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
			
			
				var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

				function validatePassword(){
				  if(password.value != confirm_password.value) {
					confirm_password.setCustomValidity("Passwords Don't Match");
				  } else {
					confirm_password.setCustomValidity('');
				  }
				}

				password.onchange = validatePassword;
				confirm_password.onkeyup = validatePassword;
				
				
				var mobile = document.getElementById("mobile");
				function validateMobile(){
				  
				  //console.log(mobile.value.length);
				  if(mobile.value.length != 11) {
					mobile.setCustomValidity("Please Enter Valid Mobile Number (11 digits).");
				  } else {
					mobile.setCustomValidity('');
				  }
				}
				mobile.onchange=validateMobile;
			</script>
		</div>
	</div>
</div>


<?php
	
	//Checking login status
	if($sign_in_flag==3) //account inactive
	{
		echo "<script> document.getElementById('sign_up_form').style.display='none'; document.getElementById('sign_in_form').style.display='block'; document.getElementById('sign_form').style.display='block'; document.getElementById('active_msg').style.display='block'; </script>";
	}
	else if($sign_in_flag==4) //invalid request
	{
		echo "<script> document.getElementById('sign_up_form').style.display='none'; document.getElementById('sign_in_form').style.display='block'; document.getElementById('sign_form').style.display='block'; document.getElementById('invalid_msg').style.display='block'; </script>";
	}
	else if($sign_in_flag==5) //account block
	{
		echo "<script> document.getElementById('sign_up_form').style.display='none'; document.getElementById('sign_in_form').style.display='block'; document.getElementById('sign_form').style.display='block'; document.getElementById('block_msg').style.display='block'; </script>";
	}
?>


<?php
	//After log in update profile will be active
	if(isset($_SESSION['logged_in']))
	{
		try
		{
			$id=$_SESSION['customer_id'];
			$stmt = $conn->prepare("select * from customer where customer_id='$id' "); 
			$stmt->execute();
			$list = $stmt->fetchAll();
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		
		if(isset($_SESSION['payment_successful'])) //card payment succssfull with stripe
		{
			
			$print_sub_total=0.00;
			$print_discount=0.00;
			$print_total=0.00;
			$print_d_per=0;
			
			//Email message setup
			$message = '<html><body>';
			$message .= '<h1>Order Checkout Successful - '.$website_title.'</h1><p>  </p>';
			$message .= '<p>Dear valuable customer,</p>';
			$message .= '<p>Thanks for order in '.$website_title.'. Your order placed successfully with the following details:</p>';  
			$message .= '<div style="float:left;">';
			
			$message .= '<table width="500" border="2" border="0" cellpadding="0" cellspacing="0" vspace="0" hspace="0" align="LEFT">
							<tbody>
								<tr>
									<td colspan="3" style="padding:4px 0px;text-align:center;font-size:17px;"><b>Order Details</b></td>
								</tr>
								<tr>
									<td style="padding:4px 0px;width:300px;text-align:center;font-size:14px;font-weight:bold;">Food Name</td>
									<td style="padding:4px 0px;width:100px;text-align:center;font-size:14px;font-weight:bold;">Quantity</td>
									<td style="padding:4px 0px;width:100px;text-align:center;font-size:14px;font-weight:bold;">Price</td>
								</tr>';
			
			
			//create order history here before delete
			$paid_through='card';
			$date=get_date();
			$time=get_time();
			$coupon_code=$_SESSION['cart_coupon'];
			$customer_id=$_SESSION['customer_id'];
			$address=$_SESSION['address'];
			$advice=$_SESSION['advice'];
			$status='In Queue';
			
			try
			{
				//Create Order
				$stmt = $conn->prepare("insert into order_info(coupon_code,paid_through,date,time,customer_id,address,advice,status) values(?,'$paid_through','$date','$time','$customer_id',?,?,'$status') "); 
				$stmt->execute([$coupon_code,$address,$advice]);
				
				//Getting the latest order_id
				$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' and coupon_code=:coupon_code and time='$time' and date='$date' and status='$status' order by customer_id desc ");
				$stmt->execute(array('coupon_code'=>$coupon_code));
				$list = $stmt->fetchAll();
				
				$order_id=$list[0]['order_id'];
				
				//Insert Cart
				foreach($_SESSION['cart_item'] as $food_id)
				{
					if(isset($_SESSION['cart_item_quantity'][$food_id]) && $_SESSION['cart_item_quantity'][$food_id]!=0)
					{
						$quantity=$_SESSION['cart_item_quantity'][$food_id];
						
						//Getting Food info for store in cart
						$stmt = $conn->prepare("select * from food where food_id='$food_id' order by food_id asc ");
						$stmt->execute();
						$list=$stmt->fetchAll();
						$price=$list[0]['food_price'];
						$food_name=$list[0]['food_name'];
						
						
						//Setting order details for email message
						$print_sub_total += ($quantity*$price);
						
						$message .= '<tr>
										<td style="padding:4px 4px;width:300px;">'.$food_name.'</td>
										<td style="padding:4px 0px;width:100px;text-align:center;">'.$quantity.' x</td>
										<td style="padding:4px 4px;width:100px;text-align:right;">'.number_format(($quantity*$price), 2, '.', '').'</td>
									</tr>';
						
						
						
						//Storing in cart
						$stmt = $conn->prepare("insert into cart_info(order_id,food_id,quantity,price,status) values('$order_id','$food_id','$quantity','$price','active') ");
						$stmt->execute();
					}
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
			//Retreiving Coupon information for discount percentage calculation
			try{
				$stmtx= $conn->prepare("select * from offer_coupon where offer_coupon_code=:coupon_code order by offer_id asc ");
				$stmtx->execute(array('coupon_code'=>$coupon_code));
				$listx=$stmtx->fetchAll();
				foreach($listx as $row)
				{
					$print_d_per=$row['offer_in_percentage'];
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
			$print_discount=(($print_subtotal/100.0)*$print_d_per);
			$print_total=$print_subtotal-$print_discount;
			
			//Removing all from order session
			$_SESSION['cart_coupon']=0;
			foreach($_SESSION['cart_item'] as $food_id) //it will hold food id
			{
				$key=array_search($food_id,$_SESSION['cart_item']);
				if($key!==false)
					unset($_SESSION['cart_item'][$key]);
				unset($_SESSION['cart_item_quantity'][$food_id]);
			}
			
			unset($_SESSION['payment_successful']);
			echo '<script>document.getElementById("card_paid_msg").style.display="block"; setTimeout(stop_payment_msg,2000);</script>';
		
			//Send Confirm Email
			$email=$_SESSION['customer_email'];
			$subject="Order Checkout Successful";
			
			$message .= '<tr>
							<td colspan="2" style="padding:4px 4px;font-weight:bold;">Subtotal</td>
							<td style="padding:4px 4px;font-weight:bold;text-align:right;">'.number_format($print_sub_total, 2, '.', '').'</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:4px 4px;font-weight:bold;">Discount</td>
							<td style="padding:4px 4px;font-weight:bold;text-align:right;">'.number_format($print_discount, 2, '.', '').'</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:4px 4px;font-weight:bold;font-size:16px;">Total</td>
							<td style="padding:4px 4px;font-weight:bold;font-size:16px;text-align:right;">&pound; '.number_format($print_total, 2, '.', '').'</td>
						</tr></tbody></table>';
						
			$message .= '</div><div style="padding: 0px 0px 0px 20px;float:left;"><b>';
			
			if($print_d_per!=0.00)
			{
				$message .= '<p>Coupon Code: '.$_SESSION['coupon_code'].' ('.$print_d_per.'%)</p>';
			}
			
			$message .= '<p>Order Date: '.$date.'</p>';			
			$message .= '<p>Order Time: '.$time.'</p>';			
			$message .= '<p>Paid By: Card</p>';			
						
			$message .= '</b></div></body></html>';
			
			sent_mail($email,$subject,$message);
			
		
		}
	
		if(isset($_SESSION['paypal_payment_done'])) //Paypal payment successfull done
		{
			$print_sub_total=0.00;
			$print_discount=0.00;
			$print_total=0.00;
			$print_d_per=0;
			
			//Email message setup
			$message = '<html><body>';
			$message .= '<h1>Order Checkout Successful - '.$website_title.'</h1><p>  </p>';
			$message .= '<p>Dear valuable customer,</p>';
			$message .= '<p>Thanks for order in '.$website_title.'. Your order placed successfully with the following details:</p>';  
			$message .= '<div style="float:left;">';
			
			$message .='<table width="500" border="2" border="0" cellpadding="0" cellspacing="0" vspace="0" hspace="0" align="LEFT">
							<tbody>
								<tr>
									<td colspan="3" style="padding:4px 0px;text-align:center;font-size:17px;"><b>Order Details</b></td>
								</tr>
								<tr>
									<td style="padding:4px 0px;width:300px;text-align:center;font-size:14px;font-weight:bold;">Food Name</td>
									<td style="padding:4px 0px;width:100px;text-align:center;font-size:14px;font-weight:bold;">Quantity</td>
									<td style="padding:4px 0px;width:100px;text-align:center;font-size:14px;font-weight:bold;">Price</td>
								</tr>';
			
			//create order history here before delete
			$paid_through='paypal';
			$date=get_date();
			$time=get_time();
			$coupon_code=$_SESSION['cart_coupon'];
			$customer_id=$_SESSION['customer_id'];
			$address=$_SESSION['address'];
			$advice=$_SESSION['advice'];
			$status='In Queue';
			
			try
			{
				//Create Order
				$stmt = $conn->prepare("insert into order_info(coupon_code,paid_through,date,time,customer_id,address,advice,status) values(?,'$paid_through','$date','$time','$customer_id',?,?,'$status') "); 
				$stmt->execute([$coupon_code,$address,$advice]);
				
				//Getting the latest order_id
				$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' and coupon_code=:coupon_code and time='$time' and date='$date' and status='$status' order by customer_id desc ");
				$stmt->execute(array('coupon_code'=>$coupon_code));
				$list = $stmt->fetchAll();
				
				$order_id=$list[0]['order_id'];
				
				//Insert Cart
				foreach($_SESSION['cart_item'] as $food_id)
				{
					if(isset($_SESSION['cart_item_quantity'][$food_id]) && $_SESSION['cart_item_quantity'][$food_id]!=0)
					{
						$quantity=$_SESSION['cart_item_quantity'][$food_id];
						
						$stmt = $conn->prepare("select * from food where food_id='$food_id' order by food_id asc ");
						$stmt->execute();
						$list=$stmt->fetchAll();
						
						$price=$list[0]['food_price'];
						$food_name=$list[0]['food_name'];
						
						//Setting order details for email message
						$print_sub_total += ($quantity*$price);
						$message .= '<tr>
										<td style="padding:4px 4px;width:300px;">'.$food_name.'</td>
										<td style="padding:4px 0px;width:100px;text-align:center;">'.$quantity.' x</td>
										<td style="padding:4px 4px;width:100px;text-align:right;">'.number_format(($quantity*$price), 2, '.', '').'</td>
									</tr>';
						
						$stmt = $conn->prepare("insert into cart_info(order_id,food_id,quantity,price,status) values('$order_id','$food_id','$quantity','$price','active') ");
						$stmt->execute();					
					}
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			
			//Retreiving Coupon information for discount percentage calculation
			$stmtx= $conn->prepare("select * from offer_coupon where offer_coupon_code=:coupon_code order by offer_id asc ");
			$stmtx->execute(array('coupon_code'=>$coupon_code));
			$listx=$stmtx->fetchAll();
			foreach($listx as $row)
			{
				$print_d_per=$row['offer_in_percentage'];
			}
			
			$print_discount=(($print_subtotal/100.0)*$print_d_per);
			$print_total=$print_subtotal-$print_discount;
			
			//Removing all from order session
			$_SESSION['cart_coupon']=0;
			foreach($_SESSION['cart_item'] as $food_id) //it will hold food id
			{
				$key=array_search($food_id,$_SESSION['cart_item']);
				if($key!==false)
					unset($_SESSION['cart_item'][$key]);
				unset($_SESSION['cart_item_quantity'][$food_id]);
			}
			
			unset($_SESSION['paypal_payment_done']);
			
			echo '<script>document.getElementById("paypal_paid_msg").style.display="block"; setTimeout(stop_payment_msg,2000);</script>';
		
			//Send Confirm Email
			$email=$_SESSION['customer_email'];
			$subject="Order Checkout Successful";
			
			$message .= '<tr>
							<td colspan="2" style="padding:4px 4px;font-weight:bold;">Subtotal</td>
							<td style="padding:4px 4px;font-weight:bold;text-align:right;">'.number_format($print_sub_total, 2, '.', '').'</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:4px 4px;font-weight:bold;">Discount</td>
							<td style="padding:4px 4px;font-weight:bold;text-align:right;">'.number_format($print_discount, 2, '.', '').'</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:4px 4px;font-weight:bold;font-size:16px;">Total</td>
							<td style="padding:4px 4px;font-weight:bold;font-size:16px;text-align:right;">&pound; '.number_format($print_total, 2, '.', '').'</td>
						</tr></tbody></table>';
						
			$message .= '</div><div style="padding: 0px 0px 0px 20px;float:left;"><b>';
			
			if($print_d_per!=0.00)
			{
				$message .= '<p>Coupon Code: '.$_SESSION['coupon_code'].' ('.$print_d_per.'%)</p>';
			}
			
			$message .= '<p>Order Date: '.$date.'</p>';			
			$message .= '<p>Order Time: '.$time.'</p>';			
			$message .= '<p>Paid By: Paypal</p>';			
						
			$message .= '</b></div></body></html>';
			
			sent_mail($email,$subject,$message);
		}
		
?>


		<!-- Update Profile Modal -->
		<div id="update_profile" class="w3-modal" style="z-index:99999999;">
			<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
				
				<div class="w3-container"><br>
					<span id="close_option" onclick="document.getElementById('ch_password').value='';document.getElementById('ch_confirm_password').value='';document.getElementById('selectedFile').value='';pre_set();document.getElementById('invalid_image_msg').style.display='none';document.getElementById('progress_bar').style.display='none';document.getElementById('update_profile').style.display='none';document.getElementById('pass_up').style.display='none';document.getElementById('image_up').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
					<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">My Profile</h2>
				</div>
				
				<div class="w3-cell-row">
				  <div class="w3-cell w3-center">
					<img id="profile_image" class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="images/customer/<?php if($list[0]['image']!=""){ echo $list[0]['image']; } else { echo 'default.png'; } ?>" style="width:140px;height:140px;">
				  </div>
				</div>  
				
				<p id="invalid_image_msg" style="display:none;" class="w3-center w3-text-red w3-bold">Sorry Invalid Image Selected !!!</p>
				
				<div class="w3-cell-row w3-border w3-padding w3-margin-top">
					<div class="w3-cell w3-border w3-small-padding w3-center w3-button w3-red" onclick="document.getElementById('selectedFile').click();" style="opacity:0.9;">
						<input class="w3-input" id="selectedFile" style="display: none;"  onclick="document.getElementById('image_up').style.display='block';" type="file" />
						<i class="fa fa-image"></i> Edit Profile Picture
					</div>
				</div>
				<p id="image_up" class="w3-tiny w3-text-red w3-bold w3-margin-left" style="display:none;margin-top:0px;">* Use only for change picture.</p>
				
				
				<form action="#">
				
					<div class="w3-section w3-border w3-padding">
								  
						<div class="w3-row" style="margin:0px;padding:0px;">
							<div class="w3-col" style="width:49%;">
								<input class="w3-input w3-border" type="text" placeholder="First Name *" id="first_name" value="<?php echo $list[0]['first_name']; ?>" maxlength="20" required>
							</div>
							<div class="w3-col" style="margin-left:2%;width:49%;">
								<input class="w3-input w3-border" type="text" placeholder="Last Name *" id="last_name" value="<?php echo $list[0]['last_name']; ?>"  maxlength="20" required>
							</div>
						</div>
						
						<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
							<div class="w3-col" style="width:30%;">
								<input class="w3-input w3-border w3-center" type="text" value="UK (+44)" disabled>
							</div>
							<div class="w3-col" style="margin-left:2%;width:68%;">
								<input class="w3-input w3-border" type="text"  maxlength="11"  placeholder="Mobile Number (11 digits) * " value="<?php echo $list[0]['mobile']; ?>" id="up_mobile" required>
							</div>
						</div>
						
						<input class="w3-input w3-border" type="text" placeholder="Telephone Number"  maxlength="15" value="<?php echo $list[0]['telephone']; ?>"  id="telephone" style="margin:8px 0px 0px 0px;">
						
						<input class="w3-input w3-border" type="email" placeholder="Email Address *" value="<?php echo $list[0]['email']; ?>" id="email" style="margin:8px 0px 0px 0px;" required>
						
						<div class="w3-row" style="margin:8px 0px 0px 0px;padding:0px;">
							<div class="w3-col" style="width:49%;">
								<input class="w3-input w3-border" type="password" placeholder="Password *" onclick="document.getElementById('pass_up').style.display='block';" id="ch_password" maxlength="30">
							</div>
							<div class="w3-col" style="margin-left:2%;width:49%;">
								<input class="w3-input w3-border" type="password" placeholder="Re-type Password *" onclick="document.getElementById('pass_up').style.display='block';" id="ch_confirm_password" maxlength="30">
							</div>
						</div>
						<p id="pass_up" class="w3-tiny w3-text-red w3-bold" style="display:none;margin-top:0px;">* Use only for change password.</p>
					   
						<input class="w3-input w3-border" type="text" placeholder="Address *" value="<?php echo $list[0]['address']; ?>" id="address" style="margin:8px 0px 0px 0px;" required>
						
						<input class="w3-input w3-border" type="text" placeholder="Post Code *" id="post_code" value="<?php echo $list[0]['post_code']; ?>" style="margin:8px 0px 0px 0px;" required>
						
						<div id="progress_bar" class="w3-light-grey w3-round-xlarge w3-border w3-margin-top w3-margin-bottom" style="display:none;">
							<div class="w3-container w3-blue w3-round-xlarge w3-text-white w3-bold" id="progress_id"></div>
						</div>
						
						<button class="w3-button w3-block w3-green w3-padding" type="submit" style="margin:8px 0px 0px 0px;" id="update_btn" onclick="update_profile()"><i class="fa fa-save"></i> Save Changes</button>
						
					</div>
				</form>
				
				<script>
				
					//Profile Update Function
					var mir=0;
					var op=0;
					function update_profile()
					{
						if(op==0)
						{
							var first_name=document.getElementById('first_name').value.trim();
							var last_name=document.getElementById('last_name').value.trim();
							var mobile=document.getElementById('up_mobile').value.trim();
							var telephone=document.getElementById('telephone').value.trim();
							var email=document.getElementById('email').value.trim();
							var password=document.getElementById('ch_password').value.trim();
							var address=document.getElementById('address').value.trim();
							var post_code=document.getElementById('post_code').value.trim();
							
							//Image info
							var image=document.getElementById('selectedFile').files[0];
							var image2=document.getElementById('selectedFile').value;
							
							var fd_image=new FormData();
							var link='selectedFile';
							fd_image.append(link, image);
							
							
							if(mir==0 && first_name!="" && last_name!="" && mobile!="" && email!="" && address!="" && post_code!="")
							{
								if(image2!="" && file_validate(image2)==false) //Image file extention not write
								{
									op=1;
									document.getElementById('invalid_image_msg').style.display='block';
									document.getElementById('image_up').style.display='none';
									document.getElementById('pass_up').style.display='none';
									document.getElementById('invalid_image_msg').focus(); 
									op=0; //must need to change in below condition with same value
								}
								else if(image2!="" &&  file_validate(image2)==true) //Image extention correct
								{
									op=1;
									//Invalid image_msg_hiding
									document.getElementById('invalid_image_msg').style.display='none';
									document.getElementById('image_up').style.display='none';
									document.getElementById('pass_up').style.display='none';
									//hiding close option of modal
									document.getElementById('close_option').style.display='none';
									//button change
									document.getElementById('update_btn').innerHTML='<i class=" w3-spin fa fa-refresh"></i> Please Wait ...';
									
									//Setting Progress Bar
									document.getElementById('progress_id').style.width='0%';
									document.getElementById('progress_id').innerHTML='0%';
									document.getElementById('progress_bar').style.display='block';
									
									//Ajax for image upload
									var xhttp1 = new XMLHttpRequest();
									xhttp1.onreadystatechange = function() {
										if (this.readyState == 4 && this.status == 200) {
											//retrive image_name
											var image_name=this.responseText.trim();
											image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
											
											//console.log(image_name);
											
											//resetting everything
											op=0;
											document.getElementById('selectedFile').value='';
											document.getElementById('progress_bar').style.display='none';
											document.getElementById('close_option').style.display='block';
											document.getElementById('update_btn').innerHTML='<i class="fa fa-save"></i> Save Changes';
											document.getElementById('ch_password').value='';document.getElementById('ch_confirm_password').value='';
											
											
											if(image_name=="Ok")
											{
												document.getElementById('updated').style.display='block';
												document.getElementById('desktop_profile_name').innerHTML='Hi! '+first_name;
												document.getElementById('mobile_profile_name').innerHTML='Hi! '+first_name;
												setTimeout(stop_on_progress,2500);
												//Changing Image on screen
												var tmppath = URL.createObjectURL(image);
													$("#profile_image").fadeIn("fast").attr('src',tmppath);
													$("#desk_image").fadeIn("fast").attr('src',tmppath);
													$("#mobile_image").fadeIn("fast").attr('src',tmppath);
												
												
											}
											else //some error occured either image or something else
											{
												document.getElementById('error_occured').style.display='block';
												setTimeout(stop_forgot_password_request,2500);
											}
										}
									};
									xhttp1.upload.onprogress = function(e) {
										if (e.lengthComputable) {
										  var percentComplete = Math.round((e.loaded / e.total) * 100);
										  percentComplete=percentComplete.toFixed(2);
										  if(percentComplete==100)
										  {
											 document.getElementById('progress_id').style.width=percentComplete+'%';
										     document.getElementById('progress_id').innerHTML= percentComplete+'%';
										  }
										  else
										  {
										     document.getElementById('progress_id').style.width=percentComplete+'%';
										     document.getElementById('progress_id').innerHTML= percentComplete+'%';
										  }
										}
									};
									xhttp1.open("POST", "include/customer_profile_update.php?update_profile=yes&image="+link+"&customer_id=<?php echo sha1($list[0]['customer_id']); ?>&first_name="+first_name+"&last_name="+last_name+"&mobile="+mobile+"&telephone="+telephone+"&email="+email+"&password="+password+"&address="+address+"&post_code="+post_code, true);
									xhttp1.send(fd_image);
									
								}
								else //Image not attached
								{
									op=1;
									//Invalid image_msg_hiding
									document.getElementById('invalid_image_msg').style.display='none';
									document.getElementById('image_up').style.display='none';
									document.getElementById('pass_up').style.display='none';
									//hiding close option of modal
									document.getElementById('close_option').style.display='none';
									//button change
									document.getElementById('update_btn').innerHTML='<i class=" w3-spin fa fa-refresh"></i> Please Wait ...';
									
									//Setting Progress Bar
									document.getElementById('progress_id').style.width='0%';
									document.getElementById('progress_id').innerHTML='0%';
									document.getElementById('progress_bar').style.display='block';
									
									//Ajax for text upload
									var xhttp1 = new XMLHttpRequest();
									xhttp1.onreadystatechange = function() {
										if (this.readyState == 4 && this.status == 200) {
											//retrive image_name
											var image_name=this.responseText.trim();
											image_name=image_name[image_name.length-2]+image_name[image_name.length-1];
											//console.log(image_name);
											document.getElementById('progress_id').style.width='100%';
											document.getElementById('progress_id').innerHTML='100%';
											//resetting everything
											op=0;
											document.getElementById('selectedFile').value='';
											document.getElementById('progress_bar').style.display='none';
											document.getElementById('close_option').style.display='block';
											document.getElementById('update_btn').innerHTML='<i class="fa fa-save"></i> Save Changes';
											document.getElementById('ch_password').value='';document.getElementById('ch_confirm_password').value='';
											
											if(image_name=="Ok")
											{
												document.getElementById('updated').style.display='block';
												document.getElementById('desktop_profile_name').innerHTML='Hi! '+first_name;
												document.getElementById('mobile_profile_name').innerHTML='Hi! '+first_name;
												setTimeout(stop_on_progress,2500);
											}
											else //some error occured either image or something else
											{
												document.getElementById('error_occured').style.display='block';
												setTimeout(stop_forgot_password_request,2500);
											}
										}
									};
									xhttp1.upload.onprogress = function(e) {
										if (e.lengthComputable) {
										  var percentComplete = Math.round((e.loaded / e.total) * 100);
										  percentComplete=percentComplete.toFixed(2);
										  if(percentComplete==100)
										  {
											 document.getElementById('progress_id').style.width=percentComplete+'%';
										     document.getElementById('progress_id').innerHTML= percentComplete+'%';
										  }
										  else
										  {
										     document.getElementById('progress_id').style.width=percentComplete+'%';
										     document.getElementById('progress_id').innerHTML= percentComplete+'%';
										  }
										}
									};
									xhttp1.open("POST", "include/customer_profile_update.php?update_profile_text=yes&customer_id=<?php echo sha1($list[0]['customer_id']); ?>&first_name="+first_name+"&last_name="+last_name+"&mobile="+mobile+"&telephone="+telephone+"&email="+email+"&password="+password+"&address="+address+"&post_code="+post_code, true);
									xhttp1.send();
									document.getElementById('progress_id').style.width='20%';
									document.getElementById('progress_id').innerHTML='20%';
								}
							}
						}
						else
						{
							document.getElementById('on_progress').style.display='block';
							setTimeout(stop_on_progress,1000);
						}
					}
					
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
					
					//correct update_btn
					function pre_set()
					{
						document.getElementById('update_btn').innerHTML='<i class="fa fa-save"></i> Save Changes';
					}
					
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
					
					//Mobile no checking
					var up_mobile = document.getElementById("up_mobile");
					function up_validateMobile(){
					  
					  //console.log(mobile.value.length);
					  if(up_mobile.value.length != 11) {
						mir=1;
						up_mobile.setCustomValidity("Please Enter Valid Mobile Number (11 digits).");
					  } else {
						mir=0;
						up_mobile.setCustomValidity('');
					  }
					}
					up_mobile.onchange=up_validateMobile;
					
				</script>
			</div>
		</div>
		
		
		<!-- My Orders Modal -->
		<div id="my_orders" class="w3-modal" style="z-index:99999999;">
			<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
				
				<div class="w3-container"><br>
					<span onclick="document.getElementById('my_orders').style.display='none';document.getElementById('all_order').style.display='block';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
					<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;">My Orders</h2>
				</div>
				<!-- Order history will show here -->
				<p class="w3-bold w3-tiny w3-right-align w3-text-red" style="padding:0px;margin:-15px 0px 0px 0px;"><a onclick="document.getElementById('all_order').style.display='none';document.getElementById('in_queue').style.display='block';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';" class="w3-round w3-text-blue" style="margin-right:5px;cursor:pointer;">In Queue</a><a onclick="document.getElementById('all_order').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='block';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';" style="margin-right:5px;cursor:pointer;" class="w3-round w3-text-teal">Processing</a><a onclick="document.getElementById('all_order').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='block';document.getElementById('cancelled').style.display='none';" class="w3-round  w3-text-green" style="margin-right:5px;cursor:pointer;">Delivered</a><a onclick="document.getElementById('all_order').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='block';" class=" w3-round w3-text-red" style="cursor:pointer;">Cancelled</a></p>
				
				<div class="w3-container w3-border w3-margin-bottom" style="padding:3px 3px 0px 3px;height:400px;overflow:auto;margin-top:5px;">
					<!-- All order box -->
					<div id="all_order" class="w3-container " style="padding:0px;margin:0px;">
						
						<?php 
							try
							{
								$customer_id=$_SESSION['customer_id'];
								$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' order by order_id desc ");
								$stmt->execute();
								$list = $stmt->fetchAll();
								$sl=0;
								foreach($list as $row)
								{
									$sl++;
									$coupon_code=$row['coupon_code'];
									$order_id=$row['order_id'];
									
									$d_per=0;
									//Getting coupon code percentage 
									$stmt2 = $conn->prepare("select * from offer_coupon where offer_coupon_code='$coupon_code' order by offer_id asc ");
									$stmt2->execute();
									$list2 = $stmt2->fetchAll();
									foreach($list2 as $row2)
										$d_per=$row2['offer_in_percentage'];
									
									//Getting Sum of cart product
									$stmt3 = $conn->prepare("select sum(price*quantity) from cart_info where order_id='$order_id' order by cart_id asc");
									$stmt3->execute();
									$list3 = $stmt3->fetchAll();
									
									$total=$list3[0]['sum(price*quantity)'];
									
									$total=($total-(($total/100.0)*$d_per));
						?>
									<!-- A single order -->
									<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-light-gray" style="margin: 0px 0px 3px 0px;">
										<div class="w3-row">
											<div class="w3-bold w3-col" style="width:25%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $sl; ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align" style="width:35%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:25%;">
												<?php
													if($row['status']=="Delivered")
													{
												?>
														<p class="w3-text-green" style="margin:2px 0px 0px 4px;padding:0px;">Delivered</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="In Queue")
													{
												?>
														<p class="w3-text-blue" style="margin:2px 0px 0px 4px;padding:0px;">In Queue</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Processing")
													{
												?>
														<p class="w3-text-teal" style="margin:2px 0px 0px 4px;padding:0px;">Processing</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Cancelled")
													{
												?>
														<p class="w3-text-red" style="margin:2px 0px 0px 4px;padding:0px;">Cancelled</p>
												<?php
													}
												?>
											</div>
											<div class="w3-col w3-small" style="width:15%;">
												<a id="all_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('all_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('all_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('all_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;">Details</a>
												<a id="all_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('all_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('all_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('all_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;">Hide</a>
											</div>
										</div>
										<!-- Order Details -->
										<div id="all_details_<?php echo $row['order_id']; ?>" class="w3-khaki w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
											<!-- Order date & time -->
											<div class="w3-row">
												<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
													Time: <?php echo $row['time']; ?>
												</div>
												<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
													Date: <?php echo $row['date']; ?>
												</div>
											</div>
											<div class="w3-container w3-border w3-white" style="padding:4px 4px 0px 4px;margin:5px 0px;">
												<?php
													$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
													$stmt4->execute();
													$list4 = $stmt4->fetchAll();
													foreach($list4 as $row4)
													{
														$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
														$stmt5->execute();
														$list5 = $stmt5->fetchAll();
												?>
															<!-- A single item in order -->
															<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
																<div class="w3-col w3-left-align w3-small" style="width:20%;">
																	<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
																</div>
																<div class="w3-col w3-left-align w3-small" style="width:55%;">
																	<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
																</div>
																<div class="w3-col w3-right-align w3-small" style="width:25%;">
																	<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
																</div>
															</div>
												<?php
													}
												?>
												<!-- Order information related to this order -->
												<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
													</div>
													<div class="w3-col" style="width:2%;margin-top:4px;">
													&nbsp
													</div>
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
													</div>
												</div>
												<?php 
													if($d_per!=0)
													{
												?>
													<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
														<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
															<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
														</div>
													</div>
												<?php
													}
												?>
												<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
													</div>
												</div>
												<?php 
													if($row['advice']!="")
													{
												?>
														<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
															<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
																<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
															</div>
														</div>
												<?php
													}
												?>
												<div class="w3-row w3-white w3-bottombar" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;margin-bottom:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
														<?php 
															if($row['address']=="")
															{
																$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
																$stmt6->execute();
																$list6 = $stmt6->fetchAll();
																echo $list6[0]['address'];
															}
															else
																echo $row['address'];
														?>
														</font></p>
													</div>
												</div>
												
											</div>
										</div>
									</div>
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							if($sl==0)
							{
						?>
								<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
						<?php
							}
						?>
					</div>
					
					<!-- In Queue Order -->
					<div id="in_queue" class="w3-container " style="padding:0px;margin:0px;display:none;">
						
						<?php 
							try
							{
								$customer_id=$_SESSION['customer_id'];
								$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' and status='In Queue' order by order_id desc ");
								$stmt->execute();
								$list = $stmt->fetchAll();
								$sl=0;
								foreach($list as $row)
								{
									$sl++;
									$coupon_code=$row['coupon_code'];
									$order_id=$row['order_id'];
									
									$d_per=0;
									//Getting coupon code percentage 
									$stmt2 = $conn->prepare("select * from offer_coupon where offer_coupon_code='$coupon_code' order by offer_id asc ");
									$stmt2->execute();
									$list2 = $stmt2->fetchAll();
									foreach($list2 as $row2)
										$d_per=$row2['offer_in_percentage'];
									
									//Getting Sum of cart product
									$stmt3 = $conn->prepare("select sum(price*quantity) from cart_info where order_id='$order_id' order by cart_id asc");
									$stmt3->execute();
									$list3 = $stmt3->fetchAll();
									
									$total=$list3[0]['sum(price*quantity)'];
									
									$total=($total-(($total/100.0)*$d_per));
						?>
									<!-- A single order -->
									<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-light-gray" style="margin: 0px 0px 3px 0px;">
										<div class="w3-row">
											<div class="w3-bold w3-col" style="width:25%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $sl; ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align" style="width:35%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:25%;">
												<?php
													if($row['status']=="Delivered")
													{
												?>
														<p class="w3-text-green" style="margin:2px 0px 0px 4px;padding:0px;">Delivered</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="In Queue")
													{
												?>
														<p class="w3-text-blue" style="margin:2px 0px 0px 4px;padding:0px;">In Queue</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Processing")
													{
												?>
														<p class="w3-text-teal" style="margin:2px 0px 0px 4px;padding:0px;">Processing</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Cancelled")
													{
												?>
														<p class="w3-text-red" style="margin:2px 0px 0px 4px;padding:0px;">Cancelled</p>
												<?php
													}
												?>
											</div>
											<div class="w3-col w3-small" style="width:15%;">
												<a id="in_queue_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('in_queue_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('in_queue_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('in_queue_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;">Details</a>
												<a id="in_queue_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('in_queue_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('in_queue_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('in_queue_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;">Hide</a>
											</div>
										</div>
										<!-- Order Details -->
										<div id="in_queue_details_<?php echo $row['order_id']; ?>" class="w3-khaki w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
											<!-- Order date & time -->
											<div class="w3-row">
												<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
													Time: <?php echo $row['time']; ?>
												</div>
												<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
													Date: <?php echo $row['date']; ?>
												</div>
											</div>
											<div class="w3-container w3-border w3-white" style="padding:4px 4px 0px 4px;margin:5px 0px;">
												<?php
													$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
													$stmt4->execute();
													$list4 = $stmt4->fetchAll();
													foreach($list4 as $row4)
													{
														$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
														$stmt5->execute();
														$list5 = $stmt5->fetchAll();
												?>
															<!-- A single item in order -->
															<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
																<div class="w3-col w3-left-align w3-small" style="width:20%;">
																	<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
																</div>
																<div class="w3-col w3-left-align w3-small" style="width:55%;">
																	<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
																</div>
																<div class="w3-col w3-right-align w3-small" style="width:25%;">
																	<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
																</div>
															</div>
												<?php
													}
												?>
												<!-- Order information related to this order -->
												<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
													</div>
													<div class="w3-col" style="width:2%;margin-top:4px;">
													&nbsp
													</div>
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
													</div>
												</div>
												<?php 
													if($d_per!=0)
													{
												?>
													<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
														<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
															<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
														</div>
													</div>
												<?php
													}
												?>
												<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
													</div>
												</div>
												<?php 
													if($row['advice']!="")
													{
												?>
														<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
															<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
																<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
															</div>
														</div>
												<?php
													}
												?>
												<div class="w3-row w3-white w3-bottombar" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;margin-bottom:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
														<?php 
															if($row['address']=="")
															{
																$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
																$stmt6->execute();
																$list6 = $stmt6->fetchAll();
																echo $list6[0]['address'];
															}
															else
																echo $row['address'];
														?>
														</font></p>
													</div>
												</div>
												
											</div>
										</div>
									</div>
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							if($sl==0)
							{
						?>
								<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
						<?php
							}
						?>
					</div>
					<!-- Processing Order -->
					<div id="processing" class="w3-container " style="padding:0px;margin:0px;display:none;">
						<?php 
							try
							{
								$customer_id=$_SESSION['customer_id'];
								$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' and status='Processing' order by order_id desc ");
								$stmt->execute();
								$list = $stmt->fetchAll();
								$sl=0;
								foreach($list as $row)
								{
									$sl++;
									$coupon_code=$row['coupon_code'];
									$order_id=$row['order_id'];
									
									$d_per=0;
									//Getting coupon code percentage 
									$stmt2 = $conn->prepare("select * from offer_coupon where offer_coupon_code='$coupon_code' order by offer_id asc ");
									$stmt2->execute();
									$list2 = $stmt2->fetchAll();
									foreach($list2 as $row2)
										$d_per=$row2['offer_in_percentage'];
									
									//Getting Sum of cart product
									$stmt3 = $conn->prepare("select sum(price*quantity) from cart_info where order_id='$order_id' order by cart_id asc");
									$stmt3->execute();
									$list3 = $stmt3->fetchAll();
									
									$total=$list3[0]['sum(price*quantity)'];
									
									$total=($total-(($total/100.0)*$d_per));
						?>
									<!-- A single order -->
									<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-light-gray" style="margin: 0px 0px 3px 0px;">
										<div class="w3-row">
											<div class="w3-bold w3-col" style="width:25%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $sl; ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align" style="width:35%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:25%;">
												<?php
													if($row['status']=="Delivered")
													{
												?>
														<p class="w3-text-green" style="margin:2px 0px 0px 4px;padding:0px;">Delivered</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="In Queue")
													{
												?>
														<p class="w3-text-blue" style="margin:2px 0px 0px 4px;padding:0px;">In Queue</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Processing")
													{
												?>
														<p class="w3-text-teal" style="margin:2px 0px 0px 4px;padding:0px;">Processing</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Cancelled")
													{
												?>
														<p class="w3-text-red" style="margin:2px 0px 0px 4px;padding:0px;">Cancelled</p>
												<?php
													}
												?>
											</div>
											<div class="w3-col w3-small" style="width:15%;">
												<a id="processing_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('processing_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('processing_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('processing_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;">Details</a>
												<a id="processing_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('processing_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('processing_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('processing_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;">Hide</a>
											</div>
										</div>
										<!-- Order Details -->
										<div id="processing_details_<?php echo $row['order_id']; ?>" class="w3-khaki w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
											<!-- Order date & time -->
											<div class="w3-row">
												<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
													Time: <?php echo $row['time']; ?>
												</div>
												<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
													Date: <?php echo $row['date']; ?>
												</div>
											</div>
											<div class="w3-container w3-border w3-white" style="padding:4px 4px 0px 4px;margin:5px 0px;">
												<?php
													$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
													$stmt4->execute();
													$list4 = $stmt4->fetchAll();
													foreach($list4 as $row4)
													{
														$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
														$stmt5->execute();
														$list5 = $stmt5->fetchAll();
												?>
															<!-- A single item in order -->
															<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
																<div class="w3-col w3-left-align w3-small" style="width:20%;">
																	<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
																</div>
																<div class="w3-col w3-left-align w3-small" style="width:55%;">
																	<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
																</div>
																<div class="w3-col w3-right-align w3-small" style="width:25%;">
																	<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
																</div>
															</div>
												<?php
													}
												?>
												<!-- Order information related to this order -->
												<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
													</div>
													<div class="w3-col" style="width:2%;margin-top:4px;">
													&nbsp
													</div>
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
													</div>
												</div>
												<?php 
													if($d_per!=0)
													{
												?>
													<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
														<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
															<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
														</div>
													</div>
												<?php
													}
												?>
												<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
													</div>
												</div>
												<?php 
													if($row['advice']!="")
													{
												?>
														<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
															<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
																<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
															</div>
														</div>
												<?php
													}
												?>
												<div class="w3-row w3-white w3-bottombar" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;margin-bottom:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
														<?php 
															if($row['address']=="")
															{
																$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
																$stmt6->execute();
																$list6 = $stmt6->fetchAll();
																echo $list6[0]['address'];
															}
															else
																echo $row['address'];
														?>
														</font></p>
													</div>
												</div>
												
											</div>
										</div>
									</div>
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							if($sl==0)
							{
						?>
								<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
						<?php
							}
						?>
					</div>
					<!-- Delivered Order -->		
					<div id="delivered" class="w3-container " style="padding:0px;margin:0px;display:none;">
						<?php 
							try
							{
								$customer_id=$_SESSION['customer_id'];
								$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' and status='Delivered' order by order_id desc ");
								$stmt->execute();
								$list = $stmt->fetchAll();
								$sl=0;
								foreach($list as $row)
								{
									$sl++;
									$coupon_code=$row['coupon_code'];
									$order_id=$row['order_id'];
									
									$d_per=0;
									//Getting coupon code percentage 
									$stmt2 = $conn->prepare("select * from offer_coupon where offer_coupon_code='$coupon_code' order by offer_id asc ");
									$stmt2->execute();
									$list2 = $stmt2->fetchAll();
									foreach($list2 as $row2)
										$d_per=$row2['offer_in_percentage'];
									
									//Getting Sum of cart product
									$stmt3 = $conn->prepare("select sum(price*quantity) from cart_info where order_id='$order_id' order by cart_id asc");
									$stmt3->execute();
									$list3 = $stmt3->fetchAll();
									
									$total=$list3[0]['sum(price*quantity)'];
									
									$total=($total-(($total/100.0)*$d_per));
						?>
									<!-- A single order -->
									<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-light-gray" style="margin: 0px 0px 3px 0px;">
										<div class="w3-row">
											<div class="w3-bold w3-col" style="width:25%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $sl; ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align" style="width:35%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:25%;">
												<?php
													if($row['status']=="Delivered")
													{
												?>
														<p class="w3-text-green" style="margin:2px 0px 0px 4px;padding:0px;">Delivered</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="In Queue")
													{
												?>
														<p class="w3-text-blue" style="margin:2px 0px 0px 4px;padding:0px;">In Queue</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Processing")
													{
												?>
														<p class="w3-text-teal" style="margin:2px 0px 0px 4px;padding:0px;">Processing</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Cancelled")
													{
												?>
														<p class="w3-text-red" style="margin:2px 0px 0px 4px;padding:0px;">Cancelled</p>
												<?php
													}
												?>
											</div>
											<div class="w3-col w3-small" style="width:15%;">
												<a id="delivered_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('delivered_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('delivered_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('delivered_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;">Details</a>
												<a id="delivered_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('delivered_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('delivered_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('delivered_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;">Hide</a>
											</div>
										</div>
										<!-- Order Details -->
										<div id="delivered_details_<?php echo $row['order_id']; ?>" class="w3-khaki w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
											<!-- Order date & time -->
											<div class="w3-row">
												<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
													Time: <?php echo $row['time']; ?>
												</div>
												<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
													Date: <?php echo $row['date']; ?>
												</div>
											</div>
											<div class="w3-container w3-border w3-white" style="padding:4px 4px 0px 4px;margin:5px 0px;">
												<?php
													$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
													$stmt4->execute();
													$list4 = $stmt4->fetchAll();
													foreach($list4 as $row4)
													{
														$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
														$stmt5->execute();
														$list5 = $stmt5->fetchAll();
												?>
															<!-- A single item in order -->
															<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
																<div class="w3-col w3-left-align w3-small" style="width:20%;">
																	<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
																</div>
																<div class="w3-col w3-left-align w3-small" style="width:55%;">
																	<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
																</div>
																<div class="w3-col w3-right-align w3-small" style="width:25%;">
																	<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
																</div>
															</div>
												<?php
													}
												?>
												<!-- Order information related to this order -->
												<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
													</div>
													<div class="w3-col" style="width:2%;margin-top:4px;">
													&nbsp
													</div>
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
													</div>
												</div>
												<?php 
													if($d_per!=0)
													{
												?>
													<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
														<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
															<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
														</div>
													</div>
												<?php
													}
												?>
												<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
													</div>
												</div>
												<?php 
													if($row['advice']!="")
													{
												?>
														<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
															<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
																<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
															</div>
														</div>
												<?php
													}
												?>
												<div class="w3-row w3-white w3-bottombar" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;margin-bottom:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
														<?php 
															if($row['address']=="")
															{
																$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
																$stmt6->execute();
																$list6 = $stmt6->fetchAll();
																echo $list6[0]['address'];
															}
															else
																echo $row['address'];
														?>
														</font></p>
													</div>
												</div>
												
											</div>
										</div>
									</div>
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							if($sl==0)
							{
						?>
								<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
						<?php
							}
						?>
					</div>
					<!-- Cancelled Order -->				
					<div id="cancelled" class="w3-container " style="padding:0px;margin:0px;display:none;">
						
						<?php 
							try
							{
								$customer_id=$_SESSION['customer_id'];
								$stmt = $conn->prepare("select * from order_info where customer_id='$customer_id' and status='Cancelled' order by order_id desc ");
								$stmt->execute();
								$list = $stmt->fetchAll();
								$sl=0;
								foreach($list as $row)
								{
									$sl++;
									$coupon_code=$row['coupon_code'];
									$order_id=$row['order_id'];
									
									$d_per=0;
									//Getting coupon code percentage 
									$stmt2 = $conn->prepare("select * from offer_coupon where offer_coupon_code='$coupon_code' order by offer_id asc ");
									$stmt2->execute();
									$list2 = $stmt2->fetchAll();
									foreach($list2 as $row2)
										$d_per=$row2['offer_in_percentage'];
									
									//Getting Sum of cart product
									$stmt3 = $conn->prepare("select sum(price*quantity) from cart_info where order_id='$order_id' order by cart_id asc");
									$stmt3->execute();
									$list3 = $stmt3->fetchAll();
									
									$total=$list3[0]['sum(price*quantity)'];
									
									$total=($total-(($total/100.0)*$d_per));
						?>
									<!-- A single order -->
									<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-light-gray" style="margin: 0px 0px 3px 0px;">
										<div class="w3-row">
											<div class="w3-bold w3-col" style="width:25%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $sl; ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align" style="width:35%;">
												<p class="w3-small" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
											</div>
											<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:25%;">
												<?php
													if($row['status']=="Delivered")
													{
												?>
														<p class="w3-text-green" style="margin:2px 0px 0px 4px;padding:0px;">Delivered</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="In Queue")
													{
												?>
														<p class="w3-text-blue" style="margin:2px 0px 0px 4px;padding:0px;">In Queue</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Processing")
													{
												?>
														<p class="w3-text-teal" style="margin:2px 0px 0px 4px;padding:0px;">Processing</p>
												<?php
													}
												?>
												<?php
													if($row['status']=="Cancelled")
													{
												?>
														<p class="w3-text-red" style="margin:2px 0px 0px 4px;padding:0px;">Cancelled</p>
												<?php
													}
												?>
											</div>
											<div class="w3-col w3-small" style="width:15%;">
												<a id="cancelled_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('cancelled_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('cancelled_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('cancelled_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;">Details</a>
												<a id="cancelled_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('cancelled_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('cancelled_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('cancelled_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;">Hide</a>
											</div>
										</div>
										<!-- Order Details -->
										<div id="cancelled_details_<?php echo $row['order_id']; ?>" class="w3-khaki w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
											<!-- Order date & time -->
											<div class="w3-row">
												<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
													Time: <?php echo $row['time']; ?>
												</div>
												<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
													Date: <?php echo $row['date']; ?>
												</div>
											</div>
											<div class="w3-container w3-border w3-white" style="padding:4px 4px 0px 4px;margin:5px 0px;">
												<?php
													$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
													$stmt4->execute();
													$list4 = $stmt4->fetchAll();
													foreach($list4 as $row4)
													{
														$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
														$stmt5->execute();
														$list5 = $stmt5->fetchAll();
												?>
															<!-- A single item in order -->
															<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
																<div class="w3-col w3-left-align w3-small" style="width:20%;">
																	<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
																</div>
																<div class="w3-col w3-left-align w3-small" style="width:55%;">
																	<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
																</div>
																<div class="w3-col w3-right-align w3-small" style="width:25%;">
																	<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
																</div>
															</div>
												<?php
													}
												?>
												<!-- Order information related to this order -->
												<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
													</div>
													<div class="w3-col" style="width:2%;margin-top:4px;">
													&nbsp
													</div>
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:49%;margin-top:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
													</div>
												</div>
												<?php 
													if($d_per!=0)
													{
												?>
													<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
														<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
															<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
														</div>
													</div>
												<?php
													}
												?>
												<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
													</div>
												</div>
												<?php 
													if($row['advice']!="")
													{
												?>
														<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
															<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
																<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
															</div>
														</div>
												<?php
													}
												?>
												<div class="w3-row w3-white w3-bottombar" style="margin-bottom:4px;padding:0px;">
													<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;margin-bottom:4px;">
														<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
														<?php 
															if($row['address']=="")
															{
																$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
																$stmt6->execute();
																$list6 = $stmt6->fetchAll();
																echo $list6[0]['address'];
															}
															else
																echo $row['address'];
														?>
														</font></p>
													</div>
												</div>
												
											</div>
										</div>
									</div>
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
							if($sl==0)
							{
						?>
								<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- My Payment Modal -->
		<div id="my_payment" class="w3-modal" style="z-index:99999999;">
			<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
				
				<!-- Title -->
				<div class="w3-container"><br>
					<span onclick="document.getElementById('my_payment').style.display='none';document.getElementById('my_payment_title').innerHTML='Choose Payment';document.getElementById('my_payment_button').style.display='block';document.getElementById('my_payment_details').style.display='block';document.getElementById('my_payment_details1').style.display='block';document.getElementById('my_payment_card_form').style.display='none';document.getElementById('card_msg').style.display='none';document.getElementById('paypal_msg').style.display='none';document.getElementById('my_payment_paypal_form').style.display='none';document.getElementById('paypal_msg1').style.display='none';document.getElementById('paypal_msg2').style.display='none';document.getElementById('card_msg1').style.display='none';document.getElementById('card_msg2').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
					<h2 class="w3-xlarge w3-bold w3-left-align" id="my_payment_title" style="font-family:Arial;">Choose Payment</h2>
				</div>
				
				<!-- Payment Details -->
				<div class="w3-container w3-margin-bottom w3-border">
					<div id="my_payment_details" class="w3-row w3-border w3-padding-small w3-margin-top" style="margin:0px;width:100%;">
						<div class="w3-col w3-left-align" style="padding:4px;margin:0px;width:50%;"><p class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">Subtotal:</p></div>
						<div class="w3-col w3-right-align" style="padding:4px;margin:0px;width:50%;"><p id="pay_subtotal_amount" class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">0.00</p></div>
					</div>
					<!-- Discount --> 
					<div id="my_payment_details1" class="w3-row w3-border w3-padding-small w3-margin-top" style="padding:0px;margin:0px;width:100%;">
						<div class="w3-col w3-left-align" style="padding:4px;margin:0px;width:50%;"><p class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">Discount:</p></div>
						<div class="w3-col w3-right-align" style="padding:4px;margin:0px;width:50%;"><p id="pay_discount_amount" class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">0.00</p></div>
					</div>
					<!-- Total -->
					<div  id="my_payment_details2" class="w3-cell-row w3-border w3-padding-small w3-margin-top w3-margin-bottom" style="padding:0px;margin:0px;">
						<div class="w3-cell w3-left-align" style="padding:6px 0px 4px 4px;margin:0px;"><p class="w3-medium" style="font-family:Arial;padding:0px;margin:0px;">Total:</p></div>
						<div class="w3-cell w3-right-align" style="padding:0px 4px 0px 0px;margin:0px;"><p id="pay_total_amount" class="w3-xlarge" style="font-family:Arial;padding:0px;margin:0px;">&pound; 0.00</p></div>
					</div>
				</div>
				
				<!-- Main Payment form of card stripe -->
				<div  id="my_payment_card_form" class="w3-container w3-margin-bottom w3-border" style="display:none;">
					<?php require_once('stripe_card_pay/config.php'); ?>
					<p class="w3-text-red w3-center w3-bold w3-margin-bottom w3-medium" id="card_msg" style="margin:0px;padding:0px;display:none;">
						
					</p>
					<form action="stripe_card_pay/charge.php" method="post" id="payment-form" class="w3-container" style="margin:0px;padding:0px;">
						
						<div class="form-row w3-container w3-border w3-padding">
						    <div id="card-element" class="form-control">
							  <!-- a Stripe Element will be inserted here. -->
							</div>
							<!-- Used to display form errors -->
							<div id="card-errors" role="alert" class="w3-text-red w3-bold w3-tiny"></div>
						</div>
						
						<input type="hidden" name="total_amount" id="pass_amount">
						<input type="hidden" name="email" value="<?php echo $list[0]['email']; ?>">
						
						<input onclick="document.getElementById('card_msg1').style.display='block';" class="w3-input w3-border w3-margin-top" type="text" placeholder="New Delivery Address" name="new_address">
						<p id="card_msg1" class="w3-left-align w3-bold w3-text-red w3-tiny" style="margin-top:0px;display:none;">
						* Use this only if you want to deliver your order in a new place.
						</p>
						
						<input onclick="document.getElementById('card_msg2').style.display='block';" class="w3-input w3-border w3-margin-top" type="text" placeholder="Any Suggestion" name="suggestion">
						<p id="card_msg2" class="w3-left-align w3-bold w3-text-red w3-tiny" style="margin-top:0px;display:none;">
						* Use this only if you have any suggestion about your order.
						</p>
						
						<div class="w3-container w3-border w3-padding w3-margin-top w3-margin-bottom">
							<button style="width:100%;" onclick="document.getElementById('pass_amount').value=document.getElementById('pay_total_amount').innerHTML;"><i class="fa fa-send"></i> Submit Payment</button>
						</div>
					</form>
					<script src="https://js.stripe.com/v3/"></script>
					<script src="stripe_card_pay/js/charge.js"></script>
				</div>
				
				
				<!-- Payment form Paypal  -->
				<div  id="my_payment_paypal_form"  class="w3-container w3-margin-bottom w3-border" style="display:none;">
					
					<p class="w3-text-red w3-center w3-bold w3-margin-top w3-medium" id="paypal_msg" style="margin:0px;padding:0px;display:none;">
					</p>
					
					<form class="paypal" action="paypal/payments.php" method="post" id="paypal_form">
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="no_note" value="1" />
						<input type="hidden" name="lc" value="UK" />
						<input type="hidden" name="currency_code" value="GBP" />
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
						<input type="hidden" name="paypal_amount" id="paypal_pass_amount" />
						<input type="hidden" name="link" value="<?php echo sha1($_SESSION['customer_id']); ?>" />
						
						<input onclick="document.getElementById('paypal_msg1').style.display='block';" class="w3-input w3-border w3-margin-top" type="text" placeholder="New Delivery Address" name="new_address">
						<p id="paypal_msg1" class="w3-left-align w3-bold w3-text-red w3-tiny" style="margin-top:0px;display:none;">
						* Use this only if you want to deliver your order in a new place.
						</p>
						
						<input onclick="document.getElementById('paypal_msg2').style.display='block';" class="w3-input w3-border w3-margin-top" type="text" placeholder="Any Suggestion" name="suggestion">
						<p id="paypal_msg2" class="w3-left-align w3-bold w3-text-red w3-tiny" style="margin-top:0px;display:none;">
						* Use this only if you have any suggestion about your order.
						</p>
						
						<div class="w3-container w3-border w3-padding w3-margin-top w3-margin-bottom">
							<button class="w3-button w3-green w3-round" style="width:100%;" onclick="document.getElementById('paypal_pass_amount').value=document.getElementById('pay_total_amount').innerHTML;"><i class="fa fa-send"></i> Submit Payment</button>
						</div> 
					</form>
				</div>
				
				
				<!-- Initial Payment Button -->
				<div  id="my_payment_button" class="w3-container w3-margin-bottom w3-border">
					<div class="w3-container w3-margin-bottom w3-border w3-margin-top">
						<p onclick="document.getElementById('my_payment_title').innerHTML='Pay with Card';document.getElementById('my_payment_button').style.display='none';document.getElementById('my_payment_details').style.display='none';document.getElementById('my_payment_details1').style.display='none';document.getElementById('my_payment_card_form').style.display='block';" class="w3-button w3-round w3-red" style="width:100%;"><i class="fa fa-credit-card"></i> Pay with Card</p>
					</div>
					<div class="w3-container w3-margin-bottom w3-border">
						<p onclick="document.getElementById('my_payment_title').innerHTML='Pay with Paypal';document.getElementById('my_payment_button').style.display='none';document.getElementById('my_payment_details').style.display='none';document.getElementById('my_payment_details1').style.display='none';document.getElementById('my_payment_paypal_form').style.display='block';" class="w3-button w3-round w3-red" style="width:100%;"><i class="fa fa-paypal"></i> Pay with Paypal</p>
					</div>
				</div>
				
			</div>
		</div>
<?php
	}
?>




<!--clear Section -->
<div class="w3-container w3-margin" style="margin:0px 0px 0px 0px;">

</div>

<!-- Desktop and Mobile Order Handeling Section -->
<div class="w3-container w3-round w3-center" style="padding:0px; width:96%;margin:0 auto;">
	
	<?php include("include/desktop_order_online.php"); ?>
	<?php include("include/mobile_order_online.php"); ?>
	
</div>

<?php
	if(isset($_SESSION['payment_not_successful'])) //error found in card access with stripe
	{
		$msg=$_SESSION['payment_msg'];
		
		echo '<script>document.getElementById("my_payment_button").style.display="none";</script>';
		echo '<script>document.getElementById("my_payment_details").style.display="none";</script>';
		echo '<script>document.getElementById("my_payment_details1").style.display="none";</script>';
		
		echo '<script>document.getElementById("pay_total_amount").innerHTML=document.getElementById("mototal_amount").innerHTML; </script>';
		
		echo '<script>document.getElementById("my_payment_card_form").style.display="block";</script>';
		echo '<script>document.getElementById("card_msg").style.display="block";</script>';
		echo '<script>document.getElementById("card_msg").innerHTML="'.$msg.'";</script>';
		echo '<script>document.getElementById("my_payment").style.display="block";</script>';
		
		unset($_SESSION['payment_not_successful']);
		unset($_SESSION['payment_msg']);
		unset($_SESSION['address']);
		unset($_SESSION['advice']);
	}
	if(isset($_SESSION['paypal_payment_not_done']))  //error in paypal payment
	{
		$msg="Sorry your paypal payment was cancelled";
	
		echo '<script>document.getElementById("my_payment_button").style.display="none";</script>';
		echo '<script>document.getElementById("my_payment_details").style.display="none";</script>';
		echo '<script>document.getElementById("my_payment_details1").style.display="none";</script>';
		
		echo '<script>document.getElementById("pay_total_amount").innerHTML=document.getElementById("mototal_amount").innerHTML; </script>';
		
		echo '<script>document.getElementById("my_payment_paypal_form").style.display="block";</script>';
		echo '<script>document.getElementById("paypal_msg").style.display="block";</script>';
		echo '<script>document.getElementById("paypal_msg").innerHTML="'.$msg.'";</script>';
		echo '<script>document.getElementById("my_payment").style.display="block";</script>';
		
		
		unset($_SESSION['paypal_payment_not_done']);
		unset($_SESSION['address']);
		unset($_SESSION['advice']);
	}
	
	include("include/footer.php");
	
?>

