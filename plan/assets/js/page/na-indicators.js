$(document).ready(function(){
	var urlParams = new URLSearchParams(window.location.search);
    var dept_id = urlParams.get('dept_id');
	var sector_id = urlParams.get('sector_id');
	var data = {
		status: '1',
		dept_id: dept_id,
		sector_id: sector_id
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