<?php
	session_start();
	require_once('config.php');


	$email = $_POST['email'];
	$total_amount = $_POST['total_amount'];
	$token = $_POST['stripeToken'];
	$_SESSION['address']=trim($_POST['new_address']);
	$_SESSION['advice']=trim($_POST['suggestion']);
	
	$main_amount="";
	$ff=0;
	for($i=0;$i<strlen($total_amount);$i++)
	{
		if($total_amount[$i]>='0' && $total_amount[$i]<='9')
			$main_amount .=$total_amount[$i];
	}
	
	$success=0;
	try
	{
		// Create Customer In Stripe
		$customer = \Stripe\Customer::create(array(
		  "email" => $email,
		  "source" => $token
		));
		
		$charge = \Stripe\Charge::create(array(
			  'customer' => $customer->id,
			  'amount'   => $main_amount,   //Amount to be charge
			  'currency' => 'gbp'  //Pound Charge
		));
		$success=1;
	} catch(Stripe_CardError $e) {
	  $error1 = $e->getMessage();
	  echo $error1;
	  $_SESSION['payment_msg']=$error1;
	} catch (Stripe_InvalidRequestError $e) {
	  // Invalid parameters were supplied to Stripe's API
	  $error2 = $e->getMessage();
	  echo $error2;
	  $_SESSION['payment_msg']=$error2;
	} catch (Stripe_AuthenticationError $e) {
	  // Authentication with Stripe's API failed
	  $error3 = $e->getMessage();
	  echo $error3;
	  $_SESSION['payment_msg']=$error3;
	} catch (Stripe_ApiConnectionError $e) {
	  // Network communication with Stripe failed
	  $error4 = $e->getMessage();
	  echo $error4;
	  $_SESSION['payment_msg']=$error4;
	} catch (Stripe_Error $e) {
	  // Display a very generic error to the user, and maybe send
	  // yourself an email
	  $error5 = $e->getMessage();
	  echo $error5;
	  $_SESSION['payment_msg']=$error5;
	} catch (Exception $e) {
	  // Something else happened, completely unrelated to Stripe
	  $error6 = $e->getMessage();
	  echo $error6;
	  $_SESSION['payment_msg']=$error6;
	}
	
	
	if($success==1)
	{
		echo $email.'<h1>Successfully charged '.$total_amount.'</h1>';  //message to be amount details success
		$_SESSION['payment_successful']='YES';
		header("Location: ../order_online.php");
	}
	else
	{
		$_SESSION['payment_not_successful']='NO';
		echo $email.'<h1>Unsuccessful</h1>'.$total_amount;
		header("Location: ../order_online.php");
	}
	
	?>