
<style type="text/css">
	body table.dataTable.no-footer.rep-table{
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
	.rep-table th, .rep-table td{
		text-align: justify !important;
		/*display: inline-block;*/
		/*min-height: 100px !important;*/
		min-width: unset !important;
		/*column-span: 2;*/
		vertical-align: middle !important;
	}
    body .rep-table tr.not-printable td{
        text-align: center !important;
    }
	.rep-table td{
		border: 1px solid rgb(0, 0, 0) !important;
		/*border-bottom: 1px solid #AAA;*/
		border-bottom: none !important;
		font-weight: 400 !important;
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
                <th>Allocations</th>
                <th>Expenditures</th>
                <th>Objectives</th>
                <th>Indicators</th>
                {{-- <th>Baseline (2016 - 2017)</th>
                <th>Targets (2017 - 18)</th>
                <th>Achievement (2017 - 18)</th> --}}
                <th>Targets {{ date('d-m-Y', strtotime($targ_begin_date)) }} to {{ date('d-m-Y', strtotime($targ_end_date)) }}</th>
                <th>Achievement {{ date('d-m-Y', strtotime($begin_date)) }} to {{ date('d-m-Y', strtotime($end_date)) }}</th>
                <th>Indicators</th>
                {{-- <th>Baseline (2016 - 2017)</th>
                <th>Targets (2017 - 18)</th>
                <th>Achievement (2017 - 18)</th> --}}
                <th>Targets  {{ date('d-m-Y', strtotime($targ_begin_date)) }} to {{ date('d-m-Y', strtotime($targ_end_date)) }}</th>
                <th>Achievement  {{ date('d-m-Y', strtotime($begin_date)) }} to {{ date('d-m-Y', strtotime($end_date)) }}</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @if(count($schemes))
                <tr class="not-printable" style="background-color: #EEE;">
                    <td style="border: none !important;">&nbsp;</td>
                    <td style="border: none !important;">&nbsp;</td>
                    <td style="border: none !important; border-left: 1px solid #DDD !important;"><b>Financials</b></td>
                    <td style="border: none !important;">&nbsp;</td>
                    <td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
                    <td style="border: none !important; border-left: 1px solid #DDD !important;">&nbsp;</td>
                    <td style="border: none !important;"><b>Outputs</b></td>
                    <td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
                    <td style="border: none !important;">&nbsp;</td>
                    <td style="border: none !important;"><b>Outcomes</b></td>
                    <td style="border: none !important; border-right: 1px solid #DDD !important;">&nbsp;</td>
                    <td style="border: none !important;">&nbsp;</td>
                </tr>
                <tr class="not-printable" style="background-color: #EEE;">
                    <td><b>S. No.</b></td>
                    <td><b>Name of the Scheme / Programme and Budget Allocation (Rs. Lakhs)</b></td>
                    <td><b>Allocations</b></td>
                    <td><b>Expenditure</b></td>
                    <td><b>Objectives</b></td>
                    <td><b>Indicators</b></td>
                    <td><b>Targets {{ date('d-m-Y', strtotime($targ_begin_date)) }} to {{ date('d-m-Y', strtotime($targ_end_date)) }}</b></td>
                    <td><b>Achievement {{ date('d-m-Y', strtotime($begin_date)) }} to {{ date('d-m-Y', strtotime($end_date)) }}</b></td>
                    {{-- <td><b>Target({{ date('Y', strtotime('+1 years')) }} - {{ date('y', strtotime('+2 years')) }})</b></td> --}}
                    <td><b>Indicators</b></td>
                    <td><b>Targets {{ date('d-m-Y', strtotime($targ_begin_date)) }} to {{ date('d-m-Y', strtotime($targ_end_date)) }}</b></td>
                    <td><b>Achievement {{ date('d-m-Y', strtotime($begin_date)) }} to {{ date('d-m-Y', strtotime($end_date)) }}</b></td>
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
                </tr>
                @php
                    $i=0;
                @endphp
                @foreach($schemes as $key=>$value)
                    @php
                        if(!empty($value['opi_ind_status'])){


                            $opi_ind_crit = ($value['opi_ind_crit'])?"<p><b>Critical</b></p>":"<p><b>Non Critical</b></p>";
                            
                            if($value['opi_ind_status'] == 1){
                                $opi_ind_status_text = "<p><b>Status:</b> NA</p>";
                                $color = 'background-color: yellow !important; color: #222 !important;';
                            }
                            elseif($value['opi_ind_status'] == 2){
                                $opi_ind_status_text = "<p><b>Status:</b> On Track</p>";
                                $color = 'background-color: #5cb85c !important; color: #222 !important;';
                            }
                            elseif($value['opi_ind_status'] == 3){
                                $opi_ind_status_text = "<p><b>Status:</b> Off Track</p>";
                                $color = 'background-color: #D9534F !important; color: #222 !important;';
                            }
                            elseif($value['opi_ind_status'] == 4){
                                $opi_ind_status_text = "<p><b>Status:</b> NR</p>";
                                $color = 'background-color: #777 !important; color: #222 !important;';
                            }

                        }
                        else{
                            $color = '';
                            $opi_ind_crit = "";
                            $opi_ind_status_text = "";
                            $value['opi_ind_status'] ='';
                        }

                        if(!empty($value['oci_ind_status'])){

                            $oci_ind_crit = ($value['oci_ind_crit'])?"<p><b>Critical</b></p>":"<p><b>Non Critical</b></p>";

                            if($value['oci_ind_status'] == 1){
                                $oci_ind_status_text = "<p><b>Status:</b> NA</p>";
                                $color1 = 'background-color: yellow !important; color: #222 !important;';
                            }
                            elseif($value['oci_ind_status'] == 2){
                                $oci_ind_status_text = "<p><b>Status:</b> On Track</p>";
                                $color1 = 'background-color: #5cb85c !important; color: #222 !important;';
                            }
                            elseif($value['oci_ind_status'] == 3){
                                $oci_ind_status_text = "<p><b>Status:</b> Off Track</p>";
                                $color1 = 'background-color: #D9534F !important; color: #222 !important;';
                            }
                            elseif($value['oci_ind_status'] == 4){
                                $oci_ind_status_text = "<p><b>Status:</b> NR</p>";
                                $color1 = 'background-color: #777 !important; color: #222 !important;';
                            }

                        }
                        else{
                            
                            $oci_ind_crit = "";
                            $oci_ind_status_text = "";
                            $color1 = '';
                            $value['oci_ind_status'] ='';

                        }


                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['opb']) !== FALSE){
                        $value['opb'] = date('G:i', strtotime($value['opb']));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['targ_last']) !== FALSE){
                        $value['targ_last'] = date('G:i', strtotime($value['targ_last']));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['status_last']) !== FALSE){
                        $value['status_last'] = date('G:i', strtotime($value['status_last']));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['targ_next']) !== FALSE){
                        $value['targ_next'] = date('G:i', strtotime($value['targ_next']));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['status']) !== FALSE){
                        $value['status'] = date('G:i', strtotime($value['status']));
                    }



                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['ocb']) !== FALSE){
                        $value['ocb'] = date('G:i', strtotime($value['ocb']));
                    }

                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['oc_targ_last']) !== FALSE){
                        $value['oc_targ_last'] = date('G:i', strtotime($value['oc_targ_last']));
                    }
                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['oc_targ_next']) !== FALSE){
                        $value['oc_targ_next'] = date('G:i', strtotime($value['oc_targ_next']));
                    }
                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['oc_status']) !== FALSE){
                        $value['oc_status'] = date('G:i', strtotime($value['oc_status']));
                    }
                    if(DateTime::createFromFormat('Y-m-d G:i:s', $value['oc_status_last']) !== FALSE){
                        $value['oc_status_last'] = date('G:i', strtotime($value['oc_status_last']));
                    }









                    if ((strpos($value['out_ind'], '%age') !== false) ||(strpos($value['out_ind'], '%') !== false) || (strpos($value['out_ind'], 'percentage') !== false) || (strpos($value['out_ind'], 'Percentage') !== false) || (strpos($value['out_ind'], 'percent') !== false) || (strpos($value['out_ind'], 'Percent') !== false)) {
                        // $value['opb'] = (int) $value['opb'];
                        $value['opb'] = trim($value['opb']);
                        $value['status_last'] = trim($value['status_last']);
                        $value['targ_next'] = trim($value['targ_next']);
                        $value['targ_last'] = trim($value['targ_last']);
                        $value['status'] = trim($value['status']);

                        if(is_numeric($value['opb']) && $value['opb'] >=0 && $value['opb'] <= 1){
                            $value['opb'] *= 100;
                            $value['opb'] = round($value['opb'], 2);
                            $value['opb'] = $value['opb'].'%';
                        }

                        if(is_numeric($value['targ_last']) && $value['targ_last'] >=0 && $value['targ_last'] <= 1){
                            $value['targ_last'] *= 100;
                            $value['targ_last'] = round($value['targ_last'], 2);
                            $value['targ_last'] = $value['targ_last'].'%';
                        }
                        if(is_numeric($value['status_last']) && $value['status_last'] >=0 && $value['status_last'] <= 1){
                            $value['status_last'] *= 100;
                            $value['status_last'] = round($value['status_last'], 2);
                            $value['status_last'] = $value['status_last'].'%';
                        }
                        if(is_numeric($value['targ_next']) && $value['targ_next'] >=0 && $value['targ_next'] <= 1){
                            $value['targ_next'] *= 100;
                            $value['targ_next'] = round($value['targ_next'], 2);
                            $value['targ_next'] = $value['targ_next'].'%';
                        }
                        if(is_numeric($value['status']) && $value['status'] >=0 && $value['status'] <= 1){
                            $value['status'] *= 100;
                            $value['status'] = round($value['status'], 2);
                            $value['status'] = $value['status'].'%';
                        }
                    }

                    if ((strpos($value['outc_ind'], '%') !== false) || (strpos($value['outc_ind'], 'Percentage') !== false) || (strpos($value['outc_ind'], 'percentage') !== false) || (strpos($value['outc_ind'], 'percent') !== false) || (strpos($value['outc_ind'], 'Percent') !== false)) {

                        if(is_numeric($value['ocb']) && $value['ocb'] >=0 && $value['ocb'] <= 1){
                            $value['ocb'] *= 100;
                            $value['ocb'] = round($value['ocb'], 2);
                            $value['ocb'] = $value['ocb'].'%';
                        }
                        if(is_numeric($value['oc_targ_last']) && $value['oc_targ_last'] >=0 && $value['oc_targ_last'] <= 1){
                            $value['oc_targ_last'] *= 100;
                            $value['oc_targ_last'] = round($value['oc_targ_last'], 2);
                            $value['oc_targ_last'] = $value['oc_targ_last'].'%';
                        }
                        if(is_numeric($value['oc_targ_next']) && $value['oc_targ_next'] >=0 && $value['oc_targ_next'] <= 1){
                            $value['oc_targ_next'] *= 100;
                            $value['oc_targ_next'] = round($value['oc_targ_next'], 2);
                            $value['oc_targ_next'] = $value['oc_targ_next'].'%';
                        }
                        if(is_numeric($value['oc_status']) && $value['oc_status'] >=0 && $value['oc_status'] <= 1){
                            $value['oc_status'] *= 100;
                            $value['oc_status'] = round($value['oc_status'], 2);
                            $value['oc_status'] = $value['oc_status'].'%';
                        }
                        if(is_numeric($value['oc_status_last']) && $value['oc_status_last'] >=0 && $value['oc_status_last'] <= 1){
                            $value['oc_status_last'] *= 100;
                            $value['oc_status_last'] = round($value['oc_status_last'], 2);
                            $value['oc_status_last'] = $value['oc_status_last'].'%';
                        }
                    }



                    @endphp



                    <tr>
                        
                        <td class="@if($value['sl'] == '&nbsp;') td-no-bord @endif">@php echo htmlspecialchars_decode($value['sl']); @endphp</td>
                        
                        <td class="@if($value['scheme'] == '&nbsp;') td-no-bord @endif">@php echo htmlspecialchars_decode($value['scheme']); @endphp</td>
                        <td class="@if($value['financials1'] == '&nbsp;') td-no-bord @endif">@php echo htmlspecialchars_decode($value['financials1']); @endphp</td>
                        <td class="@if($value['financials2'] == '&nbsp;') td-no-bord @endif">@php echo htmlspecialchars_decode($value['financials2']); @endphp</td>
                        
                        <td class="@if($value['objective'] == '&nbsp;') td-no-bord @endif">@php echo htmlspecialchars_decode($value['objective']); @endphp</td>
                        
                        <td class="@if($value['out_ind'] == '&nbsp;') td-no-bord @endif" style="{{ $color }}">
                            @php echo htmlspecialchars_decode($value['out_ind']); @endphp
                            <br>
                            @php echo htmlspecialchars_decode($opi_ind_status_text); @endphp
                            @php echo htmlspecialchars_decode($opi_ind_crit); @endphp
                        </td>
                        
                        <td class="@if($value['targ_next'] == '&nbsp;') td-no-bord @endif" style="{{ $color }}">@php echo htmlspecialchars_decode($value['targ_next']); @endphp</td>
                        
                        <td class="@if($value['status'] == '&nbsp;') td-no-bord @endif" style="{{ $color }}">@php echo htmlspecialchars_decode($value['status']); @endphp</td>
                        
                        <td class="@if($value['outc_ind'] == '&nbsp;') td-no-bord @endif" style="{{ $color1 }}">
                            @php echo htmlspecialchars_decode($value['outc_ind']); @endphp
                            <br>
                            @php echo htmlspecialchars_decode($oci_ind_status_text); @endphp
                            @php echo htmlspecialchars_decode($oci_ind_crit); @endphp
                        </td>
                        
                        <td class="@if($value['oc_targ_next'] == '&nbsp;') td-no-bord @endif" style="{{ $color1 }}">@php echo htmlspecialchars_decode($value['oc_targ_next']); @endphp</td>
                        
                        <td class="@if($value['oc_status'] == '&nbsp;') td-no-bord @endif" style="{{ $color1 }}">@php echo htmlspecialchars_decode($value['oc_status']); @endphp</td>

                        <td>
                            @if($value['oc_remark'] == '&nbsp;')
                                @if($value['remark'] == '&nbsp;')
                                    &nbsp;
                                @else
                                    @php echo htmlspecialchars_decode($value['remark']); @endphp
                                @endif
                            @else
                                @php echo htmlspecialchars_decode($value['oc_remark']); @endphp
                            @endif
                        </td>
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