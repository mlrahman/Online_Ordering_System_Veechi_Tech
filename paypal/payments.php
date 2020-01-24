<?php
session_start();
if(isset($_REQUEST['link']) && $_REQUEST['link']==sha1($_SESSION['customer_id']))
{

	// PayPal settings changes
	$paypal_email = 'mirlutfur.rahman@gmail.com'; //company pay mail
	$return_url = 'http://veechi.byethost4.com/paypal/payment-successful.php';
	$cancel_url = 'http://veechi.byethost4.com/paypal/payment-cancelled.php';
	$notify_url = 'http://veechi.byethost4.com/paypal/payments.php';


	// Check if paypal request or response
	if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
		
		$item_name = 'Total Payable';
		$total_amount = trim($_REQUEST['paypal_amount']);
		$_SESSION['address']=trim($_REQUEST['new_address']);
		$_SESSION['advice']=trim($_REQUEST['suggestion']);
		
		
		$main_amount="";
		for($i=0;$i<strlen($total_amount);$i++)
		{
			if(($total_amount[$i]>='0' && $total_amount[$i]<='9') || $total_amount[$i]=='.')
				$main_amount .=$total_amount[$i];
		}
		$item_amount = $main_amount;

		
		$querystring = '';
		
		// Firstly Append paypal account to querystring
		$querystring .= "?business=".urlencode($paypal_email)."&";
		
		// Append amount& currency (£) to quersytring so it cannot be edited in html
		
		//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
		$querystring .= "item_name=".urlencode($item_name)."&";
		$querystring .= "amount=".urlencode($item_amount)."&";
		
		//loop for posted values and append to querystring
		foreach($_POST as $key => $value){
			$value = urlencode(stripslashes($value));
			$querystring .= "$key=$value&";
		}
		
		// Append paypal return addresses
		$querystring .= "return=".urlencode(stripslashes($return_url))."&";
		$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
		$querystring .= "notify_url=".urlencode($notify_url);
		
		// Append querystring with custom field
		$querystring .= "&link=".$_REQUEST['link'];
		
		// Redirect to paypal IPN
		header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
		exit();
	}
	else
	{
	
	
	}
}
?>
