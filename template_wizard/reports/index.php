<?php

require_once('tmplgen-db.inc.php');

function getAcctInfo($active = 1) {
	
	global $mdb2;
	
	$query = sprintf('SELECT DISTINCT owner,
	                                  email,
	                                  site_url
	                             FROM account
	                            WHERE active = \'%s\'
	                              AND email != \'%s\'',$active,'?');
	
	$res =& $mdb2->query($query);
		
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$results[] = $row;
	}
	
	return $results;
	
}

function getNumAccts($active = 1) {
	
	global $mdb2;
		
	$query = sprintf('SELECT DISTINCT owner
	                             FROM account
	                            WHERE active = \'%s\'',$active);
	
	$res =& $mdb2->query($query);

	$num = $res->numRows();

	return $num;
	
}

function getPurpleGoldBGNum() {
	
	global $mdb2;
		
	$query = sprintf('SELECT hdr.color,
	                         COUNT( * ) as count 
					    FROM header as hdr,
					         account as acct
					   WHERE acct.active = \'%s\'
					     AND acct.owner = hdr.owner
					GROUP BY hdr.color',1);
	
	$res =& $mdb2->query($query);
		
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$results[] = $row;
	}
	
	return $results;
		
}

$purpleGoldCount = getPurpleGoldBGNum();


function getHeaderPatchNum() {
	
	global $mdb2;
		
	$query = sprintf('SELECT hdr.color,
	                         COUNT( * ) as count
	                    FROM account as acct,
	                         header as hdr
	                   WHERE acct.active = \'%s\'
	                     AND hdr.patch = \'%s\'
	                     AND acct.owner = hdr.owner
	                GROUP BY hdr.color',1,1);
	
	$res =& $mdb2->query($query);
		
	while (($row = $res->fetchRow(MDB2_FETCHMODE_ASSOC))) {
		$results[] = $row;
	}
	
	return $results;
	
}

$headerPatchCount = getHeaderPatchNum();


function getFooterPatchNum($color = 'purple') {
	
	global $mdb2;
		
	$query = sprintf('SELECT *
	                    FROM account as acct,
	                         footer as ftr
	                   WHERE acct.active = \'%s\'
	                     AND ftr.patch = \'%s\'
	                     AND acct.owner = ftr.owner',1,$color);
	
	$res =& $mdb2->query($query);

	$num = $res->numRows();

	return $num;
	
}

function basicSearchNum($search = 'basic') {
	
	global $mdb2;
		
	$query = sprintf('SELECT *
	                    FROM account as acct,
	                         header as hdr
	                   WHERE acct.active = \'%s\'
	                     AND hdr.search = \'%s\'
	                     AND acct.owner = hdr.owner',1,$search);
	
	$res =& $mdb2->query($query);

	$num = $res->numRows();

	return $num;
	
}

function getBlockWNum($blockw = 1) {
	
	global $mdb2;
		
	$query = sprintf('SELECT *
	                    FROM account as acct,
	                         footer as ftr
	                   WHERE acct.active = \'%s\'
	                     AND ftr.blockw = \'%s\'
	                     AND ftr.patch = \'%s\'
	                     AND acct.owner = ftr.owner',1,$blockw,0);
	
	$res =& $mdb2->query($query);

	$num = $res->numRows();

	return $num;
	
}

function getNumStaticUsers() {
	
	global $mdb2;
		
	$query = sprintf('SELECT *
	                    FROM account as acct,
	                         footer as ftr,
	                         header as hdr
	                   WHERE acct.active = \'%s\'
	                     AND ftr.static = \'%s\'
	                     AND hdr.selection = \'%s\'
	                     AND acct.owner = ftr.owner
	                     AND acct.owner = hdr.owner',1,1,'static');
	
	$res =& $mdb2->query($query);

	$num = $res->numRows();

	return $num;
	
}

function getCodePrefNums($code_pref='') {
	
	global $mdb2;
	
	$query = sprintf('SELECT DISTINCT owner
	                             FROM account
	                            WHERE code_pref = \'%s\'
	                     		  AND active = \'%s\'',$code_pref,1);
	
	$res =& $mdb2->query($query);

	$num = $res->numRows();

	return $num;
	
}

$emailsOnAString = '';
$accts = getAcctInfo($active=1);

for($i=0;$i<count($accts);$i++) {
	
	if ($i == (count($accts) - 1)) {
		$emailsOnAString .= $accts[$i]['email'];	
	} else {
		$emailsOnAString .= $accts[$i]['email'].'; ';
	}
	
}

$totalActiveAccts = getNumAccts($active = 1);
$totalInactiveAccts = getNumAccts($active = 0);
$totalAccts = $totalActiveAccts+$totalInactiveAccts;

$totalHeaderPatch = $headerPatchCount[0]['count']+$headerPatchCount[1]['count'];

$html = '';

$html .= '<html><head><title>Header &amp; Footer Wizard Reports</title>

<style type="text/css">

body {
	font-family: Arial, Verdana, Helvetica, Sans-serif;
	font-size: 12px;
}

h3 {
	margin: 14px 14px 2px -8px;
}
ul {
	list-style-type: none;
}

</style>

</head><body>';

$html .= '<h1>Header &amp; Footer Wizard Reports</h1>';

$html .= '<h2>A C C O U N T S</h2>';

$html .= '<ul>
 <li>Active: '.round(($totalActiveAccts/$totalAccts)*100,2).'% ('.$totalActiveAccts.')<br />
     Inactive: '.round(($totalInactiveAccts/$totalAccts)*100,2).'% ('.$totalInactiveAccts.')<br />
     Total: '.$totalAccts.'</li>
 <li>Emails for active accounts: <form><input value="'.$emailsOnAString.'" size="30" /></form></li>
</ul>';

$html .= '<h2>H E A D E R </h2>';

$html .= '<ul>
 <li><h3>Background color preference:</h3>
         Purple: '.round(($purpleGoldCount[0]['count']/$totalActiveAccts)*100,2).'% ('.$purpleGoldCount[0]['count'].')<br />
         Gold: '.round(($purpleGoldCount[1]['count']/$totalActiveAccts)*100,2).'% ('.$purpleGoldCount[1]['count'].')</li>
 <li><h3>Patch preference:</h3>
         Purple: '.round(($headerPatchCount[0]['count']/$totalHeaderPatch)*100,2).'% ('.$headerPatchCount[0]['count'].')<br />
         Gold: '.round(($headerPatchCount[1]['count']/$totalHeaderPatch)*100,2).'% ('.$headerPatchCount[1]['count'].')</li>
 <li><h3>Search preference:</h3>
         Basic: '.round(basicSearchNum('basic')/$totalActiveAccts*100,2).'% ('.basicSearchNum('basic').')<br />
         None: '.round(basicSearchNum('no')/$totalActiveAccts*100,2).'% ('.basicSearchNum('no').')</li>
</ul>';

$html .= '<h2>F O O T E R</h2>';

$html .= '<ul>
 <li><h3>Patch preference:</h3>
         Purple: '.round((getFooterPatchNum('purple')/$totalActiveAccts)*100,2).'% ('.getFooterPatchNum('purple').')<br />
         Gold: '.round((getFooterPatchNum('gold')/$totalActiveAccts)*100,2).'% ('.getFooterPatchNum('gold').')</li>
 <li><h3>Basic footer:</h3>
         With "w": '.round((getBlockWNum($blockw = 1)/$totalActiveAccts)*100,2).'% ('.getBlockWNum($blockw = 1).')<br />
         Without "w": '.round((getBlockWNum($blockw = 0)/$totalActiveAccts)*100,2).'% ('.getBlockWNum($blockw = 0).')</li>
</ul>';

$html .= '<h2>C O D E&nbsp;&nbsp;P R E F E R E N C E</h2>';

$html .= '<ul>
 <li>Copy &amp; Paste: '.getCodePrefNums('copy-paste').'</li>
 <li>Include: '.getCodePrefNums('include').'</li>
 <li>Both: '.getCodePrefNums('both').'</li>
 <li>CHTML: '.getNumStaticUsers().'</li></ul>';

$html .= '</body></html>';

echo $html;

?>