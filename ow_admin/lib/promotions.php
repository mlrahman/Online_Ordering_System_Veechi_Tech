<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
	
	<div class="w3-container" style="margin-top:80px" id="promotions">
		<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Promotions</b></h1>
		<hr style="width:50px;border:5px solid black;" class="w3-round">
		<p> This option is used for <font color="red">send promotions to customers</font> of <?php echo $website_title; ?>.</p>
		<div class="w3-row-padding" style="width:100%;max-width:700px;">
			<form action="#" method="post">
				<p><input class="w3-input w3-border" type="text" placeholder="Customer Name" required name="Name"></p>
				<p><input class="w3-input w3-border" type="email" placeholder="Customer Email" required name="Email"></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Promotion Subject" required name="Subject"></p>
				<p><input class="w3-input w3-border" type="text" placeholder="Promoton Message" required name="Message"></p>
				<p>
					<button class="w3-button w3-black" type="submit" name="contact_msg">
						<i class="fa fa-paper-plane"></i> SEND Promotion
					</button>
				</p>
			</form>
		</div>
		
	</div>