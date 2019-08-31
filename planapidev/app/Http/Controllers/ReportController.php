<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scheme;
use Excel;
use DB;

class ReportController extends Controller
{

     /**
     * Instantiate a new RecordController instance.
     */
     public function __construct()
     {
       // $this->middleware('auth');
        $this->data = "";
     }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function outputreport()
     {
        $schemes = Scheme::all();


        return view('report.output', compact('schemes'));
    }


    public function getSchemeRep(Request $request)
    {
        # code...

        if(date('m') > 3){

            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));

        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $begin_date = date('Y-04-01', strtotime('-1 years'));
            $end_date = date('Y-03-31');


            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }

        $head = "";
        $dept_name="";

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
                $dept_name=$schemes[0]->dept_name;
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


        $final_arr = array();



        foreach ($schemes as $key1 => $value1) {
        
            # code...
            
            $objectives = DB::table('objectives as o')
                            ->where('scheme_id', '=', $value1->id)
                            ->get();
            
            foreach($objectives as $key2=>$value2){

                $outputs = DB::table('outputs as op')
                                ->where('objective_id', '=', $value2->id)
                                ->get();
                //print_r($outputs);
                foreach($outputs as $key3=>$value3){
                    //print_r($value3);
                    $output_inds = DB::table('outputindicators as opi')

                                    ->where([
                                        ['output_id', '=', $value3->id]
                                    ])
                                    ->get();
                    if(count($output_inds) > 0){
                        $output_inds1 = $this->getOutputIndMetrics($output_inds);
                    }
                    //print_r($output_inds1);
                    foreach ($output_inds1 as $key4 => $value4) {
                        # code...
                        
                        $outcome_inds = DB::table('outcomeindicators as oci')
                                            ->where([
                                                ['output_indicator_id', '=', $value4->id]
                                            ])
                                            ->get();

                        $outcome_inds = $this->getOutcomeIndMetrics($outcome_inds);
                        
                        $output_inds1[$key4]->outcome_inds = $outcome_inds;
                        
                    }
                    
                    $objectives[$key2]->output_inds= $output_inds1;
                    //print_r($objectives);
                }
                //print_r($objectives);die();
            }

            $schemes[$key1]->objectives = $objectives;
            
        }
//print_r($schemes);die();
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
     
        $dept_namng = $schemes[0]->dept_name;
        //return $schemes;
        foreach($schemes as $key5=>$value5){
            $row_arr[0]['dept_namng']=$dept_namng;
            $j=0;
            
            foreach ($value5->objectives as $key6 => $value6) {
                # code...
                $k=0;
                //print_r($value6);
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
                                $row_arr[$i]['scheme'] = "&nbsp;";
                                $row_arr[$i]['sl'] = "&nbsp;";
                            }
                            if($k==0){
                                $row_arr[$i]['objective'] = $value6->description;
                            }
                            else{
                                $row_arr[$i]['objective'] = "&nbsp;";
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
                                $row_arr[$i]['out_ind'] = "&nbsp;";
                                $row_arr[$i]['opb'] = "&nbsp;";
                                $row_arr[$i]['status'] = "&nbsp;";
                                $row_arr[$i]['opi_ind_crit'] = "&nbsp;";
                                $row_arr[$i]['status_last'] = "&nbsp;";
                                $row_arr[$i]['targ_last'] = "&nbsp;";
                                $row_arr[$i]['targ_next'] = "&nbsp;";
                                $row_arr[$i]['remark'] = "&nbsp;";
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
                            $row_arr[$i]['scheme'] = "&nbsp;";
                            $row_arr[$i]['sl'] = "&nbsp;";
                        }
                        
                        if($k==0){
                            $row_arr[$i]['objective'] = $value6->description;
                        }
                        else{
                            $row_arr[$i]['objective'] = "&nbsp;";
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
                        $row_arr[$i]['outc_ind'] = "&nbsp;";
                        $row_arr[$i]['ocb'] = "&nbsp;";
                        $row_arr[$i]['oc_status'] = "&nbsp;";
                        $row_arr[$i]['oc_status_last'] = "&nbsp;";
                        $row_arr[$i]['oc_targ_last'] = "&nbsp;";
                        $row_arr[$i]['oc_targ_next'] = "&nbsp;";
                        $row_arr[$i]['oc_remark'] = "&nbsp;";
                        $i++;
                        $j++;
                        $k++;
                    }
                }
            }
        }
        //die();
        //return $row_arr;die();
        //echo "<pre>";
        // var_dump($row_arr);
         //echo "<pre>";
         // json_encode($row_arr);
         //die;
      $data['schemes'] = $row_arr;
        $data['head'] = $head;
        return view('reptable_revised_new', $data);

    }


    public function getCustomSchemeReports(Request $request)
    {
        # code...


        if($request->input('ind_status') == "0"){
            $ind_status_where = ['id', '>', 1];
        }
        else if($request->input('ind_status') == "1"){
            $ind_status_where = ['status', 2];
        }
        else if($request->input('ind_status') == "2"){
            $ind_status_where = ['status', 3];
        }
        else{
            $ind_status_where = ['id', '>', 1];
        }


        if(!empty($request->input('iscapital'))){
            if($request->input('iscapital') == 1){
                $capital_where = ['is_capital', 1];
            }
            else if($request->input('iscapital') == 2){
                $capital_where = ['is_capital', 0];
            }
            else if($request->input('iscapital') == 3){
                $capital_where= ['s.id', '>', 0];
            }
        }
        else{
            $capital_where= ['s.id', '>', 0];
        }



        // if(!empty($request->input('begin_date'))){
            $begin_date = $request->input('begin_date');
        // }

        // if(!empty($request->input('end_date'))){
            $end_date = $request->input('end_date');
        // }

        if(date('m', strtotime($begin_date)) > 3){

            $targ_begin_date = date('Y-04-01', strtotime($begin_date));
            // $targ_end_date = date('Y-03-31', strtotime ( '+1 years' , strtotime ( $begin_date ) ));
        
        }
        else{

            $targ_begin_date = date('Y-04-01', strtotime ( '-1 years' , strtotime ( $begin_date ) ));
            // $targ_end_date = date('Y-03-31', strtotime($begin));

        }

        if(date('m', strtotime($end_date)) > 3){

            // $targ_begin_date = date('Y-04-01', strtotime($begin_date));
            $targ_end_date = date('Y-03-31', strtotime ( '+1 years' , strtotime ( $end_date ) ));
        
        }
        else{

            // $targ_begin_date = date('Y-04-01', strtotime ( '-1 years' , strtotime ( $begin_date ) ));
            $targ_end_date = date('Y-03-31', strtotime($end_date));

        }


        $critical = (!empty($request->input('critical')))?['is_critical', 1]:['id', '>', 1];

        $head = "";


        if(!empty($request->input('scheme_id'))){

            $scheme_id = $request->input('scheme_id');
            $schemes = DB::table('schemes as s')
                        ->join('units as u', 's.unit_id', '=', 'u.id')
                            ->join('departments as d', 'u.department_id', '=', 'd.id')
                            ->where([
                            ['s.id', $scheme_id],
                            $capital_where
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
                            $capital_where
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
                                    $capital_where
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
                                    $capital_where
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
                                    $capital_where
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


        $final_arr = array();



        foreach ($schemes as $key1 => $value1) {


        
            # code...
            
            $objectives = DB::table('objectives as o')
                            ->where('scheme_id', '=', $value1->id)
                            ->get();

            $this_financials = $this->getFinancials($value1->id, $begin_date, $end_date);

            $schemes[$key1]->financials = $this_financials;
        
            foreach($objectives as $key2=>$value2){

                $outputs = DB::table('outputs as op')
                                ->where('objective_id', '=', $value2->id)
                                ->get();
        
                foreach($outputs as $key3=>$value3){



                    $output_inds = DB::table('outputindicators as opi')

                                    ->where([
                                        ['output_id', '=', $value3->id],
                                        $critical,
                                        $ind_status_where
                                    ])
                                    ->get();

                    $output_inds = $this->getOutputIndMetricsCustom($output_inds, $begin_date, $end_date);
                    foreach ($output_inds as $key4 => $value4) {
        
                        # code...
                    
                        $outcome_inds = DB::table('outcomeindicators as oci')
                                            ->where([
                                                ['output_indicator_id', '=', $value4->id],
                                                $critical,
                                                $ind_status_where
                                            ])
                                            ->get();
                        $outcome_inds = $this->getOutcomeIndMetricsCustom($outcome_inds, $begin_date, $end_date);
                    
                        $output_inds[$key4]->outcome_inds = $outcome_inds;
                    
                    }
                    
                    $objectives[$key2]->output_inds= $output_inds;
                
                }

            }

            $schemes[$key1]->objectives = $objectives;
        
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
                                $row_arr[$i]['financials1'] = "<div><b>Total Allocation:</b><br>Rs ".(($value5->financials['total_est'])/100)." Cr</div><div><b>Revenue:</b>".(($value5->financials['revenue'])/100)."Cr.,</div><div><b>Capital</b>".(($value5->financials['capital'])/100)."Cr.</div><div><b>Loan:</b>".(($value5->financials['loan'])/100)."Cr.</div>";
                                $row_arr[$i]['financials2'] = "<div><b>Total Expenditure:</b>Rs ".(($value5->financials['total_exp'])/100)." Cr</div><div><b>Revenue:</b>".(($value5->financials['revExp'])/100)."Cr.,</div><div><b>Capital</b>".(($value5->financials['capExp'])/100)."Cr.</div><div><b>Loan:</b>".(($value5->financials['loanExp'])/100)."Cr.</div>";
                                $row_arr[$i]['sl'] = $sl;
                                $sl++;
                            }
                            else{
                                $row_arr[$i]['scheme'] = "&nbsp;";
                                $row_arr[$i]['financials1'] = "&nbsp;";
                                $row_arr[$i]['financials2'] = "&nbsp;";
                                $row_arr[$i]['sl'] = "&nbsp;";
                            }
                            if($k==0){
                                $row_arr[$i]['objective'] = $value6->description;
                            }
                            else{
                                $row_arr[$i]['objective'] = "&nbsp;";
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
                                $row_arr[$i]['out_ind'] = "&nbsp;";
                                $row_arr[$i]['opb'] = "&nbsp;";
                                $row_arr[$i]['status'] = "&nbsp;";
                                $row_arr[$i]['status_last'] = "&nbsp;";
                                $row_arr[$i]['opi_ind_crit'] = "&nbsp;";
                                $row_arr[$i]['targ_last'] = "&nbsp;";
                                $row_arr[$i]['targ_next'] = "&nbsp;";
                                $row_arr[$i]['remark'] = "&nbsp;";
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
                            $row_arr[$i]['financials1'] = "<div><b>Total Allocation:</b><br>Rs ".(($value5->financials['total_est'])/100)." Cr</div><div><b>Revenue:</b>".(($value5->financials['revenue'])/100)."Cr.,</div><div><b>Capital</b>".(($value5->financials['capital'])/100)."Cr.</div><div><b>Loan:</b>".(($value5->financials['loan'])/100)."Cr.</div>";
                            $row_arr[$i]['financials2'] = "<div><b>Total Expenditure:</b>Rs ".(($value5->financials['total_exp'])/100)." Cr</div><div><b>Revenue:</b>".(($value5->financials['revExp'])/100)."Cr.,</div><div><b>Capital</b>".(($value5->financials['capExp'])/100)."Cr.</div><div><b>Loan:</b>".(($value5->financials['loanExp'])/100)."Cr.</div>";
                            $row_arr[$i]['sl'] = $sl;
                            $sl++;
                        }
                        else{
                            $row_arr[$i]['scheme'] = "&nbsp;";
                            $row_arr[$i]['financials1'] = "&nbsp;";
                            $row_arr[$i]['financials2'] = "&nbsp;";
                            $row_arr[$i]['sl'] = "&nbsp;";
                        }
                        
                        if($k==0){
                            $row_arr[$i]['objective'] = $value6->description;
                        }
                        else{
                            $row_arr[$i]['objective'] = "&nbsp;";
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
                        $row_arr[$i]['outc_ind'] = "&nbsp;";
                        $row_arr[$i]['ocb'] = "&nbsp;";
                        $row_arr[$i]['oc_status'] = "&nbsp;";
                        $row_arr[$i]['oc_status_last'] = "&nbsp;";
                        $row_arr[$i]['oc_targ_last'] = "&nbsp;";
                        $row_arr[$i]['oc_targ_next'] = "&nbsp;";
                        $row_arr[$i]['oc_remark'] = "&nbsp;";
                        $i++;
                        $j++;
                        $k++;
                    }
                }
            }
        }
        // echo json_encode($row_arr);
        // die;
        $data['schemes'] = $row_arr;
        $data['begin_date'] = $begin_date;
        $data['end_date'] = $end_date;
        $data['targ_begin_date'] = $targ_begin_date;
        $data['targ_end_date'] = $targ_end_date;
        $data['head'] = $head;
        return view('reptable_revised_new_custom', $data);


    }


    public function getOutcomeIndMetrics($allObjectiveOutcomeIndicators)
    {
        # code...
        // $current_begin_date = date('Y-04-01', strtotime('-2 years'));
        // $current_end_date = date('Y-03-31', strtotime('-1 years'));

        // $last_begin_date = date('Y-04-01', strtotime('-1 years'));
        // $last_end_date = date('Y-03-31');

        // $begin_date = date('Y-04-01');
        // $end_date = date('Y-03-31', strtotime('+1 years'));


        // $next_begin_date = date('Y-04-01', strtotime('+1 years'));
        // $next_end_date = date('Y-03-31', strtotime('+2 years'));


        if(date('m') > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));

        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $begin_date = date('Y-04-01', strtotime('-1 years'));
            $end_date = date('Y-03-31');


            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }



        foreach($allObjectiveOutcomeIndicators as $key2=>$value2){
            if(!empty($value2->id)){
                $oc_base = DB::table('outcomebaselines')
                            ->where([
                                ['outcomeindicator_id', $value2->id],
                                ['start_date', '>=', $current_begin_date],
                                ['end_date', '<=', $current_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($oc_base) > 0){
                    if(count($oc_base) > 1){
                        $oc_base_new = 0;
                        foreach ($oc_base as $key => $value) {
                            # code...
                            $oc_base_new = $oc_base[0]->value;
                        }
                    }
                    else{
                        $oc_base_new = $oc_base[0]->value;
                    }
                }
                else{
                    $oc_base_new = "";
                }
                $status = DB::table('outcome_achievements as a')
                            ->join('outcometargets as oct', 'a.outcometarget_id', '=', 'oct.id')
                            ->join('outcomeindicators as oci', 'oct.outcomeindicator_id', '=', 'oci.id')
                            ->where([
                                ['oci.id', '=', $value2->id],
                                ['a.start_date', '>=', $begin_date],
                                ['a.end_date', '<=', $end_date]
                            ])
                            ->orderBy('a.start_date', 'asc')
                            ->orderBy('a.end_date', 'desc')
                            ->select('a.*')
                            ->get();
                if(count($status) > 0){
                    if(count($status) > 1){
                        $status_new = 0;
                        foreach ($status as $key => $value) {
                            # code...
                            $status_new = $status[0]->description;
                        }
                    }
                    else{
                        $status_new = $status[0]->description;
                    }
                }
                else{
                    $status_new = "";
                }
                $status_last= DB::table('outcome_achievements as a')
                            ->join('outcometargets as oct', 'a.outcometarget_id', '=', 'oct.id')
                            ->join('outcomeindicators as oci', 'oct.outcomeindicator_id', '=', 'oci.id')
                            ->where([
                                ['oci.id', '=', $value2->id],
                                ['a.start_date', '>=', $last_begin_date],
                                ['a.end_date', '<=', $last_end_date]
                            ])
                            ->orderBy('a.start_date', 'asc')
                            ->orderBy('a.end_date', 'desc')
                            ->orderBy('a.id', 'desc')
                            ->select('a.*')
                            ->get();
                if(count($status_last) > 0){
                    if(count($status_last) > 1){
                        $status_last_new = 0;
                        foreach ($status_last as $key => $value) {
                            # code...
                            $status_last_new = $status_last[0]->description;
                        }
                    }
                    else{
                        $status_last_new = $status_last[0]->description;
                    }
                }
                else{
                    $status_last_new = "";
                }
                $targ_next = DB::table('outcometargets')
                            ->where([
                                ['outcomeindicator_id', $value2->id],
                                ['start_date', '>=', $begin_date],
                                ['end_date', '<=', $end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_next) > 0){
                    if(count($targ_next) > 1){
                        $targ_next_new = 0;
                        foreach ($targ_next as $key => $value) {
                            # code...
                            $targ_next_new = $targ_next[0]->value;
                        }
                    }
                    else{
                        $targ_next_new = $targ_next[0]->value;
                    }
                }
                else{
                    $targ_next_new = "";
                }

                $targ_last = DB::table('outcometargets')
                            ->where([
                                ['outcomeindicator_id', $value2->id],
                                ['start_date', '>=', $last_begin_date],
                                ['end_date', '<=', $last_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_last) > 0){
                    if(count($targ_last) > 1){
                        $targ_last_new = 0;
                        foreach ($targ_last as $key => $value) {
                            # code...
                            $targ_last_new = $targ_last[0]->value;
                        }
                    }
                    else{
                        $targ_last_new = $targ_last[0]->value;
                    }
                }
                else{
                    $targ_last_new = "";
                }
            }
            else{
                // $sum1 = 'NA';
            }
            $allObjectiveOutcomeIndicators[$key2]->status_new = $status_new;
            $allObjectiveOutcomeIndicators[$key2]->status_last = $status_last_new;
            $allObjectiveOutcomeIndicators[$key2]->targ_last = $targ_last_new;
            $allObjectiveOutcomeIndicators[$key2]->targ_next = $targ_next_new;
            $allObjectiveOutcomeIndicators[$key2]->ocb = $oc_base_new;

        }

        return $allObjectiveOutcomeIndicators;

    }

    public function getOutcomeIndMetricsCustom($allObjectiveOutcomeIndicators, $begin_date, $end_date)
    {
        # code...
        // $current_begin_date = date('Y-04-01', strtotime('-2 years'));
        // $current_end_date = date('Y-03-31', strtotime('-1 years'));

        // $last_begin_date = date('Y-04-01', strtotime('-1 years'));
        // $last_end_date = date('Y-03-31');

        // $begin_date = date('Y-04-01');
        // $end_date = date('Y-03-31', strtotime('+1 years'));


        // $next_begin_date = date('Y-04-01', strtotime('+1 years'));
        // $next_end_date = date('Y-03-31', strtotime('+2 years'));


        if(date('m', strtotime($begin_date)) > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $targ_begin_date = date('Y-04-01', strtotime($begin_date));
            // strtotime ( '+2 day' , strtotime ( $end_date ) ) ;
            $targ_end_date = date('Y-03-31', strtotime ( '+1 years' , strtotime ( $begin_date ) ));

            $status_begin_date = date('Y-m-d', strtotime( $begin_date ) );
            $status_end_date = date('Y-m-d', strtotime( $end_date ) );


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));
        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $targ_begin_date = date('Y-04-01', strtotime ( '-1 years' , strtotime ( $begin_date ) ));
            $targ_end_date = date('Y-03-31', strtotime($end_date));

            $status_begin_date = date('Y-m-d', strtotime( $begin_date ) );
            $status_end_date = date('Y-m-d', strtotime( $end_date ) );

            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }



        foreach($allObjectiveOutcomeIndicators as $key2=>$value2){
            if(!empty($value2->id)){
                $oc_base = DB::table('outcomebaselines')
                            ->where([
                                ['outcomeindicator_id', $value2->id],
                                ['start_date', '>=', $current_begin_date],
                                ['end_date', '<=', $current_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($oc_base) > 0){
                    if(count($oc_base) > 1){
                        $oc_base_new = 0;
                        foreach ($oc_base as $key => $value) {
                            # code...
                            $oc_base_new = $oc_base[0]->value;
                        }
                    }
                    else{
                        $oc_base_new = $oc_base[0]->value;
                    }
                }
                else{
                    $oc_base_new = "";
                }
                $targs = DB::table('outcometargets as oct')
                            ->join('outcomeindicators as oci', 'oct.outcomeindicator_id', '=', 'oci.id')
                            ->where([
                                ['oci.id', '=', $value2->id],
                                ['oct.start_date', '>=', $targ_begin_date],
                                ['oct.end_date', '<=', $targ_end_date]
                            ])
                            ->select('oct.*')
                            ->first();
                $targ_cumul = 0;
                

                if(!empty($targs)){

                    $targ_cumul = $targs->value;
                    $status = DB::table('outcome_achievements as a')
                            ->where([
                                ['a.outcometarget_id', '=', $targs->id],
                                ['a.start_date', '>=', $status_begin_date],
                                ['a.end_date', '<=', $status_end_date]
                            ])
                            ->orderBy('a.start_date', 'asc')
                            ->orderBy('a.end_date', 'desc')
                            ->orderBy('a.id', 'desc')
                            ->select('a.*')
                            ->get();
                    if(count($status) > 0){
                        if(count($status) > 1){
                            $status_new = 0;
                            foreach ($status as $key => $value) {
                                # code...
                                $status_new = $status[0]->description;
                            }
                        }
                        else{
                            $status_new = $status[0]->description;
                        }
                    }
                    else{
                        $status_new = "";
                    }
                }
                else{
                    $status_new = "";
                }

                // $status = DB::table('outcome_achievements as a')
                //             ->join('outcometargets as oct', 'a.outcometarget_id', '=', 'oct.id')
                //             ->join('outcomeindicators as oci', 'oct.outcomeindicator_id', '=', 'oci.id')
                //             ->where([
                //                 ['oci.id', '=', $value2->id],
                //                 ['oct.start_date', '>=', $begin_date],
                //                 ['oct.end_date', '<=', $end_date]
                //             ])
                //             ->select('a.*')
                //             ->get();
                // if(count($status) > 0){
                //     if(count($status) > 1){
                //         $status_new = 0;
                //         foreach ($status as $key => $value) {
                //             # code...
                //             $status_new = $status[0]->description;
                //         }
                //     }
                //     else{
                //         $status_new = $status[0]->description;
                //     }
                // }
                // else{
                //     $status_new = "";
                // }
                $status_last= DB::table('outcome_achievements as a')
                            ->join('outcometargets as oct', 'a.outcometarget_id', '=', 'oct.id')
                            ->join('outcomeindicators as oci', 'oct.outcomeindicator_id', '=', 'oci.id')
                            ->where([
                                ['oci.id', '=', $value2->id],
                                ['oct.start_date', '>=', $last_begin_date],
                                ['oct.end_date', '<=', $last_end_date]
                            ])
                            ->select('a.*')
                            ->get();
                if(count($status_last) > 0){
                    if(count($status_last) > 1){
                        $status_last_new = 0;
                        foreach ($status_last as $key => $value) {
                            # code...
                            $status_last_new = $status_last[0]->description;
                        }
                    }
                    else{
                        $status_last_new = $status_last[0]->description;
                    }
                }
                else{
                    $status_last_new = "";
                }
                $targ_next = DB::table('outcometargets')
                            ->where([
                                ['outcomeindicator_id', $value2->id],
                                ['start_date', '>=', $begin_date],
                                ['end_date', '<=', $end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_next) > 0){
                    if(count($targ_next) > 1){
                        $targ_next_new = 0;
                        foreach ($targ_next as $key => $value) {
                            # code...
                            $targ_next_new = $targ_next[0]->value;
                        }
                    }
                    else{
                        $targ_next_new = $targ_next[0]->value;
                    }
                }
                else{
                    $targ_next_new = "";
                }

                $targ_last = DB::table('outcometargets')
                            ->where([
                                ['outcomeindicator_id', $value2->id],
                                ['start_date', '>=', $last_begin_date],
                                ['end_date', '<=', $last_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_last) > 0){
                    if(count($targ_last) > 1){
                        $targ_last_new = 0;
                        foreach ($targ_last as $key => $value) {
                            # code...
                            $targ_last_new = $targ_last[0]->value;
                        }
                    }
                    else{
                        $targ_last_new = $targ_last[0]->value;
                    }
                }
                else{
                    $targ_last_new = "";
                }
            }
            else{
                // $sum1 = 'NA';
            }
            $allObjectiveOutcomeIndicators[$key2]->status_new = $status_new;
            $allObjectiveOutcomeIndicators[$key2]->status_last = $status_last_new;
            $allObjectiveOutcomeIndicators[$key2]->targ_last = $targ_last_new;
            $allObjectiveOutcomeIndicators[$key2]->targ_next = $targ_cumul;
            $allObjectiveOutcomeIndicators[$key2]->ocb = $oc_base_new;

        }

        return $allObjectiveOutcomeIndicators;

    }



    public function getOutputIndMetrics($allObjectiveOutputIndicators)
    {
        # code...
        // $current_begin_date = date('Y-04-01', strtotime('-2 years'));
        // $current_end_date = date('Y-03-31', strtotime('-1 years'));

        // $last_begin_date = date('Y-04-01', strtotime('-1 years'));
        // $last_end_date = date('Y-03-31');

        // $begin_date = date('Y-04-01');
        // $end_date = date('Y-03-31', strtotime('+1 years'));


        // $next_begin_date = date('Y-04-01', strtotime('+1 years'));
        // $next_end_date = date('Y-03-31', strtotime('+2 years'));

        if(date('m') > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));

        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $begin_date = date('Y-04-01', strtotime('-1 years'));
            $end_date = date('Y-03-31');


            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }

        foreach($allObjectiveOutputIndicators as $key2=>$value2){
            if(!empty($value2->id)){
                $op_base = DB::table('baselines')
                            ->where([
                                ['outputindicator_id', $value2->id],
                                ['start_date', '>=', $current_begin_date],
                                ['end_date', '<=', $current_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($op_base) > 0){
                    if(count($op_base) > 1){
                        $op_base_new = 0;
                        foreach ($op_base as $key => $value) {
                            # code...
                            $op_base_new = $op_base[0]->value;
                        }
                    }
                    else{
                        $op_base_new = $op_base[0]->value;
                    }
                }
                else{
                    $op_base_new = "";
                }
                $status = DB::table('achievements as a')
                            ->join('outputtargets as opt', 'a.outputtarget_id', '=', 'opt.id')
                            ->join('outputindicators as opi', 'opt.outputindicator_id', '=', 'opi.id')
                            ->where([
                                ['opi.id', '=', $value2->id],
                                ['a.start_date', '>=', $begin_date],
                                ['a.end_date', '<=', $end_date]
                            ])
                            ->orderBy('a.start_date', 'asc')
                            ->orderBy('a.end_date', 'desc')
                            ->orderBy('a.id', 'desc')
                            ->select('a.*')
                            ->get();
                if(count($status) > 0){
                    if(count($status) > 1){
                        $status_new = 0;
                        foreach ($status as $key => $value) {
                            # code...
                            $status_new = $status[0]->description;
                        }
                    }
                    else{
                        $status_new = $status[0]->description;
                    }
                }
                else{
                    $status_new = "";
                }
                $status_last= DB::table('achievements as a')
                            ->join('outputtargets as opt', 'a.outputtarget_id', '=', 'opt.id')
                            ->join('outputindicators as opi', 'opt.outputindicator_id', '=', 'opi.id')
                            ->where([
                                ['opi.id', '=', $value2->id],
                                ['a.start_date', '>=', $last_begin_date],
                                ['a.end_date', '<=', $last_end_date]
                            ])
                            ->orderBy('a.start_date', 'asc')
                            ->orderBy('a.end_date', 'desc')
                            ->select('a.*')
                            ->get();
                if(count($status_last) > 0){
                    if(count($status_last) > 1){
                        $status_last_new = 0;
                        foreach ($status_last as $key => $value) {
                            # code...
                            $status_last_new = $status_last[0]->description;
                        }
                    }
                    else{
                        $status_last_new = $status_last[0]->description;
                    }
                }
                else{
                    $status_last_new = "";
                }
                $targ_next = DB::table('outputtargets')
                            ->where([
                                ['outputindicator_id', $value2->id],
                                ['start_date', '>=', $begin_date],
                                ['end_date', '<=', $end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_next) > 0){
                    if(count($targ_next) > 1){
                        $targ_next_new = 0;
                        foreach ($targ_next as $key => $value) {
                            # code...
                            $targ_next_new = $targ_next[0]->value;
                        }
                    }
                    else{
                        $targ_next_new = $targ_next[0]->value;
                    }
                }
                else{
                    $targ_next_new = "";
                }

                $targ_last = DB::table('outputtargets')
                            ->where([
                                ['outputindicator_id', $value2->id],
                                ['start_date', '>=', $last_begin_date],
                                ['end_date', '<=', $last_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_last) > 0){
                    if(count($targ_last) > 1){
                        $targ_last_new = 0;
                        foreach ($targ_last as $key => $value) {
                            # code...
                            $targ_last_new = $targ_last[0]->value;
                        }
                    }
                    else{
                        $targ_last_new = $targ_last[0]->value;
                    }
                }
                else{
                    $targ_last_new = "";
                }
            }
            else{
                // $sum1 = 'NA';
            }
            $allObjectiveOutputIndicators[$key2]->status_new = $status_new;
            $allObjectiveOutputIndicators[$key2]->status_last = $status_last_new;
            $allObjectiveOutputIndicators[$key2]->targ_last = $targ_last_new;
            $allObjectiveOutputIndicators[$key2]->targ_next = $targ_next_new;
            $allObjectiveOutputIndicators[$key2]->opb = $op_base_new;

        }

        return $allObjectiveOutputIndicators;

    }

    public function getOutputIndMetricsCustom($allObjectiveOutputIndicators, $begin_date, $end_date)
    {
        # code...
        // $current_begin_date = date('Y-04-01', strtotime('-2 years'));
        // $current_end_date = date('Y-03-31', strtotime('-1 years'));

        // $last_begin_date = date('Y-04-01', strtotime('-1 years'));
        // $last_end_date = date('Y-03-31');

        // $begin_date = date('Y-04-01');
        // $end_date = date('Y-03-31', strtotime('+1 years'));


        // $next_begin_date = date('Y-04-01', strtotime('+1 years'));
        // $next_end_date = date('Y-03-31', strtotime('+2 years'));

        $status_begin_date = date('Y-m-d', strtotime( $begin_date ) );
        $status_end_date = date('Y-m-d', strtotime( $end_date ) );

        if(date('m', strtotime($begin_date)) > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $targ_begin_date = date('Y-04-01', strtotime($begin_date));
            // strtotime ( '+2 day' , strtotime ( $end_date ) ) ;
            $targ_end_date = date('Y-03-31', strtotime ( '+1 years' , strtotime ( $end_date ) ));


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));
        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $targ_begin_date = date('Y-04-01', strtotime ( '-1 years' , strtotime ( $begin_date ) ));
            $targ_end_date = date('Y-03-31', strtotime($end_date));


            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }

        foreach($allObjectiveOutputIndicators as $key2=>$value2){
            if(!empty($value2->id)){
                $op_base = DB::table('baselines')
                            ->where([
                                ['outputindicator_id', $value2->id],
                                ['start_date', '>=', $current_begin_date],
                                ['end_date', '<=', $current_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($op_base) > 0){
                    if(count($op_base) > 1){
                        $op_base_new = 0;
                        foreach ($op_base as $key => $value) {
                            # code...
                            $op_base_new = $op_base[0]->value;
                        }
                    }
                    else{
                        $op_base_new = $op_base[0]->value;
                    }
                }
                else{
                    $op_base_new = "";
                }

                $targs = DB::table('outputtargets as opt')
                            ->join('outputindicators as opi', 'opt.outputindicator_id', '=', 'opi.id')
                            ->where([
                                ['opi.id', '=', $value2->id],
                                ['opt.start_date', '>=', $targ_begin_date],
                                ['opt.end_date', '<=', $targ_end_date]
                            ])
                            ->select('opt.*')
                            ->first();
                $targ_cumul = 0;
                

                if(!empty($targs)){

                    $targ_cumul = $targs->value;
                    $status = DB::table('achievements as a')
                            ->where([
                                ['a.outputtarget_id', '=', $targs->id],
                                ['a.start_date', '>=', $status_begin_date],
                                ['a.end_date', '<=', $status_end_date]
                            ])
                            ->orderBy('a.start_date', 'asc')
                            ->orderBy('a.end_date', 'desc')
                            ->orderBy('a.id', 'desc')
                            ->select('a.*')
                            ->get();
                    if(count($status) > 0){
                        if(count($status) > 1){
                            $status_new = 0;
                            foreach ($status as $key => $value) {
                                # code...
                                $status_new = $status[0]->description;
                            }
                        }
                        else{
                            $status_new = $status[0]->description;
                        }
                    }
                    else{
                        $status_new = "";
                    }
                }
                else{
                    $status_new = "";
                }
                $status_last= DB::table('achievements as a')
                            ->join('outputtargets as opt', 'a.outputtarget_id', '=', 'opt.id')
                            ->join('outputindicators as opi', 'opt.outputindicator_id', '=', 'opi.id')
                            ->where([
                                ['opi.id', '=', $value2->id],
                                ['opt.start_date', '>=', $last_begin_date],
                                ['opt.end_date', '<=', $last_end_date]
                            ])
                            ->select('a.*')
                            ->get();
                if(count($status_last) > 0){
                    if(count($status_last) > 1){
                        $status_last_new = 0;
                        foreach ($status_last as $key => $value) {
                            # code...
                            $status_last_new = $status_last[0]->description;
                        }
                    }
                    else{
                        $status_last_new = $status_last[0]->description;
                    }
                }
                else{
                    $status_last_new = "";
                }
                $targ_next = DB::table('outputtargets')
                            ->where([
                                ['outputindicator_id', $value2->id],
                                ['start_date', '>=', $targ_begin_date],
                                ['end_date', '<=', $targ_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_next) > 0){
                    if(count($targ_next) > 1){
                        $targ_next_new = 0;
                        foreach ($targ_next as $key => $value) {
                            # code...
                            $targ_next_new = $targ_next[0]->value;
                        }
                    }
                    else{
                        $targ_next_new = $targ_next[0]->value;
                    }
                }
                else{
                    $targ_next_new = "";
                }

                $targ_last = DB::table('outputtargets')
                            ->where([
                                ['outputindicator_id', $value2->id],
                                ['start_date', '>=', $last_begin_date],
                                ['end_date', '<=', $last_end_date]
                            ])
                            ->select('*')
                            ->get();
                if(count($targ_last) > 0){
                    if(count($targ_last) > 1){
                        $targ_last_new = 0;
                        foreach ($targ_last as $key => $value) {
                            # code...
                            $targ_last_new = $targ_last[0]->value;
                        }
                    }
                    else{
                        $targ_last_new = $targ_last[0]->value;
                    }
                }
                else{
                    $targ_last_new = "";
                }
            }
            else{
                // $sum1 = 'NA';
            }
            $allObjectiveOutputIndicators[$key2]->status_new = $status_new;
            $allObjectiveOutputIndicators[$key2]->status_last = $status_last_new;
            $allObjectiveOutputIndicators[$key2]->targ_last = $targ_last_new;
            $allObjectiveOutputIndicators[$key2]->targ_next = $targ_cumul;
            // $allObjectiveOutputIndicators[$key2]->targ_next = $targ_next_new;
            $allObjectiveOutputIndicators[$key2]->opb = $op_base_new;

        }

        return $allObjectiveOutputIndicators;

    }


    public function getCustomSchemeReportsBck(Request $request){

        // return view('reptable_new')->render();
        // die;
        if(!empty($request->input('iscapital'))){
            if($request->input('iscapital') == 1){
                $where = ['is_capital', 1];
            }
            else if($request->input('iscapital') == 2){
                $where = ['is_capital', 0];
            }
            else if($request->input('iscapital') == 3){
                $where= ['s.id', '>', 0];
            }
        }
        else{
            $where= ['s.id', '>', 0];
        }
        $begin_date = date('Y-m-d');
        $end_date = date('Y-m-d');
        if(!empty($request->input('begin_date'))){
            $begin_date = $request->input('begin_date');
        }
        if(!empty($request->input('end_date'))){
            $end_date = $request->input('end_date');
        }
        // 31-03-2018


        $final_arr = array();
        $schemes = '';
        if(!empty($request->input('scheme_id'))){

            $scheme_id = $request->input('scheme_id');
            $schemes = DB::table('schemes')
                        ->where([
                            ['id', $scheme_id],
                            $where,
                            ['start_date', '<=', $begin_date],
                            ['end_date', '>=', $begin_date]
                        ])
                        ->orWhere([
                            ['id', $scheme_id],
                            $where,
                            ['start_date', '<=', $end_date],
                            ['end_date', '>=', $end_date]
                        ])
                        ->orWhere([
                            ['id', $scheme_id],
                            $where,
                            ['start_date', '>=', $begin_date],
                            ['end_date', '<=', $end_date]
                        ])
                        ->get();
        }
        else{
            if(!empty($request->input('unit_id'))){
                $schemes = DB::table('schemes as s')
                        ->where([
                            ['unit_id', $request->input('unit_id')],
                            ['start_date', '<=', $begin_date],
                            $where,
                            ['end_date', '>=', $begin_date]
                        ])
                        ->orWhere([
                            ['unit_id', $request->input('unit_id')],
                            ['start_date', '<=', $end_date],
                            $where,
                            ['end_date', '>=', $end_date]
                        ])
                        ->orWhere([
                            ['unit_id', $request->input('unit_id')],
                            ['start_date', '>=', $begin_date],
                            $where,
                            ['end_date', '<=', $end_date]
                        ])
                        ->select('s.*')
                        ->get();
            }
            else{
                if(!empty($request->input('department_id'))){
                    $schemes = DB::table('schemes as s')
                                ->join('units as u', 's.unit_id', '=', 'u.id')
                                ->join('departments as d', 'u.department_id', '=', 'd.id')
                                ->where([
                                    ['d.id', $request->input('department_id')],
                                    ['start_date', '<=', $begin_date],
                                    $where,
                                    ['end_date', '>=', $begin_date]
                                ])
                                ->orWhere([
                                    ['d.id', $request->input('department_id')],
                                    ['start_date', '<=', $end_date],
                                    $where,
                                    ['end_date', '>=', $end_date]
                                ])
                                ->orWhere([
                                    ['d.id', $request->input('department_id')],
                                    ['start_date', '>=', $begin_date],
                                    $where,
                                    ['end_date', '<=', $end_date]
                                ])
                                ->select('s.*')
                                ->get();
                }
                else{
                    if(!empty($request->input('subsector_id')) && $request->input('subsector_id') > 0){
                        $schemes = DB::table('schemes as s')
                                ->join('units as u', 's.unit_id', '=', 'u.id')
                                ->join('departments as d', 'u.department_id', '=', 'd.id')
                                ->join('subsectors as ss', 'd.subsector_id', '=', 'ss.id')
                                ->where([
                                    ['ss.id', $request->input('subsector_id')],
                                    ['start_date', '<=', $begin_date],
                                    $where,
                                    ['end_date', '>=', $begin_date]
                                ])
                                ->orWhere([
                                    ['ss.id', $request->input('subsector_id')],
                                    ['start_date', '<=', $end_date],
                                    $where,
                                    ['end_date', '>=', $end_date]
                                ])
                                ->orWhere([
                                    ['ss.id', $request->input('subsector_id')],
                                    ['start_date', '>=', $begin_date],
                                    $where,
                                    ['end_date', '<=', $end_date]
                                ])
                                ->select('s.*')
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
                                    ['start_date', '<=', $begin_date],
                                    $where,
                                    ['end_date', '>=', $begin_date]
                                ])
                                ->orWhere([
                                    ['sc.id', $request->input('sector_id')],
                                    ['start_date', '<=', $end_date],
                                    $where,
                                    ['end_date', '>=', $end_date]
                                ])
                                ->orWhere([
                                    ['sc.id', $request->input('sector_id')],
                                    ['start_date', '>=', $begin_date],
                                    $where,
                                    ['end_date', '<=', $end_date]
                                ])
                                ->select('s.*')
                                ->get();
                        }
                    }
                }
            }
        }

        $next_begin_date = date('Y-04-01', strtotime('+1 years'));
        $next_end_date = date('Y-03-31', strtotime('+2 years'));

        $scheme_outp = DB::table('schemes as s')
                        ->join('objectives as o', 'o.scheme_id', '=', 's.id')
                        ->join('outputs as op', 'op.objective_id', '=', 'o.id')
                        ->join('outputindicators as opi', 'opi.output_id', '=', 'op.id')
                        ->join('baselines as opb', 'opb.outputindicator_id', '=', 'opi.id', 'left')
                        ->join('outputtargets as opt', 'opt.outputindicator_id', '=', 'opi.id', 'left')
                        ->join('achievements as opa', 'opa.outputtarget_id', '=', 'opt.id', 'left')
                        ->join('reviews as opr', 'opr.achievement_id', '=', 'opa.id', 'left')
                        ->join('actionpoints as opap', 'opap.review_id', '=', 'opr.id', 'left')
                        ->select('s.id as sch_id','s.name as sch_name','s.remarks as sch_remrk', 'o.id as obj_id', 'o.description as obj_desc', 'o.scheme_id as obj_sch_id','opi.id as opi_id', 'opi.name as opi', 'opb.value as opb', 'opt.id as opt_id', 'opt.value as opt', 'opi.status as opi_st', 'opr.description as opr_desc', 'opap.description as opap_desc')
                        ->get();
        $sum1=0; $sum2=0;
        foreach($scheme_outp as $key30=>$value30){
            if(!empty($value30->opt_id)){
                $sum1 = DB::table('achievements')->where('outputtarget_id', $value30->opt_id)->sum('description');
                $sum2 = DB::table('outputtargets')
                            ->where([
                                ['outputindicator_id', $value30->opi_id],
                                ['start_date', '<=', $next_begin_date],
                                ['end_date', '>=', $next_begin_date]
                            ])
                            ->orWhere([
                                ['outputindicator_id', $value30->opi_id],
                                ['start_date', '<=', $next_end_date],
                                ['end_date', '>=', $next_end_date]
                            ])
                            ->orWhere([
                                ['outputindicator_id', $value30->opi_id],
                                ['start_date', '>=', $next_begin_date],
                                ['end_date', '<=', $next_end_date]
                            ])
                            ->sum('value');
            }
            else{
                $sum1 = 'NA';
            }
            $scheme_outp[$key30]->status = $sum1;
            $scheme_outp[$key30]->targ_next = $sum2;
        }


        $scheme_outc = DB::table('schemes as s')
                        ->join('objectives as o', 'o.scheme_id', '=', 's.id')
                        ->join('outputs as op', 'op.objective_id', '=', 'o.id')
                        ->join('outcomes as oc', 'oc.output_id', '=', 'op.id')
                        ->join('outcomeindicators as oci', 'oci.outcome_id', '=', 'oc.id')
                        ->join('outcomebaselines as ocb', 'ocb.outcomeindicator_id', '=', 'oci.id', 'left')
                        ->join('outcometargets as oct', 'oct.outcomeindicator_id', '=', 'oci.id', 'left')
                        ->join('outcome_achievements as oca', 'oca.outcometarget_id', '=', 'oct.id', 'left')
                        ->join('outcome_reviews as ocr', 'ocr.outcome_achievement_id', '=', 'oca.id', 'left')
                        ->join('outcome_actionpoints as ocap', 'ocap.outcome_review_id', '=', 'ocr.id', 'left')
                        ->select('s.id as sch_id','s.name as sch_name','s.remarks as sch_remrk', 'o.id as obj_id', 'o.description as obj_desc', 'o.scheme_id as obj_sch_id', 'oci.id as oci_id', 'oci.name as oci', 'ocb.value as ocb', 'oct.id as oct_id', 'oct.value as oct', 'ocr.description as ocr_desc', 'ocap.description as ocap_desc')
                        ->get();
        $sum=0; $sum3=0;
        foreach($scheme_outc as $key40=>$value40){
            if(!empty($value40->opt_id)){
                $sum = DB::table('outcome_achievements')->where('outcometarget_id', $value40->opt_id)->sum('description');
                $sum3 = DB::table('outputtargets')
                            ->where([
                                ['outputindicator_id', $value40->oci_id],
                                ['start_date', '<=', $next_begin_date],
                                ['end_date', '>=', $next_begin_date]
                            ])
                            ->orWhere([
                                ['outputindicator_id', $value40->oci_id],
                                ['start_date', '<=', $next_end_date],
                                ['end_date', '>=', $next_end_date]
                            ])
                            ->orWhere([
                                ['outputindicator_id', $value40->oci_id],
                                ['start_date', '>=', $next_begin_date],
                                ['end_date', '<=', $next_end_date]
                            ])
                            ->sum('value');
            }
            else{
                $sum = 'NA';
            }
            $scheme_outc[$key40]->status = $sum;
            $scheme_outc[$key40]->targ_next = $sum3;
        }

        foreach ($schemes as $key => $value) {
            # code...
            $count = count($final_arr);
            $flag_count = $count;
            foreach ($scheme_outp as $key1 => $value1) {
                # code...
                if($value1->sch_id == $value->id){
                    $final_arr[$flag_count]['sch_id'] = $value1->sch_id;
                    $final_arr[$flag_count]['sch_name'] = $value1->sch_name;
                    $final_arr[$flag_count]['obj_id'] = $value1->obj_id;
                    $final_arr[$flag_count]['obj_desc'] = $value1->obj_desc;
                    $final_arr[$flag_count]['opi'] = $value1->opi;
                    $final_arr[$flag_count]['opi_st'] = $value1->opi_st;
                    $final_arr[$flag_count]['targ_next'] = $value1->targ_next;
                    // if(!empty($value1->opb)){
                        $final_arr[$flag_count]['opb'] = $value1->opb;
                    // }
                    // if(!empty($value1->opb)){
                        $final_arr[$flag_count]['opt_id'] = $value1->opt_id;
                        $final_arr[$flag_count]['opt'] = $value1->opt;
                    // }
                    $final_arr[$flag_count]['opt_stat'] = $value1->status;
                    $final_arr[$flag_count]['sch_remrk'] = $value1->sch_remrk;
                    $final_arr[$flag_count]['opr_desc'] = $value1->opr_desc;
                    $final_arr[$flag_count]['opap_desc'] = $value1->opap_desc;
                    $flag_count++;
                }
            }
            $flag_count = $count;
            foreach ($scheme_outc as $key2 => $value2) {
                # code...
                if($value2->sch_id == $value->id){
                    $final_arr[$flag_count]['sch_id'] = $value2->sch_id;
                    $final_arr[$flag_count]['sch_name'] = $value2->sch_name;
                    $final_arr[$flag_count]['obj_id'] = $value2->obj_id;
                    $final_arr[$flag_count]['obj_desc'] = $value2->obj_desc;
                    $final_arr[$flag_count]['oci'] = $value2->oci;
                    // if(!empty($value1->opb)){
                        $final_arr[$flag_count]['ocb'] = $value2->ocb;

                    $final_arr[$flag_count]['outc_targ_next'] = $value2->targ_next;
                    // }
                    // if(!empty($value2->ocb)){
                        $final_arr[$flag_count]['oct'] = $value2->oct;
                    // }
                    $final_arr[$flag_count]['oct_stat'] = $value2->status;
                    $final_arr[$flag_count]['sch_remrk'] = $value2->sch_remrk;
                    $final_arr[$flag_count]['ocr_desc'] = $value2->ocr_desc;
                    $final_arr[$flag_count]['ocap_desc'] = $value2->ocap_desc;
                    $flag_count++;
                }
            }


        }

        // print_r($final_arr);
        $data['schemes'] = $final_arr;

        // $data['scheme_financials']
        return view('reptable_custom', $data)->render();
        // die;
        // $count_op = count($scheme_outp);
        // $count_oc = count($scheme_outc);
        // $maxcount = max($count_op, $count_oc);
        // foreach ($scheme_outp as $key => $value) {
        //     # code...
        //     $final_arr

        // }
    }

    public function getFinancials($scheme_id, $begin_date, $end_date)
    {
      # code...
        $current_month = date('m');
        $current_year = date('Y');
        $current_month_exp =0;
        if($current_month < 4){
            $est_end_year = date('Y');
            $current_year = date('Y', strtotime('-1 year'));
        }else{
            $est_end_year = date('Y', strtotime('+1 year'));
        }
        $totalEst = 0;
        $totalExp =0;
        $rev = 0;
        $cap = 0;
        $loan = 0;
        $revExp = 0;
        $capExp = 0;
        $loanExp = 0;
        $scheme = Scheme::Find($scheme_id);
        $estimate =$scheme->estimates()->first();
        if(!empty($estimate)){
            $revisedEstimate = $estimate->revisedEstimates()->get();
            if(count($revisedEstimate)){
                // print_r($revisedEstimate);
                foreach ($revisedEstimate as $re) {
                    $totalEst += $re->revenue + $re->capital + $re->loan;

                    $rev += $re->revenue;
                    $cap += $re->capital;
                    $loan += $re->loan;
                
                }
            }
            else{
                $budgetEstimate = $estimate->budgetEstimates()->get();
                if(count($budgetEstimate)){
                    foreach ($budgetEstimate as $be) {
                        $totalEst += $be->revenue + $be->capital + $be->loan;
                        $rev += $be->revenue;
                        $cap += $be->capital;
                        $loan += $be->loan;
                    }
                }
            }

            $expenditures = $scheme->expenditures()->get();
            foreach ($expenditures as $exp) {
                $year_exp =  explode('-',$exp->exp_year);
                // print_r($year_exp);
                $concerned_year = $year_exp[1];
                $concerned_month =  $year_exp[0];
                // if($current_year == $concerned_year){
                    $totalExp += $exp->revenue + $exp->capital + $exp->loan;
                    $revExp += $exp->revenue;
                    $capExp += $exp->capital;
                    $loanExp += $exp->loan;
                // }
            }
        }

        return array(
            'revenue' => $rev,
            'capital' => $cap,
            'loan' => $loan,
            'total_est' => $totalEst,
            'revExp' => $revExp,
            'capExp' => $capExp,
            'loanExp' => $loanExp,
            'total_exp' => $totalExp,
        );
    }
}