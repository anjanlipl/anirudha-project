$(document).ready(function(){
    // includePart();

    if(!window.localStorage.getItem('finYear')){
      window.localStorage.setItem('finYear', '2019-20');
    }
    // Enable pusher logging - don't include this in production
var url = window.location.href;
var filename = url.substring(url.lastIndexOf('/')+1);
// alert(filename);
var frontUrl = url.replace(filename, "");
console.log(frontUrl);
var siteUrl = "http://103.92.47.157/planapi/public";
xhrPool = [];
    includeHTML();
    // $( document ).ajaxStop(function() {
    //   console.log('Ajax Ends');
        // setInterval(function(){
        // userRole = window.localStorage.user_role;
        // if (userRole == 'super-admin') {
        //           $('#masters-menu').css('display','block');
        //           $('#users-menu').css('display','block');
        //           $('.dadmin').css('display','block');
        //           $('.hodrole').css('display','block');

        //       }else if(userRole == 'department-admin'){
        //           $('#users-menu').css('display','block');
        //           $('.superonly').css('display','none');
        //           $('.hodrole').css('display','none');
        //           $('.dadmin').css('display','block');
        //       }
        //        else if(userRole == 'hod'){
        //           $('#users-menu').css('display','block');
        //           $('.superonly').css('display','none');
        //           $('.hodrole').css('display','block');
        //           $('.dadmin').css('display','block');
        //       }else if(userRole == 'public-viewer'){
        //           $('#masters-menu').css('display','none');
        //           $('#users-menu').css('display','none');
        //           $('.dadmin').css('display','none');
        //           $('.hodrole').css('display','none');
        //           $('.superonly').css('display','none');
        //       }
        //       else{
        //           $('#masters-menu').css('display','none');
        //           $('#users-menu').css('display','none');
        //           $('.dadmin').css('display','none');
        //           $('.hodrole').css('display','none');
        //           $('.superonly').css('display','none');
  
        //       }
        //       $('body .side-list').css('display', 'block');

        //     }, 
        // 2000);
    // // });
    $(document).bind("ajaxSend", function(){
       $("body").addClass('loading');
     }).bind("ajaxStop", function(){
       $("body").removeClass('loading');
     });
    $('body').on('click', '#logout-adm', function(e){
      e.preventDefault();
      $.each(xhrPool, function(idx, jqXHR) {
          jqXHR.abort();
      });
      logout();
    });


    $('input, textarea').on('input', function(e){
        // console.log($(this).val());
        var inp_val = $(this).val();
        while(inp_val.indexOf('<') > -1)
        {
          // alert("hello found inside your_string");
          var new_val = inp_val.replace('<','');

          $(this).val(new_val);

          var inp_val = $(this).val();
        }
        while(inp_val.indexOf('>') > -1)
        {
          // alert("hello found inside your_string");
          var new_val = inp_val.replace('>','');

          $(this).val(new_val);

          var inp_val = $(this).val();
        }
        while(inp_val.indexOf('</') > -1){
          var new_val = inp_val.replace('</','');
          $(this).val(new_val);
          var inp_val = $(this).val();
        }
    });


    $('.section-title').on('click', function(e){
      if(!($(e.target).is('.sortPerfTable') || $(e.target).is('.btn.btn-primary') || $(e.target).is('.text') || $(e.target).is('.icon'))) {
        $(this).siblings('.section-content').slideToggle(300);
        $(this).toggleClass('collapsed');
      }
    });

    $('body').on('click', '#collapseBtn', function(e){
      e.preventDefault();
      $('.sidebar, .head-nav, .content').toggleClass('collapsed');
    });
    $('body .sortPerfTable').on('change', function(){
      var value_sort = $(this).val();
      var targ = $(this).attr('data-target');
      var table = $(this).closest('.section').find(targ).DataTable();

      if(value_sort == 1){
        table.order( [ 2, 'desc' ] ).draw();
      }
      else{
        table.order( [ 2, 'asc' ] ).draw();
      }

    });

    $('#sidebar').niceScroll();

    $('#sidebar').on('mouseover', function(e){
      $("#sidebar").getNiceScroll().resize();
    });

    $('body').on('click', 'li.has-dropdown > a', function(e){
        e.preventDefault();
        if($(this).parent().hasClass('active')){
            $('li.has-dropdown .dropdown').slideUp(300);
            $('li.has-dropdown > a').parent().removeClass('active');
        }
        else{
            $('li.has-dropdown .dropdown').slideUp(300);
            $('li.has-dropdown > a').parent().removeClass('active');
            // $('li .dropdown').slideUp(300);
            $(this).parent().toggleClass('active');
            $(this).parent().find('.dropdown').slideToggle(300, function(){
              $('.sidebar').getNiceScroll().resize();
            });
        }
    });

    $('body').on('click', '.head-btn', function(e){
      e.preventDefault();
      $(this).parent().toggleClass('active');
      $(this).parent().find('.dropdown').slideToggle(100);
    });

    $('form').validatr();

    // $(document).ajaxComplete(function(event, xhr, settings){
      // console.log("ajax - " + event + "--------------------------");
      // $('body').getNiceScroll().resize();
    // })
    // $(document).ajaxError(function(x, status, error) {
    //         if(x.status == 401) {
    //             // alert("Sorry, You are not allowed to view this page. Redirecting to login..");
    //             var data = {
    //               'token' : window.localStorage.token
    //             };
    //             $.ajax({
    // async: true,
    //               async: true,
    //               url: siteUrl + "/api/logout",                    
    //               type: 'POST',
    //               data: data,
    //               headers: {
    //                 'Accept': 'application/json',
    //                 'Authorization': 'Bearer ' + window.localStorage.token
    //               },
    //               success: function(result) {
    //                 window.localStorage.removeItem('token');
    //                 window.localStorage.removeItem('user_role');
    //                 window.localStorage.removeItem('username');
    //                 // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    //                 window.location.href = frontUrl + 'login.html';
    //               }
    //             });
    //         }
    //     });

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



var userRole = "";

function logout(){
  bootbox.confirm({
    title: "Logout?",
    message: "Are you sure you want to logout?",
    buttons: {
      cancel: {
          label: '<i class="fa fa-times"></i> Cancel'
      },
      confirm: {
          label: '<i class="fa fa-check"></i> Confirm'
      }
    },
    callback: function(result){
      if(result==true){
        var data = {
          'token' : window.localStorage.token
        };
        $.ajax({async: true,
          url: siteUrl + "/api/logout",                    
          type: 'POST',
          data: data,
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + window.localStorage.token
          },
          success: function(result) {
            window.localStorage.removeItem('token');
            window.localStorage.removeItem('user_role');
            window.localStorage.removeItem('username');
            // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = frontUrl + 'login.html';
          }
        });
      }
    }
  });
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}


function checkSuperAdmin() {
  console.log('checkSuperAdmin');
  // if ('super-admin' != window.localStorage.user_role && 'public-viewer' != window.localStorage.user_role) {
  //   ;
  //   console.log('checkSuperAdmin');
  //   $.ajax({
    // async: true,
  //     url: siteUrl + "/api/logout",
  //     type:'POST',                  
  //     headers: {
  //       'Accept': 'application/json',
  //       'Authorization': 'Bearer ' + window.localStorage.token
  //     },
  //     success: function(result) {
  //       window.localStorage.removeItem('token');
  //       window.localStorage.removeItem('user_role');
  //       window.localStorage.removeItem('username');
  //       // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  //       window.location.href = frontUrl + 'login.html';
  //     }
  //   });
  // }
}
function checkDepartmentAccess(id) {
  //console.log('checkSuperAdmin');
  
    // $.ajax({
    // async: true,
    //   url: siteUrl + "/api/check_dept_access/"+id,                    
    //   headers: {
    //     'Accept': 'application/json',
    //     'Authorization': 'Bearer ' + window.localStorage.token
    //   },
    //   success: function(result) {
    //     console.log(result);
    //     if(result.allowed != "true"){
    //       // alert("Access Denied, Please Login again !");
    //       window.localStorage.removeItem('token');
    //     window.localStorage.removeItem('user_role');
    //     window.localStorage.removeItem('username');
    //     window.location.href = frontUrl + 'login.html';
    //     }
    //   }
    // });
  
 
}
function checkSuperAdminOnly() {
  // if (!('super-admin' == window.localStorage.user_role ) ) {
  //   
  //   var data = {
  //         'token' : window.localStorage.token
  //       };
  //       $.ajax({async: true,
  //         url: siteUrl + "/api/logout",                    
  //         type: 'POST',
  //         data: data,
  //         headers: {
  //           'Accept': 'application/json',
  //           'Authorization': 'Bearer ' + window.localStorage.token
  //         },
  //         success: function(result) {
  //           window.localStorage.removeItem('token');
  //           window.localStorage.removeItem('user_role');
  //           window.localStorage.removeItem('username');
  //           window.location.href = frontUrl + 'login.html';
  //         }
  //       });
  // }
}
function checkDadmin() {
  // console.log('checkDAdmin');
  // if ('super-admin' != window.localStorage.user_role && 'department-admin' != window.localStorage.user_role ) {
  //   
  //   var data = {
  //         'token' : window.localStorage.token
  //       };
  //       $.ajax({async: true,
  //         url: siteUrl + "/api/logout",                    
  //         type: 'POST',
  //         data: data,
  //         headers: {
  //           'Accept': 'application/json',
  //           'Authorization': 'Bearer ' + window.localStorage.token
  //         },
  //         success: function(result) {
  //           window.localStorage.removeItem('token');
  //           window.localStorage.removeItem('user_role');
  //           window.localStorage.removeItem('username');
  //           // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  //           window.location.href = frontUrl + 'login.html';
  //         }
  //       });
  //  }
}
function checkDadminOrHOD() {
  // console.log('checkDHODAdminOnly');
  // if ('super-admin' != window.localStorage.user_role && 'department-admin' != window.localStorage.user_role && 'hod' != window.localStorage.user_role ) {
  //   
  //   // alert('You do not have access to this page. Click ok to login again');
  //   var data = {
  //         'token' : window.localStorage.token
  //       };
  //       $.ajax({async: true,
  //         url: siteUrl + "/api/logout",                    
  //         type: 'POST',
  //         data: data,
  //         headers: {
  //           'Accept': 'application/json',
  //           'Authorization': 'Bearer ' + window.localStorage.token
  //         },
  //         success: function(result) {
  //           window.localStorage.removeItem('token');
  //           window.localStorage.removeItem('user_role');
  //           window.localStorage.removeItem('username');
  //           // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  //           window.location.href = frontUrl + 'login.html';
  //         }
  //       });
  // }
}




$(window).on('load', function(){
  $('body').addClass('loaded');
  includeHTML();
   setTimeout(function(){

            var username = window.localStorage.username;
            //alert(username);
             $('.head-btn-wrap .user-name-head').html("");

             $('.head-btn-wrap .user-name-head').html("Hello, " + username);

      },2000);
})



// function includeHTML() {
//   var z, i, elmnt, file, xhttp;
//   /*loop through a collection of all HTML elements:*/
//   z = document.getElementsByTagName("*");
//   for (i = 0; i < z.length; i++) {
//     elmnt = z[i];
//     /*search for elements with a certain atrribute:*/
//     file = elmnt.getAttribute("w3-include-html");
//     if (file) {
//       /*make an HTTP request using the attribute value as the file name:*/
//       xhttp = new XMLHttpRequest();
//       xhttp.onreadystatechange = function() {
//         // if (this.readyState == 4) {
//           if (this.status == 200) {elmnt.innerHTML = this.responseText;}
//           if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
//           /*remove the attribute, and call this function once more:*/
//           elmnt.removeAttribute("w3-include-html");
//           includeHTML();
//         // }
//       } 
//       xhttp.open("GET", file, true);
//       xhttp.send();

//       /*exit the function:*/
//       return;
//     }
//   }
// }
  // setTimeout(function(){
        

    // },2000);

function includeHTML() {
  // var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  $("body *[w3-include-html]").each(function(){
      var file = $(this).attr('w3-include-html');
      // $(this).val(testdata);
      if(file){
          var cont = getFileContent(file);
          // console.log(cont);
          $(this).html(cont);
          $(this).removeAttr("w3-include-html");
          includeHTML();
      }
  });
}


$( document ).ready(function() {

   // setTimeout(function(){
             // userRole = window.localStorage.user_role;
             //  if (userRole == 'super-admin') {
             //            $('#masters-menu').css('display','block');
             //            $('#users-menu').css('display','block');
             //            $('.dadmin').css('display','block');
             //            $('.hodrole').css('display','block');

             //        }else if(userRole == 'department-admin'){
             //            $('#users-menu').css('display','block');
             //            $('.superonly').css('display','none');
             //            $('.hodrole').css('display','none');
             //            $('.dadmin').css('display','block');
             //        }
             //         else if(userRole == 'hod'){
             //            $('#users-menu').css('display','block');
             //            $('.superonly').css('display','none');
             //            $('.hodrole').css('display','block');
             //            $('.dadmin').css('display','block');
             //        }else if(userRole == 'public-viewer'){
             //            $('#masters-menu').css('display','none');
             //            $('#users-menu').css('display','none');
             //            $('.dadmin').css('display','none');
             //            $('.hodrole').css('display','none');
             //            $('.superonly').css('display','none');
             //        }
             //        else{
             //            $('#masters-menu').css('display','none');
             //            $('#users-menu').css('display','none');
             //            $('.dadmin').css('display','none');
             //            $('.hodrole').css('display','none');
             //            $('.superonly').css('display','none');
                      
             //        }
             //        $('body .side-list').css('display', 'block');

              //     }, 
              // 2000);
   
     
  $('body').on('click', '.dashboard-redirect', function(e){
      e.preventDefault();
      $.ajax({async: true,
        url: siteUrl + "/api/current_user_role",                    
        headers: {
          'Accept': 'application/json',
          'Authorization': 'Bearer ' + window.localStorage.token
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
        },
        error: function(result){
          // window.location.href = frontUrl + 'login.html';
        }
      });
                  
    });

    $('body #finYear option[value='+window.localStorage.finYear+']').attr('selected','selected');

    $('body').on('change', '#finYear', function(e){
      e.preventDefault();
      window.localStorage.setItem( 'finYear', $(this).val() );
      location.reload();
    });

    $.ajaxSetup({
        headers: {
            'finYear': window.localStorage.getItem( 'finYear' )
        },
        beforeSend: function (jqXHR, settings) {
            xhrPool.push(jqXHR);
        }
    });

    $('#finYearSet').val(window.localStorage.getItem( 'finYear' ));

    $('#financial_year').html('<option value="'+window.localStorage.getItem( 'finYear' )+'">'+window.localStorage.getItem( 'finYear' )+'</option>');
    $('#financial_year1').html('<option value="'+window.localStorage.getItem( 'finYear' )+'">'+window.localStorage.getItem( 'finYear' )+'</option>');
    if(window.localStorage.getItem('user_role') != 'super-admin'){
      $('.hidden-dept').hide();
    }
});

$(window).bind('beforeunload', function(){
  $('body').removeClass('loaded');
  // alert('Bye');

});

 // class="dashboard-redirect"
var fileArray = [];
fileArray['sidelist.html'] = '<div class="logo-img"><img src="assets/imgs/logo.gif" /><div class="logo-text">Outcome Budget</div></div><ul class="side-list">  <li>    <a href="dashboard.html"><span class="icon" w3-include-html="assets/icons/dash.html"></span><span class="text">GNCTD</span></a></li><li class="has-dropdown hidden-dept"><a href=""><span class="icon" w3-include-html="assets/icons/folder.html"></span><span class="text">Sectors</span></a><ul class="dropdown" id="sec_list_side"></ul>  </li><li class="has-dropdown hidden-dept"><a href=""><span class="icon" w3-include-html="assets/icons/folder.html"></span><span class="text">Departments</span></a><ul class="dropdown" id="dept_list_side"></ul>  </li><li class="has-dropdown  dadmin" id="schemes-menu"><a href=""><span class="icon" w3-include-html="assets/icons/scheme.html"></span><span class="text">Manage Schemes</span></a><ul class="dropdown"><li><a href="all-schemes.html">All Schemes</a></li><li><a href="assigned-actions.html">Assigned Actions</a></li><li><a href="add-establishment.html">Establishment Expenditure</a></li><li><a href="add-scheme-financials.html">Scheme Financials</a></li><li><a href="scheme-objectives-outputs.html">Scheme Outputs</a></li><li><a href="scheme-objectives-outputs-outcome.html">Scheme Outcomes</a></li><li><a href="add-targets.html">Add Targets</a></li><li><a href="add-achievements.html">Add Achievements</a></li></ul></li><li class="has-dropdown"><a href=""><span class="icon" w3-include-html="assets/icons/reports.html"></span><span class="text">Reports</span></a><ul class="dropdown"><li><a href="reports.html">Output Reports</a></li><li><a href="custom-reports.html">Custom Reports</a></li></ul></li><li class="has-dropdown  dadmin"><a href=""><span class="icon" w3-include-html="assets/icons/request.html"></span><span class="text">Requests</span></a><ul class="dropdown"><li class="superonly"><a href="respond-request.html">Respond to requests</a></li><li class="superonly"><a href="assign-departments.html">Assign Departments</a></li><li><a href="raise-request.html">Raise a request</a></li></ul></li><li class="has-dropdown" id="users-menu"><a href=""><span class="icon" w3-include-html="assets/icons/users.html"></span><span class="text">Users      </span></a><ul class="dropdown"><li><a href="all-users.html">All Users</a></li><li><a href="add-user.html">Add New Users</a></li></ul></li><li class="has-dropdown"><a href=""><span class="icon" w3-include-html="assets/icons/dash.html"></span><span class="text">Custom Dashboard</span></a><ul class="dropdown"><li><a href="my-dashboards.html">My Dashboards</a></li><li><a href="create-custom-dashboard.html">Create New</a></li></ul></li><li  class="dadmin"><a href="send-notification.html"><span class="icon" w3-include-html="assets/icons/sendmsg.html"></span><span class="text">Send Notifications</span></a></li><li  class="dadmin"><a href="upload-scheme-data.html"><span class="icon" w3-include-html="assets/icons/upload.html"></span><span class="text">Upload Scheme Data</span></a></li><!--<li><a href="compare-schemes.html"><span class="icon" w3-include-html="assets/icons/dash.html"></span><span class="text">Compare Schemes</span></a></li>--><li class="has-dropdown" id="masters-menu"><a href=""><span class="icon" w3-include-html="assets/icons/master.html"></span><span class="text">Master Data</span></a><ul class="dropdown"><li><a href="sectors.html">Sectors</a></li><li><a href="subsectors.html">Subsectors</a></li><li><a href="departments.html">Departments</a></li><li><a href="units.html">Units</a></li><li><a href="implementing_agency.html">Implementing Agency</a></li><li><a href="tags.html">Tags</a></li><li><a href="monitoringtype.html">Monitoring types</a></li><li><a href="eval_criteria.html">Evaluation Criteria</a></li><li><a href="wards.html">Wards</a></li><li><a href="districts.html">Districts</a></li><li><a href="vidhanshabhas.html">Vidhanshabhas</a></li><li class="superonly"><a href="add-scheme.html">Add Scheme</a></li></ul></li><li>    <a href="my-account.html"><span class="icon" w3-include-html="assets/icons/account.html"></span><span class="text">Change Password</span></a></li><li class="hidden-dept"><a href="audits.html"><span class="icon" w3-include-html="assets/icons/master.html"></span><span class="text">Audit Log</span></a></li></ul>';
fileArray['parts/head-nav-in.html'] = '<div class="row"><div class="col-md-4 col-xs-5 text-left" style="white-space: nowrap;"><a class="collappse-btn" id="collapseBtn" w3-include-html="assets/icons/menu.html"></a><select id="finYear"><option value="'+getCurrentFinancialYear()+'">'+getCurrentFinancialYear()+'</option><option value="'+getlastFinancialYear()+'">'+getlastFinancialYear()+'</option></select></div><audio id="chatAudio"><source src="assets/sounds/notify.mp3" type="audio/mpeg"></audio><div class="col-md-8 col-xs-7 text-right"><div class="head-btn-wrap"><a href="support.html" class="head-btn-alt"><span class="icon" w3-include-html="assets/icons/help.html"></span></a></div><div class="head-btn-wrap"><a class="head-btn"><span class="icon" w3-include-html="assets/icons/messages.html"></span><span class="count" id="notifyCount">0</span></a><ul class="dropdown" id="userMsgs"></ul></div><div class="head-btn-wrap"><a class="head-btn"><span class="icon" w3-include-html="assets/icons/hello.html"></span><span class="text user-name-head hidden-xs"></span></a><ul class="dropdown"><li><a href="my-account.html"><span class="icon" w3-include-html="assets/icons/account.html"></span><span class="text">My Account</span></a></li><li><a id="logout-adm"><span class="icon" w3-include-html="assets/icons/logout.html"></span><span class="text">Logout</span></a></li></ul></div></div></div>';
// fileArray['assets/icons/account.html'] = "hhg";
fileArray['assets/icons/account.html'] = '<svg id="Layer_1" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve"><g><g><path d="M456.566,58.504c-0.507-3.79-3.252-6.9-6.95-7.874L258.402,0.31c-1.574-0.414-3.228-0.414-4.802,0L62.386,50.63    c-3.698,0.974-6.443,4.082-6.95,7.874c-0.497,3.707-11.94,91.934,6.04,192.243c10.627,59.29,29.423,110.304,55.866,151.628    c33.367,52.145,78.95,88.844,135.48,109.075c1.028,0.367,2.103,0.552,3.179,0.552c1.076,0,2.151-0.184,3.179-0.552    c56.531-20.232,102.113-56.93,135.48-109.075c26.443-41.322,45.238-92.337,55.866-151.628    C468.505,150.437,457.061,62.211,456.566,58.504z M431.952,247.418c-10.19,56.843-28.083,105.556-53.186,144.785    C348.331,439.765,307.04,473.502,256,492.522c-50.971-18.993-92.215-52.662-122.637-100.119    c-25.103-39.16-43.014-87.791-53.234-144.54c-14.877-82.607-8.923-158.789-6.691-180.628L256,19.191l182.565,48.044    C440.798,89.012,446.748,164.866,431.952,247.418z"></path></g></g><g><g><path d="M256,98.124c-80.117,0-145.297,65.18-145.297,145.297S175.883,388.718,256,388.718s145.297-65.18,145.297-145.297    S336.117,98.124,256,98.124z M256,369.849c-37.385,0-71.027-16.316-94.193-42.195c7.633-17.027,19.681-31.613,35.127-42.408    c17.365-12.136,37.791-18.552,59.066-18.552s41.7,6.416,59.067,18.553c15.445,10.793,27.492,25.381,35.125,42.408    C327.026,353.533,293.385,369.849,256,369.849z M212.496,204.32c0-23.989,19.516-43.504,43.504-43.504    s43.504,19.515,43.504,43.504S279.987,247.824,256,247.824S212.496,228.309,212.496,204.32z M325.876,269.78    c-9.919-6.933-20.685-12.27-31.992-15.955c14.874-11.41,24.489-29.351,24.489-49.503c0-34.393-27.98-62.373-62.373-62.373    s-62.373,27.98-62.373,62.373c0,20.153,9.615,38.093,24.489,49.503c-11.308,3.686-22.074,9.024-31.993,15.956    c-15.456,10.801-28.033,24.823-37.011,41.087c-12.367-19.533-19.539-42.667-19.539-67.447    c0-69.713,56.715-126.428,126.428-126.428s126.427,56.715,126.427,126.428c0,24.78-7.172,47.914-19.54,67.447    C353.909,294.603,341.332,280.581,325.876,269.78z"></path></g></g></svg>';
fileArray['assets/icons/help.html']='<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512" height="512" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve" class="hovered-paths"><g><g><g id="help"><path d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z M280.5,433.5h-51v-51h51V433.5z     M334.05,237.15L311.1,260.1c-20.399,17.851-30.6,33.15-30.6,71.4h-51v-12.75c0-28.05,10.2-53.55,30.6-71.4L290.7,214.2    c10.2-7.65,15.3-20.4,15.3-35.7c0-28.05-22.95-51-51-51s-51,22.95-51,51h-51c0-56.1,45.9-102,102-102c56.1,0,102,45.9,102,102    C357,201.45,346.8,221.85,334.05,237.15z" data-original="#000000" class="hovered-path"></path></g></g></g></svg>';
fileArray['assets/icons/assign.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480.005 480.005" style="enable-background:new 0 0 480.005 480.005;" xml:space="preserve"> <g> <g> <path d="M472.005,256.003h-216c-4.418,0-8,3.582-8,8v66.494c-9.593-4.499-20.844-3.623-29.625,2.307l-42.375,28.25V224.003h48 c4.418,0,8-3.582,8-8v-208c0-4.418-3.582-8-8-8h-216c-4.418,0-8,3.582-8,8v208c0,4.418,3.582,8,8,8h112v18.691 c-4.411-2.095-9.296-2.995-14.164-2.609c-11.235,1.066-20.756,8.721-24.211,19.465c-13.302-7.489-30.156-2.776-37.645,10.525 c-0.977,1.736-1.764,3.573-2.347,5.478c-4.907-2.731-10.519-3.929-16.113-3.441c-14.772,1.764-25.805,14.434-25.52,29.309v130.254 c0,0.056,0.033,0.104,0.034,0.159c-0.001,0.059-0.034,0.109-0.034,0.169v40c0,4.418,3.582,8,8,8h160c4.418,0,8-3.582,8-8v-36.016 l72-53.988v90.004c0,4.418,3.582,8,8,8h216c4.418,0,8-3.582,8-8v-208C480.005,259.584,476.424,256.003,472.005,256.003z M16.005,208.003v-192h200v192h-40v-16c4.418,0,8-3.582,8-8v-144c0-4.418-3.582-8-8-8h-120c-4.418,0-8,3.582-8,8v144 c0,4.418,3.582,8,8,8h64v16H16.005z M168.005,48.003v112.466c-10.712-11.047-28.351-11.319-39.398-0.607 c-4.453,4.318-7.338,9.998-8.197,16.14H64.005v-128H168.005z M160.005,464.003h-144v-24h144V464.003z M243.594,365.249 c-0.268,0.24-0.547,0.467-0.834,0.683l0,0l-77.445,58.07H16.005V301.421c-0.245-6.566,4.425-12.291,10.906-13.371 c6.6-0.604,12.44,4.257,13.044,10.857c0.033,0.364,0.05,0.73,0.05,1.096v28h16v-42.582c-0.245-6.566,4.425-12.291,10.906-13.371 c6.6-0.604,12.44,4.257,13.044,10.857c0.033,0.364,0.05,0.73,0.05,1.096v36h16v-50.582c-0.258-6.62,4.494-12.379,11.043-13.383 c5.919-0.464,11.342,3.314,12.957,9.027v38.938h16v-124c0-6.627,5.373-12,12-12c6.627,0,12,5.373,12,12v196 c0,4.418,3.581,8,7.999,8c1.58,0,3.125-0.468,4.439-1.344l54.813-36.543c5.353-3.808,12.669-3.213,17.336,1.41l0.004,0.004 C249.212,352.699,248.763,360.632,243.594,365.249z M464.005,464.003h-200v-192h200V464.003z"></path> </g> </g> <g> <g> <path d="M472.005,0.003h-216c-4.418,0-8,3.582-8,8v208c0,4.418,3.582,8,8,8h216c4.418,0,8-3.582,8-8v-208 C480.005,3.584,476.424,0.003,472.005,0.003z M464.005,208.003h-200v-192h200V208.003z"></path> </g> </g> <g> <g> <rect x="80.005" y="64.003" width="72" height="16"></rect> </g> </g> <g> <g> <rect x="80.005" y="96.003" width="72" height="16"></rect> </g> </g> <g> <g> <path d="M391.152,85.978c12.203-12.783,11.733-33.039-1.05-45.243s-33.039-11.733-45.243,1.05 c-11.805,12.366-11.805,31.827,0,44.192c-15.318,8.438-24.839,24.536-24.854,42.025v56c0,4.418,3.582,8,8,8h80 c4.418,0,8-3.582,8-8v-56C415.991,110.514,406.47,94.416,391.152,85.978z M368.005,48.003c8.837,0,16,7.163,16,16s-7.163,16-16,16 s-16-7.163-16-16C352.014,55.17,359.173,48.011,368.005,48.003z M400.005,176.003h-64v-48c0-17.673,14.327-32,32-32 c17.673,0,32,14.327,32,32V176.003z"></path> </g> </g> <g> <g> <path d="M368.005,296.003c-39.764,0-72,32.235-72,72c0.046,39.745,32.255,71.954,72,72c39.765,0,72-32.236,72-72 C440.005,328.238,407.77,296.003,368.005,296.003z M368.005,312.003c14.633-0.003,28.681,5.743,39.117,16h-78.234 C339.324,317.746,353.373,312,368.005,312.003z M317.485,344.003h101.04c2.413,5.058,4.045,10.453,4.841,16H312.644 C313.44,354.455,315.072,349.061,317.485,344.003z M368.005,424.003c-14.633,0.003-28.681-5.743-39.117-16h78.234 C396.686,418.26,382.638,424.006,368.005,424.003z M418.525,392.003h-101.04c-2.413-5.058-4.045-10.453-4.841-16h110.723 C422.571,381.55,420.938,386.945,418.525,392.003z"></path> </g> </g> <g> <g> <rect x="80.005" y="128.003" width="48" height="16"></rect> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/hello.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 299.997 299.997" style="enable-background:new 0 0 299.997 299.997;" xml:space="preserve"><g><g><path d="M149.996,0C67.157,0,0.001,67.158,0.001,149.997c0,82.837,67.156,150,149.995,150s150-67.163,150-150    C299.996,67.156,232.835,0,149.996,0z M150.453,220.763v-0.002h-0.916H85.465c0-46.856,41.152-46.845,50.284-59.097l1.045-5.587    c-12.83-6.502-21.887-22.178-21.887-40.512c0-24.154,15.712-43.738,35.089-43.738c19.377,0,35.089,19.584,35.089,43.738    c0,18.178-8.896,33.756-21.555,40.361l1.19,6.349c10.019,11.658,49.802,12.418,49.802,58.488H150.453z"></path></g></g></svg>';
fileArray['assets/icons/back.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="511.63px" height="511.631px" viewBox="0 0 511.63 511.631" style="enable-background:new 0 0 511.63 511.631;" xml:space="preserve"> <g> <path d="M496.5,233.842c-30.841-76.706-114.112-115.06-249.823-115.06h-63.953V45.693c0-4.952-1.809-9.235-5.424-12.85 c-3.617-3.617-7.896-5.426-12.847-5.426c-4.952,0-9.235,1.809-12.85,5.426L5.424,179.021C1.809,182.641,0,186.922,0,191.871 c0,4.948,1.809,9.229,5.424,12.847L151.604,350.9c3.619,3.613,7.902,5.428,12.85,5.428c4.947,0,9.229-1.814,12.847-5.428 c3.616-3.614,5.424-7.898,5.424-12.848v-73.094h63.953c18.649,0,35.349,0.568,50.099,1.708c14.749,1.143,29.413,3.189,43.968,6.143 c14.564,2.95,27.224,6.991,37.979,12.135c10.753,5.144,20.794,11.756,30.122,19.842c9.329,8.094,16.943,17.7,22.847,28.839 c5.896,11.136,10.513,24.311,13.846,39.539c3.326,15.229,4.997,32.456,4.997,51.675c0,10.466-0.479,22.176-1.428,35.118 c0,1.137-0.236,3.375-0.715,6.708c-0.473,3.333-0.712,5.852-0.712,7.562c0,2.851,0.808,5.232,2.423,7.136 c1.622,1.902,3.86,2.851,6.714,2.851c3.046,0,5.708-1.615,7.994-4.853c1.328-1.711,2.561-3.806,3.71-6.283 c1.143-2.471,2.43-5.325,3.854-8.562c1.431-3.237,2.43-5.513,2.998-6.848c24.17-54.238,36.258-97.158,36.258-128.756 C511.63,291.039,506.589,259.344,496.5,233.842z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/close.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 212.982 212.982" style="enable-background:new 0 0 212.982 212.982;" xml:space="preserve"> <g id="Close"> <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M131.804,106.491l75.936-75.936c6.99-6.99,6.99-18.323,0-25.312 c-6.99-6.99-18.322-6.99-25.312,0l-75.937,75.937L30.554,5.242c-6.99-6.99-18.322-6.99-25.312,0c-6.989,6.99-6.989,18.323,0,25.312 l75.937,75.936L5.242,182.427c-6.989,6.99-6.989,18.323,0,25.312c6.99,6.99,18.322,6.99,25.312,0l75.937-75.937l75.937,75.937 c6.989,6.99,18.322,6.99,25.312,0c6.99-6.99,6.99-18.322,0-25.312L131.804,106.491z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/dash.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="93.416px" height="93.416px" viewBox="0 0 93.416 93.416" style="enable-background:new 0 0 93.416 93.416;" xml:space="preserve"> <g> <polygon points="88.424,85.531 88.424,30.732 72.006,30.732 72.006,85.531 60.689,85.531 60.689,1.164 44.272,1.164 44.272,85.531 33.558,85.531 33.558,30.732 17.14,30.732 17.14,85.531 7.885,85.531 7.885,0 0,0 0,93.416 93.416,93.416 93.416,85.531 "></polygon> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/dots.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <g> <circle cx="256" cy="256" r="64"></circle> <circle cx="256" cy="448" r="64"></circle> <circle cx="256" cy="64" r="64"></circle> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/estimate.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="612.004px" height="612.004px" viewBox="0 0 612.004 612.004" style="enable-background:new 0 0 612.004 612.004;" xml:space="preserve"> <g> <path d="M611.308,298.217c-2.844-10.286-13.484-16.326-23.782-13.509l-61.653,16.983c9.355-2.948,14.886-12.711,12.226-22.236 l-23.05-83.444l11.897-3.262c0.039-0.027,0.092-0.027,0.092-0.027c9.775-2.699,15.515-12.776,12.842-22.552 c-1.795-6.355-6.695-11.008-12.605-12.75l-147.82-57.84c-7.587-2.974-16.169-0.589-21.175,5.845l-39.338,50.737l-2.215-8.164 c-2.687-9.737-12.804-15.488-22.577-12.789l-16.341,4.509c-9.749,2.699-15.475,12.803-12.735,22.552l12.88,46.845l-17.821,23.009 c-4.849,6.238-5.149,14.898-0.747,21.451c4.375,6.552,12.513,9.553,20.114,7.456l11.858-3.276l23.089,83.391 c2.581,9.383,12.043,14.832,21.425,12.869l-222.802,61.375c4.574-4.18,6.828-10.6,5.072-16.982l-3.368-12.227 c29.588-12.238,45.129-36.402,36.755-66.828l-0.117-0.498c-8.307-30.047-31.526-37.187-69.029-36.689 c-31.934,0.577-40.321-1.087-43.464-12.409l-0.145-0.512c-2.281-8.374,3.511-17.14,18.056-21.136 c11.847-3.276,24.845-2.32,39.48,1.611c3.407,0.904,6.618,1.087,10.326,0.065c9.854-2.699,15.686-12.554,12.973-22.393 c-2.057-7.403-7.705-11.453-12.579-12.724c-12.75-3.931-26.3-5.11-40.478-3.617l-3.578-12.946 c-2.515-9.107-11.846-14.427-20.965-11.912c-9.042,2.489-14.362,11.846-11.846,20.953l3.537,12.854 C7.873,232.513-5.324,256.413,2.014,283.106l0.145,0.498c9.447,34.278,34.527,37.712,71.729,36.991 c30.872-0.523,38.158,2.752,40.818,12.371l0.145,0.484c2.778,10.104-4.888,18.844-20.429,23.143 c-16.759,4.625-32.681,2.633-48.444-3.354c-2.909-1.076-6.813-1.809-11.781-0.473c-9.841,2.727-15.645,12.514-12.919,22.395 c1.624,5.91,6.079,10.533,11.112,12.303c15.985,5.883,32.812,7.77,49.19,6.42l3.735,13.562c1.756,6.395,6.971,10.744,13.052,11.988 L23.1,440.178c-10.286,2.844-16.326,13.484-13.497,23.783c2.844,10.299,13.47,16.34,23.771,13.508l212.305-58.48l-67.379,67.381 c-4.573,4.586-5.948,11.465-3.472,17.455c2.464,5.963,8.321,9.867,14.78,9.867l184.826-0.012c6.461,0,12.317-3.904,14.78-9.867 c2.477-5.988,1.102-12.869-3.473-17.455l-83.077-83.076L597.782,322C608.084,319.182,614.137,308.529,611.308,298.217z M362.274,261.697l29.981-8.256c6.553-1.808,13.353,2.07,15.162,8.623l8.268,29.982c1.795,6.577-2.044,13.352-8.623,15.161 l-29.994,8.256c-6.564,1.822-13.352-2.031-15.188-8.623l-8.229-29.967C351.817,270.318,355.695,263.504,362.274,261.697z M471.519,244.414l8.229,29.967c1.821,6.577-2.057,13.378-8.623,15.174l-29.982,8.256c-6.564,1.807-13.366-2.044-15.173-8.623 l-8.256-29.982c-1.796-6.553,2.044-13.366,8.623-15.174l29.994-8.256C462.883,233.996,469.685,237.847,471.519,244.414z M408.947,180.966l29.994-8.256c6.565-1.808,13.353,2.044,15.174,8.609l8.241,29.982c1.808,6.552-2.056,13.366-8.623,15.173 l-29.968,8.256c-6.564,1.808-13.365-2.044-15.161-8.623l-8.268-29.994C398.544,189.562,402.383,182.761,408.947,180.966z M344.886,198.604l29.981-8.256c6.564-1.807,13.366,2.044,15.174,8.609l8.256,29.982c1.808,6.579-2.044,13.366-8.597,15.188 l-29.994,8.241c-6.579,1.808-13.378-2.044-15.188-8.608l-8.256-29.994C334.44,207.212,338.307,200.423,344.886,198.604z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/expend.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480.003 480.003" style="enable-background:new 0 0 480.003 480.003;" xml:space="preserve"> <g> <g> <path d="M376,136.001c-17.648,0-32-14.352-32-32c0-4.424-3.576-8-8-8H80c-4.424,0-8,3.576-8,8c0,17.648-14.352,32-32,32 c-4.424,0-8,3.576-8,8v64c0,4.424,3.576,8,8,8c17.648,0,32,14.352,32,32c0,4.424,3.576,8,8,8h256c4.424,0,8-3.576,8-8 c0-17.648,14.352-32,32-32c4.424,0,8-3.576,8-8v-64C384,139.577,380.424,136.001,376,136.001z M368,200.665 c-20.072,3.384-35.952,19.264-39.336,39.336H87.336C83.952,219.929,68.072,204.049,48,200.665v-49.328 c20.072-3.384,35.952-19.264,39.336-39.336h241.328c3.384,20.072,19.264,35.952,39.336,39.336V200.665z"></path> </g> </g> <g> <g> <path d="M208,136.001c-22.056,0-40,17.944-40,40c0,22.056,17.944,40,40,40c22.056,0,40-17.944,40-40 C248,153.945,230.056,136.001,208,136.001z M208,200.001c-13.232,0-24-10.768-24-24s10.768-24,24-24s24,10.768,24,24 S221.232,200.001,208,200.001z"></path> </g> </g> <g> <g> <path d="M472,0.001H72c-4.424,0-8,3.576-8,8v24H40c-4.424,0-8,3.576-8,8v24H8c-4.424,0-8,3.576-8,8v208c0,4.424,3.576,8,8,8h400 c4.424,0,8-3.576,8-8v-24h24c4.424,0,8-3.576,8-8v-24h24c4.424,0,8-3.576,8-8v-208C480,3.577,476.424,0.001,472,0.001z M400,248.001v24H16v-192h24h360V248.001z M432,240.001h-16v-168c0-4.424-3.576-8-8-8H48v-16h384V240.001z M464,208.001h-16v-168 c0-4.424-3.576-8-8-8H80v-16h384V208.001z"></path> </g> </g> <g> <g> <path d="M476.8,385.609l-96-72.008c-2.416-1.832-5.672-2.112-8.376-0.76c-2.712,1.36-4.424,4.128-4.424,7.16v32H240 c-4.424,0-8,3.576-8,8v64c0,4.424,3.576,8,8,8h128v40c0,3.104,1.8,5.928,4.608,7.24c1.08,0.512,2.232,0.76,3.392,0.76 c1.832,0,3.656-0.632,5.128-1.848l96-80c1.872-1.568,2.936-3.904,2.872-6.352C479.936,389.353,478.76,387.073,476.8,385.609z M384,454.921v-30.92c0-4.424-3.576-8-8-8H248v-48h128c4.424,0,8-3.576,8-8v-24l75.112,56.328L384,454.921z"></path> </g> </g> <g> <g> <path d="M208,352.001h-32c-4.424,0-8,3.576-8,8v64c0,4.424,3.576,8,8,8h32c4.424,0,8-3.576,8-8v-64 C216,355.577,212.424,352.001,208,352.001z M200,416.001h-16v-48h16V416.001z"></path> </g> </g> <g> <g> <path d="M128,352.001H96c-4.424,0-8,3.576-8,8v64c0,4.424,3.576,8,8,8h32c4.424,0,8-3.576,8-8v-64 C136,355.577,132.424,352.001,128,352.001z M120,416.001h-16v-48h16V416.001z"></path> </g> </g> <g> <g> <path d="M40,352.001H8c-4.424,0-8,3.576-8,8v64c0,4.424,3.576,8,8,8h32c4.424,0,8-3.576,8-8v-64 C48,355.577,44.424,352.001,40,352.001z M32,416.001H16v-48h16V416.001z"></path> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/folder.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve"> <g> <path d="M56.981,11.5H28.019V6.52c0-1.665-1.354-3.02-3.019-3.02H3.019C1.354,3.5,0,4.854,0,6.52V20.5h60v-5.98 C60,12.854,58.646,11.5,56.981,11.5z"></path> <path d="M0,53.48c0,1.665,1.354,3.02,3.019,3.02h53.962c1.665,0,3.019-1.354,3.019-3.02V22.5H0V53.48z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/indicators.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 483.72 483.72" style="enable-background:new 0 0 483.72 483.72;" xml:space="preserve"> <g> <path d="M257.85,174.498v-69.529c0-8.857-7.17-16.029-16.027-16.029c-8.859,0-16.029,7.172-16.029,16.029v69.529 c3.897-4.695,9.566-7.842,16.029-7.842C248.287,166.656,253.951,169.802,257.85,174.498z"></path> <path d="M184.031,128.371c-3.021-8.33-12.256-12.588-20.538-9.582c-8.327,3.023-12.614,12.227-9.579,20.537l19.629,53.957 c2.365,6.51,8.516,10.549,15.057,10.549c1.816,0,3.68-0.314,5.48-0.971c8.327-3.021,12.615-12.225,9.58-20.537L184.031,128.371z"></path> <path d="M117.193,160.537c-5.683-6.779-15.778-7.654-22.587-1.988c-6.776,5.697-7.671,15.809-1.989,22.586l36.895,43.984 c3.178,3.789,7.717,5.73,12.305,5.73c3.631,0,7.279-1.238,10.284-3.742c6.776-5.697,7.669-15.809,1.987-22.588L117.193,160.537z"></path> <path d="M115.08,242.337L65.369,213.63c-7.656-4.447-17.471-1.814-21.9,5.869c-4.43,7.67-1.799,17.469,5.869,21.9l49.713,28.705 c2.521,1.457,5.276,2.145,8.002,2.145c5.539,0,10.924-2.863,13.897-8.014C125.381,256.566,122.749,246.769,115.08,242.337z"></path> <path d="M29.271,312.808l56.539,9.984c0.939,0.172,1.877,0.25,2.799,0.25c7.641,0,14.402-5.463,15.765-13.242 c1.551-8.719-4.273-17.029-12.991-18.565l-56.539-9.984c-8.688-1.6-17.047,4.271-18.565,12.99 C14.73,302.959,20.553,311.271,29.271,312.808z"></path> <path d="M467.69,345.017h-72.581c-8.859,0-16.029,7.172-16.029,16.031c0,8.861,7.17,16.029,16.029,16.029h72.581 c8.86,0,16.029-7.168,16.029-16.029C483.72,352.189,476.551,345.017,467.69,345.017z"></path> <path d="M88.609,345.017H16.031C7.171,345.017,0,352.189,0,361.048c0,8.861,7.171,16.029,16.031,16.029h72.578 c8.861,0,16.032-7.168,16.032-16.029C104.642,352.189,97.471,345.017,88.609,345.017z"></path> <path d="M379.33,309.769c1.362,7.762,8.125,13.242,15.762,13.242c0.928,0,1.85-0.078,2.803-0.25l56.553-9.953 c8.723-1.537,14.545-9.85,12.994-18.566c-1.533-8.703-9.703-14.59-18.565-12.99l-56.553,9.953 C383.604,292.738,377.783,301.05,379.33,309.769z"></path> <path d="M434.366,241.382c7.671-4.43,10.302-14.227,5.87-21.896c-4.444-7.656-14.275-10.303-21.897-5.871l-49.729,28.693 c-7.668,4.428-10.301,14.226-5.869,21.896c2.971,5.135,8.357,8.014,13.899,8.014c2.724,0,5.478-0.689,7.997-2.143L434.366,241.382z "></path> <path d="M389.084,158.533c-6.794-5.699-16.906-4.805-22.572,1.971l-36.908,43.986c-5.697,6.777-4.807,16.891,1.974,22.57 c3.005,2.521,6.649,3.758,10.281,3.758c4.586,0,9.126-1.941,12.288-5.73l36.909-43.982 C396.754,174.326,395.861,164.214,389.084,158.533z"></path> <path d="M320.179,118.742c-8.278-3.021-17.517,1.27-20.536,9.582l-19.643,53.953c-3.038,8.311,1.249,17.516,9.581,20.537 c1.797,0.656,3.662,0.971,5.476,0.971c6.543,0,12.696-4.039,15.058-10.551l19.645-53.955 C332.795,130.966,328.507,121.765,320.179,118.742z"></path> <path d="M273.392,325.437L246.799,186.8c-0.455-2.395-2.551-4.115-4.977-4.115c-2.443,0-4.525,1.721-4.979,4.115l-26.609,138.654 c8.453-7.498,19.441-12.197,31.588-12.197S264.956,317.957,273.392,325.437z"></path> <path d="M241.822,327.33c-18.645,0-33.732,15.092-33.732,33.719c0,18.643,15.088,33.732,33.732,33.732 c18.625,0,33.715-15.09,33.715-33.732C275.537,342.421,260.447,327.33,241.822,327.33z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/logout.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve"> <g id="XMLID_2_"> <path id="XMLID_4_" d="M51.213,180h173.785c8.284,0,15-6.716,15-15s-6.716-15-15-15H51.213l19.394-19.393 c5.858-5.857,5.858-15.355,0-21.213c-5.856-5.858-15.354-5.858-21.213,0L4.397,154.391c-0.348,0.347-0.676,0.71-0.988,1.09 c-0.076,0.093-0.141,0.193-0.215,0.288c-0.229,0.291-0.454,0.583-0.66,0.891c-0.06,0.09-0.109,0.185-0.168,0.276 c-0.206,0.322-0.408,0.647-0.59,0.986c-0.035,0.067-0.064,0.138-0.099,0.205c-0.189,0.367-0.371,0.739-0.53,1.123 c-0.02,0.047-0.034,0.097-0.053,0.145c-0.163,0.404-0.314,0.813-0.442,1.234c-0.017,0.053-0.026,0.108-0.041,0.162 c-0.121,0.413-0.232,0.83-0.317,1.257c-0.025,0.127-0.036,0.258-0.059,0.386c-0.062,0.354-0.124,0.708-0.159,1.069 C0.025,163.998,0,164.498,0,165s0.025,1.002,0.076,1.498c0.035,0.366,0.099,0.723,0.16,1.08c0.022,0.124,0.033,0.251,0.058,0.374 c0.086,0.431,0.196,0.852,0.318,1.269c0.015,0.049,0.024,0.101,0.039,0.15c0.129,0.423,0.28,0.836,0.445,1.244 c0.018,0.044,0.031,0.091,0.05,0.135c0.16,0.387,0.343,0.761,0.534,1.13c0.033,0.065,0.061,0.133,0.095,0.198 c0.184,0.341,0.387,0.669,0.596,0.994c0.056,0.088,0.104,0.181,0.162,0.267c0.207,0.309,0.434,0.603,0.662,0.895 c0.073,0.094,0.138,0.193,0.213,0.285c0.313,0.379,0.641,0.743,0.988,1.09l44.997,44.997C52.322,223.536,56.161,225,60,225 s7.678-1.464,10.606-4.394c5.858-5.858,5.858-15.355,0-21.213L51.213,180z"></path> <path id="XMLID_5_" d="M207.299,42.299c-40.944,0-79.038,20.312-101.903,54.333c-4.62,6.875-2.792,16.195,4.083,20.816 c6.876,4.62,16.195,2.794,20.817-4.083c17.281-25.715,46.067-41.067,77.003-41.067C258.414,72.299,300,113.884,300,165 s-41.586,92.701-92.701,92.701c-30.845,0-59.584-15.283-76.878-40.881c-4.639-6.865-13.961-8.669-20.827-4.032 c-6.864,4.638-8.67,13.962-4.032,20.826c22.881,33.868,60.913,54.087,101.737,54.087C274.956,287.701,330,232.658,330,165 S274.956,42.299,207.299,42.299z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/master.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58.201 58.201" style="enable-background:new 0 0 58.201 58.201;" xml:space="preserve" width="512" height="512" class="hovered-paths"><g><g><path d="M31.707,33.07c-0.87,0.027-1.74,0.042-2.606,0.042c-0.869,0-1.742-0.014-2.614-0.042   c-7.341-0.201-13.191-1.238-17.403-2.717C7.104,29.685,5.409,28.899,4.1,28v7.111v0.5v0.5V37.4c2.846,2.971,12.394,5.711,25,5.711   s22.154-2.74,25-5.711v-1.289v-0.5v-0.5V28c-1.318,0.905-3.028,1.697-5.025,2.367C44.865,31.839,39.027,32.87,31.707,33.07z" data-original="#000000" class="hovered-path"></path><path d="M4.1,14.889V22v0.5V23v1.289c2.638,2.754,11.033,5.31,22.286,5.668c0.115,0.004,0.233,0.005,0.349,0.008   c0.326,0.009,0.651,0.018,0.982,0.023C28.174,29.996,28.635,30,29.1,30s0.926-0.004,1.383-0.011   c0.33-0.005,0.656-0.014,0.982-0.023c0.116-0.003,0.234-0.005,0.349-0.008c11.253-0.359,19.648-2.915,22.286-5.668V23v-0.5V22   v-7.111C49.233,18.232,38.944,20,29.1,20S8.968,18.232,4.1,14.889z" data-original="#000000" class="hovered-path"></path><path d="M53.965,8.542C52.843,4.241,44.215,0,29.1,0C14.023,0,5.404,4.22,4.247,8.51C4.162,8.657,4.1,8.818,4.1,9v0.5v1.806   C6.937,14.267,16.417,17,29.1,17s22.164-2.733,25-5.694V9.5V9C54.1,8.832,54.044,8.681,53.965,8.542z" data-original="#000000" class="hovered-path"></path><path d="M4.1,41v8.201c0,0.162,0.043,0.315,0.117,0.451c1.181,4.895,11.747,8.549,24.883,8.549c13.106,0,23.655-3.639,24.875-8.516   c0.08-0.144,0.125-0.309,0.125-0.484v-8.199c-4.135,2.911-12.655,5.199-25,5.199C16.754,46.201,8.234,43.911,4.1,41z" data-original="#000000" class="hovered-path"></path></g></g> </svg>';
fileArray['assets/icons/menu.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 53 53" style="enable-background:new 0 0 53 53;" xml:space="preserve"> <g> <g> <path d="M2,13.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,13.5,2,13.5z"></path> <path d="M2,28.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,28.5,2,28.5z"></path> <path d="M2,43.5h49c1.104,0,2-0.896,2-2s-0.896-2-2-2H2c-1.104,0-2,0.896-2,2S0.896,43.5,2,43.5z"></path> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/messages.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 14 14" style="enable-background:new 0 0 14 14;" xml:space="preserve"> <g> <g> <path d="M7,9L5.268,7.484l-4.952,4.245C0.496,11.896,0.739,12,1.007,12h11.986 c0.267,0,0.509-0.104,0.688-0.271L8.732,7.484L7,9z"></path> <path d="M13.684,2.271C13.504,2.103,13.262,2,12.993,2H1.007C0.74,2,0.498,2.104,0.318,2.273L7,8 L13.684,2.271z"></path> <polygon points="0,2.878 0,11.186 4.833,7.079 "></polygon> <polygon points="9.167,7.079 14,11.186 14,2.875 "></polygon> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/na.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 486.463 486.463" style="enable-background:new 0 0 486.463 486.463;" xml:space="preserve"> <g> <g> <path d="M243.225,333.382c-13.6,0-25,11.4-25,25s11.4,25,25,25c13.1,0,25-11.4,24.4-24.4 C268.225,344.682,256.925,333.382,243.225,333.382z"></path> <path d="M474.625,421.982c15.7-27.1,15.8-59.4,0.2-86.4l-156.6-271.2c-15.5-27.3-43.5-43.5-74.9-43.5s-59.4,16.3-74.9,43.4 l-156.8,271.5c-15.6,27.3-15.5,59.8,0.3,86.9c15.6,26.8,43.5,42.9,74.7,42.9h312.8 C430.725,465.582,458.825,449.282,474.625,421.982z M440.625,402.382c-8.7,15-24.1,23.9-41.3,23.9h-312.8 c-17,0-32.3-8.7-40.8-23.4c-8.6-14.9-8.7-32.7-0.1-47.7l156.8-271.4c8.5-14.9,23.7-23.7,40.9-23.7c17.1,0,32.4,8.9,40.9,23.8 l156.7,271.4C449.325,369.882,449.225,387.482,440.625,402.382z"></path> <path d="M237.025,157.882c-11.9,3.4-19.3,14.2-19.3,27.3c0.6,7.9,1.1,15.9,1.7,23.8c1.7,30.1,3.4,59.6,5.1,89.7 c0.6,10.2,8.5,17.6,18.7,17.6c10.2,0,18.2-7.9,18.7-18.2c0-6.2,0-11.9,0.6-18.2c1.1-19.3,2.3-38.6,3.4-57.9 c0.6-12.5,1.7-25,2.3-37.5c0-4.5-0.6-8.5-2.3-12.5C260.825,160.782,248.925,155.082,237.025,157.882z"></path> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/offtrack.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9" enable-background="new 0 0 21.9 21.9"> <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0 c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4 s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3 s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7 s-0.1-0.5-0.3-0.7L14.1,11.3z"></path> </svg>';
fileArray['assets/icons/ontrack.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 26 26" enable-background="new 0 0 26 26"> <path d="m.3,14c-0.2-0.2-0.3-0.5-0.3-0.7s0.1-0.5 0.3-0.7l1.4-1.4c0.4-0.4 1-0.4 1.4,0l.1,.1 5.5,5.9c0.2,0.2 0.5,0.2 0.7,0l13.4-13.9h0.1v-8.88178e-16c0.4-0.4 1-0.4 1.4,0l1.4,1.4c0.4,0.4 0.4,1 0,1.4l0,0-16,16.6c-0.2,0.2-0.4,0.3-0.7,0.3-0.3,0-0.5-0.1-0.7-0.3l-7.8-8.4-.2-.3z"></path> </svg>';
fileArray['assets/icons/percent.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.003 512.003" style="enable-background:new 0 0 512.003 512.003;" xml:space="preserve"> <g> <g> <path d="M477.958,262.633c-2.06-4.215-2.06-9.049,0-13.263l19.096-39.065c10.632-21.751,2.208-47.676-19.178-59.023l-38.41-20.38 c-4.144-2.198-6.985-6.11-7.796-10.729l-7.512-42.829c-4.183-23.846-26.241-39.87-50.208-36.479l-43.053,6.09 c-4.647,0.656-9.242-0.838-12.613-4.099l-31.251-30.232c-17.401-16.834-44.661-16.835-62.061,0L193.72,42.859 c-3.372,3.262-7.967,4.753-12.613,4.099l-43.053-6.09c-23.975-3.393-46.025,12.633-50.208,36.479l-7.512,42.827 c-0.811,4.62-3.652,8.531-7.795,10.73l-38.41,20.38c-21.386,11.346-29.81,37.273-19.178,59.024l19.095,39.064 c2.06,4.215,2.06,9.049,0,13.263l-19.096,39.064c-10.632,21.751-2.208,47.676,19.178,59.023l38.41,20.38 c4.144,2.198,6.985,6.11,7.796,10.729l7.512,42.829c3.808,21.708,22.422,36.932,43.815,36.93c2.107,0,4.245-0.148,6.394-0.452 l43.053-6.09c4.643-0.659,9.241,0.838,12.613,4.099l31.251,30.232c8.702,8.418,19.864,12.626,31.03,12.625 c11.163-0.001,22.332-4.209,31.03-12.625l31.252-30.232c3.372-3.261,7.968-4.751,12.613-4.099l43.053,6.09 c23.978,3.392,46.025-12.633,50.208-36.479l7.513-42.827c0.811-4.62,3.652-8.531,7.795-10.73l38.41-20.38 c21.386-11.346,29.81-37.273,19.178-59.024L477.958,262.633z M464.035,334.635l-38.41,20.38 c-12.246,6.499-20.645,18.057-23.04,31.713l-7.512,42.828c-1.415,8.068-8.874,13.487-16.987,12.342l-43.053-6.09 c-13.73-1.945-27.316,2.474-37.281,12.113L266.5,478.152c-5.886,5.694-15.109,5.694-20.997,0l-31.251-30.232 c-8.422-8.147-19.432-12.562-30.926-12.562c-2.106,0-4.229,0.148-6.355,0.449l-43.053,6.09 c-8.106,1.146-15.571-4.274-16.987-12.342l-7.513-42.829c-2.396-13.656-10.794-25.215-23.041-31.712l-38.41-20.38 c-7.236-3.839-10.086-12.61-6.489-19.969l19.096-39.065c6.088-12.456,6.088-26.742,0-39.198l-19.096-39.065 c-3.597-7.359-0.747-16.13,6.489-19.969l38.41-20.38c12.246-6.499,20.645-18.057,23.04-31.713l7.512-42.828 c1.416-8.068,8.874-13.488,16.987-12.342l43.053,6.09c13.725,1.943,27.316-2.474,37.281-12.113l31.252-30.232 c5.886-5.694,15.109-5.694,20.997,0l31.251,30.232c9.965,9.64,23.554,14.056,37.281,12.113l43.053-6.09 c8.107-1.147,15.572,4.274,16.987,12.342l7.512,42.829c2.396,13.656,10.794,25.215,23.041,31.712l38.41,20.38 c7.236,3.839,10.086,12.61,6.489,19.969l-19.096,39.064c-6.088,12.455-6.088,26.743,0,39.198l19.096,39.064 C474.121,322.024,471.271,330.796,464.035,334.635z"></path> </g> </g> <g> <g> <path d="M363.886,148.116c-5.765-5.766-15.115-5.766-20.881,0L148.116,343.006c-5.766,5.766-5.766,15.115,0,20.881 c2.883,2.883,6.662,4.325,10.44,4.325c3.778,0,7.558-1.441,10.44-4.325l194.889-194.889 C369.653,163.231,369.653,153.883,363.886,148.116z"></path> </g> </g> <g> <g> <path d="M196.941,123.116c-29.852,0-54.139,24.287-54.139,54.139s24.287,54.139,54.139,54.139s54.139-24.287,54.139-54.139 S226.793,123.116,196.941,123.116z M196.941,201.863c-13.569,0-24.608-11.039-24.608-24.609c0-13.569,11.039-24.608,24.608-24.608 c13.569,0,24.609,11.039,24.609,24.608C221.549,190.824,210.51,201.863,196.941,201.863z"></path> </g> </g> <g> <g> <path d="M315.061,280.61c-29.852,0-54.139,24.287-54.139,54.139s24.287,54.139,54.139,54.139 c29.852,0,54.139-24.287,54.139-54.139S344.913,280.61,315.061,280.61z M315.061,359.357c-13.569,0-24.609-11.039-24.609-24.608 s11.039-24.608,24.609-24.608c13.569,0,24.608,11.039,24.608,24.608S328.63,359.357,315.061,359.357z"></path> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/progress.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 24.547 24.547" style="enable-background:new 0 0 24.547 24.547;" xml:space="preserve"> <g> <path d="M5.285,24.082c-0.111,0-0.217-0.041-0.298-0.12l-4.866-4.879c-0.161-0.159-0.161-0.422,0-0.585 l4.866-4.885c0.119-0.117,0.298-0.155,0.454-0.089c0.156,0.06,0.256,0.215,0.256,0.384v3.021h13.335c0.369,0,0.67-0.301,0.67-0.668 v-3.4c0-0.111,0.043-0.216,0.119-0.295l3.256-3.269c0.118-0.118,0.3-0.156,0.454-0.091c0.157,0.066,0.258,0.22,0.258,0.386v7.391 c0,2.64-1.395,4.034-4.033,4.034H5.698v2.652c0,0.167-0.1,0.318-0.256,0.38C5.392,24.07,5.335,24.082,5.285,24.082z"></path> <path d="M1.171,15.378c-0.055,0-0.108-0.012-0.159-0.033c-0.156-0.063-0.258-0.213-0.258-0.383v-7.39 c0-2.641,1.392-4.033,4.033-4.033h14.064V0.88c0-0.165,0.101-0.317,0.256-0.385c0.158-0.061,0.335-0.031,0.455,0.092l4.864,4.875 c0.162,0.162,0.162,0.427,0,0.588l-4.864,4.882c-0.119,0.121-0.296,0.158-0.454,0.091c-0.155-0.063-0.256-0.216-0.256-0.386V7.623 H5.508c-0.367,0-0.664,0.3-0.664,0.669v3.401c0,0.11-0.043,0.213-0.124,0.296l-3.258,3.265C1.385,15.334,1.281,15.378,1.171,15.378 z"></path> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/reports.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 297.001 297.001" style="enable-background:new 0 0 297.001 297.001;" xml:space="preserve"> <g> <g> <g> <path d="M181.951,221.679c-2.128,0-4.168-0.845-5.674-2.35l-28.712-28.712c-4.43,6.591-7.02,14.517-7.02,23.039 c0,22.831,18.574,41.405,41.405,41.405c20.087,0,36.871-14.378,40.619-33.382L181.951,221.679L181.951,221.679z"></path> <path d="M181.951,172.251c-8.521,0-16.447,2.589-23.038,7.02l26.361,26.362h37.296 C218.824,186.629,202.039,172.251,181.951,172.251z"></path> <path d="M247.253,32.953h-33.063v9.721c0,12.809-10.421,23.23-23.23,23.23h-84.919c-12.809,0-23.23-10.421-23.23-23.23v-9.721 H49.748c-4.719,0-8.557,3.838-8.557,8.556v246.935c0,4.719,3.838,8.557,8.557,8.557h197.506c4.719,0,8.557-3.838,8.557-8.557 V41.509C255.811,36.791,251.972,32.953,247.253,32.953z M66.12,90.3h82.38c4.431,0,8.023,3.592,8.023,8.023 c0,4.431-3.592,8.023-8.023,8.023H66.12c-4.431,0-8.023-3.592-8.023-8.023C58.097,93.892,61.69,90.3,66.12,90.3z M115.548,172.25 H66.12c-4.431,0-8.023-3.592-8.023-8.023c0-4.431,3.592-8.023,8.023-8.023h49.428c4.431,0,8.023,3.592,8.023,8.023 C123.571,168.658,119.979,172.25,115.548,172.25z M115.548,139.298H66.12c-4.431,0-8.023-3.592-8.023-8.023 c0-4.431,3.592-8.023,8.023-8.023h49.428c4.431,0,8.023,3.592,8.023,8.023C123.571,135.705,119.979,139.298,115.548,139.298z M181.951,271.107c-31.678,0-57.451-25.773-57.451-57.451c0-31.679,25.773-57.452,57.451-57.452 c31.679,0,57.452,25.773,57.452,57.452C239.404,245.334,213.631,271.107,181.951,271.107z"></path> <path d="M106.042,49.858h84.919c3.962,0,7.184-3.222,7.184-7.184V23.66c0-3.962-3.222-7.184-7.184-7.184h-25.983 c-4.431,0-8.023-3.592-8.023-8.023c0-4.661-3.792-8.453-8.453-8.453c-4.661,0-8.453,3.792-8.453,8.453 c0,4.431-3.592,8.023-8.023,8.023h-25.983c-3.962,0-7.184,3.222-7.184,7.184v19.014C98.857,46.636,102.079,49.858,106.042,49.858 z"></path> </g> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
fileArray['assets/icons/request.html'] = '<svg xmlns="http://www.w3.org/2000/svg" height="512" viewBox="0 0 512 512" width="512" class=""><g><path d="m448.800781 0h-192.800781c-34.90625 0-63.199219 28.242188-63.199219 63.199219v289.199219c0 12.269531 14.070313 19.445312 24 12l60.265625-45.199219h171.734375c34.90625 0 63.199219-28.242188 63.199219-63.199219v-192.800781c0-34.90625-28.242188-63.199219-63.199219-63.199219zm-96.402343 246.898438c-8.277344 0-15-6.71875-15-15 0-8.277344 6.722656-15 15-15 8.28125 0 15 6.722656 15 15 0 8.28125-6.71875 15-15 15zm15-66.335938v3.136719c0 8.285156-6.714844 15-15 15-8.28125 0-15-6.714844-15-15v-16.066407c0-8.285156 6.71875-15 15-15 13.878906 0 25.167968-11.289062 25.167968-25.167968 0-13.875-11.289062-25.164063-25.167968-25.164063-13.949219 0-25.164063 11.28125-25.164063 25.148438 0 8.285156-6.71875 15.011719-15 15.011719-8.285156 0-15-6.710938-15-14.992188v-.019531c0-30.507813 24.695313-55.148438 55.148437-55.148438 30.4375 0 55.183594 24.746094 55.183594 55.167969 0 25.21875-17.011718 46.542969-40.167968 53.09375zm0 0" data-original="#000000" class="active-path"></path><path d="m166.238281 311.898438c0 39.160156-31.746093 70.90625-70.90625 70.90625-39.160156 0-70.90625-31.746094-70.90625-70.90625 0-39.164063 31.746094-70.910157 70.90625-70.910157 39.160157 0 70.90625 31.746094 70.90625 70.910157zm0 0" data-original="#000000" class="active-path"></path><path d="m95.332031 382.804688c-52.648437 0-95.332031 42.683593-95.332031 95.332031v18.863281c0 8.285156 6.714844 15 15 15h160.667969c8.28125 0 15-6.714844 15-15v-18.863281c0-52.648438-42.683594-95.332031-95.335938-95.332031zm0 0" data-original="#000000" class="active-path"></path></g> </svg>';
fileArray['assets/icons/scheme.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 484 484" style="enable-background:new 0 0 484 484;" xml:space="preserve" width="512" height="512" class=""><g><g><g><path d="M242,141.2c-55.6,0-100.8,45.2-100.8,100.8S186.4,342.8,242,342.8S342.8,297.6,342.8,242S297.6,141.2,242,141.2z     M212.2,173c-6.1,8.5-12.1,19.4-16.1,32.6h-19.8C184.3,191.1,197,179.6,212.2,173z M169.9,263.3c-2-6.8-3.1-13.9-3.1-21.3    c0-7.4,1.1-14.6,3.1-21.3h22.6c-1.1,6.6-1.8,13.7-1.8,21.3c0,7.6,0.6,14.7,1.8,21.3H169.9z M176.3,278.4h19.8    c4.1,13.2,10,24,16.1,32.6C197,304.4,184.3,292.9,176.3,278.4z M234.4,313.9c-7.3-7.4-16.4-19-22.4-35.5h22.4V313.9z M234.4,263.3    h-26.5c-1.3-6.5-2-13.6-2-21.3s0.7-14.8,2-21.3h26.5V263.3z M234.4,205.6H212c5.9-16.6,15.1-28.2,22.4-35.6V205.6z M307.7,205.6    h-19.8c-4.1-13.2-10-24-16.1-32.6C287,179.6,299.7,191.1,307.7,205.6z M249.6,170.1c7.3,7.4,16.4,19,22.4,35.5h-22.4V170.1z     M249.6,220.7h26.5c1.3,6.5,2,13.6,2,21.3c0,7.7-0.7,14.8-2,21.3h-26.5V220.7z M249.6,278.4H272c-5.9,16.6-15.1,28.2-22.4,35.6    V278.4z M271.8,311c6.1-8.5,12.1-19.4,16.1-32.6h19.8C299.7,292.9,287,304.4,271.8,311z M291.4,263.3c1.1-6.6,1.8-13.7,1.8-21.3    c0-7.6-0.6-14.7-1.8-21.3H314c2,6.8,3.1,13.9,3.1,21.3s-1.1,14.6-3.1,21.3H291.4z" data-original="#000000" class="active-path"></path><path d="M81.8,259h36.6c-0.8-5.6-1.2-11.2-1.2-17c0-4.1,0.2-8.1,0.6-12.1h-36c-5.9-16.1-21.4-27.6-39.6-27.6    c-23.3,0-42.1,18.9-42.1,42.1c0,23.3,18.9,42.1,42.1,42.1C60.4,286.6,75.8,275.1,81.8,259z" data-original="#000000" class="active-path"></path><path d="M227.5,81.8V118c4.8-0.6,9.6-0.9,14.5-0.9s9.8,0.3,14.5,0.9V81.7c16.1-5.9,27.6-21.4,27.6-39.6C284.1,18.8,265.2,0,242,0    c-23.3,0-42.1,18.9-42.1,42.1C199.9,60.4,211.4,75.8,227.5,81.8z" data-original="#000000" class="active-path"></path><path d="M100.7,142.9c6.3,0,12.3-1.4,17.7-3.9l25.7,25.7c6-7.6,12.9-14.5,20.6-20.6L139,118.4c2.5-5.4,3.9-11.4,3.9-17.7    c0-23.3-18.9-42.1-42.1-42.1c-23.3,0-42.1,18.9-42.1,42.1C58.6,124,77.4,142.9,100.7,142.9z" data-original="#000000" class="active-path"></path><path d="M340,164.6l25.7-25.7c15.5,7.2,34.6,4.4,47.4-8.5c16.4-16.4,16.4-43.1,0-59.5s-43.1-16.4-59.5,0    c-12.8,12.8-15.6,31.8-8.5,47.4l-21.5,21.5l0,0l-4.2,4.2C327,150.1,333.9,157,340,164.6z" data-original="#000000" class="active-path"></path><path d="M441.8,199.9c-19.1,0-35.2,12.7-40.4,30h-35.2c0.4,4,0.6,8,0.6,12.1c0,5.8-0.4,11.4-1.2,17h37.6    c6.5,14.8,21.3,25.2,38.6,25.2c23.3,0,42.1-18.9,42.1-42.1S465.1,199.9,441.8,199.9z" data-original="#000000" class="active-path"></path><path d="M383.3,341.1c-6.3,0-12.3,1.4-17.7,3.9L340,319.4c-6,7.6-12.9,14.5-20.6,20.6l25.7,25.7c-2.5,5.4-3.9,11.4-3.9,17.7    c0,23.3,18.9,42.1,42.1,42.1c23.3,0,42.1-18.9,42.1-42.1C425.4,360,406.6,341.1,383.3,341.1z" data-original="#000000" class="active-path"></path><path d="M144,319.4L118.4,345c-5.4-2.5-11.4-3.9-17.7-3.9c-23.3,0-42.1,18.9-42.1,42.1c0,23.3,18.9,42.1,42.1,42.1    c23.3,0,42.1-18.9,42.1-42.1c0-6.3-1.4-12.3-3.9-17.7l25.7-25.7C157,333.9,150.1,327,144,319.4z" data-original="#000000" class="active-path"></path><path d="M256.5,402.3v-29.4V366c-4.8,0.6-9.6,0.9-14.5,0.9s-9.8-0.3-14.5-0.9v6.9v29.4c-16.1,5.9-27.6,21.4-27.6,39.6    c0,23.3,18.9,42.1,42.1,42.1c23.3,0,42.1-18.9,42.1-42.1C284.1,423.6,272.6,408.2,256.5,402.3z" data-original="#000000" class="active-path"></path></g></g></g> </svg>';
fileArray['assets/icons/sendmsg.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512" height="512" class="hovered-paths"><g><g><g><path d="M255.605,334.972c0.31,0.186,0.697,0.185,1.009-0.001l227.398-136.238c-6.719-3.334-14.285-5.21-22.282-5.21H50.486    c-7.996,0-15.562,1.876-22.28,5.21L255.605,334.972z" data-original="#000000" class="hovered-path"></path><path d="M511.984,402.584V243.73c0-8.415-2.083-16.352-5.76-23.326l-110.257,66.057L511.984,402.584z" data-original="#000000" class="hovered-path"></path><path d="M369.426,302.362L272.053,360.7c-4.917,2.945-10.432,4.418-15.946,4.418c-5.513,0-11.024-1.472-15.942-4.417    l-97.806-58.597L0.233,444.359v17.433C0.233,489.477,22.777,512,50.486,512H461.73c27.71,0,50.254-22.523,50.254-50.208v-16.743    L369.426,302.362z" data-original="#000000" class="hovered-path"></path><path d="M115.82,286.203L5.994,220.405c-3.677,6.974-5.76,14.911-5.76,23.326v158.164L115.82,286.203z" data-original="#000000" class="hovered-path"></path></g><g><path d="M269.269,6.817c-2.932-4.155-7.673-6.68-12.744-6.811c-0.032-0.001-0.063-0.002-0.095-0.002    c-0.034-0.001-0.068-0.001-0.102-0.002C256.255,0.001,256.182,0,256.108,0s-0.146,0.001-0.219,0.002    c-0.034,0-0.068,0.001-0.102,0.002c-0.032,0.001-0.064,0.001-0.095,0.002c-5.071,0.131-9.812,2.656-12.745,6.812l-41.47,58.756    c-4.779,6.771-3.159,16.129,3.617,20.903c2.629,1.853,5.649,2.743,8.64,2.743c4.715,0,9.358-2.214,12.282-6.357l15.079-21.364    v85.678c0,8.284,6.722,15,15.013,15c8.292,0,15.013-6.716,15.013-15V61.499L286.2,82.863c4.779,6.77,14.145,8.388,20.922,3.614    c6.777-4.774,8.396-14.133,3.617-20.903L269.269,6.817z" data-original="#000000" class="hovered-path"></path><path d="M58.755,75.757l25.817,4.446c8.178,1.406,15.937-4.071,17.346-12.234c1.408-8.164-4.074-15.923-12.245-17.33L18.84,38.442    c-5.147-0.887-10.427,0.788-14.121,4.477c-3.695,3.69-5.372,8.965-4.486,14.105l12.186,70.897    c1.255,7.306,7.601,12.464,14.779,12.464c0.844,0,1.699-0.071,2.559-0.219c8.171-1.402,13.659-9.158,12.255-17.322l-4.439-25.824    l60.513,60.568c2.932,2.935,6.778,4.403,10.626,4.403c3.837,0,7.676-1.461,10.606-4.384c5.868-5.853,5.877-15.35,0.02-21.213    L58.755,75.757z" data-original="#000000" class="hovered-path"></path><path d="M507.281,43.067c-3.695-3.69-8.972-5.365-14.121-4.478l-70.834,12.197c-8.171,1.407-13.654,9.166-12.245,17.33    c1.408,8.164,9.176,13.64,17.346,12.234l25.817-4.446l-60.582,60.637c-5.858,5.863-5.849,15.361,0.02,21.213    c2.93,2.923,6.768,4.384,10.606,4.384c3.846,0,7.693-1.468,10.626-4.403l60.514-60.569l-4.439,25.824    c-1.404,8.165,4.084,15.92,12.255,17.322c0.86,0.147,1.715,0.219,2.559,0.219c7.176,0,13.524-5.158,14.779-12.464l12.186-70.893    C512.653,52.032,510.976,46.757,507.281,43.067z" data-original="#000000" class="hovered-path"></path></g></g></g> </svg>';
fileArray['assets/icons/users.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="512" height="512" viewBox="0 0 80.13 80.13" style="enable-background:new 0 0 80.13 80.13;" xml:space="preserve" class="hovered-paths"><g><g><path d="M48.355,17.922c3.705,2.323,6.303,6.254,6.776,10.817c1.511,0.706,3.188,1.112,4.966,1.112   c6.491,0,11.752-5.261,11.752-11.751c0-6.491-5.261-11.752-11.752-11.752C53.668,6.35,48.453,11.517,48.355,17.922z M40.656,41.984   c6.491,0,11.752-5.262,11.752-11.752s-5.262-11.751-11.752-11.751c-6.49,0-11.754,5.262-11.754,11.752S34.166,41.984,40.656,41.984   z M45.641,42.785h-9.972c-8.297,0-15.047,6.751-15.047,15.048v12.195l0.031,0.191l0.84,0.263   c7.918,2.474,14.797,3.299,20.459,3.299c11.059,0,17.469-3.153,17.864-3.354l0.785-0.397h0.084V57.833   C60.688,49.536,53.938,42.785,45.641,42.785z M65.084,30.653h-9.895c-0.107,3.959-1.797,7.524-4.47,10.088   c7.375,2.193,12.771,9.032,12.771,17.11v3.758c9.77-0.358,15.4-3.127,15.771-3.313l0.785-0.398h0.084V45.699   C80.13,37.403,73.38,30.653,65.084,30.653z M20.035,29.853c2.299,0,4.438-0.671,6.25-1.814c0.576-3.757,2.59-7.04,5.467-9.276   c0.012-0.22,0.033-0.438,0.033-0.66c0-6.491-5.262-11.752-11.75-11.752c-6.492,0-11.752,5.261-11.752,11.752   C8.283,24.591,13.543,29.853,20.035,29.853z M30.589,40.741c-2.66-2.551-4.344-6.097-4.467-10.032   c-0.367-0.027-0.73-0.056-1.104-0.056h-9.971C6.75,30.653,0,37.403,0,45.699v12.197l0.031,0.188l0.84,0.265   c6.352,1.983,12.021,2.897,16.945,3.185v-3.683C17.818,49.773,23.212,42.936,30.589,40.741z" data-original="#000000" class="hovered-path"></path></g></g> </svg>';
fileArray['assets/icons/upload.html'] = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 548.176 548.176" style="enable-background:new 0 0 548.176 548.176;" xml:space="preserve" class=""><g><g><path d="M524.326,297.352c-15.896-19.89-36.21-32.782-60.959-38.684c7.81-11.8,11.704-24.934,11.704-39.399   c0-20.177-7.139-37.401-21.409-51.678c-14.273-14.272-31.498-21.411-51.675-21.411c-18.083,0-33.879,5.901-47.39,17.703   c-11.225-27.41-29.171-49.393-53.817-65.95c-24.646-16.562-51.818-24.842-81.514-24.842c-40.349,0-74.802,14.279-103.353,42.83   c-28.553,28.544-42.825,62.999-42.825,103.351c0,2.474,0.191,6.567,0.571,12.275c-22.459,10.469-40.349,26.171-53.676,47.106   C6.661,299.594,0,322.43,0,347.179c0,35.214,12.517,65.329,37.544,90.358c25.028,25.037,55.15,37.548,90.362,37.548h310.636   c30.259,0,56.096-10.711,77.512-32.12c21.413-21.409,32.121-47.246,32.121-77.516C548.172,339.944,540.223,317.248,524.326,297.352   z M362.729,289.648c-1.813,1.804-3.949,2.707-6.42,2.707h-63.953v100.502c0,2.471-0.903,4.613-2.711,6.42   c-1.813,1.813-3.949,2.711-6.42,2.711h-54.826c-2.474,0-4.615-0.897-6.423-2.711c-1.804-1.807-2.712-3.949-2.712-6.42V292.355   H155.31c-2.662,0-4.853-0.855-6.563-2.563c-1.713-1.714-2.568-3.904-2.568-6.566c0-2.286,0.95-4.572,2.852-6.855l100.213-100.21   c1.713-1.714,3.903-2.57,6.567-2.57c2.666,0,4.856,0.856,6.567,2.57l100.499,100.495c1.714,1.712,2.562,3.901,2.562,6.571   C365.438,285.696,364.535,287.845,362.729,289.648z" data-original="#000000" class=""></path></g></g> </svg>';

function getFileContent(filename){
  return fileArray[filename];
}

function getCurrentFinancialYear() {
  var fiscalyear = "";
  var today = new Date();
  if ((today.getMonth() + 1) <= 3) {
    fiscalyear = (today.getFullYear() - 1) + "-" + today.getFullYear().toString().substr(-2)
  } else {
    fiscalyear = today.getFullYear() + "-" + (today.getFullYear() + 1).toString().substr(-2)
  }
  return fiscalyear
}
function getlastFinancialYear() {
  var fiscalyear = "";
  var today = new Date();
  if ((today.getMonth() + 1) <= 3) {
    fiscalyear = (today.getFullYear() - 2) + "-" + today.getFullYear().toString().substr(-2)
  } else {
    fiscalyear = (today.getFullYear() - 1) + "-" + today.getFullYear().toString().substr(-2)
    // fiscalyear = today.getFullYear() + "-" + (today.getFullYear() + 1)
  }
  return fiscalyear
}