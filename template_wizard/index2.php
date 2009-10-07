<?php

include_once('include/global.inc.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
	
	<title>Template Generator</title>
	
	<link rel="stylesheet" type="text/css" href="css/tmplgen.css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="include/jquery.validate.css" />
	<link rel="stylesheet" type="text/css" href="http://staff.washington.edu/kilianf/headfoot/header/css/header.css" />

	<!--<script src="js/jquery-1.3.1.min.js" type="text/javascript" charset="utf-8"></script>-->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/slider.js" type="text/javascript" charset="utf-8"></script>
	
	<script type="text/javascript">
  
	$(document).ready(function() {
	   
		// Form validation           
	    $("#owner").validate({
	        expression: "if (VAL) return true; else return false;",
	        message: "Please enter the required field"
	    });
	    $("#email").validate({
	        expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
	        message: "Please enter a valid email"
	    });
	    $("#site_url").validate({
	        expression: "if (VAL) return true; else return false;",
	        message: "Please enter the required field"
	    });
	   
	    $("#headerSelect").validate({
	        expression: "if (isChecked(SelfID)) return true; else return false;",
	        message: "Please make a selection"
	    });
	    $("#footerSelect").validate({
	        expression: "if (isChecked(SelfID)) return true; else return false;",
	        message: "Please make a selection"
	    });
	    $("#codePrefSelect").validate({
	        expression: "if (isChecked(SelfID)) return true; else return false;",
	        message: "Please make a selection"
	    });
	               	
		
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
	   	 //$('#step2_sub').hide();
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
	    		                    owner: $('#owner').val(),
	    	                        kitchen_sink: $('input[name=kitchen_sink]:checked').val(),
	    		                    color: $('input[name=color]:checked').val(),
	    		                    blockw: $('input[name=blockw]:checked').val(),
	    		                    patch: $('input[name=patch]:checked').val(),
	    		                    search: $('input[name=search]:checked').val(),
	    		                    wordmark: $('input[name=wordmark]:checked').val(),
	    	                        processType: 'initH' },function(data) {
	    	$('#preview').html(data);
	    	$('#results').text(data);
	    	});
	    	
	    });
	    
	    // update our header
	    $("input[name='blockw'],input[name='patch'],input[name='color'],input[name='search']").click(function() {
	    	$.post('generate.php',{ requester: $('#requester').val(),
	    		                    owner: $('#owner').val(),
	    	                        blockw: $("input[name='blockw']:checked").val(),
	    	                        patch: $("input[name='patch']:checked").val(),
	    	                        color: $("input[name='color']:checked").val(),
	    	                        search: $("input[name='search']:checked").val(),
	    	                        processType: 'updtH'},function(data) {
	    	$('#preview').html(data);
	    	$('#results').text(data);              	
	  		});
	  	 
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
	   
	});
	</script>

</head>


<body>
    <div id="wrapper">
	
		<img src="images/movingboxes.png" alt="moving boxes" />
    
        <div id="slider">    

            <img class="scrollButtons left" src="images/leftarrow.png">

			<div style="overflow: hidden;" class="scroll">
	
				<div class="scrollContainer">
	
	                <div class="panel" id="panel_1">

						
							<div id="step1">
						   <form name="tmplgenForm" id="tmplgenForm" action="" method="post">
						     <fieldset>
						     <legend>Step 1: User Info</legend>
						     <input type="hidden" name="requester" id="requester" value="<?php echo $_SERVER['REMOTE_USER']; ?>" />
						     <div>
						      <label for="owner">Dept. net ID:</label>
						      <input type="text" name="owner" id="owner" maxlength="40" class="required" />
						     </div>
						     <div>
						      <label for="email">Contact email:</label>
						      <input type="text" name="email" id="email" maxlength="40" class="email" />
						     </div>
						     <div>
						      <label for="site_url">Site URL:</label>
						      <input type="text" name="site_url" id="site_url" maxlength="150" class="required" />
						     </div>
						     </fieldset>
						    </div>
						
					</div>

	                <div class="panel" id="panel_2">

						
							<div id="step2">
						  <fieldset>
						    <legend>Step 2: Thin Strip or Kitchen Sink?</legend>
						    <span id="headerSelect" class="InputGroup">
							 <label for="strip">
							  <input type="radio" name="kitchen_sink" value="0" id="strip" /> Thin strip
							 </label>
							 <br />
							 <label for="sink">
							  <input type="radio" name="kitchen_sink" value="1" id="sink" /> Kitchen sink
							 </label>
							</span>
						   
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
						
					</div>
				
	                <div class="panel" id="panel_3">

						
							<div id="step3">
						    <fieldset>
						    <legend>Step 3: Footer</legend>
						    <span id="footerSelect" class="InputGroup">
						     <label for="ftr_basic"><input type="radio" name="footer" value="basic" id="ftr_basic" /> Basic</label>
						     <label for="ftr_w"><input type="radio" name="footer" value="w" id="ftr_w" /> With "W"</label>
						     <label for="ftr_gold_patch"><input type="radio" name="footer" value="goldPatch" id="ftr_gold_patch" /> With gold patch</label>
						     <label for="ftr_purple_patch"><input type="radio" name="footer" value="purplePatch" id="ftr_purple_patch" /> With purple patch</label>
						     <label for="ftr_no"><input type="radio" name="footer" value="no" id="ftr_no" /> I'll pass on the footer, thanks anyway!!!</label>
						   </span>
						   </fieldset>
						   </div>
						
					</div>
					
					<div class="panel" id="panel_4">

						<div class="inside">
							<img src="images/4.jpg" alt="picture" />
							<h2>News Heading</h2>
							<p>A very shot exerpt goes here... <a href="http://flickr.com/photos/emikohime/294092478/">more link</a></p>
						</div>
					</div>
					
					<div class="panel" id="panel_5">

						<div class="inside">
							<img src="images/5.jpg" alt="picture" />
							<h2>News Heading</h2>
							<p>A very shot exerpt goes here... <a href="http://flickr.com/photos/fensterbme/499006584/">more link</a></p>
						</div>
					</div>
				
                </div>

				<div id="left-shadow"></div>
				<div id="right-shadow"></div>

            </div>

			<img class="scrollButtons right" src="images/rightarrow.png">

        </div>
        
    </div>

</body>

</html>