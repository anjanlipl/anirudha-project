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
var frontUrl = "http://103.92.47.157/plandev/";
var siteUrl = "http://103.92.47.157/planapidev/public";
if (null == localStorage.token) {
    // 
    // alert('You do not have access to this page. Click ok to login again');
    window.stop();
    window.location.href = frontUrl + 'login.html';
}

var href = document.location.href;
var lastPathSegment = href.substr(href.lastIndexOf('/') + 1);
var page_data = {
    'page' : lastPathSegment
};
// console.log(lastPathSegment);

// $('body').css('opacity', '0');
$.ajax({
    async: true,
    url: siteUrl + '/api/check-access-for-page',
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
    },
    data: page_data,
    type: 'POST',
    success: function(result){
        //console.log(result);
        // $('body').css('opacity', '1');
        // localStorage.token = result;
    },
    error: function(result){
        //$('body').html('Access Denied');
        // localStorage.removeItem('token');
        // localStorage.removeItem('user_role');
        // localStorage.removeItem('username');
        // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        // window.location.href = frontUrl + 'login.html';
    }
});


// $(document).ajaxComplete(function(event, xhr, settings){
//   console.log('Abc');
//   console.log(xhr.responseText);
// });


// ref();

// setInterval(function(){
    // ref();
// }, 30000);

function ref(){
    var data = {
        'token': localStorage.token
    };
    $.ajax({
        async: false,
        url: siteUrl + '/api/ref-acc-token',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
        },
        data: data,
        type: 'POST',
        success: function(result){
            localStorage.token = result;
        },
        error: function(result){
            localStorage.removeItem('token');
            localStorage.removeItem('user_role');
            localStorage.removeItem('username');
            // document.cookie = "planning_sess_pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.href = frontUrl + 'login.html';
        }
    });
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