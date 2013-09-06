<?php
/*
*	Setupdraw - Rob Dunne
*	http://setupdraw.com
*	PHP Toolkit Class
*	Some commonly needed methods for when a framework is overkill
*	September 2013 onwards
*
*	Usage: 
*	Include class file
*	$toolkit = new Toolkit;
*	$toolkit->method();
*/

class Toolkit {
	function __construct() {
		// Anything need on initialisation
		
		// Uncomment to connect the database
		//$this->connectDB();
	}

	function connectDB() {
		$ra			= $_SERVER['REMOTE_ADDR'];
		$server 	= ($ra == '::1' ? 'localhost' : 'remote.host');
		$username 	= ($ra == '::1' ? 'root' : 'username');
		$password 	= ($ra == '::1' ? 'bitnami' : 'password');
		$database 	= ($ra == '::1' ? 'database' : 'db_name');
		
		$this->db = new mysqli($server, $username, $password, $database) or die('no connection');	
	}

	function updateDB($sql) {
		// Do something to the database
		if ($this->db->connect_errno) { echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error; }
		
		$response = ($this->db->query($sql) ? TRUE: FALSE);
		return $response;
	}

	function cleanInput($input) {
		// Pass the $_GET or $_POST variable before any database work
		$output = array();
		
		foreach ($input as $key=>$value) {
			// Make sure it's within the max length for the database
			$output[$key] = substr($value,0,256);
			
			// Tidy up line breaks
			$output[$key] = preg_replace('/\n{2,}/', "\n\n", $value);
			$output[$key] = nl2br($value,FALSE);
		
			// Strip any odd characters
			$output[$key] = preg_replace('/[^A-Za-z0-9\. -\!\?\(\)\<\>]/', "", $value);
			
			// Escape strings
			$output[$key] = $this->db->escape_string($value);
		}
		
		// Return the array
		return $output;
	}
	
	function sendEmail($to,$subject,$message) {
		/*
		*	Sends an HTML email
		*	$to			- email address, csv for multiple addresses
		*	$subject	- Subject string
		*	$message	- HTML message
		*/
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$response = mail($to, $subject, $message, $headers);
		
		return $response;
	}
}