<?php 

    include "dbConnection.php";

	$payment_id = $statusMsg = ''; 
	$ordStatus = 'error';
	$id = '';

	// Check whether stripe token is not empty

	if(!empty($_POST['stripeToken'])){

		// Get Token, Card and User Info from Form
		$token = $_POST['stripeToken'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$course = $_POST['course'];
		$card_no = $_POST['card_number'];
		$card_cvc = $_POST['card_cvc'];
		$card_exp_month = $_POST['card_exp_month'];
		$card_exp_year = $_POST['card_exp_year'];
		$price=$_POST['amount'];
		
		// Get Product ID From - Form
		$productId = $_POST['productId'];
		

		// Include STRIPE PHP Library
		require_once('stripe-php/init.php');

		// set API Key
		$stripe = array(
		"SecretKey"=>"sk_test_51PEQhGJyuM0u2xxsa7BIBLJvLPjKGRRvSdH5Sc5ztzoYCpdpsXT5aNsDvwMQRnMYZpC7Sv7ZHEc64KBEOtFrbMrb00pXrJNtiq",
		"PublishableKey"=>"pk_test_51PEQhGJyuM0u2xxsb0s1fQwXXxKUuPhLGZplIbZBeEdZXZWVdoyygGly1aPTvAo8KEF4BUWUEWLbu2QH72ToqLtv00F11KaQo0"
		);

		// Set your secret key: remember to change this to your live secret key in production
		// See your keys here: https://dashboard.stripe.com/account/apikeys
		\Stripe\Stripe::setApiKey($stripe['SecretKey']);

		// Add customer to stripe 
	    $customer = \Stripe\Customer::create(array( 
	        'email' => $email, 
	        'source'  => $token,
	        'name' => $name,
	        'description'=>$course
	    ));

	    // Generate Unique order ID 
	    $orderID = strtoupper(str_replace('.','',uniqid('', true)));
	     
	    // Convert price to cents 
	    $itemPrice = ($price*100);
	    $currency = "usd";
	   

	    // Charge a credit or a debit card 
	    $charge = \Stripe\Charge::create(array( 
	        'customer' => $customer->id, 
	        'amount'   => $itemPrice, 
	        'currency' => $currency, 
	        'description' => $course, 
	        'metadata' => array( 
	            'order_id' => $orderID 
	        ) 
	    ));

	    // Retrieve charge details 
    	$chargeJson = $charge->jsonSerialize();

    	// Check whether the charge is successful 
    	if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 

	        // Order details 
	        $transactionID = $chargeJson['id']; 
	        $paidAmount = $chargeJson['amount']; 
	        $paidCurrency = $chargeJson['currency']; 
	        $payment_status = $chargeJson['status'];
	        $payment_date = date("Y-m-d H:i:s");
	        $dt_tm = date('Y-m-d H:i:s');
			// $productId = $POST['productId'];


	        // Insert tansaction data into the database

	        $sql = "insert into courseordernew (name,email,coursename,fees,card_number,card_expirymonth,card_expiryyear,status,paymentid,added_date, course_id) values ('".$name."','".$email."','".$course."','".$price."','".$card_no."','".$card_exp_month."','".$card_exp_year."','".$payment_status."','".$transactionID."','".$dt_tm."','".$productId."')";
			
			
	        mysqli_query($conn,$sql) or die("Mysql Error Stripe-Charge(SQL)".mysqli_error($conn));

    		

	        // If the order is successful 
	        if($payment_status == 'succeeded'){ 
	            $ordStatus = 'success'; 
	            $statusMsg = 'Your Payment has been Successful!'; 
	    	} else{ 
	            $statusMsg = "Your Payment has Failed!"; 
	        } 
	    } else{ 
	        //print '<pre>';print_r($chargeJson); 
	        $statusMsg = "Transaction has been failed!"; 
	    } 
	} else{ 
	    $statusMsg = "Error on form submission."; 
	} 
	
?>

<!DOCTYPE html>
<html>

<head>
    <title> Stripe Payment Gateway Integration in PHP </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/stripe.css">
</head>

<!-- <div class="container">
    <h2 style="text-align: center; color: blue;">Stripe Payment Gateway Integration in PHP </h2>
    <h4 style="text-align: center;">This is - Stripe Payment Success URL </h4>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="status">
                <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>

                <h4 class="heading">Payment Information - </h4>
                <br>

                <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
                <p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?> ($<?php echo $price;?>.00)</p>
                <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
                <h4 class="heading">Product Information - </h4>
                <br>
                <p><b>Name:</b> <?php echo $course; ?></p>
                <p><b>Course ID:</b> <?php echo $productId; ?></p>
                <p><b>Price:</b> <?php echo $price.' '.$currency; ?> ($<?php echo $price;?>.00)</p>
            </div>
            <a href="index.php" class="btn-continue">Back to Home</a>
        </div>
    </div>
</div> -->

<div class="card text-center">
    <div class="card-header" style="text-align: center; color: white; background-Color: black">your payment details by
        Virtual Learning Nexus</div>
    <div class="card-body">
        <h1 class="<?php echo $ordStatus; ?>" style="color: green"><?php echo $statusMsg; ?></h1>

        <h4 class="heading">Payment Information - </h4>
        <br>

        <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
        <p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?> ($<?php echo $price;?>.00)</p>
        <p><b>Payment Status:</b><span style="color: green"> <?php echo $payment_status; ?></span></p>
        <h4 class="heading">Product Information - </h4>
        <br>
        <p><b>Name:</b> <?php echo $course; ?></p>
        <p><b>Course ID:</b> <?php echo $productId; ?></p>
        <p><b>Price:</b> <?php echo $price.' '.$currency; ?> ($<?php echo $price;?>.00)</p>
    </div>
    <!-- <a href="index.php" class="btn-continue">Back to Home</a> -->
    <button type="button" class="btn btn-outline-light btn-rounded" data-mdb-ripple-init data-mdb-ripple-color="dark">
        <a href="index.php">Back to Home</a></button>

</div>



<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.2.0/mdb.umd.min.js"></script>

</html>