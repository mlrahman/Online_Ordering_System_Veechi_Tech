
<?php
	session_start();

	$_SESSION['paypal_payment_not_done']='NO';
	
	session_write_close();

	header("Location: ../order_online.php");
?>