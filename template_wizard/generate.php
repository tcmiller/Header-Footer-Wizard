<?php

require_once('include/global.inc.php');
require_once('tmplgen-db.inc.php');

// capture, process and clean our POST vars
$values = array();
$values = $_POST;

/**
 * @name - insertAccountInfo() - Insert our account information
 *
 * @param array $values
 * @return true
 */
function insertAccountInfo($values) {
	
	global $mdb2;
	
	// call and prepare the table and data for insertion
	$table_name = 'account';

	$fields_values = array(
	    'requester' => $values['requester'],
	    'owner' => $values['owner'],
	    'email' => $values['email'],
	    'site_url' => $values['site_url'],
	    'active' => ACTIVE,
	    'code_pref' => $values['code_pref'],
		'created_date' => date('Y-m-d H:i:s'),
		'modified_date' => '0000-00-00 00:00:00',
		'last_accessed' => '0000-00-00 00:00:00'
	);

	$types = array('text', 'text', 'text', 'text', 'integer', 'text', 'text', 'text');

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							MDB2_AUTOQUERY_INSERT, null, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		return true;
	}
	
}

/**
 * @name - insertHeaderInfo() - Insert the user's header preferences
 *
 * @param array $values
 * @return true
 */
function insertHeaderInfo($values) {

	global $mdb2;
	
	// retrieve the last id inserted into the account table, which is presumably the individual that just registered during this db connection
	$account_id = $mdb2->lastInsertID('account', 'id');
	if (PEAR::isError($account_id)) {
    	die($account_id->getMessage());
	}
	
	$table_name = 'header';
	
	$fields_values = array(
	    'kitchen_sink' => $values['kitchen_sink'],
	    'blockw' => $values['blockw'],
	    'wordmark' => HEADER_WORDMARK,
	    'color' => $values['color'],
	    'search' => $values['search'],
		'created_date' => date('Y-m-d H:i:s'),
		'last_modified' => '0000-00-00 00:00:00',
		'account_id' => $account_id
	);
	
	$types = array('integer','integer','integer','text','text','text','text','integer');

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							MDB2_AUTOQUERY_INSERT, null, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		return true;
	}
	
}

/**
 * 
 * @name insertFooterInfo() - Insert the user's footer preference
 * 
 * @param array $values
 * @return true
 */
function insertFooterInfo($values) {
	
	global $mdb2;
	
	switch ($values['footer']) {
		
		case 'basic':
			$blockw = '0';
			$wordmark = '1';
			$patch = '0';
			break;
		case 'w':
			$blockw = '1';
			$wordmark = '1';
			$patch = '0';
			break;
		case 'goldPatch':
			$blockw = '0';
			$wordmark = '0';
			$patch = 'gold';
			break;
		case 'purplePatch':
			$blockw = '0';
			$wordmark = '0';
			$patch = 'purple';
			break;						
	}
	
	$account_id = $mdb2->lastInsertID('account', 'id');
	if (PEAR::isError($account_id)) {
    	die($account_id->getMessage());
	}
	
	$table_name = 'footer';
	
	$fields_values = array(
	    'blockw' => $blockw,
	    'wordmark' => $wordmark,
	    'patch' => $patch,
		'created_date' => date('Y-m-d H:i:s'),
		'last_modified' => '0000-00-00 00:00:00',
		'account_id' => $account_id
	);
	
	$types = array('integer','integer','text','text','text','integer');

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							MDB2_AUTOQUERY_INSERT, null, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		return true;
	}
	
}


// process the user's selected header/footer preferences
insertAccountInfo($values);
insertHeaderInfo($values);

// don't run the insertFooterInfo() function if they don't want a footer
if ($values['footer'] !== 'no') {
	insertFooterInfo($values);	
}

?>