$( document ).ready(function() {
	$('#sector_select').on('change', function() {
  			sectorId = this.value ;
  			var url = location.origin + "/planning/public/getSubsectors/"+sectorId;
  			$.ajax({url: url, success: function(result){
       			 console.log(result);
       			 $('#subsector_select').html(result);
    		}});

	});

	$(".addEstimate").click(function(){
		var addData = $("#firstEstimate").html();
		$( addData + ".addEstimate .fa" ).filter('.addEstimate').find('fa').addClass('fa-minus');
		/*$( addData + ".addEstimate .fa" ).addClass('fa-minus');
		$( addData + ".addEstimate .fa" ).removeClass('fa-plus');
		$( addData + ".addEstimate" ).bind( "click", function() {
			  	alert("yes");
			});*/
		$('#estimate-wrapper').append(addData);
	});
	$(".addExpenditure").click(function(){
		var addData = $("#firstExpenditure").html();
		$('#expenditureWrapper').append(addData);
	});

$("#addOutput").click(function(){
		var addData = $("#one-output").html();
		$('#output-wrapper').append(addData);
	});


	$(".addOI").click(function(){
		var beForm = $("#one-indicator").html();
		$('#indicator-wrapper').append(beForm);
	});
	$("#addOutcomeIndicator").click(function(){
		var beForm = $("#firstOutcomeindicator").html();
		$('#outcome-indicator-wrapper').append(beForm);
	});


});