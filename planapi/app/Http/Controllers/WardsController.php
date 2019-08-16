<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sector;
use App\Ward;

class WardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $sectors = Ward::all();

         $result = array();

        foreach ($sectors as $sector) {
             $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editSectorModal" data-name="' . $sector->name . '" data-id="'.$sector->id.'">Edit</a></li>
                                    <li><a class="delete" data-id="'.$sector->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

                $createdDate = 'NA';

                if(isset($sector->created_at)){
                  $createdDate =  date('d M, Y',strtotime($sector->created_at) );
                }    
                array_push($result, [
                    $sector->name,
                    $sector->latitude,
                    $sector->longitude,

                    // $createdDate,
                    $actionBtn
                ]);
        }
         return response()->json(['sectors'=>$result]);
        
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
            'sectorName'=>'required|max:191|unique:wards,name',
        ]);
        $sector = new Ward;
        $sector->name = $request->get('sectorName');
        $sector->latitude = $request->get('latitude');
        $sector->longitude = $request->get('longitude');

        $sector->save();
        return response()->json(['saved'=>'true','ward'=>$sector]);
        
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
            'sectorName'=>'required|max:70|unique:wards,name,'. $id,
        ]);
        $sector = Ward::find($id);
        if(!isset($sector)){
        return response()->json(['saved'=>'false','sector'=>$sector]);

        }else{
             $sector->name = $request->get('sectorName');

        $sector->latitude = $request->get('latitude');
        $sector->longitude = $request->get('longitude');
        $sector->update();
        return response()->json(['saved'=>'true','ward'=>$sector]);

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

        $sector = Ward::find($id);
    
        $sector->delete();
        return response()->json(['deleted'=>'true']);

    }
    public function getWardList()
    {
        $sectors = Ward::all();
       return response()->json(['wards'=>$sectors]);
        
    }
     public function getWardDetails($id)
    {
        $ward = Ward::find($id);
       return response()->json(['ward'=>$ward]);
        
    }
    
}
