$( document ).ready(function() {

    
  checkDadminOrHOD();
  var urlParams = new URLSearchParams(window.location.search);
  var indicator_id = urlParams.get('indicator_id');
  var type = urlParams.get('type');

    //checkSuperAdmin();
    //console.log( "ready!" );

    $.ajax({async: true,
    url: siteUrl + "/api/wardslist",
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.token
    },
    success: function(result){
      $.each(result.wards, function(k, val){
        var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
        $('.ward-select').append(newOption);
      })
    },
    error:function (error) {
      console.log(error.status);
      if(error.status == 401){
        
        
        
      }
    }
  });
    $.ajax({async: true,
    url: siteUrl + "/api/districtslist",
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.token
    },
    success: function(result){
      $.each(result.districts, function(k, val){
        var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
        $('.district-select').append(newOption);
      })
    },
    error:function (error) {
      console.log(error.status);
      if(error.status == 401){
        
        
        
      }
    }
  });
    $.ajax({async: true,
    url: siteUrl + "/api/vidhanshabhalist",
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.token
    },
    success: function(result){
      $.each(result.vidhansabhas, function(k, val){
        var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
        $('.vidhasnsabha-select').append(newOption);
      })
    },
    error:function (error) {
      console.log(error.status);
      if(error.status == 401){
        
        
        
      }
    }
  });
    var sectorTable = '';
     $.ajax({async: true,
          url: siteUrl + "/api/indicatorobj",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          data:{'type':type,'indicator_id':indicator_id},
          success: function(result){
           sectorTable = $('#sectorTab').DataTable({
            	data: result['objects']
           });
         },
         error:function (error) {
              console.log(error.status);
              if(error.status == 401){
                
                
                
              }
          }

     });


      $('#addObjectForm').on('submit', function(e){
        $.notify('Adding object', 'info');
        e.preventDefault();
        if($.validatr.validateForm($('#addObjectForm'))){
          $(this).find('button[type=submit]').addClass('loading');
          var formData = $(this).serialize();
          formData += '&&type='+type+'&&indicator_id='+indicator_id;
          $.ajax({async: true,
              url: siteUrl + "/api/indicatorobj",
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "POST",
              data: formData,
              success: function(result) {
                  $('#addSectorModal').modal('toggle');
                  $('.notifyjs-wrapper').trigger('notify-hide');
                  $.notify('Object Added', 'success');
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
      $('.ward-select').on('change',function(){
       // alert();
        var wardId = $(this).val();

           $.ajax({async: true,
              url: siteUrl + "/api/getWardDetails/"+wardId,
              headers: {
                  'Accept': 'application/json',
                  'Authorization': 'Bearer ' + localStorage.token
              },
              type: "GET",
              success: function(result) {
                $('.latitude').val(result.ward.latitude);
                $('.longitude').val(result.ward.longitude);

                 console.log(result);
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
      });
});