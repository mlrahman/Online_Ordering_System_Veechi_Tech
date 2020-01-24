<?php
	include("../library/initialize.php");
	if(isset($_GET['id']) and isset($_GET['do_it']) and isset($_SESSION['cart_item']) and isset($_SESSION['cart_item_quantity']))
	{
		$food_id=$_GET['id'];
		$key=array_search($food_id,$_SESSION['cart_item']);
		if($key!==false)
		{	
			//Item alreday in Cart
			$_SESSION['cart_item_quantity'][$food_id]=$_SESSION['cart_item_quantity'][$food_id]-1;
			if($_SESSION['cart_item_quantity'][$food_id]==0)
			{
				$key=array_search($food_id,$_SESSION['cart_item']);
				if($key!==false)
					unset($_SESSION['cart_item'][$key]);
				unset($_SESSION['cart_item_quantity'][$food_id]);
			}
		}
		$fl=0;
		foreach($_SESSION['cart_item'] as $item) //it will hold food id
		{
			$fl++;
		}
		if($fl==0)
			$_SESSION['cart_coupon']=0; 
	}
?>