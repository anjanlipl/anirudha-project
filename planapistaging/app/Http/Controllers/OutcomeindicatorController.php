<?php

namespace App\Http\Controllers;

use App\Outcomeindicator;
use App\Scheme;
use App\Outcome;
use App\Output;
use App\Objective;
use App\IndicatorStatus;
use App\IndicatorUnit;
use Auth;
use DB;

use Illuminate\Http\Request;

class OutcomeindicatorController extends Controller
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
        $outcome_id = $request->input('outcome_id');

        $outcome = Outcome::find($outcome_id);
        $result = array();
        if(isset($outcome)){
            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));
            $outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
                 foreach ($outcomeIndicators as $outcomeIndicator) {

                    $outputIndicator = DB::table('outputindicators')
                                            ->where('id', $outcomeIndicator->output_indicator_id)
                                            ->first();

                    if(!empty($outputIndicator)) {
                        $outname = $outputIndicator->name;
                    }
                    else{
                        $outname = "";
                    }
                    
                    $sum = DB::table('outcome_achievements as oca')
                                ->join('outcometargets as oct', 'oca.outcometarget_id', '=', 'oct.id')
                                ->join('outcomeindicators as oci', 'oct.outcomeindicator_id', '=', 'oci.id')
                                ->where([
                                    ['oci.id', '=', $outcomeIndicator->id],
                                    ['oct.start_date', '>=', $begin_date],
                                    ['oct.end_date', '<=', $end_date]
                                ])
                                ->select('oca.*')
                                ->get();
                    if(count($sum) > 0){
                        if(count($sum) > 1){
                            $sum_new = 0;
                            foreach ($sum as $key => $value) {
                                # code...
                                $sum_new = $sum[0]->description;
                            }
                        }
                        else{
                            $sum_new = $sum[0]->description;
                        }
                    }
                    else{
                        $sum_new = "";
                    }


                    $sum3 = DB::table('outcometargets')
                                ->where([
                                    ['outcomeindicator_id', $outcomeIndicator->id],
                                    ['start_date', '>=', $begin_date],
                                    ['end_date', '<=', $end_date]
                                ])
                                ->select('*')
                                ->get();
                    if(count($sum3) > 0){
                        if(count($sum3) > 1){
                            $sum3_new = 0;
                            foreach ($sum3 as $key => $value) {
                                # code...
                                $sum3_new = $sum3[0]->value;
                            }
                        }
                        else{
                            $sum3_new = $sum3[0]->value;
                        }
                    }
                    else{
                        $sum3_new = "";
                    }

                    $actionBtn = '<ul><li><a href="outcome-target-baseline.html?indicator_id='.$outcomeIndicator->id.'" class="btn btn-sm btn-green">
                                                <span class="text">Targets &amp; Baseline</span>
                                            </a></li><li>
                                            <a class="btn btn-sm btn-primary editIndicator " data-toggle="modal" data-target="#editIndicatorModal" data-name="'.$outcomeIndicator->name .'" data-id="'.$outcomeIndicator->id .'" data-unit="'.$outcomeIndicator->unit_id.'" data-remark="'.$outcomeIndicator->remark.'">
                                                <span class="text">Edit</span>
                                            </a></li><li>
                                            <a class="btn btn-sm btn-danger deleteObj" data-id="'.$outcomeIndicator->id .'">
                                                <span class="text">Delete</span>
                                            </a></li><li>
                                            <a class="btn btn-sm btn-red indicatorObj" data-id="'.$outcomeIndicator->id .'">
                                                <span class="text">Indicator Objects</span>
                                            </a></li>';

                    $user = Auth::user(); 
                    $roles = $user->getRoleNames();
                    if($outcomeIndicator->is_critical == 1 ){
                        $is_critical = 'Yes';
                        $criticBtnText = "Mark Non-Critical";
                    }else{
                        $is_critical = 'No';
                        $criticBtnText = "Mark Critical";

                    }
                    foreach ($roles as $role) {
                            if($role =='super-admin'){
                                $actionBtn .= '<li><a class="btn btn-sm btn-primary markCritical" data-id="'.$outcomeIndicator->id .'">
                                                                                <span class="text">'.$criticBtnText.'</span>
                                                                            </a></li></ul>';
                                break;
                            }
                    }  
                    $status_id = $outcomeIndicator->status;

                    $status = IndicatorStatus::find($status_id);

                     $unit_id = $outcomeIndicator->unit_id;
                    if($unit_id == null){
                        $unitname = 'Na';
                    }else{
                        $unit = IndicatorUnit::find($unit_id );
                        $unitname = $unit->name;

                    }

                    if($unitname == 'Percentage'){
                        if($sum_new > 0 && $sum_new < 1){
                            $sum_new = ($sum_new * 100).'%';
                        }
                        if($sum3_new > 0 && $sum3_new < 1){
                            $sum3_new = ($sum3_new * 100).'%';
                        }
                    }
                    $status=isset($status->name)?$status->name:'';
            array_push($result, [
                    $outcomeIndicator->id,
                    $outcomeIndicator->name,
                    $outname,
                    $unitname,
                    $status,
                    $is_critical,
                    $sum3_new,
                    $sum_new,
                    $actionBtn

                ]);
                 }


        }

         return response()->json(['indicators'=>$result]);
    }

    public function markCritical($id) {

        $outputIndicator = Outcomeindicator::find($id);
        if($outputIndicator->is_critical == 0){
            $outputIndicator->is_critical = 1;
        }
        else{
            $outputIndicator->is_critical = 0;
        }
        $outputIndicator->update();
        return response()->json(['id'=>$id]);
    }
    public function outcomeIndicatorsHeadInfo(Request $request) {

        $outcome_id = $request->input('outcome_id');
        $outcome = Outcome::find($outcome_id);
        $output = Output::find($outcome->output_id);
        $objective = Objective::find($output->objective_id);
        $scheme = Scheme::find($objective->scheme_id);

        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>
                <p class='outcomeinfo' data-id='$outcome->id'><b>Outcome :</b> $outcome->name</p>";

        return response()->json(['headInfo'=>$result]);

    }

    public function outTargetBaseHeadInfo(Request $request) {

        $indicator_id = $request->input('indicator_id');
        $indicator = Outcomeindicator::find($indicator_id);
        $outcome = Outcome::find($indicator->outcome_id);
        $output = Output::find($outcome->output_id);
        $objective = Objective::find($output->objective_id);
        $scheme = Scheme::find($objective->scheme_id);

        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>
                <p class='outcomeinfo' data-id='$outcome->id'><b>Outcome :</b> $outcome->name</p>
                <p class='indicatorinfo' data-id='$indicator->id'><b>Indicator :</b> $indicator->name</p>";

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
        return view('outcomeindicator.create',compact('schemes'));
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
            'outcome_id' => 'required|exists:outcomes,id',
            'name'=>'required|max:191|unique:outcomeindicators,name',
        ]);

        $outcome_id = $request->input('outcome_id');
        $status = $request->input('status_id');
        $unit_id = $request->input('unit_id');
        $output_indicator_id = $request->input('output_indicator_id');
        $respond_to_criteria = $request->input('evaluation_type');
        $remark = $request->input('remark');


        //$output_id =  request()->get('output_id');
        $outcome = Outcome::find($outcome_id);
        if(isset($outcome))
        {
            if(isset($unit_id) && $unit_id !=0 && $unit_id!= ''){
                $indicator = $outcome->outcomeIndicators()->create([
                'name'=>request()->get('name'),
                'unit_id'=>$unit_id,
                'respond_to_criteria'=>$respond_to_criteria,
                'output_indicator_id'=> $output_indicator_id,
                'remark' => $remark,
                'status'=>$status
                
            ]);
            }else{
                $indicator = $outcome->outcomeIndicators()->create([
                'name'=>request()->get('name'),
                'respond_to_criteria'=>$respond_to_criteria,
                'output_indicator_id'=> $output_indicator_id,
                'remark' => $remark,
                'status'=>$status
                
            ]);
            }
            
        }
         return response()->json(['success'=>'true','indicator'=>$indicator]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outcomeindicator  $outcomeindicator
     * @return \Illuminate\Http\Response
     */
    public function show(Outcomeindicator $outcomeindicator)
    {
        return view('outcomeindicator.show', compact('outcomeindicator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outcomeindicator  $outcomeindicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcomeindicator $outcomeindicator)
    {
        return view('outcomeindicator.edit', compact('outcomeindicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outcomeindicator  $outcomeindicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcomeindicator $outcomeindicator)
    {
        $this->validate($request, [
            'outcome_id' => 'required|exists:outcomes,id',
            'name'=>'required|max:191',
            'baseline'=>'required|max:191',
            'status'=>'required|max:191',
        ]);

        $outcomeindicator->outcome_id = $request->outcome_id;
        $outcomeindicator->name = $request->name;
        $outcomeindicator->baseline = $request->baseline;
        $outcomeindicator->status = $request->status;

        $outputindicator->respond_to_criteria=$respond_to_criteria;

        $outcomeindicator->save();
        return redirect()->route('outcomeindicator.index')
            ->with('success',
             'Outcome Indicator'. $outcomeindicator->name.' updated!');
    }


    public function updateindicator(Request $request)
    {
        $this->validate($request, [
            
            'name'=>'required|max:191',
            
        ]);
        
        $ind_id = $request->input('id');
        $status = $request->input('status_id');
        $unit_id = $request->input('unit_id');
        $remark = $request->input('remark');
        $respond_to_criteria = $request->input('evaluation_type');


        //$output_id =  request()->get('output_id');
        $indicator = Outcomeindicator::find($ind_id);
        if(isset($indicator))
        {

            if(isset($unit_id) && $unit_id !=0 && $unit_id!= ''){
                    $indicator->unit_id = $unit_id; 
            }
           $indicator->name = $request->input('name');
            $indicator->status = $status;
            $indicator->output_indicator_id = $request->input('output_indicator_id');
        $indicator->respond_to_criteria=$respond_to_criteria;
        $indicator->remark=$remark;
            
           $indicator->update();
        }
         return response()->json(['success'=>'true','indicator'=>$indicator]);
        
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outcomeindicator  $outcomeindicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcomeindicator $outcomeindicator)
    {
        $outcomeindicator->delete();
        return redirect()->route('outcomeindicator.index')
            ->with('success',
             'Outcome Indicator deleted successfully!');
    }

    public function changeoutcomeindicator(Request $request)
    {
        $this->validate($request, [
            'indicator_id' => 'required|exists:outcomeindicators,id'
        ]);
        
        $status = $request->status_name;
        $outcome_Indicator= Outcomeindicator::find($request->indicator_id);
        $outcome_Indicator->status = $status;
        $outcome_Indicator->update();
        return redirect()->route('outcomeindicator.index')
            ->with('success',
             'Outcome Indicator'. $outcome_Indicator->name.' updated!');
    }

    public function deleteOutcomeIndicator(Request $request,$id)
    {
        $objective = Outcomeindicator::find($id);
        if(isset($objective)){
            $objective->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
}
