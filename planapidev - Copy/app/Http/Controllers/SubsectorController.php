<?php

namespace App\Http\Controllers;

use App\Subsector;
use App\Sector;
use Illuminate\Http\Request;
use App\User;
use App\Notification;
use DB;

class SubsectorController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware(['role:admin'])->only('create','store','edit','update');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsectors = Subsector::all();
        $result = array();

        foreach ($subsectors as $subsector) {
                if($subsector->is_default != 1){
                    $sector = $subsector->sector()->first();
                    if(isset($sector->id)){
                        $actionBtn = '<div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                            Actions <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" id="actionDrop">
                                            <li><a class="edit" data-toggle="modal"
                                                data-target="#editSubsectorModal" data-name="' . $subsector->name . '"
                                                data-sectorid="' . $subsector->sector_id . '"
                                            data-id="'.$subsector->id.'">Edit</a></li>
                                            <li><a class="delete" data-id="'.$subsector->id.'"  href="javascript:void(0);" >Delete</a></li>
                                        </ul>
                                    </div>';
                        $createdDate = 'NA';

                        if(isset($subsector->created_at)){
                          $createdDate =  date('d M, Y',strtotime($subsector->created_at) );
                        }
                        array_push($result, [
                            $subsector->name,
                            $sector->name,
                            // $createdDate,
                            $actionBtn
                        ]);
                    }
                }
        }

        return response()->json(['subsectors'=>$result]);

        //return view('subsector.index', compact('subsectors'));
    }

    public function getsubsectorlist(){
        if(!isset($_POST['sector_id'])){
            $where = [
                'is_default' => '0'
            ];
        }
        else{
            $where = [
                'sector_id' => $_POST['sector_id'],
                'is_default' => '0'
            ];
        }
        $subsectors = Subsector::where($where)->get();
       return response()->json(['subsectors'=>$subsectors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::all();
       return response()->json(['errorMsg'=>'','sectors'=>$sectors,'allowed'=>'true']);
        
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
            'sector_id' => 'required|exists:sectors,id',
            'subsectorName'=>'required|max:191|unique:subsectors,name',
        ]);
        $subsector = new Subsector;
        $subsector->sector_id = $request->sector_id;
        $subsector->name = $request->subsectorName;
        $subsector->save();


        $users = DB::table('users')
                    ->get();
        $superusers = User::role('super-admin')->get(); 
        $message = '<a href="sectors.html"><p class="notif-title"><b>New Subsector: <b>'.$subsector->name.'</b> Created</p><p class="notif-time">'.date('d M, Y').' at '.date('h:i a').'</p></a>';
        // $read_by =array();
        $intended_users=array();
        foreach($users as $key=>$value){
          // echo $value->id;
          array_push($intended_users, $value->id);
        }

        foreach($superusers as $key=>$value){
          // echo $value->id;
          if(!in_array($value->id, $intended_users)){
            array_push($intended_users, $value->id);
          }
        }
        $intended_users_arr = $intended_users;
        $notification = new Notification;
        $notification->message = $message;
        $notification->intended_for = implode(',', $intended_users);
        // $notification->read_by = implode(',', $read_by);
        $notification->save();
        $message = array();
        $message['id'] = $notification->id;
        $message['text'] = '<a href="sectors.html"><p class="notif-title"><b>New Subsector: <b>'.$subsector->name.'</b> Created</p><p class="notif-time">'.date('d M, Y').' at '.date('h:i a').'</p></a>';
        foreach ($intended_users_arr as $key => $value) {
          # code...
          event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$value, $message));
        }




        // $message = '<li><a href="">New Subsector: <b>'.$subsector->name.'</b> Created</a></li>';
        // $read_by =array();
        // $intended_users=array();
        // $superusers = User::role('super-admin')->get(); 
        //  foreach($superusers as $key=>$value){
        //   // echo $value->id;
        //   array_push($intended_users, $value->id);

        //   event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$value->id.'', $message));
        // }
        //  Notification::create([
        //     'message'=>$message,
        //     'intended_for'=>json_encode($intended_users),
        //     'read_by'=>json_encode($read_by)
        // ]);
        return response()->json(['success'=>'true','subsector'=>$subsector]);

        /*return redirect()->route('subsector.index')->with('success','Subsector added successfully');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subsector = Subsector::find($id);
        if(!isset($subsector)){
        return response()->json(['found'=>'false','subsector'=>$subsector]);

        }else{
        $sector =$subsector->sector()->first();

        return response()->json(['found'=>'true','sector'=>$sector,'subsector'=>$subsector]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $subsector = Subsector::find($id);
         if(!isset($sector)){
             return response()->json(['found'=>'false','allowed'=>'true','subsector'=>$subsector]);
         }else{
            $sector = $subsector->sector()->first();
             return response()->json(['found'=>'true','allowed'=>'true','sector'=>$sector,'subsector'=>$subsector]);

         }

        //return view('subsector.edit', compact('subsector','sectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sector_id' => 'required|exists:sectors,id',
            'subsectorName'=>'required|max:70|unique:subsectors,name,'. $id,
        ]);

        $subsector = Subsector::find($id);
        if(!isset($subsector)){
        return response()->json(['saved'=>'false','subsector'=>$subsector]);

        }else{
             $subsector->sector_id = $request->sector_id;
        $subsector->name = $request->subsectorName;
        $subsector->update();
        return response()->json(['saved'=>'true','subsector'=>$subsector]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsector  $subsector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $grant = 'true';

        $subsector = Subsector::find($id);
        if(isset($subsector->id)){
            $departments = $subsector->departments()->get();
            if(count($departments)>0){
                $grant = 'false';
            }
        }
        if(!isset($subsector) || $grant == 'false'){
         return response()->json(['deleted'=>'false']);

        }else{
            $subsector->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
}
