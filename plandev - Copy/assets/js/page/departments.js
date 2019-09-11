$( document ).ready(function() {
    
    checkSuperAdminOnly();
    //console.log( "ready!" );
    
     $.ajax({async: true,url: siteUrl + "/api/departments",
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

   //    $.ajax({async: true,url: siteUrl + "/api/subsectorlist",
   //    headers: {
   //      'Accept': 'application/json',
   //      'Authorization': 'Bearer ' + localStorage.token
   //    },
   //     success: function(result){
   //     var htm = '';
   //     htm += '<option  value="">NA</option>';
   //     $.each( result['subsectors'], function( key, value ) {
   //      htm += '<option  value="'+result['subsectors'][key]['id']+'" > '+ result['subsectors'][key]['name'] +'</option>';
   //    });
   //    $('.subsector_list').append(htm);
   // }});


      $('#sector-select').on('change', function(){
        $.notify('Loading subsector list. Please wait..', 'info');
        $.ajax({async: true,
          url: siteUrl + "/api/subsectorlist",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          type: 'POST',
          data: {
            sector_id: $(this).val()
          },
          success: function(result){
            $('.notifyjs-wrapper').trigger('notify-hide');
            $('#sub-sector-select')
              .empty()
              .append('<option selected="selected" disabled="disabled">Select a Subsector</option>');
              $('#sub-sector-select').append('<option value="0">NA</option>');
            if (result.subsectors.length > 0) {
              $.each(result.subsectors, function(k, val){
                var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
                $('#sub-sector-select').append(newOption);
              });
            }
            $('#sub-sector-select').trigger('change');
          },
          error:function (error) {
            console.log(error.status);
            if(error.status == 500){
              $.notify('Something went wrong. Please refresh this page and try again.', 'error');
            }
          }
        });
      });


     // action 

      $(document).on('click', '#actionDrop li a', function(){
      var deptId = $(this).attr('data-id');
      var actionClass = $(this).attr('class');
      if(actionClass.indexOf('show') >= 0){
      }
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              //title: "Delete?",
              message: "Are you sure you want to delete this department?",
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
                      url: siteUrl + "/api/departments/" + deptId,
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
                            $.notify("Department is not empty cannot be deleted!", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){
          //       $.ajax({async: true,
          //             url: siteUrl + "/api/departments/" + deptId,
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
          //                   confirm("Department is not empty cannot be deleted !");
          //                  //location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#deptId').val($(this).data('id'));
        $('#dept_name').val($(this).data('name'));
        $('#editDepartmentModal #sector_id').val($(this).data('sectorid'));
        $('#editDepartmentModal #subsector_id').val($(this).data('subsectorid'));
      }
     });

      $('#editDepartmentForm').on('submit', function(e){
        $.notify('Please Wait..', 'info');
        e.preventDefault();
        if($.validatr.validateForm($('#editDepartmentForm'))){
            $(this).find('button[type=submit]').addClass('loading');
            var deptId = $('#deptId').val();
            var formData = $(this).serialize();
            $.ajax({async: true,
                url: siteUrl + "/api/departments/" + deptId,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                type: "PUT",
                data: formData,
                success: function(result) {
                    $('#editDepartmentModal').modal('toggle');
                    $('.notifyjs-wrapper').trigger('notify-hide');
                    $.notify('Department updated succesfully', 'success');
                    location.reload();
                },
                error:function (error) {
                  if(error.status == 422){
                    $.notify('Duplicate Entry. Please enter a different department name.', 'error');
                  }
                  else if(error.status == 403){
                      $.notify('You are not allowed to update this department', 'error');
                  }
                  else if(error.status == 500){
                      $.notify('Something went wrong. Please refresh this page and try again.', 'error');
                  }
                }
            });
        }

      });
});