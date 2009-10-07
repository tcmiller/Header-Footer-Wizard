<?php

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, 'http://staff.washington.edu/cheiland/template/header.cgi?i=bob');

// return the transfer as a string of the return value of curl_exec instead of outputting directly
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// grab URL and pass it to the browser
$preview = curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

echo $preview;

?>