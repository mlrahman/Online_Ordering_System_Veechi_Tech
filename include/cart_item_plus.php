<?php
	include("../library/initialize.php");
	if(isset($_GET['id']) and isset($_GET['do_it']) and isset($_SESSION['cart_item']) and isset($_SESSION['cart_item_quantity']))
	{
		$food_id=$_GET['id'];
		$key=array_search($food_id,$_SESSION['cart_item']);
		if($key!==false)
		{	
			//Item alreday in Cart
			$_SESSION['cart_item_quantity'][$food_id]=$_SESSION['cart_item_quantity'][$food_id]+1;
		}
	}
?>