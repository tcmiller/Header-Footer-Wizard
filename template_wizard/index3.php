<?php

include_once('include/global.inc.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    
    <title>Template Generator 1.0</title>
    
    <link rel="stylesheet" href="css/page.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/tmplgen.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="http://staff.washington.edu/kilianf/headfoot/header/css/header.css" type="text/css" media="screen" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.easing.1.2.js"></script>
	<script src="js/jquery.anythingslider.js" type="text/javascript" charset="utf-8"></script>
	

    <script type="text/javascript">
    
        function formatText(index, panel) {
		  return index + "";
	    }
    
    </script>
    
    <script src="js/tmplgen.js" type="text/javascript"></script>
    
</head>

<body>

<div class="wheader patchYes colorGold">	
  <span id="autoMargin">
  
    <div class="wlogoSmall">
            <div class="logoAbsolute"><a id="wlogoLink" href="http://www.washington.edu/">W</a></div>

      <div><a href="http://www.washington.edu/">University of Washington</a></div>
    </div>
    
	<div id="wsearch">        
      <form name=form1 id="searchbox_001967960132951597331:04hcho0_drk" action="http://www.google.com/cse">
			 <div class="wfield">
                <input type="hidden" name="cx" value="001967960132951597331:04hcho0_drk" />
				<input type="hidden" name="cof" value="FORID:0" />
		       <input name="q" type="text" value="Search the UW" class="wTextInput" onClick="make_blank();"/>			   
             </div>   
	  			<input type="submit" class="formbutton" name="sa" value="Go" />

      </form>
    </div>
    
	<div id="wtext">
   	  <ul>
      		<li><a href="http://www.washington.edu/">UW Home</a></li>
        	<li><span class="border"><a href="http://www.washington.edu/home/directories.html">Directories</a></span></li>
       	  	<li><span class="border"><a href="http://www.washington.edu/visit/events.html">Calendar</a></span></li>

       	  	<li><span class="border"><a href="http://www.washington.edu/maps/">Maps</a></span></li>
       	  	<li><span class="border"><a href="http://myuw.washington.edu/">My UW</a></span></li>
      </ul>
    </div>
    
  </span>
</div>

    <div id="page-wrap">
    
        <h1>Template Generator</h1>
    
        <div class="anythingSlider">
        
          <div class="wrapper">
            <ul>
               <li id="step1">
                    <form name="tmplgenForm" id="tmplgenForm" action="" method="post">
				     <fieldset>
				     <legend>Step 1: User Info</legend>
				     <input type="hidden" name="requester" id="requester" value="<?php echo $_SERVER['REMOTE_USER']; ?>" />
				     
				      <div>
				       <label for="owner">Dept. net ID:</label>  <input type="text" name="owner" id="owner" maxlength="40" class="required" />
				      </div>
				      <div>
				       <label for="email">Contact email:</label> <input type="text" name="email" id="email" maxlength="40" class="email" />
				      </div>
				      <div>
				       <label for="site_url">Site URL:</label> <input type="text" name="site_url" id="site_url" maxlength="150" size="30" class="required" />
				      </div>
				     
				     </fieldset>
               </li>
              <li>
                 
                 <fieldset>
				    <legend>Step 2: Thin Strip or Kitchen Sink?</legend>
				    
					 <label for="strip"><input type="radio" name="kitchen_sink" value="0" id="strip" /> Thin strip</label><br />
					 <label for="sink"><input type="radio" name="kitchen_sink" value="1" id="sink" /> Kitchen sink</label>
				   
				   <div id="step2_sub">   
				
				     <div>
				      <label for="color">Gold or purple background?</label>
				      <input type="radio" name="color" value="purple" id="purple_bg" /> Purple<br />
				      <input type="radio" name="color" value="gold" id="gold_bg" /> Gold
				     </div>
				    
				     <div>
				      <label for="patch">Patch or no patch?</label>
				      <input type="radio" name="patch" value="1" id="patch" /> Patch<br />
				      <input type="radio" name="patch" value="0" id="no_patch" /> No patch
				     </div>
				      
				     <div id="blockw">
				      <label for="blockw">W or no W?</label>
				      <input type="radio" name="blockw" value="1" id="w_yes" /> W<br />
				      <input type="radio" name="blockw" value="0" id="w_no" /> No W
				     </div>
				     
				     <div>			    
				      <label for="search">Search</label>
				      <input type="radio" name="search" value="basic" id="s_basic" /> Basic<br />
				      <input type="radio" name="search" value="no" id="s_no" /> No search<br />
				      <input type="radio" name="search" value="super-inline" id="ss_inline" /> <span class="unavailable">Super (inline)</span><br />
				      <input type="radio" name="search" value="super-tab" id="ss_tab" /> <span class="unavailable">Super (tab)</span>
				     </div>
				    
				   </div>
				    
				   </fieldset>
                 
              </li>
              <li id="step3">
                 <fieldset>
			    <legend>Step 3: Footer</legend>
			    
			     <label for="ftr_basic"><input type="radio" name="footer" value="basic" id="ftr_basic" /> Basic</label>
			     <label for="ftr_w"><input type="radio" name="footer" value="w" id="ftr_w" /> With "W"</label>
			     <label for="ftr_gold_patch"><input type="radio" name="footer" value="goldPatch" id="ftr_gold_patch" /> With gold patch</label>
			     <label for="ftr_purple_patch"><input type="radio" name="footer" value="purplePatch" id="ftr_purple_patch" /> With purple patch</label>
			     <label for="ftr_no"><input type="radio" name="footer" value="no" id="ftr_no" /> I'll pass on the footer, thanks anyway!!!</label>
			   
			   </fieldset>
              </li>
              <li id="step4">
                 <fieldset>
			     <legend>Step 4: Code Preference</legend>
			     
			      <label for="cde-prf-cp"><input type="radio" name="code_pref" value="copy-paste" id="cde-prf-cp" /> <a href="">Copy &amp; Paste</a></label>
			      <label for="cde-prf-inc"><input type="radio" name="code_pref" value="include" id="cde-prf-inc" /> <a href="">Include</a></label>
			      <label for="cde-prf-bth"><input type="radio" name="code_pref" value="both" id="cde-prf-bth" /> <a href="">Both</a></label>
			     
			    </fieldset>
			    <div>
			     <input type="submit" name="generate" id="generate" value="Generate my code" class="button" />
			     </form>
			    </div>
              </li>
            </ul>        
          </div>
          
        </div> <!-- END AnythingSlider -->
    
    </div>
    
    <div id="preview"></div>
    <br />
    <br />
    <br />
	<br />
	<div id="results"></div>
        
</body>

</html>