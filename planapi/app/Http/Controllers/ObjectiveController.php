<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scheme;
use App\Objective;
use App\Output;

class ObjectiveController extends Controller
{
    
     public function objectivesList(Request $request)
    {
    	//$schemeId =  request()->get('scheme_id');
    	$schemeId = $request->input('scheme_id');
    	$scheme = Scheme::find($schemeId);
    	$result = array();
    	if(isset($scheme)){

    		

    		$objectives = $scheme->objectives()->get();
    			 foreach ($objectives as $objective) {

    			 	$createdDate = 'NA';

    			 	$actionBtn = '<a class="btn btn-small btn-primary">
										<span class="text editObjectiveBtn" data-toggle="modal" data-target="#editobjModal" data-id="'.$objective->id .'" >Edit</span>
									</a>
									<a href="scheme-objectives-outputs.html?objective_id=' . $objective->id .'" class="btn btn-small btn-green">
										<span class="text">Outputs</span>
									</a>
									<a class="btn btn-small btn-danger deleteObj" data-id="'.  $objective->id .'">
										<span class="text">Delete</span>
									</a>';

                if(isset($objective->created_at)){
                  $createdDate =  date('d M, Y',strtotime($objective->created_at) );
                }

            array_push($result, [
                    $objective->description,
                    $createdDate,
                    $actionBtn

                ]);
    			 }


    	}

    	 return response()->json(['objectives'=>$result]);
    }

    public function objectivesHeadInfo(Request $request) {
        $schemeId = $request->input('scheme_id');
        $scheme = Scheme::find($schemeId);
        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p>  ";
        return response()->json(['headInfo'=>$result]);
    }

     public function store(Request $request)
    {

        //print_r($request->input()); die;

        $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
            'scheme_id'=>'required',
            'obj_desc' => 'required|max:191',
            

        ]);
        $schemeId = $request->input('scheme_id');
        $scheme= Scheme::find($schemeId);
        if(isset($scheme))
        {
        	$objective = $scheme->objectives()->create([
        		'description'=>request()->get('obj_desc')
        	]);
        }


        return response()->json(['success'=>'true','objective'=>$objective]);

        // return redirect()->route('scheme.index')->with('success','Scheme added successfully');
    }

      public function update(Request $request)
    {

        //print_r($request->input()); die;

        $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
        
            'obj_id'=>'required',
            'obj_desc' => 'required|max:191',
            

        ]);
        $obj_id = $request->input('obj_id');
        $objective= Objective::find($obj_id);
        if(isset($objective))
        {
            $objective->update([
                'description'=>request()->get('obj_desc')
            ]);
        }


        return response()->json(['success'=>'true','objective'=>$objective]);

        // return redirect()->route('scheme.index')->with('success','Scheme added successfully');
    }


    
    public function outputsList(Request $request)
    {
    	//$objective_id =  request()->get('ojective_id');
        $objective_id = $request->input('objective_id');

    	$objective = Objective::find($objective_id);
    	$result = array();
    	if(isset($objective)){

    		
    		$outputs = $objective->outputs()->get();
    			 foreach ($outputs as $output) {
	

    			 	$actionBtn = '<a href="scheme-objectives-outputs-outcome.html?output_id='.$output->id.'"class="btn btn-sm btn-red">
												<span class="text">Outcomes</span>
											</a>
											<a href="scheme-objectives-outputs-indicators.html?output_id='.$output->id.'" class="btn btn-sm btn-green">
												<span class="text">Indicators</span>
											</a>
											<a class="btn btn-sm btn-primary">
												<span class="text editoutput"  data-toggle="modal" data-target="#editOutputModal" data-id="'.$output->id.'" data-name="'.$output->name.'"  >Edit</span>
											</a>
											<a class="btn btn-sm btn-danger deleteOut"   data-id="'.$output->id.'" >
												<span class="text">Delete</span>
											</a>';


            array_push($result, [
                    $output->name,
                    $actionBtn

                ]);
    			 }


    	}

    	 return response()->json(['outputs'=>$result]);
    }

    public function outputsHeadInfo(Request $request) {

        $objective_id = $request->input('objective_id');
        $objective = Objective::find($objective_id);
        $scheme = Scheme::find($objective->scheme_id);

        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                ";
        return response()->json(['headInfo'=>$result]);
    }


 public function storeOutput(Request $request)
    {

        //print_r($request->input()); die;

        $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
            
            'output_name'=>'required|max:191',   

        ]);
        //$objective_id =  request()->get('ojective_id');
        $objective_id = $request->input('objective_id');
        $objective = Objective::find($objective_id);
        if(isset($objective))
        {
        	$output = $objective->outputs()->create([
        		'name'=>request()->get('output_name')
        		
        	]);
        }


        return response()->json(['success'=>'true','output'=>$output]);

        // return redirect()->route('scheme.index')->with('success','Scheme added successfully');
    }

    public function getObjectiveById(Request $request)
    {
        $obj_id = $request->input('objective_id');
        $objective = Objective::find($obj_id);
        
       return response()->json(['objective'=>$objective]);
        
    }
    public function editschemeoutput(Request $request)
    {


        $this->validate($request, [
           
            'output_name'=>'required|max:191',   

        ]);

        $output_id = $request->input('id');
        $output = Output::find($output_id);
        if(isset($output))
        {
            $output->name= $request->input('output_name');
            $output->update();
        }


        return response()->json(['success'=>'true','output'=>$output]);

        // return redirect()->route('scheme.index')->with('success','Scheme added successfully');
    }
     public function deleteObjective(Request $request,$id)
    {
        $objective = Objective::find($id);
        if(isset($objective)){
            $objective->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
    
    


}
