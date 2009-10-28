<?php

include_once('include/functions.inc.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Header &amp; Footer Wizard</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />    
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/easySliderUW.js" type="text/javascript"></script>
	<script src="js/jquery.colorbox.js" type="text/javascript"></script>
	<script src="js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="js/tmplgen.js" type="text/javascript"></script>
	<script src="js/screenshot.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider();
			$(".feedbackCall").colorbox({width:"20%", inline:true, href:"#feedback", title:false});
			$(".faqCall").colorbox({width:"50%", inline:true, href:"#faq"});
			$("#cpHelpCall").colorbox({width:"50%", inline:true, href:"#cpHelp"});
			$("#incHelpCall").colorbox({width:"50%", inline:true, href:"#incHelp"});
			
			<?php
			
			createAndSetAppDefaults();
								
			?>
			
		});
		
	// clear out the global search input text field
    function make_blank() {document.uwglobalsearch.q.value = "";}
			
	</script>
	<link rel="stylesheet" href="css/colorbox.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/header.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/tmplgen.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/footer.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/footer_no_patch.css" type="text/css" media="screen" />
	
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
	margin-bottom:2em;
	padding: 20px;
	background-image: url(images/bg.png);
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
		width:132px;
		height:64px;
		position:absolute;
		left:-120px;
		top:100px;
		}	
	#nextBtn{ 
		left:680px;
		}														
	#prevBtn a, #nextBtn a{  
		display:block;
		width:132px;
		height:64px;
		background:url(images/btn_prev.png) no-repeat 0 0;	
		}	
	#nextBtn a{ 
		background:url(images/btn_next.png) no-repeat 0 0;	
		}												
	#fdBkTtleBlk {
		position: relative;
	    display: block;
	    width: 700px;
	    height: 38px;
	    margin: 40px auto 10px;	
	}
	.title {
		position: relative;
        background:url(images/text.gif) no-repeat 0 0;
		text-indent: -9999px;
		overflow: hidden;
		display: block;
		height: 38px;
		width: 650px;
		margin: 0 auto;
	}
	
/* // Easy Slider */

/*  */

#screenshot{
	position:absolute;
	border:1px solid #ccc;
	background:#fff;
	padding:5px;
	display:none;
	color:#fff;
	}

/*  */


</style>	
	
</head>
<body>

<div id="fdBkTtleBlk"><span class="fdBkLnk"><a class="feedbackCall" href="#">Got feedback?</a><span>&nbsp;&nbsp;|&nbsp;&nbsp;</span><a class="faqCall" href="#">FAQ</a></span>
	<span class="title">Header &amp; Footer Wizard</span>
</div>
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
				       <input type="text" name="email" id="email" size="20" maxlength="40" class="req" />
				      </div>
				      <div>
				       <label for="site_url">Site URL:</label>
				       <input type="text" name="site_url" id="site_url" size="35" maxlength="150" class="req" />
				      </div>
				     
				     </fieldset>
               </li>
              <li>
                 
                 <fieldset>
				    <legend>Step 2: Header</legend>
				    
				   <div id="step2_main"> 
					 
				   	 <label for="strip"><input type="radio" name="selection" value="strip" id="strip" onclick="javascript:pageTracker._trackPageview('/hdr-thin-strip');" /> Thin strip</label><br />
					 <label for="no-hdr"><input type="radio" name="selection" value="no-hdr" id="no-hdr" onclick="javascript:pageTracker._trackPageview('/hdr-no-header');" /> No header for me</label><br />
				   	 <label for="sink"><input type="radio" name="selection" value="sink" id="sink" onclick="javascript:pageTracker._trackPageview('/hdr-kitchen-sink');" /> <a href="" class="screenshot unavailable" rel="images/kitchen_sink.jpg">Kitchen sink</a></label>
				   
				   </div>
					 
				   <div id="step2_sub">
				   
				   <fieldset id="options">
				   <legend>Options:</legend>
				
				     <div id="colorSrchBlk">
				      <div>
				       <label for="color">Gold or purple background?</label>
				       <input type="radio" name="color" value="purple" id="purple_bg" onclick="javascript:pageTracker._trackPageview('/hdr-gold-bg');" /> Purple<br />
				       <input type="radio" name="color" value="gold" id="gold_bg" onclick="javascript:pageTracker._trackPageview('/hdr-purple-bg');" /> Gold
				      </div>
					  <br />				      
				      <div>			    
				       <label for="search">Search</label>
				       <input type="radio" name="search" value="basic" id="s_basic" onclick="javascript:pageTracker._trackPageview('/hdr-srch-basic');" /> Basic<br />
				       <input type="radio" name="search" value="no" id="s_no" onclick="javascript:pageTracker._trackPageview('/hdr-srch-no');" /> No search<br />
				       <input type="radio" name="search" value="super-inline" id="ss_inline" onclick="javascript:pageTracker._trackPageview('/hdr-srch-ss-inline');" /> <a href="" class="screenshot unavailable" rel="images/thin_strip_super_search_inline.jpg">Super (inline)</a><br />
				       <input type="radio" name="search" value="super-tab" id="ss_tab" onclick="javascript:pageTracker._trackPageview('/hdr-srch-ss-tab');" /> <a href="" class="screenshot unavailable" rel="images/thin_strip_super_search_tab.jpg">Super (tab)</a>
				      </div>
				     </div>
				    
				    <div id="patchBlockwBlk">
				     <div>
				      <label for="patch">Patch or no patch?</label>
				      <input type="radio" name="patch" value="1" id="patch" onclick="javascript:pageTracker._trackPageview('/hdr-patch-yes');" /> Patch<br />
				      <input type="radio" name="patch" value="0" id="no_patch" onclick="javascript:pageTracker._trackPageview('/hdr-patch-no');" /> No patch
				     </div>
				     <br />			     
				     <div id="blockwBlk">
				      <label for="blockw">W or no W?</label>
				      <input type="radio" name="blockw" value="1" id="w_yes" onclick="javascript:pageTracker._trackPageview('/hdr-blockw-yes');" /> W<br />
				      <input type="radio" name="blockw" value="0" id="w_no" onclick="javascript:pageTracker._trackPageview('/hdr-blockw-no');" /> No W
				     </div>
				    </div>
				   
				   </fieldset> 
				   </div>		   
				    
				   </fieldset>
                 
              </li>
              <li id="step3">
                 <fieldset>
			    <legend>Step 3: Footer</legend>
			    
			     <label for="ftr_basic"><input type="radio" name="footer" value="basic" id="ftr_basic" onclick="javascript:pageTracker._trackPageview('/ftr-basic');" /> Basic</label>
			     <label for="ftr_w"><input type="radio" name="footer" value="w" id="ftr_w" onclick="javascript:pageTracker._trackPageview('/ftr-with-w');" /> With "W"</label>
			     <label for="ftr_gold_patch"><input type="radio" name="footer" value="goldPatch" id="ftr_gold_patch" onclick="javascript:pageTracker._trackPageview('/ftr-gold-patch');" /> With gold patch</label>
			     <label for="ftr_purple_patch"><input type="radio" name="footer" value="purplePatch" id="ftr_purple_patch" onclick="javascript:pageTracker._trackPageview('/ftr-purple-patch');" /> With purple patch</label>
			     <label for="ftr_no"><input type="radio" name="footer" value="no" id="ftr_no" onclick="javascript:pageTracker._trackPageview('/ftr-no');" /> No thanks, I'll pass on the footer</label>
			   
			   </fieldset>
              </li>
              <li id="step4">
                 <fieldset>
			     <legend>Step 4: Code Preference</legend>
			     
			      <label for="copy-paste"><input type="radio" name="code_pref" value="copy-paste" id="copy-paste" onclick="javascript:pageTracker._trackPageview('/copy-paste');" /> <a href="#" id="cpHelpCall">Copy &amp; Paste</a></label>
			      <label for="include"><input type="radio" name="code_pref" value="include" id="include" onclick="javascript:pageTracker._trackPageview('/include');" /> <a href="#" id="incHelpCall">Include</a></label>
			      <label for="both"><input type="radio" name="code_pref" value="both" id="both" onclick="javascript:pageTracker._trackPageview('/both');" /> Both</label>
			     
			    </fieldset>
			    
			     <input type="submit" name="generate" id="generate" value="Generate my code" class="button" onclick="javascript:pageTracker._trackPageview('/wizard-complete');" />
			     </form>
			    
              </li>
            </ul>
		
		</div>

	</div>

</div>

<div id="prevBlk">

	<div id="hdr-preview"><?php loadHdrPrvw(); ?></div>
	
	<div id="bodyTxt">Insert website here :)</div>
	
	<div id="outputBlk"></div>
	
	<div id="ftr-preview"><?php loadFtrPrvw(); ?></div>

</div>

<!-- This contains the hidden content for inline calls -->
<div id="hidden">
	<div id="feedback">
        <h2>Suggestions, questions, gripes?  Speak up!</h2>        
        <form id="feedbackForm" action="/uweb/tmplgen/" method="post"> 
            <label for="email"><span class="feedback">Your Email:</span></label> <input class="feedback-in" type="text" id="email" name="email" />
            <br />
            <br />
            <label for="comment"><span class="feedback">Comments:</span></label> <textarea class="feedback-in" id="comment" name="comment"></textarea>
            <br />
            <br /> 
            <input id="feedbackSubmit" type="submit" value="Talk to us &raquo;" /> 
        </form>	   
    </div>
    <div id="faq">
        <h3>FAQ</h3>
    	<ul>
         <li><h4>Copy &amp; Paste or Include?  What's best for me?</h4>
                 Well, this depends on your site's server environment, your visual/editorial needs and your technical background.  Detailed responses to these considerations will be listed below, but here is a general response: If you feel comfortable with HTML and CSS, and your site doesn't use the .shtml file extension or chtml includes, then Copy &amp; Paste is best for you.  However, if your site already uses the .shtml file extension, then the Include option would work quite well.  For the more technically minded, there is a way to bring in the dynamic Include option without the .shtml file extension or chtml include (using CURL).</li>
         <li><h4>My site is on bank... what are my options?</h4>
                 Copy &amp; Paste: Just copy and paste from the code output boxes at the end of the wizard, placing the code bits into their appropriate places.
                 <p>Include: If your site already uses the .shtml file extension, then copy and paste the include code at the end of the wizard into the appropriate spot.  If your site uses chtml includes, we currently only offer two header options and one footer option.</p>
                 <p>Detailed installation instructions can be found on the wizard's final step.</p></li>
         <li><h4>My site is on depts... what are my options?</h4>
                 Copy &amp; Paste: Just copy and paste from the code output boxes at the end of the wizard, placing code bits into their appropriate places.
                 <p>Include: If your site already uses the .shtml file extension, then copy and paste the include code at the end of the wizard into the appropriate spot.</p>
                 <p>Detailed installation instructions can be found on the wizard's final step.</p></li>
         <li><h4>What if you make updates?</h4>
                 We plan on notifying all users before making any updates, on both the Copy &amp; Paste version as well as the Include version.  This is especially important for the Include version since it will dynamically update without you needing to touch anything.  Since you are providing a contact email, we can easily notify you of changes.</li>
         <li><h4>I have other questions, who do I contact?</h4>
                 Please use our <a href="#" class="feedbackCall">feedback form</a> to communicate with us.</li>
        </ul>
    </div>
    <div id="cpHelp">
    	<h3>Copy &amp; Paste Help</h3>
        <ul>
    	 <li><h4>How "safe" is the CSS, Javascript and HTML?</h4>
    	         We've done our best to "bulletproof" the code and prevent any CSS collisions, but if you find any strange behavior, please <a href="#" class="feedbackCall">let us know.</a>  Since you are choosing the Copy &amp; Paste version, you could certainly modify the code to make it work.</li>
    	 <li><h4>What if you make updates?  How will we hear about them?</h4>
    	         Since we are collecting a contact email, we can easily notify you of changes (editorial, visual, etc.).</li>
    	</ul>
    </div>
    <div id="incHelp">
    	<h3>Include Help</h3>
    	<ul>
    	 <li><h4>What in the world is a Server Side Include?</h4>
    	         UW Technology has a <a href="http://www.washington.edu/itconnect/web/publishing/ssi.html" target="_blank">great article on SSIs</a>.  The primary thing to consider is the file extension: .shtml.  If you aren't already using this file extension throughout your site, you may want to consider the Copy &amp; Paste option or use CURL with server side scripting.</li>
    	 <li><h4>Header and/or footer include on bank... is this possible?</h4>
    	         We're currently working through some technical hurdles, but SSIs are possible on bank.  You'll still need to use the <strong>.shtml</strong> file extension (see the UW Technology article above).</li>
    	 <li><h4>Is there a chtml include?</h4>
    	         Short answer: Yes!  Long answer: Well, almost.  Right now, we are making available, as chtml includes, two basic header options and one footer option.  If demand drives the need for more customizable, "wizardish" chtml include options, we will roll out additional permutations.</li>
    	 <li><h4>The Include version breaks my site... what's the deal?</h4>
    	         While we have diligently tried to code the header and footer to function as independently as possible from your site, CSS conflicts may still occur.  Please report any issues you experience and we will update the code on our side as quickly as possible.</li>
    	</ul>
    </div>
    <div id="cpInstall">
    	<h3>How to install the Copy &amp; Paste version</h3>
    	<ol>
		 <li>Place the CSS + Javascript code between your HTML document's &lt;head&gt;&lt;/head&gt; tags</li>
		 <li>Copy and paste the Header HTML directly below your document's opening &lt;body&gt; tag</li>
		 <li>Copy and paste the Footer HTML directly above your document's closing &lt;/body&gt; tag</li>
		</ol>
    </div>
    <div id="incInstall">
    	<h3>How to install the Include version</h3>
    	<ul>
    	 <li><h4>On depts:</h4>
    	  <p>Note: If you are not familiar with Server Side Includes (SSI), please <a href="http://www.washington.edu/itconnect/web/publishing/ssi.html" target="_blank">read this first</a>.  If you'd like to use the includes without the <strong>.shtml</strong> file extension, then you'll most likely need to use CURL (in whichever server side scripting language suits you best) to pull in the HTML.</p>
    	  <ol>
    	   <li>For both the header and footer, you will need the CSS + Javascript include</li>
    	   <li>Select and copy the CSS+JS include code from the "On depts:" field.</li>
    	   <li>Paste this line of code between your HTML document's $lt;head&gt;&lt;/head&gt; tags</li>
    	   <li>If you are installing a header, select and copy the header include code from the "On depts:" field.</li>
    	   <li>Then, paste this header include code directly below your document's opening &lt;body&gt; tag</li>
    	   <li>If you are also installing a footer, select and copy the footer include code from the "On depts:" field.</li>
    	   <li>Then, paste this footer include code directly above your document's closing &lt;/body&gt; tag</li>
    	  </ol>
    	 </li>
    	 <li><h4>On bank:</h4>
    	  <ol>
    	   <li></li>
    	   <li></li>
    	   <li></li>
    	  </ol>
    	 </li>
    	</ul>
    </div>
</div>


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("");
pageTracker._trackPageview();
} catch(err) {}</script>

<!-- UA-11194387-1 -->

</body>
</html>
