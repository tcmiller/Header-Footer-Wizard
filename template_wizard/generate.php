<?php

header("Cache-Control: no-cache");

require_once('include/global.inc.php');
require_once('tmplgen-db.inc.php');

// capture, process and clean our POST vars
$values = array();
$values = $_POST;

/*echo '<pre>';
print_r($values);
echo '</pre>';*/

/**
 * @name - processAccountInfo() - Initialize, update and finalize our account info
 *
 * @param array $values
 * @return true
 */
function processAccountInfo($values) {
	
	global $mdb2;
	
	// call and prepare the table and data for insertion or updating
	$table_name = 'account';

	switch ($values['processType']) {
		
		case 'initA':
			$fields_values = array('requester'=>$values['requester'],
			                       'active'=>0,
			                       'created_date' => date('Y-m-d H:i:s'),
								   'modified_date' => '0000-00-00 00:00:00',
								   'last_accessed' => '0000-00-00 00:00:00');
			$procType = 'MDB2_AUTOQUERY_INSERT';
			$join = 'null';			
			$types = array('text','integer','text','text','text');
			break;
			
		case 'updtA':
			$fields_values = array('owner'=>$values['owner'],
			                       'email'=>$values['email'],
			                       'site_url'=>$values['site_url'],
			                       'code_pref'=>$values['code_pref'],
			                       'modified_date'=>date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'requester = '.$mdb2->quote($values['requester'], 'text').'';			
			$types = array('text','text','text','text','text');
			break;
			
		case 'fnlzA':
			$fields_values = array('active'=>1,
			                       'modified_date'=>date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'requester = '.$mdb2->quote($values['requester'], 'text').'';			
			$types = array('integer','text');
			break;
		
	}
	
	/*$fields_values = array('requester'=>$values['requester'],
			                       'active'=>'0',
			                       'created_date' => date('Y-m-d H:i:s'),
								   'modified_date' => '0000-00-00 00:00:00',
								   'last_accessed' => '0000-00-00 00:00:00');
								   
								   $procType = 'MDB2_AUTOQUERY_INSERT';
								   
								   $types = array('text','integer','text','text','text');*/
	
	/*$fields_values = array(
	    'requester' => $values['requester'],
	    'owner' => $values['owner'],
	    'email' => $values['email'],
	    'site_url' => $values['site_url'],
	    'active' => ACTIVE,
	    'code_pref' => $values['code_pref'],
		'created_date' => date('Y-m-d H:i:s'),
		'modified_date' => '0000-00-00 00:00:00',
		'last_accessed' => '0000-00-00 00:00:00'
	);*/
	
	//$types = array('text', 'text', 'text', 'text', 'integer', 'text', 'text', 'text');

	//echo $procType;
	
	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($procType), $join, $types);

		/*echo '<pre>';
							print_r($affectedRows);
							echo '</pre>';*/
							
	if (PEAR::isError($affectedRows)) {
		
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		
		return true;
	}
	
}

/**
 * @name - processHeaderInfo() - Initialize and update the user's header preferences
 *
 * @param array $values
 * @return true
 */
function processHeaderInfo($values) {

	global $mdb2;
	
	// retrieve the last id inserted into the account table, which is presumably the individual that just registered during this session, but on a different db connection, which is why.....
	// we use the requester id to look up the id that must now be the $account_id
	$mdb2->loadModule('Extended');
	$query = 'SELECT id FROM account WHERE requester = ?';
	$data = $mdb2->extended->getRow($query, null, array($values['requester']), array('text'));
	// $data[0] is a reference simply to the value of id
	
	$table_name = 'header';
	
	switch($values['processType']) {
		
		case 'initH':
			$fields_values = array('kitchen_sink' => $values['kitchen_sink'],
								   'blockw' => $values['blockw'],
								   'patch' => $values['patch'],
								   'wordmark' => 1,                       
								   'color' => $values['color'],       
			                       'search' => $values['search'],
								   'created_date' => date('Y-m-d H:i:s'),
								   'last_modified' => '0000-00-00 00:00:00',
						 		   'account_id' => $data[0]);
			$procType = 'MDB2_AUTOQUERY_INSERT';
			$join = 'null';
			$types = array('integer','integer','integer','integer','text','text','text','text','integer');
			break;
			
		case 'updtH':			
			$fields_values = array('blockw' => $values['blockw'],
			                       'patch' => $values['patch'],
			                       'wordmark' => 1,
			                       'color' => $values['color'],
			                       'search' => $values['search'],
			                       'last_modified' => date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'account_id = '.$mdb2->quote($data[0], 'integer').'';
			$types = array('integer','integer','integer','text','text','text');
			break;
		
	}
	
	
	/*$fields_values = array(
	    'kitchen_sink' => KITCHEN_SINK,
	    'blockw' => $blockw,
	    'patch' => $values['patch'],
	    'wordmark' => HEADER_WORDMARK,
	    'color' => $values['color'],
	    'search' => $values['search'],
		'created_date' => date('Y-m-d H:i:s'),
		'last_modified' => '0000-00-00 00:00:00',
		'account_id' => $account_id
	);
	
	$procType = 'MDB2_AUTOQUERY_INSERT';
	
	$types = array('integer','integer','integer','integer','text','text','text','text','integer');*/

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($procType), $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		return true;
	}
	
}

/**
 * 
 * @name processFooterInfo() - Process the user's footer preference
 * 
 * @param array $values
 * @return true
 */
function processFooterInfo($values) {
	
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
	
	// retrieve the last id inserted into the account table, which is presumably the individual that just registered during this session, but on a different db connection, which is why.....
	// we use the requester id to look up the id that must now be the $account_id
	$mdb2->loadModule('Extended');
	$query = 'SELECT id FROM account WHERE requester = ?';
	$accountInfo = $mdb2->extended->getRow($query, null, array($values['requester']), array('text'));
	// $accountInfo[0] is a reference simply to the value of id
	
	/*echo '<pre>';
	print_r($accountInfo);
	echo '</pre>';*/
	
	// check to see if the footer row exists for this particular "requester"... this helps us know if we're going to be updating or inserting
	$mdb2->loadModule('Extended');
	$query = 'SELECT * FROM footer WHERE account_id = ?';
	$footerInfo = $mdb2->extended->getRow($query, null, array($accountInfo[0]), array('text'));
	
	/*echo '<pre>';
	print_r($footerInfo);
	echo '</pre>';*/
	
	// initialize our query mode string
	$qmode = 'MDB2_AUTOQUERY';
	
	if (!empty($footerInfo) && is_array($footerInfo)) {
		// set the query mode to "UPDATE"		
		$qmode .= '_UPDATE';
		$join = 'account_id = '.$mdb2->quote($accountInfo[0], 'integer').'';
		$fields_values = array(
		    'blockw' => $blockw,
		    'wordmark' => $wordmark,
		    'patch' => $patch,
			'last_modified' => date('Y-m-d H:i:s'));		
		$types = array('integer','integer','text','text');
		
	} else {
		// set the query mode to "INSERT"
		$qmode .= '_INSERT';
		$join = '';
		$fields_values = array(
		    'blockw' => $blockw,
		    'wordmark' => $wordmark,
		    'patch' => $patch,
			'created_date' => date('Y-m-d H:i:s'),
			'last_modified' => '0000-00-00 00:00:00',
			'account_id' => $accountInfo[0]);		
		$types = array('integer','integer','text','text','text','integer');
	}
	
	$table_name = 'footer';
	
	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($qmode), $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		return true;
	}
	
}

function runGenerator($values) {

	// process the user's selected header/footer preferences
	// only run this if certain processType values come through (initA || updtA || fnlzA)
	if ($values['processType'] == 'initA' || $values['processType'] == 'updtA' || $values['processType'] == 'fnlzA') {
		processAccountInfo($values);		
	}
	
	// only run this if certain processType values come through (initH || updtH)
	if ($values['processType'] == 'initH' || $values['processType'] == 'updtH') {
		processHeaderInfo($values);
	}
	
	// only run this if certain processType values come through (initF)
	if ($values['processType'] == 'initF' && $values['footer'] !== 'no') {
		processFooterInfo($values);
	}
	
	return true;
	
}

// call our "constructor"
if (runGenerator($values)) {
	$msg = '      Success!       ';
} else {
	$msg = 'Try again';
}

echo $msg;

?>