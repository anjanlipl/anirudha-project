$( document ).ready(function() {

  
    checkSuperAdminOnly();
  $.ajax({async: true,url: siteUrl + "/api/indunits",
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






   $(document).on('click', '#actionDrop li a', function(){
      var unitId = $(this).attr('data-id');
      var actionClass = $(this).attr('class');
      if(actionClass.indexOf('show') >= 0){
      }
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              //title: "Delete?",
              message: "Are you sure you want to delete this Unit?",
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
                      url: siteUrl + "/api/indunits/" + unitId,
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
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){
          //       $.ajax({async: true,
          //             url: siteUrl + "/api/indunits/" + unitId,
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
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#unitId').val($(this).data('id'));
        $('#unitname').val($(this).data('name'));
      }

     });

      $('#editUnitForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#editUnitForm'))){
          var unitId = $('#unitId').val();
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/indunits/" + unitId,
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "PUT",
              data: formData,
              success: function(result) {
                  $('#editUnitModal').modal('toggle');
                  alert("Unit updated successfully !")
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