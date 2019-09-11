<?php
namespace App\Exports;

use Illuminate\Http\Request;
use App\Scheme;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class ReportExport implements FromView
{


	public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function view(): View
    {

        $request = $this->request();

        // echo session('finYear'); die;
        $year =  $request->input('finYearSet');
        $dates = explode('-', $year);
        $start_dates = date('Y-m-d', strtotime($dates[0].'-04-01'));
        $end_dates = date('Y-m-d', strtotime('20'.$dates[1].'-03-31'));

        // if(date('m') > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years', strtotime($start_dates)));
            $current_end_date = date('Y-03-31', strtotime('-1 years', strtotime($end_dates)));

            $last_begin_date = date('Y-04-01', strtotime('-1 years', strtotime($start_dates)));
            $last_end_date = date('Y-03-31', strtotime($end_dates));

            $begin_date = date('Y-04-01', strtotime($start_dates));
            $end_date = date('Y-03-31', strtotime('+1 years', strtotime($end_dates)));


            $next_begin_date = date('Y-04-01', strtotime('+1 years', strtotime($start_dates)));
            $next_end_date = date('Y-03-31', strtotime('+2 years', strtotime($end_dates)));

        // }
        // else{
            // $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            // $current_end_date = date('Y-03-31', strtotime('-2 years'));

            // $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            // $last_end_date = date('Y-03-31', strtotime('-1 years'));

            // $begin_date = date('Y-04-01', strtotime('-1 years'));
            // $end_date = date('Y-03-31');


            // $next_begin_date = date('Y-04-01');
            // $next_end_date = date('Y-03-31', strtotime('+1 years'));

        // }

        $head = "";

        if(auth()->user()->department_id){
            if(!empty($request->input('scheme_id'))){

                $scheme_id = $request->input('scheme_id');
                $schemes = DB::table('schemes as s')
                            ->join('units as u', 's.unit_id', '=', 'u.id')
                                ->join('departments as d', 'u.department_id', '=', 'd.id')
                                ->where([
                                ['s.id', $scheme_id],
                                // ['start_date', '<=', date('Y-m-d')],
                                // ['end_date', '>=', date('Y-m-d')]
                            ])
                            ->select('s.*', 'd.name as dept_name')
                            ->orderBy('sno', 'asc')
                            ->get();
                if(count($schemes)){
                    $head = $schemes[0]->name;
                }

            }
            else{
                if(!empty($request->input('unit_id'))){
                    $schemes = DB::table('schemes as s')
                            ->join('units as u', 's.unit_id', '=', 'u.id')
                                ->join('departments as d', 'u.department_id', '=', 'd.id')
                                ->where([
                                ['unit_id', $request->input('unit_id')],
                                // ['start_date', '<=', date('Y-m-d')],
                                // ['end_date', '>=', date('Y-m-d')]
                            ])
                            ->orderBy('sno', 'asc')
                            ->select('s.*', 'd.name as dept_name')
                            ->get();
                    if(count($schemes)){
                        $head = $schemes[0]->dept_name;
                    }
                }
                else{
                    if(!empty($request->input('department_id'))){
                        $schemes = DB::table('schemes as s')
                                    ->join('units as u', 's.unit_id', '=', 'u.id')
                                    ->join('departments as d', 'u.department_id', '=', 'd.id')
                                    ->where([
                                        ['d.id', $request->input('department_id')],
                                        // ['start_date', '<=', date('Y-m-d')],
                                        // ['end_date', '>=', date('Y-m-d')]
                                    ])
                                    ->orderBy('sno', 'asc')
                                    ->select('s.*', 'd.name as dept_name')
                                    ->get();
                        if(count($schemes)){
                            $head = $schemes[0]->dept_name;
                        }
                    }
                }
            }

        }
        else{

            if(!empty($request->input('scheme_id'))){

                $scheme_id = $request->input('scheme_id');
                $schemes = DB::table('schemes as s')
                            ->join('units as u', 's.unit_id', '=', 'u.id')
                                ->join('departments as d', 'u.department_id', '=', 'd.id')
                                ->where([
                                ['s.id', $scheme_id],
                                // ['start_date', '<=', date('Y-m-d')],
                                // ['end_date', '>=', date('Y-m-d')]
                            ])
                            ->select('s.*', 'd.name as dept_name')
                            ->orderBy('sno', 'asc')
                            ->get();
                if(count($schemes)){
                    $head = $schemes[0]->name;
                }
            }
            else{
                if(!empty($request->input('unit_id'))){
                    $schemes = DB::table('schemes as s')
                            ->join('units as u', 's.unit_id', '=', 'u.id')
                                ->join('departments as d', 'u.department_id', '=', 'd.id')
                                ->where([
                                ['unit_id', $request->input('unit_id')],
                                // ['start_date', '<=', date('Y-m-d')],
                                // ['end_date', '>=', date('Y-m-d')]
                            ])
                            ->orderBy('sno', 'asc')
                            ->select('s.*', 'd.name as dept_name')
                            ->get();

                }
                else{
                    if(!empty($request->input('department_id'))){
                        $schemes = DB::table('schemes as s')
                                    ->join('units as u', 's.unit_id', '=', 'u.id')
                                    ->join('departments as d', 'u.department_id', '=', 'd.id')
                                    ->where([
                                        ['d.id', $request->input('department_id')],
                                        // ['start_date', '<=', date('Y-m-d')],
                                        // ['end_date', '>=', date('Y-m-d')]
                                    ])
                                    ->orderBy('sno', 'asc')
                                    ->select('s.*', 'd.name as dept_name')
                                    ->get();
                        if(count($schemes)){
                            $head = $schemes[0]->dept_name;
                        }
                    }
                    else{
                        if(!empty($request->input('subsector_id')) && $request->input('subsector_id') > 0){
                            $schemes = DB::table('schemes as s')
                                    ->join('units as u', 's.unit_id', '=', 'u.id')
                                    ->join('departments as d', 'u.department_id', '=', 'd.id')
                                    ->join('subsectors as ss', 'd.subsector_id', '=', 'ss.id')
                                    ->where([
                                        ['ss.id', $request->input('subsector_id')],
                                        // ['start_date', '<=', date('Y-m-d')],
                                        // ['end_date', '>=', date('Y-m-d')]
                                    ])
                                    ->orderBy('sno', 'asc')
                                    ->select('s.*', 'd.name as dept_name')
                                    ->get();
                        }
                        else{
                            if(!empty($request->input('sector_id'))){
                                $schemes = DB::table('schemes as s')
                                    ->join('units as u', 's.unit_id', '=', 'u.id')
                                    ->join('departments as d', 'u.department_id', '=', 'd.id')
                                    ->join('subsectors as ss', 'd.subsector_id', '=', 'ss.id')
                                    ->join('sectors as sc', 'ss.sector_id', '=', 'sc.id')
                                    ->where([
                                        ['sc.id', $request->input('sector_id')],
                                        // ['start_date', '<=', date('Y-m-d')],
                                        // ['end_date', '>=', date('Y-m-d')]
                                    ])
                                    ->orderBy('sno', 'asc')
                                    ->select('s.*', 'sc.name as sec_name', 'd.name as dept_name')
                                    ->get();
                                if(count($schemes)){
                                    $head = $schemes[0]->sec_name;
                                }
                            }
                        }
                    }
                }
            }
        }


        $final_arr = array();



        foreach ($schemes as $key1 => $value1) {
        
            # code...
            $sch_rows=0;
            $schemes[$key1]->total_outp_rows = 0;
            $schemes[$key1]->total_outc_rows = 0;
            
            $objectives = DB::table('objectives as o')
                            ->where('scheme_id', '=', $value1->id)
                            ->get();
            if(!empty($objectives)){
                $sch_obj_opt=0;
                foreach($objectives as $key2=>$value2){
                    $obj_rows = 0;
                    $objectives[$key2]->total_outp_rows = 0;
                    $objectives[$key2]->total_outc_rows = 0;
                    $outputs = DB::table('outputs as op')
                                    ->where('objective_id', '=', $value2->id)
                                    ->get();
            
                    foreach($outputs as $key3=>$value3){

                        $output_inds = DB::table('outputindicators as opi')

                                        ->where([
                                            ['output_id', '=', $value3->id]
                                        ])
                                        ->get();

                        $output_inds = $this->getOutputIndMetrics($output_inds, $request);
                        if(count($output_inds)){
                            $schemes[$key1]->total_outp_rows = $schemes[$key1]->total_outp_rows + count($output_inds);
                            $objectives[$key2]->total_outp_rows = $objectives[$key2]->total_outp_rows + count($output_inds);
                        }
                        else{
                            $objectives[$key2]->total_outp_rows = 1;
                        }
                        $obj_opt=0;
                        if(!empty($output_inds)){
                            foreach ($output_inds as $key4 => $value4) {
                                $opt_rows = 0;
                                # code...
                                $output_inds[$key4]->total_outc_rows = 0;
                                $outcome_inds = DB::table('outcomeindicators as oci')
                                                    ->where([
                                                        ['output_indicator_id', '=', $value4->id]
                                                    ])
                                                    ->get();
                                $outcome_inds = $this->getOutcomeIndMetrics($outcome_inds, $request);
                            
                                $output_inds[$key4]->outcome_inds = $outcome_inds;
                                if(count($outcome_inds)) {
                                    $outcome_cnt = 1;
                                }
                                else{
                                    $outcome_cnt = count($outcome_inds);
                                }
                                if(!empty($outcome_inds)){
                                    foreach ($outcome_inds as $key7 => $value7) {
                                        # code...
                                        $obj_rows++;
                                        $opt_rows++;
                                        $sch_rows++;
                                    }
                                }
                                else{
                                    $obj_rows++;
                                    $opt_rows++;
                                    $sch_rows++;
                                }
                                $output_inds[$key4]->total_rows = $opt_rows+1;
                                $obj_opt++;
                                $sch_obj_opt++;
                            }
                        }
                        else{
                            $obj_rows++;
                            $sch_rows++;

                        }
                        $objectives[$key2]->output_inds= $output_inds;    
                    }
                    $objectives[$key2]->total_rows = $obj_rows+$obj_opt+1;
                    $sch_obj_opt++;
                }
            }
            else{
                $sch_rows++;
            }

            $schemes[$key1]->objectives = $objectives;
            $schemes[$key1]->total_rows = $sch_rows+$sch_obj_opt+1;
        
        }

        // $allObjectiveOutputIndicators[$key2]->status = $status_new;
        // $allObjectiveOutputIndicators[$key2]->status_last = $status_last_new;
        // $allObjectiveOutputIndicators[$key2]->targ_last = $targ_last_new;
        // $allObjectiveOutputIndicators[$key2]->targ_next = $targ_next_new;
        // $allObjectiveOutputIndicators[$key2]->opb = $op_base_new;


        // $allObjectiveOutcomeIndicators[$key2]->status = $status_new;
        // $allObjectiveOutcomeIndicators[$key2]->status_last = $status_last_new;
        // $allObjectiveOutcomeIndicators[$key2]->targ_last = $targ_last_new;
        // $allObjectiveOutcomeIndicators[$key2]->targ_next = $targ_next_new;
        // $allObjectiveOutcomeIndicators[$key2]->ocb = $oc_base_new;

        $i=0; $sl = 1;
        $row_arr = array();
        foreach($schemes as $key5=>$value5){
            $j=0;
            foreach ($value5->objectives as $key6 => $value6) {
                # code...
                $k=0;
                // print_r($value6);
                if(empty($value6->output_inds)){
                    continue;
                }
                foreach ($value6->output_inds as $key7 => $value7) {
                    # code...
                    $l=0;
                    $outc_count = count($value7->outcome_inds);
                    if((!empty($value7->outcome_inds)) && $outc_count > 0 ){
                        
                        foreach ($value7->outcome_inds as $key8 => $value8) {
                            # code...
                            if($j==0){
                                $row_arr[$i]['scheme'] = $value5->name;
                                $row_arr[$i]['sl'] = $sl;
                                $sl++;
                            }
                            else{
                                $row_arr[$i]['scheme'] = " ";
                                $row_arr[$i]['sl'] = " ";
                            }
                            if($k==0){
                                $row_arr[$i]['objective'] = $value6->description;
                            }
                            else{
                                $row_arr[$i]['objective'] = " ";
                            }
                            
                            if($l==0){
                                $row_arr[$i]['out_ind'] = $value7->name;
                                $row_arr[$i]['opb'] = $value7->opb;
                                $row_arr[$i]['opi_ind_status'] = $value7->status;
                                $row_arr[$i]['opi_ind_crit'] = $value7->is_critical;
                                $row_arr[$i]['status'] = $value7->status_new;
                                $row_arr[$i]['status_last'] = $value7->status_last;
                                $row_arr[$i]['targ_last'] = $value7->targ_last;
                                $row_arr[$i]['targ_next'] = $value7->targ_next;
                                $row_arr[$i]['remark'] = $value7->remark;
                            }
                            else{
                                $row_arr[$i]['out_ind'] = " ";
                                $row_arr[$i]['opb'] = " ";
                                $row_arr[$i]['status'] = " ";
                                $row_arr[$i]['opi_ind_crit'] = " ";
                                $row_arr[$i]['status_last'] = " ";
                                $row_arr[$i]['targ_last'] = " ";
                                $row_arr[$i]['targ_next'] = " ";
                                $row_arr[$i]['remark'] = " ";
                            }
                            $row_arr[$i]['outc_ind'] = $value8->name;
                            $row_arr[$i]['ocb'] = $value8->ocb;
                            $row_arr[$i]['oci_ind_status'] = $value8->status;
                            $row_arr[$i]['oci_ind_crit'] = $value8->is_critical;
                            $row_arr[$i]['oc_status'] = $value8->status_new;
                            $row_arr[$i]['oc_status_last'] = $value8->status_last;
                            $row_arr[$i]['oc_targ_last'] = $value8->targ_last;
                            $row_arr[$i]['oc_targ_next'] = $value8->targ_next;
                            $row_arr[$i]['oc_remark'] = $value8->remark;
                            $i++;
                            $j++;
                            $k++;
                            $l++;
                        }

                    }
                    else{

                        if($j==0){
                            $row_arr[$i]['scheme'] = $value5->name;
                            $row_arr[$i]['sl'] = $sl;
                            $sl++;
                        }
                        else{
                            $row_arr[$i]['scheme'] = " ";
                            $row_arr[$i]['sl'] = " ";
                        }
                        
                        if($k==0){
                            $row_arr[$i]['objective'] = $value6->description;
                        }
                        else{
                            $row_arr[$i]['objective'] = " ";
                        }

                        $row_arr[$i]['out_ind'] = $value7->name;
                        $row_arr[$i]['opb'] = $value7->opb;
                        $row_arr[$i]['opi_ind_status'] = $value7->status;
                        $row_arr[$i]['opi_ind_crit'] = $value7->is_critical;
                        $row_arr[$i]['status'] = $value7->status_new;
                        $row_arr[$i]['status_last'] = $value7->status_last;
                        $row_arr[$i]['targ_last'] = $value7->targ_last;
                        $row_arr[$i]['targ_next'] = $value7->targ_next;
                        $row_arr[$i]['remark'] = $value7->remark;
                        $row_arr[$i]['outc_ind'] = " ";
                        $row_arr[$i]['ocb'] = " ";
                        $row_arr[$i]['oc_status'] = " ";
                        $row_arr[$i]['oc_status_last'] = " ";
                        $row_arr[$i]['oc_targ_last'] = " ";
                        $row_arr[$i]['oc_targ_next'] = " ";
                        $row_arr[$i]['oc_remark'] = " ";
                        $i++;
                        $j++;
                        $k++;
                    }
                }
            }
        }
        // print_r($schemes);
        // die;
        $data['schemes'] = $schemes;
        $data['head'] = $head;
        return view('reptable_revised_new', $data);


        return view('add_achieve', [
            'data' => Invoice::all()
        ]);
    }

}