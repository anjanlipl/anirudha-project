<style type="text/css">
	table.rep-table{
		border: 1px solid #DDD !important;
		/*ghfhgf*/
	}
	.rep-table thead{
		/*display: inline-block;*/
		/*white-space: nowrap;*/
	}
	.rep-table th{
		text-align: center;
		/*padding: 0px 0px !important;*/
	}
	.rep-table th, td{
		text-align: center !important;
		/*display: inline-block;*/
		/*min-height: 100px !important;*/
		min-width: 200px !important;
		column-span: 2;
		vertical-align: middle !important;
	}
	.rep-table td{
		border: 1px solid rgba(212, 212, 212,1) !important;
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

@php
	if(date('m') > 4){
		$month = 'April';
	}
	if(date('m') > 6){
		$month = 'June';
	}
	if(date('m') > 9){
		$month = "September";
	}
	if(date('m') < 4){
		$month = "December";
	}
@endphp
<div class="dash-sec-thumb-title text-center" id="dashSecThumbTitle">{{ ($head)?$head:'OUTCOME BUDGET- 2018-19' }}</div>
<input type="hidden" id="titleText" value="{{ ($head)?$head:'OUTCOME BUDGET- 2018-19' }}">
<table class="rep-table" id="ExcelTable">
	<thead style="opacity: 0; visibility: hidden;">
		<tr>
			<th>Department Name</th>
			<th>S. No.</th>
			<th>Name of the Scheme / Programme and Budget Allocation (Rs. Lakhs)</th>
			<th>Objectives</th>
			<th>Output Indicators</th>
			<th>Output Baseline ({{ date('Y', strtotime('-2 years')) }} - {{ date('Y', strtotime('-1 years')) }})</th>
			<th>Output Targets ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</th>
			<th>Output Achievement ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</th>
			<th>Output Targets ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }})</th>
			<th>Output Achievement ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }}) upto {{ $month.', '.date('Y') }}</th>
			{{-- <th>Target({{ date('Y', strtotime('+1 years')) }} - {{ date('y', strtotime('+2 years')) }})</th> --}}
			<th>Outcome Indicators</th>
			<th>Outcome Baseline ({{ date('Y', strtotime('-2 years')) }} - {{ date('Y', strtotime('-1 years')) }})</th>
			<th>Outcome Targets ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</th>
			<th>Outcome Achievement ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</th>
			<th>Outcome Targets ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }})</th>
			<th>Outcome Achievement ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }}) upto {{ $month.', '.date('Y') }}</th>
			{{-- <th>Target({{ date('Y', strtotime('+1 years')) }} - {{ date('y', strtotime('+2 years')) }})</th> --}}
			<th>Remarks</th>
		</tr>
	</thead>
	<tbody>
		@if(count($schemes))
		<tr class="not-printable" style="background-color: #FAFAFA;">
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important; border-left: 1px solid #DDD !important;">&nbsp;</td>
			{{-- <td style="border: none !important;">&nbsp;</td> --}}
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;"><b>Outputs</b></td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			{{-- <td style="border: none !important;">&nbsp;</td> --}}
			<td style="border: none !important;"><b>Outcomes</b></td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
			<td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
			<td style="border: none !important;">&nbsp;</td>
		</tr>
		<tr class="not-printable" style="background-color: #FAFAFA;">
			<td><b>Department Name</b></td>
			<td><b>S. No.</b></td>
			<td><b>Name of the Scheme / Programme and Budget Allocation (Rs. Lakhs)</b></td>
			<td><b>Objectives</b></td>
			<td><b>Indicators</b></td>
			<td><b>Baseline ({{ date('Y', strtotime('-2 years')) }} - {{ date('Y', strtotime('-1 years')) }})</b></td>
			<td><b>Targets ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</b></td>
			<td><b>Achievement ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</b></td>
			<td><b>Targets ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }})</b></td>
			<td><b>Achievement ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }}) upto {{ $month.', '.date('Y') }}</b></td>
			{{-- <td><b>Target({{ date('Y', strtotime('+1 years')) }} - {{ date('y', strtotime('+2 years')) }})</b></td> --}}
			<td><b>Indicators</b></td>
			<td><b>Baseline ({{ date('Y', strtotime('-2 years')) }} - {{ date('Y', strtotime('-1 years')) }})</b></td>
			<td><b>Targets ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</b></td>
			<td><b>Achievement ({{ date('Y', strtotime('-1 years')) }} - {{ date('y') }})</b></td>
			<td><b>Targets ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }})</b></td>
			<td><b>Achievement ({{ date('Y') }} - {{ date('y', strtotime('+1 years')) }}) upto {{ $month.', '.date('Y') }}</b></td>
			{{-- <td><b>Target({{ date('Y', strtotime('+1 years')) }} - {{ date('y', strtotime('+2 years')) }})</b></td> --}}
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
			<td>16</td>
			<td>17</td>
		</tr>
		@php
			$dept_name_arr = array();
			$sch_arr = array();
			$obj_arr = array();
			$opi_arr = array();
			$oci_arr = array();
			$opb_arr = array();
			$ocb_arr = array();
			$opb_arr = array();
			$opt_arr = array();
			$oct_arr = array();
			$base_date_beg = date('Y', strtotime('-1 years'));
			$base_date_end = date('Y');
			$i=0;
		@endphp
		{{-- @php print_r(count($schemes)); @endphp --}}
		@foreach($schemes as $key=>$value)
			@php
				$sch_name = "&nbsp;";
				// $sch_remrk = "&nbsp;";
				if(!in_array($value['sch_id'], $sch_arr)){
					$sch_name = $value['sch_name'];
					$count_no = ++$i;
					$tdschclass = '';
				}
				else{
					$count_no = '';
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

				if(!in_array($value['dept_name'], $dept_name_arr)){
					$dept_name = $value['dept_name'];
					$tddeptclass = '';
				}
				else{
					$dept_name = "";
					$tddeptclass = 'td-no-bord';
				}

				if(!empty($value['opi'])){
					if(in_array($value['opi'], $opi_arr)){
						// $value['opi'] = '';
						// $tdopiclass = 'td-no-bord';
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
						// $value['oci'] = '';
						// $tdociclass = 'td-no-bord';
					}
					else{
						$tdociclass = '';
					}
				}
				else{
					$tdociclass = '';
				}

				// if(!empty($value['ocb_id'])){
				// 	if(in_array($value['ocb_id'], $ocb_arr)){
				// 		$value['ocb'] = '';
				// 		$tdocbclass = 'td-no-bord';
				// 	}
				// 	else{
				// 		$tdocbclass = '';
				// 	}
				// }
				// else{
				// 	$tdocbclass = '';
				// }

				// if(!empty($value['opb_id'])){
				// 	if(in_array($value['opb_id'], $opb_arr)){
				// 		$value['opb'] = '';
				// 		$tdopbclass = 'td-no-bord';
				// 	}
				// 	else{
				// 		$tdopbclass = '';
				// 	}
				// }
				// else{
				// 	$tdopbclass = '';
				// }

				// if(!empty($value['opt_id'])){
				// 	if(in_array($value['opt_id'], $opt_arr)){
				// 		$value['opt'] = '';
				// 		$tdoptclass = 'td-no-bord';
				// 	}
				// 	else{
				// 		$tdoptclass = '';
				// 	}
				// }
				// else{
				// 	$tdoptclass = '';
				// }

				// if(!empty($value['oct_id'])){
				// 	if(in_array($value['oct_id'], $oct_arr)){
				// 		$value['oct'] = '';
				// 		$tdoctclass = 'td-no-bord';
				// 	}
				// 	else{
				// 		$tdoctclass = '';
				// 	}
				// }
				// else{
				// 	$tdoctclass = '';
				// }


				if(!empty($value['opi_st'])){

					if($value['opi_st'] == 1){
						$color = 'background-color: #F0AD4E !important; color: #FFF !important;';
					}
					elseif($value['opi_st'] == 2){
						$color = 'background-color: #5cb85c !important; color: #FFF !important;';
					}
					elseif($value['opi_st'] == 3){
						$color = 'background-color: #D9534F !important; color: #FFF !important;';
					}
					elseif($value['opi_st'] == 4){
						$color = 'background-color: #777 !important; color: #FFF !important;';
					}
				}
				else{
					$color = '';
					$value['opi_st'] ='';
				}

				if(!empty($value['oci_st'])){

					if($value['oci_st'] == 1){
						$color1 = 'background-color: #F0AD4E !important; color: #FFF !important;';
					}
					elseif($value['oci_st'] == 2){
						$color1 = 'background-color: #5cb85c !important; color: #FFF !important;';
					}
					elseif($value['oci_st'] == 3){
						$color1 = 'background-color: #D9534F !important; color: #FFF !important;';
					}
					elseif($value['oci_st'] == 4){
						$color1 = 'background-color: #777 !important; color: #FFF !important;';
					}
				}
				else{
					$color1 = '';
					$value['oci_st'] ='';
				}

				array_push($sch_arr, $value['sch_id']);
				array_push($obj_arr, $value['obj_id']);
				if(!empty($value['opi'])){
					array_push($opi_arr, $value['opi']);
				}

				if(!empty($value['dept_name'])){
					array_push($dept_name_arr, $value['dept_name']);
				}


				// if(!empty($value['ocb_id'])){
				// 	array_push($ocb_arr, $value['ocb_id']);
				// }
				// if(!empty($value['opb_id'])){
				// 	array_push($opb_arr, $value['opb_id']);
				// }




				// if(!empty($value['oct_id'])){
				// 	array_push($oct_arr, $value['oct_id']);
				// }


				// if(!empty($value['opt_id'])){
				// 	array_push($opt_arr, $value['opt_id']);
				// }


				if(!empty($value['oci'])){
					array_push($oci_arr, $value['oci']);
				}

				$tdbaseopClass = "";
				// if(!empty($value['opb_beg'])){
				// 	if(!(date('Y', strtotime($value['opb_beg'])) == $base_date_beg)){
				// 		$value['opb'] = "";
				// 		$value['opt'] = "";
				// 		$value['opt_stat'] = "";
				// 		$tdbaseopClass = "td-no-bord";
				// 	}
				// }

				$tdbaseocClass = "";
				// if(!empty($value['ocb_beg'])){
				// 	if(!(date('Y', strtotime($value['ocb_beg'])) == $base_date_beg)){
				// 		$value['ocb'] = "";
				// 		$value['oct'] = "";
				// 		$value['oct_stat'] = "";
				// 		$tdbaseocClass = "td-no-bord";
				// 	}
				// }







				// $dept_name = (!empty($value['dept_name']))?$value['dept_name']:"&nbsp;";
				$opi = (!empty($value['opi']))?$value['opi']:"&nbsp;";
				$opb = (!empty($value['opb']))?$value['opb']:"&nbsp;";
				$opt = (!empty($value['opt']))?$value['opt']:"&nbsp;";
				$targ_last = (!empty($value['targ_last']))?$value['targ_last']:"&nbsp;";
				$opt_stat = (!empty($value['opt_stat']))?$value['opt_stat']:"&nbsp;";
				$opt_stat_last = (!empty($value['opt_stat_last']))?$value['opt_stat_last']:"&nbsp;";
				$targ_next = (!empty($value['targ_next']))?$value['targ_next']:"&nbsp;";
				$oci = (!empty($value['oci']))?$value['oci']:"&nbsp;";
				$ocb = (!empty($value['ocb']))?$value['ocb']:"&nbsp;";
				$oct = (!empty($value['oct']))?$value['oct']:"&nbsp;";
				$oct_stat = (!empty($value['oct_stat']))?$value['oct_stat']:"&nbsp;";
				$oct_stat_last = (!empty($value['oct_stat_last']))?$value['oct_stat_last']:"&nbsp;";
				$outc_targ_last = (!empty($value['outc_targ_last']))?$value['outc_targ_last']:"&nbsp;";
				$outc_targ_next = (!empty($value['outc_targ_next']))?$value['outc_targ_next']:"&nbsp;";
				$rem = (!empty($value['rem']))?$value['rem']:"&nbsp;";
				// $sch_remrk = (!empty($sch_remrk))?$sch_remrk:"&nbsp;";

					if(DateTime::createFromFormat('Y-m-d G:i:s', $opb) !== FALSE){
						$opb = date('G:i', strtotime($opb));
					}

					if(DateTime::createFromFormat('Y-m-d G:i:s', $targ_last) !== FALSE){
						$targ_last = date('G:i', strtotime($targ_last));
					}

					if(DateTime::createFromFormat('Y-m-d G:i:s', $opt_stat_last) !== FALSE){
						$opt_stat_last = date('G:i', strtotime($opt_stat_last));
					}

					if(DateTime::createFromFormat('Y-m-d G:i:s', $targ_next) !== FALSE){
						$targ_next = date('G:i', strtotime($targ_next));
					}

					if(DateTime::createFromFormat('Y-m-d G:i:s', $opt_stat) !== FALSE){
						$opt_stat = date('G:i', strtotime($opt_stat));
					}

				if ((strpos($opi, '%age') !== false) ||(strpos($opi, '%') !== false) || (strpos($opi, 'percentage') !== false) || (strpos($opi, 'Percentage') !== false) || (strpos($opi, 'percent') !== false) || (strpos($opi, 'Percent') !== false)) {
					// $opb = (int) $opb;
					$opb = trim($opb);
					$opt_stat_last = trim($opt_stat_last);
					$targ_next = trim($targ_next);
					$targ_last = trim($targ_last);
					$opt_stat = trim($opt_stat);

					if(is_numeric($opb) && $opb >=0 && $opb <= 1){
						$opb *= 100;
						$opb = round($opb, 2);
						$opb = $opb.'%';
					}

					if(is_numeric($targ_last) && $targ_last >=0 && $targ_last <= 1){
						$targ_last *= 100;
						$targ_last = round($targ_last, 2);
						$targ_last = $targ_last.'%';
					}
					if(is_numeric($opt_stat_last) && $opt_stat_last >=0 && $opt_stat_last <= 1){
						$opt_stat_last *= 100;
						$opt_stat_last = round($opt_stat_last, 2);
						$opt_stat_last = $opt_stat_last.'%';
					}
					if(is_numeric($targ_next) && $targ_next >=0 && $targ_next <= 1){
						$targ_next *= 100;
						$targ_next = round($targ_next, 2);
						$targ_next = $targ_next.'%';
					}
					if(is_numeric($opt_stat) && $opt_stat >=0 && $opt_stat <= 1){
						$opt_stat *= 100;
						$opt_stat = round($opt_stat, 2);
						$opt_stat = $opt_stat.'%';
					}
				}



					if(DateTime::createFromFormat('Y-m-d G:i:s', $ocb) !== FALSE){
						$ocb = date('G:i', strtotime($ocb));
					}

					if(DateTime::createFromFormat('Y-m-d G:i:s', $outc_targ_last) !== FALSE){
						$outc_targ_last = date('G:i', strtotime($outc_targ_last));
					}
					if(DateTime::createFromFormat('Y-m-d G:i:s', $outc_targ_next) !== FALSE){
						$outc_targ_next = date('G:i', strtotime($outc_targ_next));
					}
					if(DateTime::createFromFormat('Y-m-d G:i:s', $oct_stat) !== FALSE){
						$oct_stat = date('G:i', strtotime($oct_stat));
					}
					if(DateTime::createFromFormat('Y-m-d G:i:s', $oct_stat_last) !== FALSE){
						$oct_stat_last = date('G:i', strtotime($oct_stat_last));
					}

				if ((strpos($oci, '%') !== false) || (strpos($oci, 'Percentage') !== false) || (strpos($oci, 'percentage') !== false) || (strpos($oci, 'percent') !== false) || (strpos($oci, 'Percent') !== false)) {

					if(is_numeric($ocb) && $ocb >=0 && $ocb <= 1){
						$ocb *= 100;
						$ocb = round($ocb, 2);
						$ocb = $ocb.'%';
					}
					if(is_numeric($outc_targ_last) && $outc_targ_last >=0 && $outc_targ_last <= 1){
						$outc_targ_last *= 100;
						$outc_targ_last = round($outc_targ_last, 2);
						$outc_targ_last = $outc_targ_last.'%';
					}
					if(is_numeric($outc_targ_next) && $outc_targ_next >=0 && $outc_targ_next <= 1){
						$outc_targ_next *= 100;
						$outc_targ_next = round($outc_targ_next, 2);
						$outc_targ_next = $outc_targ_next.'%';
					}
					if(is_numeric($oct_stat) && $oct_stat >=0 && $oct_stat <= 1){
						$oct_stat *= 100;
						$oct_stat = round($oct_stat, 2);
						$oct_stat = $oct_stat.'%';
					}
					if(is_numeric($oct_stat_last) && $oct_stat_last >=0 && $oct_stat_last <= 1){
						$oct_stat_last *= 100;
						$oct_stat_last = round($oct_stat_last, 2);
						$oct_stat_last = $oct_stat_last.'%';
					}
				}
			@endphp
		<tr>
			<td class="{{ $tddeptclass }}">@php echo htmlspecialchars_decode($dept_name) @endphp</td>
			<td class="{{ $tdschclass }}">@php echo htmlspecialchars_decode($count_no) @endphp</td>
			<td class="{{ $tdschclass }}">@php echo htmlspecialchars_decode($sch_name) @endphp</td>
			<td class="{{ $tdobjclass }}">@php echo htmlspecialchars_decode($obj_desc) @endphp</td>
			<td class="{{ $tdopiclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($opi) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opb) @endphp</td>
			<td class="" style="{{ $color  }}">@php echo htmlspecialchars_decode($targ_last) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opt_stat_last) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($targ_next) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opt_stat) @endphp</td>
			<td class="{{ $tdociclass }}" style="{{ $color1  }}">@php echo htmlspecialchars_decode($oci) @endphp</td>
			<td style="{{ $color1  }}">@php echo htmlspecialchars_decode($ocb) @endphp</td>
			<td style="{{ $color1  }}">@php echo htmlspecialchars_decode($outc_targ_last) @endphp</td>
			<td style="{{ $color1  }}">@php echo htmlspecialchars_decode($oct_stat_last) @endphp</td>
			<td style="{{ $color1  }}">@php echo htmlspecialchars_decode($outc_targ_next) @endphp</td>
			<td style="{{ $color1  }}">@php echo htmlspecialchars_decode($oct_stat) @endphp</td>
			<td style="{{ $color1  }}" class="">@php echo htmlspecialchars_decode($rem) @endphp</td>
			{{-- <td class="{{ $tddeptclass }}">@php echo htmlspecialchars_decode($dept_name) @endphp</td>
			<td class="{{ $tdschclass }}">@php echo htmlspecialchars_decode($sch_name) @endphp</td>
			<td class="{{ $tdobjclass }}">@php echo htmlspecialchars_decode($obj_desc) @endphp</td>
			<td class="{{ $tdopiclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($opi) @endphp</td>
			<td class="{{ $tdopbclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($opb) @endphp</td>
			<td class="{{ $tdopbclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($opb) @endphp</td>
			<td class="{{ $tdoptclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($opt) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($opt_stat) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($targ_next) @endphp</td> --}}
			{{-- <td class="{{ $tdociclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($oci) @endphp</td>
			<td class="{{ $tdocbclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($ocb) @endphp</td>
			<td class="{{ $tdoctclass }}" style="{{ $color  }}">@php echo htmlspecialchars_decode($oct) @endphp</td>
			<td style="{{ $color  }}">@php echo htmlspecialchars_decode($oct_stat) @endphp</td> --}}
			{{-- <td style="{{ $color  }}">@php echo htmlspecialchars_decode($outc_targ_next) @endphp</td> --}}
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