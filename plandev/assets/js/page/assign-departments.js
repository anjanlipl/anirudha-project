$( document ).ready(function() {
    //console.log( "ready!" );
    checkDadminOrHOD();
     $.ajax({async: true,url: siteUrl + "/api/assign_departments_list",
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

     $(document).on('click', '#assignDept', function(){
      var deptId = $(this).attr('data-id');

      $('#assignDepartModal #deptId').val(deptId);
    });


     $.ajax({async: true,url: siteUrl + "/api/dept_assignto_list",
        headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
        success: function(result){
       var htm = '';
       $.each( result['users'], function( key, value ) {
        htm += '<option  value="'+result['users'][key]['id']+'" > '+ result['users'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
       $.each( result['moreUsers'], function( key, value ) {
        htm += '<option  value="'+result['moreUsers'][key]['id']+'" > '+ result['moreUsers'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
       
      $('.assignto_list').append(htm);
   }});


      $('#assignDepartForm').on('submit', function(e){
        $.notify('Assigning..', 'info');
        e.preventDefault();
        if($.validatr.validateForm($('#assignDepartForm'))){
          $(this).find('button[type=submit]').addClass('loading');
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/assignDept/submit",
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "POST",
              data: formData,
              success: function(result) {
                $('.notifyjs-wrapper').trigger('notify-hide');
                $.notify('Assigned Successfully!', 'success');
                location.reload();
                
              },
              error:function (error) {
                console.log(error.status);
                if(error.status == 422){
                  $('.error-content').html('');
                  var errorMsg = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Duplicate Entry. Please enter a different sector name.</div>'
                  $('.error-content').append(errorMsg);
                }
              }
          });
        }
      });
});