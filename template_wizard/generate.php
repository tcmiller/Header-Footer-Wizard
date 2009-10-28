<?php

header("Cache-Control: no-cache");

require_once('tmplgen-db.inc.php');
require_once('include/functions.inc.php');

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
			
			// call up our code and display it
			getCode();
			
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
		
		echo 'crap';
		
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
		
		// because of how Kilian's css works, this needs to be set to 1 by default, even if the user doesn't really want this to start with
		$blockw = 1;
		
		// no account exists, create one
		$fields_values = array('selection' => $values['selection'],
							   'blockw' => $blockw,
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
		
			curlRequestGenerator('header.cgi?i='.$values['owner']);
		
		} elseif ($values['selection'] == 'static') {
			
			echo '<div class="no-selection-msg">chtml include selected: Currently no preview available</div>';
			
		} else {
			
			echo '<div class="no-selection-msg">No header selection</div>';
			
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
			$static = '0';
			break;
		case 'w':
			$selected = '1';
			$blockw = '1';
			$wordmark = '1';
			$patch = '0';
			$static = '0';
			break;
		case 'goldPatch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'gold';
			$static = '0';
			break;
		case 'purplePatch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'purple';
			$static = '0';
			break;
		case 'static':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = '0';
			$static = '1';
			break;
		case 'no':
			$selected = '0';
			$blockw = '0';
			$wordmark = '0';
			$patch = '0';
			$static = '0';
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
		    'static' => $static,
			'last_modified' => date('Y-m-d H:i:s'));		
		$types = array('integer','integer','integer','text','integer','text');
			
	} else {
		// set the query mode to "INSERT"
		$qmode .= '_INSERT';
		$join = '';
		$fields_values = array(
			'selected' => $selected,
		    'blockw' => $blockw,
		    'wordmark' => $wordmark,
		    'patch' => $patch,
		    'static' => $static,
			'created_date' => date('Y-m-d H:i:s'),
			'last_modified' => '0000-00-00 00:00:00',
			'account_id' => $accountInfo[0]);		
		$types = array('integer','integer','integer','text','integer','text','text','integer');
	}
	
	$table_name = 'footer';
	
	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($qmode), $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());
		
		// add an error message to the exceptions handler or something
		
	} else {
		
		// only show a preview if they select a footer
		if ($selected == '1' && $static == '0') {
			
			curlRequestGenerator('footer.cgi?i='.$values['owner']);
		
		} elseif ($static == '1') {
			
			echo '<div class="no-selection-msg">chtml include selected: Currently no preview available</div>';
			
		} else {
			
			echo '<div class="no-selection-msg">No footer selection</div>';
			
		}
		
	}
	
}

/**
 * getCode() - using CURL, retrieve and display the user's code selections
 * 
 * @return string $html
 */
function getCode() {
	
	global $mdb2;
	
	// we need three pieces of info, acct.code_pref, hdr.selection and ftr.selected
	$query = sprintf('SELECT acct.owner,
	                         acct.code_pref,
	                         hdr.selection,
	                         ftr.selected,
	                         ftr.static
	                    FROM account as acct,
	                         header as hdr,
	                         footer as ftr
	                   WHERE acct.owner = \'%s\'
	                     AND hdr.account_id = acct.id
	                     AND ftr.account_id = acct.id',$_SERVER['REMOTE_USER']);
	
	// Proceed with getting some data...
	$res =& $mdb2->query($query);
		
	// build the header data array
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$usersPrefs = $row;
	}

	// store some random js here since we can't call the help modals out of index.php, only generate.php
	$html = '<script type="text/javascript">
		$(document).ready(function(){	
			
			$("#cpInstallCall").colorbox({width:"50%", inline:true, href:"#cpInstall"});
			$("#incInstallCall").colorbox({width:"50%", inline:true, href:"#incInstall"});
			$("#cpHelpCall").colorbox({width:"50%", inline:true, href:"#cpHelp"});
			$("#incHelpCall").colorbox({width:"50%", inline:true, href:"#incHelp"});
			
		});	
	</script>';
	
	define('ABS_URL_DEPTS','http://depts.washington.edu/uweb/inc/');
	define('INC_BASE_URL_DEPTS','/uweb/inc/');
	define('CHTML_INC_URL_BANK','/incs/');
	
	// store some reusable html and initialize some vars
	$css_js_url = 'head.cgi?i='.$usersPrefs['owner'];
	$header_url = 'header.cgi?i='.$usersPrefs['owner'];
	$footer_url = 'footer.cgi?i='.$usersPrefs['owner'];
	
	// css + javascript urls
	//<!--chtml include "//president/inc/header.html" -->
	$chtml_inc_css_js_html = '<!--chtml include "//'.CHTML_INC_URL_BANK.'head.inc" -->
';	
	
	$inc_css_js_depts_html = '<!--#include virtual=&#34;'.INC_BASE_URL_DEPTS.$css_js_url.'&#34;-->';
	//$inc_css_js_bank = INC_BASE_URL_BANK.$css_js_url;
	$header_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/header.css" type="text/css" media="screen" />
';
	$footer_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/footer.css" type="text/css" media="screen" />
';
	$footer_no_patch_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/footer_no_patch.css" type="text/css" media="screen" />
';
	$js_html = '<script type="text/javascript">
// clear out the global search input text field
function make_blank() {document.uwglobalsearch.q.value = "";}
</script>
';	
	
	// header urls
	$chtml_inc_h_purple_html = '<!--chtml include "//'.CHTML_INC_URL_BANK.'header-purple.inc" -->';
	$chtml_inc_h_gold_html = '<!--chtml include "//'.CHTML_INC_URL_BANK.'header-gold.inc" -->';
	$cp_h = curlRequestGenerator($header_url,'plain');
	$inc_h_depts = '<!--#include virtual=&#34;'.INC_BASE_URL_DEPTS.$header_url.'&#34;-->';
	//$inc_h_bank = INC_BASE_URL_BANK.$header_url;
	
	// footer urls
	$chtml_inc_f_html = '<!--chtml include "//'.CHTML_INC_URL_BANK.'footer.inc" -->';
	$cp_f = curlRequestGenerator($footer_url,'plain');
	$inc_f_depts = '<!--#include virtual=&#34;'.INC_BASE_URL_DEPTS.$footer_url.'&#34;-->';
	//$inc_f_bank = INC_BASE_URL_BANK.$footer_url;
	
	$chtml_css_js_html = ''
	
	$cp_css_js_h_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$header_css_html.$js_html.'</textarea></form></td>';
	$cp_css_js_f_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$footer_css_html.$footer_no_patch_css_html.'</textarea></form></td>';
	$cp_css_js_both_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$header_css_html.$footer_css_html.$footer_no_patch_css_html.$js_html.'</textarea></form></td>';
	
	$inc_css_js_html = '<td><form><strong>On depts:</strong>&nbsp;&nbsp;<input type="text" value="'.$inc_css_js_depts_html.'" size="35" />
	                              <br />
	                              <br />
	                              <strong>On bank:</strong>&nbsp;&nbsp;<input type="text" value="Coming soon!" size="35" /></form></td>';
	
	$cp_h_html = '<td class="removeOutline"><form><textarea cols="70" rows="16">'.$cp_h.'</textarea></form></td>';
	$inc_h_html = '<td><form><strong>On depts:</strong>&nbsp;&nbsp;<input type="text" value="'.$inc_h_depts.'" size="35" />
	                          <br />
	                          <br />
	                          <strong>On bank:</strong>&nbsp;&nbsp;<input type="text" value="Coming soon!" size="35" /></form></td>';
	
	$cp_f_html = '<td class="removeOutline"><form><textarea cols="70" rows="16">'.$cp_f.'</textarea></form></td>';
	$inc_f_html = '<td><form><strong>On depts:</strong>&nbsp;&nbsp;<input type="text" value="'.$inc_f_depts.'" size="35" />
	                          <br />
	                          <br />
	                          <strong>On bank:</strong>&nbsp;&nbsp;<input type="text" value="Coming soon!" size="35" /></form></td>';

	// table builder
	$empty_col = '<th class="removeOutline">&nbsp;</th>';
	$cp_col = '<th>Copy &amp; Paste <a href="#" id="cpInstallCall">Install</a> <span>|</span>  <a href="#" id="cpHelpCall">Help</a></th>';
	$inc_col = '<th>Include(s) <a href="#" id="incInstallCall">Install</a> <span>|</span> <a href="#" id="incHelpCall">Help</a></th>';
	$css_js_row = '<td><strong>CSS +<br />Javascript</strong></td>';
	$header_row = '<td><strong>Header</strong></td>';
	$footer_row = '<td><strong>Footer</strong></td>';
	
	$html .= '<table cellpadding="4" cellspacing="4"><tr>';
	
	// user wants the static header and footer
	if ($usersPrefs['selection'] == 'static' && $usersPrefs['static'] == '1') {
		
		$html .= $empty_col.$inc_col.'</tr><tr>'.;
		
	// user wants just the static header
	} elseif {
		
	// user wants just the static footer
	} elseif {	
	
	// user wants both the header and footer
	} elseif ($usersPrefs['selection'] == 'strip' && $usersPrefs['selected'] == '1') {
		
		$html .= $empty_col;
		
		// include + copy & paste
		if ($usersPrefs['code_pref'] == 'both') {
			$html .= $cp_col.$inc_col.'</tr><tr>'.$css_js_row.$cp_css_js_both_html.$inc_css_js_html.'</tr><tr>'.$header_row.$cp_h_html.$inc_h_html.'</tr><tr>'.$footer_row.$cp_f_html.$inc_f_html;
		
		// include
		} elseif ($usersPrefs['code_pref'] == 'include') {
			$html .= $inc_col.'</tr><tr>'.$css_js_row.$inc_css_js_html.'</tr><tr>'.$header_row.$inc_h_html.'</tr><tr>'.$footer_row.$inc_f_html;
		
		// copy & paste
		} else {
			$html .= $cp_col.'</tr><tr>'.$css_js_row.$cp_css_js_both_html.'</tr><tr>'.$header_row.$cp_h_html.'</tr><tr>'.$footer_row.$cp_f_html;
		
		}
		
	// user wants just the header
	} elseif ($usersPrefs['selection'] == 'strip' && $usersPrefs['selected'] == '0') {
		
		$html .= $empty_col;
		
		// include + copy & paste
		if ($usersPrefs['code_pref'] == 'both') {
			$html .= $cp_col.$inc_col.'</tr><tr>'.$css_js_row.$cp_css_js_h_html.$inc_css_js_html.'</tr><tr>'.$header_row.$cp_h_html.$inc_h_html;	
		
		// include
		} elseif ($usersPrefs['code_pref'] == 'include') {
			$html .= $inc_col.'</tr><tr>'.$css_js_row.$inc_css_js_html.'</tr><tr>'.$header_row.$inc_h_html;
		
		// copy & paste
		} else {
			$html .= $cp_col.'</tr><tr>'.$css_js_row.$cp_css_js_h_html.'</tr><tr>'.$header_row.$cp_h_html;
		
		}		
	
	// user wants just the footer
	} elseif ($usersPrefs['selection'] == 'no-hdr' && $usersPrefs['selected'] == '1') {
		
		$html .= $empty_col;
		
		// include + copy & paste
		if ($usersPrefs['code_pref'] == 'both') {
			$html .= $cp_col.$inc_col.'</tr><tr>'.$css_js_row.$cp_css_js_f_html.$inc_css_js_html.'</tr><tr>'.$footer_row.$cp_f_html.$inc_f_html;	
		
		// include
		} elseif ($usersPrefs['code_pref'] == 'include') {
			$html .= $inc_col.'</tr><tr>'.$css_js_row.$inc_css_js_html.'</tr><tr>'.$footer_row.$inc_f_html;
		
		// copy & paste
		} else {
			$html .= $cp_col.'</tr><tr>'.$css_js_row.$cp_css_js_f_html.'</tr><tr>'.$footer_row.$cp_f_html;
		}
		
	} else {
		$html .= '<th>You selected nothing... that\'s funny.  Did you really mean to do this?</th>';
	}
	
	$html .= '</tr></table>';
	
	// pass the $html back to the callback function in our ajax post script
	echo $html;
		
}

/**
 * runGenerator - acts as a constructor of sorts, interprets what functions should be called
 *
 * @param array $values
 * @return true
 */
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

runGenerator($values);

?>
