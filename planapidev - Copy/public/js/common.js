$( document ).ready(function() {
	$('#sectorsTable').DataTable();
	 $('#subsectorsTable').DataTable();
	 $('#departmentsTable').DataTable();

	 $('.datepicker').datepicker({
	 	autoclose: true,
	 	orientation: "bottom"
		});
	 

	  $('.change-outputindicator').click(function(){
	  	var indicatorId = $(this).attr('data-id');
	  	$('#outputindicatorProgress #indicator_id').val(indicatorId);
	  	$('#outputindicatorProgress').modal('show');
	  });

	  $('.change-outcomeindicator').click(function(){
	  	var indicatorId = $(this).attr('data-id');
	  	$('#outcomeindicatorProgress #indicator_id').val(indicatorId);
	  	$('#outcomeindicatorProgress').modal('show');
	  });

	
	  
	 
});