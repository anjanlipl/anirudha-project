$(document).ready(function(){
	var data = {
		status: '2',
		type: 'critical'
	};
	$.ajax({
	    url: siteUrl + "/api/offtrackIndicators",                    
		type: 'POST',
		data: data,
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
	  	success: function(result) {
	  		$('#allInds').html(result);
	  	}
  	});
});