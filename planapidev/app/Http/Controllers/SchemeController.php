<?php

namespace App\Http\Controllers;

use App\Scheme;
use App\Unit;
use App\Type;
use App\Output;
use App\Department;
use Illuminate\Http\Request;
use Excel;
use App\User;
use App\SchemeAssign;
use Auth;
use App\SchemeMonitoringType;
use App\Tag;
use Pusher;
use DB;
use App\Notification;

class SchemeController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {

        // header('Access-Control-Allow-Origin: http://localhost');
        //  header("Access-Control-Allow-Credentials: true");
        //  header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
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
        $user = Auth::user(); 
        $roles = $user->getRoleNames();
        //var_dump($roles);die;
        $returnRoles = array();
        $schemes =array();
        foreach ($roles as $role) {
                if($role =='super-admin'){
                    $schemes = Scheme::all();
                }else{
                  $department = Department::find($user->department_id);
                    if(isset($department) && $department->id != null){
                      $units = $department->units()->get();
                      foreach ($units as $unit) {
                        $tem_schemes = $unit->schemes()->get();
                          array_push($schemes, $tem_schemes);
                      }
                    }else{
                    $schemes = Scheme::all();

                    }
                }
        }
        $result = array();
        //;exit;
       // var_dump($schemes);exit;

         foreach ($roles as $role) {
                if($role =='super-admin'){
                       foreach ($schemes as $scheme) {

                          $unit = $scheme->unit()->first();
                          $unitName ='NA';
                          if(isset($unit->id) && $unit->is_default == 0){
                              $unitName = $unit->name;
                          }
                          if(isset($unit->id)){
                                $dept = $unit->department()->first();
                                 //$deptName ='NA';
                                 if(isset($dept->id)){
                                     $deptName = $dept->name;
                                     $subsector = $dept->subsector()->first();
                                        $subsectorName ='NA';
                                        if(isset($subsector) && $subsector->is_default == 0){
                                            $subsectorName = $subsector->name;
                                        }
                                        if(isset($subsector->id)){
                                              $sector = $subsector->sector()->first();
                                              //$sectorName ='NA';
                                              if(isset($sector)){
                                                  $sectorName = $sector->name;
                                              }
                                        }
                                         
                                 }
                              }
                         
                          
                          
                         if(isset($sectorName) && isset($deptName)){
                               $actionBtn = '<ul class="btn-group">
                                                <li><a class="btn btn-sm btn-primary" id="editScheme" data-id="'. $scheme->id .'">
                                                    <span class="text">Edit</span>
                                                </a></li>
                                                <li><a href="add-scheme-financials.html?scheme_id='.$scheme->id.'" class="btn btn-sm btn-green">
                                                    <span class="text">Financials</span>
                                                </a></li>
                                                <li><a href="scheme-objectives.html?scheme_id='.$scheme->id.'"  class="btn btn-sm btn-red">
                                                    <span class="text">Objectives</span>
                                                </a></li>
                                                <li><a class="btn btn-sm btn-danger delScheme" data-id="'. $scheme->id .'">
                                                    <span class="text">Delete</span>
                                                </a></li></ul>';

                                $createdDate = 'NA';

                                    if(isset($scheme->created_at)){
                                      $createdDate =  date('d M, Y',strtotime($scheme->created_at) );
                                    }
                                      $is_capital='No';

                                    if($scheme->is_capital == 1){
                                      $is_capital='Yes';
                                    }

                        array_push($result, [
                                $scheme->name,
                                $sectorName,
                                $subsectorName,
                                $deptName,
                                $unitName,
                                $is_capital,
                                $createdDate,
                                $actionBtn
                            ]);
                         }

                       
                   }
                }else{
                    foreach ($schemes as $key => $value) {
          foreach ($value as $key2 => $scheme) {
               
            $unit = $scheme->unit()->first();
            $unitName ='NA';
            if(isset($unit) && $unit->is_default == 0){
                $unitName = $unit->name;
            }
            $dept = $unit->department()->first();
            $deptName ='NA';
            if(isset($dept)){
                $deptName = $dept->name;
            }
            $subsector = $dept->subsector()->first();
            $subsectorName ='NA';
            if(isset($subsector) && $subsector->is_default == 0){
                $subsectorName = $subsector->name;
            }
            $sector = $subsector->sector()->first();
            $sectorName ='NA';
            if(isset($sector)){
                $sectorName = $sector->name;
            }

            $actionBtn = '<ul class="btn-group">
                                    <li><a class="btn btn-sm btn-primary" id="editScheme" data-id="'. $scheme->id .'">
                                        <span class="text">Edit</span>
                                    </a></li>
                                    <li><a href="add-scheme-financials.html?scheme_id='.$scheme->id.'" class="btn btn-sm btn-green">
                                        <span class="text">Financials</span>
                                    </a></li>
                                    <li><a href="scheme-objectives.html?scheme_id='.$scheme->id.'"  class="btn btn-sm btn-red">
                                        <span class="text">Objectives</span>
                                    </a></li>
                                    <li><a class="btn btn-sm btn-danger delScheme" data-id="'. $scheme->id .'">
                                        <span class="text">Delete</span>
                                    </a></li></ul>';

            $createdDate = 'NA';

                if(isset($scheme->created_at)){
                  $createdDate =  date('d M, Y',strtotime($scheme->created_at) );
                }
                  $is_capital='No';

                if($scheme->is_capital == 1){
                  $is_capital='Yes';
                }

            array_push($result, [
                    $scheme->name,
                    $sectorName,
                    $subsectorName,
                    $deptName,
                    $unitName,
                    $is_capital,
                    $createdDate,
                    $actionBtn
                ]);
          }
        }
      
                }
             }   
        
       

        return response()->json(['schemes'=>$result]);
        
    }

    
    public function assignSchemeSubmit(Request $request)
    {

         $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
            'schemeId'=>'required|exists:schemes,id',
            'user_id'=>'required|exists:users,id',
        ]);

        $schemeId = $request->input('schemeId');
        $user_id = $request->input('user_id');
        $c_user = Auth::user(); 
        $roles = $c_user->getRoleNames();
        $scheme = Scheme::find($schemeId);
        $user = User::find($user_id);

        $unit = $scheme->unit()->first();
        $department =$unit->department()->first();

        //var_dump($roles);die;
        foreach ($roles as $role) {
                if($role =='super-admin'){
                    $scheme->assigned_to = $user->id;
                    $scheme->update();
                }else if($role == 'department-admin'){
                  $assignScheme = new SchemeAssign;
                  $assignScheme->user_id = $user_id;
                  $assignScheme->scheme_id = $schemeId;
                  $assignScheme->save();
                  $user->department_id = $department->id;
                  $user->update();

                   /* $scheme = Scheme::find($schemeId);
                    $scheme->schemeAssign()->create([
                      'user_id'=>$user_id
                    ]);*/
                }
        }

       

        
        return response()->json(['success'=>'true','scheme'=>$scheme]);

    }
    
    public function raiseRequestSchemeList()
    {

         // $user = Auth::user(); 
         // $departId = $user->department_id;
         // $department = Department::find($departId);
         // $allschemes = array();
         // if(isset($department) && $department != null ){
         //    $units = $department->units()->get();
             
         //     foreach ($units as $unit) {
         //         $schemes = $unit->schemes()->get();
         //         array_push($allschemes, $schemes);
         //     }
         // }
         $allschemes = array();
         $depts = Department::all();
         array_push($allschemes, $depts);
        return response()->json(['success'=>'true','schemes'=>$allschemes]);

        
    }
    public function schemeAssignList()
    {
        //$schemes = Scheme::all();

      $user = Auth::user(); 
        $roles = $user->getRoleNames();
        //var_dump($roles);die;
        $returnRoles = array();
        foreach ($roles as $role) {
                if($role =='super-admin'){
                    $schemes = Scheme::all();
                }else if($role == 'department-admin'){
                    $schemes = Scheme::where('assigned_to', $user->id)->get();
                }
        }
        $result = array();

        foreach ($schemes as $scheme) {

            $unit = $scheme->unit()->first();
            $unitName ='NA';
            if(isset($unit) && $unit->is_default == 0){
                $unitName = $unit->name;
            }
            $dept = $unit->department()->first();
            $deptName ='NA';
            if(isset($dept)){
                $deptName = $dept->name;
            }
            $subsector = $dept->subsector()->first();
            $subsectorName ='NA';
            if(isset($subsector) && $subsector->is_default == 0){
                $subsectorName = $subsector->name;
            }
            $sector = $subsector->sector()->first();
            $sectorName ='NA';
            if(isset($sector)){
                $sectorName = $sector->name;
            }

            $actionBtn = '<a class="btn btn-sm btn-primary"  data-toggle="modal" data-target="#assignSchemeModal" id="assignScheme" data-id="'. $scheme->id .'">
                                        <span class="text">Assign Scheme</span>
                                    </a>
                                   ';

            $createdDate = 'NA';

                if(isset($scheme->created_at)){
                  $createdDate =  date('d M, Y',strtotime($scheme->created_at) );
                }
                  $is_capital='No';

                if($scheme->is_capital == 1){
                  $is_capital='Yes';
                }

                if($scheme->assigned_to != null && $scheme->assigned_to != ''){
                    $assignedUser= User::find($scheme->assigned_to);
                    $assigned_to = $assignedUser->name;
                }else{
                     $assigned_to = 'None';

                }


            array_push($result, [
                    $scheme->name,
                    $sectorName,
                    $subsectorName,
                    $deptName,
                    $unitName,
                    $is_capital,
                    $assigned_to,
                    $actionBtn
                ]);
        }

        return response()->json(['schemes'=>$result]);
        
    }

    
    
    public function uploadScheme(Request $request){
       /* $filename = $_FILES['schemefile']['name'];
        return $filename;*/
         //return response()->json(var_dump($_FILES));
          $this->validate($request, [
             'schemefile' => 'required|max:10000|mimes:xls,xlsx,csv'
        ]);
        

        $file = $request->file('schemefile');
        $destinationPath = 'uploads/schemes';
        //echo $destinationPath . '/' . $file->getClientOriginalName();
        $img_path ='';
        if(isset($file)){
            $file->move($destinationPath, $file->getClientOriginalName());
            $img_path = $destinationPath . '/' . $file->getClientOriginalName();
            try {
                Excel::load($img_path, function ($reader) {
                    foreach ($reader->toArray() as $row) {
                       /* echo response()->json(['scheme'=>$row]);*/
                      // echo $row[0]['name'] ;exit;
                       foreach ($row as $key => $value) {
                           //echo $row[$key]['name'] ;
                           
                           if($row[$key]['unit_name'] != '' && $row[$key]['unit_name'] != 'NA' ){
                                $unit_name = $row[$key]['unit_name'];
                                $unit = Unit::where('name',$unit_name)->first();

                           }else{
                            $department_name =$row[$key]['department_name']; 
                                $department = Department::where('name',$department_name)->first();
                                $unit = $department->units()->where('is_default',1)->first();

                           }
                            $monitoringType = SchemeMonitoringType::where('abbreviation',$row[$key]['monitoring_type'])->first();
                            $tag = Tag::where('tag_name',$row[$key]['tag_name'])->first();
                            $is_capital = 0;
                            if($row[$key]['capital'] == 'yes'){
                            $is_capital = 1;

                            }

                             $scheme = $unit->schemes()->create([
                                'name' => $row[$key]['scheme_name'],
                                'code' => $row[$key]['code'],
                                'account_head' => $row[$key]['account_head'],
                                'demand_no' => $row[$key]['demand_number'],
                                'remarks' =>$row[$key]['remarks'] ,
                                'start_date' => date('Y-m-d',strtotime( $row[$key]['start_date'] )),
                                'end_date' => date('Y-m-d',strtotime( $row[$key]['end_date'] )),
                                'scheme_monitoring_type_ids' => json_encode($monitoringType->id),
                                'tag_ids' => json_encode($tag->id),
                                'is_capital'=>$is_capital,
                                'latitude'=>$row[$key]['latitude'],
                                'longitude'=>$row[$key]['longitude']
                                

                            ]);
                            $type_variety =  $row[$key]['state_or_central'];
                            if($type_variety =='state' ){
                              $type_variety_id = 1;
                              $state_share = 100;
                              $central_share = 0;
                            }else{
                               $type_variety_id = 2;
                              $state_share = $row[$key]['state_share'];
                              $central_share = $row[$key]['central_share'];
                            }
                            $scheme->type()->create([
                                'type_variety_id'=>$type_variety_id,
                                'state_share'=>$state_share,
                                'central_share'=>$central_share
                            ]);

                       }
                    }
                });
                //\Session::flash('success', 'Users uploaded successfully.');
                return "success";
            } catch (\Exception $e) {
                   // \Session::flash('error', $e->getMessage());
                    return $e;
            }

            return "success";
        }
        else{
          return "failed2";
        }

        
    }


    public function uploadSchemeData(Request $request){

        $this->validate($request, [
            // 'schemefile' => 'required|max:10000|mimes:xls,xlsx,csv',
            'deptId'=>'required'
             
        ]);
          
        $deptId=$request->get('deptId');
        
        $unitId=$request->get('unitId');
        
        if($unitId == null || $unitId == '' || $unitId == 0){
            $department = Department::find($deptId);
            $unit = $department->units()->where('is_default',1)->first();
            $unitId = $unit->id;
        }
        
        //$ig = Unit::find(10);
        
        $file = $request->file('schemefile');
        
        $destinationPath = 'uploads/schemes';
        
        //echo $destinationPath . '/' . $file->getClientOriginalName();
        
        $img_path ='';
        
        if(isset($file)){
            $file->move($destinationPath, $file->getClientOriginalName());
            $img_path = $destinationPath . '/' . $file->getClientOriginalName();
            config(['excel.import.startRow' => 1]);
            try {
                  //echo $img_path;die();
                $reader = \Excel::load($img_path); 
                //this will load file
                //echo 'sadasd';die();

                $results = $reader->noHeading()->get()->toArray();
                //print_r($results);
                $head = $results[0];
                
                $baseline1Name = "Baseline 2017-18";
                $baseline1StartDate = date('Y-m-d',strtotime('2017-04-01'));
                $baseline1EndDate = date('Y-m-d',strtotime('2018-03-31'));

                $target1Name = "Target 2018-19";
                $target1StartDate = date('Y-m-d',strtotime('2018-04-01'));
                $target1EndDate = date('Y-m-d',strtotime('2019-03-31'));

                $target2Name = "Target 2019-20";
                $target2StartDate = date('Y-m-d',strtotime('2019-04-01'));
                $target2EndDate = date('Y-m-d',strtotime('2020-03-31'));
                $allOneEntries = array();
                $newResult =$results;
                
                //print_r($results);die();
                $countTotal = count($results);
                for($i=1;$i<$countTotal;$i++){
                  $status = 0;
                    $oneEntry = $results[$i];
                    // print_r($oneEntry[6]);
                    array_push($allOneEntries, $oneEntry);
                    if(is_array($oneEntry)){
                      //echo count($oneEntry);die();
                        if(count($oneEntry)>=14 ) {
                            $str = $oneEntry[1];
                            $objName = $oneEntry[2];
                            $indName = $oneEntry[3];
                            $outcomeIndName= '';
                            if($oneEntry[8] != null){
                                $outcomeIndName = $oneEntry[8];
                            }
                           
                            //print_r($indName);die();
                            if($str != null){
                                $scheme = new Scheme;
                                $SchemeName = strtok($str, "\n");
                                $scheme->name = $SchemeName;
                                $scheme->unit_id=$unitId;
                                $scheme->save();
                            }
                            if($objName != null){
                                $objective = $scheme->objectives()->create([
                                    'description'=>$objName
                                ]);
                                $output = $objective->outputs()->create([
                                    'name'=>'output_1',
                                    'scheme_id'=>$scheme->id
                                ]);
                                $outcome = $output->outcomes()->create([
                                  'name'=>'outcome_1'
                                ]);
                            }

                            if($indName != null && $indName != ''){
                                if($oneEntry[6] == 'NA' || $oneEntry[6] == 'na' || $oneEntry[6] == 'NIL'){
                                  // || $oneEntry[6] == 'NIL'
                                      $status = 1;
                                      //continue;
                                  }
                                  elseif($oneEntry[6] == 'NR' || $oneEntry[6] == 'nr'){
                                      $status = 4;
                                      //continue;
                                  }else{
                                      $status = 0;
                                  }
                                $indicator =  $output->outputIndicators()->create([
                                    'name'=>$indName,
                                    'status'=>$status,
                                    'remark'=>$oneEntry[13]
                                ]);
                                $output_indicator_id = $indicator->id;
                                if($oneEntry[4] != null && $oneEntry[4] != ''){
                                    $baseline = $indicator->baselines()->create([
                                        'name'=>$baseline1Name,
                                        'value'=>$oneEntry[4],
                                        'start_date'=>$baseline1StartDate,
                                        'end_date'=>$baseline1EndDate
                                    ]);
                                }
                                if($oneEntry[5] != null && $oneEntry[5] != ''){
                                    $target = $indicator->outputTargets()->create([
                                        'name'=>$target1Name,
                                        'value'=>$oneEntry[5],
                                        'start_date'=>$target1StartDate,
                                        'end_date'=>$target1EndDate
                                    ]);
                                    if($oneEntry[6] != null && $oneEntry[6] != ''){
                                        
                                        $target->achievements()->create([
                                            'description'=>$oneEntry[6],
                                            'start_date'=>$target1StartDate,
                                            'end_date'=>$target1EndDate
                                        ]);
                                    }
                                }
                                if($oneEntry[7] != null && $oneEntry[7] != ''){
                                    $target = $indicator->outputTargets()->create([
                                        'name'=>$target2Name,
                                        'value'=>$oneEntry[7],
                                        'start_date'=>$target2StartDate,
                                        'end_date'=>$target2EndDate
                                    ]);
                                }
                            }
                            if($outcomeIndName != null && $outcomeIndName != ''){
                                if($oneEntry[11] == 'NA' || $oneEntry[11] == 'na' || $oneEntry[11] == 'NIL'){
                                    $status = 1;
                                    //continue;
                                }
                                elseif($oneEntry[11] == 'NR' || $oneEntry[11] == 'nr'){
                                    $status = 4;
                                    //continue;
                                }
                                else{
                                      $status = 0;
                                  }
                                $indicator =  $outcome->outcomeIndicators()->create([
                                    'name'=>$outcomeIndName,
                                    'output_indicator_id'=>$output_indicator_id,
                                    'status'=>$status,
                                    'remark'=>$oneEntry[13]
                                ]);

                                $baseline = $indicator->outcomeBaselines()->create([
                                    'name'=>$baseline1Name,
                                    'value'=>$oneEntry[9],
                                    'start_date'=>$baseline1StartDate,
                                    'end_date'=>$baseline1EndDate
                                ]);
                                $target = $indicator->outcomeTargets()->create([
                                    'name'=>$target1Name,
                                    'value'=>$oneEntry[10],
                                    'start_date'=>$target1StartDate,
                                    'end_date'=>$target1EndDate
                                ]);
                                if($oneEntry[11] != null && $oneEntry[11] != ''){
                                  
                                    $target->outcomeAchievements()->create([
                                        'description'=>$oneEntry[11],
                                        'start_date'=>$target1StartDate,
                                        'end_date'=>$target1EndDate
                                    ]);
                                }
                                $target = $indicator->outcomeTargets()->create([
                                    'name'=>$target2Name,
                                    'value'=>$oneEntry[12],
                                    'start_date'=>$target2StartDate,
                                    'end_date'=>$target2EndDate
                                ]);
                            }
                        }
                    } 
                }
            }
            catch (\Exception $e) {
                return $e;
            }
        }
        return response()->json(['results'=>$results,'oneEntry'=>$allOneEntries]);
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $units = Unit::all();
        $departments = Department::all();
        $errorMsg = '' ;
         if(isset($request->errorMsg)){
            $errorMsg = $request->errorMsg;
         }
        return view('scheme.create', compact('units','departments','errorMsg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //print_r($request->input()); die;

        $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
            'scheme_name'=>'required|max:191|unique:schemes,name',
            'unit_id' => 'required',
            'account_head'=>'required',
            'demand_no'=>'required',
            'mon_type' =>'required',
            'code'=>'required',
            'scheme_type'=>'required',
            'tag'=>'required',
        ]);

        $latitude ='';
          $longitude ='';
          $isCapital=0;
          ;
        $capital_check = request()->get('capital-check');
        if(isset($capital_check)){
          $isCapital =1;
          $latitude =request()->get('latitude');

          $longitude =request()->get('longitude');
        } 
         

        $scheme_type = request()->get('scheme_type');
        if($scheme_type == 1){
            $state_share = 100;
            $central_share = 0;
        }
        else{

            $state_share = request()->get('state_share');
            $central_share = request()->get('central_share');
        }
        $unitId = request()->get('unit_id');
        if($unitId != 0){
        $unit = Unit::find(request()->get('unit_id'));

    }else{
        $department_id = request()->get('department_id');
        $department = Department::find($department_id);
        $unit = $department->units()->where('is_default',1)->first();
    }
        $remarks =request()->get('remarks');
        if(!isset($remarks)){
            $remarks='';
        }
        $scheme = $unit->schemes()->create([
            'sno' => request()->get('sno'),
            'name' => request()->get('scheme_name'),
            'code' => request()->get('code'),
            'account_head' => request()->get('account_head'),
            'demand_no' => request()->get('demand_no'),
            'remarks' =>$remarks ,
            'start_date' => date('Y-m-d',strtotime(request()->get('start_date'))),
            'end_date' => date('Y-m-d',strtotime(request()->get('end_date'))),
            'scheme_monitoring_type_ids' => json_encode(request()->get('mon_type')),
            'tag_ids' => json_encode(request()->get('tag')),
            'is_capital'=>$isCapital,
            'latitude'=>$latitude,
            'longitude'=>$longitude
            

        ]);
        $scheme->type()->create([
            'type_variety_id'=>request()->get('scheme_type'),
            'state_share'=>$state_share,
            'central_share'=>$central_share
        ]);

        // require '/vendor/autoload.php';
        $department_id = request()->get('department_id');
        $users = DB::table('users')
                    ->where('department_id', $department_id)
                    ->get();
        $superusers = User::role('super-admin')->get(); 
        $message = '<a href="scheme_dashboard.html?scheme_id='.$scheme->id.'"><p class="notif-title"><b>New Scheme: </b>'.$scheme->name.' Created</p><p class="notif-time">'.date('d M, Y').' at '.date('h:i a').'</p></a>';
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
        $message['text'] = '<a href="scheme_dashboard.html?scheme_id='.$scheme->id.'"><p class="notif-title"><b>New Scheme: </b>'.$scheme->name.' Created</p><p class="notif-time">'.date('d M, Y').' at '.date('h:i a').'</p></a>';
        foreach ($intended_users_arr as $key => $value) {
          # code...
          event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$value, $message));
        }
       


        return response()->json(['success'=>'true','scheme'=>$scheme]);

        // return redirect()->route('scheme.index')->with('success','Scheme added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function show(Scheme $scheme)
    {
        $output = $scheme->output()->first();
        $outputIndicators = $output->outputIndicators()->get();
        $outcome = $scheme->outcome()->first();
        $outcomeIndicators = $outcome->outcomeIndicators()->get();
        return view('scheme.show', compact('scheme','output','outcome','outputIndicators','outcomeIndicators'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scheme = Scheme::find($id);

        $result = array();
        $others = array();

        $unit= $scheme->unit()->first();
        $department = $unit->department()->first();
        $subsector = $department->subsector()->first();
        $sector = $subsector->sector()->first();
        $result['sector_id']=$sector->id;
         $result['subsectors']=$sector->subsectors()->where('is_default',0)->get();
         $result['departments']=$subsector->departments()->get();

        $result['units']=$department->units()->where('is_default',0)->get();

        if($subsector->is_default == 1){
             $result['subsector_id']=0;
        }else{
             $result['subsector_id']=$subsector->id;

        }
        $result['department_id']=$department->id;
         if($unit->is_default == 1){
             $result['unit_id']=0;
        }else{
             $result['unit_id']=$unit->id;

        }

        $type =$scheme->type()->first();
        // echo $type; die;
        $result['code']= $scheme->code; 
        $result['start_date']=date('Y-m-d',strtotime($scheme->start_date));
        $result['end_date']=date('Y-m-d',strtotime($scheme->end_date));
        
        //$others['montype']=$scheme->scheme_monitoring_type_ids;
        //$others['tags']=$scheme->tag_ids;
        //$others['tag[]']=$scheme->tag_ids;
        $result['sno']=$scheme->sno;
        $result['account_head']=$scheme->account_head;
        $result['demand_no']=$scheme->demand_no;
        $result['scheme_name']=$scheme->name;
        $result['scheme_type']=(!empty($type))?$type->type_variety_id:"";
        $result['remarks']=$scheme->remarks;
        $result['state_share']=(!empty($type))?$type->state_share:"";
        $result['central_share']=(!empty($type))?$type->central_share:"";
        $result['is_capital']=$scheme->is_capital;
        $result['latitude']=$scheme->latitude;
        $result['longitude']=$scheme->longitude;
        $mon_type_ids = json_decode($scheme->scheme_monitoring_type_ids);
        $tag_ids = json_decode($scheme->tag_ids);
        $mon_type_arr = json_decode($scheme->scheme_monitoring_type_ids, TRUE);
        $tag_arr = json_decode($scheme->tag_ids, TRUE);
        if(!empty($mon_type_arr)){
            $mon_types_list = DB::table('scheme_monitoring_types')
                                ->whereIN('id', $mon_type_arr)
                                ->get();
            $mon_type_names = array();
            foreach($mon_types_list as $key=>$value){
              array_push($mon_type_names, $value->abbreviation);
            }

            $mon_type_names = implode(',', $mon_type_names);
        }
        else{
          $mon_type_names = '-';
        }

        if(!empty($tag_arr)){
            $tag_list = DB::table('tags')
                                ->whereIN('id', $tag_arr)
                                ->get();
            $tag_list_names = array();
            foreach($tag_list as $key=>$value){
              array_push($tag_list_names, $value->tag_name);
            }

            $tag_list_names = implode(',', $tag_list_names);
        }
        else{
          $tag_list_names = '-';
        }

        $monTypes =array();
        $tags =array();

        if(isset($mon_type_ids) && count($mon_type_ids)>0){
          foreach ($mon_type_ids as $key => $val) {
           // $real_val = str_replace('\"', '', $val);
            $real_val = (int) $val;
           array_push($monTypes, $real_val);
            }
        }
        if(isset($tag_ids) && count($tag_ids)>0){
          foreach ($tag_ids as $key => $val) {
           $real_val = str_replace('\"', '', $val);
           array_push($tags, $real_val);
        }
        }
        


        $result['mon_types']=$monTypes;
        $result['tags']=$tags;
        $result['mon_type_names'] = $mon_type_names;
        $result['tag_list_names'] = $tag_list_names;

        return response()->json(['success'=>'true','scheme'=>$result,'others'=>$others]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       //print_r($request->input()); die;

        $this->validate($request, [
            /*'unit_id' => 'required|exists:units,id',*/
            'scheme_name'=>'required|max:191',
            'unit_id' => 'required'
        ]);

        $latitude ='';
          $longitude ='';
          $isCapital=0;
          ;
        $capital_check = request()->get('capital-check');
        if(isset($capital_check)){
          $isCapital =1;
          $latitude =request()->get('latitude');

          $longitude =request()->get('longitude');
        } 
         

        $scheme_type = request()->get('scheme_type');
        if($scheme_type == 1){
            $state_share = 100;
            $central_share = 0;
        }
        else{
            $state_share = request()->get('state_share');
            $central_share = request()->get('central_share');
        }
        $unitId = request()->get('unit_id');
        if($unitId != 0){
        $unit = Unit::find(request()->get('unit_id'));

    }else{
        $department_id = request()->get('department_id');
        $department = Department::find($department_id);
        $unit = $department->units()->where('is_default',1)->first();
    }
        $remarks =request()->get('remarks');
        if(!isset($remarks)){
            $remarks='';
        }
        $scheme = Scheme::find($id);
        $scheme->sno = request()->get('sno');
        $scheme->name = request()->get('scheme_name');
        if(!empty(request()->get('code'))){
            $scheme->code = request()->get('code');
        }
        if(!empty(request()->get('account_head'))){
            $scheme->account_head = request()->get('account_head');
        }
        if(!empty(request()->get('demand_no'))){
            $scheme->demand_no = request()->get('demand_no');
        }
        $scheme->remarks = $remarks;
        $scheme->unit_id = $unit->id;
        if(!empty(request()->get('start_date'))) {
            $scheme->start_date = date('Y-m-d',strtotime(request()->get('start_date')));
        }
        if(!empty(request()->get('end_date'))){
            $scheme->end_date = date('Y-m-d',strtotime(request()->get('end_date')));
        }
        if(!empty(request()->get('mon_type'))){
            $scheme->scheme_monitoring_type_ids = json_encode(request()->get('mon_type'));
        }
        if(!empty(request()->get('tag'))){
            $scheme->tag_ids = json_encode(request()->get('tag'));
        }
        $scheme->is_capital = $isCapital;
        if($scheme->is_capital){
            $scheme->latitude = $latitude;
            $scheme->longitude = $longitude;
        }
        $scheme->save();
        // Scheme::find($id)->update([
        //     'sno' => request()->get('sno'),
        //     'name' => request()->get('scheme_name'),
        //     'code' => (isset(request()->get('code')))?request()->get('code'):"",
        //     'account_head' => (isset(request()->get('account_head')))?request()->get('account_head'):"",
        //     'demand_no' => (isset(request()->get('demand_no')))?request()->get('demand_no'):"",
        //     'remarks' =>$remarks ,
        //     'unit_id' => $unit->id,
        //     'start_date' => (isset(request()->get('start_date')))?date('Y-m-d',strtotime(request()->get('start_date'))):"",
        //     'end_date' => (isset(request()->get('end_date')))?date('Y-m-d',strtotime(request()->get('end_date'))):"",
        //     'scheme_monitoring_type_ids' => (isset(request()->get('mon_type')))?json_encode(request()->get('mon_type')):"",,
        //     'tag_ids' => (isset(request()->get('tag')))?json_encode(request()->get('tag')):"",
        //     'is_capital'=>$isCapital,
        //     'latitude'=>$latitude,
        //     'longitude'=>$longitude
        // ]);
        $scheme =  Scheme::find($id)->first();
        $type =  $scheme->type()->first();
        if (!empty(request()->get('scheme_type'))) {
            if(isset( $type->type_variety_id)) {
                $type->update([
                'type_variety_id'=>request()->get('scheme_type'),
                'state_share'=>$state_share,
                'central_share'=>$central_share
            ]);
            }else{
                 $scheme->type()->create([
                'type_variety_id'=>request()->get('scheme_type'),
                'state_share'=>$state_share,
                'central_share'=>$central_share
            ]);
          }
        }

         


        return response()->json(['success'=>'true','scheme'=>$scheme]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Scheme  $scheme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scheme $scheme)
    {
        $scheme->delete();
        return redirect()->route('scheme.index')
            ->with('success',
             'Scheme deleted successfully!');
    }

    public function getSchemeForUnit(Request $request)
    {
        $unit_id= $request->input('unit_id');
        $depart_id =$request->input('department_id');
        if($unit_id == 0 ){
            $depart = Department::find($depart_id);
            $unit = $depart->units()->where('is_default',1)->first();
        }else{
        $unit = Unit::find($unit_id);
        }
        $schemes = $unit->schemes()->orderBy('name', 'asc')->get();
       return response()->json(['schemes'=>$schemes]);

    }


    public function compareSchemes(Request $request)
    {
      # code...
      $scheme_ids = $request->input('scheme_ids');
      $schemes = Scheme::whereIN('id', $scheme_ids)->get();
      $final_arr = array();
      $current_month = date('m');
      $current_year = date('Y');
      $current_month_exp =0;
      if($current_month <4){
        $est_end_year = date('Y');
        $current_year = date('Y', strtotime('-1 year'));
      }else{
        $est_end_year = date('Y', strtotime('+1 year'));
      }
      $i=0;
      foreach ($schemes as $key => $scheme) {
        # code...
        $totalInd = 0;
        $totalIndOn = 0;
        $totalEst = 0;
        $totalExp = 0;
        $final_arr[$key]['scheme_id'] = $scheme->id;
        $final_arr[$key]['scheme_name'] = $scheme->name;
        $final_arr[$key]['code'] = $scheme->code;
        $final_arr[$key]['start_date'] = $scheme->start_date;
        $final_arr[$key]['end_date'] = $scheme->end_date;
        $objectives = $scheme->objectives()->get();
        foreach ($objectives as $key1 => $objective){
          # code...
          $outputs = $objective->outputs()->get();
          foreach ($outputs as $key2 => $output){
            # code...
            $totalInd = $totalInd + count($output->outputIndicators()->get());
            $totalIndOn = $totalIndOn + count($output->outputIndicators()->where('status', 2)->get());
            $outcomes = $output->outcomes()->get();
            foreach($outcomes as $key3=>$outcome){
              $totalInd = $totalInd + count($outcome->outcomeIndicators()->get());
              $totalIndOn = $totalIndOn + count($outcome->outcomeIndicators()->where('status', 2)->get());
            }
          }
        }
        $estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
        if(!empty($estimate)){
          $revisedEstimate = $estimate->revisedEstimates()->get();
            if(count($revisedEstimate)){
            // print_r($revisedEstimate);
            foreach ($revisedEstimate as $re) {
              $totalEst += $re->revenue + $re->capital + $re->loan;
            }
          }
          else{
            $budgetEstimate = $estimate->budgetEstimates()->get();
            if(count($budgetEstimate)){
              foreach ($budgetEstimate as $be) {
                $totalEst += $be->revenue + $be->capital + $be->loan;
              }
            }
          }
        }
        $expenditures = $scheme->expenditures()->get();
        foreach ($expenditures as $exp) {
          $year_exp =  explode('-',$exp->exp_year);
                      // print_r($year_exp);
          $concerned_year = $year_exp[1];
          $concerned_month =  $year_exp[0];
          if($current_year == $concerned_year){
            $totalExp += $exp->revenue + $exp->capital + $exp->loan;
          }
        }
        $final_arr[$key]['totalInd'] = $totalInd;
        $final_arr[$key]['totalIndOn'] = $totalIndOn;
        $final_arr[$key]['totalEst'] = $totalEst;
        $final_arr[$key]['totalExp'] = $totalExp;
      }
      // print_r($final_arr);
      $data['schemes'] = $final_arr;
      return view('compare_table', $data);
    }

    
    public function delScheme(Request $request)
    {


      $scheme_id  = $request->input('scheme_id');
     $scheme =  Scheme::find($scheme_id);
     if(isset($scheme->name)){
          $objectives = $scheme->objectives()->get();

            if(count($objectives)>0){
                  return response()->json(['deleted'=>'false']);

            }else{
              $scheme->delete();
            }
     }else{
        return response()->json(['deleted'=>'false']);

     }
      return response()->json(['deleted'=>'true']);
    }
    
}


