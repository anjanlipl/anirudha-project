<?php

namespace App\Http\Controllers;

use App\Scheme;
use App\Outputindicator;
use Illuminate\Http\Request;
use App\Objective;
use App\Output;
use App\IndicatorStatus;
use App\IndicatorUnit;
use DB;
use Auth;

class OutputindicatorController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$output_id =  request()->get('output_id');
        $output_id = $request->input('output_id');

        $output = Output::find($output_id);
        $result = array();
        if(isset($output)){
            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));
            
            $outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
                 foreach ($outputIndicators as $indicator) {
                    $sum1=0; $sum2=0;$sum5=0; $sum8=0; $sum10 = 0;

                    $sum1 = DB::table('achievements as a')
                                ->join('outputtargets as opt', 'a.outputtarget_id', '=', 'opt.id')
                                ->join('outputindicators as opi', 'opt.outputindicator_id', '=', 'opi.id')
                                ->where([
                                    ['opi.id', '=', $indicator->id],
                                    ['opt.start_date', '>=', $begin_date],
                                    ['opt.end_date', '<=', $end_date]
                                ])
                                ->select('a.*')
                                ->get();
                    if(count($sum1) > 0){
                        if(count($sum1) > 1){
                            $sum1_new = 0;
                            foreach ($sum1 as $key => $value) {
                                # code...
                                $sum1_new = $sum1[0]->description;
                            }
                        }
                        else{
                            $sum1_new = $sum1[0]->description;
                        }
                    }
                    else{
                        $sum1_new = "";
                    }


                    $sum2 = DB::table('outputtargets')
                                ->where([
                                    ['outputindicator_id', $indicator->id],
                                    ['start_date', '>=', $begin_date],
                                    ['end_date', '<=', $end_date]
                                ])
                                ->select('*')
                                ->get();
                    if(count($sum2) > 0){
                        if(count($sum2) > 1){
                            $sum2_new = 0;
                            foreach ($sum2 as $key => $value) {
                                # code...
                                $sum2_new = $sum2[0]->value;
                            }
                        }
                        else{
                            $sum2_new = $sum2[0]->value;
                        }
                    }
                    else{
                        $sum2_new = "";
                    }




                    $actionBtn = '<a href="output-target-baseline.html?indicator_id='.$indicator->id.'" class="btn btn-sm btn-green">
                                                <span class="text">Targets &amp; Baseline</span>
                                            </a>
                                            <a class="btn btn-sm btn-primary editIndicator" data-toggle="modal" data-target="#editIndicatorModal" data-name="'.$indicator->name .'" data-id="'.$indicator->id .'"
                                            data-unit="'.$indicator->unit_id.'" data-remark="'.$indicator->remark.'" >
                                                <span class="text">Edit</span>
                                            </a>
                                            
                                            <a class="btn btn-sm btn-danger deleteObj" data-id="'.$indicator->id .'">
                                                <span class="text">Delete</span>
                                            </a>
                                            <a class="btn btn-sm btn-red indicatorObj" data-id="'.$indicator->id .'">
                                                <span class="text">Indicator Objects</span>
                                            </a>';
                    $user = Auth::user(); 
                    $roles = $user->getRoleNames();
                    if($indicator->is_critical == 1 ){
                        $is_critical = 'Yes';
                        $criticBtnText = "Mark Non-Critical";
                    }else{
                        $is_critical = 'No';
                        $criticBtnText = "Mark Critical";
                    }
                    foreach ($roles as $role) {
                            if($role =='super-admin'){
                                $actionBtn .= '<a class="btn btn-sm btn-primary markCritical" data-id="'.$indicator->id .'">
                                                                                <span class="text">'.$criticBtnText.'</span>
                                                                            </a>';
                                break;
                            }
                    }                
                    $status_id = $indicator->status;
                    $status = IndicatorStatus::find($status_id);
                    $unit_id = $indicator->unit_id;
                    if($unit_id == null){
                        $unitname = 'Na';
                    }else{
                        $unit = IndicatorUnit::find($unit_id );
                        $unitname = $unit->name;

                    }

                    if($unitname == 'Percentage'){
                        if($sum2_new > 0 && $sum2_new < 1){
                            $sum2_new = ($sum2_new * 100).'%';
                        }
                        if($sum1_new > 0 && $sum1_new < 1){
                            $sum1_new = ($sum1_new * 100).'%';
                        }
                    }
            array_push($result, [
                    $indicator->id,
                    $indicator->name,
                    $unitname,
                    $status->name,
                    $is_critical,
                    $sum2_new,
                    $sum1_new,
                    $actionBtn

                ]);
                 }


        }

         return response()->json(['indicators'=>$result]);
    }


    public function parentinds(Request $request)
    {
        # code...
        // echo $request->outcome_id;

        $output = DB::table('outcomes as oc')
            ->join('outputs as o', 'oc.output_id', '=', 'o.id')
            ->select('o.id as out_id')
            ->where('oc.id', $request->outcome_id)
            ->first();
        $output_id = $output->out_id;
        $output = Output::find($output_id);
        $outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
        // print_r($outputIndicators);
       return response()->json(['inds'=>$outputIndicators]);
    }
    

     public function markCritical($id) {

        $outputIndicator = Outputindicator::find($id);
        if($outputIndicator->is_critical == 0){
            $outputIndicator->is_critical = 1;
        }
        else{
            $outputIndicator->is_critical = 0;
        }
        $outputIndicator->update();
        return response()->json(['id'=>$id]);
    }
    public function outputIndicatorsHeadInfo(Request $request) {

        $output_id = $request->input('output_id');
        $output = Output::find($output_id);

        $objective = Objective::find($output->objective_id);
        $scheme = Scheme::find($objective->scheme_id);
        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>";
                

        return response()->json(['headInfo'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $schemes = Scheme::all();
        return view('outputindicator.create',compact('schemes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'output_id' => 'required|exists:outputs,id',
            'name'=>'required|max:191|unique:outputindicators,name',
        ]);
        
        $output_id = $request->input('output_id');

        //$output_id =  request()->get('output_id');
        $output = Output::find($output_id);
         $status = $request->input('status_id');
        $unit_id = $request->input('unit_id');
        $respond_to_criteria = $request->input('evaluation_type');


        if(isset($output))
        {

            if(isset($unit_id) && $unit_id !=0 && $unit_id!= ''){
                $indicator = $output->outputIndicators()->create([
                'name'=>request()->get('name'),
                'unit_id'=>$unit_id,
                'respond_to_criteria'=>$respond_to_criteria,
                'status'=>$status,
                'remark' => request()->get('remarks')
                
                ]);    
            }else{
                $indicator = $output->outputIndicators()->create([
                'name'=>request()->get('name'),
                'respond_to_criteria'=>$respond_to_criteria,
                'status'=>$status,
                'remark' => request()->get('remarks')
                
                ]); 
            }
            
        }
         return response()->json(['success'=>'true','indicator'=>$indicator]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outputindicator  $outputindicator
     * @return \Illuminate\Http\Response
     */
    public function show(Outputindicator $outputindicator)
    {
        return view('outputindicator.show', compact('outputindicator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outputindicator  $outputindicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Outputindicator $outputindicator)
    {
        return view('outputindicator.edit', compact('outputindicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outputindicator  $outputindicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outputindicator $outputindicator)
    {
        $this->validate($request, [
            'id' => 'required|exists:outputs,id',
            'name'=>'required|max:191',
            'baseline'=>'required|max:191',
            'status'=>'required|max:191',
        ]);

        $outputindicator->output_id = $request->id;
        $unit_id = $request->input('unit_id');
        $respond_to_criteria = $request->input('evaluation_type');

         if(isset($unit_id) && $unit_id !=0 && $unit_id!= ''){
                    $outputindicator->unit_id = $unit_id; 
            }
        $outputindicator->name = $request->name;
        $outputindicator->baseline = $request->baseline;
        $outputindicator->status = $request->status;
        $outputindicator->respond_to_criteria=$respond_to_criteria;

        $outputindicator->update();
        return redirect()->route('outputindicator.index')
            ->with('success',
             'Output Indicator'. $outputindicator->name.' updated!');
    }

     public function updateindicator(Request $request)
    {
        $this->validate($request, [
            
            'name'=>'required|max:191',
            
        ]);
        
        $ind_id = $request->input('id');
        $status = $request->input('status_id');
        $unit_id = $request->input('unit_id');
        $respond_to_criteria = $request->input('evaluation_type');
        $remark = $request->input('remarks');


        //$output_id =  request()->get('output_id');
        $indicator = Outputindicator::find($ind_id);
        if(isset($indicator))
        {

            if(isset($unit_id) && $unit_id !=0 && $unit_id!= ''){
                    $indicator->unit_id = $unit_id; 
            }
           $indicator->name = $request->input('name');
            $indicator->status = $status;
        $indicator->respond_to_criteria=$respond_to_criteria;
            $indicator->remark = $remark;
           $indicator->update();
        }
         return response()->json(['success'=>'true','indicator'=>$indicator]);
        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outputindicator  $outputindicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outputindicator $outputindicator)
    {
        $outputindicator->delete();
        return redirect()->route('outputindicator.index')
            ->with('success',
             'Output Indicator deleted successfully!');
    }



    public function changeoutputindicator(Request $request)
    {
        $this->validate($request, [
            'indicator_id' => 'required|exists:outputindicators,id'
        ]);
        
        $status = $request->status_name;
        $output_Indicator= Outputindicator::find($request->indicator_id);
        $output_Indicator->status = $status;
        $output_Indicator->update();
        return redirect()->route('outputindicator.index')
            ->with('success',
             'Output Indicator'. $output_Indicator->name.' updated!');
    }

    
    public function deleteOutputIndicator(Request $request,$id)
    {
        $objective = Outputindicator::find($id);
        if(isset($objective)){
            $objective->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
    
}
