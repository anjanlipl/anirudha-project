$(document).ready(function(){
	var urlParams = new URLSearchParams(window.location.search);
	var scheme_id = urlParams.get('scheme_id');
	//alert(scheme_id);

	
	$('body').on('click', '#capital-check', function(){
		var checkBox = document.getElementById("capital-check");
		    if (checkBox.checked == true){
		       $('#lat-long-row').css('display','block');
		    } else {
		       $('#lat-long-row').css('display','none');
		     
		    }
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
	$.ajax({async: true,
		url: siteUrl + "/api/schemes/"+scheme_id+"/edit",
		headers: {
			'Accept': 'application/json',
			'Authorization': 'Bearer ' + localStorage.token
		},
		success: function(result){

				console.log(result);


				var iscapital = result.scheme.is_capital;
				if(iscapital == 1){
					var map; var marker;
					var myLatLng = {lat: parseFloat(result.scheme.latitude), lng: parseFloat(result.scheme.longitude)};
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
				}
				

				$('#sub-sector-select')
					.empty()
					.append('<option selected="selected" disabled="disabled">Select a Subsector</option>');
					$('#sub-sector-select').append('<option value="0">NA</option>');
				if (result.scheme.subsectors.length > 0) {
					$.each(result.scheme.subsectors, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#sub-sector-select').append(newOption);
					});
				}
				$('#sub-sector-select').trigger('change');


				$('#dept-select')
					.empty()
					.append('<option selected="selected" disabled="disabled">Select a Department</option>');
				if (result.scheme.departments.length > 0) {
					$.each(result.scheme.departments, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#dept-select').append(newOption);
					});
				}
				$('#dept-select').trigger('change');


				$('#unit-select')
					.empty()
					.append('<option selected="selected" disabled="disabled">Select a Unit</option>');
				$('#unit-select').append('<option value="0">NA</option>');

				

				//alert(result.scheme.is_capital);
				if(result.scheme.is_capital == 1){
					$('#capital-check').prop('checked', true);
		       $('#lat-long-row').css('display','block');
					
					//$('#capital-check').checked();
					
				}


				function fill(a){
				    for(var k in a){
				        $('[name="'+k+'"]').val(a[k]);
				    }
				}

				fill(result['scheme']);

					setTimeout(function(){ 
					$("#dept-select option[value=" + result.scheme.department_id+"]").attr("selected","selected") ;
					if (result.scheme.units.length > 0) {
						$.each(result.scheme.units, function(k, val){
							var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');

							$('#unit-select').append(newOption);
						});
					}
					$('#unit-select').trigger('change');
					$("#unit-select option[value=" + result.scheme.unit_id+"]").attr("selected","selected") ;
					console.log(result.scheme.mon_types);

					$.each(result.scheme.mon_types, function(k, val){
						// alert('here');
						// $("#montype-select option[value='"+val+"]").prop("selected", true);
						$("#montype-select option[value='" + val + "']").prop("selected", true);
					
					});
					$.each(result.scheme.tags, function(k, val){
						
					$("#tag-select option[value=" + val+"]").prop("selected","selected") ;

					});

				}, 1000);

				 //$('[name="department_id"]').val(result.scheme.department_id);
		},
		error:function (error) {
			console.log(error.status);
			if(error.status == 401){
				
				
				
			}
		}
	});


	$('#edit-scheme-form').on('submit', function(e){
		e.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({async: true,
			url: siteUrl + "/api/update_scheme/"+scheme_id,
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: form_data,
			success: function(result){
				$.notify('Scheme Updated succesfully', 'success');
				var scheme_id = result.scheme['id'];
				var redirUrl = frontUrl + 'add-scheme-financials.html?scheme_id=' + scheme_id;
				window.location.href = redirUrl;

				console.log(result);

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

});