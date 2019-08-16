$( document ).ready(function() {
    //console.log( "ready!" );

    
    checkSuperAdminOnly();
     $.ajax({async: true,url: siteUrl + "/api/subsector", 
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#subsectorTab').DataTable({
       	data: result['subsectors']
       }) 
      },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

 });


     $(document).on('click', '#actionDrop li a', function(){
     	var subId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	if(actionClass.indexOf('show') >= 0){
     		
     	}
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete this subsector?",
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
                      url: siteUrl + "/api/subsector/" + subId,
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
                            $.notify("Subsector is not empty, cannot be deleted!", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){
          //       $.ajax({async: true,
          //             url: siteUrl + "/api/subsector/" + subId,
          //             headers: {
          //                 'Accept': 'application/json',
          //                 'Authorization': 'Bearer ' + localStorage.token
          //               },
          //             type: "DELETE",
          //             success: function(result) {
          //                 if(result['deleted'] == "true"){
          //                   alert("Deleted successfully !");
          //                  location.reload();
          //                 }
          //                 if(result['deleted'] == "false"){
          //                   confirm("Subsector is not empty cannot be deleted !");
          //                  //location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#subSectorId').val($(this).data('id'));
        $('#subSecName').val($(this).data('name'));
        $('#editSubsectorModal #sector_id').val($(this).data('sectorid'));
      }

     });

     $.ajax({async: true,url: siteUrl + "/api/sectorlist",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       var htm = '';
       $.each( result['sectors'], function( key, value ) {
        htm += '<option  value="'+result['sectors'][key]['id']+'" > '+ result['sectors'][key]['name'] +'</option>';
        //console.log( key + ": " + value );
      });
      $('.sector_list').append(htm);
   }});

      $('#editSubSectorForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#editSubSectorForm'))){
            $(this).find('button[type=submit]').addClass('loading');
            var subSectorId = $('#subSectorId').val();
            var formData = $(this).serialize();
            // console.log(subSectorId, formData);
            // return false;
            $.ajax({async: true,
                url: siteUrl + "/api/subsector/" + subSectorId,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                type: "PUT",
                data: formData,
                success: function(result) {
                    $('#editSubSectorModal').modal('toggle');
                    $.notify("Subsector Updated successfully !", 'success');
                    location.reload();
                },
                error:function (error) {
                  console.log(error.status);
                  if(error.status == 422){
                    $.notify('Duplicate Entry. Please enter a different subsector name.', 'error');
                  }
                  else if(error.status == 403){
                      $.notify('You are not allowed to update this subsector', 'error');
                  }
                  else if(error.status == 500){
                      $.notify('Something went wrong. Please refresh this page and try again.', 'error');
                  }
                }
            });
        }

      });


});
