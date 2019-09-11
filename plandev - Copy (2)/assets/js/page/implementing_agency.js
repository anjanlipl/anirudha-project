$( document ).ready(function() {

  
    checkSuperAdminOnly();
  $.ajax({async: true,url: siteUrl + "/api/units",
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#unitsTab').DataTable({
       	data: result['units']
       }) 
   },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

 });


 $.ajax({async: true,url: siteUrl + "/api/departmentlist",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      }, success: function(result){
       var htm = '';
       $.each( result['departments'], function( key, value ) {
        htm += '<option  value="'+result['departments'][key]['id']+'" > '+ result['departments'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
      $('.dept_listing').append(htm);
   }});



   $(document).on('click', '#actionDrop li a', function(){
      var unitId = $(this).attr('data-id');
      var actionClass = $(this).attr('class');
      if(actionClass.indexOf('show') >= 0){
      }
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              //title: "Delete?",
              message: "Are you sure you want to delete this Implementing Agency?",
              buttons: {
                  cancel: {
                      label: '<i class="fa fa-times"></i> Cancel'
                  },
                  confirm: {
                      label: '<i class="fa fa-check"></i> Confirm'
                  }
              },
              callback: function (result) {
                  if(result==true){
                    $.ajax({async: true,
                      url: siteUrl + "/api/units/" + unitId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            $.notify("Deleted successfully !", 'success');
                            location.reload();
                          }
                          if(result['deleted'] == "false"){
                            $.notify("Implementing Agency is not empty cannot be deleted!", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){
          //       $.ajax({async: true,
          //             url: siteUrl + "/api/units/" + unitId,
          //             headers: {
          //               'Accept': 'application/json',
          //               'Authorization': 'Bearer ' + localStorage.token
          //             },
          //             type: "DELETE",
          //             success: function(result) {
          //                 if(result['deleted'] == "true"){
          //                   alert("Deleted successfully !");
          //                  location.reload();
          //                 }
          //                 if(result['deleted'] == "false"){
          //                   confirm("Implementing Agency has active schemes  cannot be deleted !");
          //                  //location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#unitId').val($(this).data('id'));
        $('#unitname').val($(this).data('name'));
        $('#editUnitModal #department_id').val($(this).data('departmentid'));
      }

     });

      $('#editUnitForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#editUnitForm'))){
            $(this).find('button[type=submit]').addClass('loading');
            var unitId = $('#unitId').val();
            var formData = $(this).serialize();
            $.ajax({async: true,
                url: siteUrl + "/api/units/" + unitId,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                type: "PUT",
                data: formData,
                success: function(result) {
                    $('#editUnitModal').modal('toggle');
                    $.notify('Implementing Agency updated successfully', 'success');
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