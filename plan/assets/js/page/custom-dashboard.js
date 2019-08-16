$(document).ready(function(){
	

	var urlParams = new URLSearchParams(window.location.search);
	var dashboard_id = urlParams.get('id');

	$.ajax({async: true,
  	url: siteUrl + "/api/custom_dashboard_show",
  	headers: {
    	'Accept': 'application/json',
    	'Authorization': 'Bearer ' + localStorage.token
  	},
  	data:{'dashboard_id':dashboard_id},
  	success: function(result){
   		// console.log(result);
      var htm = "";
      $.each(result.schemes, function(i, scheme){
        htm+= '<div class="collapse-wrap"><button class="collapse-btn collapsed scheme-collapse" data-scheme-id="'+scheme.id+'" data-toggle="collapse" data-target="#schemeColl'+scheme.id+'">'+scheme.name+'</button><div id="schemeColl'+scheme.id+'" class="collapse collapse-content"></div></div>';
      });

      $('#schemeListCustom').html(htm);
 	},
 	error:function (error) {
      	console.log(error.status);
      	if(error.status == 401){
        
        
        
  	}
}

});

  $('body').on('click', '.scheme-collapse.collapsed', function(e){
    $.notify('Loading Scheme Details', 'true');
    e.preventDefault();
    var scheme_id = $(this).attr('data-scheme-id');
    var targ = $(this).attr('data-target');
    $.ajax({async: true,
      url: siteUrl + '/api/getCustomSchemeDetails',
      data: {
        'scheme_id': scheme_id
      },
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      type: 'post',
      success: function(result){
        $('.notifyjs-wrapper').trigger('notify-hide');
        $(targ).html(result);
      }
    });
  });

});
