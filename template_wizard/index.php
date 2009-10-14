<?php

include_once('include/global.inc.php');
include_once('include/functions.inc.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Easy Slider jQuery Plugin Demo</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/easySlider1.5.js"></script>
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.5.5/jquery.validate.min.js"></script>
	<script src="js/tmplgen.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider();
			
			<?php
			
			// create the account if it doesn't already exist
			createAccount();
			
			// set some account defaults
			setAccountDefaults();
			
			// set some header defaults
			setHeaderDefaults();
			
			// set a footer default
			setFooterDefault();
			
			// set a code preference default
			//setCodePref();
								
			?>
			
		});	
	</script>
	<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/tmplgen.css" type="text/css" media="screen" />
	
<style type="text/css">
		
    /* image replacement */
        .graphic, #prevBtn, #nextBtn{
            margin:0;
            padding:0;
            display:block;
            overflow:hidden;
            text-indent:-8000px;
            }
    /* // image replacement */
			

	#container{	
		margin:0 auto;
		position:relative;
		text-align:left;
		width:696px;
		background:#fff;		
		margin-bottom:2em;
		}	
	#header{
		height:80px;
		background:#5DC9E1;
		color:#fff;
		}				
	#content{
		position:relative;
		}			

/* Easy Slider */

	#slider{}	
	#slider ul, #slider li{
		margin:0;
		padding:0;
		list-style:none;
		}
	#slider li{ 
		/* 
			define width and height of list item (slide)
			entire slider area will adjust according to the parameters provided here
		*/ 
		width:696px;
		height:270px;
		overflow:hidden; 
		}	
	#prevBtn, #nextBtn{ 
		display:block;
		width:30px;
		height:77px;
		position:absolute;
		left:-30px;
		top:71px;
		}	
	#nextBtn{ 
		left:696px;
		}														
	#prevBtn a, #nextBtn a{  
		display:block;
		width:30px;
		height:77px;
		background:url(images/btn_prev.gif) no-repeat 0 0;	
		}	
	#nextBtn a{ 
		background:url(images/btn_next.gif) no-repeat 0 0;	
		}												

/* // Easy Slider */

</style>	
	
</head>
<body>

<!--<div class="wheader patchYes colorGold wNo">	
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
			    <input name="q" id="q" type="text" value="Search the UW" class="wTextInput" />			   
             </div>   
	  			<input type="submit" class="formbutton" name="sa" value="Go" />
          </form>
    </div>
    
	<div id="wtext">
    	<ul>
      		<li><a href="#">UW Home</a></li>
        	<li><span class="border"><a href="#">Directories</a></span></li>
       	  	<li><span class="border"><a href="#">Calendar</a></span></li>
       	  	<li><span class="border"><a href="#">Maps</a></span></li>
       	  	<li><span class="border"><a href="#">My UW</a></span></li>
       </ul>
    </div>
    
  </span>
</div>-->

<div id="container">

	<div id="content">
	
		<div id="slider">
			
			<ul>
               <li id="step1">
                    <form name="tmplgenForm" id="tmplgenForm" action="" method="post">
				     <fieldset>
				     <legend>Step 1: User Info</legend>
				     <input type="hidden" name="owner" id="owner" value="<?php echo $_SERVER['REMOTE_USER']; ?>" />
				      <div>
				       <label for="email">Contact email:</label>
				       <input type="text" name="email" id="email" maxlength="40" />
				      </div>
				      <div>
				       <label for="site_url">Site URL:</label>
				       <input type="text" name="site_url" id="site_url" maxlength="150" />
				      </div>
				     
				     </fieldset>
               </li>
              <li>
                 
                 <fieldset>
				    <legend>Step 2: Thin Strip or Kitchen Sink?</legend>
				   
				   <div id="step2_main"> 
					 
				   	 <label for="strip"><input type="radio" name="selection" value="strip" id="strip" /> Thin strip</label><br />
					 <label for="no-hdr"><input type="radio" name="selection" value="no-hdr" id="no-hdr" /> No header for me</label><br />
				   	 <label for="sink"><input type="radio" name="selection" value="sink" id="sink" /> <span class="unavailable">Kitchen sink</span></label>
				   
				   </div>
					 
				   <div id="step2_sub">
				   
				   <fieldset id="options">
				   <legend>Options:</legend>
				
				     <div id="colorSrchBlk">
				      <div>
				       <label for="color">Gold or purple background?</label>
				       <input type="radio" name="color" value="purple" id="purple_bg" /> Purple<br />
				       <input type="radio" name="color" value="gold" id="gold_bg" /> Gold
				      </div>
					  <br />				      
				      <div>			    
				       <label for="search">Search</label>
				       <input type="radio" name="search" value="basic" id="s_basic" /> Basic<br />
				       <input type="radio" name="search" value="no" id="s_no" /> No search<br />
				       <input type="radio" name="search" value="super-inline" id="ss_inline" /> <span class="unavailable">Super (inline)</span><br />
				       <input type="radio" name="search" value="super-tab" id="ss_tab" /> <span class="unavailable">Super (tab)</span>
				      </div>
				     </div>
				    
				    <div id="patchBlockwBlk">
				     <div>
				      <label for="patch">Patch or no patch?</label>
				      <input type="radio" name="patch" value="1" id="patch" /> Patch<br />
				      <input type="radio" name="patch" value="0" id="no_patch" /> No patch
				     </div>
				     <br />			     
				     <div id="blockwBlk">
				      <label for="blockw">W or no W?</label>
				      <input type="radio" name="blockw" value="1" id="w_yes" /> W<br />
				      <input type="radio" name="blockw" value="0" id="w_no" /> No W
				     </div>
				    </div>
				   
				   </fieldset> 
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
			     <label for="ftr_no"><input type="radio" name="footer" value="no" id="ftr_no" /> No thanks, I'll pass on the footer</label>
			   
			   </fieldset>
              </li>
              <li id="step4">
                 <fieldset>
			     <legend>Step 4: Code Preference</legend>
			     
			      <label for="copy-paste"><input type="radio" name="code_pref" value="copy-paste" id="copy-paste" /> <a href="">Copy &amp; Paste</a></label>
			      <label for="include"><input type="radio" name="code_pref" value="include" id="include" /> <a href="">Include</a></label>
			      <label for="both"><input type="radio" name="code_pref" value="both" id="both" /> <a href="">Both</a></label>
			     
			    </fieldset>
			    <div>
			     <input type="submit" name="generate" id="generate" value="Generate my code" class="button" />
			     </form>
			    </div>
              </li>
            </ul>
		
		</div>

	</div>

</div>

<div id="preview"></div>
<br />
<br />
<br />
<br />
<div id="results"></div>

</body>
</html>