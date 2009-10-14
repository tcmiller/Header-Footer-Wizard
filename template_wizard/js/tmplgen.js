$(function () {               	
	
    /* prevent tab idea
    $.fn.preventTab = function(options) {

        return this.each(function(){
            $(this).bind('keydown', function(e){
                if(e.which == 9){
                    return false;
                }
            });
        });
    };
    
    $('.preventTab', $('#site_url')).preventTab();*/
    
	$('#q').click(function(){
		$('#q').attr('value','');
	});
	
	// Form validation
	/*$("#tmplgenForm").validate({
    errorClass: "error",
        rules: {
         
         email: {
           required: true,
           email: true
         },
         site_url: {
            required: true,
            url: true
        },
         selection: "required",
         code_pref: "required",
       },
       messages: {
         email: {
           required: "Please provide an email address",
           email: "Invalid email, try again"
         },
         site_url: {
           required: "Please specify a site url",
           url: "We need a valid url for our records"
         },
         selection: "Please make a choice",
         code_pref: "Please specify a delivery option",
       }
    });*/
	
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
   
    
    // update our account
    $('#email,#site_url').change(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    	                        email: $('#email').val(),
    	                        site_url: $('#site_url').val(),
    	                        code_pref: $('input[name=code_pref]:checked').val(),
    	                        processType: 'updtA' },function(data) {
    	$('#results').text(data);
    },'html');  
      	
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
    	$('#preview').html(data);
    	$('#results').text(data);
    	});
    	
    });    
    
    // initialize our footer
    $("input[name='footer']").click(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    		                    footer: $('input[name=footer]:checked').val(),
    	                        processType: 'initF'},function(data) {
    	$('#results').text(data);              	
  	},'html');
  	 
    });
    
    // process our code preference selection
    $("input[name='code_pref']").click(function() {
    	$.post('generate.php',{ owner: $('#owner').val(),
    	                        email: $('#email').val(),
    	                        site_url: $('#site_url').val(),
    		                    code_pref: $('input[name=code_pref]:checked').val(),
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
		   data: ({ owner : $('#owner').val(),
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