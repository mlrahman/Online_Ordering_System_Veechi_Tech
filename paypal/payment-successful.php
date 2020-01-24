<?php
	session_start();

	$_SESSION['paypal_payment_done']='YES';

	session_write_close();

	header("Location: ../order_online.php");
?>