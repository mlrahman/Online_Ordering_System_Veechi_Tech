Important Settings (Compulsory)


/** Website Basic Information **/

1) Update all details with db at "initialize.php".


/** PHP Stripe Setting **/

1) Use Stripe Live Keys at "charge.js" and "config.php".
2) Stripe Charge: (Total Amount * 2.9%) + 20 P (GBP)
3) Open stripe account and attach bank account with it.


/** Paypal Setting **/

1) Use paypal account email at "payments.php".
2) Change paypal sumission link sandbox to live.
3) Paypal charge: (Total Amount * 2.9%) + 20 P (GBP)
4) Set Paypal account settings:

      *) My Selling Preferences >> Getting Paid and Managing Risk >> Instant Payment Notification Preferences
         Set IPN value to 'ON'
         Set the IPN URL to the PHP page containing the IPN code shown in steps 3 & 4 of this tutorial (www.evoluted.net/thinktank/web-development/paypal-php-integration)
         Block payments with eCheque
         Set Email
      *) Website Payment Preferences
         Auto Return: ON ***
         Payment Data Transfer: ON ***