$(document).ready(function(){
    // includePart();
    includeHTML();

    $('body').on('click', '#logout-adm', function(e){
      e.preventDefault();
      logout();
    });

    $('body').on('click', '#collapseBtn', function(e){
      e.preventDefault();
      $('.sidebar, .head-nav, .content').toggleClass('collapsed');
    });

    $.ajax({async: true,url: siteUrl + "/api/department_dashboard_links",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
        // alert('success');
       
       $.each(result['departments'], function(key, value){
        $('body #dept_list_side').append('<li><a href="dept_dashboard.html?dept_id='+value.id+'">'+value.name+'</a></li>');
        console.log(value);
       }); 
     },error:function (error) {
                  console.log(error.status);
                  if(error.status == 401){
                    
                    
                    
                  }
              }

   });

    $('.sidebar').niceScroll();

    $('body').on('click', 'li.has-dropdown > a', function(e){
        e.preventDefault();
        // $('li .dropdown').slideUp(300);
        $(this).parent().toggleClass('active');
        $(this).parent().find('.dropdown').slideToggle(300, function(){
          $('.sidebar').getNiceScroll().resize();
        });
    });

    $('body').on('click', '.head-btn', function(e){
      e.preventDefault();
      $(this).parent().toggleClass('active');
      $(this).parent().find('.dropdown').slideToggle(300);
    });

    $('form').validatr();

    $(document).ajaxComplete(function(){
      // alert('ajax');
      // $('body').getNiceScroll().resize();
    })

    //$('table').DataTable();
    // var myform = new jsValidator().init({
    //     form: 'form2submit',   // #id
    //     forceFilter: true,
    //      message: {
    //         required: 'This field is required !',
    //         min: '<br><span style="color: red;">This field is less then the limit</span>',
    //         max: 'This field is exceeds the limit',
    //         password: 'Password does not match !',
    //         email: 'Invalid Email found !',
    //         file: 'Invalid File format given'
    //     }
    // });

});



// <<<<<<< HEAD
var siteUrl = "http://local.planning.com/";
var frontUrl= "http://localhost/dg/";
// =======
// var siteUrl = "http://localhost/planning_api/public/";
// var frontUrl= "http://localhost/planning/";
// >>>>>>> 951394fcc438dd21a7f6d6452eeabbfedee291b4



var userRole = "";

function logout() {
  document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function redirectToLogin() {
  if ('' == localStorage.token) {
    
    alert('You do not have access to this page. Click ok to login again');
    window.location.href = frontUrl + 'login.html';
  }
}
function checkSuperAdmin() {
  if ('super-admin' != localStorage.user_role && 'public-viewer' != localStorage.user_role) {
    
    alert('You do not have access to this page. Click ok to login again');
    window.location.href = frontUrl + 'login.html';
  }
  /*if (userRole != "super-admin") {
    
    alert('You do not have access to this page. Click ok to login again');
    setCookie('planning_sess_pass', '', 10);
    window.location.href = frontUrl + 'login.html';
  }*/
}
function checkDadmin() {
  if ('super-admin' != localStorage.user_role || 'department-admin' != localStorage.user_role) {
    
    alert('You do not have access to this page. Click ok to login again');
    window.location.href = frontUrl + 'login.html';
  }

}


<<<<<<< HEAD
// $(window).on('load', function(){
//   includeHTML();
// })
=======
$(window).on('load', function(){
  includeHTML();
   setTimeout(function(){

            var username = localStorage.username;
            //alert(username);
             $('.head-btn-wrap .user-name-head').html("");

             $('.head-btn-wrap .user-name-head').html("Hello, " + username);

      },2000);
})
>>>>>>> 951394fcc438dd21a7f6d6452eeabbfedee291b4


function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /*make an HTTP request using the attribute value as the file name:*/
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText;}
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          /*remove the attribute, and call this function once more:*/
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      } 
      xhttp.open("GET", file, true);
      xhttp.send();
      /*exit the function:*/
      return;
    }
  }
}

function includePart() {
  var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /*make an HTTP request using the attribute value as the file name:*/
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText;}
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          /*remove the attribute, and call this function once more:*/
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      } 
      xhttp.open("GET", file, true);
      xhttp.send();
      /*exit the function:*/
      return;
    }
  }
  includeHTML();
}


$( document ).ready(function() {

   setTimeout(function(){
             userRole = localStorage.user_role ;

              if (userRole == 'super-admin') {
                        $('#masters-menu').css('display','block');
                        $('#users-menu').css('display','block');
                        $('.dadmin').css('display','block');
                        $('.hodrole').css('display','block');

                    }else if(userRole == 'department-admin'){
                        $('#users-menu').css('display','block');
                        $('.superonly').css('display','none');
                        $('.hodrole').css('display','none');
                        $('.dadmin').css('display','block');
                    }
                     else if(userRole == 'hod'){
                        $('#users-menu').css('display','block');
                        $('.superonly').css('display','none');
                        $('.hodrole').css('display','block');
                        $('.dadmin').css('display','block');
                    }else if(userRole == 'public-viewer'){
                        $('#masters-menu').css('display','none');
                        $('#users-menu').css('display','none');
                        $('.dadmin').css('display','none');
                        $('.hodrole').css('display','none');
                        $('.superonly').css('display','none');
                    }
                    else{
                        $('#masters-menu').css('display','none');
                        $('#users-menu').css('display','none');
                        $('.dadmin').css('display','none');
                        $('.hodrole').css('display','none');
                        $('.superonly').css('display','none');
                      
                    }
                  }, 
              2000);
   
     
  $('body').on('click', '.dashboard-redirect', function(e){

      e.preventDefault();
      $.ajax({async: true,
                      url: siteUrl + "/api/current_user_role",                    
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      success: function(result) {
                        console.log(result);
                        userRole = result.myrole ;
                          if (userRole== 'super-admin') {
                            window.location.href = frontUrl + 'dashboard.html';

                          }else if(userRole== 'hod'){
                            var dept_id = result.depart.id;
                            window.location.href = frontUrl + 'dept_dashboard.html?dept_id='+dept_id;

                          }else if(userRole == 'department-admin'){
                            var dept_id = result.depart.id;
                            window.location.href = frontUrl + 'dept_dashboard.html?dept_id='+dept_id;
                          }else{
                             window.location.href = frontUrl + 'dashboard.html';
                          }
                      }
                    });
                        
                         // console.log(result);
                  
        });
  
  

}); 




    
        

     





