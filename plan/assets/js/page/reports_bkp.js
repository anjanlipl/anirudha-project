$(document).ready(function(){
	
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

	$('body').on('click', '#downPDF', function () {
		// var this_elem = $(this);
		// this_elem.hide();
		// $('#downExcel').hide();
		// var element = document.getElementById('rep');
		// var opt = {
	 //  		margin:       0,
	 //  		filename:     'report.pdf',
	 //  		html2canvas:  { scale: 1 },
	 //  		jsPDF:        { unit: 'in', format: 'a2', orientation: 'l' }
		// };
		// // New Promise-based usage:
		// html2pdf().from(element).set(opt).save();
		// setTimeout(function(){
		// 	this_elem.show();
		// 	$('#downExcel').show();
		// }, 4000)

		var doc = new jsPDF();
			$('#downPDF').click(function () {   
		    doc.fromHTML($('#rep').html(), 15, 15, {
		        'width': 170,
		            // 'elementHandlers': specialElementHandlers
		    });
		    doc.save('sample-file.pdf');
		});
	});


	$('body').on('click', '#downExcel', function () {
		// alert('abc');
		// $("#ExcelTable").tableExport();
		new TableExport(document.getElementById("ExcelTable"), {
		    headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
		    footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
		    formats: ['xlsx', 'csv', 'txt'],            // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
		    filename: 'report',                             // (id, String), filename for the downloaded file, (default: 'id')
		    bootstrap: true,                           // (Boolean), style buttons using bootstrap, (default: true)
		    // exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
		    position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
		    ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
		    ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
		    trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
		});
	});



	// Fill in the sub-sector List using sector id
	$('#sector-select').on('change', function(){	
		// console.log('s-changed');

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
				$('#sub-sector-select')
					.empty()
					.append('<option value="" selected="selected" disabled="disabled">Select a Subsector</option>');
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
		// console.log('ss-changed');
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
				console.log(result);
				$('#dept-select')
					.empty()
					.append('<option value="" selected="selected" disabled="disabled">Select a Department</option>');
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

	// Fill in unit list using department id
	$('#dept-select').on('change', function(){
		// console.log('dept-changed');

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
				$('#unit-select')
					.empty()
					.append('<option value="" selected="selected" disabled="disabled">Select Implementing agency</option>');
				// $('#unit-select').append('<option value="0">NA</option>');

				if (result.units.length > 0) {
					$.each(result.units, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#unit-select').append(newOption);
					});
				}
				$('#scheme-select')
					.empty()
					.append('<option value="" selected="selected">Select a Scheme</option>');
			},
			error:function (error) {
				console.log(error.status);
				if(error.status == 401){
					
					
					
				}
			}
		});
	});

	$('#unit-select').on('change', function(){
		// console.log('unit-changed');
		$('#scheme-select')
					.empty()
					.append('<option value="" selected="selected">Select a Scheme</option>');
		$.ajax({async: true,
			url: siteUrl + "/api/schemelist",
			headers: {
				'Accept': 'application/json',
				'Authorization': 'Bearer ' + localStorage.token
			},
			type: 'POST',
			data: {
				unit_id: $(this).val(),
				department_id: $('#dept-select').val()
			},
			success: function(result){
				// $('#scheme-select').append('<option value="0">NA</option>');

				if (result.schemes.length > 0) {
					$.each(result.schemes, function(k, val){
						var newOption = $('<option value="'+val.id+'">'+val.name+'</option>');
						$('#scheme-select').append(newOption);
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

	$('body').on('click', '.close-reptable', function(e){
		e.preventDefault();
		$('.reptable-overlay').fadeOut(300);
	});

	$('#generateScheme').on('submit', function(e){
		e.preventDefault();
        if($.validatr.validateForm($('#generateScheme'))){
        	$('#rep').html('<img src="assets/icons/loader.gif" /><span class="rep-load-text">Generating Report. Please wait...</span>');
        	$('.reptable-overlay').fadeIn(300);
        	$('body').css('overflow', 'hidden');
			var data = $(this).serialize();
			// alert(data);

			$.ajax({async: true,
				url: siteUrl + "/api/getSchemeReports",
				headers: {
					'Accept': 'application/json',
					'Authorization': 'Bearer ' + localStorage.token
				},
				type: 'POST',
				data: data,
				success: function(result){
					console.log(result);
					$('#rep').html(result);
					var title_text = $('body #titleText').val();
					console.log(title_text);
					// $("#ExcelTable").tableExport();	
					$('#ExcelTable').DataTable({
						"paging":   false,
						"searching": false,
						dom: 'Bfrtip',
						"bSort": false,
				        buttons: [
				            {
				            	extend: 'print',
				            	header: false,
				            	title: title_text,
				            	exportOptions: {
	                  				columns: ':visible',
	                  				rows: ':not(.not-printable)'
	              				},
				                orientation:"landscape",
				                pageSize:"A2",
				            	text: "Print"
				            },
				            {
				            	extend: 'excelHtml5',
				            	// header: false,
				            	title: title_text,
				            	exportOptions: {
				            		// stripHtml: false,
	                  				columns: ':visible',
	                  				rows: ':not(.not-printable)'
							    },
				            	text: "Export as Excel(.xslx)"
				            },
				            {
				            	extend: 'csvHtml5',
				            	title: title_text,
				            	exportOptions: {
	                  				columns: ':visible',
	                  				rows: ':not(.not-printable)'
	              				},
				            	text: 'Export as CSV(.csv)'
				            },
				            {
				            	// header: false,
				                extend: 'pdfHtml5',
				                //download: 'open',
				                text: 'Export as PDF(.pdf)',
				                // headerRows: 0,
				            	title: title_text,
				            	filename: title_text,
				                exportOptions: {
	                  				columns: ':visible',
	                  				rows: ':not(.not-printable)'
	              				},
				                orientation:"landscape",
				                pageSize:"A2"
							},
							{
								extend: 'colvis',
								text: 'Show/Hide Columns'
							}
			        	]
		        	});
				},
				error:function (error) {
					console.log(error.status);
					if(error.status == 401){
						
						
						
					}
				}
			});
		}
	});
});