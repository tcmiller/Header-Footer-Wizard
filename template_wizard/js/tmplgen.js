$(function () {               	
    
    /***    
    Tab and Enter really mess with form so we
    disable, sorry
    ***/
    $("#tmplgenForm").bind("keypress", function(e) {
      if ((e.keyCode == 13) || (e.keyCode == 9)) return false;
      });

	$('#q').click(function(){
		$('#q').attr('value','');
	});
	
	// Some form defaults, mostly the disabled radio buttons
	$('#sink').attr('disabled','disabled');
	$('#ss_inline').attr('disabled','disabled');
	$('#ss_tab').attr('disabled','disabled');
	
   // UI
   $('#strip').click(function(){
     $('#step2_sub').show();
   });
   $('#sink').click(function(){
     $('#step2_sub').hide();
   });
   $('#no-hdr').click(function() {
   	 $('#step2_sub').hide();
   });
   $('#no_patch').click(function(){
     $('#blockwBlk').show();
   });
   $('#patch').click(function(){
     $('#blockwBlk').hide();
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
   
    
    // update account
    $('#email,#site_url').change(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    	                        email: $('#email').val(),
    	                        site_url: $('#site_url').val(),
    	                        code_pref: $('input[name=code_pref]:checked').val(),
    	                        processType: 'updtA' } );  
      	
    });
    
    // send header info
    $('input[name=selection],input[name=blockw],input[name=patch],input[name=color],input[name=search]').click(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    	                        selection: $('input[name=selection]:checked').val(),
    		                    color: $('input[name=color]:checked').val(),
    		                    blockw: $('input[name=blockw]:checked').val(),
    		                    patch: $('input[name=patch]:checked').val(),
    		                    search: $('input[name=search]:checked').val(),
    		                    wordmark: $('input[name=wordmark]:checked').val(),
    	                        processType: 'initH'},function(data) {
    	$('#hdr-preview').css('display','block');
    	$('#hdr-preview').html(data);
    	$('#outputBlk').css('display','none');
    	var display = '';
    	if (($('input[name=selection]:checked').val() == 'no-hdr') && ($('input[name=footer]:checked').val() !== 'no')) {
    		display = 'block';	
    	} else if ($('input[name=selection]:checked').val() !== 'no-hdr') {
    		display = 'block';
    	} else {
    		display = 'none';
    	}
    	$('#bodyTxt').css('display',display);
    	
    	});
    	
    });
    
    // initialize/update footer
    $('input[name=footer]').click(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    		                    footer: $('input[name=footer]:checked').val(),
    	                        processType: 'initF'},function(data) {
    	$('#ftr-preview').css('display','block');
    	$('#ftr-preview').html(data);
    	$('#outputBlk').css('display','none');
    	var display = '';
    	if (($('input[name=footer]:checked').val() == 'no') && ($('input[name=selection]:checked').val() !== 'no-hdr')) {
    		display = 'block';	
    	} else if ($('input[name=footer]:checked').val() !== 'no') {
    		display = 'block';
    	} else {
    		display = 'none';
    	}
    	$('#bodyTxt').css('display',display);
    	
    	});

    });
    
    // process our code preference selection
    $('input[name=code_pref]').click(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    	                        email: $('#email').val(),
    	                        site_url: $('#site_url').val(),
    		                    code_pref: $('input[name=code_pref]:checked').val(),
    	                        processType: 'updtA'} );
  	 
    });   
    
    // finalize our account    
    $('form#tmplgenForm').submit(function() {
    	
    	// what needs to be done before finalizing account and displaying code
    	// validate step 4
    	
    	// what needs to display and not display after all is kosher
    	// depending on the code preference selection, a textarea containing the copy and paste code AND/OR the include scripts they need to copy
    	// depending on header AND/OR footer, just the code for what they want, maybe in a modal window or maybe just below
    	// get rid of the input previews and show the output previews
    	
    	$('#generate').attr('value','Please wait............');
    	$('#generate').attr('disabled','disabled');
    	$.ajax({
		   type: "POST",
		   url: "generate.php",
		   timeout: 2000,
		   data: ({ owner : $('#owner').val(),
		            processType: 'fnlzA' }),
		   error: function() {
               $('#generate').attr('value','Failed to submit');
               $('#generate').removeAttr('disabled');},
		   success: function(msg) {
		     setTimeout(function() {
		     	$('#generate').attr('value','Now, go have fun!');
		     	$('#generate').removeAttr('disabled');
		     	$('#bodyTxt').css('display','none');
		     	$('#outputBlk').css('display','block');
		     	$('#ftr-preview').css('padding-top','80px');
		     	$('#outputBlk').html(msg);
		     	$('#outputBlk input,textarea').attr('readonly','readonly');
		     	$('#outputBlk input,textarea').focus(function() {
				  // only select if the text has not changed
				  if(this.value == this.defaultValue) {
				  	this.select();
				  }
				 }
				)
		     }, 750);
		   }
		 });
	 return false;
    });
    
    
    /*
	 * Url preview script 
	 * powered by jQuery (http://www.jquery.com)
	 * 
	 * written by Alen Grakalic (http://cssglobe.com)
	 * 
	 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
	 *
	 */
	$.fn.screenshotPreview = function(){	
		/* CONFIG */
			
			xOffset = 10;
			yOffset = 30;
			
			// these 2 variable determine popup's distance from the cursor
			// you might want to adjust to get the right result
			
		/* END CONFIG */
		$("a.screenshot").hover(function(e){
			this.t = this.title;
			this.title = "";	
			var c = (this.t != "") ? "<br/>" + this.t : "";
			$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
			$("#screenshot")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(e.pageX + yOffset) + "px")
				.fadeIn("fast");						
	    },
		function(){
			this.title = this.t;	
			$("#screenshot").remove();
	    });	
		$("a.screenshot").mousemove(function(e){
			$("#screenshot")
				.css("top",(e.pageY - xOffset) + "px")
				.css("left",(e.pageX + yOffset) + "px");
		});			
	};
	
	
	/**
	 * Feedback submit form
	 *
	 */
	$("#feedbackSubmit").click(function(){                                     
        $(".error").hide();
        var hasError = false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        
        var emailVal = $("#email").val();
        if (emailVal == '')
        {
            $("#email").after('<span class="error">Please enter an email address.</span>');
            hasError = true;
        }
        else if (!emailReg.test(emailVal)) 
        {
            $("#email").after('<span class="error">Please enter a valid email address.</span>');
            hasError = true;
        }

        var messageVal = $("#comment").val();
        if (messageVal == '') {
            $("#comment").after('<span class="error">You forgot to enter a comment.</span>');
            hasError = true;
        }
        
        if(hasError == false) 
        {
            var data = new Object();
            data.email = emailVal;
            data.message = messageVal;
            var dataString = $.toJSON(data)
            $(this).hide();
            $("#feedbackForm").append('<img src="/uweb/tmplgen/images/loading.gif" alt="Loading" id="loading" />');
            
            $.post("comment.php",
                { data: dataString },
                function(resp)
                {
                    var obj = $.evalJSON(resp); 
                    if (obj == true) 
                    {
                        $("#feedback").slideUp("normal", function()
                        {
                            $("#feedback").before('<h3>Awesome!</h3><p>Thanks for the comment!</p>');                                          
                        });
                    }
                    else
                    {
                        $("#feedback").slideUp("normal", function()
                        {
                            $("#feedback").before('<h3>Fail!</h3><p>Massive problem.</p>'); 
                        });
                    }
                }
            );
        }
        return false;
    });
    
});
