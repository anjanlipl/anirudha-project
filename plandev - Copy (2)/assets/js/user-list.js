$(document).ready(function(){
		$.ajax({async: true,
		url: siteUrl + "/api/userslist",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			$('#user-list').DataTable({
				data: result.users
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});
});