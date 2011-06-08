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

	switch ($values['processType']) {

		// create an account row, header row and footer row, upon entering the system for the first time
		case 'initA':
			$a_table_name = 'account';
			$a_fields_values = array('owner'=>$values['owner'],
			                         'active'=>0,
			                         'created_date' => date('Y-m-d H:i:s'),
								     'modified_date' => '0000-00-00 00:00:00',
								     'last_accessed' => '0000-00-00 00:00:00');
			$a_procType = 'MDB2_AUTOQUERY_INSERT';
			$a_join = 'null';
			$a_types = array('text','integer','text','text','text');

			$mdb2->loadModule('Extended');
			$affectedRows = $mdb2->extended->autoExecute($a_table_name, $a_fields_values,
									constant($a_procType), $a_join, $a_types);

			if (PEAR::isError($affectedRows)) {

				die($affectedRows->getMessage());

				// add an error message to the exceptions handler or something

			}

			// create a header row
			$h_table_name = 'header';
			$h_fields_values = array('owner' => $values['owner'],
			                         'created_date' => date('Y-m-d H:i:s'),
								     'last_modified' => '0000-00-00 00:00:00');
			$h_procType = 'MDB2_AUTOQUERY_INSERT';
			$h_join = 'null';
			$h_types = array('text','text','text');

			$mdb2->loadModule('Extended');
			$affectedRows = $mdb2->extended->autoExecute($h_table_name, $h_fields_values,
									constant($h_procType), $h_join, $h_types);

			if (PEAR::isError($affectedRows)) {

				die($affectedRows->getMessage());

				// add an error message to the exceptions handler or something

			}

			// create a footer row
			$f_table_name = 'footer';
			$f_fields_values = array('owner' => $values['owner'],
			                         'created_date' => date('Y-m-d H:i:s'),
				                     'last_modified' => '0000-00-00 00:00:00');
			$f_procType = 'MDB2_AUTOQUERY_INSERT';
			$f_join = 'null';
			$f_types = array('text','text','text');

			$mdb2->loadModule('Extended');
			$affectedRows = $mdb2->extended->autoExecute($f_table_name, $f_fields_values,
									constant($f_procType), $f_join, $f_types);

			if (PEAR::isError($affectedRows)) {

				die($affectedRows->getMessage());

				// add an error message to the exceptions handler or something

			}

			break;

		case 'updtA':
			$table_name = 'account';
			$fields_values = array('email'=>$values['email'],
			                       'site_url'=>$values['site_url'],
			                       'code_pref'=>$values['code_pref'],
			                       'modified_date'=>date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'owner = '.$mdb2->quote($values['owner'], 'text').'';
			$types = array('text','text','text','text');

			$mdb2->loadModule('Extended');
			$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
									constant($procType), $join, $types);

			if (PEAR::isError($affectedRows)) {

				die($affectedRows->getMessage());

				// add an error message to the exceptions handler or something

			} else {

				return true;
			}

			break;

		case 'fnlzA':

			// call up our code and display it
			getCode($values);

			$table_name = 'account';

			$fields_values = array('active'=>1,
			                       'modified_date'=>date('Y-m-d H:i:s'));
			$procType = 'MDB2_AUTOQUERY_UPDATE';
			$join = 'owner = '.$mdb2->quote($values['owner'], 'text').'';
			$types = array('integer','text');

			$mdb2->loadModule('Extended');
			$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
									constant($procType), $join, $types);

			if (PEAR::isError($affectedRows)) {

				die($affectedRows->getMessage());

				// add an error message to the exceptions handler or something

			} else {

				return true;
			}

			break;

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

	// Step 1: Attempt to retrieve a user's row from the header table
	$query = sprintf('SELECT hdr.color
	                    FROM header as hdr,
	                         account as acct
	                   WHERE acct.owner = \'%s\'
	                     AND hdr.owner = acct.owner',$values['owner']);

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
				
		if ($values['sesqui'] == 0) {
			$sesqui = 0;
		} else {
			$sesqui = $values['sesqui'];
		}

		// no need to create a header record, one already exists
		$fields_values = array('selection' => $values['selection'],
		                       'blockw' => $blockw,
		                       'patch' => $values['patch'],
		                       'sesqui' => $sesqui,
		                       'sesqui_sink' => $values['sesqui_sink'],
		                       'wordmark' => 1,
		                       'color' => $values['color'],
		                       'search' => $values['search'],
		                       'last_modified' => date('Y-m-d H:i:s'));
		$procType = 'MDB2_AUTOQUERY_UPDATE';
		$join = 'owner = '.$mdb2->quote($values['owner'], 'text').'';
		$types = array('text','integer','integer','integer','integer','integer','text','text','text');

	}

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							constant($procType), $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());

		// add an error message to the exceptions handler or something

	} else {

		// show a preview for the thin strip or the kitchen sink
		if ($values['selection'] == 'strip' || $values['selection'] == 'sink') {

			curlRequestGenerator('header.cgi?i='.$values['owner'].'&c=0');

		} elseif ($values['selection'] == 'static') {

			echo '<div class="no-selection-msg">chtml header include selected: Currently no preview available</div>';

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
			$sesqui = '0';
			$static = '0';
			break;
		case 'w':
			$selected = '1';
			$blockw = '1';
			$wordmark = '1';
			$patch = '0';
			$sesqui = '0';
			$static = '0';
			break;
		case 'goldPatch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'gold';
			$sesqui = '0';
			$static = '0';
			break;
		case 'purplePatch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'purple';
			$sesqui = '0';
			$static = '0';
			break;
		case 'gold150Patch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'gold';
			$sesqui = '1';
			$static = '0';
			break;
		case 'purple150Patch':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = 'purple';
			$sesqui = '1';
			$static = '0';
			break;
		case 'static':
			$selected = '1';
			$blockw = '0';
			$wordmark = '0';
			$patch = '0';
			$sesqui = '0';
			$static = '1';
			break;
		case 'no':
			$selected = '0';
			$blockw = '0';
			$wordmark = '0';
			$patch = '0';
			$sesqui = '0';
			$static = '0';
			break;
	}

	// check to see if the footer row exists for this particular "owner"... this helps us know if we're going to be updating/deleting or inserting
	$mdb2->loadModule('Extended');
	$query = 'SELECT * FROM footer WHERE owner = ?';
	$footerInfo = $mdb2->extended->getRow($query, null, array($values['owner']), array('text'));

	// initialize our query mode string


	if (!empty($footerInfo) && is_array($footerInfo)) {
		
		// set the query mode to "UPDATE"

		$join = 'owner = '.$mdb2->quote($values['owner'], 'text').'';
		$fields_values = array(
		    'selected' => $selected,
			'blockw' => $blockw,
		    'wordmark' => $wordmark,
		    'patch' => $patch,
		    'sesqui' => $sesqui,
		    'static' => $static,
			'last_modified' => date('Y-m-d H:i:s'));
		$types = array('integer','integer','integer','text','integer','integer','text');

	}

	$table_name = 'footer';

	$mdb2->loadModule('Extended');
	$affectedRows = $mdb2->extended->autoExecute($table_name, $fields_values,
							MDB2_AUTOQUERY_UPDATE, $join, $types);

	if (PEAR::isError($affectedRows)) {
		die($affectedRows->getMessage());

		// add an error message to the exceptions handler or something

	} else {

		// only show a preview if they select a footer
		if ($selected == '1' && $static == '0') {

			curlRequestGenerator('footer.cgi?i='.$values['owner'].'&c=0');

		} elseif ($static == '1') {

			echo '<div class="no-selection-msg">chtml footer include selected: Currently no preview available</div>';

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
function getCode($values) {

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
	                     AND hdr.owner = acct.owner
	                     AND ftr.owner = acct.owner',$values['owner']);

	// Proceed with getting some data...
	$res =& $mdb2->query($query);

	// build the header data array
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$usersPrefs = $row;
	}
	
	$html = '';

	// store some random js here since we can't call the help modals out of index.php, only generate.php
	$html .= '<script type="text/javascript">
		$(document).ready(function(){

			$(".cpHelpCall").colorbox({width:"50%", inline:true, href:"#cpHelp"});
			$(".incHelpCall").colorbox({width:"50%", inline:true, href:"#incHelp"});
			$("#cpInstallCall").colorbox({width:"50%", inline:true, href:"#cpInstall"});
			$("#incInstallCall").colorbox({width:"50%", inline:true, href:"#incInstall"});

		});
	</script>';

	define('ABS_URL_DEPTS','http://depts.washington.edu/uweb/inc/');
	define('INC_BASE_URL_DEPTS','/uweb/inc/');
	define('CHTML_INC_URL_BANK','incs/');

	// store some reusable html and initialize some vars
	$css_js_url = 'head.cgi?i='.$usersPrefs['owner'];
	$header_url = 'header.cgi?i='.$usersPrefs['owner'];
	$footer_url = 'footer.cgi?i='.$usersPrefs['owner'];

	$header_url_prvw = 'header.cgi?i='.$usersPrefs['owner'].'&c=0';
	$footer_url_prvw = 'footer.cgi?i='.$usersPrefs['owner'].'&c=0';

	// css + javascript urls

	$chtml_inc_css_js_html = '<!--chtml include &#34;//'.CHTML_INC_URL_BANK.'head.inc&#34; -->';

	$inc_css_js_depts_html = '<!--#include virtual=&#34;'.INC_BASE_URL_DEPTS.$css_js_url.'&#34;-->';

	$header_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/header.css" type="text/css" media="screen" />
';
	$header_full_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/header-full.css" type="text/css" media="screen" />
';
	$print_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/print.css" type="text/css" media="print" />
';
	$footer_css_html = '<link rel="stylesheet" href="'.ABS_URL_DEPTS.'css/footer.css" type="text/css" media="screen" />
';
	$js_html = '<script type="text/javascript">
// clear out the global search input text field
window.onload = function() {

     if (document.getElementById("searchInput")) {

       var query = document.getElementById("searchInput");

       query.onfocus = function() {
         if (query.value == query.defaultValue) {
           query.value = "";
         }
       }

       query.onblur = function() {
         if (query.value == "") {
           query.value = query.defaultValue;
         }
       }

     }

}
</script>
';

	// header urls
	$chtml_inc_h_purple_html = '<!--chtml include &#34;//'.CHTML_INC_URL_BANK.'header-purple.inc&#34; -->';
	$chtml_inc_h_gold_html = '<!--chtml include &#34;//'.CHTML_INC_URL_BANK.'header-gold.inc&#34; -->';
	$cp_h = curlRequestGenerator($header_url_prvw,'plain');
	$inc_h_depts = '<!--#include virtual=&#34;'.INC_BASE_URL_DEPTS.$header_url.'&#34;-->';

	// footer urls
	$chtml_inc_f_html = '<!--chtml include &#34;//'.CHTML_INC_URL_BANK.'footer.inc&#34; -->';
	$cp_f = curlRequestGenerator($footer_url_prvw,'plain');
	$inc_f_depts = '<!--#include virtual=&#34;'.INC_BASE_URL_DEPTS.$footer_url.'&#34;-->';

	// chtml css+js include
	$chtml_css_js_html = '<td><form><input type="text" value="'.$chtml_inc_css_js_html.'" size="35" /></form></td>';

	// copy & paste css+js html
	$cp_css_js_h_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$header_css_html.$print_css_html.$js_html.'</textarea></form></td>';
	$cp_css_js_h_f_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$header_full_css_html.$print_css_html.$js_html.'</textarea></form></td>';
	$cp_css_js_f_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$print_css_html.$footer_css_html.'</textarea></form></td>';
	$cp_css_js_both_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$header_css_html.$print_css_html.$footer_css_html.$js_html.'</textarea></form></td>';
	$cp_css_js_both_h_f_html = '<td class="removeOutline"><form><textarea cols="70" rows="8">'.$header_full_css_html.$print_css_html.$footer_css_html.$js_html.'</textarea></form></td>';

	$inc_css_js_html = '<td><form><strong>On depts:</strong>&nbsp;&nbsp;<input type="text" value="'.$inc_css_js_depts_html.'" size="35" /></form></td>';

	// chtml header include(s) html
	$chtml_h_html = '<td><form><span style="display: block; float: left; margin: 0; padding: 0; width: 50px; font-size: 12px; font-weight: bold;">Purple:</span> <input type="text" value="'.$chtml_inc_h_purple_html.'" size="50" /><br />
	                           <span style="display: block; float: left; margin: 0; padding: 0; width: 50px; font-size: 12px; font-weight: bold;">Gold:</span> <input type="text" value="'.$chtml_inc_h_gold_html.'" size="50" /></form></td>';

	$cp_h_html = '<td class="removeOutline"><form><textarea cols="70" rows="16">'.htmlentities($cp_h).'</textarea></form></td>';
	$inc_h_html = '<td><form><strong>On depts:</strong>&nbsp;&nbsp;<input type="text" value="'.$inc_h_depts.'" size="35" /></form></td>';

	// chtml footer include html
	$chtml_f_html = '<td><form><input type="text" value="'.$chtml_inc_f_html.'" size="35" /></form></td>';

	$cp_f_html = '<td class="removeOutline"><form><textarea cols="70" rows="16">'.htmlentities($cp_f).'</textarea></form></td>';
	$inc_f_html = '<td><form><strong>On depts:</strong>&nbsp;&nbsp;<input type="text" value="'.$inc_f_depts.'" size="35" /></form></td>';

	// table builder
	$empty_col = '<th class="removeOutline">&nbsp;</th>';
	$cp_col = '<th>Copy &amp; Paste <a href="#" id="cpInstallCall">Install</a> <span>|</span>  <a href="#" class="cpHelpCall">Help</a></th>';
	$inc_col = '<th>Include(s) <a href="#" id="incInstallCall">Install</a> <span>|</span> <a href="#" class="incHelpCall">Help</a></th>';
	$css_js_row = '<td><strong>CSS +<br />Javascript</strong></td>';
	$header_row = '<td><strong>Header</strong></td>';
	$footer_row = '<td><strong>Footer</strong></td>';

	$html .= '<table cellpadding="4" cellspacing="4"><tr>';

	// user wants the static header and footer
	if ($usersPrefs['selection'] == 'static' && $usersPrefs['static'] == '1') {

		$html .= $empty_col.$inc_col.'</tr><tr>'.$css_js_row.$chtml_css_js_html.'</tr><tr>'.$header_row.$chtml_h_html.'</tr><tr>'.$footer_row.$chtml_f_html;

	// user wants just the static header
	} elseif ($usersPrefs['selection'] == 'static') {

		$html .= $empty_col.$inc_col.'</tr><tr>'.$css_js_row.$chtml_css_js_html.'</tr><tr>'.$header_row.$chtml_h_html;

	// user wants just the static footer
	} elseif ($usersPrefs['static'] == '1') {

		$html .= $empty_col.$inc_col.'</tr><tr>'.$css_js_row.$chtml_css_js_html.'</tr><tr>'.$footer_row.$chtml_f_html;

	// user wants both the full header and footer
	} elseif ($usersPrefs['selection'] == 'sink' && $usersPrefs['selected'] == '1') {

		$html .= $empty_col;

		// include + copy & paste
		if ($usersPrefs['code_pref'] == 'both') {
			$html .= $cp_col.$inc_col.'</tr><tr>'.$css_js_row.$cp_css_js_both_h_f_html.$inc_css_js_html.'</tr><tr>'.$header_row.$cp_h_html.$inc_h_html.'</tr><tr>'.$footer_row.$cp_f_html.$inc_f_html;

		// include
		} elseif ($usersPrefs['code_pref'] == 'include') {
			$html .= $inc_col.'</tr><tr>'.$css_js_row.$inc_css_js_html.'</tr><tr>'.$header_row.$inc_h_html.'</tr><tr>'.$footer_row.$inc_f_html;

		// copy & paste
		} else {
			$html .= $cp_col.'</tr><tr>'.$css_js_row.$cp_css_js_both_h_f_html.'</tr><tr>'.$header_row.$cp_h_html.'</tr><tr>'.$footer_row.$cp_f_html;

		}

	// user wants just the full header and no footer
	} elseif ($usersPrefs['selection'] == 'sink' && $usersPrefs['selected'] == '0') {

		$html .= $empty_col;

		// include + copy & paste
		if ($usersPrefs['code_pref'] == 'both') {
			$html .= $cp_col.$inc_col.'</tr><tr>'.$css_js_row.$cp_css_js_h_f_html.$inc_css_js_html.'</tr><tr>'.$header_row.$cp_h_html.$inc_h_html;

		// include
		} elseif ($usersPrefs['code_pref'] == 'include') {
			$html .= $inc_col.'</tr><tr>'.$css_js_row.$inc_css_js_html.'</tr><tr>'.$header_row.$inc_h_html;

		// copy & paste
		} else {
			$html .= $cp_col.'</tr><tr>'.$css_js_row.$cp_css_js_h_f_html.'</tr><tr>'.$header_row.$cp_h_html;

		}

	// user wants both the thin strip header and footer
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
