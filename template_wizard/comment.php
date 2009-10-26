<?php 
/**
 * Comments Form
 *
 * Form to submit Header/Footer Wizard comments to uweb@uw.edu
 *
 * @author cheiland
 *
 */

$sResponse = json_decode(stripslashes($_POST['data']), true);

// check the parameters
if ($sResponse)
{
    // Execute some mail function
    $email = $sResponse['email'];
    $body = $sResponse['message'];

    mail( "uweb@uw.edu", "Header/Footer Wizard Comment",
    $body, "From: $email" );

    // Execute response
    $sBody = 'Your feedback was received: '.$body;

    mail( $email, "Header/Footer Wizard Comment Received",
    $sBody, "From: uweb@uw.edu" );

    echo true;
}
else
{
    echo false;
}
?>
