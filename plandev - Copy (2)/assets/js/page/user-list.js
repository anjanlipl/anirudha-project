$(document).ready(function(){
	 checkDadminOrHOD();
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
     $.ajax({async: true,
          url: siteUrl + "/api/getusertypes",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(result){
      $.each(result.types, function(k2, val2){
        $.each(val2, function(k, val){ 
        console.log(val);
          if(val.name != undefined && val.name !=null && val.name != ''){
            var name = val.name;
            var name = name.replace("-", " ");
          name = name.charAt(0).toUpperCase() + name.slice(1);
        }else{
          name='';
        }
          
          var newOption = $('<option value="'+val.id+'">'+name+'</option>');
          $('#usertype-select').append(newOption);

        });
        
      })
    },
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });

	$(document).on('click', '#actionDrop li a', function(e){
       	// e.preventDefault();
       //	alert(':here');
     	var userId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	
      if(actionClass.indexOf('delete') >= 0){
          if(confirm("Are you sure to delete?")){
                $.ajax({async: true,
                      url: siteUrl + "/api/users/" + userId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            alert("Deleted successfully !");
                           location.reload();
                          }
                      }
                    });
            }
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#editUserForm .username').val($(this).attr('data-name'));
        $('#editUserForm #userid').val($(this).attr('data-id'));

        $deptId = $(this).attr('data-dept');
        $('#editUserForm #usertype-select').val($deptId);

       // $('#secName').val($(this).data('name'));
      }
     });



    

       $('#editUserForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#editUserForm'))){
          var userid = $('#userid').val();
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/users/" + userid,
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "PUT",
              data: formData,
              success: function(result) {
                console.log(result);
                  $('#editUserModal').modal('toggle');
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
        }

      });


});