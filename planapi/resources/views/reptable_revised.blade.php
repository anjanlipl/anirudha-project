<style type="text/css">
	table.rep-table{
		border: 1px solid #DDD !important;
		/*ghfhgf*/
	}
	.rep-table thead{
		/*display: inline-block;*/
		/*white-space: nowrap;*/
	}
	body .rep-table th{
		text-align: center;
        padding: 0px !important;
        height: 0px !important;
        font-size: 0px;
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

    .dt-buttons > .dt-button {
        height: 24px;
        margin-right: 10px;
        border-radius: 5px;
        background-color: #DDD;
        color: #222;
        border: none;
        font-size: 12px;
        margin-bottom: 20px;
        margin-top: 20px;
        font-weight: 600;
        border: 1px solid #AAA;
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
<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
<div class="dash-sec-thumb-title text-center" id="dashSecThumbTitle">{{ ($head)?$head:'OUTCOME BUDGET- 2018-19' }}</div>
<input type="hidden" id="titleText" value="{{ ($head)?$head:'OUTCOME BUDGET- 2018-19' }}">
<button onclick="printDiv('#printRepCont')" id="printReport" class="btn btn-primary">Print Report</button>
<div id="printRepCont">
    <table class="rep-table" id="ExcelTable">
        <thead style="opacity: 0; visibility: hidden;">
            <tr role="row">
                <th>S. No.</th>
                <th>Name of the Scheme / Programme and Budget Allocation (Rs. Lakhs)</th>
                <th>Objectives</th>
                <th>Output Indicators</th>
                <th>Output Baseline (2016 - 2017)</th>
                <th>Output Targets (2017 - 18)</th>
                <th>Output Achievement (2017 - 18)</th>
                <th>Output Targets (2018 - 19)</th>
                <th>Output Achievement (2018 - 19) upto September, 2018</th>
                <th>Outcome Indicators</th>
                <th>Outcome Baseline (2016 - 2017)</th>
                <th>Outcome Targets (2017 - 18)</th>
                <th>Outcome Achievement (2017 - 18)</th>
                <th>Outcome Targets (2018 - 19)</th>
                <th>Outcome Achievement (2018 - 19) upto September, 2018</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @if(count($schemes))
                <tr class="not-printable" style="background-color: #EEE;">
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
                <tr class="not-printable" style="background-color: #EEE;">
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
                </tr>
                @php
                    $sch_arr= array();
                    $obj_arr = array();
                    $i=0;
                @endphp
                @foreach($schemes as $key=>$value)
                @php
                    $scheme_name = $value['scheme_name'];
                    if(in_array($scheme_name, $sch_arr)){
                        $scheme_name = "&nbsp;";
                        $x = "&nbsp;";
                    }
                    else{
                        $x = ++$i;
                        array_push($sch_arr, $scheme_name);
                    }
                    $obj_name = $value['obj_name'];
                    if(in_array($obj_name, $obj_arr)){
                        $obj_name = "&nbsp;";
                    }
                    else{
                        array_push($obj_arr, $obj_name);
                    }
                    $opi_name = $value['opi_name'];
                    $opb = $value['opb'];
                    $targ_last = $value['targ_last'];
                    $status_last = $value['status_last'];
                    $targ_next = $value['targ_next'];
                    $status = $value['status'];
                    $oci_name = $value['oci_name'];
                    $ocb = $value['ocb'];
                    $oc_targ_last = $value['oc_targ_last'];
                    $oc_status_last = $value['oc_status_last'];
                    $oc_targ_next = $value['oc_targ_next'];
                    $oc_status = $value['oc_status'];
                    $rem = $value['rem'];
                    

                    if(!empty($value['opi_ind_status'])){

                        if($value['opi_ind_status'] == 1){
                            $color = 'background-color: yellow !important; color: #222 !important;';
                        }
                        elseif($value['opi_ind_status'] == 2){
                            $color = 'background-color: #5cb85c !important; color: #FFF !important;';
                        }
                        elseif($value['opi_ind_status'] == 3){
                            $color = 'background-color: #D9534F !important; color: #FFF !important;';
                        }
                        elseif($value['opi_ind_status'] == 4){
                            $color = 'background-color: #777 !important; color: #FFF !important;';
                        }
                    }
                    else{
                        $color = '';
                        $value['opi_ind_status'] ='';
                    }

                    if(!empty($value['oci_ind_status'])){

                        if($value['oci_ind_status'] == 1){
                            $color1 = 'background-color: yellow !important; color: #222 !important;';
                        }
                        elseif($value['oci_ind_status'] == 2){
                            $color1 = 'background-color: #5cb85c !important; color: #FFF !important;';
                        }
                        elseif($value['oci_ind_status'] == 3){
                            $color1 = 'background-color: #D9534F !important; color: #FFF !important;';
                        }
                        elseif($value['oci_ind_status'] == 4){
                            $color1 = 'background-color: #777 !important; color: #FFF !important;';
                        }
                    }
                    else{
                        $color1 = '';
                        $value['oci_ind_status'] ='';
                    }








                    if(DateTime::createFromFormat('Y-m-d G:i:s', $opb) !== FALSE){
                        $opb = date('G:i', strtotime($opb));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $targ_last) !== FALSE){
                        $targ_last = date('G:i', strtotime($targ_last));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $status_last) !== FALSE){
                        $status_last = date('G:i', strtotime($status_last));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $targ_next) !== FALSE){
                        $targ_next = date('G:i', strtotime($targ_next));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $status) !== FALSE){
                        $status = date('G:i', strtotime($status));
                    }



                    if(DateTime::createFromFormat('Y-m-d G:i:s', $ocb) !== FALSE){
                        $ocb = date('G:i', strtotime($ocb));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $oc_targ_last) !== FALSE){
                        $oc_targ_last = date('G:i', strtotime($oc_targ_last));
                    }
                    if(DateTime::createFromFormat('Y-m-d G:i:s', $oc_targ_next) !== FALSE){
                        $oc_targ_next = date('G:i', strtotime($oc_targ_next));
                    }
                    if(DateTime::createFromFormat('Y-m-d G:i:s', $oc_status) !== FALSE){
                        $oc_status = date('G:i', strtotime($oc_status));
                    }
                    if(DateTime::createFromFormat('Y-m-d G:i:s', $oc_status_last) !== FALSE){
                        $oc_status_last = date('G:i', strtotime($oc_status_last));
                    }









                    if ((strpos($opi_name, '%age') !== false) ||(strpos($opi_name, '%') !== false) || (strpos($opi_name, 'percentage') !== false) || (strpos($opi_name, 'Percentage') !== false) || (strpos($opi_name, 'percent') !== false) || (strpos($opi_name, 'Percent') !== false)) {
                        // $opb = (int) $opb;
                        $opb = trim($opb);
                        $status_last = trim($status_last);
                        $targ_next = trim($targ_next);
                        $targ_last = trim($targ_last);
                        $status = trim($status);

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
                        if(is_numeric($status_last) && $status_last >=0 && $status_last <= 1){
                            $status_last *= 100;
                            $status_last = round($status_last, 2);
                            $status_last = $status_last.'%';
                        }
                        if(is_numeric($targ_next) && $targ_next >=0 && $targ_next <= 1){
                            $targ_next *= 100;
                            $targ_next = round($targ_next, 2);
                            $targ_next = $targ_next.'%';
                        }
                        if(is_numeric($status) && $status >=0 && $status <= 1){
                            $status *= 100;
                            $status = round($status, 2);
                            $status = $status.'%';
                        }
                    }

                    if ((strpos($oci_name, '%') !== false) || (strpos($oci_name, 'Percentage') !== false) || (strpos($oci_name, 'percentage') !== false) || (strpos($oci_name, 'percent') !== false) || (strpos($oci_name, 'Percent') !== false)) {

                        if(is_numeric($ocb) && $ocb >=0 && $ocb <= 1){
                            $ocb *= 100;
                            $ocb = round($ocb, 2);
                            $ocb = $ocb.'%';
                        }
                        if(is_numeric($oc_targ_last) && $oc_targ_last >=0 && $oc_targ_last <= 1){
                            $oc_targ_last *= 100;
                            $oc_targ_last = round($oc_targ_last, 2);
                            $oc_targ_last = $oc_targ_last.'%';
                        }
                        if(is_numeric($oc_targ_next) && $oc_targ_next >=0 && $oc_targ_next <= 1){
                            $oc_targ_next *= 100;
                            $oc_targ_next = round($oc_targ_next, 2);
                            $oc_targ_next = $oc_targ_next.'%';
                        }
                        if(is_numeric($oc_status) && $oc_status >=0 && $oc_status <= 1){
                            $oc_status *= 100;
                            $oc_status = round($oc_status, 2);
                            $oc_status = $oc_status.'%';
                        }
                        if(is_numeric($oc_status_last) && $oc_status_last >=0 && $oc_status_last <= 1){
                            $oc_status_last *= 100;
                            $oc_status_last = round($oc_status_last, 2);
                            $oc_status_last = $oc_status_last.'%';
                        }
                    }



                @endphp
                <tr>
                    <td>@php echo htmlspecialchars_decode($x) @endphp</td>
                    <td>@php echo htmlspecialchars_decode($scheme_name) @endphp</td>
                    <td>@php echo htmlspecialchars_decode($obj_name) @endphp</td>
                    <td style="{{ $color }}">@php echo htmlspecialchars_decode($opi_name) @endphp</td>
                    <td style="{{ $color }}">@php echo htmlspecialchars_decode($opb) @endphp</td>
                    <td style="{{ $color }}">@php echo htmlspecialchars_decode($targ_last) @endphp</td>
                    <td style="{{ $color }}">@php echo htmlspecialchars_decode($status_last) @endphp</td>
                    <td style="{{ $color }}">@php echo htmlspecialchars_decode($targ_next) @endphp</td>
                    <td style="{{ $color }}">@php echo htmlspecialchars_decode($status) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($oci_name) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($ocb) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($oc_targ_last) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($oc_status_last) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($oc_targ_next) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($oc_status) @endphp</td>
                    <td style="{{ $color1 }}">@php echo htmlspecialchars_decode($rem) @endphp</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<script>
    printDivCSS = new String ('<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"><link href="assets/css/style.css" rel="stylesheet" type="text/css">')
    function printDiv(divId) {
        var rep_tab = $(divId).html();
        window.frames["print_frame"].document.body.innerHTML=printDivCSS + rep_tab;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }
</script>