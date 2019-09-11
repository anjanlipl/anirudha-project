$(document).ready(function(){

	$.ajax({async: true,
		url: siteUrl + "/api/custom_dashboard_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		type: 'get',
		success: function(result){
			$.each( result.customdashboards, function( key, value ) {
					//console.log(key + "----- "+value);
					console.log(result.customdashboards[key].name );
					var dashboard_name= result.customdashboards[key].name;
					$('#dashboard_cards').append('<div><a href="custom-dashboard.html?id='+result.customdashboards[key].id+'">'+dashboard_name+'</a></div>')

			});
			// $('#dept-select').trigger('change');
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

});