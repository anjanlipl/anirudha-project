<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchemeMonitoringType;

class MonitoringTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitoringTypes = SchemeMonitoringType::all();
    
        $result = array();

        foreach ($monitoringTypes as $monitoringType) {



            $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit"
                                    data-toggle="modal"
                                    data-target="#editMonTypeModal"
                                    data-abbr="' . $monitoringType->abbreviation . '"
                                    data-desc="' . $monitoringType->description . '"
                                    data-id="'.$monitoringType->id.'"
                                    >Edit</a></li>
                                    <li><a class="delete" data-id="'.$monitoringType->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

            $createdDate = 'NA';

                if(isset($monitoringType->created_at)){
                  $createdDate =  date('d M, Y',strtotime($monitoringType->created_at) );
                }

            array_push($result, [
                    $monitoringType->abbreviation,
                    $monitoringType->description,
                    $createdDate,
                    $actionBtn
                ]);
        }

        return response()->json(['monitoringtypes'=>$result]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return response()->json(['errorMsg'=>'','allowed'=>'true']);
      
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
            'abbreviation'=>'required|max:191|unique:scheme_monitoring_types,abbreviation',
            'description' => 'required|max:191'
        ]);
        $monitoringType = new SchemeMonitoringType;
        $monitoringType->abbreviation = $request->abbreviation;
        $monitoringType->description = $request->description;
        $monitoringType->save();
        return response()->json(['success'=>'true','monitoringType'=>$monitoringType]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $monitoringType = SchemeMonitoringType::find($id);
        if(!isset($monitoringType)){
            return response()->json(['found'=>'false','monitoringType'=>$monitoringType]);

        }else{
            return response()->json(['found'=>'true','monitoringType'=>$monitoringType]);

        }
    }



    public function montypeList()
    {
        # code...
        $montype = SchemeMonitoringType::orderBy('abbreviation', 'asc')->get();
       return response()->json(['montype'=>$montype]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $monitoringType = SchemeMonitoringType::find($id);
       
         if(!isset($monitoringType)){
             return response()->json(['found'=>'true','allowed'=>'true','monitoringType'=>$monitoringType]);
         }else{
             return response()->json(['found'=>'false','allowed'=>'true','monitoringType'=>$monitoringType]);

         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     $this->validate($request, [
        'abbreviation'=>'required|max:191|abbreviation|unique:scheme_monitoring_types,' . $id,
         ]);
        $monitoringType = SchemeMonitoringType::find($id);

        if(!isset($monitoringType)){
            
        return response()->json(['saved'=>'false','monitoringType'=>$monitoringType]);

        }else{
            $monitoringType->abbreviation = $request->abbreviation;
            $monitoringType->description = $request->description;
            $monitoringType->update();
            return response()->json(['saved'=>'true','monitoringType'=>$monitoringType]);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monitoringType = SchemeMonitoringType::find($id);
        
        if(!isset($monitoringType)){
         return response()->json(['deleted'=>'false']);

        }else{
            $monitoringType->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
}
