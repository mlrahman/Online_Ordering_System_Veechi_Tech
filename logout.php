<?php
	//Requested
	
	session_start();
	if(isset($_REQUEST['access']) && isset($_REQUEST['link']))
	{
		unset($_SESSION['logged_in']);
		unset($_SESSION['customer_id']);
		unset($_SESSION['customer_email']);
		unset($_SESSION['customer_image']);
		unset($_SESSION['customer_first_name']);
		unset($_SESSION['customer_last_name']);
	}
	
	header("Location: order_online.php");
	
?>