<?php
	if(!isset($_SESSION['admin_email']) || !isset($_SESSION['admin_password']) || !isset($_SESSION['admin_id']) || $_SESSION['admin_password']=='' || $_SESSION['admin_email']=='' || $_SESSION['admin_id']=='')
	{
		header("Location: index.php");
	}
?>
<div class="w3-container" style="margin-top:80px" id="home">
	<h1 class="w3-jumbo w3-new-text-color" style="font-family: 'Comic Sans MS', cursive, sans-serif;"><b>Welcome</b></h1>
	<hr style="width:50px;border:5px solid black;" class="w3-round">
	<p>Welcome to the <font color="red">Admin Panel</font> of <?php echo $website_title; ?>.</p>
</div>