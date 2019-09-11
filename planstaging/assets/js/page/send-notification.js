$(document).ready(function(){
	 checkDadminOrHOD();
		$.ajax({async: true,
		url: siteUrl + "/api/get-department-users",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			// $.each(result.users)
      var htm = "";
      $.each( result.users, function( key, value ) {
        htm += '<option  value="'+value.id+'" > '+ value.name +'</option>';
        //console.log( key + ": " + value );
      });
      $('#userid').append(htm);
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});
     $('#sendNotification').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#sendNotification'))){
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/send-notification",
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "POST",
              data: formData,
              success: function(result) {
                console.log(result);
                alert('Notification Sent');
                $('#userid').val('');
                $('#message').html(''); 
                  // $('#editUserModal').modal('toggle');
                  // location.reload();
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
        }

      });


});