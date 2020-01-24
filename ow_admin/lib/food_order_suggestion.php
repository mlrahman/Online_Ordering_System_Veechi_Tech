<?php

	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['give_food_order_suggestion']) && isset($_REQUEST['search_value']))
	{
		$sl=0;
		$search_value=trim($_REQUEST['search_value']);
		//echo '<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom" style="cursor:pointer;">'.$search_value.'</li>';
		try
		{
			$stmt=$conn->prepare("select * from order_info where order_id LIKE '%$search_value%' OR customer_id IN(select customer_id from customer where first_name LIKE '%$search_value%' or last_name LIKE '%$search_value%')  order by order_id asc ");
			$stmt->execute();
			$list=$stmt->fetchAll();
			foreach($list as $row)
			{
				$sl++;
				$coupon_code=$row['coupon_code'];
					$order_id=$row['order_id'];
					$customer_id=$row['customer_id'];
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
					
					
					$stmt4 = $conn->prepare("select * from customer where customer_id='$customer_id' ");
					$stmt4->execute();
					$list4 = $stmt4->fetchAll();
		?>
				<li onclick="view_food_order(<?php echo $row['order_id']; ?>);" class="w3-border w3-hover-light-gray w3-border-bottom w3-small" style="cursor:pointer;padding:2px 0px;">
					<div class="w3-row">
						<div class="w3-bold w3-col" style="width:30%;">
							<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $row['order_id']; ?></p>
						</div>
						<div class="w3-bold w3-col w3-left-align" style="width:35%;">
							<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
						</div>
						<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:35%;">
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
					</div>
					
				</li>
		<?php					
			}
		}
		catch(PDOException $e)
		{
			echo "Error: ".$e->getMessage();
		}
		if($sl==0)
			echo '<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom w3-small w3-text-red" style="cursor:pointer;"><i class="fa fa-exclamation-triangle"></i> Oops! No suggestion</li>';
			
	}
?>