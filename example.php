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

$return = ($toolkit->sendEmail($to,$subject,$message)) ? 'Mail sent' : 'Mail fail';
echo $return;
