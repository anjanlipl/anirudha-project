<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outputindicator;
use App\Outcomeindicator;
use App\IndicatorObject;
use App\OutcomeIndicatorObject;
use App\Ward;
use App\District;
use App\Vidhanshabha;

class IndicatorObjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $indicatorId = $request->input('indicator_id');
        $indicatorType = $request->input('type');
        $result= array();
        if($indicatorType == 'output'){
            $indicator = Outputindicator::find($indicatorId);
        }else if($indicatorType == 'outcome'){
            $indicator = Outcomeindicator::find($indicatorId);
        }
         //return response()->json(['indicator'=>$indicator]);
        $indicatorObj=array();
        if(isset($indicator->id)){
            $indicatorObjs = $indicator->indicatorObjects()->get();
            foreach ($indicatorObjs as $indicatorObj) {
                $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editSectorModal"  data-id="'.$indicatorObj->id.'">Edit</a></li>
                                    <li><a class="delete" data-id="'.$indicatorObj->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';
                            $ward=Ward::find($indicatorObj->ward);
                            $district = District::find($indicatorObj->district);
                            $vidhansabha = Vidhanshabha::find($indicatorObj->vidhanshabha);

             array_push($result, [
                    $indicatorObj->value,
                    // $createdDate,
                    $indicatorObj->latitude,
                    $indicatorObj->longitude,
                    $ward->name,
                    $district->name,
                    $vidhansabha->name,
                    $indicatorObj->remark,
                    //$actionBtn

                ]);
            }
             
        }

         return response()->json(['objects'=>$result]);

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
            'value'=>'required',
            'type'=>'required'
        ]);

        $indicatorType = $request->input('type');
        $ind_id = $request->input('indicator_id');
         //return response()->json(['ind_id'=>$ind_id]);
        
        $result= array();
        if($indicatorType == 'output'){
            IndicatorObject::create([
                'value'=>request()->get('value'),
                'latitude'=>request()->get('latitude'),
                'longitude'=>request()->get('longitude'),
                'ward'=>request()->get('ward'),
                'district'=>request()->get('district'),
                'vidhanshabha'=>request()->get('vidhanshabha'),
                'remark'=>request()->get('remark'),
                'outputindicator_id'=>$ind_id

            ]);
        }else if($indicatorType == 'outcome'){
            OutcomeIndicatorObject::create([
                'value'=>request()->get('value'),
                'latitude'=>request()->get('latitude'),
                'longitude'=>request()->get('longitude'),
                'ward'=>request()->get('ward'),
                'district'=>request()->get('district'),
                'vidhanshabha'=>request()->get('vidhanshabha'),
                'remark'=>request()->get('remark'),
                'outcomeindicator_id'=>$ind_id

            ]);
        }
        return response()->json(['success'=>'true']);

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
            'value'=>'required',
            'type'=>'required'
        ]);

        $indicatorType = $request->input('type');
        $result= array();
        if($indicatorType == 'output'){

            $indicatorObj = IndicatorObject::find($id);
            $indicatorObj->value = request()->get('value');
            $indicatorObj->latitude = request()->get('latitude');
            $indicatorObj->longitude = request()->get('longitude');
            $indicatorObj->ward = request()->get('ward');
            $indicatorObj->district = request()->get('district');
            $indicatorObj->remark = request()->get('remark');
            $indicatorObj->update();

        }else if($indicatorType == 'outcome'){

            $indicatorObj = OutcomeIndicatorObject::find($id);
            $indicatorObj->value = request()->get('value');
            $indicatorObj->latitude = request()->get('latitude');
            $indicatorObj->longitude = request()->get('longitude');
            $indicatorObj->ward = request()->get('ward');
            $indicatorObj->district = request()->get('district');
            $indicatorObj->remark = request()->get('remark');
            $indicatorObj->update();
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {

        $indicatorType = $request->input('type');
        $result= array();
        if($indicatorType == 'output'){
            $indicator = Outputindicator::find($indicatorId);
        }else if($indicatorType == 'outcome'){
            $indicator = Outcomeindicator::find($indicatorId);
        }
        if(isset($indicator->id)){
            $indicator->delete();
        }
    }
}
