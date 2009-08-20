<html>
<head>
<title>Template Generator 1.0</title>
<link rel="stylesheet" type="text/css" href="include/tempgen.css" /> 
<script type="text/javascript" src="tempgen.js"></script>
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
   <h2>Step 1: User information</h2>
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
   <h2>Step 2: Kitchen sink or thin strip?</h2>
   <label for="sinkOrStrip"></label>
   <input type="radio" name="sinkOrStrip" value="strip" /> <img src="images/thin_strip.jpg" width="300" height="8" alt="Thin strip sample" /><br />
   <input type="radio" name="sinkOrStrip" value="sink" disabled="disabled" /> <img src="images/kitchen_sink.jpg" width="300" height="56" alt="Kitchen sink sample" />
  </div>
  <div class="clear"></div>
  <div id="step2_sub">
   
   <h2>Step 2a: Gold or purple background?</h2>
   <label for="goldOrPurple"></label>
   <input type="radio" name="goldOrPurple" value="purple" /> <img src="images/thin_strip_purple_base.jpg" width="300" height="8" alt="Purple base sample" /><br />
   <input type="radio" name="goldOrPurple" value="gold" /> <img src="images/thin_strip_gold_base.jpg" width="300" height="8" alt="Gold base sample" />
   <div class="dash"></div>
   
   
   <h2>Step 2b: W or no W?</h2>
   <label for="wOrNot"></label>
   <input type="radio" name="wOrNot" value="purpleW" /> <img src="images/thin_strip_purple_base.jpg" width="300" height="8" alt="Purple with W sample" /><br />
   <input type="radio" name="wOrNot" value="purpleNoW" /> <img src="images/thin_strip_purple_base.jpg" width="300" height="8" alt="Purple without W sample" /><br />
   
   <input type="radio" name="wOrNot" value="goldW" /> <img src="images/thin_strip_purple_base.jpg" width="300" height="8" alt="Purple with W sample" /><br />
   <input type="radio" name="wOrNot" value="goldNoW" /> <img src="images/thin_strip_purple_base.jpg" width="300" height="8" alt="Purple without W sample" />
   <div class="dash"></div>
   
   
   <h2>Step 2c: Search?</h2>
   <label for="search"></label>
   <div id="sbPurpleW">
   <input type="radio" name="search" value="purpleWBasicSearch" /> <img src="images/thin_strip_purple_search.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="purpleWSuperSearchNoTab" disabled="disabled" /> <img src="images/thin_strip_purple_super_search_inline.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="purpleWSuperSearch" disabled="disabled" /> <img src="images/thin_strip_purple_super_search.jpg" width="300" height="23" alt="" />
   </div>
   
   <div id="sbGoldW">
   <input type="radio" name="search" value="goldWBasicSearch" /> <img src="images/thin_strip_purple_search.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="goldWSuperSearchNoTab" disabled="disabled" /> <img src="images/thin_strip_purple_super_search_inline.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="goldWSuperSearch" disabled="disabled" /> <img src="images/thin_strip_purple_super_search.jpg" width="300" height="23" alt="" />
   </div>
   
   <div id="sbPurpleNoW">
   <input type="radio" name="search" value="purpleNoWBasicSearch" /> <img src="images/thin_strip_purple_search.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="purpleNoWSuperSearchNoTab" disabled="disabled" /> <img src="images/thin_strip_purple_super_search_inline.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="purpleNoWSuperSearch" disabled="disabled" /> <img src="images/thin_strip_purple_super_search.jpg" width="300" height="23" alt="" />
   </div>
   
   <div id="sbGoldNoW">
   <input type="radio" name="search" value="goldNoWBasicSearch" /> <img src="images/thin_strip_purple_search.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="goldNoWSuperSearchNoTab" disabled="disabled" /> <img src="images/thin_strip_purple_super_search_inline.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="search" value="goldNoWSuperSearch" disabled="disabled" /> <img src="images/thin_strip_purple_super_search.jpg" width="300" height="23" alt="" />
   </div>
  
  </div>
  <div id="step3">
   
   <input type="radio" name="footer" value="footerBasic" /> <img src="images/footer_base.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="footer" value="footerW" /> <img src="images/footer_base.jpg" width="300" height="8" alt="" /><br />
   <input type="radio" name="footer" value="footerGoldPatch" /> <img src="images/footer_w_purple.jpg" width="300" height="27" alt="" /><br />
   <input type="radio" name="footer" value="footerPurplePatch" /> <img src="images/footer_w_gold.jpg" width="300" height="27" alt="" /><br />
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