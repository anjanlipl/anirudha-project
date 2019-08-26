$( document ).ready(function() {

	checkDadminOrHOD();
	// Fill in the sector List
	$.ajax({async: true,
		url: siteUrl + "/api/schemes",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			console.log(result);
			$('#scheme-list').DataTable({
				data: result.schemes
			});
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	$(document).on('click', '#editScheme', function(){
		window.location ="edit-scheme.html?scheme_id="+$(this).attr('data-id');
		
	});

	$(document).on('click', '.delScheme', function(e){
		// alert();
		if(confirm("Do you want to delete?")){
				$.ajax({async: true,
					url: siteUrl + "/api/del-scheme",
					data: {'scheme_id': $(this).attr('data-id') },
					type: 'POST',
					headers: {
						'Accept': 'application/json',
						'Authorization': 'Bearer ' + localStorage.token
					},
					success: function(result){
						if(result.deleted == 'true'){
							alert("deleted");
							//location.reload();
						}else{
							alert('Scheme is not empty and cannot be deleted');
						}
					},
					error:function (error) {
						console.log(error.status);
						if(error.status == 401){
							
							
							
						}
					}
			});
		}
		
	});

});
