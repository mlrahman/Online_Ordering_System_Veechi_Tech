<?php


	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['give_food_offer_search_list']) && isset($_REQUEST['offer_id']))
	{
		$offer_id=trim($_REQUEST['offer_id']);
		$search_value=trim($_REQUEST['search_value']);
		
				$sl=0;
				try
				{
					if($offer_id!=0)
						$stmt=$conn->prepare("select * from offer_coupon where offer_id='$offer_id' order by offer_id desc ");
					else
						$stmt=$conn->prepare("select * from offer_coupon where offer_title LIKE '%$search_value%'  order by offer_id desc ");
			
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
										<p style="margin:2px;">Offer: <font class="w3-text-blue"><?php echo $row['offer_title'] ?></font></p>
										
									</td>
									<td style="width:30%;" class="w3-center">
										<?php 
											if($row['visibility']=='1')
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_hide_fo=YES&food_id=<?php echo $row['food_id']; ?>"><button class="w3-button w3-red w3-round" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye-slash"></i> Hide</button></a>
										<?php
											}
											else 
											{
										?>
												<a class="w3-left" href="ow_index.php?pls_show_fo=YES&food_id=<?php echo $row['food_id']; ?>"><button class="w3-button w3-round w3-green" style="padding:2px 5px;margin-top:5px;"><i class="fa fa-eye"></i> Show</button></a>
										<?php
											}
										?>
										<a class="w3-left" href="ow_index.php?edit_food_offer_list=YES&food_id=<?php echo $row['food_id']; ?>"><button class="w3-button w3-teal w3-round" style="padding:2px 5px;margin-top:5px;margin-left:5px;"><i class="fa fa-edit"></i> Edit</button></a>
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
					echo '<p style="color:red;padding-top:120px;text-align:center;">No food offer added yet</p>';
			
		

	
	}
?>