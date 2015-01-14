# eWAY-Rapid-API-payment-using-Codeigniter
How to use eway Rapid API payment gateway using PHP. This class is an example of how to connect to eWAY's Rapid API using Codeigniter. Single library will work for all controls for payment integration. 

//=======================================================================================================================
This application is example how to use eWAY Rapid API and implement.
A codes is made by Web Active Corporation Pty Ltd.
And customized by Krishna Bhat (krishna1bhat@gmail.com) for seasy.

You need modify following code to execute this example.


1. Rapidapi.php (library file)

//'------------------------------------
//' The $sandbox is controller for sandbox or live mode
//' the current transaction is in sandbox mode if its value is true and will be live if its value is false
//'
//' This is set to the value entered on the Integration Assistant 
//'------------------------------------
private $sandbox = true; //if true => sandbox, for live make false

//'------------------------------------
//' The $username and $password are the PAI authentications
//' $username = API key and $password = API password
//'
//' This is set to the value entered on the Integration Assistant 
//'------------------------------------
private $username = "60CF3CYVn3kQHKDPQwNm+OqAr8YYmt2JDoRXSUI3Ie8uFrOKACaip9lsvhmxiIE7zKfj90"; //sandbox API key
private $password = "EBkrishna123"; //sandbox API password;


2. cart.php

	//'------------------------------------
	//' Payment parameter settings
	//' Change these variables according to your need
	//'------------------------------------
	$amount = 30; // this is real amount to be paid
  $amount = $amount * 100; //The amount of the transaction in the lowest denomination for the currency (e.g. a $27.00 transaction would have a TotalAmount value of â€˜2700â€™) 
  $CurrencyCode = "AUD";
  $RedirectUrl = base_url("cart/eway_redirect/" . $order_id);
  $CancelUrl = base_url("cart/eway_cancel/" . $order_id);

