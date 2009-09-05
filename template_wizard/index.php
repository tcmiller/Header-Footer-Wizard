<?php

include_once('include/global.inc.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Template Generator 1.0</title>
<link rel="stylesheet" type="text/css" href="include/tmplgen.css" /> 
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/validate/jquery.validate.js"></script>
<!--<script type="text/javascript" src="include/additional-methods.js"></script>-->
<script type="text/javascript" src="tmplgen.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	
	$("#tmplgenForm").validate({	
		errorPlacement: function(error, element) {
			error.appendTo( element.parent("p").next("div") );	
		},
		debug:true
		
	})
});

</script>

<!--<script type="text/javascript">
$(document).ready(function() {
   $('#strip').click(function(){
     $('#step2_sub').show();
   });
   $('#sink').click(function(){
     $('#step2_sub').hide();
   });
});
</script>-->



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
  <div id="bodyPanel">
  <h1>Template Generator 1.0</h1>
  <div id="stepsCol">
   <div id="step1">
    <h2>Step 1: <?php echo USER_INFO; ?></h2>
    <form name="tmplgenForm" id="tmplgenForm" method="post" action="generate.php">
     <fieldset>
     <legend></legend>
     <input type="hidden" name="requester" value="<?php echo $_SERVER['REMOTE_USER']; ?>" />
     <div>
      <label for="netid">Dept. net ID:</label>
      <p><input type="text" name="owner" maxlength="40" class="required email" /></p>
      <div></div>
     </div>
     <div>
      <label for="email">Contact email:</label>
      <p><input type="text" name="email" maxlength="40" class="required email" /></p>
      <div></div>
     </div>
     <div>
      <label for="url">Site URL:</label>
      <p><input type="text" name="site_url" maxlength="150" size="30" class="required url" /></p>
      <div></div>
     </div>
   </div>
   <div id="step2">
    
    <h2>Step 2: <?php echo THIN_STRIP; ?> or <?php echo KITCHEN_SINK; ?>?</h2>
    <div>
     <label for="sinkOrStrip"></label>
     <input type="radio" name="kitchen_sink" value="0" id="strip" checked="checked" /> <?php echo THIN_STRIP; ?><br />
     <div style="position: absolute;"><input type="radio" name="kitchen_sink" value="1" id="sink" disabled="disabled" /> <?php echo KITCHEN_SINK ?> <img src="images/kitchen_sink.jpg" width="170" height="32" alt="Kitchen sink sample graphic" style="position: absolute; left: 96px; top: 4px;" /></div>
    </div>
   </div>
   <div id="step2_sub">   
    
    <h3>Step 2a: Gold or purple background?</h3>
    <div>
     <label for="purpleOrGold"></label>
     <input type="radio" name="color" value="purple" /> Purple<br />
     <input type="radio" name="color" value="gold" /> Gold
    </div>
    <div class="dash"></div>
   
    <h3>Step 2b: W or no W?</h3>
    <div>
     <label for="wOrNot"></label>
     <input type="radio" name="blockw" value="1" /> W<br />
     <input type="radio" name="blockw" value="0" /> No W
    </div>
    <div class="dash"></div>
      
    <h3>Step 2c: Search</h3>
    <div>
     <label for="search"></label>
     <input type="radio" name="search" value="basic" /> Basic<br />
     <input type="radio" name="search" value="super-inline" disabled="disabled" /> Super search (inline)<br />
     <input type="radio" name="search" value="super-tab" disabled="disabled" /> Super search (tab)
    </div>
  
   </div>
   <div id="step3">
   
    <h2>Step 3: Footer</h2>
    <div>
     <label for="search"></label>
     <input type="radio" name="footer" value="basic" /> Basic<br />
     <input type="radio" name="footer" value="w" /> With "W"<br />
     <input type="radio" name="footer" value="goldPatch" /> With gold patch<br />
     <input type="radio" name="footer" value="purplePatch" /> With purple patch<br />
     <input type="radio" name="footer" value="no" /> I'll pass on the footer, thanks anyway!!!
    </div>
   
   </div>
   <div id="step4">
   
    <h2>Step4: Generate code</h2>
   
    <?php
    
    /** @todo - add tooltips that provide a little more explanation about the various code output options **/
    
    ?>
    
    <div>
     <label for="code_pref">How would you like your code?</label><br />
     <input type="radio" name="code_pref" value="copy-paste" /> <a href="">Copy &amp; Paste</a>&nbsp;&nbsp;
     <input type="radio" name="code_pref" value="include" /> <a href="">Include</a>&nbsp;&nbsp;
     <input type="radio" name="code_pref" value="both" /> <a href="">Both</a>
    </div>
    
    <div>
     <input type="submit" name="generate" value="Generate my code" /></fieldset></form>
    </div>
   </div>
  </div>
  <div id="prevCodeCol">Preview and generated code goes in this column.</div>
  </div>
  <div class="clear">&nbsp;</div>
 </div>
 <div id="footer"><div class="footerText"><strong><a href="http://www.washington.edu/home/siteinfo/" class="whitetext">FAQ</a>&nbsp;   |&nbsp;<a href="http://www.washington.edu/jobs/" class="whitetext">Employment</a>&nbsp;   |&nbsp; <a href="http://myuw.washington.edu/" class="whitetext">MyUW</a>&nbsp;   |&nbsp; <a href="http://www.washington.edu/uwin/" class="whitetext">UWIN</a>&nbsp;   |&nbsp; </strong><strong class="whitetext"><a href="http://www.washington.edu/home/siteinfo/form/" class="whitetext"><strong>Contact Us</strong></a></strong><br />  Copyright &copy; <?php echo date('Y'); ?> University of Washington</div></div>
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