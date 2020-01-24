<?php

	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['give_food_menu_suggestion']) && isset($_REQUEST['search_value']))
	{
		$sl=0;
		$search_value=trim($_REQUEST['search_value']);
		//echo '<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom" style="cursor:pointer;">'.$search_value.'</li>';
		try
		{
			$stmt=$conn->prepare("select * from food_category where category_name LIKE '%$search_value%'  order by category_id asc ");
			$stmt->execute();
			$list=$stmt->fetchAll();
			foreach($list as $row)
			{
				$sl++;
		?>
				<li onclick="view_food_menu(<?php echo $row['category_id']; ?>);" class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom w3-small  <?php if($row['status']=='active'){ echo 'w3-pale-green'; } else { echo 'w3-pale-red'; } ?> " style="cursor:pointer;"><?php echo $row['category_name']; ?></li>
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