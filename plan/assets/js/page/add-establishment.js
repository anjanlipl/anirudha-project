$(document).ready(function(){
  checkDadmin();
  var urlParams = new URLSearchParams(window.location.search);
	var dept_id = urlParams.get('dept_id');

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


   $.ajax({async: true,url: siteUrl + "/api/establishment_be_history?dept_id="+dept_id,
      headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.token
      },
      success: function(result){
       $('#be_tab').DataTable({
       	data: result['bugets']
       }) ;
       $('#re_tab').DataTable({
       	data: result['revised']
       }) ;
        $('#exp_tab').DataTable({
       	data: result['exp']
       }) ;
      /* $('#re_tab').DataTable({
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
       }) ;*/
   },error:function (error) {
                console.log(error.status);
                if(error.status == 401){
                  
                  
                  
                }
            }

 	});


	 $(".be_rcl").keyup(function(){
	    var sal = $(".be_sal").val();
	    var benifit = $(".be_benifit").val();
	    var wages = $(".be_wages").val();
	    var machinery = $(".be_machinery").val();
	    var office = $(".be_office").val();

	    if(sal != '' && benifit != '' && wages != '' && machinery != '' && office != ''){
	      var total =  +sal + +benifit + +wages + +machinery + +office  ;
	      $('.be_total').val(total);
	    }
   
	});

	 $(".re_rcl").keyup(function(){
	    var sal = $(".re_sal").val();
	    var benifit = $(".re_benifit").val();
	    var wages = $(".re_wages").val();
	    var machinery = $(".re_machinery").val();
	    var office = $(".re_office").val();

	    if(sal != '' && benifit != '' && wages != '' && machinery != '' && office != ''){
	      var total =  +sal + +benifit + +wages + +machinery + +office  ;
	      $('.re_total').val(total);
	    }
   
	});
	 $(".exp_rcl").keyup(function(){
	    var sal = $(".exp_sal").val();
	    var benifit = $(".exp_benefit").val();
	    var wages = $(".exp_wages").val();
	    var machinery = $(".exp_machinery").val();
	    var office = $(".exp_office").val();

	    if(sal != '' && benifit != '' && wages != '' && machinery != '' && office != ''){
	      var total =  +sal + +benifit + +wages + +machinery + +office  ;
	      $('.exp_total').val(total);
	    }
   
	});
   

   	$('body').on('submit', '#addEstimateForm', function(e){
      $.notify('Adding Estimate', 'info');
		e.preventDefault();
		    var isvalid = 'false';
		     var sal = $(".be_sal").val();
		    var benifit = $(".be_benifit").val();
		    var wages = $(".be_wages").val();
		    var machinery = $(".be_machinery").val();
		    var office = $(".be_office").val();
		    if(sal != '' && benifit != '' && wages != '' && machinery != '' && office != ''){
			     // var total =  +sal + +benifit + +wages + +machinery + +office  ;
			       isvalid = 'true';
	    	}else{
		         
	    		var sal = $(".re_sal").val();
			    var benifit = $(".re_benifit").val();
			    var wages = $(".re_wages").val();
			    var machinery = $(".re_machinery").val();
			    var office = $(".re_office").val();

			    if(sal != '' && benifit != '' && wages != '' && machinery != '' && office != ''){
			      //var total =  +sal + +benifit + +wages + +machinery + +office  ;
			       isvalid = 'true';
			      
			    }

		    }
		    //alert(isvalid);

		   if(isvalid == 'true'){
		      var form_data = $(this).serialize() + '&dept_id=' + dept_id;
		    $.ajax({async: true,
		      url: siteUrl + "/api/add-establishment_estimate",
		      data: form_data,
		      type: "POST",
		      headers: {
		        'Accept': 'application/json',
		        'Authorization': 'Bearer ' + localStorage.token
		      },
		      success: function(response){
            $('.notifyjs-wrapper').trigger('notify-hide');
		      	console.log(response);
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
      $.notify('Adding Establishment Expenditure', 'info');
		e.preventDefault();
		var form_data = $(this).serialize() + '&dept_id=' + dept_id;
		//console.log(form_data);
		$.ajax({async: true,
			url: siteUrl + "/api/add-establishment-expenditure",
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
              message: "Are you sure you want to delete the Budget Estimate?",
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
                      url: siteUrl + "/api/delete_estab_be/" + beId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            $.notify("Budget Estimate Deleted successfully !", 'success');
                            location.reload();
                          }else{
                            $.notify("Something went wrong. Please try again.", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){

          //      $.ajax({async: true,
          //             url: siteUrl + "/api/delete_estab_be/" + beId,
          //             headers: {
          //               'Accept': 'application/json',
          //               'Authorization': 'Bearer ' + localStorage.token
          //             },
          //             type: "POST",
          //             success: function(result) {
          //                 if(result['deleted'] == "true"){
          //                   alert("Budget Estimate Deleted successfully !");
          //                  location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
      	var elem = $(this).parents().eq(4);
      	var year = elem.find('td:nth-child(1)').html();

      	var salary = elem.find('td:nth-child(2)').html();
      	var benefits = elem.find('td:nth-child(3)').html();

      	var wages = elem.find('td:nth-child(4)').html();
        var machinery = elem.find('td:nth-child(5)').html();
        var officeexp = elem.find('td:nth-child(6)').html();

      	//console.log(value);
      	function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

		formdata ={'id':beId,'year':year,'type':'be','salary':salary,'benefits':benefits,'wages':wages,'machinery':machinery,'officeexp':officeexp};

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
              message: "Are you sure you want to delete the Revised Estimate?",
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
                      url: siteUrl + "/api/delete_estab_re/" + reId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            $.notify("Revised Estimate Deleted successfully!", 'success');
                            location.reload();
                          }else{
                            $.notify("Something went wrong. Please try again.", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){

          //      $.ajax({async: true,
          //             url: siteUrl + "/api/delete_estab_re/" + reId,
          //             headers: {
          //               'Accept': 'application/json',
          //               'Authorization': 'Bearer ' + localStorage.token
          //             },
          //             type: "POST",
          //             success: function(result) {
          //                 if(result['deleted'] == "true"){
          //                   alert("Review Estimate Deleted successfully !");
          //                  location.reload();
          //                 }
          //             }
          //           });
          //   }
      }
      if(actionClass.indexOf('edit') >= 0){
       var elem = $(this).parents().eq(4);
      	var year = elem.find('td:nth-child(1)').html();

        var salary = elem.find('td:nth-child(2)').html();
        var benefits = elem.find('td:nth-child(3)').html();

        var wages = elem.find('td:nth-child(4)').html();
        var machinery = elem.find('td:nth-child(5)').html();
        var officeexp = elem.find('td:nth-child(6)').html();

      	//console.log(value);
      	function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

		formdata ={'id':reId,'year':year,'type':'re','salary':salary,'benefits':benefits,'wages':wages,'machinery':machinery,'officeexp':officeexp};

		fill(formdata);
      }
     });

		     $(document).on('click', '.expAction li a', function(){
	 	//alert('here');
     	var expId = $(this).attr('data-id');
     	var actionClass = $(this).attr('class');
     	$('#Expenditure').html('Revised');

      $('#estimateTitle').html('Expenditure');
     	
      if(actionClass.indexOf('delete') >= 0){

          bootbox.confirm({
              title: "Delete?",
              message: "Are you sure you want to delete the Expenditure?",
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
                      url: siteUrl + "/api/delete_estab_exp/" + expId,
                      headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.token
                      },
                      type: "DELETE",
                      success: function(result) {
                          if(result['deleted'] == "true"){
                            $.notify("Expenditure Deleted successfully!", 'success');
                            location.reload();
                          }else{
                            $.notify("Something went wrong. Please try again.", "error");
                           //location.reload();
                          }
                      }
                    });
                  }
              }
          });
          // if(confirm("Are you sure to delete?")){

          //      $.ajax({async: true,
          //             url: siteUrl + "/api/delete_estab_exp/" + expId,
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

        var salary = elem.find('td:nth-child(2)').html();
        var benefits = elem.find('td:nth-child(3)').html();

        var wages = elem.find('td:nth-child(4)').html();
        var machinery = elem.find('td:nth-child(5)').html();
        var officeexp = elem.find('td:nth-child(6)').html();



      	//console.log(value);
      	function fill(a){
			    for(var k in a){
			        $('[name="'+k+'"]').val(a[k]);
			    }
				}

		formdata ={'id':expId,'year':year,'type':'exp','salary':salary,'benefits':benefits,'wages':wages,'machinery':machinery,'officeexp':officeexp};

		fill(formdata);
      }
     });


    $('body').on('submit', '#editbeForm', function(e){
      $.notify('Updating Budget Estimate', 'info');
      e.preventDefault();
      if(userRole != 'super-admin'){
        $.notify("Permission Denied", "error");
        // location.reload();
        }else{
          var form_data = $(this).serialize();
          $.ajax({async: true,
            url: siteUrl + "/api/edit-establishment-estimates",
            data: form_data,
            type: "POST",
            headers: {
              'Accept': 'application/json',
              'Authorization': 'Bearer ' + localStorage.token
            },
            success: function(response){
              $.notify("Succesfully updated Budget Estimate", "success");
              location.reload();
            }
          });
        }
      }); 
    });