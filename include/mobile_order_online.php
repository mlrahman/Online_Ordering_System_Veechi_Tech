<!-- Item Succcessdully Added to cart notification -->
<div id="mocart_notification" class="w3-bar w3-red w3-animate-opacity w3-hide-large" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-medium" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Successfully Added to Cart</p>
</div>

<div id="modiscount_applied" class="w3-bar w3-green w3-animate-opacity w3-hide-large" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-medium" style="margin:0px;padding:0px;"><i class="" style="font-family:Arial;" id="modiscount_percentage" ></i> Discount Applied Successfully. <i style="font-family:Arial;" id="modiscount_condition"></i></p>
</div>

<div id="modiscount_invalid" class="w3-bar w3-red w3-animate-opacity w3-hide-large" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-medium" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Invalid Coupon Code</p>
</div>

<div id="modiscount_expired" class="w3-bar w3-red w3-animate-opacity w3-hide-large" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-medium" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Coupon Code Expired</p>
</div>

<div id="modiscount_already" class="w3-bar w3-red w3-animate-opacity w3-hide-large" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-medium" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Coupon Code Already Applied</p>
</div>



<script>
	
	function mostop_coupon()
	{
		document.getElementById('modiscount_applied').style.display='none';
		document.getElementById('modiscount_expired').style.display='none';
		document.getElementById('modiscount_invalid').style.display='none';
		document.getElementById('modiscount_already').style.display='none';
	}
	
</script>

<!-- My Order Box -->
<div id="mocart_box" class="w3-container w3-hide-large w3-light-gray w3-animate-bottom" style="height:100%;width:100%;position:fixed;bottom:0px;left:0px;z-index:999997;overflow:scroll;display:none;">
	<h3 class="w3-bold w3-left-align" style="margin:12px 0px 8px 0px;padding:0px;">My Order</h3>
	<div id="mocart_items" class="w3-container w3-border-top w3-light-gray" style="margin:0px;padding:8px 10px 0px 5px;height:auto;max-height:203px;overflow:auto;">
		<?php
			//Submit for apply coupon code mobile
			if(isset($_REQUEST['mosubmit_coupon_code']))
			{
				$mocoupon_code=trim($_REQUEST['mocoupon_code']);
				//Another Testing
				//echo '<script> alert("'.$coupon_code.'"); </script>';
				$mocart_coupon="".$_SESSION['cart_coupon'];
				//echo '<script> alert("'.$cart_coupon.'"); </script>';
				if($mocart_coupon==$mocoupon_code)
				{
					//echo '<script> alert("Oh Nooooo"); </script>';
					echo '<script>document.getElementById("modiscount_already").style.display="block"; setTimeout(mostop_coupon,2000);</script>';
				}
				else
				{
					$today=strtotime(get_coupon_date()); //Get today's date YYYY-MM-DD
					$fl=0; 
					try
					{
						$stmt2 = $conn->prepare("select * from offer_coupon where status='active' AND offer_coupon_code=:mocoupon_code order by offer_id asc ");
						$stmt2->execute(array('mocoupon_code'=>$mocoupon_code));
						$list2 = $stmt2->fetchAll(); 
						foreach($list2 as $row2)
						{
							$fl++;
							$start=strtotime($row2['offer_start_date']);
							$end=strtotime($row2['offer_end_date']);
							if($today>=$start && $today<=$end)
							{
								//Apply Coupon Code successfully
								$_SESSION['cart_coupon']=$mocoupon_code;
								echo '<script> document.getElementById("modiscount_percentage").innerHTML="'.$row2['offer_in_percentage'].'%"; document.getElementById("modiscount_condition").innerHTML="At Order Over &pound;'.$row2['offer_conditional_amount'].'"; document.getElementById("modiscount_applied").style.display="block"; setTimeout(mostop_coupon,2000);</script>';
							}
							else
							{
								//Expired
								echo '<script>document.getElementById("modiscount_expired").style.display="block"; setTimeout(mostop_coupon,2000);</script>';
							}
						}
					}
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
				}
				if($fl==0)
				{
					//Invalid Coupon code
					echo '<script>document.getElementById("modiscount_invalid").style.display="block"; setTimeout(mostop_coupon,2000);</script>';
				}
				
			}
			
			$modiscount_percentage=0;
			$modiscount_condition=0.0;
			if(isset($_SESSION['cart_coupon']))
			{
				$mocart_coupon=$_SESSION['cart_coupon'];
				try 
				{
					$stmt2 = $conn->prepare("select * from offer_coupon where status='active' AND offer_coupon_code='$mocart_coupon' order by offer_id asc ");
					$stmt2->execute();
					$list2 = $stmt2->fetchAll(); 
					foreach($list2 as $row2)
					{
						$modiscount_percentage=$row2['offer_in_percentage'];
						$modiscount_condition=$row2['offer_conditional_amount'];
					}
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
			}
			
			
			$mototal_items=0;
			$mointotal_items=0;
			$mosubtotal_amount=0.0;
			$modiscount_amount=0.0;
			$mototal_amount=0.0;
			if(isset($_SESSION['cart_item']) and isset($_SESSION['cart_item_quantity']))
			{
				$mofood_name="";
				$mofood_price=0.0;
				foreach($_SESSION['cart_item'] as $item) //it will hold food id
				{	
					$mototal_items++;
					try
					{
						$stmt2 = $conn->prepare("select * from food where status='active' AND food_id='$item' order by food_id asc ");
						$stmt2->execute();
						$list2 = $stmt2->fetchAll(); 
						foreach($list2 as $row2)
						{
							$mofood_name=$row2['food_name'];
							$mofood_price=$row2['food_price'];
						}
					}
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
		?>
			<!-- A single item in cart -->
			<div class="w3-row w3-border-bottom" id="mocart_item_<?php echo $item; ?>" onmouseover="moshow_cart_option('<?php echo $item; ?>')" onmouseout="mohide_cart_option('<?php echo $item; ?>');" style="cursor:pointer;padding:7px 0px 0px 0px;">
				<!-- No of Item Details in Cart -->
				<div class="w3-col" style="width:15%;padding: 0px 2px;">
					<!--Cart A single Item qty -->
					<p id="mono_of_item_<?php echo $item; ?>" class="w3-small w3-opacity w3-left-align" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;"><?php echo $_SESSION['cart_item_quantity'][$item]; ?> x</p>
					<!--Cart A single Item qty change option -->
					<div id="mono_of_button_<?php echo $item; ?>" class="w3-container" style="display:none;margin:0px;padding:0px;width:100%;">
						<p class="w3-tiny w3-center w3-border w3-border-black" onclick="moplus_cart_item('<?php echo $item; ?>')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-plus"></i></p>
						<p class="w3-tiny w3-center w3-border w3-border-black" id="movalue_<?php echo $item; ?>" style="margin:0px;width:18px;padding: 0px;font-family:Arial;"></p>
						<p class="w3-tiny w3-center w3-border w3-border-black" onclick="mominus_cart_item('<?php echo $item; ?>')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-minus"></i></p>
					</div>
				</div>
				<!-- A single item title -->
				<div class="w3-col" style="width:65%;padding: 23px 2px;">
					<p class="w3-left-align w3-small w3-opacity" style="margin:0px;padding:0px;font-family:Arial;">
						<?php echo $mofood_name; ?>
					</p>
				</div>
				
				<!-- Item Amount details in cart -->
				<div class="w3-col" style="width:20%;padding: 0px 2px;">
					<!-- A single item price -->
					<p id="moclose_item_<?php echo $item; ?>" class="w3-right-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;"><?php $mofood_qty=$_SESSION['cart_item_quantity'][$item]; $mointotal_items+=$mofood_qty; $mosingle_amount=($mofood_price*$mofood_qty); $mosingle_amount=number_format($mosingle_amount, 2, '.', ''); echo $mosingle_amount; $mosubtotal_amount+=$mosingle_amount; ?></p>
					<!-- A single item remove option --> 
					<p id="moclose_button_<?php echo $item; ?>" class="w3-right-align w3-large w3-opacity" style="display:none;margin:17px 0px 0px 0px;padding:0px;font-family:Arial;"><i class="fa fa-window-close-o" onclick="mocart_item_close('<?php echo $item; ?>')"></i></p>
				</div>
			</div>
		<?php
				}
			}
		?>
	</div>
	
	<!-- Discount will show here -->
	<div id="mocart_discount" class="w3-container w3-border-top" style="margin:0px;padding:10px 0px 10px 0px;">
		<p class="w3-small w3-bold w3-left-align" style="pading:0px;margin:0px;">Discounts & Offers</p>
		<div class="w3-row" style="margin:0px;padding:0px;">
			<form action="order_online.php" method="post" autocomplete="off">
				<div class="w3-col" style="width:80%;margin:0px;padding:3px 0px 0px 0px;"><input placeholder=" Enter Coupon Code" name="mocoupon_code" class="w3-input-modified w3-small w3-round w3-border" style="width:100%;height:24px;" /></div>
				<div class="w3-col" style="width:20%;margin:0px;padding:3px 0px 0px 4px;"><input type="submit" name="mosubmit_coupon_code" value="Apply" class="w3-button w3-red w3-round w3-small" style="margin:0px;width:100%;height:24px;padding:2px 0px;"></div>	
			</form>
		</div>
	</div>
	
	<!-- Amount will show here -->
	<div id="mocart_amount" class="w3-container w3-border-top" style="margin:0px 0px 30px 0px;padding:0px 0px 10px 0px;">
		<!-- Sub Total -->
		<div class="w3-row" style="padding:0px;margin:0px;">
			<div class="w3-col w3-left-align" style="width:50%;padding:4px;margin:0px;"><p class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">Subtotal:</p></div>
			<div class="w3-col w3-right-align" style="width:50%;padding:4px;margin:0px;"><p id="mosubtotal_amount" class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;"><?php $sss=number_format($mosubtotal_amount, 2, '.', ''); echo $sss; ?></p></div>
		</div>
		<!-- Discount --> 
		<div class="w3-row" style="padding:0px;margin:0px;">
			<div class="w3-col w3-left-align" style="width:50%;padding:4px;margin:0px;"><p class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">Discount:</p></div>
			<div class="w3-col w3-right-align" style="width:50%;padding:4px;margin:0px;"><p id="modiscount_amount" class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;"><?php if($sss>=$modiscount_condition){  $modiscount_amount=($sss/100.0)*$modiscount_percentage; echo number_format($modiscount_amount, 2, '.', ''); } else {  echo number_format($modiscount_amount, 2, '.', ''); }  ?></p></div>
		</div>
		<!-- Total -->
		<div class="w3-row" style="padding:0px;margin:0px;">
			<div class="w3-col w3-left-align" style="width:50%;padding:6px 0px 4px 4px;margin:0px;"><p class="w3-medium" style="font-family:Arial;padding:0px;margin:0px;">Total:</p></div>
			<div class="w3-col w3-right-align" style="width:50%;padding:0px 4px 0px 0px;margin:0px;"><p id="mototal_amount" class="w3-xlarge" style="font-family:Arial;padding:0px;margin:0px;">&pound; <?php $mototal_amount=number_format(($mosubtotal_amount-$modiscount_amount), 2, '.', ''); echo $mototal_amount; ?></p></div>
		</div>
	</div>
	
</div>

<!-- Cart bar -->
<div id="mocart_bar" class="w3-row w3-light-gray w3-border-top w3-border-shadow w3-hide-large" style="width:100%;position:fixed;z-index:999999;bottom:0px;left:0px;">
	<div class="w3-col w3-border-right" style="width:25%;padding:10px 0px 6px 0px;margin:0px;cursor:pointer;" onclick="show_mocart_box()"> 
		<p class="w3-medium w3-text-red" style="padding:0px;margin:0px;font-family:Arial;"><i class="fa fa-cart-arrow-down" id="mocart_total_items"> <?php echo $mointotal_items; ?></i></p>
	</div>
	<div class="w3-col w3-border-right" style="width:45%;padding:10px 0px 6px 0px;margin:0px;">
		<p class="w3-medium w3-text-red" id="mobar_total_amount" style="padding:0px;margin:0px;font-family:Arial;">Total: &pound;<?php $mototal_amount=number_format(($mosubtotal_amount-$modiscount_amount), 2, '.', ''); echo $mototal_amount; ?></p>
	</div>
	<?php 
		if(isset($_SESSION['logged_in']))
		{
	?>
		<div class="w3-col w3-button w3-red w3-medium" style="width:30%;margin:0px;padding:10px 0px 6px 0px;" onclick="document.getElementById('pay_subtotal_amount').innerHTML=document.getElementById('mosubtotal_amount').innerHTML;document.getElementById('pay_discount_amount').innerHTML=document.getElementById('modiscount_amount').innerHTML;document.getElementById('pay_total_amount').innerHTML=document.getElementById('mototal_amount').innerHTML;document.getElementById('my_payment').style.display='block';">
			Checkout
		</div>
	<?php
		}
		else
		{
	?>
		<div class="w3-col w3-button w3-red w3-medium" style="width:30%;margin:0px;padding:10px 0px 6px 0px;" onclick="document.getElementById('pls_sign_in').style.display='block';setTimeout(stop_pls_sign_in,1800);">
			Checkout
		</div>
	<?php
		}
	?>
</div>

<?php if($mointotal_items==0){ ?>
	<script>
		document.getElementById('mocart_bar').style.display='none';
	</script>
<?php } ?>

<!-- Date and Time Section -->
<div class="w3-container w3-hide-large" style="margin:-25px 0px 0px 0px;">
	<div class="w3-container w3-round w3-light-gray w3-border w3-border-shadow">
		<div class="w3-container" style="padding:0px;">
			<div class="w3-container w3-light-gray" style="padding:0px;">
				<h4 class="w3-medium w3-bold w3-left-align" style="font-family:Arial;">
					Today's Opening Hours: 
					<?php
						try
						{
							$stmt = $conn->prepare("select * from opening_time where status='active' order by opening_id asc ");
							$stmt->execute();
							$list = $stmt->fetchAll(); 
							foreach($list as $row)
							{
								echo $row[strtolower(Date("l"))]; 
							}
						}
						catch(PDOException $e) {
							echo "Error: " . $e->getMessage();
						}
					?>
				</h4>
			</div>
			<div class="w3-container w3-light-gray w3-right-align" style="padding:0px;">
				<?php 
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
				?>
						<div class="w3-dropdown-hover w3-right w3-light-gray"  style="margin:0px 0px 8px 0px;padding:0px;">
							<h4 onmouseover="document.getElementById('momy_profile_menu').classList.add('fa-caret-square-o-down');" onmouseout="document.getElementById('momy_profile_menu').classList.remove('fa-caret-square-o-down');" class="w3-button w3-medium w3-bold w3-center w3-round w3-hover-black w3-border" style="padding:5px 9px 3px 7px;margin:0px;"><img  id="mobile_image" src="images/customer/<?php if($list[0]['image']!=""){ echo $list[0]['image']; } else { echo 'default.png'; } ?>" class="w3-image w3-round w3-border" style="width:100%;max-width:22px;height:25px;margin:-5px 0px 0px -2px;padding:0px;"/> <a id="mobile_profile_name">Hi! <?php echo $list[0]['first_name']; ?></a> <i id="momy_profile_menu" class="fa " style="margin:0px 0px 0px 3px;padding:0px;"></i></h4>
							<div class="w3-dropdown-content w3-bar-block w3-border w3-light-gray w3-medium w3-bold" onmouseover="document.getElementById('momy_profile_menu').classList.add('fa-caret-square-o-down');" onmouseout="document.getElementById('momy_profile_menu').classList.remove('fa-caret-square-o-down');" style="right:0;width:140px;">
							  <a onclick="document.getElementById('update_profile').style.display='block';" class="w3-bar-item w3-button w3-hover-black w3-border-bottom"><i class="fa fa-user"></i> My Profile</a>
							  <a onclick="document.getElementById('my_orders').style.display='block';" class="w3-bar-item w3-button w3-hover-black w3-border-bottom"><i class="fa fa-shopping-bag"></i> My Orders</a>
							  <a href="logout.php?access=YES&link=<?php echo sha1($id); ?>" class="w3-bar-item w3-button w3-hover-black"><i class="fa fa-sign-out"></i> Log Out</a>
							</div>
						</div> 
				<?php
					}
					else
					{
				?>
						<h4 class="w3-medium w3-right-align"><a class="w3-hover-bold" style="text-decoration:none;" onclick="document.getElementById('sign_up_form').style.display='none';document.getElementById('sign_in_form').style.display='block';document.getElementById('sign_form').style.display='block';"><i class="fa fa-sign-in"></i> Sign In</a> <a class="w3-hover-bold" style="text-decoration:none;margin-left:20px;" onclick="document.getElementById('sign_in_form').style.display='none';document.getElementById('sign_up_form').style.display='block';document.getElementById('sign_form').style.display='block';"><i class="fa fa-user-plus"></i> Sign Up</a></h4>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>

<div class="w3-container  w3-hide-large" style="margin:15px 0px 0px 0px;">
	
	<div class="w3-container" style="padding:0px;">
		
		<div class="w3-container w3-light-gray w3-round w3-border w3-border-shadow" style="padding:0px;">
			<!-- Menu or Offer -->
			<div class="w3-container">
				<div class="w3-left">
					<div>
						<a id="momenu_btn" onclick="momenu_active()" class="w3-bar-item w3-button w3-hover-white w3-white w3-hover-opacity-off" style="border-bottom: 2px solid black;margin-bottom:2px;"><i class="fa fa-cutlery"></i> Menu</a>
						<a id="mooffer_btn" onclick="mooffer_active()" class="w3-bar-item w3-button w3-opacity w3-hover-opacity-off" style="margin-bottom:2px;"><i class="fa fa-asterisk"></i> Offer</a>
					</div>
					<script>
						function momenu_active()
						{
							document.getElementById('mooffer_btn').style.border='0px';
							document.getElementById('mooffer_btn').classList.remove('w3-white');
							document.getElementById('mooffer_btn').classList.add('w3-opacity');
							
							document.getElementById('momenu_btn').classList.remove('w3-opacity');
							document.getElementById('momenu_btn').classList.add('w3-white');
							document.getElementById('momenu_btn').style.borderBottom='2px solid black';
							document.getElementById('momenu_items').style.display='block';
							document.getElementById('mooffer_items').style.display='none';
							flag_offer=0;
						}
						function mooffer_active()
						{
							document.getElementById('momenu_btn').style.border='0px';
							document.getElementById('momenu_btn').classList.remove('w3-white');
							document.getElementById('momenu_btn').classList.add('w3-opacity');
							
							document.getElementById('mooffer_btn').classList.remove('w3-opacity');
							document.getElementById('mooffer_btn').classList.add('w3-white');
							document.getElementById('mooffer_btn').style.borderBottom='2px solid black';
							
							document.getElementById('momenu_items').style.display='none';
							document.getElementById('mooffer_items').style.display='block';
							flag_offer=1;
						}
					
					</script>
				</div>
			</div>
			<!-- Other Content -->
			
			<div id="momenu_items" class="w3-container w3-border-top" style="padding:10px 0px 40px 0px;margin:0px;min-height:300px;height:auto;">
				<div class="w3-container" style="margin:0px;padding:0px;">
					
					<!-- Menu Items -->
					<div class="w3-container">
					
						<?php
							try
							{
								$stmt = $conn->prepare("select * from food_category where status='active' order by category_id asc ");
								$stmt->execute();
								$list = $stmt->fetchAll(); 
								foreach($list as $row)
								{
						?>
							<!-- Moile menu items -->
							<div id="mo<?php echo $row['category_id']; ?>" class="w3-container" style="margin:0px;padding:0px;">
								<div class="w3-container w3-border" style="padding:0px 0px 0px 10px;">
									<h2 id="text<?php echo $row['category_id']; ?>" class="w3-bold w3-medium w3-left-align"  style="font-family:Arial;"><?php echo $row['category_name']; ?></h2>
								</div>
								<?php
									try
									{
										$stmt2 = $conn->prepare("select * from food where status='active' AND category_id='$row[category_id]' order by food_id asc ");
										$stmt2->execute();
										$list2 = $stmt2->fetchAll(); 
										foreach($list2 as $row2)
										{
								?>

									<!-- A single Item -->
									<div class="w3-container w3-border-bottom" style="padding:0px;">
										<div class="w3-container" style="padding:0px;">
											<!-- Item Name -->
											<div class="w3-container" style="padding:0px 0px 0px 10px;">
												<h3 class="w3-bold w3-medium w3-left-align" style="font-family:Arial;" id="mofood_name_<?php echo $row2['food_id']; ?>"><?php echo $row2['food_name']; ?></h3>
											</div>	
										</div>
										
										<!--Items amount details if available -->
										<?php 
											if(trim($row2['food_summary'])!=""){ 
										?>
											<div class="w3-container" style="padding:0px 0px 0px 10px;">
												<p class="w3-text-red w3-left-align" style="padding:0px;margin:0px;font-family:Arial;"><?php echo $row2['food_summary']; ?></p>
											</div>
										<?php
											}
										?>
										
										<!--Item Details -->
										<?php 
											if(trim($row2['food_description'])!=""){ 
										?>
											<div class="w3-container" style="padding:0px 10px 0px 10px;">
												<p class="w3-small w3-left-align">
													<?php echo $row2['food_description']; ?>
												</p>
											</div>
										<?php
											}
										?>
										<!-- Price and Add option -->
										<p id="mofood_price_<?php echo $row2['food_id']; ?>" style="margin:0px;padding:0px;display:none;"><?php echo $row2['food_price']; ?></p>
							
										<div class="w3-container" style="overflow-wrap: normal;">
											<h3 class="w3-bold w3-large w3-right-align" style="font-family:Arial;">&pound; <?php echo $row2['food_price']; ?> <i class="w3-xlarge fa fa-plus-square-o" style="margin-left:10px;cursor:pointer;" onclick="moadd_to_cart(<?php echo $row2['food_id']; ?>)"></i></h3>
										</div>
									</div>
								<?php
										}
									}
									catch(PDOException $e) {
										echo "Error: " . $e->getMessage();
									}
								?>
							</div> 
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
						?>
						
					</div>
				</div>
			</div>
			
			<div id="mooffer_items" class="w3-container w3-border-top" style="display:none;padding:0px 5px 80px 5px;margin:0px;min-height:300px;height:auto;">
				
				<?php
					try
					{
						$stmt = $conn->prepare("select * from offer_coupon where status='active' and visibility='1' order by offer_id desc ");
						$stmt->execute();
						$list = $stmt->fetchAll(); 
						foreach($list as $row)
						{
				?>
							<!-- Offer details goes here -->
							<div class="w3-container w3-topbar w3-bottombar" style="margin:10px 0px 10px 0px;padding:0px;">
								<div class="w3-container w3-border w3-white" style="padding:5px;">
									<h2 class="w3-bold w3-medium w3-left-align" style="font-family:Arial;margin:0px;">
										<i class="fa fa-certificate"></i>
										<?php echo $row['offer_title']; ?>
									</h2>
									<p class="w3-text-teal w3-left-align w3-bold w3-small" style="padding:0px;margin:0px 0px 0px 16px;font-family:Arial;">Offer Coupon Code: "<?php echo $row['offer_coupon_code']; ?>"</p>
								</div>
								<div class="w3-container w3-light-gray w3-small w3-left-align w3-border-left w3-border-right" style="padding:5px;margin:0px;min-height:50px;height:auto;">
									<?php echo $row['offer_details']; ?>
								</div>
								<div class="w3-row w3-white w3-border w3-small" style="margin:0px;padding:5px;">
									<div class="w3-col w3-left-align w3-text-red w3-bold" style="width:100%;margin:0px;padding:5px;font-family:Arial;">
										Condition: On Orders Over &pound;<?php echo $row['offer_conditional_amount']; ?>
									</div>
									<div class="w3-col w3-left-align w3-text-green w3-bold w3-border-top" style="width:100%;margin:0px;padding:5px;font-family:Arial;">
										Validity: <?php echo $row['offer_start_date']; ?> to <?php echo $row['offer_end_date']; ?>
									</div>
								</div>
							</div>
				<?php
						}
						if(count($list)<=0)
						{
							echo '<h1 class="w3-text-red w3-bold w3-large" style="margin-top:100px;"> Sorry no offer available</h1>';
						}
					}
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
				?>				
				
			</div>
		</div>
	</div>
</div>
<script>
	var mototal_unique_item=<?php echo $mototal_items; ?>;
	var mointotal_items=<?php echo $mointotal_items; ?>;
	var mosubtotal_amount=<?php echo $mosubtotal_amount; ?>;
	var modiscount_amount=<?php echo $modiscount_amount; ?>;
	var modiscount_percentage=<?php echo $modiscount_percentage; ?>;
	var modiscount_condition=<?php echo $modiscount_condition; ?>;

	//Mobile cart goes here
	var mocart_box_flag=0;
	function show_mocart_box()
	{
		if(mocart_box_flag==0)
		{
			document.getElementById('mocart_box').style.display='block';
			mocart_box_flag=1;
		}
		else if(mocart_box_flag==1)
		{
			document.getElementById('mocart_box').style.display='none';
			mocart_box_flag=0;
		}
	
	}
	function moshow_cart_option(id)
	{
		//Value Edit of Item
		var value=document.getElementById('mono_of_item_'+id).innerHTML;
		var i,len=value.length;
		var x="";
		for(i=0;i<len;i++)
		{
			if(value[i]==' ')
				break;
			x=x+value[i];
		}
		document.getElementById('mono_of_item_'+id).style.display='none';
		document.getElementById('mono_of_button_'+id).style.display='block';
		document.getElementById('movalue_'+id).innerHTML=x;
		// View Close Option
		document.getElementById('moclose_item_'+id).style.display='none';
		document.getElementById('moclose_button_'+id).style.display='block';
	}
	function mohide_cart_option(id)
	{
	
		//Value Edit of Item
		document.getElementById('mono_of_button_'+id).style.display='none';
		document.getElementById('mono_of_item_'+id).style.display='block';
		
		//hide Close Option
		document.getElementById('moclose_button_'+id).style.display='none';
		document.getElementById('moclose_item_'+id).style.display='block';
	}
	function moadd_to_cart(id)
	{
		//Show cart notification
		document.getElementById('mocart_notification').style.display='block';
		//show cart bar
		document.getElementById('mocart_bar').style.display='block';
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
				
            }
        };
		
		if(document.getElementById("mocart_item_"+id))
		{
			if(document.getElementById("mocart_item_"+id).style.display=='none')
			{
				
				mototal_unique_item=mototal_unique_item+1;
				mointotal_items=mointotal_items+1;
				//console.log("YES");
				var mofood_price=document.getElementById('mofood_price_'+id).innerHTML;
				document.getElementById("mono_of_item_"+id).innerHTML='1 x';
				document.getElementById("moclose_item_"+id).innerHTML=mofood_price;
				document.getElementById("mocart_item_"+id).style.display='block';
				//document.getElementById("mocart_items").scrollTop=0;
				//document.getElementById("mocart_items").scrollTop=document.getElementById("mocart_item_"+id).offsetTop-60;
				mosubtotal_amount=mosubtotal_amount+parseFloat(mofood_price);
			}
			else
			{
				//Already added in cart so increase
				mointotal_items=mointotal_items+1;
				var value=document.getElementById('mono_of_item_'+id).innerHTML;
				var i,len=value.length;
				var x="";
				for(i=0;i<len;i++)
				{
					if(value[i]==' ')
						break;
					x=x+value[i];
				}
				var y=parseInt(x);
				y=y+1;
				document.getElementById('mono_of_item_'+id).innerHTML=y+" x";
				var z=document.getElementById('mofood_price_'+id).innerHTML;
				var zz=parseFloat(z);
				var yy=(y*zz*1.0);
				var yyy=yy.toFixed(2);
				document.getElementById('moclose_item_'+id).innerHTML=yyy;
				//document.getElementById("mocart_items").scrollTop=0;
				//document.getElementById("mocart_items").scrollTop=document.getElementById("mocart_item_"+id).offsetTop-60;
				mosubtotal_amount=mosubtotal_amount+zz;
			}
		}
		else
		{
			mototal_unique_item=mototal_unique_item+1;
			mointotal_items=mointotal_items+1;
			var mofood_name=document.getElementById('mofood_name_'+id).innerHTML;
			var mofood_price=document.getElementById('mofood_price_'+id).innerHTML;  //////////////
			var a='<div class="w3-row w3-border-bottom" id="mocart_item_'+id+'" onmouseover="moshow_cart_option(\''+id+'\')" onmouseout="mohide_cart_option(\''+id+'\');" style="cursor:pointer;"><div class="w3-col" style="width:15%;padding: 0px 2px;">'
					+'<p id="mono_of_item_'+id+'" class="w3-left-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;">1 x</p>'
					+'<div id="mono_of_button_'+id+'" class="w3-container" style="display:none;margin:0px;padding:0px;width:100%;">'
					+'<p class="w3-tiny w3-center w3-border w3-border-black" onclick="moplus_cart_item(\''+id+'\')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-plus"></i></p>'
					+'<p class="w3-tiny w3-center w3-border w3-border-black" id="movalue_'+id+'" style="margin:0px;width:18px;padding: 0px;font-family:Arial;"></p>'
					+'<p class="w3-tiny w3-center w3-border w3-border-black" onclick="mominus_cart_item(\''+id+'\')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-minus"></i></p>'
					+'</div>'
					+'</div>'
					+'<div class="w3-col" style="width:65%;padding: 23px 2px;">'
					+'<p class="w3-left-align w3-small w3-opacity" style="margin:0px;padding:0px;font-family:Arial;">'
					+mofood_name
					+'</p>'
					+'</div>'
					+'<div class="w3-col" style="width:20%;padding: 0px 2px;">'
					+'<p id="moclose_item_'+id+'" class="w3-right-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;">'
					+mofood_price
					+'</p>'
					+'<p id="moclose_button_'+id+'" class="w3-right-align w3-large w3-opacity" style="display:none;margin:17px 0px 0px 0px;padding:0px;font-family:Arial;"><i class="fa fa-window-close-o" onclick="mocart_item_close(\''+id+'\')"></i></p>'
					+'</div>'
					+'</div>';
			document.getElementById("mocart_items").innerHTML=document.getElementById("mocart_items").innerHTML+a;
			//document.getElementById("mocart_items").scrollTop=0;
			//document.getElementById("mocart_items").scrollTop=document.getElementById("mocart_item_"+id).offsetTop;
			mosubtotal_amount=mosubtotal_amount+parseFloat(mofood_price);
		}
		document.getElementById('mosubtotal_amount').innerHTML=mosubtotal_amount.toFixed(2);
		// Discount Calculation
		if(mosubtotal_amount>=modiscount_condition)
		{
			modiscount_amount=(mosubtotal_amount/100.0)*modiscount_percentage;
		}
		else
			modiscount_amount=0.00;
		
		
		document.getElementById('modiscount_amount').innerHTML=modiscount_amount.toFixed(2);
		document.getElementById('mocart_total_items').innerHTML=' '+mointotal_items;
		document.getElementById('mototal_amount').innerHTML='&pound; '+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		document.getElementById('mobar_total_amount').innerHTML='Total: &pound;'+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		xmlhttp.open("GET", "include/cart_item_add.php?do_it=YES&id="+id, true);
        xmlhttp.send();
		
		//hiding notification bar after 550 ms
		setTimeout(mostop_notification,550); 
	}
	function mostop_notification()
	{
		var x=document.getElementById('mocart_notification');
		x.style.display='none';
	}
	
	function mocart_item_close(id)
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
            }
        };
		
		var z=document.getElementById('moclose_item_'+id).innerHTML;
		var zz=parseFloat(z);
		mosubtotal_amount=mosubtotal_amount-zz;
		document.getElementById('mosubtotal_amount').innerHTML=mosubtotal_amount.toFixed(2);
		// Discount Calculation
		if(mosubtotal_amount>=modiscount_condition)
		{
			modiscount_amount=(mosubtotal_amount/100.0)*modiscount_percentage;
		}
		else
			modiscount_amount=0.00;
		
		document.getElementById('modiscount_amount').innerHTML=modiscount_amount.toFixed(2);
		document.getElementById('mototal_amount').innerHTML='&pound; '+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		document.getElementById('mobar_total_amount').innerHTML='Total: &pound;'+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		
		
		var value=document.getElementById('mono_of_item_'+id).innerHTML;
		var i,len=value.length;
		var x="";
		for(i=0;i<len;i++)
		{
			if(value[i]==' ')
				break;
			x=x+value[i];
		}
		var y=parseInt(x);
		
		mointotal_items=mointotal_items-y;
		document.getElementById('mocart_total_items').innerHTML=' '+mointotal_items;
		
		document.getElementById("mocart_item_"+id).style.display='none';
		mototal_unique_item=mototal_unique_item-1;
		if(mototal_unique_item==0)
		{
			//hide empty cart box
			document.getElementById('mocart_box').style.display='none';
			//hide empty cart bar
			document.getElementById('mocart_bar').style.display='none';
			
			modiscount_percentage=0;
		}
		xmlhttp.open("GET", "include/cart_item_close.php?do_it=YES&id="+id, true);
        xmlhttp.send();
	}
	
	function moplus_cart_item(id)
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
				
            }
        };
		
		var value=document.getElementById('mono_of_item_'+id).innerHTML;
		var i,len=value.length;
		var x="";
		for(i=0;i<len;i++)
		{
			if(value[i]==' ')
				break;
			x=x+value[i];
		}
		var y=parseInt(x);
		y=y+1;
		mointotal_items=mointotal_items+1;
		document.getElementById('mocart_total_items').innerHTML=' '+mointotal_items;
		
		document.getElementById('mono_of_item_'+id).innerHTML=y+" x";
		document.getElementById('movalue_'+id).innerHTML=y;
		var z=document.getElementById('mofood_price_'+id).innerHTML;
		var zz=parseFloat(z);
		var yy=(y*zz*1.0);
		var yyy=yy.toFixed(2);
		document.getElementById('moclose_item_'+id).innerHTML=yyy;
		mosubtotal_amount=mosubtotal_amount+zz;
		document.getElementById('mosubtotal_amount').innerHTML=mosubtotal_amount.toFixed(2);
		// Discount Calculation
		if(mosubtotal_amount>=modiscount_condition)
		{
			modiscount_amount=(mosubtotal_amount/100.0)*modiscount_percentage;
		}
		else
			modiscount_amount=0.00;
		
		document.getElementById('modiscount_amount').innerHTML=modiscount_amount.toFixed(2);
		document.getElementById('mototal_amount').innerHTML='&pound; '+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		document.getElementById('mobar_total_amount').innerHTML='Total: &pound;'+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		
		xmlhttp.open("GET", "include/cart_item_plus.php?do_it=YES&id="+id, true);
        xmlhttp.send();
	}
	
	function mominus_cart_item(id)
	{
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
				
            }
        };
		
		var value=document.getElementById('mono_of_item_'+id).innerHTML;
		var i,len=value.length;
		var x="";
		for(i=0;i<len;i++)
		{
			if(value[i]==' ')
				break;
			x=x+value[i];
		}
		var y=parseInt(x);
		var z=document.getElementById('mofood_price_'+id).innerHTML;
		var zz=parseFloat(z);
		
		if(y==1) //Only single Item Available
		{
			mototal_unique_item=mototal_unique_item-1;
			y=y-1;
			if(mototal_unique_item<=0) //This is the last item in cart
			{
				document.getElementById('mocart_item_'+id).style.display='none';
				//hide empty cart box
				document.getElementById('mocart_box').style.display='none';
				//hide empty cart bar
				document.getElementById('mocart_bar').style.display='none';
				
				modiscount_percentage=0;
			}
			else //This is not the last item in cart
			{
				document.getElementById('mocart_item_'+id).style.display='none';
			}
		}
		else //More than one qty of a Item
		{
			y=y-1;
			document.getElementById('mono_of_item_'+id).innerHTML=y+" x";
			document.getElementById('movalue_'+id).innerHTML=y;
			var yy=(y*zz*1.0);
			var yyy=yy.toFixed(2);
			document.getElementById('moclose_item_'+id).innerHTML=yyy;			
		}
		mointotal_items=mointotal_items-1;
		document.getElementById('mocart_total_items').innerHTML=' '+mointotal_items;
		
		
		mosubtotal_amount=mosubtotal_amount-zz;
		document.getElementById('mosubtotal_amount').innerHTML=mosubtotal_amount.toFixed(2);
		// Discount Calculation
		if(mosubtotal_amount>=modiscount_condition)
		{
			modiscount_amount=(mosubtotal_amount/100.0)*modiscount_percentage;
		}
		else
			modiscount_amount=0.00;
		
		document.getElementById('modiscount_amount').innerHTML=modiscount_amount.toFixed(2);
		document.getElementById('mototal_amount').innerHTML='&pound; '+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		document.getElementById('mobar_total_amount').innerHTML='Total: &pound;'+(mosubtotal_amount.toFixed(2)-modiscount_amount.toFixed(2)).toFixed(2);
		
		
		xmlhttp.open("GET", "include/cart_item_minus.php?do_it=YES&id="+id, true);
        xmlhttp.send();
	}
	
	
	function scrollFunction2() {
		<?php
			try
			{
				$stmt = $conn->prepare("select * from food_category where status='active' order by category_id desc ");
				$stmt->execute();
				$list = $stmt->fetchAll(); 
				
				foreach($list as $row)
				{			
		?>
		
			//Must be descending order with topposition
			if ((document.body.scrollTop+60)>= document.getElementById("mo<?php echo $row['category_id']; ?>").offsetTop || (document.documentElement.scrollTop+60)>=document.getElementById("mo<?php echo $row['category_id']; ?>").offsetTop) {
				document.getElementById("menu_text").innerHTML=document.getElementById("text<?php echo $row['category_id']; ?>").innerHTML;  
				return;
			}
		
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		?>
		
	}
	
	<!-- Food Menu show hide -->
	var menuSidebar = document.getElementById("menuSidebar");

	function food_menu_open() {
		if (menuSidebar.style.display === 'block') {
			menuSidebar.style.display = 'none';
		} else {
			menuSidebar.style.display = 'block';
		}
	}

	// Close the sidebar with the close button
	function food_menu_close() {
		menuSidebar.style.display = "none";
	}
	
</script>