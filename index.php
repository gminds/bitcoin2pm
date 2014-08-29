<?php
define('USERNAME', 'demo'); //Admin Username
define('PASSWORD', 'demo'); //Admin Password
define('ALTERNATE_PHRASE_HASH',  'gggjjj'); //Perfect Money Alternate phrase hash
define('TRANSACTIONFEE', 7); // Transaction Fee
define('FAILEDMESSAGE', 'Your order was not successful.'); //Order Failed Message
define('EMAILFAILEDSUBJECT', 'failure notice'); //email subject order failed
define('ADMINEMAIL', 'support@demo.com'); //admin email
define('EMAILFROM', 'support@demo.com');  //email from
define('WALLETBALANCE', 100); //your wallet balance displayed on your website
define('PMACCOUNT', 'U777677'); //your Perfect money account USD
define('PMPAYEENAME', 'Easy2Exchange'); //Your company name displayed during checkout
define('PMPAYMENTID', 'Easy2Exchange PM - Bitcoin'); //payment id for reference
define('PMMINIMUM', 'Min $20'); //Minimum amount of perfect money for purchase

// Slim
require 'Slim/Slim.php';
require 'Views/TwigView.php';
 
// Paris and Idiorm
require 'Paris/idiorm.php';
require 'Paris/paris.php';


// Configuration
TwigView::$twigDirectory = __DIR__ . '/Twig/lib/Twig/';

ORM::configure('mysql:host=localhost;dbname=yourdatabasename'); //your database name
ORM::configure('username', 'yourdatabaseusername'); // your database username
ORM::configure('password', 'yourdatabasepassword'); // your database password



// Models
require 'models/Order.php';

// Start Slim.
$app = new Slim(array(
	'log.enabled' => true,
	 'debug' => true,
   'view' => new TwigView
));





// Auth Check.
$authCheck = function() use ($app) {
	$authRequest 	= isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);
	$authUser 		= $authRequest && $_SERVER['PHP_AUTH_USER'] === USERNAME;
	$authPass 		= $authRequest && $_SERVER['PHP_AUTH_PW'] === PASSWORD;

	if (! $authUser || ! $authPass) {
		$app->response()->header('WWW-Authenticate: Basic realm="My Administration"', '');
		$app->response()->header('HTTP/1.1 401 Unauthorized', '');
		$app->response()->body('<h1>Please enter valid administration credentials</h1>');
		$app->response()->send();
		exit;
	}
};




// Admin Home.
$app->get('/admin', $authCheck, function() use ($app) {
	$orders = Model::factory('Order')
					->order_by_desc('timestamp')
					->find_many();
					
	return $app->render('admin_home.html', array('orders' => $orders));
});

// Blog View.
$app->get('/admin/view/(:id)', function($id) use ($app) {
	$orders = Model::factory('Order')->find_one($id);
	if (! $orders instanceof Order) {
		$app->notFound();
	}
	
	return $app->render('blog_detail.html', array('order' => $orders));
});





$app->get('/', function() use ($app) {
function url(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function objectToArray($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}




$url_btc =    'https://blockchain.info/ticker';

$response_btc = file_get_contents($url_btc);
$object_btc = json_decode($response_btc);
	//print_r($object_btc);
	
$usdprice = $object_btc->{"USD"}->{"last"};

//echo $usdprice;

                        $rate['balance'] =  WALLETBALANCE;
						$rate['rate'] =  $object_btc->{"USD"}->{"last"};
						//print_r($result);
						$commision = $object_btc->{"USD"}->{"last"};
						$object_btc->{"USD"}->{"last"} = ($object_btc->{"USD"}->{"last"} + ( $commision * (TRANSACTIONFEE/100)));
						
						$json_a = objectToArray($object_btc);
						$json_a['btc']['amount'] = WALLETBALANCE;
						$json_a['btc']['url'] = url();
						$json_a['btc']['pm'] = PMACCOUNT;
						$json_a['btc']['pmname'] = PMPAYEENAME;
						$json_a['btc']['pmid'] = PMPAYMENTID;
						$json_a['btc']['pmminimum'] = PMMINIMUM;
						//print_r($json_a);
			return $app->render('blog_home.html', array('feeds' => $json_a));		
});

$app->post('/status', function () use ($app) {
  
   //Slim Request object
    $req = $app->request();
	
	
	
$string=
      $req->post('PAYMENT_ID').':'.$req->post('PAYEE_ACCOUNT').':'.
      $req->post('PAYMENT_AMOUNT').':'.$req->post('PAYMENT_UNITS').':'.
      $req->post('PAYMENT_BATCH_NUM').':'.
      $req->post('PAYER_ACCOUNT').':'.ALTERNATE_PHRASE_HASH.':'.
      $req->post('TIMESTAMPGMT');
	  
	  $payamount = $req->post('PAYMENT_AMOUNT');
	  $to = $req->post('email');
	  $toaddress = $req->post('BTC_ADDR');

$hash=strtoupper(md5($string));

if($hash==$req->post('V2_HASH')  && $req->post('PAYEE_ACCOUNT')==PMACCOUNT && $req->post('PAYMENT_UNITS')=='USD'){



					    // check for current price and process fees
						
						function objectToArray($d) {
								if (is_object($d)) {
									// Gets the properties of the given object
									// with get_object_vars function
									$d = get_object_vars($d);
								}
						 
								if (is_array($d)) {
									/*
									* Return array converted to object
									* Using __FUNCTION__ (Magic constant)
									* for recursive call
									*/
									return array_map(__FUNCTION__, $d);
								}
								else {
									// Return array
									return $d;
								}
							}




						$url_btc =    'https://blockchain.info/ticker';

						$response_btc = file_get_contents($url_btc);
						$object_btc = json_decode($response_btc);
							//print_r($object_btc);
							
						$usdprice = $object_btc->{"USD"}->{"last"};
						$rate['rate'] =  $object_btc->{"USD"}->{"last"};
						//print_r($result);
						$commision = $object_btc->{"USD"}->{"last"};
						$object_btc->{"USD"}->{"last"} = ($object_btc->{"USD"}->{"last"} + ( $commision * (TRANSACTIONFEE/100)));
						$json_a = objectToArray($object_btc);						

					
						
						
						function recalc($amount, $updatelast) {
							$btc = $amount/ $updatelast;
							return $btc;
							}
						
						
						
						
						$updatelast = $object_btc->{"USD"}->{"last"};
						//$updateamt =  $json_a['btc']['amount'];
						$nowbtc = recalc($payamount, $updatelast);
						
											
						// update status
						
						$order	= Model::factory('Order')->create();
							$order->payment_id 	= $app->request()->post('PAYMENT_ID');
							$order->id 	= $app->request()->post('PAYMENT_BATCH_NUM');
							$order->payee_account 	= $app->request()->post('PAYEE_ACCOUNT');
							$order->payment_batch_num 	= $app->request()->post('PAYMENT_BATCH_NUM');
							$order->payer_account 	= $app->request()->post('PAYER_ACCOUNT');
							$order->timestampgmt 	= $app->request()->post('TIMESTAMPGMT');
							$order->email 	= $app->request()->post('email');
							$order->btc_addr 	= $app->request()->post('BTC_ADDR');
							$order->payment_amount 	= $app->request()->post('PAYMENT_AMOUNT');
							$order->payment_units 	= $app->request()->post('PAYMENT_UNITS');
							$order->v2_hash 	= $app->request()->post('V2_HASH');
							$order->rate 	= $app->request()->post('rate');
							$order->last 	= $app->request()->post('last');
							$order->newrate 	= $updatelast;
							//$order->newlast 	= $updateamt;
							$order->bitcoin 	= $nowbtc;
					
							$order->timestamp = date('Y-m-d H:i:s');
	
						
						

							if ($nowbtc <= 0 ) {
							
							// fail email
								$failmessage = FAILEDMESSAGE;
						 $email_from = EMAILFROM;
						$email_subject = EMAILFAILEDSUBJECT;
							$headers = 'From: '.$email_from . "\r\n" .
							'Reply-To: '.$email_from . "\r\n" .
							'Cc: '. "\r\n".
							'Bcc: '. "\r\n".
							'MIME-Version: 1.0' . "\r\n".
							'Content-type: text/html; charset=iso-8859-1' . "\r\n".
							'X-Mailer: PHP/' . phpversion();

							mail($to, $email_subject, $failmessage, $headers);
							$order->status 	= 'failed';
                             $order->save();
							
							} else {
							
							
   
						   $order->status 	= "Completed";
						   $order->save();
						   
						   $successmessage = "Your bitcoin wallet ".$toaddress." will be funded soon";
						   $adminmessage = "A bitcoin wallet ".$toaddress." has requested for ".$nowbtc." ".$payamount." USD was paid.";
						   
						   $email_from = EMAILFROM;
						   $email_subject = "Bitcoin Order Received";
							$headers = 'From: '.$email_from . "\r\n" .
							'Reply-To: '.$email_from . "\r\n" .
							'Cc: '. "\r\n".
							'Bcc: '. "\r\n".
							'MIME-Version: 1.0' . "\r\n".
							'Content-type: text/html; charset=iso-8859-1' . "\r\n".
							'X-Mailer: PHP/' . phpversion();

							mail($to, $email_subject, $successmessage, $headers);
							mail(ADMINEMAIL, $email_subject, $adminmessage, $headers);	
																				
							
							} 
						}else {

	                        $failmessage = 'Hacking attempt';
						    $email_from = EMAILFROM;
						    $email_subject = "Failed hacking attempt";
							$headers = 'From: '.$email_from . "\r\n" .
							'Reply-To: '.$email_from . "\r\n" .
							'Cc: ' ."\r\n".
							'Bcc:' ."\r\n".
							'MIME-Version: 1.0' . "\r\n".
							'Content-type: text/html; charset=iso-8859-1' . "\r\n".
							'X-Mailer: PHP/' . phpversion();

						//	mail($to, $email_subject, $failmessage, $headers);
							mail(ADMINEMAIL, $email_subject, $failmessage, $headers);


}
    // return $app->render('blog_home.html');	
});



$app->get('/failed', function () use ($app) {

						function url(){
							if(isset($_SERVER['HTTPS'])){
								$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
							}
							else{
								$protocol = 'http';
							}
							return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
						}
						function objectToArray($d) {
								if (is_object($d)) {
									// Gets the properties of the given object
									// with get_object_vars function
									$d = get_object_vars($d);
								}
						 
								if (is_array($d)) {
									/*
									* Return array converted to object
									* Using __FUNCTION__ (Magic constant)
									* for recursive call
									*/
									return array_map(__FUNCTION__, $d);
								}
								else {
									// Return array
									return $d;
								}
							}




						$url_btc =    'https://blockchain.info/ticker';

						$response_btc = file_get_contents($url_btc);
						$object_btc = json_decode($response_btc);
							//print_r($object_btc);
							
						$usdprice = $object_btc->{"USD"}->{"last"};
						$rate['rate'] =  $object_btc->{"USD"}->{"last"};
						//print_r($result);
						$commision = $object_btc->{"USD"}->{"last"};
						$object_btc->{"USD"}->{"last"} = ($object_btc->{"USD"}->{"last"} + ( $commision * (TRANSACTIONFEE/100)));
						$json_a = objectToArray($object_btc);						
						$json_a = objectToArray($object_btc);
						$json_a['btc']['amount'] = WALLETBALANCE;
						$json_a['btc']['url'] = url();
						$json_a['btc']['pm'] = PMACCOUNT;
						$json_a['btc']['pmname'] = PMPAYEENAME;
						$json_a['btc']['pmid'] = PMPAYMENTID;
						$json_a['btc']['pmminimum'] = PMMINIMUM;





						
						$app->flashNow('info', 'Your order has failed. Please try again');
					 return $app->render('blog_home.html', array('feeds' => $json_a));	
					});


$app->get('/success', function () use ($app) {
    //Slim Request object
	
	
					function url(){
						if(isset($_SERVER['HTTPS'])){
							$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
						}
						else{
							$protocol = 'http';
						}
						return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
					}
	
						function objectToArray($d) {
								if (is_object($d)) {
									// Gets the properties of the given object
									// with get_object_vars function
									$d = get_object_vars($d);
								}
						 
								if (is_array($d)) {
									/*
									* Return array converted to object
									* Using __FUNCTION__ (Magic constant)
									* for recursive call
									*/
									return array_map(__FUNCTION__, $d);
								}
								else {
									// Return array
									return $d;
								}
							}




						$url_btc =    'https://blockchain.info/ticker';

						$response_btc = file_get_contents($url_btc);
						$object_btc = json_decode($response_btc);
							//print_r($object_btc);
							
						$usdprice = $object_btc->{"USD"}->{"last"};
						$rate['rate'] =  $object_btc->{"USD"}->{"last"};
						//print_r($result);
						$commision = $object_btc->{"USD"}->{"last"};
						$object_btc->{"USD"}->{"last"} = ($object_btc->{"USD"}->{"last"} + ( $commision * (TRANSACTIONFEE/100)));
						$json_a = objectToArray($object_btc);		
						$json_a = objectToArray($object_btc);
						$json_a['btc']['amount'] = WALLETBALANCE;
						$json_a['btc']['url'] = url();
						$json_a['btc']['pm'] = PMACCOUNT;
						$json_a['btc']['pmname'] = PMPAYEENAME;
						$json_a['btc']['pmid'] = PMPAYMENTID;
						$json_a['btc']['pmminimum'] = PMMINIMUM;

$app->flashNow('info', 'Your order was successfully processed. An email has been sent to you');
return $app->render('blog_home.html', array('feeds' => $json_a));	
});


$app->run();