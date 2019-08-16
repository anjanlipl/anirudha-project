$( document ).ready(function() {

    
    checkSuperAdminOnly();
    var urlParams = new URLSearchParams(window.location.search);
  var type = urlParams.get('type');
  var action = urlParams.get('action');

    //console.log( "ready!" );
    var sectorTable = '';
     $.ajax({async: true,
          url: siteUrl + "/api/get_action_remarks",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          data:{'type':type,'action':action},
          success: function(result){
            console.log(result);
           sectorTable = $('#sectorTab').DataTable({
            	data: result['sectors']
           });
         },
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });
});