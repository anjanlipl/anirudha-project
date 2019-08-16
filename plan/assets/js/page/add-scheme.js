$(document).ready(function(){
	
	checkDadmin();
	$('body').on('click', '#capital-check', function(){
		var checkBox = document.getElementById("capital-check");
		    if (checkBox.checked == true){
		       $('#lat-long-row').css('display','block');
		    } else {
		       $('#lat-long-row').css('display','none');
		     
		    }
	});

	$('body').on('click', '#addEstimateBtn', function(){
		$.get(frontUrl + "parts/estFields.html", function(data){
			$('#addEstimate').append(data);
		});
	});

	$('body').on('click', '#addExpBtn', function(){
		$.get(frontUrl + "parts/expFields.html", function(data){
			$('#addExp').append(data);
		});
	});

	 $('#uploadSchemeForm').on('submit', function(e){
        e.preventDefault();
        $(this).find('button[type=submit]').addClass('loading');
		//alert("here");
		//var formData = new FormData($(this)[0]);

    // add assoc key values, this will be posts values
    //formData.append("file", this.file, this.getName());
       // var formData = $(this).serialize();
        //var formData = new FormData();
        var form = document.forms.namedItem("uploadSchemeForm"); // high importance!, here you need change "yourformname" with the name of your form
		var formdata = new FormData(form);

// ... 
//formData.append('schemefile', document.getElementById("schemefile").files[0]);
                $.ajax({async: true,
			url: siteUrl + "/api/scheme_upload",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			async: true,
		    type: "POST",
		    // dataType: "json", // or html if you want...
		    contentType: false, // high importance!
		    data: formdata, // high importance!
		    processData: false,
			success: function(result){
				console.log(result);
				$.notify("schemes uploaded successfully", "success");
				document.location.href = 'all-schemes.html',true;
			},
			error:function (error) {
				if(error.status == 422){
                  
                }
                else if(error.status == 401){
                    $.notify('You are not allowed to update this sector', 'error');
                }
                else if(error.status == 500){
                    $.notify('Something went wrong. Please refresh this page and try again.', 'error');
                }
			}
		});
                //$('form')[0].reset();
            
        });
        
   
	


	$('#add-scheme-form').on('submit', function(e){
		e.preventDefault();
		if($.validatr.validateForm($('#add-scheme-form'))){
			$(this).find('button[type=submit]').addClass('loading');
			var form_data = $(this).serialize();
			$.ajax({async: true,
				url: siteUrl + "/api/add_scheme",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: form_data,
				success: function(result){
					console.log(result);
					var scheme_id = result.scheme['id'];
					$.notify("schemes added successfully", "success");
					var redirUrl = frontUrl + 'add-scheme-financials.html?scheme_id=' + scheme_id;
					window.location.href = redirUrl;
				},
				error:function (error) {
					if(error.status == 422){
						console.log(error);
						console.log(error.responseJSON.errors);
						// console.log(error['errors']);
	               		$.each(error.responseJSON.errors, function(key, value){
	               			$.notify(value, 'error');
	               		});
	                }
	                else if(error.status == 401){
	                    $.notify('You are not allowed to add scheme', 'error');
	                }
	                else if(error.status == 500){
	                    $.notify('Something went wrong. Please refresh this page and try again.', 'error');
	                }
				}
			});
		}
	});

	// Fill in the sector List
	$.ajax({async: true,
		url: siteUrl + "/api/sectorlist",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			$.each(result.sectors, function(k, val){
				var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
				$('#sector-select').append(newOption);
			})
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	// Fill in the tag List
	$.ajax({async: true,
		url: siteUrl + "/api/taglist",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			$.each(result.tags, function(k, val){
				var newOption = $('<option value="'+val.id+'">'+val.tag_name+'</option>');
				$('#tag-select').append(newOption);
			})
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	// Fill in the Scheme Monitoring type List
	$.ajax({async: true,
		url: siteUrl + "/api/montypelist",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){
			$.each(result.montype, function(k, val){
				var newOption = $('<option value="'+val.id+'">'+val.abbreviation+'</option>');
				$('#montype-select').append(newOption);
			})
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});

	// Fill in the sub-sector List using sector id
	$('#sector-select').on('change', function(){
		$.notify('Loading Subsector list', 'info');	
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
				if(error.status == 401){
					
					
					
				}
			}
		});
	});

	// Fill in department list using sub sector id
	$('#sub-sector-select').on('change', function(){
		$.notify('Loading Department List', 'info');
		var sector_id= $('#sector-select').val();
		$.ajax({async: true,
			url: siteUrl + "/api/departmentlist",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: {
				subsector_id: $(this).val(),
				sector_id:sector_id
			},
			success: function(result){
				$('.notifyjs-wrapper').trigger('notify-hide');
				$('#dept-select')
					.empty()
					.append('<option selected="selected" disabled="disabled">Select a Department</option>');
				if (result.departments.length > 0) {
					$.each(result.departments, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#dept-select').append(newOption);
					});
				}
				$('#dept-select').trigger('change');
			},
			error:function (error) {
				console.log(error.status);
				if(error.status == 401){
					
					
					
				}
			}
		});
	});

	$('#longitude').on('change', function(e){
		var latitude = $('#latitude').val();
		var longitude = $(this).val();
		var map; var marker;
		var myLatLng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
		console.log(myLatLng);
  		function initMap() {
        	map = new google.maps.Map(document.getElementById('map'), {
          		center: myLatLng,
          		zoom: 8
        	});
        	marker = new google.maps.Marker({
			    position: myLatLng,
			    map: map,
		  	});
      	}
		initMap();
	});

	// Fill in unit list using department id
	$('#dept-select').on('change', function(){
		$.notify('Loading Implementing agencies.', 'info');
		$.ajax({async: true,
			url: siteUrl + "/api/unitlist",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: {
				department_id: $(this).val()
			},
			success: function(result){
				$('.notifyjs-wrapper').trigger('notify-hide');
				$('#unit-select')
					.empty()
					.append('<option selected="selected" disabled="disabled">Select a Unit</option>');
				$('#unit-select').append('<option value="0">NA</option>');

				if (result.units.length > 0) {
					$.each(result.units, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#unit-select').append(newOption);
					});
				}
			},
			error:function (error) {
				console.log(error.status);
				if(error.status == 401){
					
					
					
				}
			}
		});
	});


		$('#scheme_type_select').on('change', function(){
			//alert($(this).val());
			var selectedType = $(this).val();
			if(selectedType == 1){
				$('#state_share').val(100);
				$('#central_share').val(0);
				$('#state_share').attr('disabled','disabled');
				$('#central_share').attr('disabled','disabled');
			}else{
				$('#state_share').val('');
				$('#central_share').val('');
				$('#state_share').removeAttr('disabled');
				$('#central_share').removeAttr('disabled');
			}
			});

});