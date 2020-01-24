<?php

	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['give_food_offer_suggestion']) && isset($_REQUEST['search_value']))
	{
		$sl=0;
		$search_value=trim($_REQUEST['search_value']);
		//echo '<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom" style="cursor:pointer;">'.$search_value.'</li>';
		try
		{
			$stmt=$conn->prepare("select * from offer_coupon where offer_title LIKE '%$search_value%'  order by offer_id asc ");
			$stmt->execute();
			$list=$stmt->fetchAll();
			foreach($list as $row)
			{
				$sl++;
		?>
				<li onclick="view_food_offer(<?php echo $row['offer_id']; ?>);" class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom w3-small  <?php if($row['visibility']=='1'){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?> " style="cursor:pointer;"><?php echo $row['offer_title']; ?>
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