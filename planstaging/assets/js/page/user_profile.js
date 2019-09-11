$( document ).ready(function() {



		 $.ajax({async: true,
          url: siteUrl + "/api/get-user-profile",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          type: "post",
          success: function(result){
				//console.log(result);
				$('#username').val(result.name.trim());
				$('#useremail').val(result.email);

			},
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });
		 $('#editButton').click(function(){
		 	$('#updateButton').css('display','block');
		 	$('#username').attr('readonly',false);
		 	$('#editButton').css('display','none');

		 });

	$('#editProfile').on('submit', function(e){
		e.preventDefault();
     	//alert('here');
     	var new_username = encrypt($('input[name=user_name]').val());
     	
     	var data = {
     		'new_username': new_username,	
     	};
     		$.ajax({async: true,
		 		url: siteUrl + '/api/update_profile',
	          	headers: {
	            	'Accept': 'application/json',
	            	'Authorization': 'Bearer ' + localStorage.token
	          	},
		 		data: data,
		 		type: "post",
		 		success: function(result){
		 			//console.log(result);
        localStorage.removeItem('username');
        localStorage.setItem('username',result.name);


          //alert('User Name Updated Successfully');
          $.notify('User Name Updated Successfully','success');
          setTimeout(function(){ location.reload(); }, 400);
		 			

		 			
		 		},error:function(error){
		 			console.log(error);

		 			if(error.status == 401){
		                
		                
		                
		              }

		 		}
		 	});
     	
     	//alert('here');
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
		 		url: siteUrl + '/api/change_password',
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
		 			$('#changePassword')[0].reset();
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