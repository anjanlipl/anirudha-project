$( document ).ready(function() {
    //console.log( "ready!" );
    
    checkSuperAdminOnly();
     $.ajax({async: true,url: siteUrl + "/api/monitoringtypes",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#monitoringTypeTab').DataTable({
       	data: result['monitoringtypes']
       }) 
        },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

      });

      $(document).on('click', '#actionDrop li a', function(){
      var typeId = $(this).attr('data-id');
      var actionClass = $(this).attr('class');
      if(actionClass.indexOf('show') >= 0){
        
      }
      if(actionClass.indexOf('delete') >= 0){
          if(confirm("Are you sure to delete?")){
                $.ajax({async: true,
                      url: siteUrl + "/api/monitoringtypes/" + typeId,
                      type: "DELETE",
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            alert("Deleted successfully !");
                           location.reload();
                          }
                      }
                    });
                 
            }
      }
      if(actionClass.indexOf('edit') >= 0){
        $('#monId').val($(this).data('id'));
        $('#monAbbr').val($(this).data('abbr'));
        $('#monDesc').val($(this).data('desc'));
      }

     });

      $('#editMonitoringTypeForm').on('submit', function(e){
        $.notify('Updating Monitoring Type', 'info');
        e.preventDefault();
        if($.validatr.validateForm($('#editMonitoringTypeForm'))){
            var monId = $('#monId').val();
            var formData = $(this).serialize();
            $.ajax({async: true,
                url: siteUrl + "/api/monitoringtypes/" + monId,
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.token
                },
                type: "PUT",
                data: formData,
                success: function(result) {
                    $('#editMonTypeModal').modal('toggle');
                    $('.notifyjs-wrapper').trigger('notify-hide');
                    $.notify('Updated successfully', 'success');
                    location.reload();
                }
            });
        }

      });

});