<?php
	//DB Connection update required for a new hosting
	include("../../library/initialize.php");
	if(isset($_REQUEST['change_status']) && isset($_REQUEST['order_id']))
	{
		$order_id=trim($_REQUEST['order_id']);
		try
		{
			$stmt=$conn->prepare("update order_info set status='Cancelled' where order_id=:order_id ");
			$stmt->execute(array('order_id'=>$order_id));
			
		}catch(PDOException $e)
		{
			echo "Error: ".$e->getMessage();
		}
	
	
	}

?>