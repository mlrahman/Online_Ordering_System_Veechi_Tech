<!-- Item Succcessdully Added to cart notification -->
<div id="cart_notification" class="w3-bar w3-red w3-animate-opacity w3-hide-small w3-hide-medium" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Successfully Added to Cart</p>
</div>

<!-- Coupon code Notification -->
<div id="discount_applied" class="w3-bar w3-green w3-animate-opacity w3-hide-small w3-hide-medium" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large" style="margin:0px;padding:0px;"><i class="" style="font-family:Arial;" id="discount_percentage" ></i> Discount Applied Successfully. <i style="font-family:Arial;" id="discount_condition"></i></p>
</div>

<div id="discount_invalid" class="w3-bar w3-red w3-animate-opacity w3-hide-small w3-hide-medium" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Invalid Coupon Code</p>
</div>

<div id="discount_expired" class="w3-bar w3-red w3-animate-opacity w3-hide-small w3-hide-medium" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Coupon Code Expired</p>
</div>

<div id="discount_already" class="w3-bar w3-red w3-animate-opacity w3-hide-small w3-hide-medium" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
	<p class="w3-large" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Coupon Code Already Applied</p>
</div>


<script>
	
	function stop_coupon()
	{
		document.getElementById('discount_applied').style.display='none';
		document.getElementById('discount_expired').style.display='none';
		document.getElementById('discount_invalid').style.display='none';
		document.getElementById('discount_already').style.display='none';
	}
	
</script>

<!-- Date and Time Section -->
<div class="w3-container w3-hide-small w3-hide-medium" style="margin:-25px 0px 0px 0px;">
	<div class="w3-container w3-round w3-light-gray w3-border w3-border-shadow">
		<div class="w3-row-padding" style="padding:0px;">
			<div class="w3-threequarter w3-light-gray">
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
			<div class="w3-quarter w3-light-gray">
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
						<div class="w3-dropdown-hover w3-right w3-light-gray"  style="margin:5px 0px 0px 0px;padding:0px;">
							<h4 onmouseover="document.getElementById('my_profile_menu').classList.add('fa-caret-square-o-down');" onmouseout="document.getElementById('my_profile_menu').classList.remove('fa-caret-square-o-down');" class="w3-button w3-medium w3-bold w3-center w3-round w3-hover-black w3-border" style="padding:5px 9px 3px 7px;margin:0px;"><img id="desk_image" src="images/customer/<?php if($list[0]['image']!=""){ echo $list[0]['image']; } else { echo 'default.png'; } ?>" class="w3-image w3-round w3-border" style="width:100%;max-width:22px;height:25px;margin:-5px 0px 0px -2px;padding:0px;"/> <a id="desktop_profile_name">Hi! <?php echo $list[0]['first_name']; ?></a> <i id="my_profile_menu" class="fa " style="margin:0px 0px 0px 3px;padding:0px;"></i></h4>
							<div class="w3-dropdown-content w3-bar-block w3-border w3-light-gray w3-medium w3-bold" onmouseover="document.getElementById('my_profile_menu').classList.add('fa-caret-square-o-down');" onmouseout="document.getElementById('my_profile_menu').classList.remove('fa-caret-square-o-down');" style="right:0;width:140px;">
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
						<h4 class="w3-medium w3-right-align"><a onclick="document.getElementById('sign_up_form').style.display='none';document.getElementById('sign_in_form').style.display='block';document.getElementById('sign_form').style.display='block';" class="w3-hover-bold" style="text-decoration:none;"><i class="fa fa-sign-in"></i> Sign In</a> <a class="w3-hover-bold" style="text-decoration:none;margin-left:20px;" onclick="document.getElementById('sign_in_form').style.display='none';document.getElementById('sign_up_form').style.display='block';document.getElementById('sign_form').style.display='block';"><i class="fa fa-user-plus"></i> Sign Up</a></h4>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>



<script>
	 function menu_design(e)
	 {
		<?php
			try
			{
				$stmt = $conn->prepare("select * from food_category where status='active' order by category_id asc ");
				$stmt->execute();
				$list = $stmt->fetchAll(); 
				foreach($list as $row)
				{
		?>
			document.getElementById('menu_design_<?php echo $row['category_id']; ?>').style.fontWeight='normal';
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		?>
		e.style.fontWeight='bold';
	 }
</script>


<!-- Main Part Start Here -->
<div class="w3-row-padding  w3-hide-small w3-hide-medium" style="margin:15px 0px 0px 0px;">
	
	<div class="w3-threequarter">
		
		<div class="w3-container w3-light-gray w3-round w3-border w3-border-shadow" style="padding:0px;">
			<!-- Menu or Offer -->
			<div class="w3-container">
				<div class="w3-left">
					<div>
						<a id="menu_btn" onclick="menu_active()" class="w3-bar-item w3-button w3-hover-white w3-white w3-hover-opacity-off" style="border-bottom: 2px solid black;margin-bottom:2px;"><i class="fa fa-cutlery"></i> Menu</a>
						<a id="offer_btn" onclick="offer_active()" class="w3-bar-item w3-button w3-opacity w3-hover-opacity-off" style="margin-bottom:2px;"><i class="fa fa-asterisk"></i> Offer</a>
					</div>
					<script>
						function menu_active()
						{
							document.getElementById('offer_btn').style.border='0px';
							document.getElementById('offer_btn').classList.remove('w3-white');
							document.getElementById('offer_btn').classList.add('w3-opacity');
							
							document.getElementById('menu_btn').classList.remove('w3-opacity');
							document.getElementById('menu_btn').classList.add('w3-white');
							document.getElementById('menu_btn').style.borderBottom='2px solid black';
							document.getElementById('menu_items').style.display='block';
							document.getElementById('offer_items').style.display='none';
							
						}
						function offer_active()
						{
							document.getElementById('menu_btn').style.border='0px';
							document.getElementById('menu_btn').classList.remove('w3-white');
							document.getElementById('menu_btn').classList.add('w3-opacity');
							
							document.getElementById('offer_btn').classList.remove('w3-opacity');
							document.getElementById('offer_btn').classList.add('w3-white');
							document.getElementById('offer_btn').style.borderBottom='2px solid black';
							
							document.getElementById('menu_items').style.display='none';
							document.getElementById('offer_items').style.display='block';
						}
					
					</script>
				</div>
			</div>
			<!-- Other Content -->
			
			<div id="menu_items" class="w3-container w3-border-top" style="padding:20px 0px 80px 0px;margin:0px;min-height:300px;height:auto;">
				<div class="w3-row-padding" style="margin:0px;">
					<!-- Menu List -->
					<div class="w3-quarter w3-bar-block w3-small " style="position: -webkit-sticky;position: sticky;top:0;">
						<?php
							try
							{
								$stmt = $conn->prepare("select * from food_category where status='active' order by category_id asc ");
								$stmt->execute();
								$list = $stmt->fetchAll(); 
								foreach($list as $row)
								{
						?>
							<div class="w3-bar-item w3-padding-small w3-hover-bold"><a href="#<?php echo $row['category_id']; ?>" id="menu_design_<?php echo $row['category_id']; ?>" style="text-decoration:none;" class="" onclick="menu_design(this)"><?php echo $row['category_name']; ?></a></div>
						<?php
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
						?>
					</div>
					<!-- Menu Items -->
					<div class="w3-threequarter">
						
						<?php
							try
							{
								$stmt = $conn->prepare("select * from food_category where status='active' order by category_id asc ");
								$stmt->execute();
								$list = $stmt->fetchAll(); 
								foreach($list as $row)
								{
						?>
							<!-- Food Menu Item -->
							<div class="w3-container" id="idd_<?php echo $row['category_id']; ?>" style="margin:0px; padding:0px;">
								<div id="<?php echo $row['category_id']; ?>" class="w3-container w3-border w3-white" style="">
									<h2 class="w3-bold w3-medium w3-left-align"><?php echo $row['category_name']; ?></h2>
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
									<div class="w3-container w3-border-bottom" style="padding:0px;margin-bottom:3px;">
										<div class="w3-row-padding" style="padding:0px;">
											<!-- Item Name -->
											<div class="w3-container w3-threequarter">
												<h3 id="food_name_<?php echo $row2['food_id']; ?>" class="w3-bold w3-medium w3-left-align"><?php echo $row2['food_name']; ?></h3>
											</div>
											<!-- Price and Add option -->
											
											<p id="food_price_<?php echo $row2['food_id']; ?>" style="margin:0px;padding:0px;display:none;"><?php echo $row2['food_price']; ?></p>
							
											
											<div class="w3-container w3-quarter " style="overflow-wrap: normal;">
												<h3 class="w3-bold w3-large w3-right-align" style="font-family:Arial;">&pound; <?php echo $row2['food_price']; ?> <i class="w3-xlarge fa fa-plus-square-o" style="margin-left:10px;cursor:pointer;" onclick="add_to_cart(<?php echo $row2['food_id']; ?>)"></i></h3>
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
											<div class="w3-container" style="padding:0px 10px 0px 10px;width:85%;">
												<p class="w3-medium w3-left-align">
													<?php echo $row2['food_description']; ?>
												</p>
											</div> 
										<?php
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
			
			<div id="offer_items" class="w3-container w3-border-top" style="display:none;padding:0px 10px 20px 10px;margin:0px;min-height:300px;height:auto;">
				
				
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
								<div class="w3-container w3-border w3-white" style="padding:10px;">
									<h2 class="w3-bold w3-xlarge w3-left-align" style="font-family:Arial;margin:0px;">
										<i class="fa fa-certificate"></i>
										<?php echo $row['offer_title']; ?>
									</h2>
									<p class="w3-text-teal w3-left-align w3-bold" style="padding:0px;margin:0px 0px 0px 27px;font-family:Arial;">Offer Coupon Code: "<?php echo $row['offer_coupon_code']; ?>"</p>
								</div>
								<div class="w3-container w3-light-gray w3-medium w3-left-align w3-border-left w3-border-right" style="padding:10px;margin:0px;min-height:60px;height:auto;">
									<?php echo $row['offer_details']; ?>
								</div>
								<div class="w3-row w3-white w3-border" style="margin:0px;padding:10px;">
									<div class="w3-col w3-left-align w3-bold w3-text-red" style="width:50%;margin:0px;font-family:Arial;">
										Condition: On Orders Over &pound;<?php echo $row['offer_conditional_amount']; ?>
									</div>
									<div class="w3-col w3-right-align w3-bold w3-text-green" style="width:50%;padding:0px;font-family:Arial;">
										Validity: <?php echo $row['offer_start_date']; ?> to <?php echo $row['offer_end_date']; ?>
									</div>
								</div>
							</div>
				<?php
						}
						if(count($list)<=0)
						{
							echo '<h1 class="w3-text-red w3-bold w3-xlarge" style="margin-top:100px;"> Sorry no offer available</h1>';
						}
					}
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
				?>				
			</div>
			
		</div>
	
	</div>
		
	<div class="w3-quarter " style="padding-left:10px;position: -webkit-sticky;position: sticky;top:0;">
		<div class="w3-container w3-light-gray w3-round w3-border w3-border-shadow">
			<h3 class="w3-bold w3-left-align" style="margin:8px 0px 5px 0px;padding:0px;">My Order</h3>
			<?php
				$count=0;
				if(isset($_SESSION['cart_item']) and isset($_SESSION['cart_item_quantity']))
				{
					foreach($_SESSION['cart_item'] as $item) //it will hold food id
					{
						$count++;
					}
				}
				//Submit for apply coupon code
				if(isset($_REQUEST['submit_coupon_code']))
				{
					$coupon_code=trim($_REQUEST['coupon_code']);
					//Another Testing
					//echo '<script> alert("'.$coupon_code.'"); </script>';
					$cart_coupon="".$_SESSION['cart_coupon'];
					//echo '<script> alert("'.$cart_coupon.'"); </script>';
					if($cart_coupon==$coupon_code)
					{
						//echo '<script> alert("Oh Nooooo"); </script>';
						echo '<script>document.getElementById("discount_already").style.display="block"; setTimeout(stop_coupon,2000);</script>';
					}
					else
					{
						$today=strtotime(get_coupon_date()); //Get today's date YYYY-MM-DD
						$fl=0; 
						try
						{
							$stmt2 = $conn->prepare("select * from offer_coupon where status='active' AND offer_coupon_code=:coupon_code order by offer_id asc ");
							$stmt2->execute(array('coupon_code'=>$coupon_code));
							$list2 = $stmt2->fetchAll(); 
							foreach($list2 as $row2)
							{
								$fl++;
								$start=strtotime($row2['offer_start_date']);
								$end=strtotime($row2['offer_end_date']);
								if($today>=$start && $today<=$end)
								{
									//Apply Coupon Code successfully
									$_SESSION['cart_coupon']=$coupon_code;
									echo '<script> document.getElementById("discount_percentage").innerHTML="'.$row2['offer_in_percentage'].'%"; document.getElementById("discount_condition").innerHTML="At Order Over &pound;'.$row2['offer_conditional_amount'].'"; document.getElementById("discount_applied").style.display="block"; setTimeout(stop_coupon,2000);</script>';
								}
								else
								{
									//Expired
									echo '<script>document.getElementById("discount_expired").style.display="block"; setTimeout(stop_coupon,2000);</script>';
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
						echo '<script>document.getElementById("discount_invalid").style.display="block"; setTimeout(stop_coupon,2000);</script>';
					}
					
				}
				
			?>
			<div id="cart_none" class="w3-container w3-center w3-border-top w3-padding" style="<?php if($count!=0){ echo "display:none;"; } ?>" >
				<i style="font-size:150px;" class="w3-opacity-max fa fa-cart-arrow-down"></i>
				<p class="w3-medium w3-opacity">Add menu items into your cart</p>
			</div>
			<!-- Total Cart Details when it will show to user -->
			<div id="cart_activate" class="w3-container w3-center w3-border-top" style="margin:0px;padding:0px;<?php if($count==0){ echo "display:none;"; } ?>">
				<!-- Cart Item will show here -->
				<div id="cart_items" class="w3-container" style="margin:0px;padding:10px 0px 0px 0px;height:auto;max-height:203px;overflow:auto;">
					<?php
						
						$discount_percentage=0;
						$discount_condition=0.0;
						if(isset($_SESSION['cart_coupon']))
						{
							$cart_coupon=$_SESSION['cart_coupon'];
							try 
							{
								$stmt2 = $conn->prepare("select * from offer_coupon where status='active' AND offer_coupon_code='$cart_coupon' order by offer_id asc ");
								$stmt2->execute();
								$list2 = $stmt2->fetchAll(); 
								foreach($list2 as $row2)
								{
									$discount_percentage=$row2['offer_in_percentage'];
									$discount_condition=$row2['offer_conditional_amount'];
								}
							}
							catch(PDOException $e) {
								echo "Error: " . $e->getMessage();
							}
						}
						
						$total_items=0;
						$subtotal_amount=0.0;
						$discount_amount=0.0;
						$total_amount=0.0;
						if(isset($_SESSION['cart_item']) and isset($_SESSION['cart_item_quantity']))
						{
							$food_name="";
							$food_price=0.0;
							foreach($_SESSION['cart_item'] as $item) //it will hold food id
							{	
								$total_items++;
								try
								{
									$stmt2 = $conn->prepare("select * from food where status='active' AND food_id='$item' order by food_id asc ");
									$stmt2->execute();
									$list2 = $stmt2->fetchAll(); 
									foreach($list2 as $row2)
									{
										$food_name=$row2['food_name'];
										$food_price=$row2['food_price'];
									}
								}
								catch(PDOException $e) {
									echo "Error: " . $e->getMessage();
								}
					?>
						<!-- A single item in cart -->
						<div class="w3-row w3-border-bottom" id="cart_item_<?php echo $item; ?>" onmouseover="show_cart_option('<?php echo $item; ?>')" onmouseout="hide_cart_option('<?php echo $item; ?>');" style="cursor:pointer;">
							<!-- No of Item Details in Cart -->
							<div class="w3-col" style="width:15%;padding: 0px 2px;">
								<!--Cart A single Item qty -->
								<p id="no_of_item_<?php echo $item; ?>" class="w3-center w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;"><?php echo $_SESSION['cart_item_quantity'][$item]; ?> x</p>
								<!--Cart A single Item qty change option -->
								<div id="no_of_button_<?php echo $item; ?>" class="w3-container" style="display:none;margin:0px;padding:0px;width:100%;">
									<p class="w3-tiny w3-center w3-border w3-border-black" onclick="plus_cart_item('<?php echo $item; ?>')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-plus"></i></p>
									<p class="w3-tiny w3-center w3-border w3-border-black" id="value_<?php echo $item; ?>" style="margin:0px;width:18px;padding: 0px;font-family:Arial;"></p>
									<p class="w3-tiny w3-center w3-border w3-border-black" onclick="minus_cart_item('<?php echo $item; ?>')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-minus"></i></p>
								</div>
							</div>
							<!-- A single item title -->
							<div class="w3-col" style="width:65%;padding: 23px 2px;">
								<p class="w3-left-align w3-small w3-opacity" style="margin:0px;padding:0px;font-family:Arial;">
									<?php echo $food_name; ?>
								</p>
							</div>
							
							<!-- Item Amount details in cart -->
							<div class="w3-col" style="width:20%;padding: 0px 2px;">
								<!-- A single item price -->
								<p id="close_item_<?php echo $item; ?>" class="w3-right-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;"><?php $food_qty=$_SESSION['cart_item_quantity'][$item]; $single_amount=($food_price*$food_qty); $single_amount=number_format($single_amount, 2, '.', ''); echo $single_amount; $subtotal_amount+=$single_amount; ?></p>
								<!-- A single item remove option --> 
								<p id="close_button_<?php echo $item; ?>" class="w3-right-align w3-large w3-opacity" style="display:none;margin:17px 0px 0px 0px;padding:0px;font-family:Arial;"><i class="fa fa-window-close-o" onclick="cart_item_close('<?php echo $item; ?>')"></i></p>
							</div>
						</div>
					<?php
							}
						}
					?>
				</div>
				
				<!-- Discount will show here -->
				<div id="cart_discount" class="w3-container w3-border-top" style="margin:0px;padding:5px 0px 10px 0px;">
					<p class="w3-small w3-bold w3-left-align" style="pading:0px;margin:0px;">Discounts & Offers</p>
					<div class="w3-row" style="margin:0px;padding:0px;">
						<form action="order_online.php" method="post" autocomplete="off">
							<div class="w3-threequarter" style="margin:0px;padding:3px 0px 0px 0px;"><input type="text" placeholder=" Enter Coupon Code" name="coupon_code" class="w3-input-modified w3-small w3-round w3-border" style="width:100%;height:24px;" /></div>
							<div class="w3-quarter" style="margin:0px;padding:3px 0px 0px 4px;"><input type="submit" name="submit_coupon_code" value="Apply" class="w3-button w3-red w3-round w3-small" style="margin:0px;width:100%;height:24px;padding:2px 0px;"></div>	
						</form>	
					</div>
				</div>
				
				<!-- Amount will show here -->
				<div id="cart_amount" class="w3-container w3-border-top" style="margin:0px;padding:0px 0px 10px 0px;">
					<!-- Sub Total -->
					<div class="w3-row" style="padding:0px;margin:0px;">
						<div class="w3-half w3-left-align" style="padding:4px;margin:0px;"><p class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">Subtotal:</p></div>
						<div class="w3-half w3-right-align" style="padding:4px;margin:0px;"><p id="subtotal_amount" class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;"><?php $sss=number_format($subtotal_amount, 2, '.', ''); echo $sss; ?></p></div>
					</div>
					<!-- Discount --> 
					<div class="w3-row" style="padding:0px;margin:0px;">
						<div class="w3-half w3-left-align" style="padding:4px;margin:0px;"><p class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;">Discount:</p></div>
						<div class="w3-half w3-right-align" style="padding:4px;margin:0px;"><p id="discount_amount" class="w3-medium w3-opacity" style="font-family:Arial;padding:0px;margin:0px;"><?php if($sss>=$discount_condition){  $discount_amount=($sss/100.0)*$discount_percentage; echo number_format($discount_amount, 2, '.', ''); } else {  echo number_format($discount_amount, 2, '.', ''); } ?></p></div>
					</div>
					<!-- Total -->
					<div class="w3-row" style="padding:0px;margin:0px;">
						<div class="w3-half w3-left-align" style="padding:6px 0px 4px 4px;margin:0px;"><p class="w3-medium" style="font-family:Arial;padding:0px;margin:0px;">Total:</p></div>
						<div class="w3-half w3-right-align" style="padding:0px 4px 0px 0px;margin:0px;"><p id="total_amount" class="w3-xlarge" style="font-family:Arial;padding:0px;margin:0px;">&pound; <?php $total_amount=number_format(($subtotal_amount-$discount_amount), 2, '.', ''); echo $total_amount; ?></p></div>
						<?php 
							if(isset($_SESSION['logged_in']))
							{
						?>
								<a class="w3-button w3-medium w3-center w3-red w3-round" onclick="document.getElementById('pay_subtotal_amount').innerHTML=document.getElementById('subtotal_amount').innerHTML;document.getElementById('pay_discount_amount').innerHTML=document.getElementById('discount_amount').innerHTML;document.getElementById('pay_total_amount').innerHTML=document.getElementById('total_amount').innerHTML;document.getElementById('my_payment').style.display='block';" style="width:100%;margin-top:30px;">Proceed to Checkout</a> 
						<?php
							}
							else
							{
						?>
								<a class="w3-button w3-medium w3-center w3-red w3-round" onclick="document.getElementById('pls_sign_in').style.display='block';setTimeout(stop_pls_sign_in,1500);" style="width:100%;margin-top:30px;">Proceed to Checkout</a> 
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div> 
	</div>
	
</div>
<script>

	var total_unique_item=<?php echo $total_items; ?>;
	var subtotal_amount=<?php echo $subtotal_amount; ?>;
	var discount_amount=<?php echo $discount_amount; ?>;
	var discount_percentage=<?php echo $discount_percentage; ?>;
	var discount_condition=<?php echo $discount_condition; ?>;
	//Cart Items with Ajax
	function add_to_cart(id)
	{
		//Show cart notification
		document.getElementById('cart_notification').style.display='block';
		//hide empty cart
		document.getElementById('cart_none').style.display='none';
		//show cart
		document.getElementById('cart_activate').style.display='block';
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
				
            }
        };		
		if(document.getElementById("cart_item_"+id))
		{
			if(document.getElementById("cart_item_"+id).style.display=='none')
			{
				
				total_unique_item=total_unique_item+1;
				//console.log("YES");
				var food_price=document.getElementById('food_price_'+id).innerHTML;
				document.getElementById("no_of_item_"+id).innerHTML='1 x';
				document.getElementById("close_item_"+id).innerHTML=food_price;
				document.getElementById("cart_item_"+id).style.display='block';
				document.getElementById("cart_items").scrollTop=0;
				document.getElementById("cart_items").scrollTop=document.getElementById("cart_item_"+id).offsetTop-60;
				subtotal_amount=subtotal_amount+parseFloat(food_price);
			}
			else
			{
				//Already added in cart so increase
				var value=document.getElementById('no_of_item_'+id).innerHTML;
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
				document.getElementById('no_of_item_'+id).innerHTML=y+" x";
				var z=document.getElementById('food_price_'+id).innerHTML;
				var zz=parseFloat(z);
				var yy=(y*zz*1.0);
				var yyy=yy.toFixed(2);
				document.getElementById('close_item_'+id).innerHTML=yyy;
				document.getElementById("cart_items").scrollTop=0;
				document.getElementById("cart_items").scrollTop=document.getElementById("cart_item_"+id).offsetTop-60;
				subtotal_amount=subtotal_amount+zz;
			}
		}
		else
		{
			total_unique_item=total_unique_item+1;
			var food_name=document.getElementById('food_name_'+id).innerHTML;
			var food_price=document.getElementById('food_price_'+id).innerHTML;
			var a='<div class="w3-row w3-border-bottom" id="cart_item_'+id+'" onmouseover="show_cart_option(\''+id+'\')" onmouseout="hide_cart_option(\''+id+'\');" style="cursor:pointer;"><div class="w3-col" style="width:15%;padding: 0px 2px;">'
					+'<p id="no_of_item_'+id+'" class="w3-left-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;">1 x</p>'
					+'<div id="no_of_button_'+id+'" class="w3-container" style="display:none;margin:0px;padding:0px;width:100%;">'
					+'<p class="w3-tiny w3-center w3-border w3-border-black" onclick="plus_cart_item(\''+id+'\')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-plus"></i></p>'
					+'<p class="w3-tiny w3-center w3-border w3-border-black" id="value_'+id+'" style="margin:0px;width:18px;padding: 0px;font-family:Arial;"></p>'
					+'<p class="w3-tiny w3-center w3-border w3-border-black" onclick="minus_cart_item(\''+id+'\')" style="margin:0px;width:18px;padding: 2px 0px 0px 0px;"><i class="fa fa-minus"></i></p>'
					+'</div>'
					+'</div>'
					+'<div class="w3-col" style="width:65%;padding: 23px 2px;">'
					+'<p class="w3-left-align w3-small w3-opacity" style="margin:0px;padding:0px;font-family:Arial;">'
					+food_name
					+'</p>'
					+'</div>'
					+'<div class="w3-col" style="width:20%;padding: 0px 2px;">'
					+'<p id="close_item_'+id+'" class="w3-right-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;">'
					+food_price
					+'</p>'
					+'<p id="close_button_'+id+'" class="w3-right-align w3-large w3-opacity" style="display:none;margin:17px 0px 0px 0px;padding:0px;font-family:Arial;"><i class="fa fa-window-close-o" onclick="cart_item_close(\''+id+'\')"></i></p>'
					+'</div>'
					+'</div>';
			document.getElementById("cart_items").innerHTML=document.getElementById("cart_items").innerHTML+a;
			document.getElementById("cart_items").scrollTop=0;
			document.getElementById("cart_items").scrollTop=document.getElementById("cart_item_"+id).offsetTop;
			subtotal_amount=subtotal_amount+parseFloat(food_price);
		}
		document.getElementById('subtotal_amount').innerHTML=subtotal_amount.toFixed(2);
		// Discount Calculation
		if(subtotal_amount>=discount_condition)
		{
			discount_amount=(subtotal_amount/100.0)*discount_percentage;
		}
		else
			discount_amount=0.00;
		document.getElementById('discount_amount').innerHTML=discount_amount.toFixed(2);
		document.getElementById('total_amount').innerHTML='&pound; '+(subtotal_amount.toFixed(2)-discount_amount.toFixed(2)).toFixed(2);
		xmlhttp.open("GET", "include/cart_item_add.php?do_it=YES&id="+id, true);
        xmlhttp.send();
		
		//hiding notification bar after 550 ms
		setTimeout(stop_notification,550); 
		
		
	}
	function stop_notification()
	{
		var x=document.getElementById('cart_notification');
		x.style.display='none';
	}
	function show_cart_option(id)
	{
		//Value Edit of Item
		var value=document.getElementById('no_of_item_'+id).innerHTML;
		var i,len=value.length;
		var x="";
		for(i=0;i<len;i++)
		{
			if(value[i]==' ')
				break;
			x=x+value[i];
		}
		document.getElementById('no_of_item_'+id).style.display='none';
		document.getElementById('no_of_button_'+id).style.display='block';
		document.getElementById('value_'+id).innerHTML=x;
		// View Close Option
		document.getElementById('close_item_'+id).style.display='none';
		document.getElementById('close_button_'+id).style.display='block';
	}
	function hide_cart_option(id)
	{
	
		//Value Edit of Item
		document.getElementById('no_of_button_'+id).style.display='none';
		document.getElementById('no_of_item_'+id).style.display='block';
		
		//hide Close Option
		document.getElementById('close_button_'+id).style.display='none';
		document.getElementById('close_item_'+id).style.display='block';
	}
	function plus_cart_item(id)
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
				
            }
        };
		
		var value=document.getElementById('no_of_item_'+id).innerHTML;
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
		document.getElementById('no_of_item_'+id).innerHTML=y+" x";
		document.getElementById('value_'+id).innerHTML=y;
		var z=document.getElementById('food_price_'+id).innerHTML;
		var zz=parseFloat(z);
		var yy=(y*zz*1.0);
		var yyy=yy.toFixed(2);
		document.getElementById('close_item_'+id).innerHTML=yyy;
		subtotal_amount=subtotal_amount+zz;
		document.getElementById('subtotal_amount').innerHTML=subtotal_amount.toFixed(2);
		
		// Discount Calculation
		if(subtotal_amount>=discount_condition)
		{
			discount_amount=(subtotal_amount/100.0)*discount_percentage;
		}
		else
			discount_amount=0.00;
		document.getElementById('discount_amount').innerHTML=discount_amount.toFixed(2);
		document.getElementById('total_amount').innerHTML='&pound; '+(subtotal_amount.toFixed(2)-discount_amount.toFixed(2)).toFixed(2);
		
		xmlhttp.open("GET", "include/cart_item_plus.php?do_it=YES&id="+id, true);
        xmlhttp.send();
	}
	function minus_cart_item(id)
	{
		
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
				
            }
        };
		
		var value=document.getElementById('no_of_item_'+id).innerHTML;
		var i,len=value.length;
		var x="";
		for(i=0;i<len;i++)
		{
			if(value[i]==' ')
				break;
			x=x+value[i];
		}
		var y=parseInt(x);
		var z=document.getElementById('food_price_'+id).innerHTML;
		var zz=parseFloat(z);
		
		if(y==1) //Only single Item Available
		{
			total_unique_item=total_unique_item-1;
			y=y-1;
			if(total_unique_item<=0) //This is the last item in cart
			{
				document.getElementById('cart_item_'+id).style.display='none';
				//hide empty cart
				document.getElementById('cart_activate').style.display='none';
				//show cart
				document.getElementById('cart_none').style.display='block';
				
				discount_percentage=0;
			}
			else //This is not the last item in cart
			{
				document.getElementById('cart_item_'+id).style.display='none';
			}
		}
		else //More than one qty of a Item
		{
			y=y-1;
			document.getElementById('no_of_item_'+id).innerHTML=y+" x";
			document.getElementById('value_'+id).innerHTML=y;
			var yy=(y*zz*1.0);
			var yyy=yy.toFixed(2);
			document.getElementById('close_item_'+id).innerHTML=yyy;			
		}
		subtotal_amount=subtotal_amount-zz;
		document.getElementById('subtotal_amount').innerHTML=subtotal_amount.toFixed(2);
		
		// Discount Calculation
		if(subtotal_amount>=discount_condition)
		{
			discount_amount=(subtotal_amount/100.0)*discount_percentage;
		}
		else
			discount_amount=0.00;
		
		document.getElementById('discount_amount').innerHTML=discount_amount.toFixed(2);
		document.getElementById('total_amount').innerHTML='&pound; '+(subtotal_amount.toFixed(2)-discount_amount.toFixed(2)).toFixed(2);
		
		xmlhttp.open("GET", "include/cart_item_minus.php?do_it=YES&id="+id, true);
        xmlhttp.send();
	}
	function cart_item_close(id)
	{
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("cart_items").innerHTML = this.responseText;
				//console.log("Working");
            }
        };
		
		var z=document.getElementById('close_item_'+id).innerHTML;
		var zz=parseFloat(z);
		subtotal_amount=subtotal_amount-zz;
		document.getElementById('subtotal_amount').innerHTML=subtotal_amount.toFixed(2);
		// Discount Calculation
		if(subtotal_amount>=discount_condition)
		{
			discount_amount=(subtotal_amount/100.0)*discount_percentage;
		}
		else
			discount_amount=0.00;
		document.getElementById('discount_amount').innerHTML=discount_amount.toFixed(2);
		document.getElementById('total_amount').innerHTML='&pound; '+(subtotal_amount.toFixed(2)-discount_amount.toFixed(2)).toFixed(2);
		
		
		document.getElementById("cart_item_"+id).style.display='none';
		total_unique_item=total_unique_item-1;
		if(total_unique_item==0)
		{
			//hide empty cart
			document.getElementById('cart_activate').style.display='none';
			//show cart
			document.getElementById('cart_none').style.display='block';
			
			discount_percentage=0;
		}
		xmlhttp.open("GET", "include/cart_item_close.php?do_it=YES&id="+id, true);
        xmlhttp.send();
	}
	
	
	

	function scrollFunction3() {
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
			if ((document.body.scrollTop+10)>= document.getElementById("idd_<?php echo $row['category_id']; ?>").offsetTop || (document.documentElement.scrollTop+10)>=document.getElementById("idd_<?php echo $row['category_id']; ?>").offsetTop) {
				<?php
					try
					{
						$stmt2 = $conn->prepare("select * from food_category where status='active' AND category_id!='$row[category_id]' order by category_id asc ");
						$stmt2->execute();
						$list2 = $stmt2->fetchAll(); 
						foreach($list2 as $row2)
						{
				?>
					document.getElementById('menu_design_<?php echo $row2['category_id']; ?>').style.fontWeight='normal';
				<?php
						}
					}
					catch(PDOException $e) {
						echo "Error: " . $e->getMessage();
					}
				?>
				document.getElementById('menu_design_<?php echo $row['category_id']; ?>').style.fontWeight='bold';
				return;
			}
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
		?>
		if ((document.body.scrollTop)< document.getElementById("idd_<?php echo $row['category_id']; ?>").offsetTop || (document.documentElement.scrollTop)<document.getElementById("idd_<?php echo $row['category_id']; ?>").offsetTop) { 
			document.getElementById('menu_design_<?php echo $row['category_id']; ?>').style.fontWeight='normal';
		}
	}
</script>