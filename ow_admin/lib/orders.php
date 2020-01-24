<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
	
	<script>
	
		var audio = new Audio('../images/system/notification.mp3');
	
		//audio.play();
		
		var total_products=0;
		
		var timer_object;
	
		function general_print_token(option,id)
		{
			var content = document.getElementById(option+id).innerHTML;
			
			var objDiv = document.getElementById("orders");
			
			//console.log(objDiv.offsetTop);
			
			var zz=objDiv.offsetTop;
			
			var old_content = document.getElementById('main_content').innerHTML;
			
			document.getElementById('main_content').innerHTML = content;
			
			window.print();
			
			document.getElementById('main_content').innerHTML = old_content;
			
			document.body.scrollTop = zz;
		}
	
	
		function print_token(option,id)
		{
			var content = document.getElementById(option+id).innerHTML;
			
			var objDiv = document.getElementById("orders");
			
			//console.log(objDiv.offsetTop);
			
			var zz=objDiv.offsetTop;
			
			var old_content = document.getElementById('main_content').innerHTML;
			
			document.getElementById('main_content').innerHTML = content;
			
			window.print();
			
			document.getElementById('main_content').innerHTML = old_content;
			
			document.body.scrollTop = zz;
			
			change_status(id);

		}
	
		function change_status(id)
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					
					//done
					
					//auto_refresh();
					clearTimeout(timer_object);
					auto_refresh();
					
			   }
			};
			xhttp.open("GET", "lib/order_processing.php?change_status=YES&order_id="+id, true);
			xhttp.send(); 
			
			
		}
		
		function auto_refresh()
		{
			
			//console.log('Auto Refresh called');
			
			//get all orders
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//retreive successful
					var xxxy=this.responseText;
					document.getElementById('all_order').innerHTML=xxxy;
					var index=(xxxy.length)-5, x="";
					while(xxxy[index]>='0' && xxxy[index]<='9')
					{
						x=x+xxxy[index];
						index=index-1;
					}
					var xy="";
					for(var i=x.length-1;i>=0;i--)
						xy=xy+x[i];
					var new_total_products=parseInt(xy);
					//console.log(new_total_products);
					if(new_total_products>total_products)
					{
						audio.play();
						total_products=new_total_products;
					}
				}
			};
			xhttp.open("GET", "lib/get_all_orders.php?sure=YES", true);
			xhttp.send(); 
			
			
			
			//get all queue orders
			var xhttp1 = new XMLHttpRequest();
			xhttp1.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//retreive successful
					document.getElementById('in_queue').innerHTML=this.responseText;
				}
			};
			xhttp1.open("GET", "lib/get_all_queue_orders.php?sure=YES", true);
			xhttp1.send();
			
			
			//get all processing orders
			var xhttp2 = new XMLHttpRequest();
			xhttp2.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//retreive successful
					document.getElementById('processing').innerHTML=this.responseText;
				}
			};
			xhttp2.open("GET", "lib/get_all_processing_orders.php?sure=YES", true);
			xhttp2.send();
			
			
			//get all Delivered orders
			var xhttp3 = new XMLHttpRequest();
			xhttp3.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//retreive successful
					document.getElementById('delivered').innerHTML=this.responseText;
				}
			};
			xhttp3.open("GET", "lib/get_all_delivered_orders.php?sure=YES", true);
			xhttp3.send();
			
			
			//get all cancelled orders
			var xhttp4 = new XMLHttpRequest();
			xhttp4.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					//retreive successful
					document.getElementById('cancelled').innerHTML=this.responseText;
				}
			};
			xhttp4.open("GET", "lib/get_all_cancelled_orders.php?sure=YES", true);
			xhttp4.send();
			
			
			timer_object = setTimeout(auto_refresh, 5000);
		}	
		
	</script>
	
	
	<div class="w3-container" style="margin-top:80px" id="orders">
		<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Orders</b></h1>
		<hr style="width:50px;border:5px solid black;" class="w3-round">
		<p> This option is used for <font color="red">update order status</font> of <?php echo $website_title; ?>.</p>
		
		
		<!-- Order history will show here -->
		<div class="w3-container" style="padding:0px;margin:0px 0px 0px 0px;width:100%;max-width:700px;">
			<div class="w3-right w3-text-right" style="width:100%;max-width:724px;">
					
				
				
				
				
				
				<button class="w3-button w3-brown w3-round w3-small w3-right w3-hide-small" style="padding:3px 5px;margin-left:5px;" onclick="view_food_order(0)"><i class="fa fa-search"></i> Search</button>
				<button class="w3-button w3-brown w3-round w3-small w3-right w3-hide-large w3-hide-medium" style="padding:3px 5px;margin-left:5px;" onclick="view_food_order(0)"><i class="fa fa-search w3-bold"></i></button>
				
				<div class="w3-right" style="width:80%;max-width:180px;margin-left:5px;">
					<input type="text" id="food_order_search_value" oninput="get_food_order_suggestion()"  onfocus="get_food_order_suggestion()" class=" w3-round w3-small " placeholder=" Search" style="width:100%;">
					<ul id="food_order_suggestion" class="w3-container w3-white w3-round w3-border-black w3-border-right w3-border-left w3-border-bottom" style="display:none;margin:2px 0px 0px 0px;padding:0px;position:absolute;width:100%;max-width:252px;list-style-type:none;height:auto;max-height:150px;overflow:auto;">
						
					</ul>
				</div>
				
				
				<a onclick="cancelled_btn()" class="w3-right w3-round w3-red w3-button  w3-small  w3-padding-small" style="margin-right:5px;cursor:pointer;margin-bottom:10px;">Cancelled</a>	
				
				<a onclick="delivered_btn()" class="w3-right w3-round  w3-green w3-button  w3-small w3-padding-small" style="margin-right:5px;cursor:pointer;margin-bottom:10px;">Delivered</a>
				
				<a onclick="processing_btn()" style="margin-right:5px;cursor:pointer;margin-bottom:10px;" class="w3-right w3-round w3-teal w3-button  w3-small w3-padding-small">Processing</a>
				
				<a onclick="in_queue_btn()" class="w3-right w3-round w3-blue w3-button w3-padding-small w3-small" style="margin-right:5px;cursor:pointer;margin-bottom:10px;">In Queue</a>
				
				<script>
				
				function search_refresh(id,val)
				{
					//Ajax for text upload
					var xhttp2 = new XMLHttpRequest();
					xhttp2.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							//retrive image_name
							var image_name=this.responseText;
							document.getElementById('food_order_search_list_container').innerHTML=image_name;							
									
							
							
							document.getElementById('all_order').style.display='none';
							document.getElementById('in_queue').style.display='none'; 
							document.getElementById('delivered').style.display='none';
							document.getElementById('cancelled').style.display='none';
							
							document.getElementById('food_order_search_list_container').style.display='block';
							
						}
					};
					xhttp2.open("POST", "lib/food_order_search_list_show.php?give_food_order_search_list=yes&order_id="+id+"&search_value="+val, true);
					xhttp2.send();
				}
				
				function view_food_order(id)
				{
					
					var val=document.getElementById('food_order_search_value').value.trim();
					document.getElementById('food_order_search_value').value='';
					var search_box=document.getElementById('food_order_suggestion');
					
					
					search_box.innerHTML='';
					search_box.style.display='none';
					//Ajax for text upload
					var xhttp2 = new XMLHttpRequest();
					xhttp2.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							//retrive image_name
							var image_name=this.responseText;
							document.getElementById('food_order_search_list_container').innerHTML=image_name;							
									
							
							
							document.getElementById('all_order').style.display='none';
							document.getElementById('in_queue').style.display='none'; 
							document.getElementById('delivered').style.display='none';
							document.getElementById('cancelled').style.display='none';
							
							document.getElementById('food_order_search_list_container').style.display='block';
							
						}
					};
					xhttp2.open("POST", "lib/food_order_search_list_show.php?give_food_order_search_list=yes&order_id="+id+"&search_value="+val, true);
					xhttp2.send();
				}
				
				
				
				function get_food_order_suggestion()
				{
					var search=document.getElementById('food_order_search_value').value.trim();
					var search_box=document.getElementById('food_order_suggestion');
						
					
					if(search==""){
						search_box.innerHTML='';
						search_box.style.display='none';
					}
					else
					{
						search_box.style.display='block';
						search_box.innerHTML='<li class="w3-border w3-hover-light-gray w3-padding-small w3-border-bottom"><i class="fa fa-refresh w3-spin w3-center w3-text-red"></i> Please Wait...</li>';
						//Ajax for text upload
						var xhttp1 = new XMLHttpRequest();
						xhttp1.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								//retrive image_name
								var image_name=this.responseText;
								search_box.innerHTML=image_name;	
								
								//Error Checking
								//console.log(image_name);
							}
						};
						xhttp1.open("POST", "lib/food_order_suggestion.php?give_food_order_suggestion=yes&search_value="+search, true);
						xhttp1.send();
					}
				}


					var in_queue_fl=0;
					function in_queue_btn()
					{
						if(in_queue_fl==0)
						{
							document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('all_order').style.display='none';document.getElementById('in_queue').style.display='block';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';
							in_queue_fl=1;
						}
						else
						{
							document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('all_order').style.display='block';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';
							in_queue_fl=0;
						}
					}
					
					
					var processing_fl=0;
					function processing_btn()
					{
						if(processing_fl==0)
						{
							document.getElementById('all_order').style.display='none';document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='block';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';
							processing_fl=1;
						}
						else
						{
							document.getElementById('all_order').style.display='block';document.getElementById('in_queue').style.display='none';document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';
							processing_fl=0;
						}
					}
					
					var delivered_fl=0;
					function delivered_btn()
					{
						if(delivered_fl==0)
						{
							document.getElementById('all_order').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('delivered').style.display='block';document.getElementById('cancelled').style.display='none';
							delivered_fl=1;
						}
						else
						{
							document.getElementById('all_order').style.display='block';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('cancelled').style.display='none';
							delivered_fl=0;
						}
					}
					
					var cancelled_fl=0;
					function cancelled_btn()
					{
						if(cancelled_fl==0)
						{
							document.getElementById('all_order').style.display='none';document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='block';
							cancelled_fl=1;
						}
						else
						{
							document.getElementById('all_order').style.display='block';document.getElementById('food_order_search_list_container').style.display='none';document.getElementById('in_queue').style.display='none';document.getElementById('processing').style.display='none';document.getElementById('delivered').style.display='none';document.getElementById('cancelled').style.display='none';
							cancelled_fl=0;
						}
					}
					
					function delivery_done(id)
					{
						var z = confirm("Are you sure to change the order status into Delivered?");
						if (z == true) {
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									
									//done
									
									//auto_refresh();
									clearTimeout(timer_object);
									auto_refresh();
									
							   }
							};
							xhttp.open("GET", "lib/order_processing_delivered.php?change_status=YES&order_id="+id, true);
							xhttp.send(); 
						
						} 
						
					}
					function cancel_done(id)
					{
						var z = confirm("Are you sure to change the order status into Cancelled?");
						if (z == true) {
							var xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									
									//done
									
									//auto_refresh();
									clearTimeout(timer_object);
									auto_refresh();
									
							   }
							};
							xhttp.open("GET", "lib/order_processing_cancelled.php?change_status=YES&order_id="+id, true);
							xhttp.send(); 
						
						}
						
					}
				
				</script>
				
				
			</div>
		</div>
		
		
		<div id="food_order_search_list_container" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
		
		</div>
		
		
		<div id="all_order" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;">
		
		<?php 
			try
			{

				$stmt = $conn->prepare("select * from order_info order by order_id desc ");
				$stmt->execute();
				$list = $stmt->fetchAll();
				$sl=0;
				echo '<script>total_products='.count($list).'; </script>';
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
					<!-- A single order -->
					<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-white w3-round w3-border-black" style="margin: 0px 0px 12px 0px;">
						<div class="w3-row">
							<div class="w3-bold w3-col" style="width:25%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $row['order_id']; ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align" style="width:30%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:20%;">
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
							<div class="w3-col " style="width:25%;">
								<a id="all_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('all_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('all_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('all_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;">Details</a>
								<a id="all_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('all_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('all_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('all_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;float:left;">Hide</a>
								<?php
									if($row['status']=="In Queue")
									{
								?>
										<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="print_token('all_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
								<?php
									}
									else if($row['status']=="Processing")
									{
								?>
										<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="general_print_token('all_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
										<i class="fa fa-check-square-o w3-text-blue" style="padding:2px 4px;margin-right:8px;float:left;cursor:pointer;" title="Order Delivered Successfull" onclick="delivery_done(<?php echo $row['order_id']; ?>)"></i>
										<i class="fa fa-close w3-text-red" style="padding:2px 4px;margin-right:8px;float:left;cursor:pointer;" title="Order Cancelled" onclick="cancel_done(<?php echo $row['order_id']; ?>)"></i>
								<?php
									}
									else
									{
								?>
										<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="general_print_token('all_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
								
								<?php
									}
								?>
							</div>
						</div>
						<!-- Order Details -->
						<div id="all_details_<?php echo $row['order_id']; ?>" class="w3-pale-red w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
							<!-- Order date & time -->
							<div class="w3-row">
								<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
									Time: <?php echo $row['time']; ?>
								</div>
								<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
									Date: <?php echo $row['date']; ?>
								</div>
							</div>
							<!-- Personal Info -->
							<div class="w3-row w3-white w3-topbar w3-bottombar" style="margin-bottom:4px;padding:0px;">
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-top:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Name: <font class="w3-text-black w3-bold"><?php echo $list4[0]['first_name'].' '.$list4[0]['last_name']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Email: <font class="w3-text-blue w3-bold"><?php echo $list4[0]['email']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-bottom:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Mobile: <font class="w3-text-black w3-bold"><?php echo $list4[0]['mobile']; ?></font></p>
								</div>
							</div>
							
							
							<div class="w3-container w3-border w3-white w3-topbar w3-bottombar" style="padding:4px 4px 4px 4px;margin:5px 0px;padding-top:4px;">
								<?php
									$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
									$stmt4->execute();
									$list4 = $stmt4->fetchAll();
									foreach($list4 as $row4)
									{
										$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
										$stmt5->execute();
										$list5 = $stmt5->fetchAll();
								?>
											<!-- A single item in order -->
											<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
												<div class="w3-col w3-left-align " style="width:20%;margin-top:4px;">
													<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
												</div>
												<div class="w3-col w3-left-align " style="width:55%;">
													<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
												</div>
												<div class="w3-col w3-right-align " style="width:25%;">
													<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
												</div>
											</div>
								<?php
									}
								?>
								<!-- Order information related to this order -->
								<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
									</div>
									<div class="w3-col" style="width:2%;margin-top:4px;">
									&nbsp
									</div>
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
									</div>
								</div>
								<?php 
									if($d_per!=0)
									{
								?>
									<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
										<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
											<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
										</div>
									</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
									</div>
								</div>
								<?php 
									if($row['advice']!="")
									{
								?>
										<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
											<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
												<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
											</div>
										</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="padding:0px;">
									<div class="w3-col w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
										<?php 
											if($row['address']=="")
											{
												$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
												$stmt6->execute();
												$list6 = $stmt6->fetchAll();
												echo $list6[0]['address'];
											}
											else
												echo $row['address'];
										?>
										</font></p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			if($sl==0)
			{
		?>
				<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
		<?php
			}
		?>
		
		
		</div>
	
	
	
		<div id="in_queue" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
		
		<?php 
			try
			{

				$stmt = $conn->prepare("select * from order_info where status='In Queue' order by order_id desc ");
				$stmt->execute();
				$list = $stmt->fetchAll();
				$sl=0;
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
					<!-- A single order -->
					<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-white w3-round w3-border-black" style="margin: 0px 0px 12px 0px;">
						<div class="w3-row">
							<div class="w3-bold w3-col" style="width:25%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $row['order_id']; ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align" style="width:30%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:20%;">
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
							<div class="w3-col " style="width:25%;">
								<a id="in_queue_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('in_queue_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('in_queue_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('in_queue_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;">Details</a>
								<a id="in_queue_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('in_queue_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('in_queue_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('in_queue_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;float:left;">Hide</a>
								<?php
									if($row['status']=="In Queue")
									{
								?>
										<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="print_token('in_queue_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
								<?php
									}
								?>
							</div>
						</div>
						<!-- Order Details -->
						<div id="in_queue_details_<?php echo $row['order_id']; ?>" class="w3-pale-red w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
							<!-- Order date & time -->
							<div class="w3-row">
								<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
									Time: <?php echo $row['time']; ?>
								</div>
								<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
									Date: <?php echo $row['date']; ?>
								</div>
							</div>
							<!-- Personal Info -->
							<div class="w3-row w3-white w3-topbar w3-bottombar" style="margin-bottom:4px;padding:0px;">
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-top:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Name: <font class="w3-text-black w3-bold"><?php echo $list4[0]['first_name'].' '.$list4[0]['last_name']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Email: <font class="w3-text-blue w3-bold"><?php echo $list4[0]['email']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-bottom:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Mobile: <font class="w3-text-black w3-bold"><?php echo $list4[0]['mobile']; ?></font></p>
								</div>
							</div>
							
							
							<div class="w3-container w3-border w3-white w3-topbar w3-bottombar" style="padding:4px 4px 4px 4px;margin:5px 0px;padding-top:4px;">
								<?php
									$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
									$stmt4->execute();
									$list4 = $stmt4->fetchAll();
									foreach($list4 as $row4)
									{
										$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
										$stmt5->execute();
										$list5 = $stmt5->fetchAll();
								?>
											<!-- A single item in order -->
											<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
												<div class="w3-col w3-left-align " style="width:20%;margin-top:4px;">
													<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
												</div>
												<div class="w3-col w3-left-align " style="width:55%;">
													<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
												</div>
												<div class="w3-col w3-right-align " style="width:25%;">
													<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
												</div>
											</div>
								<?php
									}
								?>
								<!-- Order information related to this order -->
								<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
									</div>
									<div class="w3-col" style="width:2%;margin-top:4px;">
									&nbsp
									</div>
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
									</div>
								</div>
								<?php 
									if($d_per!=0)
									{
								?>
									<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
										<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
											<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
										</div>
									</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
									</div>
								</div>
								<?php 
									if($row['advice']!="")
									{
								?>
										<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
											<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
												<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
											</div>
										</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="padding:0px;">
									<div class="w3-col w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
										<?php 
											if($row['address']=="")
											{
												$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
												$stmt6->execute();
												$list6 = $stmt6->fetchAll();
												echo $list6[0]['address'];
											}
											else
												echo $row['address'];
										?>
										</font></p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			if($sl==0)
			{
		?>
				<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
		<?php
			}
		?>
		</div>
		
		<div id="processing" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
		
		<?php 
			try
			{

				$stmt = $conn->prepare("select * from order_info where status='Processing' order by order_id desc ");
				$stmt->execute();
				$list = $stmt->fetchAll();
				$sl=0;
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
					<!-- A single order -->
					<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-white w3-round w3-border-black" style="margin: 0px 0px 12px 0px;">
						<div class="w3-row">
							<div class="w3-bold w3-col" style="width:25%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $row['order_id']; ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align" style="width:30%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:20%;">
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
							<div class="w3-col " style="width:25%;">
								<a id="processing_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('processing_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('processing_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('processing_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;">Details</a>
								<a id="processing_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('processing_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('processing_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('processing_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;float:left;">Hide</a>
								<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="general_print_token('all_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
								<i class="fa fa-check-square-o w3-text-blue" style="padding:2px 4px;margin-right:8px;float:left;cursor:pointer;" title="Order Delivered Successfull" onclick="delivery_done(<?php echo $row['order_id']; ?>)"></i>
								<i class="fa fa-close w3-text-red" style="padding:2px 4px;margin-right:8px;float:left;cursor:pointer;" title="Order Cancelled" onclick="cancel_done(<?php echo $row['order_id']; ?>)"></i>
							</div>
						</div>
						<!-- Order Details -->
						<div id="processing_details_<?php echo $row['order_id']; ?>" class="w3-pale-red w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
							<!-- Order date & time -->
							<div class="w3-row">
								<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
									Time: <?php echo $row['time']; ?>
								</div>
								<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
									Date: <?php echo $row['date']; ?>
								</div>
							</div>
							<!-- Personal Info -->
							<div class="w3-row w3-white w3-topbar w3-bottombar" style="margin-bottom:4px;padding:0px;">
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-top:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Name: <font class="w3-text-black w3-bold"><?php echo $list4[0]['first_name'].' '.$list4[0]['last_name']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Email: <font class="w3-text-blue w3-bold"><?php echo $list4[0]['email']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-bottom:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Mobile: <font class="w3-text-black w3-bold"><?php echo $list4[0]['mobile']; ?></font></p>
								</div>
							</div>
							
							
							<div class="w3-container w3-border w3-white w3-topbar w3-bottombar" style="padding:4px 4px 4px 4px;margin:5px 0px;padding-top:4px;">
								<?php
									$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
									$stmt4->execute();
									$list4 = $stmt4->fetchAll();
									foreach($list4 as $row4)
									{
										$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
										$stmt5->execute();
										$list5 = $stmt5->fetchAll();
								?>
											<!-- A single item in order -->
											<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
												<div class="w3-col w3-left-align " style="width:20%;margin-top:4px;">
													<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
												</div>
												<div class="w3-col w3-left-align " style="width:55%;">
													<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
												</div>
												<div class="w3-col w3-right-align " style="width:25%;">
													<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
												</div>
											</div>
								<?php
									}
								?>
								<!-- Order information related to this order -->
								<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
									</div>
									<div class="w3-col" style="width:2%;margin-top:4px;">
									&nbsp
									</div>
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
									</div>
								</div>
								<?php 
									if($d_per!=0)
									{
								?>
									<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
										<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
											<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
										</div>
									</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
									</div>
								</div>
								<?php 
									if($row['advice']!="")
									{
								?>
										<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
											<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
												<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
											</div>
										</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="padding:0px;">
									<div class="w3-col w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
										<?php 
											if($row['address']=="")
											{
												$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
												$stmt6->execute();
												$list6 = $stmt6->fetchAll();
												echo $list6[0]['address'];
											}
											else
												echo $row['address'];
										?>
										</font></p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			if($sl==0)
			{
		?>
				<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
		<?php
			}
		?>
		
		</div>
	
	
	
		<div id="delivered" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
		
		<?php 
			try
			{

				$stmt = $conn->prepare("select * from order_info where status='Delivered' order by order_id desc ");
				$stmt->execute();
				$list = $stmt->fetchAll();
				$sl=0;
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
					<!-- A single order -->
					<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-white w3-round w3-border-black" style="margin: 0px 0px 12px 0px;">
						<div class="w3-row">
							<div class="w3-bold w3-col" style="width:25%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $row['order_id']; ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align" style="width:30%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:20%;">
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
							<div class="w3-col " style="width:25%;">
								<a id="delivered_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('delivered_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('delivered_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('delivered_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;">Details</a>
								<a id="delivered_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('delivered_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('delivered_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('delivered_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;float:left;">Hide</a>
								<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="general_print_token('all_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
							</div>
						</div>
						<!-- Order Details -->
						<div id="delivered_details_<?php echo $row['order_id']; ?>" class="w3-pale-red w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
							<!-- Order date & time -->
							<div class="w3-row">
								<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
									Time: <?php echo $row['time']; ?>
								</div>
								<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
									Date: <?php echo $row['date']; ?>
								</div>
							</div>
							<!-- Personal Info -->
							<div class="w3-row w3-white w3-topbar w3-bottombar" style="margin-bottom:4px;padding:0px;">
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-top:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Name: <font class="w3-text-black w3-bold"><?php echo $list4[0]['first_name'].' '.$list4[0]['last_name']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Email: <font class="w3-text-blue w3-bold"><?php echo $list4[0]['email']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-bottom:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Mobile: <font class="w3-text-black w3-bold"><?php echo $list4[0]['mobile']; ?></font></p>
								</div>
							</div>
							
							
							<div class="w3-container w3-border w3-white w3-topbar w3-bottombar" style="padding:4px 4px 4px 4px;margin:5px 0px;padding-top:4px;">
								<?php
									$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
									$stmt4->execute();
									$list4 = $stmt4->fetchAll();
									foreach($list4 as $row4)
									{
										$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
										$stmt5->execute();
										$list5 = $stmt5->fetchAll();
								?>
											<!-- A single item in order -->
											<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
												<div class="w3-col w3-left-align " style="width:20%;margin-top:4px;">
													<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
												</div>
												<div class="w3-col w3-left-align " style="width:55%;">
													<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
												</div>
												<div class="w3-col w3-right-align " style="width:25%;">
													<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
												</div>
											</div>
								<?php
									}
								?>
								<!-- Order information related to this order -->
								<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
									</div>
									<div class="w3-col" style="width:2%;margin-top:4px;">
									&nbsp
									</div>
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
									</div>
								</div>
								<?php 
									if($d_per!=0)
									{
								?>
									<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
										<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
											<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
										</div>
									</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
									</div>
								</div>
								<?php 
									if($row['advice']!="")
									{
								?>
										<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
											<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
												<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
											</div>
										</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="padding:0px;">
									<div class="w3-col w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
										<?php 
											if($row['address']=="")
											{
												$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
												$stmt6->execute();
												$list6 = $stmt6->fetchAll();
												echo $list6[0]['address'];
											}
											else
												echo $row['address'];
										?>
										</font></p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			if($sl==0)
			{
		?>
				<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
		<?php
			}
		?>
		</div>
	
		<div id="cancelled" class="w3-container w3-light-gray w3-leftbar w3-rightbar w3-bottombar w3-topbar" style="height:400px;overflow:auto;width:100%;max-width:700px;padding: 16px 6px 0px 6px;display:none;">
		
		<?php 
			try
			{

				$stmt = $conn->prepare("select * from order_info where status='Cancelled' order by order_id desc ");
				$stmt->execute();
				$list = $stmt->fetchAll();
				$sl=0;
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
					<!-- A single order -->
					<div class="w3-medium w3-topbar w3-bottombar w3-container w3-border w3-padding-small w3-white w3-round w3-border-black" style="margin: 0px 0px 12px 0px;">
						<div class="w3-row">
							<div class="w3-bold w3-col" style="width:25%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Order #<?php echo $row['order_id']; ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align" style="width:30%;">
								<p class="" style="margin:0px 0px 0px 4px;padding:0px;">Total: &pound;<?php echo  number_format($total, 2, '.', ''); ?></p>
							</div>
							<div class="w3-bold w3-col w3-left-align w3-tiny" style="width:20%;">
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
							<div class="w3-col " style="width:25%;">
								<a id="cancelled_btn_<?php echo $row['order_id']; ?>" onclick="document.getElementById('cancelled_btn_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('cancelled_btn_hide_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('cancelled_details_<?php echo $row['order_id']; ?>').style.display='block';" class="w3-button w3-green w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;">Details</a>
								<a id="cancelled_btn_hide_<?php echo $row['order_id']; ?>" onclick="document.getElementById('cancelled_btn_<?php echo $row['order_id']; ?>').style.display='block';document.getElementById('cancelled_btn_hide_<?php echo $row['order_id']; ?>').style.display='none';document.getElementById('cancelled_details_<?php echo $row['order_id']; ?>').style.display='none';" class="w3-button w3-red w3-round w3-tiny" style="padding:2px 4px;display:none;width:40px;margin-right:8px;float:left;">Hide</a>
								<a class="w3-button w3-purple w3-round w3-tiny" style="padding:2px 4px;width:40px;margin-right:8px;float:left;" onclick="general_print_token('all_details_',<?php echo $row['order_id']; ?>)"><i class="fa fa-print"></i> Print</a>
							</div>
						</div>
						<!-- Order Details -->
						<div id="cancelled_details_<?php echo $row['order_id']; ?>" class="w3-pale-red w3-round w3-container w3-margin-top w3-border w3-padding-small" style="display:none;">
							<!-- Order date & time -->
							<div class="w3-row">
								<div class="w3-col w3-left-align w3-tiny" style="width:50%;">
									Time: <?php echo $row['time']; ?>
								</div>
								<div class="w3-col w3-right-align w3-tiny" style="width:50%;">
									Date: <?php echo $row['date']; ?>
								</div>
							</div>
							<!-- Personal Info -->
							<div class="w3-row w3-white w3-topbar w3-bottombar" style="margin-bottom:4px;padding:0px;">
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-top:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Name: <font class="w3-text-black w3-bold"><?php echo $list4[0]['first_name'].' '.$list4[0]['last_name']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Email: <font class="w3-text-blue w3-bold"><?php echo $list4[0]['email']; ?></font></p>
								</div>
								<div class="w3-col w3-light-gray w3-border w3-left-align " style="width:100%;margin-bottom:4px;">
									<p style="padding:0px;margin:0px 0px 0px 10px;">Mobile: <font class="w3-text-black w3-bold"><?php echo $list4[0]['mobile']; ?></font></p>
								</div>
							</div>
							
							
							<div class="w3-container w3-border w3-white w3-topbar w3-bottombar" style="padding:4px 4px 4px 4px;margin:5px 0px;padding-top:4px;">
								<?php
									$stmt4 = $conn->prepare("select * from cart_info where order_id='$order_id' order by cart_id asc ");
									$stmt4->execute();
									$list4 = $stmt4->fetchAll();
									foreach($list4 as $row4)
									{
										$stmt5 = $conn->prepare("select * from food where food_id='$row4[food_id]' order by food_id asc ");
										$stmt5->execute();
										$list5 = $stmt5->fetchAll();
								?>
											<!-- A single item in order -->
											<div class="w3-row w3-border w3-light-gray" style="margin-bottom:4px;padding:3px;">
												<div class="w3-col w3-left-align " style="width:20%;margin-top:4px;">
													<p style="padding:0px;margin:0px 0px 0px 10px;"><?php echo $row4['quantity']; ?> x</p>
												</div>
												<div class="w3-col w3-left-align " style="width:55%;">
													<p style="padding:0px;margin:0px 0px 0px 5px;"><?php echo $list5[0]['food_name']; ?></p>
												</div>
												<div class="w3-col w3-right-align " style="width:25%;">
													<p style="padding:0px;margin:0px 10px 0px 0px;"><?php echo $row4['price']; ?></p>
												</div>
											</div>
								<?php
									}
								?>
								<!-- Order information related to this order -->
								<div class="w3-row w3-white w3-topbar w3-bold" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Subtotal: <?php echo number_format($list3[0]['sum(price*quantity)'], 2, '.', ''); ?></p>
									</div>
									<div class="w3-col" style="width:2%;margin-top:4px;">
									&nbsp
									</div>
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:49%;margin-top:4px;">
										<p style="padding:0px;margin:0px 0px 0px 10px;"> Discount: <?php echo number_format((($total/100.0)*$d_per), 2, '.', ''); ?></p>
									</div>
								</div>
								<?php 
									if($d_per!=0)
									{
								?>
									<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
										<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
											<p style="padding:0px;margin:0px 0px 0px 10px;">Coupon Code: <font class="w3-text-teal"><?php echo $row['coupon_code'].' ('.$d_per.'%) '; ?></font><font class="w3-text-red w3-tiny">[shop over &pound;<?php echo $list2[0]['offer_conditional_amount']; ?>]</font></p>
										</div>
									</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
									<div class="w3-col w3-bold w3-light-gray w3-border w3-left-align " style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Paid By: <font class="w3-text-blue"><?php echo $row['paid_through']; ?></font></p>
									</div>
								</div>
								<?php 
									if($row['advice']!="")
									{
								?>
										<div class="w3-row w3-white" style="margin-bottom:4px;padding:0px;">
											<div class="w3-col w3-light-gray w3-border w3-left-align w3-tiny" style="width:100%;">
												<p style="padding:0px;margin:0px 0px 0px 10px;">Suggestion: <font class=""><?php echo $row['advice']; ?></font></p>
											</div>
										</div>
								<?php
									}
								?>
								<div class="w3-row w3-white" style="padding:0px;">
									<div class="w3-col w3-light-gray w3-border w3-left-align w3-small" style="width:100%;">
										<p style="padding:0px;margin:0px 0px 0px 10px;">Delivery Address: <font class="">
										<?php 
											if($row['address']=="")
											{
												$stmt6 = $conn->prepare("select * from customer where customer_id='$customer_id' order by customer_id asc ");
												$stmt6->execute();
												$list6 = $stmt6->fetchAll();
												echo $list6[0]['address'];
											}
											else
												echo $row['address'];
										?>
										</font></p>
									</div>
								</div>
								
							</div>
						</div>
					</div>
		<?php
				}
			}
			catch(PDOException $e) {
				echo "Error: " . $e->getMessage();
			}
			if($sl==0)
			{
		?>
				<p class="w3-medium w3-center w3-bold w3-text-red" style="margin-top:150px;">Oops!!! No Order's Available</p>
		<?php
			}
		?>
		</div>
	</div>
	<script>
		auto_refresh();
	</script>