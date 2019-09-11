<?php

namespace App\Http\Controllers;

use App\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Notification;
use DB;
use Auth;
class SectorController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        
        // header('Access-Control-Allow-Origin: http://localhost');
        // header("Access-Control-Allow-Credentials: true");
        // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        //$this->middleware('auth');
         //$this->middleware(['role:admin'])->only('create','store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::all();

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
                    // $createdDate,
                    $actionBtn
                ]);
        }
         return response()->json(['sectors'=>$result]);
        
        //return view('sector.index', compact('sectors'));
    }

     public function getSectorList()
    {
        $curr_user = Auth::user(); 
        $roles = $curr_user->getRoleNames();
        foreach ($roles as $role) {
            # code...
            if($role =='super-admin'){
                $sectors = Sector::orderBy('name', 'asc')->get();
            }
            else if($role =='department-admin' || $role =='hod'){
                $depart_id= Auth::user()->department_id;
                if($depart_id >0 && $depart_id != null){
                    $sectors = DB::table('departments as d')
                                ->join('subsectors as ss', 'ss.id', '=', 'd.subsector_id')
                                ->join('sectors as s', 'ss.sector_id', '=', 's.id')
                                ->where('d.id', '=', $depart_id)
                                ->select('s.id as id', 's.name as name')
                                ->get();

                    // $sectors = DB::table('sectors as s')
                    //             ->join('subsectors as ss', 'ss.sector_id', '=', 's.id')
                    //             ->join('departments as d', 'd.subsector_id', '=', 'd.id')
                    //             ->where('d.id', '=', $depart_id)
                    //             ->select('s.id as id', 's.name as name')
                    //             ->get();
                }
                else{
                    $sectors = Sector::orderBy('name', 'asc')->get();
                }
            }
            else{
                $sectors = Sector::orderBy('name', 'asc')->get();
            }
        }

        // print_r($sectors);

        // $sectors = Sector::orderBy('name', 'asc')->get();
        return response()->json(['sectors'=>$sectors]);
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
            'sectorName'=>'required|max:191|unique:sectors,name',
        ]);
        $sector = new Sector;
        $sector->name = $request->get('sectorName');
        $sector->save();

        //$sectorCreated = Sector::where('name',$request->get('sectorName'))->first();
        
        $nameDefault =$sector->id . '_default';
        $subsector = $sector->subsectors()->create([
            'name'=>$nameDefault,
            'is_default'=> '1'
        ]);


        $users = DB::table('users')
                    ->get();
        $superusers = User::role('super-admin')->get(); 
        $message = '<a href="sectors.html"><p class="notif-title"><b>New Sector: </b>'.$sector->name.' Created</p><p class="notif-time">'.date('d M, Y').' at '.date('h:i a').'</p></a>';
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
        $message['text'] = '<a href="sectors.html"><p class="notif-title"><b>New Sector: </b>'.$sector->name.' Created</p><p class="notif-time">'.date('d M, Y').' at '.date('h:i a').'</p></a>';
        foreach ($intended_users_arr as $key => $value) {
          # code...
          event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$value, $message));
        }

        return response()->json(['success'=>'true','sector'=>$sector]);

        /*return redirect()->route('sector.index')->with('success','Sector added successfully');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sector = Sector::find($id);
        if(!isset($sector)){
        return response()->json(['found'=>'false','sector'=>$sector]);

        }else{
            
        $subsectors =$sector->subsectors()->get();

        return response()->json(['found'=>'true','sector'=>$sector,'subsectors'=>$subsectors]);

        }
       
        //return view('sector.show', compact('sector','subsectors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        $sector = Sector::find($id);
         if(!isset($sector)){
             return response()->json(['found'=>'true','allowed'=>'true','sector'=>$sector]);
         }else{
             return response()->json(['found'=>'false','allowed'=>'true','sector'=>$sector]);

         }
      
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'sectorName'=>'required|max:70|unique:sectors,name,'. $id,
        ]);
        $sector = Sector::find($id);
        if(!isset($sector)){
        return response()->json(['saved'=>'false','sector'=>$sector]);

        }else{
             $sector->name = $request->get('sectorName');
        $sector->update();
        return response()->json(['saved'=>'true','sector'=>$sector]);

        }

       
       /* return redirect()->route('sector.index')
            ->with('success',
             'sector'. $sector->name.' updated!');*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grant = 'true';

        $sector = Sector::find($id);
        
        if(isset($sector->id)){
            $subsectors = $sector->subsectors()->get();
            if(count($subsectors)>0){
                foreach ($subsectors as $subsector) {
                    $departments = $subsector->departments()->get();
                    if(count($departments)>0){
                        $grant = 'false';
                    }
                }
            }
            
        }

        if(!isset($sector) || $grant == 'false'){
         return response()->json(['deleted'=>'false']);

        }else{
            $sector->delete();
            return response()->json(['deleted'=>'true']);
        }
    }

    public function sectorDashboardLinks()
    {
        # code...
        $sectors = Sector::orderBy('name', 'asc')->get();
        return response()->json(['sectors'=>$sectors]);
    }
}
