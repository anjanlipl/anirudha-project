window.onload = function () {
    if (typeof history.pushState === "function") {
        history.pushState("jibberish", null, null);
        window.onpopstate = function () {
            history.pushState('newjibberish', null, null);           
        };
    }
    else {
        var ignoreHashChange = true;
        window.onhashchange = function () {
            if (!ignoreHashChange) {
                ignoreHashChange = true;
                window.location.hash = Math.random();                
            }
            else {
                ignoreHashChange = false;   
            }
        };
    }
};
var frontUrl = "http://192.168.1.136/plan/";
var siteUrl = "http://192.168.1.136/planapi/public";

$( document ).ready(function() {

  if (null != localStorage.token) {
      // 
      // alert('You do not have access to this page. Click ok to login again');
      window.stop();
      window.location.href = frontUrl + 'dashboard.html';
  }

	$('#login-form, #login_guest').on('submit', function(e){
    $.notify('Trying to login. Please Wait..', 'info');
    e.preventDefault();
    $(this).find('button[type=submit]').addClass('loading');
    var email = encryp($('input[name="email"').val());
    var password = encryp($('input[name="password"').val());
    var guest = encryp($(this).find('input[name="guest"]').val());
    $.ajax({
      async: true,
      url: siteUrl + "/api/login",
      type: 'POST',           
      headers: {
        'Accept': 'application/json',
      },
      data: {email: email, password: password, guest: guest},
      success: function(result){
        // setCookie('planning_sess_pass', result.success.token, 10);
        localStorage.token = result.success.token;
        $('.notifyjs-wrapper').trigger('notify-hide');
        $.notify('Succesfully Logged in. Redirecting..', 'success');
        $.ajax({
          async: true,
          url: siteUrl + "/api/current_user_role", 
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(result) {
            userRole = result.role_name;
            localStorage.user_role = userRole;
            localStorage.username = result.user.name;
            // setCookie('username', result.user.name, 10);
            if (result.myrole == 'super-admin') {
              window.location.href = frontUrl + 'dashboard.html';

            }
            else if(result.myrole == 'hod' || result.myrole == 'department-admin' ){
              var dept_id = result.user.department_id;
              if(dept_id == null){
                 window.location.href = frontUrl + 'my-dashboards.html';
              }else{
                 window.location.href = frontUrl + 'dept_dashboard.html?dept_id='+dept_id;
              }
            }
            else{
              var dept_id = result.user.department_id;
              if(dept_id == null){
                
                window.location.href = frontUrl + 'my-dashboards.html';
              
              }
              else{
                
                window.location.href = frontUrl + 'dept_dashboard.html?dept_id='+dept_id;

              };

            }
                         // console.log(result);
          }
        });
        
      },
      error:function (error) {
        $('#login-form').find('button[type=submit]').removeClass('loading');
        if(error.status == 401){
          $('.error-content').html('');
          var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
          $('.error-content').append(errorMsg);
        } else if (error.status == 0) {
          $('.error-content').html('');
          var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
          $('.error-content').append(error);
        }
      }
    });
  });

});


function encryp(s){
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