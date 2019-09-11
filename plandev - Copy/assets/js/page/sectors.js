$( document ).ready(function() {

    
    checkSuperAdminOnly();
    //console.log( "ready!" );
    var sectorTable = '';
     $.ajax({async: true,
          url: siteUrl + "/api/sector",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(result){
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


     $(document).on('click', '#actionDrop li a', function(){
     	var secId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	if(actionClass.indexOf('show') >= 0){
     	}
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              //title: "Delete?",
              message: "Are you sure you want to delete this sector?",
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
                      url: siteUrl + "/api/sector/" + secId,
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
                            $.notify("Sector is not empty cannot be deleted!", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#sectorId').val($(this).data('id'));
        $('#secName').val($(this).data('name'));
      }
     });

      $('#addSectorForm').on('submit', function(e){
        e.preventDefault();
        // $.notify('Adding. Please Wait..', 'info');

        if($.validatr.validateForm($('#addSectorForm'))){
          $(this).find('button[type=submit]').addClass('loading');
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/sector",
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "post",
              data: formData,
              success: function(result) {
                alert("Sector successfully added");
                  $('#addSectorModal').modal('toggle');
                  //$('#succ').notify('Sector successfully added','success');
                  //$.notify('Sector successfully added', 'success');
                  location.reload();
              },
              error:function (error) {
                // console.log(error.status);
                if(error.status == 422){
                  $.notify('Duplicate Entry. Please enter a different sector name.', 'error');
                }
                else if(error.status == 403){
                    $.notify('You are not allowed to update this sector', 'error');
                }
                else if(error.status == 500){
                    $.notify('Something went wrong. Please refresh this page and try again.', 'error');
                }
              }
          });
        }
      });

      $('#editSectorForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#editSectorForm'))){
          $(this).find('button[type=submit]').addClass('loading');
          var secId = $('#sectorId').val();
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/sector/" + secId,
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "PUT",
              data: formData,
              success: function(result) {
                  $('#editSectorModal').modal('toggle');
                  $.notify('Sector successfully Updated', 'success');
                  location.reload();
              },
              error:function (error) {
                // console.log(error.status);
                if(error.status == 422){
                  $.notify('Duplicate Entry. Please enter a different sector name.', 'error');
                }
                else if(error.status == 403){
                    $.notify('You are not allowed to update this sector', 'error');
                }
                else if(error.status == 500){
                    $.notify('Something went wrong. Please refresh this page and try again.', 'error');
                }
              }
          });
        }

      });

});

