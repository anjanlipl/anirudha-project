$( document ).ready(function() {
    //console.log( "ready!" );
    
     $.ajax({async: true,url: siteUrl + "/api/department_dashboard_links",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#departmentTab').DataTable({
       	data: result['departments']
       }) 
   },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

 });
});