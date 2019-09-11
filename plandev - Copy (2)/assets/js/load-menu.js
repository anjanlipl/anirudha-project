$(window).on('load', function(){

   // $(".side-list").css('display','block');

    $(document).ajaxStop(function() {
        $('body .side-list').css('display', 'none');
        userRole = localStorage.user_role;
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
            $('#change-password').css('display','none');
            $('#custom-dashboard').css('display','none');
            $('#icon-btn').css('display','none');
            $('#notifyCount').css('display','none');
            $('#msg-img').css('display','none');
            $('.rep-menu').css('display','none');

        }
        else{
            $('#masters-menu').css('display','none');
            $('#users-menu').css('display','none');
            $('.dadmin').css('display','none');
            $('.hodrole').css('display','none');
            $('.superonly').css('display','none');

          
        }
         //setTimeout(function(){
          $('body .side-list').css('display', 'block');
         //}, 200);
    });

    var func = setInterval(function(){
        $.ajax({async: true,
            url: siteUrl + "/api/department_dashboard_links",
            headers: {
              'Accept': 'application/json',
              'Authorization': 'Bearer ' + localStorage.token
            },
            success: function(result){
              $.each(result['departments'], function(key, value){
                $('body #dept_list_side').append('<li><a href="dept_dashboard.html?dept_id='+value.id+'">'+value.name+'</a></li>');
                // console.log(value);
              });
              var addr = window.location.href;
              var abs_addr = addr.replace(frontUrl, "");
              $('.side-list').find('a[href="'+abs_addr+'"]').parentsUntil('.side-list').addClass('active');

            },
            error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }
        });

        $.ajax({async: true,
            url: siteUrl + "/api/sector_dashboard_links",
            headers: {
              'Accept': 'application/json',
              'Authorization': 'Bearer ' + localStorage.token
            },
            success: function(result){
              $.each(result['sectors'], function(key, value){
                $('body #sec_list_side').append('<li><a href="all_departments_dasboard.html?sector_id='+value.id+'">'+value.name+'</a></li>');
                // console.log(value);
              });
              var addr = window.location.href;
              var abs_addr = addr.replace(frontUrl, "");
              $('.side-list').find('a[href="'+abs_addr+'"]').parentsUntil('.side-list').addClass('active');

            },
            error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }
        });

        $.ajax({async: true,
            url: siteUrl + "/api/getNotifications",
            headers: {
              'Accept': 'application/json',
              'Authorization': 'Bearer ' + localStorage.token
            },
            success: function(result){
              // console.log(result);
                $('#notifyCount').html(result.count);
                if(result.count){
                    if( !$.isArray(result.notifications) ||  !result.notifications.length ) {
                        $('#userMsgs').addClass('empty');
                    }
                    $.each(result.notifications, function(i, val){
                        $('#userMsgs').addClass('notempty');
                        $('#userMsgs').prepend(val.message);
                    });
                }
                else{
                  $('#userMsgs').html('<p class="no-note">No Notification</p>');
                }
                $.ajax({async: true,
                  url: siteUrl + "/api/get_current_user_dets",
                  headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                  },
                  success: function(result){
                    Pusher.logToConsole = true;

                    var pusher = new Pusher('e11ef279aac7ef0d7e32', {
                      cluster: 'ap2',
                      encrypted: true
                    });

                    var channel = pusher.subscribe('delhi_planning_' + result.user.id);
                    channel.bind('App\\Events\\SchemeCreateEvent', function(data) {
                      // alert(JSON.stringify(data));
                      var count = $('#notifyCount').html();
                      count++;
                      $('#notifyCount').html(count);
                      if($('#userMsgs').hasClass('notempty')){
                        $('#userMsgs').prepend('<li class="notify-item" data-id="'+data.message.id+'">'+data.message.text+'</li>');
                      }
                      else{
                        $('#userMsgs').html('<li class="notify-item" data-id="'+data.message.id+'">'+data.message.text+'</li>');
                      }
                      $('#chatAudio')[0].play();
                    });

                  } 
                })
            },
            error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }
        });

        clearInterval(func);
    }, 500);

$(".side-list li").css('display','block');
  setTimeout(function(){
  $(".side-list").css('display','block');
}, 30000);


$('#sidebar').on({
    'mousewheel': function(e) {
        if (e.target.id == 'el') return;
        e.preventDefault();
        e.stopPropagation();
     }
});

});
