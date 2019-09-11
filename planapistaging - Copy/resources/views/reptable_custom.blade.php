
<table class="rep-table" id="ExcelTable">
<style type="text/css">
	table.rep-table{
		border: 1px solid #DDD !important;
		/*fcfgcf*/
	}
	.rep-table thead{
		/*display: inline-block;*/
		/*white-space: nowrap;*/
	}
	.rep-table th{
		/*padding: 0px 0px !important;*/
	}
	.rep-table th, td{
		/*display: inline-block;*/
		/*min-height: 100px !important;*/
		min-width: 200px !important;
		column-span: 2;
		vertical-align: middle !important;
	}
	.rep-table td{
		border: 1px solid #DDD !important;
		/*border-bottom: 1px solid #AAA;*/
		border-bottom: none !important;
		font-weight: 600 !important;
	}
	.rep-table td.td-no-bord{
		border-top: none !important;
		/*border-top-color: #FFF;*/
	}
	.rep-table td.bord-top{
		/*border-top-color: #AAA;*/
	}
	.dt-buttons{
		/*margin-bottom: -40px;*/
	}
	.dt-button-collection{
		display: block;
		position: absolute;
		top: 100%;
		margin-top: 2px;
		margin-left: 10px;
		left: 0;
		/*right: 0;*/
		border: 1px solid #DDD;
		background-color: #FFF;
		max-height: 300px;
		overflow: auto;
	}
	.buttons-columnVisibility{
		position: relative;
		display: block;
		width: 100%;
		background-color: transparent;
		border: none;
		border-bottom: 1px solid #DDD;
		max-width: 200px;
		padding: 10px;
		padding-left: 36px;
		text-align: left;
	}
	.buttons-columnVisibility:before{
		content: "";
		position: absolute;
		top: 12px;
		left: 10px;
		height: 16px;
		width: 16px;
		background-image: url(assets/icons/checked.png);
		background-position: center -16px;
		background-repeat: no-repeat;
		background-size: 10px 10px;
		background-color: #FFF;
		border: 2px solid #DDD;
		transition: all 0.3s ease-in-out;
	}
	.buttons-columnVisibility.active:before{
		background-color: #FF8833;
		background-position: center center;
		border-color: #FF8833;
	}

</style>
	{{-- <tr>
		<th colspan="2"></th>
		<th colspan="5">Outputs</th>
		<th colspan="5">Outcomes</th>
		<th></th>
	</tr> --}}
	<thead style="opacity: 0; visibility: hidden;">
		<tr>
			<th>Name of tde Scheme / Programme and Budget Allocation (Rs. Lakhs)</th>
			<th>Objectives</th>
			<th>Indicators</th>
			<th>Baseline (2017-18)</th>
			<th>Targets (2017-18)</th>
			<th>Status (2017-18)</th>
			{{-- <th>Target(2018-19)</th> --}}
			<th>Reviews</th>
			<th>Action Points</th>
			<th>Indicators</th>
			<th>Baseline (2017-18)</th>
			<th>Targets (2017-18)</th>
			<th>Status (2017-18)</th>
			{{-- <th>Target(2018-19)</th> --}}
			<th>Reviews</th>
			<th>Action Points</th>
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		@if(count($schemes))
		<tr style="background-color: #FAFAFA;">
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important; border-left: 1px solid #DDD !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			{{-- <td style="border: none !important;">&nbsp;</td> --}}
			<td style="border: none !important;"><b>Outputs</b></td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			{{-- <td style="border: none !important;">&nbsp;</td> --}}
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;"><b>Outcomes</b></td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
		</tr>
		<tr style="background-color: #FAFAFA;">
			<td><b>Name of the Scheme / Programme and Budget Allocation (Rs. Lakhs)</b></td>
			<td><b>Objectives</b></td>
			<td><b>Indicators</b></td>
			<td><b>Baseline (2017-18)</b></td>
			<td><b>Targets (2017-18)</b></td>
			<td><b>Status (2017-18)</b></td>
			{{-- <td><b>Target(2018-19)</b></td> --}}
			<td><b>Reviews</b></td>
			<td><b>Action Points</b></td>
			<td><b>Indicators</b></td>
			<td><b>Baseline (2017-18)</b></td>
			<td><b>Targets (2017-18)</b></td>
			<td><b>Status (2017-18)</b></td>
			{{-- <td><b>Target(2018-19)</b></td> --}}
			<td><b>Reviews</b></td>
			<td><b>Action Points</b></td>
			<td><b>Remarks</b></td>
		</tr>
		<tr style="background-color: #FAFAFA;">
			<td>1</td>
			<td>2</td>
			<td>3</td>
			<td>4</td>
			<td>5</td>
			<td>6</td>
			<td>7</td>
			<td>8</td>
			<td>9</td>
			<td>10</td>
			<td>11</td>
			<td>12</td>
			<td>13</td>
			<td>14</td>
			<td>15</td>
			{{-- <td>16</td>
			<td>17</td> --}}
		</tr>
		@php
			$sch_arr = array();
			$obj_arr = array();
			$opi_arr = array();
			$oci_arr = array();
		@endphp
		{{-- @php print_r($schemes); @endphp --}}
		@foreach($schemes as $key=>$value)
			@php
				$sch_name = "&nbsp;";
				$sch_remrk = "&nbsp;";
				if(!in_array($value['sch_id'], $sch_arr)){
					$sch_name = $value['sch_name'];
					$sch_remrk = $value['sch_remrk'];
					$tdschclass = '';
				}
				else{
					$tdschclass = 'td-no-bord';
				}
				array_push($sch_arr, $value['sch_id']);
				$obj_desc = "";
				if(!in_array($value['obj_id'], $obj_arr)){
					$obj_desc = $value['obj_desc'];
					$tdobjclass = '';
				}
				else{
					$tdobjclass = 'td-no-bord';
				}
				if(!empty($value['opi'])){
					if(in_array($value['opi'], $opi_arr)){
						$value['opi'] = '';
						$tdopiclass = 'td-no-bord';
					}
					else{
						$tdopiclass = '';
					}
				}
				else{
					$tdopiclass = '';
				}

				if(!empty($value['oci'])){
					if(in_array($value['oci'], $oci_arr)){
						$value['oci'] = '';
						$tdociclass = 'td-no-bord';
					}
					else{
						$tdociclass = '';
					}
				}
				else{
					$tdociclass = '';
				}

				if(!empty($value['opi_st'])){

					if($value['opi_st'] == 1){
						$color = 'background-color: #999 !important; color: #FFF !important;';
					}
					elseif($value['opi_st'] == 2){
						$color = 'background-color: #37942c !important; color: #FFF !important;';
					}
					elseif($value['opi_st'] == 3){
						$color = 'background-color: #b70000 !important; color: #FFF !important;';
					}
					elseif($value['opi_st'] == 4){
						$color = 'background-color: #FFFF00 !important';
					}
				}
				else{
					// $color = '#222 !important';
					$value['opi_st'] ='';
				}

				array_push($sch_arr, $value['sch_id']);
				array_push($obj_arr, $value['obj_id']);
				if(!empty($value['opi'])){
					array_push($opi_arr, $value['opi']);
				}
				if(!empty($value['oci'])){
					array_push($oci_arr, $value['oci']);
				}
				$opi = (!empty($value['opi']))?$value['opi']:"&nbsp;";
				$opb = (!empty($value['opb']))?$value['opb']:"&nbsp;";
				$opt = (!empty($value['opt']))?$value['opt']:"&nbsp;";
				$opt_stat = (!empty($value['opt_stat']))?$value['opt_stat']:"&nbsp;";
				$oci = (!empty($value['oci']))?$value['oci']:"&nbsp;";
				$ocb = (!empty($value['ocb']))?$value['ocb']:"&nbsp;";
				$oct = (!empty($value['oct']))?$value['oct']:"&nbsp;";
				$opr_desc = (!empty($value['opr_desc']))?$value['opr_desc']:"&nbsp;";
				$opap_desc = (!empty($value['opap_desc']))?$value['opap_desc']:"&nbsp;";
				$ocr_desc = (!empty($value['ocr_desc']))?$value['ocr_desc']:"&nbsp;";
				$ocap_desc = (!empty($value['opap_desc']))?$value['opap_desc']:"&nbsp;";
				$targ_next = (!empty($value['targ_next']))?$value['targ_next']:"&nbsp;";
				$outc_targ_next = (!empty($value['outc_targ_next']))?$value['outc_targ_next']:"&nbsp;";
				$oct_stat = (!empty($value['oct_stat']))?$value['oct_stat']:"&nbsp;";
				$sch_remrk = (!empty($sch_remrk))?$sch_remrk:"&nbsp;";
			@endphp
		<tr>
			<td class="{{ $tdschclass }}">@php echo htmlspecialchars_decode($sch_name) @endphp</td>
			<td class="{{ $tdobjclass }}">@php echo htmlspecialchars_decode($obj_desc) @endphp</td>
			<td class="{{ $tdopiclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($opi) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opb) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opt) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opt_stat) @endphp</td>
			{{-- <td style="{{ $color  }}">@php echo htmlspecialchars_decode($targ_next) @endphp</td> --}}
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opr_desc) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opap_desc) @endphp</td>
			<td class="{{ $tdociclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($oci) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($ocb) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($oct) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($oct_stat) @endphp</td>
			{{-- <td style="{{ $color  }}">@php echo htmlspecialchars_decode($outc_targ_next) @endphp</td> --}}
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($ocr_desc) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($ocap_desc) @endphp</td>
			<td style="{{ $color  }}" class="{{ $tdschclass }}">@php echo htmlspecialchars_decode($sch_remrk) @endphp</td>
		</tr>
		@endforeach
		@endif
	</tbody>
</table>
{{-- <div class="row rep-table" style="width: 1300px;">
	<div class="col-md-12">
		<a id="downPDF" class="btn btn-primary"><span class="text">Download Report as Pdf</span></a>
		<a id="downExcel" class="btn btn-primary"><span class="text">Download Report as Excel</span></a>
	</div>
</div> --}}