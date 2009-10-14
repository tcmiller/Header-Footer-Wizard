<?php

header("Cache-Control: no-cache");

require_once('include/global.inc.php');
require_once('tmplgen-db.inc.php');

// capture, process and clean our POST vars
$values = array();
$values = $_POST;

/**
 * @name - processAccountInfo() - Initialize, update and finalize our account info
 *
 * @param array $values
 * @return true
 */
function processAccountInfo($values) {
	
	global $mdb2;
	
    // TODO: Switch fields to NOT NULL so error works properly
	// call and prepare the table and data for insertion or updating
	$table_name = 'account';

	switch ($values['processType']) {
		
		case 'initA':
			$fields_values = array('owner'=>$values['owner'],
			                       'active'=>0,
			                       'created_date' => date('Y-m-d H:i:s'),
								   'modified_date' => '0000-00-00 00:00:00',
								   'last_accessed' => '0000-00-00 00:00:00');
			$procType = 'MDB2_AUTOQUERY_INSERT';
			$join = 'null';			
			$types = array('text','integer','text','text','text');
			break;
			
		case 'updtA':
			$fields_values = array('email'=>$values['email'],
			                       'site_url'=>$values['site_url'],
			                       'code_pref'=>$values['code_pref'],
			                       'modified_date'=>date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'owner = '.$mdb2->quote($values['owner'], 'text').'';			
			$types = array('text','text','text','text');
			break;
			
		case 'fnlzA':
			$fields_values = array('active'=>1,
			                       'modified_date'=>date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'owner = '.$mdb2->quote($values['owner'], 'text').'';			
			$types = array('integer','text');
			break;
		
	}
	
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
 * @name - processHeaderInfo() - Initialize and update the user's header preferences
 *
 * @param array $values
 * @return true
 */
function processHeaderInfo($values) {

	global $mdb2;
	
	// retrieve the last id inserted into the account table, which is presumably the individual that just registered during this session, but on a different db connection, which is why.....
	// we use the owner id to look up the id that must now be the $account_id
	$mdb2->loadModule('Extended');
	$query = 'SELECT id FROM account WHERE owner = ?';
	$data = $mdb2->extended->getRow($query, null, array($values['owner']), array('text'));
	// $data[0] is a reference simply to the value of id
	
	// Step 1: Attempt to retrieve a user's row from the header table
	$query = sprintf('SELECT hdr.color
	                    FROM header as hdr,
	                         account as acct
	                   WHERE acct.owner = \'%s\'
	                     AND hdr.account_id = acct.id',$_SERVER['REMOTE_USER']);
	
	// Proceed with getting some data...
	$res =& $mdb2->query($query);
		
	// build the header data array
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$headerData = $row;
	}
		
	$table_name = 'header';

	// Step 2: Determine update or create
	if (!empty($headerData) && is_array($headerData)) {
			
		if ($values['patch'] == 1) {
			$blockw = 1;			
		} else {
			$blockw = $values['blockw'];
		}
		
		// no need to create a header record, one already exists
		$fields_values = array('selection' => $values['selection'],
		                       'blockw' => $blockw,
		                       'patch' => $values['patch'],
		                       'wordmark' => 1,
		                       'color' => $values['color'],
		                       'search' => $values['search'],
		                       'last_modified' => date('Y-m-d H:i:s'));
		$procType = 'MDB2_AUTOQUERY_UPDATE';
		$join = 'account_id = '.$mdb2->quote($data[0], 'integer').'';
		$types = array('text','integer','integer','integer','text','text','text');
		
	} else {
	
		// no account exists, create one
		$fields_values = array('selection' => $values['selection'],
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
		$types = array('text','integer','integer','integer','text','text','text','text','integer');
		
	}

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($procType), $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		
		// only show a preview if we're looking at the thin strip header (since the kitchen sink isn't ready yet)
		if ($values['selection'] == 'strip') {
		
			// create a new cURL resource to call our "preview" script
			$ch = curl_init();
			
			// set URL and other appropriate options
			curl_setopt($ch, CURLOPT_URL, 'http://depts.washington.edu/uweb/inc/header.cgi?i='.$values['owner']);
			//curl_setopt($ch, CURLOPT_URL, 'http://staff.washington.edu/cheiland/template/header.cgi?i='.$values['owner']);
			curl_setopt($ch, CURLOPT_HEADER, false);
			
			// grab URL and pass it to the browser
			curl_exec($ch);
			
			// close cURL resource, and free up system resources
			curl_close($ch);
		
		}
		
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
			$selected = '1';
			$blockw = '0';
			$wordmark = '1';
			$patch = '0';
			break;
		case 'w':
			$selected = '1';
			$blockw = '1';
			$wordmark = '1';
			$patch = '0';
			break;
		case 'goldPatch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'gold';
			break;
		case 'purplePatch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'purple';
			break;
		case 'no':
			$selected = '0';
			$blockw = '0';
			$wordmark = '0';
			$patch = '0';
			break;			
	}
	
	// retrieve the last id inserted into the account table, which is presumably the individual that just registered during this session, but on a different db connection, which is why.....
	// we use the owner id to look up the id that must now be the $account_id
	$mdb2->loadModule('Extended');
	$query = 'SELECT id FROM account WHERE owner = ?';
	$accountInfo = $mdb2->extended->getRow($query, null, array($values['owner']), array('text'));
	// $accountInfo[0] is a reference simply to the value of id
	
	// check to see if the footer row exists for this particular "owner"... this helps us know if we're going to be updating/deleting or inserting
	$mdb2->loadModule('Extended');
	$query = 'SELECT * FROM footer WHERE account_id = ?';
	$footerInfo = $mdb2->extended->getRow($query, null, array($accountInfo[0]), array('text'));
		
	// initialize our query mode string
	$qmode = 'MDB2_AUTOQUERY';
	
	if (!empty($footerInfo) && is_array($footerInfo)) {
		
		// set the query mode to "UPDATE"		
		$qmode .= '_UPDATE';
		$join = 'account_id = '.$mdb2->quote($accountInfo[0], 'integer').'';
		$fields_values = array(
		    'selected' => $selected,
			'blockw' => $blockw,
		    'wordmark' => $wordmark,
		    'patch' => $patch,
			'last_modified' => date('Y-m-d H:i:s'));		
		$types = array('integer','integer','integer','text','text');
			
	} else {
		// set the query mode to "INSERT"
		$qmode .= '_INSERT';
		$join = '';
		$fields_values = array(
			'selected' => $selected,
		    'blockw' => $blockw,
		    'wordmark' => $wordmark,
		    'patch' => $patch,
			'created_date' => date('Y-m-d H:i:s'),
			'last_modified' => '0000-00-00 00:00:00',
			'account_id' => $accountInfo[0]);		
		$types = array('integer','integer','integer','text','text','text','integer');
	}
	
	$table_name = 'footer';
	
	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($qmode), $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		
		// only show a preview if we're looking at the thin strip header (since the kitchen sink isn't ready yet)
		if ($selected == '1') {
		
			// create a new cURL resource to call our "preview" script
			$ch = curl_init();
			
			// set URL and other appropriate options
			//curl_setopt($ch, CURLOPT_URL, 'http://depts.washington.edu/uweb/inc/footer.cgi?i='.$values['owner']);
			//curl_setopt($ch, CURLOPT_URL, 'http://staff.washington.edu/cheiland/template/footer.cgi?i='.$values['owner']);
			curl_setopt($ch, CURLOPT_HEADER, false);
			
			// grab URL and pass it to the browser
			curl_exec($ch);
			
			// close cURL resource, and free up system resources
			curl_close($ch);
		
		}
		
	}
	
}

function runGenerator($values) {

	// process the user's selected header/footer preferences
	// only run this if certain processType values come through (initA || updtA || fnlzA)
	if ($values['processType'] == 'initA' || $values['processType'] == 'updtA' || $values['processType'] == 'fnlzA') {
		processAccountInfo($values);		
	}
	
	// only run this if certain processType values come through (initH)
	if ($values['processType'] == 'initH') {
		processHeaderInfo($values);
	}
	
	// only run this if certain processType values come through (initF)
	if ($values['processType'] == 'initF') {
		processFooterInfo($values);
	}
	
	return true;
	
}

// call our "constructor"
/*if (runGenerator($values)) {
	$msg = '      Success!       ';
} else {
	$msg = 'Try again';
}

echo $msg;*/

runGenerator($values);

?>
