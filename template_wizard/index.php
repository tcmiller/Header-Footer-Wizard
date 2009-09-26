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

<!--<script type="text/javascript">
$(document).ready(function() {
	
	$("#tmplgenForm").validate({	
		errorPlacement: function(error, element) {
			error.appendTo( element.parent("p").next("div") );	
		},
		debug:true
		
	})
});

</script>-->

<script type="text/javascript">
  
$(document).ready(function() {
   
	// Form defaults
	$('#sink').attr('disabled','disabled');
	$('#gold_bg').attr('checked','checked');
	$('#patch').attr('checked','checked');
	$('#w_no').attr('checked','checked');
	$('#s_basic').attr('checked','checked');
	$('#ss_inline').attr('disabled','disabled');
	$('#ss_tab').attr('disabled','disabled');
	
   // UI
   $('#strip').click(function(){
     $('#step2_sub').show();
   });
   $('#sink').click(function(){
     $('#step2_sub').hide();
   });
   $('#no_patch').click(function(){
     $('#blockw').show();
   });
   $('#patch').click(function(){
     $('#blockw').hide();
   });   
   $('#reset').click(function(){
   	 $('#step2_sub').hide();
   	 $(':input')
	 .not(':button, :submit, :reset, :hidden')
	 .val('')
	 .removeAttr('checked')
	 .removeAttr('selected');
   });
   
   // AJAX DB interface
   	// initialize our account
   	$(window).load(function () {
  		// run code
		$.post('generate.php',{ requester: $('#requester').val(),
                                processType: 'initA' },function(data) {
     	$('#results').text(data);
     },'html');
      return false;
   	});
   
    // update our account
    $('#owner,#email,#site_url').change(function() {
    	$.post('generate.php',{ requester: $('#requester').val(),
    	                        owner: $('#owner').val(),
    	                        email: $('#email').val(),
    	                        site_url: $('#site_url').val(),
    	                        processType: 'updtA' },function(data) {
    	$('#results').text(data);
    },'html');  
      	
    });    
    
    // initialize our header
    $('input[name=kitchen_sink]').click(function() {
    	$.post('generate.php',{ requester: $('#requester').val(),
    		                    kitchen_sink: $('input[name=kitchen_sink]:checked').val(),
    		                    color: $('input[name=color]:checked').val(),
    		                    blockw: $('input[name=blockw]:checked').val(),
    		                    patch: $('input[name=patch]:checked').val(),
    		                    search: $('input[name=search]:checked').val(),
    		                    wordmark: $('input[name=wordmark]:checked').val(),
    	                        processType: 'initH' },function(data) {
    	$('#results').text(data);
    },'html');

    });
    
    // update our header
    $("input[name='blockw'],input[name='patch'],input[name='color'],input[name='search']").click(function() {
    	$.post('generate.php',{ requester: $('#requester').val(),
    		                    blockw: $("input[name='blockw']:checked").val(),
    	                        patch: $("input[name='patch']:checked").val(),
    	                        color: $("input[name='color']:checked").val(),
    	                        search: $("input[name='search']:checked").val(),
    	                        processType: 'updtH'},function(data) {
    	$('#results').text(data);              	
  	},'html');
  	 
    });
    
    // initialize our footer
    $("input[name='footer']").click(function() {
    	$.post('generate.php',{ requester: $('#requester').val(),
    		                    footer: $("input[name='footer']:checked").val(),
    	                        processType: 'initF'},function(data) {
    	$('#results').text(data);              	
  	},'html');
  	 
    });
    
    // process our code preference selection
    $("input[name='code_pref']").click(function() {
    	$.post('generate.php',{ requester: $('#requester').val(),
    	                        owner: $('#owner').val(),
    	                        email: $('#email').val(),
    	                        site_url: $('#site_url').val(),
    		                    code_pref: $("input[name='code_pref']:checked").val(),
    	                        processType: 'updtA'},function(data) {
    	$('#results').text(data);              	
  	},'html');
  	 
    });   
    
    // finalize our account
    /*$('form#tmplgenForm').submit(function() {
    	$('#generate').attr('disabled','disabled');
    	$('#generate').attr('value','Generating.... code');
    	$.post('generate.php',{ requester: $('#requester').val(),
    	                        processType: 'fnlzA' },function(data) {
    	//$('#results').text(data);
    	//if ()
    },'html');
     return false;
    });*/
    
    $('form#tmplgenForm').submit(function() {
    	$('#generate').attr('value','Please wait............');
    	$('#generate').attr('disabled','disabled');
    	$.ajax({
		   type: "POST",
		   url: "generate.php",
		   timeout: 2000,
		   data: ({ requester : $('#requester').val(),
		            processType: 'fnlzA' }),
		   error: function() {
               $('#generate').attr('value','Failed to submit');
               $('#generate').removeAttr('disabled');},
		   success: function(msg) {
		     setTimeout(function() {
		     	$('#generate').attr('value',msg);
		     	$('#generate').removeAttr('disabled');
		     }, 750);
		   }
		 });
	 return false;
    }); 
      
    /*function showValues() {
      var str = $("form#tmplgenForm").serialize();
      $("#results").text(str);
    }*/
    /*function showValues() {
      var fields = $("form#tmplgenForm").serializeArray();
      $("#results").empty();
      jQuery.each(fields, function(i, field){
        $("#results").append(field.value + " ");
      });
    }

    $(":checkbox, :radio").click(showValues);
    $(":input").change(showValues);
    $("select").change(showValues);
    showValues();*/
  
   
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
  <div id="bodyPanel">
  <h1>Template Generator 1.0</h1>
  <div id="stepsCol">
   <div id="step1">
    <form name="tmplgenForm" id="tmplgenForm" action="">
     <fieldset>
     <legend>Step 1: User Info</legend>
     <input type="hidden" name="requester" id="requester" value="<?php echo $_SERVER['REMOTE_USER']; ?>" />
     <div>
      <label for="netid">Dept. net ID:</label>
      <p><input type="text" name="owner" id="owner" maxlength="40" class="required" /></p>
      <div></div>
     </div>
     <div>
      <label for="email">Contact email:</label>
      <p><input type="text" name="email" id="email" maxlength="40" class="required email" /></p>
      <div></div>
     </div>
     <div>
      <label for="url">Site URL:</label>
      <p><input type="text" name="site_url" id="site_url" maxlength="150" size="30" class="required url" /></p>
      <div></div>
     </div>
     </fieldset>
   </div>
   <div id="step2">
    <fieldset>
    <legend>Step 2: Thin Strip or Kitchen Sink?</legend>
    <div>
     <label for="kitchen_sink"></label>
     <input type="radio" name="kitchen_sink" value="0" id="strip" /> Thin strip<br />
     <div style="position: relative; margin-bottom: 12px;"><input type="radio" name="kitchen_sink" value="1" id="sink" /> <span class="unavailable">Kitchen sink</span><img src="images/kitchen_sink.jpg" width="170" height="32" alt="Kitchen sink sample graphic" style="position: absolute; left: 96px; top: 4px;" /></div>
    </div>
   
   <div id="step2_sub">   

    <div style="padding-top: 0;">
     <label for="color">Gold or purple background?</label>
     <input type="radio" name="color" value="purple" id="purple_bg" /> Purple<br />
     <input type="radio" name="color" value="gold" id="gold_bg" /> Gold
    </div>
    <div class="dash"></div>
   
    <div>
     <label for="patch">Patch or no patch?</label>
     <input type="radio" name="patch" value="1" id="patch" /> Patch<br />
     <input type="radio" name="patch" value="0" id="no_patch" /> No patch
    </div>
    <div class="dash"></div>
    
    <div id="blockw">
     <label for="blockw">W or no W?</label>
     <input type="radio" name="blockw" value="1" id="w_yes" /> W<br />
     <input type="radio" name="blockw" value="0" id="w_no" /> No W
    </div>
    <div class="dash"></div>

    <div>
     <label for="search">Search</label>
     <input type="radio" name="search" value="basic" id="s_basic" /> Basic<br />
     <input type="radio" name="search" value="no" id="s_no" /> No search<br />
     <input type="radio" name="search" value="super-inline" id="ss_inline" /> <span class="unavailable">Super (inline)</span><br />
     <input type="radio" name="search" value="super-tab" id="ss_tab" /> <span class="unavailable">Super (tab)</span>
    </div>
    
   </fieldset>
  
   </div>
   
   <div id="step3">
    <fieldset>
    <legend>Step 3: Footer</legend>
    <div>
     <label for="search"></label>
     <input type="radio" name="footer" value="basic" /> Basic<br />
     <input type="radio" name="footer" value="w" /> With "W"<br />
     <input type="radio" name="footer" value="goldPatch" /> With gold patch<br />
     <input type="radio" name="footer" value="purplePatch" /> With purple patch<br />
     <input type="radio" name="footer" value="no" /> I'll pass on the footer, thanks anyway!!!
    </div>
    </fieldset>   
   </div>
   <div id="step4">
    <fieldset>
    <legend>Step 4: Generate Code</legend>
   
    <?php
    
    /** @todo - add tooltips that provide a little more explanation about the various code output options **/
    
    ?>
    
    <div>
     <label for="code_pref">How would you like your code?</label><br />
     <input type="radio" name="code_pref" value="copy-paste" /> <a href="">Copy &amp; Paste</a>&nbsp;&nbsp;
     <input type="radio" name="code_pref" value="include" /> <a href="">Include</a>&nbsp;&nbsp;
     <input type="radio" name="code_pref" value="both" /> <a href="">Both</a>
    </div>
    </fieldset>
    <div>
     <input type="submit" name="generate" id="generate" value="Generate my code" class="button" />&nbsp;&nbsp;&nbsp;<input type="button" value="Start over" id="reset" /></form>
    </div>
   </div>
  </div>
  <div id="prevCodeCol">Preview and generated code goes in this column.
  
    <p><tt id="lresults"></tt></p>
  
  	<div id="loadSelections"></div>
  
  </div>
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