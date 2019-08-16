$( document ).ready(function() {

    checkDadminOrHOD();
     $.ajax({async: true,
          url: siteUrl + "/api/assigned_actions",
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

      $(document).on('click', '.addremark', function(){
      var actionId = $(this).attr('data-id');
      var type = $(this).attr('data-type');

      
      //alert(actionId);
      $('#addRemarkForm .id').val(actionId);
      $('#addRemarkForm .indType').val(type);

      //var actionClass = $(this).attr('class');
      
     });

      

          $('#addRemarkForm').on('submit', function(e){
        e.preventDefault();
            $.notify('Adding', 'info');

        if($.validatr.validateForm($('#addRemarkForm'))){
          $(this).find('button[type=submit]').addClass('loading');
          var formData = $(this).serialize();
          $.ajax({async: true,
              url: siteUrl + "/api/add_user_remark",
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "post",
              data: formData,
              success: function(result) {
                  $('.notifyjs-wrapper').trigger('notify-hide');
                  // $('#addSectorModal').modal('toggle');
                  $.notify('Added', 'success');
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
    