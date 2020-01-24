<?php

	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['give_customer_suggestion']) && isset($_REQUEST['search_value']))
	{
		$sl=0;
		$search_value=trim($_REQUEST['search_value']);
		//echo '<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom" style="cursor:pointer;">'.$search_value.'</li>';
		try
		{
			$stmt=$conn->prepare("select * from customer where email LIKE '%$search_value%' OR first_name LIKE '%$search_value%' OR last_name LIKE '%$search_value%'  order by customer_id asc ");
			$stmt->execute();
			$list=$stmt->fetchAll();
			foreach($list as $row)
			{
				$sl++;
		?>
				<li onclick="view_customer(<?php echo $row['customer_id']; ?>);" class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom w3-small  <?php if($row['block_status']==0){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?> " style="cursor:pointer;"><img class="w3-cell w3-round w3-left" src="../../images/customer/<?php if($row['image']!=""){ echo $row['image']; } else { echo 'default.png'; } ?>" style="height:17px;width:17px;margin-right:5px;"/> <?php echo $row['first_name'].' '.$row['last_name']; ?></li>
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