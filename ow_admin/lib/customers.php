<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
	
	<div class="w3-container" style="margin-top:80px" id="customers">
		<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Customers</b></h1>
		<hr style="width:50px;border:5px solid black;" class="w3-round">
		<p> This option is used for <font color="red">update customers status</font> of <?php echo $website_title; ?>.</p>
		<div class="w3-container" style="padding:0px;margin:0px 0px 10px 0px;width:100%;max-width:700px;">
			<div class="w3-right w3-text-right" style="width:100%;max-width:424px;">
				<button class="w3-button w3-blue w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px;margin-left:5px;" onclick="view_customer(0)"><i class="fa fa-search"></i> Search</button>
				<button class="w3-button w3-blue w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px;margin-left:5px;" onclick="view_customer(0)"><i class="fa fa-search w3-bold"></i></button>
				
				<!-- Search Suggestion -->
				<div class="w3-right" style="width:80%;max-width:180px;margin-left:5px;" >
					<input type="text" id="customer_search_value" oninput="get_customer_suggestion()" onfocus="get_customer_suggestion()"  class=" w3-round w3-small " placeholder=" Search by Name or Email" style="width:100%;">
					<ul id="customer_suggestion" class="w3-container w3-white w3-round w3-border-black w3-border-right w3-border-left w3-border-bottom" style="display:none;margin:2px 0px 0px 0px;padding:0px;position:absolute;width:100%;max-width:252px;list-style-type:none;height:auto;max-height:150px;overflow:auto;">
						
					</ul>
				</div>
	
				
				<button class="w3-button w3-red w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px;margin-left:5px;" onclick="filter(1)"><i class="fa fa-eye-slash"></i> Blocked</button>	
				<button class="w3-button w3-red w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px;margin-left:5px;" onclick="filter(1)"><i class="fa fa-eye-slash w3-bold"></i></button>	
				
				<button class="w3-button w3-green w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px" onclick="filter(0)"><i class="fa fa-eye"></i> Unblocked</button>
				<button class="w3-button w3-green w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px" onclick="filter(0)"><i class="fa fa-eye w3-bold"></i></button>
			
				
			</div>
		</div>
		
		<script>
			function get_customer_suggestion()
			{
				var search=document.getElementById('customer_search_value').value.trim();
				var search_box=document.getElementById('customer_suggestion');
					
				
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
							//retrive customer suggestion list
							var image_name=this.responseText;
							//console.log(image_name); 
							search_box.innerHTML=image_name;							
						}
					};
					xhttp1.open("POST", "lib/customer_suggestion.php?give_customer_suggestion=yes&search_value="+search, true);
					xhttp1.send();
				}
			}		
		
			var tracker=0; //default
			function filter(val)
			{
				if(val==1) //blocked container request
				{
					if(tracker==0 || tracker==2  || tracker==3)
					{
						document.getElementById('customers_normal_container').style.display='none';
						document.getElementById('customers_search_list_container').style.display='none';	
						document.getElementById('customers_unblock_container').style.display='none';
						document.getElementById('customers_block_container').style.display='block';
						tracker=1; //block showing
					}
					else
					{
						document.getElementById('customers_normal_container').style.display='block';
						document.getElementById('customers_unblock_container').style.display='none';
						document.getElementById('customers_block_container').style.display='none';
						tracker=0; //default showing
					}
				}
				else	//Unblocked container request
				{
					if(tracker==0 || tracker==1 || tracker==3)
					{
						document.getElementById('customers_normal_container').style.display='none';
						document.getElementById('customers_search_list_container').style.display='none';	
						document.getElementById('customers_unblock_container').style.display='block';
						document.getElementById('customers_block_container').style.display='none';
						tracker=2;
					}
					else
					{
						document.getElementById('customers_normal_container').style.display='block';
						document.getElementById('customers_unblock_container').style.display='none';
						document.getElementById('customers_block_container').style.display='none';
						tracker=0; //default showing
					}
				}
			
			}
			
			function view_customer(id)
			{
				var val=document.getElementById('customer_search_value').value.trim();
				document.getElementById('customer_search_value').value='';
				var search_box=document.getElementById('customer_suggestion');
				
				search_box.innerHTML='';
				search_box.style.display='none';
				//Ajax for text upload
				var xhttp1 = new XMLHttpRequest();
				xhttp1.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						//retrive image_name
						var image_name=this.responseText.trim();
						document.getElementById('customers_search_list_container').innerHTML=image_name;							
								
						document.getElementById('customers_normal_container').style.display='none';
						document.getElementById('customers_unblock_container').style.display='none';
						document.getElementById('customers_block_container').style.display='none';
						document.getElementById('customers_search_list_container').style.display='block';
						tracker=3; //search list showing
						
						//Clearing search suggestion and search value
						search_box.innerHTML='';
						search_box.style.display='none';

					}
				};
				xhttp1.open("POST", "lib/customer_search_list_show.php?give_customer_search_list=yes&customer_id="+id+"&search_value="+val, true);
				xhttp1.send();
			}
		

		</script>
		
		
		<!-- block unblock confirm modal goes here-->

		<div id="customer_block_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
			<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Customer blocked successfully.</p>
		</div>
		
		<div id="customer_unblock_notification" class="w3-bar w3-green w3-animate-opacity" style="position:fixed;z-index:9999;top:0px;width:100%;left:0px;padding:5px;display:none;"> 
			<p class="w3-large w3-center" style="margin:0px;padding:0px;"><i class="fa fa-bell"></i> Congratulation. Customer unblocked successfully.</p>
		</div>

		<script>
		
			function stop_customer_block_notification()
			{
				document.getElementById('customer_block_notification').style.display='none';
			}
			
			function stop_customer_unblock_notification()
			{
				document.getElementById('customer_unblock_notification').style.display='none';
			}
		
		</script>
		
		<?php
			
			//Block code segment
			if(isset($_SESSION['customer_block_successful']))
			{
				echo "<script>document.getElementById('customer_block_notification').style.display='block';setTimeout(stop_customer_block_notification,1500);</script>";
				unset($_SESSION['customer_block_successful']);
			}
			if(isset($_REQUEST['confirmed_block_customer']))
			{
				$cs_id=trim($_REQUEST['cs_id']);
				try
				{
					$stmt=$conn->prepare("update customer set block_status='1' where customer_id=:cs_id ");
					$stmt->execute(array('cs_id'=>$cs_id));
						
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				$_SESSION['customer_block_successful']='YES';
				header("Location: ow_index.php#customers");
			}
			
			
			//Unblock code segment
			if(isset($_SESSION['customer_unblock_successful']))
			{
				echo "<script>document.getElementById('customer_unblock_notification').style.display='block';setTimeout(stop_customer_unblock_notification,1500);</script>";
				unset($_SESSION['customer_unblock_successful']);
			}
			if(isset($_REQUEST['confirmed_unblock_customer']))
			{
				$cs_id=trim($_REQUEST['cs_id']);
				try
				{
					$stmt=$conn->prepare("update customer set block_status='0' where customer_id=:cs_id ");
					$stmt->execute(array('cs_id'=>$cs_id));
						
				}
				catch(PDOException $e)
				{
					echo "Error: ".$e->getMessage();
				}
				$_SESSION['customer_unblock_successful']='YES';
				header("Location: ow_index.php#customers");
			}
			
			
		?>
		
		<!-- Customer Unblock Confirm Modal -->
			<div id="unblock_customer_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('unblock_customer_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to unblock the customer?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['pls_unblock'])){
								$cs_id=trim($_REQUEST['cs_id']);
					
						?>
								<a href="ow_index.php?confirmed_unblock_customer=YES&cs_id=<?php echo $cs_id; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('unblock_customer_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
		
		
		<!-- Customer Block Confirm Modal -->
			<div id="block_customer_confirm" class="w3-modal">
				<div class="w3-modal-content w3-card-4 w3-animate-zoom">
					<header class="w3-container w3-flat-midnight-blue"> 
						<span onclick="document.getElementById('block_customer_confirm').style.display='none'" class="w3-button w3-flat-midnight-blue w3-xlarge w3-bold w3-display-topright">&times;</span>
						<h2 class="w3-bold" style="font-family: 'Comic Sans MS', cursive, sans-serif;">Confirmation</h2>
					</header>

					<div id="Tokyo" class="w3-container city">
						<p class="w3-bold w3-large">Are you sure to block the customer?</p><br>
					</div>

					<div class="w3-container w3-light-grey w3-padding w3-right-align">
						<?php 
							if(isset($_REQUEST['pls_block'])){
								$cs_id=trim($_REQUEST['cs_id']);
					
						?>
								<a href="ow_index.php?confirmed_block_customer=YES&cs_id=<?php echo $cs_id; ?>" class="w3-button w3-green w3-border w3-round w3-margin-right">Yes</a>
						<?php } ?>
						<button class="w3-button w3-round w3-red w3-border" onclick="document.getElementById('block_customer_confirm').style.display='none'">No</button>
					</div>
				</div>
			</div>
		
		
		
		<?php
			if(isset($_REQUEST['pls_block']))
			{
				echo '<script>document.getElementById("block_customer_confirm").style.display="block";</script>';
			}
			if(isset($_REQUEST['pls_unblock']))
			{
				echo '<script>document.getElementById("unblock_customer_confirm").style.display="block";</script>';
			}
		
		?>
		
		<!-- search list filter -->
		<div id="customers_search_list_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
		
		</div>
		
		<!-- normal filter -->
		<div id="customers_normal_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;">
			<?php
				$sl=0;
				try
				{
					$stmt=$conn->prepare("select * from customer order by customer_id desc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
						$sl++;
			?>
						<div style="width:100%;cursor:pointer;" class=" w3-padding w3-round w3-margin-bottom w3-small w3-container w3-topbar w3-bottombar w3-border w3-border-black <?php if($row['block_status']==0){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?> w3-hover-light-gray">
							<table class="w3-text-left w3-hide-large w3-hide-medium w3-tiny" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:80%;" valign="top">
										<p style="margin:2px;">Name: <font class=""><?php echo $row['first_name'].' '.$row['last_name']; ?></font></p>
										<p style="margin:2px;">Email: <font class="w3-text-blue"><?php echo $row['email']; ?></font></p>
										<p style="margin:2px;">Mobile: <font class="w3-text-blue"><?php echo $row['mobile']; ?></font></p>
										<?php
											if($row['telephone']!="")
											{
										?>
												<p style="margin:2px;">Telephone: <font class="w3-text-blue"><?php echo $row['telephone']; ?></font></p>
										<?php
											}
										?>
										<p style="margin:2px;">Address: <font class=""><?php echo $row['address']; ?></font></p>
										<p style="margin:2px;">Post Code: <font class="w3-text-red"><?php echo $row['post_code']; ?></font></p>
										<p style="margin:2px;">Confirmed: 
										<?php
											if($row['status']=='active')
											{
										?>
											<font class="w3-text-green"><?php echo 'Yes'; ?></font> ( 
											<font class="w3-text-blue"><?php echo $row['date']; ?></font> ) 
										<?php
											}
											else
											{
										?>
											<font class="w3-text-red"><?php echo 'No'; ?></font>
										<?php
											}
										?>
										</p>
									</td>
									<td style="width:20%;" class="w3-center">
										<div class="w3-cell-row">
										  <div class="w3-cell w3-center">
											<img class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="width:50px;height:50px;">
										  </div>
										</div>
										<?php 
											if($row['block_status']==0)
											{
										?>
 												<a href="ow_index.php?pls_block=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Block</button></a>
										<?php
											}
											else 
											{
										?>
												<a href="ow_index.php?pls_unblock=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Unblock</button></a>
										<?php
											}
										?>
									</td>
								</tr>
							</table>
							
														<table class="w3-text-left w3-hide-small" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:80%;" valign="top">
										<p style="margin:2px;">Name: <font class=""><?php echo $row['first_name'].' '.$row['last_name']; ?></font></p>
										<p style="margin:2px;">Email: <font class="w3-text-blue"><?php echo $row['email']; ?></font></p>
										<p style="margin:2px;">Mobile: <font class="w3-text-blue"><?php echo $row['mobile']; ?></font></p>
										<?php
											if($row['telephone']!="")
											{
										?>
												<p style="margin:2px;">Telephone: <font class="w3-text-blue"><?php echo $row['telephone']; ?></font></p>
										<?php
											}
										?>
										<p style="margin:2px;">Address: <font class=""><?php echo $row['address']; ?></font></p>
										<p style="margin:2px;">Post Code: <font class="w3-text-red"><?php echo $row['post_code']; ?></font></p>
										<p style="margin:2px;">Confirmed: 
										<?php
											if($row['status']=='active')
											{
										?>
											<font class="w3-text-green"><?php echo 'Yes'; ?></font> ( 
											<font class="w3-text-blue"><?php echo $row['date']; ?></font> ) 
										<?php
											}
											else
											{
										?>
											<font class="w3-text-red"><?php echo 'No'; ?></font>
										<?php
											}
										?>
										</p>
									</td>
									<td style="width:20%;" class="w3-center">
										<div class="w3-cell-row">
										  <div class="w3-cell w3-center">
											<img class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="width:80px;height:80px;">
										  </div>
										</div>
										<?php 
											if($row['block_status']==0)
											{
										?>
												<a href="ow_index.php?pls_block=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Block</button></a>
										<?php
											}
											else 
											{
										?>
												<a href="ow_index.php?pls_unblock=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Unblock</button></a>
										<?php
											}
										?>
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
					echo '<p style="color:red;padding-top:120px;text-align:center;">No customer joined yet</p>';
			?>
		
		</div>
		
		
		<!-- Block Filter -->
		<div id="customers_block_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
			<?php
				$sl=0;
				try
				{
					$stmt=$conn->prepare("select * from customer where block_status='1' order by customer_id desc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
						$sl++;
			?>
						<div style="width:100%;cursor:pointer;" class=" w3-padding w3-round w3-margin-bottom w3-small w3-container w3-topbar w3-bottombar w3-border w3-border-black <?php if($row['block_status']==0){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?> w3-hover-light-gray">
							<table class="w3-text-left w3-hide-large w3-hide-medium w3-tiny" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:80%;" valign="top">
										<p style="margin:2px;">Name: <font class=""><?php echo $row['first_name'].' '.$row['last_name']; ?></font></p>
										<p style="margin:2px;">Email: <font class="w3-text-blue"><?php echo $row['email']; ?></font></p>
										<p style="margin:2px;">Mobile: <font class="w3-text-blue"><?php echo $row['mobile']; ?></font></p>
										<?php
											if($row['telephone']!="")
											{
										?>
												<p style="margin:2px;">Telephone: <font class="w3-text-blue"><?php echo $row['telephone']; ?></font></p>
										<?php
											}
										?>
										<p style="margin:2px;">Address: <font class=""><?php echo $row['address']; ?></font></p>
										<p style="margin:2px;">Post Code: <font class="w3-text-red"><?php echo $row['post_code']; ?></font></p>
										<p style="margin:2px;">Confirmed: 
										<?php
											if($row['status']=='active')
											{
										?>
											<font class="w3-text-green"><?php echo 'Yes'; ?></font> ( 
											<font class="w3-text-blue"><?php echo $row['date']; ?></font> ) 
										<?php
											}
											else
											{
										?>
											<font class="w3-text-red"><?php echo 'No'; ?></font>
										<?php
											}
										?>
										</p>
									</td>
									<td style="width:20%;" class="w3-center">
										<div class="w3-cell-row">
										  <div class="w3-cell w3-center">
											<img class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="width:50px;height:50px;">
										  </div>
										</div>
										<?php 
											if($row['block_status']==0)
											{
										?>
												<a href="ow_index.php?pls_block=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Block</button></a>
										<?php
											}
											else 
											{
										?>
												<a href="ow_index.php?pls_unblock=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Unblock</button></a>
										<?php
											}
										?>
									</td>
								</tr>
							</table>
							
														<table class="w3-text-left w3-hide-small" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:80%;" valign="top">
										<p style="margin:2px;">Name: <font class=""><?php echo $row['first_name'].' '.$row['last_name']; ?></font></p>
										<p style="margin:2px;">Email: <font class="w3-text-blue"><?php echo $row['email']; ?></font></p>
										<p style="margin:2px;">Mobile: <font class="w3-text-blue"><?php echo $row['mobile']; ?></font></p>
										<?php
											if($row['telephone']!="")
											{
										?>
												<p style="margin:2px;">Telephone: <font class="w3-text-blue"><?php echo $row['telephone']; ?></font></p>
										<?php
											}
										?>
										<p style="margin:2px;">Address: <font class=""><?php echo $row['address']; ?></font></p>
										<p style="margin:2px;">Post Code: <font class="w3-text-red"><?php echo $row['post_code']; ?></font></p>
										<p style="margin:2px;">Confirmed: 
										<?php
											if($row['status']=='active')
											{
										?>
											<font class="w3-text-green"><?php echo 'Yes'; ?></font> ( 
											<font class="w3-text-blue"><?php echo $row['date']; ?></font> ) 
										<?php
											}
											else
											{
										?>
											<font class="w3-text-red"><?php echo 'No'; ?></font>
										<?php
											}
										?>
										</p>
									</td>
									<td style="width:20%;" class="w3-center">
										<div class="w3-cell-row">
										  <div class="w3-cell w3-center">
											<img class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="width:80px;height:80px;">
										  </div>
										</div>
										<?php 
											if($row['block_status']==0)
											{
										?>
												<a href="ow_index.php?pls_block=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Block</button></a>
										<?php
											}
											else 
											{
										?>
												<a href="ow_index.php?pls_unblock=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Unblock</button></a>
										<?php
											}
										?>
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
					echo '<p style="color:red;padding-top:120px;text-align:center;">No customer joined yet</p>';
			?>
		
		</div>
		
		
		<!-- UnBlock Filter -->
		<div id="customers_unblock_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
			<?php
				$sl=0;
				try
				{
					$stmt=$conn->prepare("select * from customer where block_status='0' order by customer_id desc ");
					$stmt->execute();
					$list=$stmt->fetchAll();
					foreach($list as $row)
					{
						$sl++;
			?>
						<div style="width:100%;cursor:pointer;" class=" w3-padding w3-round w3-margin-bottom w3-small w3-container w3-topbar w3-bottombar w3-border w3-border-black <?php if($row['block_status']==0){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?> w3-hover-light-gray">
							<table class="w3-text-left w3-hide-large w3-hide-medium w3-tiny" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:80%;" valign="top">
										<p style="margin:2px;">Name: <font class=""><?php echo $row['first_name'].' '.$row['last_name']; ?></font></p>
										<p style="margin:2px;">Email: <font class="w3-text-blue"><?php echo $row['email']; ?></font></p>
										<p style="margin:2px;">Mobile: <font class="w3-text-blue"><?php echo $row['mobile']; ?></font></p>
										<?php
											if($row['telephone']!="")
											{
										?>
												<p style="margin:2px;">Telephone: <font class="w3-text-blue"><?php echo $row['telephone']; ?></font></p>
										<?php
											}
										?>
										<p style="margin:2px;">Address: <font class=""><?php echo $row['address']; ?></font></p>
										<p style="margin:2px;">Post Code: <font class="w3-text-red"><?php echo $row['post_code']; ?></font></p>
										<p style="margin:2px;">Confirmed: 
										<?php
											if($row['status']=='active')
											{
										?>
											<font class="w3-text-green"><?php echo 'Yes'; ?></font> ( 
											<font class="w3-text-blue"><?php echo $row['date']; ?></font> ) 
										<?php
											}
											else
											{
										?>
											<font class="w3-text-red"><?php echo 'No'; ?></font>
										<?php
											}
										?>
										</p>
									</td>
									<td style="width:20%;" class="w3-center">
										<div class="w3-cell-row">
										  <div class="w3-cell w3-center">
											<img class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="width:50px;height:50px;">
										  </div>
										</div>
										<?php 
											if($row['block_status']==0)
											{
										?>
												<a href="ow_index.php?pls_block=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Block</button></a>
										<?php
											}
											else 
											{
										?>
												<a href="ow_index.php?pls_unblock=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round w3-tiny" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Unblock</button></a>
										<?php
											}
										?>
									</td>
								</tr>
							</table>
							
														<table class="w3-text-left w3-hide-small" style="width:100%;max-width:600px;">
								<tr>
									<td style="width:80%;" valign="top">
										<p style="margin:2px;">Name: <font class=""><?php echo $row['first_name'].' '.$row['last_name']; ?></font></p>
										<p style="margin:2px;">Email: <font class="w3-text-blue"><?php echo $row['email']; ?></font></p>
										<p style="margin:2px;">Mobile: <font class="w3-text-blue"><?php echo $row['mobile']; ?></font></p>
										<?php
											if($row['telephone']!="")
											{
										?>
												<p style="margin:2px;">Telephone: <font class="w3-text-blue"><?php echo $row['telephone']; ?></font></p>
										<?php
											}
										?>
										<p style="margin:2px;">Address: <font class=""><?php echo $row['address']; ?></font></p>
										<p style="margin:2px;">Post Code: <font class="w3-text-red"><?php echo $row['post_code']; ?></font></p>
										<p style="margin:2px;">Confirmed: 
										<?php
											if($row['status']=='active')
											{
										?>
											<font class="w3-text-green"><?php echo 'Yes'; ?></font> ( 
											<font class="w3-text-blue"><?php echo $row['date']; ?></font> ) 
										<?php
											}
											else
											{
										?>
											<font class="w3-text-red"><?php echo 'No'; ?></font>
										<?php
											}
										?>
										</p>
									</td>
									<td style="width:20%;" class="w3-center">
										<div class="w3-cell-row">
										  <div class="w3-cell w3-center">
											<img class="w3-circle w3-topbar w3-bottombar w3-leftbar w3-rightbar" src="../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="width:80px;height:80px;">
										  </div>
										</div>
										<?php 
											if($row['block_status']==0)
											{
										?>
												<a href="ow_index.php?pls_block=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Block</button></a>
										<?php
											}
											else 
											{
										?>
												<a href="ow_index.php?pls_unblock=YES&cs_id=<?php echo $row['customer_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Unblock</button></a>
										<?php
											}
										?>
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
					echo '<p style="color:red;padding-top:120px;text-align:center;">No customer joined yet</p>';
			?>
		
		</div>
		
		
	</div>