<?php

header("Cache-Control: no-cache");

require_once('include/global.inc.php');

// capture, process and clean our POST vars
$formData = array();
$formData = $_GET;

/*echo '<pre>';
print_r($formData);
echo '</pre>';*/

//echo $values['owner'].$values['blah'];

$values = array();

// abstract out the form field's $_GET values (ignoring the array's key)
foreach ($formData as $key => $value) {
	$values = $value; 			
}

echo '<pre>';
print_r($values);
echo '</pre>';

function errorHandler($values) {

	// get and store the field value
	$fieldValue = $values[0];
	
	// get and store the error type
	$errorType = $values[1];
	
	switch ($errorType) {
		
		case 'required':
			$msg = required($fieldValue);
			break;
			
		case 'requiredAndEmail':
			$msg = requiredAndEmail($fieldValue);
			break;		
	}
	
	return $msg;
	
}

//echo errorHandler($values);

function required($value) {
	
	if (empty($value)) {	
		$msg = 'This field is required';
			
	} else {
		$msg = '';
			
	}	
	
	return $msg;
	
}

//echo required($values);

function requiredAndEmail($value) {

	if (empty($value)) {	
		$msg = 'This field is required';
	
	} else {		
		
		if (check_email_address($value)) {
			$msg = '';

		} else {
			$msg = 'Please provide a valid email';
			
		}
		
	}
	
	return $msg;
	
}

//echo requiredAndEmail($values);

function check_email_address($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
   		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
   		return false;
   	}
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
   	for ($i = 0; $i < sizeof($local_array); $i++) {
   		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
   			return false;
   		}
	}
   	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
   		$domain_array = explode(".", $email_array[1]);
   		if (sizeof($domain_array) < 2) {
   			return false; // Not enough parts to domain
   		}
 		for ($i = 0; $i < sizeof($domain_array); $i++) {
 			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
 				return false;
 			}
 		}
 	}
 	return true;
}

//echo errorHandler($values);

?>