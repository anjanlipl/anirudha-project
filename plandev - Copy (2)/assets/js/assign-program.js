$( document ).ready(function() {

	
	// Fill in the sector List
	$.ajax({async: true,
		url: siteUrl + "/api/schemes_assign_list",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
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

	$(document).on('click', '#assignScheme', function(){
		var schemeId = $(this).attr('data-id');

		$('#assignSchemeModal #schemeId').val(schemeId);
	});


     $.ajax({async: true,url: siteUrl + "/api/assignto_list",
        headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
        success: function(result){
       var htm = '';
       $.each( result['users'], function( key, value ) {
        htm += '<option  value="'+result['users'][key]['id']+'" > '+ result['users'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
      $('.assignto_list').append(htm);
   }});

      $('#assignSchemeForm').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({async: true,
            url: siteUrl + "/api/assignScheme/submit",
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + localStorage.token
            },
            type: "POST",
            data: formData,
            success: function(result) {
            	alert('Scheme assigned Successfully !');
            	location.reload();
            	
            },
            error:function (error) {
              console.log(error.status);
              if(error.status == 422){
                $('.error-content').html('');
                var errorMsg = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Duplicate Entry. Please enter a different sector name.</div>'
                $('.error-content').append(errorMsg);
              }
            }
        });

      });
});