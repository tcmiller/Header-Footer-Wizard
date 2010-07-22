<?php

require_once('tmplgen-db.inc.php');

/**
 * curlRequestGenerator - returns a particular CURL resource, based on some inputs
 *
 * @param string $url
 * @param string $type optional
 * @return $curl
 */
function curlRequestGenerator($url,$type = '') {
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://depts.washington.edu/uweb/inc/'.$url);
	curl_setopt($ch, CURLOPT_HEADER, false);
	
	// we just want the plain text back, not an html preview
	if ($type == 'plain') {
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl = curl_exec($ch);
		return $curl;
	} else {
		curl_exec($ch);
		curl_close($ch);
	}
}

/**
 * accountLookup() - Look up just the owner info
 *
 * @todo - Look up any current info we might have for the logged in user
 * 
 * @return array $accountData
 */
function accountLookup() {
	
	global $mdb2;
		
	// this query just retrieves the account owner
	$query = sprintf('SELECT owner,
	                         email,
	                         site_url,
	                         active,
	                         code_pref
	                    FROM account
	                   WHERE owner = \'%s\'',$_SERVER['REMOTE_USER']);
	
	// Proceed with getting some data...
	$res =& $mdb2->query($query);
		
	// build the data array
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$accountData = $row;
	}
	
	return $accountData;
	
}

function createAccount() {
	
	// call and store the results from accountLookup()
	$account = accountLookup();
	
	// make sure the results exist and are in array format
	if (!empty($account) && is_array($account)) {
			
		// no need to create an account, one already exists
		$accountStartup = '';
		
	} else {
		
		// no account exists, create one
		$accountStartup = '$(window).load(function () {
		  		// run code
				$.post(\'generate.php\',{ owner: $(\'#owner\').val(),
		                                  processType: \'initA\' },function(data) {
		     	$(\'#results\').text(data);
		     },\'html\');
		      
		   	});';
			
	}
	
	echo $accountStartup;
	
}

/**
 * setAccountDefaults() - Look through any returned account data and set if exists
 *
 * 
 * @return string $accountDefaults
 */
function setAccountDefaults() {
	
	// call and store the results from accountLookup()
	$account = accountLookup();
	
	// call our header and footer info as well
	$header = headerLookup();
	$footer = footerLookup();
	
	// set up $accountDefaults
	$accountDefaults = '';
	
	// see if email exists and if so, show it
	if (!empty($account['email'])) {
		$accountDefaults .= '$(\'#email\').attr(\'value\',\''.$account['email'].'\');';
	}
	
	// see if site_url exists and if so, show it
	if (!empty($account['site_url'])) {
		$accountDefaults .= '$(\'#site_url\').attr(\'value\',\''.$account['site_url'].'\');';
	}
	
	// see if code preference exists and if so, show it
	if (!empty($account['code_pref'])) {
		// look to see if the user had selected the static chtml include output options, and if so, check the include radio button
		if ($header['selection'] == 'static' || $footer['static'] == 1) {
			$accountDefaults .= '$(\'#include\').attr(\'checked\',\'checked\');';
			$accountDefaults .= '$(\'#copy-paste\').attr(\'disabled\',\'disabled\');';
    		$accountDefaults .= '$(\'#both\').attr(\'disabled\',\'disabled\');';
		} else {
			$accountDefaults .= '$(\'#'.$account['code_pref'].'\').attr(\'checked\',\'checked\');';
		}
	}
	
	echo $accountDefaults;
	
}

/**
 * headerLookup() - Look up any header info for the logged in user
 *
 * 
 * @return array $headerData
 */
function headerLookup() {
	
	global $mdb2;
		
	// this query retrieves header data
	$query = sprintf('SELECT hdr.selection,
	                         hdr.blockw,
	                         hdr.patch,
	                         hdr.wordmark,
	                         hdr.color,
	                         hdr.search
	                    FROM header as hdr,
	                         account as acct
	                   WHERE acct.owner = \'%s\'
	                     AND hdr.owner = acct.owner',$_SERVER['REMOTE_USER']);
	
	// Proceed with getting some data...
	$res =& $mdb2->query($query);
		
	// build the data array
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$headerData = $row;
	}
	
	return $headerData;
	
}

/**
 * setHeaderDefaults() - If the header row for this user doesn't exist, set some header option defaults
 *
 * @return string $headerDefaults
 */
function setHeaderDefaults() {
	
	// call and store the results from headerLookup()
	$header = headerLookup();
	
	$headerDefaults = '';
	
	// make sure the results exist and are in array format
	if (!empty($header) && is_array($header)) {
		
		// header record exists, return current user's selections
		
		// selection lookups, primarily for block display
		if ($header['selection'] == 'strip') {
			$headerDefaults .= '$(\'#step2_sub\').css(\'display\',\'block\');';
		}
		
		// search lookups
		if ($header['search'] == 'basic') {
			$search = 's_basic';
		} else {
			$search = 's_no';
		}
		
		// patch lookups
		if ($header['patch'] == '1') {
			$patch = 'patch';
			$display = 'none';			
		} else {
			$patch = 'no_patch';
			$display = 'block';
		}
		
		// blockw lookups
		if ($header['blockw'] == '1') {
			$blockw = 'w_yes';
		} else {
			$blockw = 'w_no';
		}

		// build string	
		$headerDefaults .= '$(\'#'.$header['selection'].'\').attr(\'checked\',\'checked\');';
		$headerDefaults .= '$(\'#'.$header['color'].'_bg\').attr(\'checked\',\'checked\');';
		$headerDefaults .= '$(\'#'.$search.'\').attr(\'checked\',\'checked\');';
		$headerDefaults .= '$(\'#'.$patch.'\').attr(\'checked\',\'checked\');';
		$headerDefaults .= '$(\'#'.$blockw.'\').attr(\'checked\',\'checked\');';
		$headerDefaults .= '$(\'#blockwBlk\').css(\'display\',\''.$display.'\');';
		
	} else {
		
		// no header selections exist, set some defaults
		$headerDefaults .= '$(\'#gold_bg\').attr(\'checked\',\'checked\');
						    $(\'#patch\').attr(\'checked\',\'checked\');
						    $(\'#w_yes\').attr(\'checked\',\'checked\');
						    $(\'#s_basic\').attr(\'checked\',\'checked\');';

		$headerDefaults .= '$(\'#blockwBlk\').css(\'display\',\'none\');';
			
	}
	
	echo $headerDefaults;
	
}

/**
 * footerLookup() - Look up any footer info for the logged in user
 *
 * 
 * @return array $footerData
 */
function footerLookup() {
	
	global $mdb2;
		
	// this query just retrieves the color (a single piece of data to tell us if there's a row)
	$query = sprintf('SELECT ftr.selected,
	                         ftr.blockw,
	                         ftr.wordmark,
	                         ftr.patch,
	                         ftr.static
	                    FROM footer as ftr,
	                         account as acct
	                   WHERE acct.owner = \'%s\'
	                     AND ftr.owner = acct.owner',$_SERVER['REMOTE_USER']);
	
	// Proceed with getting some data...
	$res =& $mdb2->query($query);
		
	// build the data array
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$footerData = $row;
	}
	
	return $footerData;
	
}

/**
 * setFooterDefault
 *
 * @return string $footerDefault
 */
function setFooterDefault() {
	
	$footer = footerLookup();
	
	$footerDefault = '';
	
	// make sure the results exist and are in array format
	if (!empty($footer) && is_array($footer)) {
		
		// we need an interpreter to handle the footer data
		if ($footer['selected'] == 0) {
			
			// no selection
			$footerType = 'ftr_no';
	
		} elseif ($footer['static'] == 1) {
			
			// static selection
			$footerType = 'ftr_static';
			
		} elseif ($footer['blockw'] == 0 && $footer['wordmark'] == 0) {
			
			// is it the purple patch?
			if ($footer['patch'] == 'purple') {
				
				$footerType = 'ftr_purple_patch';
					
			
			} else {
				
				// must be the gold patch
				$footerType = 'ftr_gold_patch';
				
			}
			
		// is it with the block "W"?
		} elseif ($footer['blockw'] == 1 && $footer['wordmark'] == 1) {
			
			$footerType = 'ftr_w';
			
		} else {
			
			// must be the basic footer
			$footerType = 'ftr_basic';
				
		}
		
		$footerDefault = '$(\'#'.$footerType.'\').attr(\'checked\',\'checked\');';
		
		
	} else {
		
		// only if we want a default (when they first enter the form)
		//$footerDefault = '$(\'#ftr_basic\').attr(\'checked\',\'checked\');';
		
	}
	
	echo $footerDefault;
	
}

/**
 * loadHdrPrvw() - Dynamically load a preview of the user's header
 *
 */
function loadHdrPrvw() {
	
	$hdrPrvw = '';
	
	// see if a header exists for this user
	$header = headerLookup();

	// make sure the results exist and are in array format
	if (!empty($header) && ($header['selection'] == 'strip' || $header['selection'] == 'sink')) {
		$hdrPrvw = curlRequestGenerator('header.cgi?i='.$_SERVER['REMOTE_USER'].'&amp;c=0','plain');
	} elseif (!empty($header) && $header['selection'] == 'static') {
		$hdrPrvw = '<div class="no-selection-msg">chtml header include selected: Currently no preview available</div>';
	} else {
		$hdrPrvw = '<div class="no-selection-msg">No header selection</div>';
	}
	
	echo $hdrPrvw;
	
}

/**
 * loadFtrPrvw() - Dynamically load a preview of the user's footer
 *
 */
function loadFtrPrvw() {
	
	$ftrPrvw = '';
	
	// see if a footer exists for this user
	$footer = footerLookup();
	
	// make sure the results exist and are in array format
	if (!empty($footer) && $footer['selected'] == '1' && $footer['static'] == 0) {
		$ftrPrvw = curlRequestGenerator('footer.cgi?i='.$_SERVER['REMOTE_USER'].'&amp;c=0','plain');
	} elseif (!empty($footer) && $footer['static'] == '1') {
		$ftrPrvw = '<div class="no-selection-msg">chtml footer include selected: Currently no preview available</div>';
	} else {
		$ftrPrvw = '<div class="no-selection-msg">No footer selection</div>';
	}
	
	echo $ftrPrvw;
	
}

/**
 * setStyleDefaults() - This sets some style defaults for the page, based on certain user info we know
 *
 */
function setStyleDefaults() {
	
	$styleDefaults = '';
	
	// look for a header or a footer
	$header = headerLookup();
	$footer = footerLookup();	
	
	// provide the appropriate stylesheet, based on the user's header selection
	if (!empty($header) && $header['selection'] == 'sink') {
		$styleDefaults .= '$(\'head\').append(\'<link rel="stylesheet" href="../inc/css/header-full.css" type="text/css" title="header-styles" />\');';
	} else {
		$styleDefaults .= '$(\'head\').append(\'<link rel="stylesheet" href="../inc/css/header.css" type="text/css" title="header-styles" />\');';
	}
	
	// does a user have a header or footer selected in the system?
	if ((!empty($header) && ($header['selection'] == 'strip' || $header['selection'] == 'sink')) || (!empty($footer) && $footer['selected'] == '1')) {
		$styleDefaults .= '$(\'#bodyTxt\').css(\'display\',\'block\');';
	} else {
		$styleDefaults .= '$(\'#bodyTxt\').css(\'display\',\'none\');';
	}
	
	$styleDefaults .= '$(\'.unavailable\').css(\'cursor\',\'arrow\').click(function(){
     						return false;
					  });';
	$styleDefaults .= '$(\'.available\').css(\'cursor\',\'arrow\').click(function(){
     						return false;
					  });'; 
	
	echo $styleDefaults;
	
}

/**
 * createAndSetAppDefaults() - This function just sets things in motion
 *
 */
function createAndSetAppDefaults() {
	
	// set some dynamic styles
	setStyleDefaults();
	
	// create the account if it doesn't already exist
	createAccount();
	
	// set some account defaults
	setAccountDefaults();
	
	// set some header defaults
	setHeaderDefaults();
	
	// set a footer default
	setFooterDefault();
	
}

?>