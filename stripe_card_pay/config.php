<?php
	require_once('stripe-php/init.php');
	
	$stripe = array(  //use live keys
	  "secret_key"      => "sk_test_No226HWDmn1zDJUoPu22SzyL",
	  "publishable_key" => "pk_test_9FufpFsxsWPBgyDe1OPrbxqv"
	);

	\Stripe\Stripe::setApiKey($stripe['secret_key']);


?>