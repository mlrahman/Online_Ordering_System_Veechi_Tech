<?php


	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['give_customer_search_list']) && isset($_REQUEST['customer_id']))
	{
		$customer_id=trim($_REQUEST['customer_id']);
		$search_value=trim($_REQUEST['search_value']);
		
				$sl=0;
				try
				{
					if($customer_id!=0)
						$stmt=$conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id desc ");
					else
						$stmt=$conn->prepare("select * from customer where email LIKE '%$search_value%' OR first_name LIKE '%$search_value%' OR last_name LIKE '%$search_value%'  order by customer_id asc ");
			
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
			
		

	
	}
?>