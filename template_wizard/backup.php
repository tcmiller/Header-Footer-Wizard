/*$fields_values = array('requester'=>$values['requester'],
			                       'active'=>'0',
			                       'created_date' => date('Y-m-d H:i:s'),
								   'modified_date' => '0000-00-00 00:00:00',
								   'last_accessed' => '0000-00-00 00:00:00');
								   
								   $procType = 'MDB2_AUTOQUERY_INSERT';
								   
								   $types = array('text','integer','text','text','text');*/
	
	/*$fields_values = array(
	    'requester' => $values['requester'],
	    'owner' => $values['owner'],
	    'email' => $values['email'],
	    'site_url' => $values['site_url'],
	    'active' => ACTIVE,
	    'code_pref' => $values['code_pref'],
		'created_date' => date('Y-m-d H:i:s'),
		'modified_date' => '0000-00-00 00:00:00',
		'last_accessed' => '0000-00-00 00:00:00'
	);*/
	
	//$types = array('text', 'text', 'text', 'text', 'integer', 'text', 'text', 'text');

	//echo $procType;
	
	
	// Server-side form validation   
   /*$('#owner').bind('blur',function(){
	    $.get("error.php", { 'owner[]': [$('#owner').val(), 'required'] }, function(data) {

	      $('#error-owner').html(data);
	    }, 'html');
	  });
	  
	$('#email').bind('blur',function(){
		$.get("error.php", { 'email[]': [$('#email').val(), 'requiredAndEmail'] }, function(data) {
		                     	
		  $('#error-email').html(data);
	  },'html');
	});
	
	$('#site_url').bind('blur',function(){
		$.get("error.php", { 'site_url[]': [$('#site_url').val(), 'required'] }, function(data) {
		                     	
		  $('#error-site_url').html(data);
	  },'html');
	});*/
	
	/*$('input[name=kitchen_sink]').bind('click',function(){
		$.get("error.php", { 'kitchen_sink[]': [$('input[name=kitchen_sink]').val(), 'required'] }, function(data) {
		                     	
		  $('#error-kitchen_sink').html(data);
	  },'html');
	});
	
	$('input[name=footer]').bind('click',function(){
		$.get("error.php", { 'footer[]': [$('input[name=footer]').val(), 'required'] }, function(data) {
		                     	
		  $('#error-footer').html(data);
	  },'html');
	});*/
	
	/*$('#strip').bind('blur',function(){
		$.get("error.php", { blah: 'something' }, function(data) {
		                     	
		  $('#error-kitchen_sink').html(data);
	  },'html');
	});*/
	
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
    
    
    <div style="position: relative; margin-bottom: 12px;"><img src="images/kitchen_sink.jpg" width="170" height="32" alt="Kitchen sink sample graphic" style="position: absolute; left: 96px; top: 4px;" /></div>