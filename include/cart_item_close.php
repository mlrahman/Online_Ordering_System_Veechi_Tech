<?php
	
	include("../library/initialize.php");
	if(isset($_GET['id']) and isset($_GET['do_it']) and isset($_SESSION['cart_item']) and isset($_SESSION['cart_item_quantity']))
	{
		$food_id=$_GET['id'];
		
		//Removing Food item and qty from cart
		$key=array_search($food_id,$_SESSION['cart_item']);
		if($key!==false)
			unset($_SESSION['cart_item'][$key]);
		unset($_SESSION['cart_item_quantity'][$food_id]);
		
		$food_name="";
		$food_price=0.0;
		$fl=0;
		foreach($_SESSION['cart_item'] as $item) //it will hold food id
		{
			$fl++;
			try
			{
				$stmt2 = $conn->prepare("select * from food where status='active' AND food_id='$item' order by food_id asc ");
				$stmt2->execute();
				$list2 = $stmt2->fetchAll(); 
				foreach($list2 as $row2)
				{
					$food_name=$row2['food_name'];
					$food_price=$row2['food_price'];
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
?>
	<!-- A single item in cart -->
	<div class="w3-row w3-border-bottom" id="cart_item_<?php echo $item; ?>" onmouseover="show_cart_option('<?php echo $item; ?>')" onmouseout="hide_cart_option('<?php echo $item; ?>');" style="cursor:pointer;">
		<!-- No of Item Details in Cart -->
		<div class="w3-col" style="width:15%;padding: 0px 2px;">
			<!--Cart A single Item qty -->
			<p id="no_of_item_<?php echo $item; ?>" class="w3-left-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;"><?php echo $_SESSION['cart_item_quantity'][$item]; ?> x</p>
			<!--Cart A single Item qty change option -->
			<div id="no_of_button_<?php echo $item; ?>" class="w3-container" style="display:none;margin:0px;padding:0px;width:47%;">
				<a class="w3-tiny w3-border w3-border-black" onclick="plus_cart_item('<?php echo $item; ?>')" style="margin:0px;padding:2px 3px 1px 3px;width:10px;"><i class="fa fa-plus"></i></a>
				<input id="value_<?php echo $item; ?>" class="w3-input-modified w3-tiny w3-center w3-border w3-border-black" style="margin:-1px 0px -4px 0px;padding:0px;width:10px;width:100%;font-family:Arial;" disabled>
				<a class="w3-tiny w3-border w3-border-black" onclick="minus_cart_item('<?php echo $item; ?>')" style="margin:0px;padding:2px 3px 0px 3px;width:10px;"><i class="fa fa-minus"></i></a>
			</div>
		</div>
		<!-- A single item title -->
		<div class="w3-col" style="width:65%;padding: 23px 2px;">
			<p class="w3-left-align w3-small w3-opacity" style="margin:0px;padding:0px;font-family:Arial;">
				<?php echo $food_name; ?>
			</p>
		</div>
		<!-- Item Amount details in cart -->
		<div class="w3-col" style="width:20%;padding: 0px 2px;">
			<!-- A single item price -->
			<p id="close_item_<?php echo $item; ?>" class="w3-right-align w3-small w3-opacity" style="margin:23px 0px 0px 0px;padding:0px;font-family:Arial;"><?php $food_qty=$_SESSION['cart_item_quantity'][$item]; $single_amount=($food_price*$food_qty); $single_amount=number_format($single_amount, 2, '.', ''); echo $single_amount;?></p>
			<!-- A single item remove option --> 
			<p id="close_button_<?php echo $item; ?>" class="w3-right-align w3-large w3-opacity" style="display:none;margin:17px 0px 0px 0px;padding:0px;font-family:Arial;"><i class="fa fa-window-close-o" onclick="cart_item_close('<?php echo $item; ?>')"></i></p>
		</div>
	</div>
<?php
		}
		if($fl==0)
			$_SESSION['cart_coupon']=0;
	}
?>