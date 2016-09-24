$(document).ready(function(){

	var canvass_setup = function() {
		$.ajax({
			url: "/api/v1/canvass/setup",
		    type: "GET",
		    success: function(data){
		    	$('#canvass_setup_result').html(data);    
		  	}	
		});
  	};

	var switch_setup = function() {
		$.ajax({
			url: "/api/v1/switch/setup",
		    type: "GET",
		    success: function(data){
		    	$('#setup_result').html(data);    
		  	}	
		});
  	};

	var switch_status = function(id, status, ipaddress) {
		$.ajax({
			url: "/api/v1/switch",
		    type: "POST",
		    data:"id="+id+"&status="+status+"",
		    success: function(data){
		    	switch_setup();  
		    	canvass_setup();  
		  	}	
		});

		$.ajax({
			url: ipaddress+""+status,
		    type: "GET",
		    success: function(data){
		    	console.log("success");  
		  	}	
		});
  	};

  	canvass_setup();
  	switch_setup();

	$(document).on('click', 'span.switch-btn', function(e){
	    e.preventDefault();
	    var id = $(this).data('id');
	    var status = $(this).data('status');
	    var ipaddress = $(this).data('ipaddress');
	    switch_status(id, status, ipaddress);
	});

});