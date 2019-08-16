$(document).ready(function(){
  checkDadmin();
	var urlParams = new URLSearchParams(window.location.search);
	var scheme_id = urlParams.get('scheme_id');
	$('#redirBtnObj').attr('href', frontUrl + 'scheme-objectives.html?scheme_id='+scheme_id);

  if(scheme_id == null){
    $('.head-info, #schmFinance, #schmFinanceBtn').hide();
  }


  $(".be_rcl").keyup(function(){
    var rev = ($(".be_rev").val())?$(".be_rev").val():"0";
    var cap = ($(".be_cap").val())?$(".be_cap").val():"0";
    var loan = ($(".be_loan").val())?$(".be_loan").val():"0";
    if(rev != '' && cap != '' && loan != ''){
      var total =  +rev + +cap + +loan;
      $('.be_total').val(total);
    }
   
});
   $(".re_rcl").keyup(function(){
    var rev = ($(".re_rev").val())?$(".re_rev").val():"0";
    var cap = ($(".re_cap").val())?$(".re_cap").val():"0";
    var loan = ($(".re_loan").val())?$(".re_loan").val():"0";
    // if(rev != '' && cap != '' && loan != ''){
      var total =  +rev + +cap + +loan;
      $('.re_total').val(total);
    // }
   
});
    $(".exp_rcl").keyup(function(){
    var rev = ($(".exp_rev").val())?$(".exp_rev").val():"0";
    var cap = ($(".exp_cap").val())?$(".exp_cap").val():"0";
    var loan = ($(".exp_loan").val())?$(".exp_loan").val():"0";
    if(rev != '' && cap != '' && loan != ''){
      var total =  +rev + +cap + +loan;
      $('.exp_total').val(total);
    }
});


    $.ajax({async: true,
    url: siteUrl + "/api/departmentlist",
    headers: {
      'Accept': 'application/json',
      'Authorization': 'Bearer ' + localStorage.token
    },
    type: 'POST',
    success: function(result){
      $('#dept-select')
        .empty()
        .append('<option value="" selected="selected" disabled="disabled">Select a Department</option>');
      if (result.departments.length > 0) {
        $.each(result.departments, function(k, val){
          var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
          $('#dept-select').append(newOption);
        });
      }
      // $('#dept-select').trigger('change');
    },
    error:function (error) {
      console.log(error.status);
      if(error.status == 401){
        
        
        
      }
    }
  });

  

  $('#dept-select').on('change', function(){
    $.notify('Loading Scheme List', 'info');
    var dept_id = $(this).val();

    var data = {
      'dept_id': dept_id
    };
    $.ajax({async: true,
      url: siteUrl + "/api/getdepartmentschemes",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      type: 'POST',
      data: data,
      success: function(result){
        // alert(result);
        $('.notifyjs-wrapper').trigger('notify-hide');
        $('#scheme-select')
          .empty()
          .append('<option value="" selected="selected" disabled="disabled">Select a Scheme</option>');
        if (result.schemes.length > 0) {
          $.each(result.schemes, function(k, val){
            var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
            $('#scheme-select').append(newOption);
          });
        }
        // $('#dept-select').trigger('change');
        // location.reload();
      },
      error:function (error) {
        if(error.status == 401){
          $('.error-content').html('');
          var errorMsg = '<div class="alert alert-danger">Unauthorized Access. Please re-try</div>'
          $('.error-content').append(errorMsg);
        } else if (error.status == 0) {
          $('.error-content').html('');
          var errorMsg = '<div class="alert alert-danger">Something went wrong.</div>'
          $('.error-content').append(errorMsg);
        }
      }
    });
  });
   



	$.ajax({async: true,
		url: siteUrl + "/api/scheme_objectives_head_info",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		data: {'scheme_id': scheme_id},
		type: 'GET',
		success: function(result){
			$('.head-info').html(result.headInfo);
      $('.objectiveBread').attr('href','scheme-objectives.html?scheme_id=' + $( '.schemeinfo').attr('data-id'));
      $('.outputBread').attr('href',$('.outputBread').attr('href')+'?objective_id=' + $( '.objectiveinfo').attr('data-id'));
      $('.outcomeBread').attr('href',$('.outcomeBread').attr('href')+'?output_id=' + $( '.outputinfo').attr('data-id'));
      $('.IndicatorBread').attr('href',$('.IndicatorBread').attr('href')+'?outcome_id=' + $( '.outcomeinfo').attr('data-id'));
      
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});


	    $.ajax({async: true,url: siteUrl + "/api/be_history?scheme_id="+scheme_id,
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#be_tab').DataTable({
       	data: result['bugets']
       }) ;
       $('#re_tab').DataTable({
       	data: result['revenues']
       }) ;
       $('#exp_tab').DataTable({
       	data: result['exp']
       }) ;
       $('#exp_per_be_tab').DataTable({
        data: result['exp_per_be']
       }) ;
       $('#exp_per_re_tab').DataTable({
        data: result['exp_per_re']
       }) ;
   },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

 	});




	$('body').on('submit', '#addEstimateForm', function(e){
    $.notify('Adding Estimate', 'info');
		e.preventDefault();
    var isvalid = 'false';
     var rev = $(".be_rev").val();
     var cap = $(".be_cap").val();
     var loan = $(".be_loan").val();
     var total = $('.be_total').val();
     if(rev != '' && cap != '' && loan != '' && total != '' && total != 'NaN'){
        isvalid = 'true';
    }else{
         var rev2 = $(".re_rev").val();
         var cap2 = $(".re_cap").val();
         var loan2 = $(".re_loan").val();
         var total2 = $('.re_total').val();
          if(rev2 != '' && cap2 != '' && loan2 != '' && total2 != ''  && total2 != 'NaN'){
             isvalid = 'true';
          }
    }
    //alert(isvalid);

   if(isvalid == 'true'){
      var form_data = $(this).serialize() + '&scheme_id=' + scheme_id;
    $.ajax({async: true,
      url: siteUrl + "/api/add-scheme-estimates",
      data: form_data,
      type: "POST",
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(response){
        $('.notifyjs-wrapper').trigger('notify-hide');
        location.reload();
      }
    });
   }else{
         $('.error-content').html('');
          var errorMsg = '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Incomplete form. Please fill Estimate Revenue, capital and loan .</div>'
          $('.error-content').append(errorMsg);
   }


		

	});
	$('body').on('submit', '#addExpForm', function(e){
    $.notify('Adding Expenditure', 'info');
		e.preventDefault();
		var form_data = $(this).serialize() + '&scheme_id=' + scheme_id;
		console.log(form_data);
		$.ajax({async: true,
			url: siteUrl + "/api/add-scheme-expenditure",
			data: form_data,
			type: "POST",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			success: function(response){
				console.log(response);
        $('.notifyjs-wrapper').trigger('notify-hide');
				location.reload();
			}
		})
	});

	 $(document).on('click', '.beAction li a', function(){
	 	//alert('here');
     	var beId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	$('#estimateTitle').html('Budget Estimate');
     	
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete?",
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
                      url: siteUrl + "/api/deletebe/" + beId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "POST",
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
      }
      if(actionClass.indexOf('edit') >= 0){
      	var elem = $(this).parents().eq(4);
      	var year = elem.find('td:nth-child(1)').html();

      	var revenue = elem.find('td:nth-child(2)').html();
      	var capital = elem.find('td:nth-child(3)').html();

      	var loan = elem.find('td:nth-child(4)').html();

      	//console.log(value);
      	function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

		formdata ={'id':beId,'year':year,'type':'be','revenue':revenue,'capital':capital,'loan':loan};

		fill(formdata);
       /* $('#sectorId').val($(this).data('id'));
        $('#secName').val($(this).data('name'));*/
      }
     });

     $(document).on('click', '.reAction li a', function(){
	 	//alert('here');
     	var reId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	$('#estimateTitle').html('Revised Estimate');

     	
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete?",
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
                      url: siteUrl + "/api/deletere/" + reId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "POST",
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
      }
      if(actionClass.indexOf('edit') >= 0){
       var elem = $(this).parents().eq(4);
      	var year = elem.find('td:nth-child(1)').html();

      	var revenue = elem.find('td:nth-child(2)').html();
      	var capital = elem.find('td:nth-child(3)').html();

      	var loan = elem.find('td:nth-child(4)').html();

      	//console.log(value);
      	function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

		formdata ={'id':reId,'year':year,'type':'re','revenue':revenue,'capital':capital,'loan':loan};

		fill(formdata);
      }
     });


     $(document).on('click', '.expAction li a', function(){
	 	//alert('here');
     	var expId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	$('#Expenditure').html('Revised');

     	
      if(actionClass.indexOf('delete') >= 0){
          bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete?",
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
                      url: siteUrl + "/api/deleteexp/" + expId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "POST",
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

          //      $.ajax({async: true,
          //             url: siteUrl + "/api/deleteexp/" + expId,
          //             headers: {
          //               'Accept': 'application/json',
          //               'Authorization': 'Bearer ' + localStorage.token
          //             },
          //             type: "POST",
          //             success: function(result) {
          //                 if(result['deleted'] == "true"){
          //                   alert("Expenditure Deleted successfully !");
          //                  location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
       var elem = $(this).parents().eq(4);
      	var year = elem.find('td:nth-child(1)').html();

      	var revenue = elem.find('td:nth-child(2)').html();
      	var capital = elem.find('td:nth-child(3)').html();

      	var loan = elem.find('td:nth-child(4)').html();

      	//console.log(value);
      	function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

		formdata ={'id':expId,'year':year,'type':'exp','revenue':revenue,'capital':capital,'loan':loan};

		fill(formdata);
      }
     });

     $('body').on('submit', '#editbeForm', function(e){
  
         var form_data = $(this).serialize();
        $.ajax({async: true,
          url: siteUrl + "/api/edit-scheme-estimates",
          data: form_data,
          type: "POST",
          headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer ' + localStorage.token
          },
          success: function(response){
            $.notify("successfully updated", "success");
            //location.reload();
          }
        });
  
   
  });




});