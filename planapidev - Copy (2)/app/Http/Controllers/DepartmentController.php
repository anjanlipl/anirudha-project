<?php

namespace App\Http\Controllers;
use App\Subsector;
use App\Sector;
use App\Department;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Notification;
use App\RaisedRequest;


class DepartmentController extends Controller
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
    public function index()
    {
        $departments = Department::orderBy('name', 'asc')->get();

        $result = array();

        foreach ($departments as $depart) {
                $name = $depart->name;
                $subsector = $depart->subsector()->first();
                $sector = $subsector->sector()->first();
                if(isset($subsector->id) && isset($sector->id)){
                    $sectorName = $sector->name;
                if($subsector->is_default == 1){
                    $subsectorName ='NA';
                }else{
                    $subsectorName = $subsector->name;
                }

                $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit" data-id="'.$depart->id.'"
                                    data-toggle="modal"
                                    data-target="#editDepartmentModal"
                                    data-name="' . $depart->name . '"
                                    data-sectorid="' . $subsector->sector_id . '"
                                    data-subsectorid="' . $depart->subsector_id . '"
                                    >Edit</a></li>
                                    <li><a class="delete" data-id="'.$depart->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';


                             $createdDate = 'NA';

                if(isset($depart->created_at)){
                  $createdDate =  date('d M, Y',strtotime($depart->created_at) );
                }    
                array_push($result, [
                    $name,
                    $sectorName,
                    $subsectorName,
                    // $createdDate,
                    $actionBtn
                ]);
                }
                
        }
        return response()->json(['departments'=>$result]);

        //return view('department.index', compact('departments'));
    }

     public function departmentDashboardLinks()
    {
        $departments = Department::orderBy('name', 'asc')->get();

        $result = array();

        foreach ($departments as $depart) {
                $name = $depart->name;
                $id = $depart->id;
                $subsector = $depart->subsector()->first();
                $sector = $subsector->sector()->first();
                if(isset($subsector->id) && isset($sector->id)){
                    $sectorName = $sector->name;
                if($subsector->is_default == 1){
                    $subsectorName ='NA';
                }else{
                    $subsectorName = $subsector->name;
                }

                $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="dashboard" href="dept_dashboard.html?dept_id='.$depart->id.'">Dashboard</a></li>
                                    
                                </ul>
                            </div>';


                             $createdDate = 'NA';

                if(isset($depart->created_at)){
                  $createdDate =  date('d M, Y',strtotime($depart->created_at) );
                }    
                array_push($result, [
                    'id' => $id,
                    'name'=>$name
                ]);
                }
                
        }
        return response()->json(['departments'=>$departments]);

        //return view('department.index', compact('departments'));
    }



     public function assignDepartmentslist()
    {
      $curr_user = Auth::user(); 
      $roles = $curr_user->getRoleNames();
      foreach ($roles as $role) {
         if($role =='super-admin'){
              $departments = Department::orderBy('name', 'asc')->get();
            }else if($role =='department-admin' || $role =='hod'){
              $depart_id= Auth::user()->department_id;
              if($depart_id >0 && $depart_id != null){
                $departments = Department::orderBy('name', 'asc')->where('id',$depart_id)->get();
              }else{
                $departments =array();
              }
            }else{
               $departments =array();
            }
        }    
        $result = array();
        foreach ($departments as $depart) {
              $allUserAssigned='';

                $name = $depart->name;
                $subsector = $depart->subsector()->first();
                $sector = $subsector->sector()->first();

                $sectorName = $sector->name;
                if($subsector->is_default == 1){
                    $subsectorName ='NA';
                }else{
                    $subsectorName = $subsector->name;
                }

                $actionBtn = '<a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#assignDepartModal" id="assignDept" data-id="'. $depart->id .'">
                                        <span class="text">Assign</span>
                                    </a>
                                   ';


                             $createdDate = 'NA';

                if(isset($depart->created_at)){
                  $createdDate =  date('d M, Y',strtotime($depart->created_at) );
                }    


                 
                  //var_dump($roles);die;
                  foreach ($roles as $role) {
                          if($role =='super-admin'){
                              if($depart->assigned_to != null && $depart->assigned_to != ''){
                                  $assignedUser= User::find($depart->assigned_to);
                                  $assigned_to = $assignedUser->name;
                              }else{
                                   $assigned_to = 'None';

                              }
                          }else if($role =='department-admin' || $role =='hod'){
                              $deptUsers = User::where('department_id',$depart->id)->get();
                              foreach ($deptUsers as $duser) {
                                $allUserAssigned .= $duser->name . ',' ;
                              }
                             $assigned_to = $allUserAssigned;
                          }else{
                                   $assigned_to = 'None';
                            
                          }
                }

               
                array_push($result, [
                    $name,
                    $sectorName,
                    $subsectorName,
                    $assigned_to,
                    // $createdDate,
                    $actionBtn
                ]);
        }
        return response()->json(['departments'=>$result]);

        //return view('department.index', compact('departments'));
    }

    
    public function checkDeptAccess(Request $request,$id)
    {
      $user = Auth::user();
      $depart_id = $user->department_id;
        $roles = $user->getRoleNames();
        $super =false;
        //var_dump($roles);die;
        foreach ($roles as $role) {
                if($role =='super-admin'){
                    $super =true;
                }
        }
        if($super == false){
            if($depart_id == $id){
                return response()->json(['allowed'=>'true']);
              }else{
                return response()->json(['allowed'=>'false']);
              }
        }else{
                return response()->json(['allowed'=>'true']);
          
        }
      
    }
    public function assignDeptSubmit(Request $request)
    {

         $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
            'deptId'=>'required|exists:departments,id',
            'user_id'=>'required|exists:users,id',
        ]);

        $department_id = $request->input('deptId');
        $user_id = $request->input('user_id');

        $department = Department::find($department_id);
        $user = User::find($user_id);


        $curr_user = Auth::user(); 
        $roles = $curr_user->getRoleNames();
        //var_dump($roles);die;
        foreach ($roles as $role) {
                if($role =='super-admin'){
                    $department->assigned_to = $user->id;
                    $department->update();
                }
        }
         $department->departAssign()->create([
            'user_id'=>$user_id,
            'dept_id'=>$department_id
         ]);
        $user->department_id = $department_id;
        $user->update();
         $allRequests = RaisedRequest::where('user_id',$user->id)->get();
         foreach ($allRequests as $raisedReq) {
           $raisedReq->is_active=0;
           $raisedReq->update();
         }
        return response()->json(['success'=>'true','department'=>$department]);

    }


    public function getDepartmentSchemes(Request $request)
    {
        # code...
        $dept_id = $request->input('dept_id');
        // echo $dept_id;
        $schemes = DB::table('schemes as s')
                        ->select('s.*')
                        ->join('units as u', 's.unit_id', '=', 'u.id')
                        ->where('u.department_id', $dept_id)
                        ->orderBy('name', 'asc')
                        ->get();

        return response()->json(['schemes'=>$schemes]);
    }

    public function getSchemeObjective(Request $request)
    {
      # code...
      $scheme_id = $request->input('scheme_id');
        // echo $scheme_id;
        $objectives = DB::table('objectives as o')
                        ->where('scheme_id', $scheme_id)
                        ->get();

        return response()->json(['objectives'=>$objectives]);
    }

    public function getObjectiveOutput(Request $request)
    {
      # code...
      $objective_id = $request->input('objective_id');
        // echo $objective_id;
        $outputs = DB::table('outputs as o')
                        ->where('objective_id', $objective_id)
                        ->get();

        return response()->json(['outputs'=>$outputs]);
    }
    

     public function getdepartmentlist(){
      $curr_user = Auth::user(); 
          $roles = $curr_user->getRoleNames();


        if(!isset($_POST['subsector_id']) || $_POST['subsector_id']==''){
           foreach ($roles as $role) {
            
                           if($role =='super-admin'){
                                $departments = Department::whereRaw('1=1')->orderBy('name', 'asc')->get();
                              }else if($role =='department-admin' || $role =='hod'){
                                $depart_id= Auth::user()->department_id;
                                if($depart_id >0 && $depart_id != null){
                                $departments = Department::whereRaw('1=1')->where('id',$depart_id)->orderBy('name', 'asc')->get();
                                }else{
                                  $departments = Department::whereRaw('1=1')->orderBy('name', 'asc')->get();
                                }
                              }else{
                                  $departments = Department::whereRaw('1=1')->orderBy('name', 'asc')->get();
                              }
                          } 
            
        }
        else{

          
          
            if($_POST['subsector_id'] == 0){
                  $sectorId =  $_POST['sector_id'];
                  if(isset($sectorId)){
                   $sector = Sector::find($sectorId);
                    $subsector = $sector->subsectors()->where('is_default',1)->first();
                   // $departments = $subsector->departments()->orderBy('name', 'asc')->get();

                    foreach ($roles as $role) {
                           if($role =='super-admin'){
                                $departments = $subsector->departments()->orderBy('name', 'asc')->get();
                              }else if($role =='department-admin' || $role =='hod'){
                                $depart_id= Auth::user()->department_id;
                                if($depart_id >0 && $depart_id != null){
                                  $departments = $subsector->departments()->orderBy('name', 'asc')->where('id',$depart_id)->get();
                                }else{
                                  $departments =array();
                                }
                              }else{
                                 $departments = $subsector->departments()->orderBy('name', 'asc')->get();
                              }
                          } 
                  }
            }else{
                $where = [
                'subsector_id' => $_POST['subsector_id']
            ];

             foreach ($roles as $role) {
                           if($role =='super-admin'){
                                $departments = Department::where($where)->orderBy('name', 'asc')->get();
                                
                              }else if($role =='department-admin' || $role =='hod'){
                                $depart_id= Auth::user()->department_id;
                                if($depart_id >0 && $depart_id != null){
                                      $departments = Department::where($where)->orderBy('name', 'asc')->where('id',$depart_id)->get();
                                }else{
                                      $departments = Department::where($where)->orderBy('name', 'asc')->get();
                                }
                              }else{
                                 $departments =array();
                              }
                          } 
            }
            
        }
       return response()->json(['departments'=>$departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        

       return response()->json(['errorMsg'=>'','allowed'=>'true']);
       

        //return view('department.create',compact('subsectors','sectors','errorMsg'));
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
            'sector_id'=>'required|exists:sectors,id',
            'departmentName'=>'required|max:191',
        ]);
        if(!isset($request->sector_id) || $request->sector_id == 0){
           
                $errorMsg="Please select sector";
                return response()->json(['success'=>'false','errorMsg'=>$errorMsg]);     
            
        }
        $department = new Department;
        if(isset($request->subsector_id) && $request->subsector_id != 0){

            $department->subsector_id = $request->subsector_id;
            $department->name = $request->departmentName;
            $department->save();
           // activity()->performedOn($department)->causedBy(Auth::user())->log('Created department'. $department->name);
            
        }else{
            $sector = Sector::find($request->sector_id);
            $defaultName  = $sector->id . '_default';
            $subsector = $sector->subsectors()->where('name',$defaultName)->first();
            $department->subsector_id = $subsector->id;
            $department->name = $request->departmentName;
            $department->save();
            activity()->performedOn($department)->causedBy(Auth::user())->log('Created department'. $department->name);
        }
        
        
        
        
        $nameDefault ='NA';
        $department->units()->create([
            'name'=>$nameDefault,
            'is_default'=>1
        ]);
        $department->establishmentExpenditure()->create([
           
        ]);

        $message = '<li><a href="">New Department: <b>'.$department->name.'</b> Created</a></li>';
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
        return response()->json(['success'=>'true','department'=>$department]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = Department::find($id);
        if(!isset($department)){
            return response()->json(['found'=>'false','department'=>$department]);

        }else{
            return response()->json(['found'=>'true','department'=>$department]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
         if(!isset($department)){
             return response()->json(['found'=>'true','allowed'=>'true','department'=>$department]);
         }else{
             return response()->json(['found'=>'false','allowed'=>'true','department'=>$department]);

         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [
            'sector_id'=>'required|exists:sectors,id',
            'departmentName'=>'required|max:191|unique:departments,name,'. $id,
        ]);
        if(!isset($request->sector_id) || $request->sector_id == 0){
           
                $errorMsg="Please select sector";
                return response()->json(['success'=>'false','errorMsg'=>$errorMsg]);     
            
        }
        $department = Department::find($id);
        if(isset($request->subsector_id) && $request->subsector_id != 0){

            $department->subsector_id = $request->subsector_id;
            $department->name = $request->departmentName;
            $department->update();
            
        }else{
            $sector = Sector::find($request->sector_id);
            $defaultName  = $sector->id . '_default';
            $subsector = $sector->subsectors()->where('name',$defaultName)->first();
            $department->subsector_id = $subsector->id;
            $department->name = $request->departmentName;
            $department->update();
        }
        


        return response()->json(['success'=>'true','department'=>$department]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grant = 'true';
        $department = Department::find($id);
        $units = $department->units()->get();
        if(count($units) > 0){
            foreach ($units as $unit) {
                $schemes = $unit->schemes()->get();
                if(count($schemes) > 0 ){
                     $grant = 'false';
                }
            }
        }

        if(!isset($department) || $grant == 'false'){
            return response()->json(['deleted'=>'false']);
        }else{
            $department->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
    
     public function getDepartmentById(Request $request)
    {
        $dept_id = $request->input('objective_id');
        $department = Department::find($dept_id);
        
       return response()->json(['department'=>$department]);
        
    }
    
}
