<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
	
	<div class="w3-container" style="margin-top:80px" id="offers">
		<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Offers</b></h1>
		<hr style="width:50px;border:5px solid black;" class="w3-round">
		<p> This option is used for <font color="red">add or update offer coupons</font> of <?php echo $website_title; ?>.</p>
		
		<div class="w3-container" style="padding:0px;margin:0px 0px 10px 0px;width:100%;max-width:700px;">
			<div class="w3-right w3-text-right" style="width:100%;max-width:524px;">
				<button class="w3-button w3-blue w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px;margin-left:5px;" onclick="view_food_offer(0)"><i class="fa fa-search"></i> Search</button>
				<button class="w3-button w3-blue w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px;margin-left:5px;" onclick="view_food_offer(0)"><i class="fa fa-search w3-bold"></i></button>
				
				<!-- Search Suggestion -->
				<div class="w3-right" style="width:80%;max-width:180px;margin-left:5px;">
					<input type="text" id="food_offer_search_value" oninput="get_food_offer_suggestion()"  onfocus="get_food_offer_suggestion()" class=" w3-round w3-small " placeholder=" Search by Food Offer" style="width:100%;">
					<ul id="food_offer_suggestion" class="w3-container w3-white w3-round w3-border-black w3-border-right w3-border-left w3-border-bottom" style="display:none;margin:2px 0px 0px 0px;padding:0px;position:absolute;width:100%;max-width:252px;list-style-type:none;height:auto;max-height:150px;overflow:auto;">
						
					</ul>
				</div>
				
				
				<button class="w3-button w3-teal w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px;margin-left:5px;" onclick="show_food_offer_add_form()"><i class="fa fa-plus"></i> Add Offer</button>	
				<button class="w3-button w3-teal w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px;margin-left:5px;" onclick="show_food_offer_add_form()"><i class="fa fa-plus w3-bold"></i></button>	
				
				
				<button class="w3-button w3-red w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px;margin-left:5px;" onclick="filter_fo(1)"><i class="fa fa-eye-slash"></i> Hidden</button>	
				<button class="w3-button w3-red w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px;margin-left:5px;" onclick="filter_fo(1)"><i class="fa fa-eye-slash w3-bold"></i></button>	
				
				<button class="w3-button w3-green w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px" onclick="filter_fo(0)"><i class="fa fa-eye"></i> Visible</button>
				<button class="w3-button w3-green w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px" onclick="filter_fo(0)"><i class="fa fa-eye w3-bold"></i></button>
			
				
			</div>
		</div>
		
		<!-- Food item edit --> 
		
		<div id="food_offer_update_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
			<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Food offer updated successfully.</p>
		</div>
		
		<script>
			function stop_food_offer_update_notification()
			{
				document.getElementById('food_offer_update_notification').style.display='none';
			}
		</script>
		
		<?php
			if(isset($_SESSION['food_offer_update_successful']))
			{
				echo "<script>document.getElementById('food_offer_update_notification').style.display='block';setTimeout(stop_food_offer_update_notification,1500);</script>";
				unset($_SESSION['food_offer_update_successful']);
			}
			if(isset($_REQUEST['food_offer_update']))
			{
				$offer_id=trim($_REQUEST['offer_id']);
				
				
				
				try
				{
					$stmt=$conn->prepare("update offer_coupon set  where offer_id=:offer_id ");
					$stmt->execute(array('offer_id'=>$offer_id));
					$_SESSION['food_offer_update_successful']='YES';
					header("Location: ow_index.php#offers");
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e.getMessage();
				}
			}
			
			if(isset($_REQUEST['edit_food_offer_list']))
			{
				$offer_id=($_REQUEST['offer_id']);
				try
				{
					$stmt=$conn->prepare("select * from offer_coupon where offer_id=:offer_id order by offer_id desc ");
					$stmt->execute(array('offer_id'=>$offer_id));
					$list=$stmt->fetchAll();
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e.getMessage();
				}
			?>
				<div id="edit_food_offer_list_form" class="w3-modal" style="z-index:99999999;">
					<div class="w3-modal-content w3-card-4 w3-animate-zoom w3-padding" style="max-width:500px;font-family:Arial;">
						
						<div class="w3-container" style="padding-left:0px;"><br>
							<span onclick="document.getElementById('edit_food_offer_list_form').style.display='none';" class="w3-button w3-large w3-transparent w3-display-topright" title="Close Modal"><i class="fa fa-close"></i></span>
							<h2 class="w3-xlarge w3-bold w3-left-align" style="font-family:Arial;margin:0px;">Edit Food Offer</h2>
						</div>

						<form action="ow_index.php#offers" class="w3-margin-bottom">
							
							<input class="w3-input w3-border" name="offer_title" type="text" placeholder="Enter Offer Title *" value="<?php echo $list[0]['offer_title']; ?>"  maxlength="80" style="margin:8px 0px 0px 0px;" required>
							
							<input class="w3-input w3-border" name="offer_in_percentage" type="text" placeholder="Enter Offer amount in percentage (ex. 5) *" value="<?php echo $list[0]['offer_in_percentage']; ?>"  maxlength="30" style="margin:8px 0px 0px 0px;" required>
							
							<input class="w3-input w3-border" name="offer_reject_msg" type="text" placeholder="Enter Offer reject message *" value="<?php echo $list[0]['offer_reject_msg']; ?>"  maxlength="60" style="margin:8px 0px 0px 0px;" required>

							<input class="w3-input w3-border" name="offer_coupon_code" type="text" placeholder="Enter Offer coupon code *" value="<?php echo $list[0]['offer_coupon_code']; ?>"  maxlength="60" style="margin:8px 0px 0px 0px;" required>

							<input class="w3-input w3-border" name="offer_conditional_amount" type="text" placeholder="Enter Offer conditional amount (ex. 0 min) *" value="<?php echo $list[0]['offer_conditional_amount']; ?>"  maxlength="60" style="margin:8px 0px 0px 0px;" required>

							
							<input type="hidden" name="offer_id" value="<?php echo $list[0]['offer_id']; ?>">
							
							<button class="w3-button w3-block w3-green w3-padding w3-margin-bottom" style="margin:8px 0px 0px 0px;" name="food_offer_update"><i class="fa fa-save"></i> Save Changes</button>
						
						</form>
						
					</div>
				</div>
		
		<?php
				echo '<script>document.getElementById("edit_food_offer_list_form").style.display="block";</script>';
			}		
		?>
		
		<script>
		
			
			function get_food_offer_suggestion()
			{
				var search=document.getElementById('food_offer_search_value').value.trim();
				var search_box=document.getElementById('food_offer_suggestion');
					
				
				if(search==""){
					search_box.innerHTML='';
					search_box.style.display='none';
				}
				else
				{
					search_box.style.display='block';
					search_box.innerHTML='<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom"><i class="fa fa-refresh w3-spin w3-center w3-text-red"></i> Please Wait...</li>';
					//Ajax for text upload
					var xhttp1 = new XMLHttpRequest();
					xhttp1.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							//retrive image_name
							var image_name=this.responseText;
							search_box.innerHTML=image_name;	
							
							//Error Checking
							//console.log(image_name);
						}
					};
					xhttp1.open("POST", "lib/food_offer_suggestion.php?give_food_offer_suggestion=yes&search_value="+search, true);
					xhttp1.send();
				}
			}
		
		
		
		
		
			var food_offer_tracker=0; //default
			function filter_fo(val)
			{
				if(val==1) //blocked container request
				{
					if(food_offer_tracker==0 || food_offer_tracker==2 || food_offer_tracker==3)
					{
						document.getElementById('food_offer_normal_container').style.display='none';
						document.getElementById('food_offer_unblock_container').style.display='none';
						document.getElementById('food_offer_block_container').style.display='block';
						
						document.getElementById('food_offer_search_list_container').style.display='none';
						food_offer_tracker=1; //block showing
					}
					else
					{
						document.getElementById('food_offer_normal_container').style.display='block';
						document.getElementById('food_offer_unblock_container').style.display='none';
						document.getElementById('food_offer_block_container').style.display='none';
						
						document.getElementById('food_offer_search_list_container').style.display='none';
						food_offer_tracker=0; //default showing
					}
				}
				else	//Unblocked container request
				{
					if(food_offer_tracker==0 || food_offer_tracker==1 || food_offer_tracker==3)
					{
						document.getElementById('food_offer_normal_container').style.display='none';
						document.getElementById('food_offer_unblock_container').style.display='block';
						document.getElementById('food_offer_block_container').style.display='none';
						
						document.getElementById('food_offer_search_list_container').style.display='none';
						food_offer_tracker=2;
					}
					else
					{
						document.getElementById('food_offer_normal_container').style.display='block';
						document.getElementById('food_offer_unblock_container').style.display='none';
						document.getElementById('food_offer_block_container').style.display='none';
						
						document.getElementById('food_offer_search_list_container').style.display='none';
						food_offer_tracker=0; //default showing
					}
				}
			
			}
			
			
			function view_food_offer(id)
			{
				
				var val=document.getElementById('food_offer_search_value').value.trim();
				document.getElementById('food_offer_search_value').value='';
				var search_box=document.getElementById('food_offer_suggestion');
				
				
				search_box.innerHTML='';
				search_box.style.display='none';
				//Ajax for text upload
				var xhttp2 = new XMLHttpRequest();
				xhttp2.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						//retrive image_name
						var image_name=this.responseText;
						document.getElementById('food_offer_search_list_container').innerHTML=image_name;							
								
						document.getElementById('food_offer_normal_container').style.display='none';
						document.getElementById('food_offer_unblock_container').style.display='none';
						document.getElementById('food_offer_block_container').style.display='none';
						document.getElementById('food_offer_search_list_container').style.display='block';
						food_offer_tracker=3; //search list showing

					}
				};
				xhttp2.open("POST", "lib/food_offer_search_list_show.php?give_food_offer_search_list=yes&offer_id="+id+"&search_value="+val, true);
				xhttp2.send();
			}
		
		</script>
		
		
		
		
		<!-- block unblock confirm modal goes here-->

		<div id="food_offer_hide_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
			<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Food offer hidden successfully.</p>
		</div>
		
		<div id="food_offer_show_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
			<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Food offer showed successfully.</p>
		</div>

		<script>
		
			function stop_food_offer_hide_notification()
			{
				document.getElementById('food_offer_hide_notification').style.display='none';
			}
			
			function stop_food_offer_show_notification()
			{
				document.getElementById('food_offer_show_notification').style.display='none';
			}
		
		</script>
		
		
		<?php
			
			//Block code segment
			if(isset($_SESSION['food_offer_hide_successful']))
			{
				echo "<script>document.getElementById('food_offer_hide_notification').style.display='block';setTimeout(stop_food_offer_hide_notification,1500);</script>";
				unset($_SESSION['food_offer_hide_successful']);
			}
			if(isset($_REQUEST['confirmed_hide_food_offer']))
			{
				$offer_id=trim($_REQUEST['offer_id']);
				try
				{
					$stmt=$conn->prepare("update offer_coupon set visibility='0' where offer_id=:offer_id ");
					$stmt->execute(array('offer_id'=>$offer_id));
						
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				$_SESSION['food_offer_hide_successful']='YES';
				header("Location: ow_index.php#offers");
			}
			
			
			//Unblock code segment
			if(isset($_SESSION['food_offer_unblock_successful']))
			{
				echo "<script>document.getElementById('food_offer_show_notification').style.display='block';setTimeout(stop_food_offer_show_notification,1500);</script>";
				unset($_SESSION['food_offer_unblock_successful']);
			}
			if(isset($_REQUEST['confirmed_unblock_food_offer']))
			{
				$offer_id=trim($_REQUEST['offer_id']);
				try
				{
					$stmt=$conn->prepare("update offer_coupon set visibility='1' where offer_id=:offer_id ");
					$stmt->execute(array('offer_id'=>$offer_id));
						
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				$_SESSION['food_offer_unblock_successful']='YES';
				header("Location: ow_index.php#offers");
			}
			
			
		?>
		
		
		
		<!-- food_category show Confirm Modal -->
			<div id="unblock_food_offer_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('unblock_food_offer_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to show the Food Offer in Customer Panel?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['pls_show_fo'])){
								$offer_id=trim($_REQUEST['offer_id']);
					
						?>
								<a href="ow_index.php?confirmed_unblock_food_offer=YES&offer_id=<?php echo $offer_id; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('unblock_food_offer_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
		
		
		<!-- food_category hide Confirm Modal -->
			<div id="block_food_offer_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('block_food_offer_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to hide the food Offer in Customer Panel?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['pls_hide_fo'])){
								$offer_id=trim($_REQUEST['offer_id']);
					
						?>
								<a href="ow_index.php?confirmed_hide_food_offer=YES&offer_id=<?php echo $offer_id; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('block_food_offer_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
		
		
		
		
		<!-- Hidden Visible confirm modal goes here-->
		<?php
			if(isset($_REQUEST['pls_hide_fo']))
			{
				echo '<script>document.getElementById("block_food_offer_confirm").style.display="block";</script>';
			}
			if(isset($_REQUEST['pls_show_fo']))
			{
				echo '<script>document.getElementById("unblock_food_offer_confirm").style.display="block";</script>';
			}
		
		?>
		
		
		
		
		<div id="food_offer_search_list_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="display:none;height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;">
		
		</div>
		
		<!-- normal filter -->
		<div id="food_offer_normal_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;">
			<?php
				$sl=0;
				try
				{
					$stmt=$conn->prepare("select * from offer_coupon order by offer_id desc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
						$sl++;
			?>
						<div style="width:100%;" class=" w3-padding w3-round w3-margin-bottom w3-small w3-container w3-topbar w3-bottombar w3-border w3-border-black <?php if($row['visibility']=='1'){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?>">
							<table class="w3-text-left w3-hide-large w3-hide-medium w3-tiny" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:70%;" valign="top">
										<p style="margin:2px;">
											Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font> 
											(
											<?php 
												if($row['status']=='active')
												{
													echo '<font class="w3-text-green">Valid</font>';
												}
												else
												{
													echo '<font class="w3-text-red">Invalid</font>';
												}
											?> 
											)
										</p>
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
 												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-round w3-green w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-teal w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
									</td>
								</tr>
							</table>
							
							<table class="w3-text-left w3-hide-small" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:70%;" valign="top">
										<p style="margin:2px;">
											Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font> 
											(
											<?php 
												if($row['status']=='active')
												{
													echo '<font class="w3-text-green">Valid</font>';
												}
												else
												{
													echo '<font class="w3-text-red">Invalid</font>';
												}
											?> 
											)
										</p>
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-teal w3-round" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
									</td>
								</tr>
							</table>

							
						</div>
			<?php
					}
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				if($sl==0)
					echo '<p style="color:red;padding-top:120px;text-align:center;">Sorry no food offer added yet</p>';
			?>
		
		</div>
		
		
		
		<!-- block filter -->
		<div id="food_offer_block_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
			<?php
				$sl=0;
				try
				{
					$stmt=$conn->prepare("select * from offer_coupon where visibility='0' order by offer_id desc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
						$sl++;
			?>
						<div style="width:100%;" class=" w3-padding w3-round w3-margin-bottom w3-small w3-container w3-topbar w3-bottombar w3-border w3-border-black <?php if($row['visibility']=='1'){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?>">
							<table class="w3-text-left w3-hide-large w3-hide-medium w3-tiny" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:70%;" valign="top">
										<p style="margin:2px;">
											Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font> 
											(
											<?php 
												if($row['status']=='active')
												{
													echo '<font class="w3-text-green">Valid</font>';
												}
												else
												{
													echo '<font class="w3-text-red">Invalid</font>';
												}
											?> 
											)
										</p>
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
 												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-round w3-green w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-teal w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
									</td>
								</tr>
							</table>
							
							<table class="w3-text-left w3-hide-small" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:70%;" valign="top">
									<p style="margin:2px;">
											Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font> 
											(
											<?php 
												if($row['status']=='active')
												{
													echo '<font class="w3-text-green">Valid</font>';
												}
												else
												{
													echo '<font class="w3-text-red">Invalid</font>';
												}
											?> 
											)
										</p>	
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-teal w3-round" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
									</td>
								</tr>
							</table>

							
						</div>
			<?php
					}
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				if($sl==0)
					echo '<p style="color:red;padding-top:120px;text-align:center;">Sorry no food offer added yet</p>';
			?>
		
		</div>
		
		
		
		<!-- unblock filter -->
		<div id="food_offer_unblock_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
			<?php
				$sl=0;
				try
				{
					$stmt=$conn->prepare("select * from offer_coupon where visibility='1' order by offer_id desc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
						$sl++;
			?>
						<div style="width:100%;" class=" w3-padding w3-round w3-margin-bottom w3-small w3-container w3-topbar w3-bottombar w3-border w3-border-black <?php if($row['visibility']=='1'){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?>">
							<table class="w3-text-left w3-hide-large w3-hide-medium w3-tiny" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:70%;" valign="top">
										<p style="margin:2px;">
											Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font> 
											(
											<?php 
												if($row['status']=='active')
												{
													echo '<font class="w3-text-green">Valid</font>';
												}
												else
												{
													echo '<font class="w3-text-red">Invalid</font>';
												}
											?> 
											)
										</p>
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
 												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-round w3-green w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-teal w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
									</td>
								</tr>
							</table>
							
							<table class="w3-text-left w3-hide-small" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:70%;" valign="top">
										<p style="margin:2px;">
											Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font> 
											(
											<?php 
												if($row['status']=='active')
												{
													echo '<font class="w3-text-green">Valid</font>';
												}
												else
												{
													echo '<font class="w3-text-red">Invalid</font>';
												}
											?> 
											)
										</p>
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&offer_id=<?php echo $row['offer_id']; ?>"><button class="w3-button w3-teal w3-round" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
									</td>
								</tr>
							</table>

							
						</div>
			<?php
					}
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				if($sl==0)
					echo '<p style="color:red;padding-top:120px;text-align:center;">Sorry no food offer added yet</p>';
			?>
		
		</div>
		
		
	</div>