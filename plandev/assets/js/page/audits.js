$( document ).ready(function() {

    
    checkSuperAdminOnly();
    // var urlParams = new URLSearchParams(window.location.search);
  // var type = urlParams.get('type');
  // var action = urlParams.get('action');

    //console.log( "ready!" );
    var sectorTable = '';
     $.ajax({async: true,
          url: siteUrl + "/api/audits",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          // data:{'type':type,'action':action},
          success: function(result){
            $('#sectorTab tbody').html(result.audits);
            $('#sectorTab').DataTable();
            // console.log(result);
            // sectorTable = $('#sectorTab').DataTable({
            // 	 data: result['audits']
            // });
         },
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });
});