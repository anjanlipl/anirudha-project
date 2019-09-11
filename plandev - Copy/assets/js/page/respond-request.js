$( document ).ready(function() {

    
    checkDadminOrHOD();
    //console.log( "ready!" );
    var sectorTable = '';
     $.ajax({async: true,
          url: siteUrl + "/api/get_all_request",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(result){
           sectorTable = $('#sectorTab').DataTable({
            	data: result['requests']
           });
         },
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });
   });