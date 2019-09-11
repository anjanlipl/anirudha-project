$( document ).ready(function() {
    //console.log( "ready!" );

    
    checkSuperAdminOnly();
     $.ajax({async: true,url: siteUrl + "/api/tags",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#tagsTab').DataTable({
       	data: result['tags']
       }) 
        },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

      });



     $(document).on('click', '#actionDrop li a', function(){
      var tagId = $(this).attr('data-id');
      var actionClass = $(this).attr('class');
      if(actionClass.indexOf('show') >= 0){
      }
      if(actionClass.indexOf('delete') >= 0){
          if(confirm("Are you sure to delete?")){
                $.ajax({async: true,
                      url: siteUrl + "/api/tags/" + tagId,
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
        $('#tagId').val($(this).data('id'));
        $('#tagName').val($(this).data('name'));
      }

     });

    $('#editTagsForm').on('submit', function(e){
        e.preventDefault();
        if($.validatr.validateForm($('#editTagsForm'))){
          var tagId = $('#tagId').val();
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/tags/" + tagId,
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "PUT",
              data: formData,
              success: function(result) {
                  $('#editTagsModal').modal('toggle');
                  location.reload();
              }
          });
        }

      });



}); //document end
