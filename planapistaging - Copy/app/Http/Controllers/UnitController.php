<?php

namespace App\Http\Controllers;

use App\Unit;
use App\Department;
use Illuminate\Http\Request;
use App\User;
use App\Notification;


class UnitController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
       // $this->middleware('auth');
        // $this->middleware(['role:admin'])->only('create','store','edit','update');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();

        $result = array();

        foreach ($units as $unit) {

            if($unit->is_default != 1){

                $department = $unit->department()->first();
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
                                    data-departmentid="' . $unit->department_id . '"
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
                    (!empty($department->name))?$department->name:"",
                    // $createdDate,
                    $actionBtn
                ]);
            }
        }

        return response()->json(['units'=>$result]);
        
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

    public function getUnitList()
    {


        if(!isset($_POST['department_id'])){
            $where = [
                "1" => 1
            ];
            return '';
        }
        else{
            $where = [
                'department_id' => $_POST['department_id'],
                'is_default' => 0
            ];
        }
        $units = Unit::where($where)->get();
        if(count($units)){
            return response()->json(['units'=>$units]);
        }
        else{
            $where = [
                'department_id' => $_POST['department_id']
            ];
            $units = Unit::where($where)->get();
            return response()->json(['units'=>$units]);
        }
        # code...
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
            'department_id' => 'required|exists:departments,id',
            // 'unitName'=>'required|max:191|unique:units,name',
        ]);
        $unit = new Unit;
        $department=Department::find($request->input('department_id'));
            if(isset($department->name)){
                $duplicate= 'false';
                $units = $department->units()->get();
                foreach ($units as $d_unit) {
                    if($d_unit->name ==$request->input('unitName') ){
                         $duplicate= 'true';
                         break;
                    }
                }
                if($duplicate == 'false'){
                    $unit->department_id = $request->department_id;
                    $unit->name = $request->unitName;
                    $unit->save();
                }
                
            }
        
        $message = '<li><a href="">New Implementing Agency: <b>'.$unit->name.'</b> Created</a></li>';
         $read_by =array();
        $intended_users=array();
        $superusers = User::role('super-admin')->get(); 
         foreach($superusers as $key=>$value){
          // echo $value->id;
          array_push($intended_users, $value->id);

          event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$value->id.'', $message));
        }
         Notification::create([
            'message'=>$message,
            'intended_for'=>json_encode($intended_users),
            'read_by'=>json_encode($read_by)
        ]);
        return response()->json(['success'=>'true','unit'=>$unit,'duplicate'=>$duplicate]);

       //return redirect()->route('unit.index')->with('success','Unit added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unit = Unit::find($id);
        if(!isset($unit)){
            return response()->json(['found'=>'false','unit'=>$unit]);

        }else{
            return response()->json(['found'=>'true','unit'=>$unit]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
       $unit = Unit::find($id);
         if(!isset($unit)){
             return response()->json(['found'=>'true','allowed'=>'true','unit'=>$unit]);
         }else{
             return response()->json(['found'=>'false','allowed'=>'true','unit'=>$unit]);

         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'department_id' => 'required|exists:departments,id',
            'unitName'=>'required|max:70|unique:units,name,' . $id,
        ]);
        

        $unit = Unit::find($id);
        if(!isset($unit)){
            
        return response()->json(['saved'=>'false','unit'=>$unit]);

        }else{
            $unit->department_id = $request->department_id;
            $unit->name = $request->unitName;
            $unit->update();
        return response()->json(['saved'=>'true','unit'=>$unit]);

        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grant = 'true';
        $unit = Unit::find($id);
        $schemes = $unit->schemes()->get();
        if(count($schemes) > 0 ){
            $grant = 'false';
        }
        if(!isset($unit) || $grant == 'false'){
         return response()->json(['deleted'=>'false']);

        }else{
            $unit->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
}
