<?php

include_once('include/global.inc.php');

?>

<html>
<head>
<title>Template Generator 1.0</title>
<link rel="stylesheet" type="text/css" href="include/tempgen.css" /> 
<script type="text/javascript" src="include/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="tempgen.js"></script>

<script type="text/javascript">
$(document).ready(function() {
   $('#strip').click(function(){
     $('#step2_sub').show();
   });
   $('#sink').click(function(){
     $('#step2_sub').hide();
   });
});
</script>

</head>
<body>

<div id="header">
 <div id="lgo"><a href="http://www.washington.edu/"><img src="https://depts.washington.edu/coenv/header/w.gif" width="207" height="18" border="0" alt="UW Logo" /></a></div>  
 <div id="rhtlnks">
  <div id="searchb">   
   <form name="form1" id="searchbox_001967960132951597331:04hcho0_drk" action="http://www.google.com/cse">
    <input type="hidden" name="cx" value="001967960132951597331:04hcho0_drk" />
    <input type="hidden" name="cof" value="FORID:0" />
    <input name="q" type="text" size="20" value="Enter Search" onclick="make_blank();" />
    <input type="submit" name="sa" value="Go" />
   </form>
  </div>
  <div id="searcha">
   <ul>
    <li><a href="http://www.washington.edu/discovery/about.html">About Us</a>&nbsp;&nbsp;<span class="style1">|</span></li>      
    <li><a href="http://www.uwnews.org/">News</a>&nbsp;&nbsp;<span class="style1">|</span></li>
    <li><a href="http://gohuskies.ocsn.com/">Sports</a>&nbsp;&nbsp;<span class="style1">|</span></li>
    <li><a href="http://www.washington.edu/alumni/">Alumni</a>&nbsp;&nbsp;<span class="style1">|</span></li>
    <li><a href="http://myuw.washington.edu/">MyUW</a>&nbsp;&nbsp;<span class="style1">|</span></li>
    <li><a href="http://www.washington.edu/home/directories.html">Directories</a>&nbsp;&nbsp;<span class="style1">|</span></li>
    <li><a href="http://www.washington.edu/visit/events.html">Calendar</a></li>
   </ul>
  </div>
 </div>
</div>
<div id="centered">
 <div id="content">
  <h1>Template Generator 1.0</h1>
  <div id="step1">
   <h2>Step 1: <?php echo USER_INFO; ?></h2>
   <form name="" id="" action="">
    <label for="fname">First name:</label>
    <input type="text" name="fname" maxlength="20" />
    <br />
    <label for="lname">Last name:</label>
    <input type="" name="lname" maxlength="20" />
    <br />
    <label for="email">Email:</label>
    <input type="text" name="email" maxlength="40" />
    <br />
    <label for="url">Site URL:</label>
    <input type="text" name="url" maxlength="150" />
  </div>
  <div id="step2">
   <h2>Step 2: <?php echo THIN_STRIP; ?> or <?php echo KITCHEN_SINK; ?>?</h2>
   <label for="sinkOrStrip"></label>
   <input type="radio" name="sinkOrStrip" value="strip" id="strip" /> <?php echo THIN_STRIP; ?><br />
   <input type="radio" name="sinkOrStrip" value="sink" id="sink"  /> <?php echo KITCHEN_SINK ?>
  </div>
  <div class="clear"></div>
  <div id="step2_sub">
   
   <h3>Step 2a: Gold or purple background?</h3>
   <label for="purpleOrGold"></label>
   <input type="radio" name="purpleOrGold" value="purple" /> Purple<br />
   <input type="radio" name="purpleOrGold" value="gold" /> Gold
   <div class="dash"></div>
   
   
   <h3>Step 2b: W or no W?</h3>
   <label for="wOrNot"></label>
   <input type="radio" name="wOrNot" value="W" /> W<br />
   <input type="radio" name="wOrNot" value="noW" /> No W
   <div class="dash"></div>
   
   
   <h3>Step 2c: Search</h3>
   <label for="search"></label>
   <div id="sbPurpleW">
   <input type="radio" name="search" value="basic" /> Basic<br />
   <input type="radio" name="search" value="superInline" disabled="disabled" /> Super search (inline)<br />
   <input type="radio" name="search" value="superTab" disabled="disabled" /> Super search (tab)
   </div>
  
  </div>
  <div id="step3">
   
   <h2>Step 3: Footer</h2>
   <label for="search"></label>
   <input type="radio" name="footer" value="footerBasic" /> Basic<br />
   <input type="radio" name="footer" value="footerW" /> With "W"<br />
   <input type="radio" name="footer" value="footerGoldPatch" /> With gold patch<br />
   <input type="radio" name="footer" value="footerPurplePatch" /> With purple patch<br />
   <input type="radio" name="footer" value="noFooter" /> I'll pass on the footer, thanks anyway!!!
  
  </div>
  <div id="step4"></form></div>
 </div>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("");
pageTracker._trackPageview();
</script>

</body>
</html>