<?php

namespace App\Http\Controllers;

use App\Outcome;
use App\Output;
use Illuminate\Http\Request;

class OutcomeController extends Controller
{


    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $output_id = $request->input('output_id');
        $output = Output::find($output_id);
        $result = array();
        if(isset($output)){

            
            $outcomes = $output->outcomes()->get();
                 foreach ($outcomes as $outcome) {
    

                    $actionBtn = '<a href="scheme-objectives-outputs-outcome-indicators.html?outcome_id='.$outcome->id.'" class="btn btn-sm btn-green">
                                                <span class="text">Indicators</span>
                                            </a>
                                            <a class="btn btn-sm btn-primary editoutcome"  data-toggle="modal" data-target="#editOutcomeModal" data-id="'.$outcome->id . '" data-name="'.$outcome->name.'">
                                                <span class="text ">Edit</span>
                                            </a>
                                            <a class="btn btn-sm btn-danger deleteOut" data-id="'.$outcome->id . '">
                                                <span class="text">Delete</span>
                                            </a>';


            array_push($result, [
                    $outcome->name,
                    $actionBtn

                ]);
                 }


        }

         return response()->json(['outcomes'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outcome.create');
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
            'name'=>'required|max:191',
        ]);

        $output_id = $request->input('output_id');

        //$output_id =  request()->get('output_id');
        $output = Output::find($output_id);
        if(isset($output))
        {
            $outcome = $output->outcomes()->create([
                'name'=>request()->get('name')
                
            ]);
        }
         return response()->json(['success'=>'true','outcome'=>$outcome]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function show(Outcome $outcome)
    {
        return view('outcome.show', compact('outcome'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function edit(Outcome $outcome)
    {
        return view('outcome.edit', compact('outcome'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outcome $outcome)
    {
        $this->validate($request, [
            'scheme_id' => 'required|exists:schemes,id',
            'name'=>'required|max:191',
        ]);
        $outcome->scheme_id = $request->scheme_id;
        $outcome->name = $request->name;
        $outcome->save();
        return redirect()->route('outcome.index')
            ->with('success',
             'Outcome'. $outcome->name.' updated!');
    }

    public function updateoutcome(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name'=>'required|max:191',
        ]);

        $outcome_id = $request->input('id');

        //$output_id =  request()->get('output_id');
        $outcome = Outcome::find($outcome_id);
        if(isset($outcome))
        {
            $outcome->name=request()->get('name');
                $outcome->update(); 
            
        }
         return response()->json(['success'=>'true','outcome'=>$outcome]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Outcome  $outcome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outcome $outcome)
    {
        $outcome->delete();
        return redirect()->route('outcome.index')
            ->with('success',
             'Outcome deleted successfully!');
    }

     public function deleteOutcome(Request $request,$id)
    {
        $objective = Outcome::find($id);
        if(isset($objective)){
            $objective->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
}
