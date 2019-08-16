<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use App\IndicatorUnit;

class IndicatorUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
    {
        $units = IndicatorUnit::all();

        $result = array();

        foreach ($units as $unit) {

            if($unit->is_active != 0){



                 $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit"
                                    data-id="'.$unit->id.'"
                                    data-toggle="modal"
                                    data-target="#editUnitModal"
                                    data-name="' . $unit->name . '"
                                    >Edit</a></li>
                                    <li><a class="delete" data-id="'.$unit->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';
                $createdDate = 'NA';

                if(isset($unit->created_at)){
                  $createdDate =  date('d M, Y',strtotime($unit->created_at) );
                }

                array_push($result, [
                    $unit->name,
                    // $createdDate,
                    $actionBtn
                ]);
            }
        }

        return response()->json(['units'=>$result]);
        
    }

    public function getIndUnitList()
    {
        $indunits = IndicatorUnit::all();
       return response()->json(['indunits'=>$indunits]);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'unitName'=>'required|max:191|unique:units,name',
        ]);
        $unit = new IndicatorUnit;
        $unit->name = $request->unitName;
        $unit->save();
        return response()->json(['success'=>'true','unit'=>$unit]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'unitName'=>'required|max:70|unique:units,name,' . $id,
        ]);
        

        $unit = IndicatorUnit::find($id);
        if(!isset($unit)){
            
        return response()->json(['saved'=>'false','unit'=>$unit]);

        }else{
            $unit->name = $request->unitName;
            $unit->update();
        return response()->json(['saved'=>'true','unit'=>$unit]);

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
        $unit = IndicatorUnit::find($id);
        
        if(!isset($unit)){
         return response()->json(['deleted'=>'false']);

        }else{
            $unit->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
}
