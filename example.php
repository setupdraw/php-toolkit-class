<?php
// Include the class
include('toolkit.class.php');

// Set the vars
$to 		= 'chupacabra@abracadabra.com';
$subject	= 'PHP Toolkit example';
$message	= '<html>
			   <head>
			   <title>PHP Toolkit example</title>
			   <style>
			   div { color: red; }
			   </style>
			   </head>
			   <body>
			   <div>This is the test message</div>
			   </body>
			   </html>';

// Do the work
$toolkit = new Toolkit;
$toolkit->sendEmail($to,$subject,$message);

if($toolkit->sendEmail($to,$subject,$message)) {
	echo 'Mail sent!';
} else {
	echo 'Mail fail.';
}