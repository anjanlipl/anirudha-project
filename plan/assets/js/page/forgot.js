var frontUrl = "http://192.168.1.136/plan/";
var siteUrl = "http://192.168.1.136/planapi/public";
$( document ).ready(function() {
	$('#reset-pass').on('submit', function(e){
		e.preventDefault();
		$.ajax({
          	url: siteUrl + "/api/reset_password",
          	type: 'POST',
          	data: $('#reset-pass').serializeArray(),
          	headers: {
	            'Accept': 'application/json',
	            'Authorization': 'Bearer ' + localStorage.token
          	},
          	success: function(result){
				if(result.success){
					$.notify('New Password sent to your email ID.');
				}
			},
         	error:function (error) {
              	console.log(error.status);
              	if(error.status == 401){
	                
              	}
          	}
     	});
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