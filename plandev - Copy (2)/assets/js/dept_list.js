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
$(window).on('load', function(){
    

    setTimeout(function(){

    },5000);

    $(document).ajaxError(function(){
        $('button[type=submit]').removeClass('loading');
    });

    $('body').on('click', '.notify-item', function(e){
        var elem = $(this);
        if(elem.hasClass('read')){
          
        }
        else{
            e.preventDefault();
            var targ = elem.find('a').attr('href');
            // alert(targ);
            var note_id = elem.attr('data-id');
            $.ajax({async: true,
                url: siteUrl + "/api/markNoteRead",
                data: {
                    'note_id': note_id
                },
                type: 'post',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                success: function(result){
                    // alert(result)
                    if(result == 1){
                        elem.addClass('read');
                        var count = $('#notifyCount').html();
                        count--;
                        $('#notifyCount').html(count);
                        window.location.href = targ;
                    }
                }
            });
        }
    });
});

$(document).ready(function(){
  $.notify.defaults({
      gap: 4,
      globalPosition: 'bottom right',
  });
})