$( document ).ready(function() {

	checkDadminOrHOD();
    //checkDadmin();
    
	 $.ajax({async: true,
          url: siteUrl + "/api/getusertypes",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(result){
			$.each(result.types, function(k2, val2){
				if(val2.name != undefined && val2.name !=null && val2.name != ''){
							var name = val2.name;
							var name = name.replace("-", " ");
							name = name.charAt(0).toUpperCase() + name.slice(1);
							var newOption = $('<option value="'+val2.id+'">'+name+'</option>');
							$('#usertype-select').append(newOption);
				}else{
					$.each(val2, function(k, val){ 
						//console.log(val);
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

						
				}
				
			});
		},
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });

     $('#changePassword').on('submit', function(e){
     	e.preventDefault();
     	var elem = $(this);
     	var new_pass = encrypt($('input[name=password]').val());
     	var conf_pass = encrypt($('input[name=password_confirmation]').val());
     	var old_pass = encrypt($('input[name=user_password]').val());
     	var data = {
     		'password': new_pass,
     		'password_confirmation': conf_pass,
     		'user_password': old_pass
     	};
     	if(new_pass == conf_pass){
     		$.ajax({async: true,
		 		url: siteUrl + 'api/change_password',
	          	headers: {
	            	'Accept': 'application/json',
	            	'Authorization': 'Bearer ' + localStorage.token
	          	},
		 		data: data,
		 		type: "post",
		 		success: function(result){
		 			console.log(result);
		 			if(result.success == "false"){
     					$.notify('Old Password given doesnot match','error');
		 			}else{
     					$.notify('Your Password Changed Successfully','success');

		 			}
		 			$('#changePassword').reset();
		 			location.reload();
		 		},error:function(error){
		 			console.log(error);

		 			console.log(error.responseText);
		 			if(error.status == 403){
     					$.notify('Old Password given doesnot match','error');

		 			}
		 			else if(error.responseText.password != '' || error.responseText.password_confirmation != ''){
     					$.notify('Password Must be minimum 6 characters','error');
		 			}

		 		}
		 	});
     	}
     	else{
     		$.notify('New password and confirm password do not match','error');
     	}
     });

     $('#add-user-form').on('submit', function(e){
     	$.notify('Adding user', 'info');
		e.preventDefault();
		if($.validatr.validateForm($('#add-user-form'))){
			$(this).find('button[type=submit]').addClass('loading');
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/users",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					//var scheme_id = result.scheme['id'];
					//var redirUrl = frontUrl + 'add-scheme-financials.html?scheme_id=' + scheme_id;
					$('.notifyjs-wrapper').trigger('notify-hide');
					//window.location.href = redirUrl;
					$.notify('New User created successfully', 'success');
					window.location = 'all-users.html';
				},
				error:function (error) {
					console.log(error);
					if(error.status == 401){
						$('.error-content').html('');
						var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
						$('.error-content').append(errorMsg);
					}else{
						$('.error-content').html('');
						var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
						$('.error-content').append(errorMsg);
					}
				}
			});
		}
	});
});
function encrypt(s){
	// body...
  var enc = "";
  var str = "";
  // make sure that input is string
  str = s.toString();
  for (var i = 0; i < s.length; i++) {
    // create block
    var a = s.charCodeAt(i);
    // bitwise XOR
    // var b = a ^ k;
    enc = enc + a+'.*$%';
  }
  return enc;
}