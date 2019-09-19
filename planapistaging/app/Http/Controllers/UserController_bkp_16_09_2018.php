<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Role;
use App\Department;
use Auth;
use DB;
use App\OutcomeActionpoint;
use App\Actionpoint;
use App\ActionUser;
use App\Notification;
use App\ActionPointRemark;
use App\OutputTarget;
use App\OutcomeTarget;
use App\Achievement;
use App\OutcomeAchievement;
use App\Outputindicator;
use App\Outcomeindicator;
use Crypt;
use Mail;
use Illuminate\Support\Facades\Hash;
use Cookie;
use Spatie\Activitylog\Models\Activity;

class UserController extends Controller
{
	public $successStatus = 200;
     public function user($id)
    {
        $user = User::find($id);
        return response()->json(['users'=>$user]);
    }

    public function userProfile()
    {
        $user = Auth::user(); 
        return response()->json(['name'=>$user->name,'email'=>$user->email]);
    }
     public function updateProfile(Request $request)
    {
        $user = Auth::user(); 
         $new_username= $this->decodeString( $request->input('new_username'));

         $user->name = $new_username;
         $user->update();
        return response()->json(['name'=>$new_username]);
    }

    public function checkAccessForPage(Request $request)
    {
        # code...
        $page_name = $request->input('page');
        $page_access = $this->getAccessResult($page_name);
        if($page_access){
            return response()->json(['Page Access allowed'], 200);
        }
        else{
            $user_id = Auth::user()->id;
            DB::table('oauth_access_tokens')
                ->where('user_id', $user_id)
                ->delete();
            $accessToken = Auth::user()->token();
            $accessToken->revoke();
            return response()->json(['No allowed to access this page'], 401);
        }
    }
    

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function apiLogin(Request $request){ 
      // $k = $request->input('k');

        $captcha = $request->input('captcha');
        $sessiondigit = $_SESSION['digit'];
        

        $guest_enc = $request->input('guest');
        $guest = $this->decodeString($guest_enc);
        // echo $guest; die;
        if($guest && $guest == 1){
            $email = "guest@user.com";
            //$password = "september6";
            $password = "Password@123";
        }
        else{
            if($captcha == $sessiondigit){
            $email_enc = $request->input('email');
            $pw_enc = $request->input('password');
            $email = $this->decodeString($email_enc);
            $password = $this->decodeString($pw_enc);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 403);
        }
       
    }
        
        if(Auth::attempt(['email' => $email, 'password' => $password])){ 
            $user = Auth::user(); 
            $success = array();
            $token =  $user->createToken('MyApp')->accessToken; 
            $success['token'] = $token;
            // Cookie::queue('planning_sess_pass', $token, 30);
            // Cookie::queue($name, $value, $minutes);
            // Cookie::queue($name, $value, $minutes);
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function setFinYear(Request $request)
    {
        # code...
        // print_r($request->all());
        session(['finYear' => $request->input('finYear')]);
        // echo session('finYear');
        return response()->json(['success'=>'success']);
    }


    public function refToken()
    {
        # code...
        DB::table('oauth_access_tokens')
        ->where('user_id', Auth()->user()->id)
        ->update([
            'revoked' => 1
        ]);
        DB::table('oauth_access_tokens')
            ->where([
                ['user_id', Auth()->user()->id],
                ['revoked', 1]
            ])
            ->delete();
        // $accessToken = Auth::user()->token();
        // $accessToken->revoke();

        $user = Auth::user(); 
        $success = array();
        $token =  $user->createToken('MyApp')->accessToken; 
        // $success['token'] = $token;
        // Cookie::queue('planning_sess_pass', $token, 30);
        // Cookie::queue($name, $value, $minutes);
        // Cookie::queue($name, $value, $minutes);
        return $token;
    }

    public function get_current_user_dets()
    {
      # code...
      $user['id'] = Auth::user()->id;
      return response()->json(['user' => $user]);
    }
    public function logout(){
        $user_id = Auth::user()->id;
        // Auth::logout();
        // $token = $_POST['token'];
        // $user = DB::table('oauth_access_tokens')
        //             ->where('id', '=', $token)
        //             ->first();
        // $user = Auth::user(); 
        // DB::table('oauth_access_tokens')
        //     ->where('user_id', $user_id)
        //     ->delete();
        $accessToken = Auth::user()->token();
        $accessToken->revoke();
        return response()->json(null, 200);
    }
    
     public function userslist()
    {
        $cuser = Auth::user(); 
        $croles = $cuser->getRoleNames();
        foreach ($croles as $crole) {
                if($crole =='super-admin'){
                    $users = User::all();
                }
                else if($crole == 'hod' || $crole == 'department-admin'){
                    $users = User::role(['public-viewer','department-user'])->get();
                    //array_push($users, User::role('public-viewer')->get());
                }else{
                    $users= array();
                }
        }
         $result = array();
        foreach ($users as $user) {
                $role = $user->getRoleNames()->first();

                $rolewithid = $user->roles->first();

             $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editUserModal" data-name="' . $user->name . '" data-id="'.$user->id.'" data-dept="'.$rolewithid->id.'" >Edit</a></li>
                                    <li><a class="delete" data-id="'.$user->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';
                 
                array_push($result, [
                    $user->name,
                    $user->email,
                    $role,
                    $actionBtn
                ]);
        }
         return response()->json(['users'=>$result]);
        
        //return view('sector.index', compact('sectors'));
    }
     public function update(Request $request,$id)
    {
        
        $user = User::find($id);
        if(!isset($user)){
        return response()->json(['saved'=>'false','user'=>$user]);

        }else{
             $user->name = $request->get('username');
             echo $user->name; exit;

             $role = Role::find($request->get('usertype-select'));
              $user->roles()->detach(); 
              $user->assignRole($role->name);
              if($role->name == 'public-viewer'){
                $user->department_id = null;
              }

        $user->update();
        return response()->json(['saved'=>'true','rolename'=>$role->name]);

        }

       
       /* return redirect()->route('sector.index')
            ->with('success',
             'sector'. $sector->name.' updated!');*/
    }

    public function currentUserRoles() {
        $user = Auth::user(); 
        $roles = $user->getRoleNames();
        $depart = $user->department_id;
        $department = Department::find($depart);
        return response()->json(['roles'=>$roles,'depart'=>$department]);
    }

    public function getusertypes() {
        $user = Auth::user(); 
        $roles = $user->getRoleNames();
        //var_dump($roles);die;
        $returnRoles = array();
        foreach ($roles as $role) {
                if($role =='super-admin'){
                    array_push($returnRoles, Role::all());
                }
                else if($role == 'hod'){
                    array_push($returnRoles, Role::where('name','department-admin')->get());
                }else if($role == 'department-admin'){
                    array_push($returnRoles, Role::where('name','department-user')->get());
                    array_push($returnRoles, Role::where('name','department-viewer')->get());

                }
        }
        return response()->json(['types'=>$returnRoles]);
    }

     public function getCurrentuserRole() {
        $user = Auth::user(); 
        $user_id = $user->id;
        $user_role_id = DB::table('model_has_roles')
                            ->where('model_id', $user_id)
                            ->first();
        if($user_role_id->role_id == 4){
            $role_name = 'super-admin';
        }
        else if($user_role_id->role_id == 6){
            $role_name = 'department-admin';
        }
        else if($user_role_id->role_id == 5){
            $role_name = 'hod';
        }
        else if($user_role_id->role_id == 7){
            $role_name = 'department-user';
        }
        else if($user_role_id->role_id == 8){
            $role_name = 'gnctd-viewer';
        }
        else if($user_role_id->role_id == 9){
            $role_name = 'department-viewer';
        }
        else if($user_role_id->role_id == 10){
            $role_name = 'public-viewer';
        }
        $roles = $user->getRoleNames();
        $depart_id = $user->department_id;
        $dept = '';
        if($depart_id != null && $depart_id != '' && $depart_id != 0){
            $dept = Department::find($depart_id);
        }
        
        //var_dump($roles);die;
        $returnRole = 'none';
        foreach ($roles as $role) {
                $returnRole = $role;
        }

        return response()->json(['myrole'=>$returnRole, 'role_name'=>$role_name, 'depart'=>$dept, 'user' => $user]);

    }

    public function assigntolist()
    {

        $currentuser = Auth::user(); 
        $currentroles = $currentuser->getRoleNames();
        $returnUsers = array();
        $moreUsers = array();


        foreach ($currentroles as $role1) {
                if($role1 == 'super-admin'){
                   $returnUsers = User::role('department-admin')->get();
                   $moreUsers =User::role('hod')->get();

                   
                }else if($role1 == 'hod'){
                   $returnUsers = User::role('department-admin')->get();
                   $moreUsers =User::role('department-user')->get();
                   //$dview = User::role('department-viewer')->get();
                }
                else if($role1 == 'department-admin'){
                   $returnUsers = User::role('gnctd-viewer')->get();
                   $moreUsers =User::role('public-viewer')->get();
                   //$dview = User::role('department-viewer')->get();
                }
        }
       /* $users = User::all();
        $returnUsers = array();
        foreach ($users as $user) {
                $roles = $user->getRoleNames();
                
                foreach ($roles as $role) {
                         if($role == 'department-admin'){
                            array_push($returnUsers, $user);
                            break;
                        }
                }
        }*/
       return response()->json(['users'=>$returnUsers,'moreUsers'=>$moreUsers]);
        
    }

     public function deptAssigntolist(){
    // {
    //     $users = User::all();
    //     $returnUsers = array();
    //     foreach ($users as $user) {
    //             $roles = $user->getRoleNames();
                
    //             foreach ($roles as $role) {
    //                      if($role == 'hod'){
    //                         array_push($returnUsers, $user);
    //                         break;
    //                     }
    //             }
    //     }


        $currentuser = Auth::user(); 
        $currentroles = $currentuser->getRoleNames();
        $returnUsers = array();
        $moreUsers = array();


        foreach ($currentroles as $role1) {
                if($role1 == 'super-admin'){
                   $returnUsers = User::role('department-admin')->get();
                   $moreUsers =User::role('hod')->get();

                   
                }else if($role1 == 'department-admin'){
                   $returnUsers = User::role('department-user')->get();
                   $moreUsers =User::role('department-viewer')->get();
                   //$dview = User::role('department-viewer')->get();
                }
                
        }
       return response()->json(['users'=>$returnUsers,'moreUsers'=>$moreUsers]);

       //return response()->json(['users'=>$returnUsers]);
        
    }
    
     public function destroy($id)
    {
        $user = User::find($id);
        
        if(!isset($user) && $user !=null){
         return response()->json(['deleted'=>'false']);

        }else{
            $user->delete();
            return response()->json(['deleted'=>'true']);
        }
    }

      public function getactionremarks(Request $request)
    {
            $type = $request->input('type');
            $action_id = $request->input('action');
            if($type == "output"){
                $action = Actionpoint::find($action_id);
            }else if($type == "outcome"){
                $action = OutcomeActionpoint::find($action_id);
            }
            $remarksResult =array();
            if(isset($action->description)){
                    $remarks = $action->actionRemarks()->get();
                    foreach ($remarks as $remark) {
                        $user = User::find($remark->user_id);
                        array_push($remarksResult, [
                            $remark->description,
                            $user->name
                        ]);
                    }
            }
            return response()->json(['sectors'=>$remarksResult]);

        
    }

    public function assignActionSubmit(Request $request)
    {
      //{"requestAll":{"id":"12","indicator_type":"output","assigned_to":"2"}}
        $requestAll = $request->all();
        $indicator_type = $request->input('indicator_type');
        $assigned_to = $request->input('assigned_to');
        $id = $request->input('id');
        $message = '' ;
        if($indicator_type != null && $assigned_to != null && $id !=null){

            if($indicator_type == 'output'){
                $actionPoint = Actionpoint::find($id);
            }else if($indicator_type == 'outcome'){
                $actionPoint = OutcomeActionpoint::find($id);
            }else{
                $message = "Indicator type not recognised";
                return response()->json(['success'=>'false','message'=>$message]);

            }
            if(isset($actionPoint->description)){
                ActionUser::create([
                  'user_id'=>$assigned_to,
                  'action_type'=>$indicator_type,
                  'actionpoint_id'=>$id
                ]);

            $intended_users=array();
            $message = '<li><a href="">New Action Point Assigned: <b>'.$actionPoint->description.'</b></a></li>';
            $read_by =array();
            array_push($intended_users, $id);
            event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$id.'', $message));
             Notification::create([
                'message'=>$message,
                'intended_for'=>json_encode($intended_users),
                'read_by'=>json_encode($read_by)
            ]);
            }else{
                $message = "Action Point not found";
                return response()->json(['success'=>'false','message'=>$message]);
                
            }
            return response()->json(['success'=>'true','message'=>$message]);

        }else{
             return response()->json(['success'=>'false','message'=>$message]);
        }


    }

    public function assignedActions()
    {

      $user =Auth::user();
        //$sectors = Sector::all();
      $actions = ActionUser::where('user_id',$user->id)->get();
         $result = array();

        foreach ($actions as $action) {
            $type=$action->action_type;
            if($type == 'output'){
                $actionPoint = ActionPoint::find($action->actionpoint_id);
                $review = $actionPoint->review()->first();
                $achievement =  Achievement::find($review->achievement_id);
                $target = OutputTarget::find($achievement->outputtarget_id);
               $indicator = Outputindicator::find($target->outputindicator_id);
                
                

            }else{
                $actionPoint = OutcomeActionpoint::find($action->actionpoint_id);
                $review = $actionPoint->review()->first();
                $achievement =  OutcomeAchievement::find($review->outcome_achievement_id);
                $target = OutcomeTarget::find($achievement->outcometarget_id);
                $indicator =Outcomeindicator::find($target->outcomeindicator_id);

                
                
            }

            

             $actionBtn = '<a class="btn btn-sm btn-primary addremark" data-toggle="modal"
                                    data-target="#addRemarkModal" data-type="'.$type.'" data-id="'.$actionPoint->id.'">
                                                                <span class="text" >Remark</span>
                                                            </a>';

                $actionRemarks = ActionPointRemark::where('actionpoint_id',$actionPoint->id)->get();
                $allRemarks =array();
                foreach ($actionRemarks as $remark) {
                    array_push($allRemarks,$remark->description);
                }
                array_push($result, [
                    $indicator->name,
                    $actionPoint->description,
                    implode(',', $allRemarks),
                    $actionBtn
                ]);
            }
        
         return response()->json(['sectors'=>$result]);
        
        //return view('sector.index', compact('sectors'));
    }
    public function addUserRemark(Request $request){
      $this->validate($request, [
            'ind_type'=>'required',
            'id'=>'required',
            'description'=>'required',

        ]);
        $user =Auth::user();

        $type = $request->input('ind_type');
        $id = $request->input('id');
        $description = $request->input('description');
        if($type == 'output'){
                $actionPoint = ActionPoint::find($id);

            }else{
                $actionPoint = OutcomeActionpoint::find($id);
                
            }

          $actionPoint->actionRemarks()->create([
              'description'=>$description,
              'user_id'=>$user->id
          ]);

            

         return response()->json(['success'=>'true']);

    }


        public function updateActionPointsStatus(Request $request){
     
        $user =Auth::user();

        $actionPoints = ActionPoint::all(); 
        $outcomeActionPoints = OutcomeActionpoint::all();

        foreach ($actionPoints as $action) {
          $onTrack = 'false';
            $remarks = $action->actionRemarks()->get();
            $start_date = $action->start_date;
            $end_date = $action->end_date;
            if($start_date == null || $end_date== null){
                    $onTrack = 'na';
            }else{
              foreach ($remarks as $remark) {
                $remark_date = $remark->created_at;
                if($remark_date < $end_date){
                    $onTrack = 'true';
                    break;
                }
              }
            }
            

            if(count($remarks) > 0){
                if($onTrack == 'true'){
                    $action->status_id = 2;
                }else if($onTrack == 'false'){
                    $action->status_id = 3;
                }
            }else{
                    $action->status_id = 4;
            }
            if($onTrack == 'na'){
                    $action->status_id = 1;
            }
            $action->update();

        }

        foreach ($outcomeActionPoints as $action) {
          $onTrack = 'false';
            $remarks = $action->actionRemarks()->get();
            $start_date = $action->start_date;
            $end_date = $action->end_date;
            if($start_date == null || $end_date== null){
                    $onTrack = 'na';
            }else{
              foreach ($remarks as $remark) {
                $remark_date = $remark->created_at;
                if($remark_date < $end_date){
                    $onTrack = 'true';
                    break;
                }
              }
            }
            

            if(count($remarks) > 0){
                if($onTrack == 'true'){
                    $action->status_id = 2;
                }else if($onTrack == 'false'){
                    $action->status_id = 3;
                }
            }else{
                    $action->status_id = 4;
            }
            if($onTrack == 'na'){
                    $action->status_id = 1;
            }
            $action->update();

        }
         return response()->json(['success'=>'true']);

    }
    

    public function change_password(Request $request){
        
        $password = $this->decodeString($request->input('password'));
        $user_password = $this->decodeString($request->input('user_password'));
        $this->validate($request, [
            'user_password'=>'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);


        $user = Auth::user();
        $hashedPass = $user->password;
        $errMsg = '';
        if (Hash::check($user_password, $hashedPass)) {
            $user->password = Hash::make($password);
            $user->update();
            return response()->json(['success'=>'true','errorMsg'=>$errMsg],200);
        }
        else{
              $errMsg = 'User password Incorrect';  
              return response()->json(['success'=>'false','errorMsg'=>$errMsg],403);

        }




    }

    /**
     * Encodes or decodes string according to key
     * 
     * @access public
     * @param mixed $str
     * @param mixed $decodeKey
     * @return string
     */
     
    public function decodeString($str) {

        $str_arr = explode('.*$%', $str);
        $result = "";
        foreach ($str_arr as $key => $value){
            #code...
            $result .= chr($value);
        }
        // for($i=0;$i < strlen($str);$i++) {
        //     $a = $this->_getCharcode($str,$i);
        //     $b = $a ^ $decodeKey;
        //     $result .= $this->_fromCharCode($b);
        // }
        return $result;
    }

    /**
     * PHP replacement for JavaScript charCodeAt.
     * 
     * @access private
     * @param mixed $str
     * @param mixed $i
     * @return string
     */
    public function _getCharcode($str,$i) {
         return $this->_uniord(substr($str, $i, 1));
    }

    /**
     * Gets character from code.
     * 
     * @access public
     * @return string
     */
    public function _fromCharCode(){
      $output = '';
      $chars = func_get_args();
      foreach($chars as $char){
        $output .= chr((int) $char);
      }
      return $output;
    }


    /**
     * Multi byte ord function.
     * 
     * @access public
     * @param mixed $c
     * @return mixed
     */
    public function _uniord($c) {
        $h = ord($c{0});
        if ($h <= 0x7F) {
            return $h;
        } else if ($h < 0xC2) {
            return false;
        } else if ($h <= 0xDF) {
            return ($h & 0x1F) << 6 | (ord($c{1}) & 0x3F);
        } else if ($h <= 0xEF) {
            return ($h & 0x0F) << 12 | (ord($c{1}) & 0x3F) << 6 | (ord($c{2}) & 0x3F);
        } else if ($h <= 0xF4) {
            return ($h & 0x0F) << 18 | (ord($c{1}) & 0x3F) << 12 | (ord($c{2}) & 0x3F) << 6 | (ord($c{3}) & 0x3F);
        } else {
            return false;
        }
    }


    public function sendTicket(Request $request)
    {
        # code...

        // print_r($request->input());
        $support_data['user'] = auth()->user()->name;
        $support_data['text'] = $request->input('message');
        print_r($support_data);
        Mail::send('ticket', $support_data, function($message) use ($support_data) {
            $message->to("nishant6639@gmail.com", 'GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI')->subject('New Ticket Raised');
            $message->from('nishant060990@gmail.com','GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
        });
        return response()->json(['saved'=>'true'], 200);
    }


    public function getAccessResult($page_name)
    {
        # code...
        $roles_spec_pages = '{
                    "super-admin": [
                        "action-remarks",
                        "add-achievements",
                        "add-establishment",
                        "add-scheme-financials",
                        "add-scheme-financials.php",
                        "add-scheme",
                        "add-scheme-objectives",
                        "add-targets",
                        "add-user",
                        "all_departments_dasboard",
                        "all-schemes",
                        "all-users",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "all-financials",
                        "assign-departments",
                        "assigned-actions",
                        "all-indicators-status",
                        "assign-programs",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "custom-reports.js",
                        "dashboard",
                        "department_dashboard_links",
                        "departments",
                        "dept_dashboard",
                        "districts",
                        "edit-scheme",
                        "eval_criteria",
                        "implementing_agency",
                        "indicator_dashboard",
                        "indicator-objects",
                        "monitoringtype",
                        "my-account",
                        "my-dashboards",
                        "outcome-target-achievements",
                        "outcome-target-achievements-reviews-action",
                        "outcome-target-achievements-reviews",
                        "outcome-target-baseline",
                        "output-target-achievements",
                        "output-target-achievements-reviews-action",
                        "output-target-achievements-reviews",
                        "output-target-baseline",
                        "raise-request",
                        "reports",
                        "respond-request",
                        "scheme_dashboard",
                        "scheme-list-dept",
                        "scheme-list",
                        "scheme-objectives",
                        "scheme-objectives-outputs",
                        "scheme-objectives-outputs-indicators",
                        "scheme-objectives-outputs-outcome",
                        "scheme-objectives-outputs-outcome-indicators",
                        "sectors",
                        "send-notification",
                        "sidelist",
                        "subsectors",
                        "tags",
                        "units",
                        "upload-scheme-data",
                        "vidhanshabhas",
                        "wards",
                        "action-remarks.html",
                        "add-achievements.html",
                        "add-establishment.html",
                        "add-scheme-financials.html",
                        "add-scheme-financials.php.html",
                        "add-scheme.html",
                        "add-scheme-objectives.html",
                        "add-targets.html",
                        "add-user.html",
                        "all_departments_dasboard.html",
                        "all-schemes.html",
                        "all-users.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "all-financials.html",
                        "assign-departments.html",
                        "assigned-actions.html",
                        "all-indicators-status.html",
                        "assign-programs.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "custom-reports.js.html",
                        "dashboard.html",
                        "department_dashboard_links.html",
                        "departments.html",
                        "dept_dashboard.html",
                        "districts.html",
                        "edit-scheme.html",
                        "eval_criteria.html",
                        "implementing_agency.html",
                        "indicator_dashboard.html",
                        "indicator-objects.html",
                        "monitoringtype.html",
                        "my-account.html",
                        "my-dashboards.html",
                        "outcome-target-achievements.html",
                        "outcome-target-achievements-reviews-action.html",
                        "outcome-target-achievements-reviews.html",
                        "outcome-target-baseline.html",
                        "output-target-achievements.html",
                        "output-target-achievements-reviews-action.html",
                        "output-target-achievements-reviews.html",
                        "output-target-baseline.html",
                        "raise-request.html",
                        "reports.html",
                        "respond-request.html",
                        "scheme_dashboard.html",
                        "scheme-list-dept.html",
                        "scheme-list.html",
                        "scheme-objectives.html",
                        "scheme-objectives-outputs.html",
                        "scheme-objectives-outputs-indicators.html",
                        "scheme-objectives-outputs-outcome.html",
                        "scheme-objectives-outputs-outcome-indicators.html",
                        "sectors.html",
                        "send-notification.html",
                        "sidelist.html",
                        "subsectors.html",
                        "tags.html",
                        "units.html",
                        "upload-scheme-data.html",
                        "vidhanshabhas.html",
                        "wards.html",
                        "support.html",
                        "support",
                        "change-password",
                        "change-password.html",
                        "audits.html",
                        "audits"
                    ],
                    "department-admin": [
                        "action-remarks",
                        "add-achievements",
                        "add-establishment",
                        "add-scheme-financials",
                        "add-scheme-financials.php",
                        "add-scheme",
                        "add-scheme-objectives",
                        "add-targets",
                        "add-user",
                        "all-schemes",
                        "all-users",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "all-financials",
                        "all-indicators-status",
                        "assign-programs",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "custom-reports.js",
                        "dashboard",
                        "department_dashboard_links",
                        "dept_dashboard",
                        "districts",
                        "edit-scheme",
                        "implementing_agency",
                        "indicator_dashboard",
                        "indicator-objects",
                        "my-account",
                        "my-dashboards",
                        "outcome-target-achievements",
                        "outcome-target-achievements-reviews-action",
                        "outcome-target-achievements-reviews",
                        "outcome-target-baseline",
                        "output-target-achievements",
                        "output-target-achievements-reviews-action",
                        "output-target-achievements-reviews",
                        "output-target-baseline",
                        "raise-request",
                        "reports",
                        "respond-request",
                        "scheme_dashboard",
                        "scheme-list-dept",
                        "scheme-list",
                        "scheme-objectives",
                        "scheme-objectives-outputs",
                        "scheme-objectives-outputs-indicators",
                        "scheme-objectives-outputs-outcome",
                        "scheme-objectives-outputs-outcome-indicators",
                        "send-notification",
                        "sidelist",
                        "upload-scheme-data",
                        "action-remarks.html",
                        "add-achievements.html",
                        "add-establishment.html",
                        "add-scheme-financials.html",
                        "add-scheme-financials.php.html",
                        "add-scheme.html",
                        "add-scheme-objectives.html",
                        "add-targets.html",
                        "add-user.html",
                        "all_departments_dasboard.html",
                        "all-schemes.html",
                        "all-users.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "all-financials.html",
                        "assign-departments.html",
                        "assigned-actions.html",
                        "all-indicators-status.html",
                        "assign-programs.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "custom-reports.js.html",
                        "dashboard.html",
                        "department_dashboard_links.html",
                        "departments.html",
                        "dept_dashboard.html",
                        "edit-scheme.html",
                        "eval_criteria.html",
                        "implementing_agency.html",
                        "indicator_dashboard.html",
                        "indicator-objects.html",
                        "my-account.html",
                        "my-dashboards.html",
                        "outcome-target-achievements.html",
                        "outcome-target-achievements-reviews-action.html",
                        "outcome-target-achievements-reviews.html",
                        "outcome-target-baseline.html",
                        "output-target-achievements.html",
                        "output-target-achievements-reviews-action.html",
                        "output-target-achievements-reviews.html",
                        "output-target-baseline.html",
                        "raise-request.html",
                        "reports.html",
                        "respond-request.html",
                        "scheme_dashboard.html",
                        "scheme-list-dept.html",
                        "scheme-list.html",
                        "scheme-objectives.html",
                        "scheme-objectives-outputs.html",
                        "scheme-objectives-outputs-indicators.html",
                        "scheme-objectives-outputs-outcome.html",
                        "scheme-objectives-outputs-outcome-indicators.html",
                        "send-notification.html",
                        "sidelist.html",
                        "upload-scheme-data.html",
                        "support.html",
                        "support",
                        "change-password",
                        "change-password.html"
                    ],
                    "department-user": [
                        "action-remarks",
                        "add-achievements",
                        "add-establishment",
                        "add-scheme-financials",
                        "add-scheme-financials.php",
                        "add-scheme",
                        "add-scheme-objectives",
                        "add-targets",
                        "add-user",
                        "all-schemes",
                        "all-users",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "all-financials",
                        "all-indicators-status",
                        "assign-programs",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "custom-reports.js",
                        "dashboard",
                        "department_dashboard_links",
                        "dept_dashboard",
                        "districts",
                        "edit-scheme",
                        "implementing_agency",
                        "indicator_dashboard",
                        "indicator-objects",
                        "my-account",
                        "my-dashboards",
                        "outcome-target-achievements",
                        "outcome-target-achievements-reviews-action",
                        "outcome-target-achievements-reviews",
                        "outcome-target-baseline",
                        "output-target-achievements",
                        "output-target-achievements-reviews-action",
                        "output-target-achievements-reviews",
                        "output-target-baseline",
                        "raise-request",
                        "reports",
                        "scheme_dashboard",
                        "scheme-list-dept",
                        "scheme-list",
                        "scheme-objectives",
                        "scheme-objectives-outputs",
                        "scheme-objectives-outputs-indicators",
                        "scheme-objectives-outputs-outcome",
                        "scheme-objectives-outputs-outcome-indicators",
                        "send-notification",
                        "sidelist",
                        "upload-scheme-data",
                        "action-remarks.html",
                        "add-achievements.html",
                        "add-establishment.html",
                        "add-scheme-financials.html",
                        "add-scheme-financials.php.html",
                        "add-scheme.html",
                        "add-scheme-objectives.html",
                        "add-targets.html",
                        "add-user.html",
                        "all_departments_dasboard.html",
                        "all-schemes.html",
                        "all-users.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "all-financials.html",
                        "assign-departments.html",
                        "assigned-actions.html",
                        "all-indicators-status.html",
                        "assign-programs.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "custom-reports.js.html",
                        "dashboard.html",
                        "department_dashboard_links.html",
                        "departments.html",
                        "dept_dashboard.html",
                        "edit-scheme.html",
                        "eval_criteria.html",
                        "implementing_agency.html",
                        "indicator_dashboard.html",
                        "indicator-objects.html",
                        "my-account.html",
                        "my-dashboards.html",
                        "outcome-target-achievements.html",
                        "outcome-target-achievements-reviews-action.html",
                        "outcome-target-achievements-reviews.html",
                        "outcome-target-baseline.html",
                        "output-target-achievements.html",
                        "output-target-achievements-reviews-action.html",
                        "output-target-achievements-reviews.html",
                        "output-target-baseline.html",
                        "raise-request.html",
                        "reports.html",
                        "scheme_dashboard.html",
                        "scheme-list-dept.html",
                        "scheme-list.html",
                        "scheme-objectives.html",
                        "scheme-objectives-outputs.html",
                        "scheme-objectives-outputs-indicators.html",
                        "scheme-objectives-outputs-outcome.html",
                        "scheme-objectives-outputs-outcome-indicators.html",
                        "send-notification.html",
                        "sidelist.html",
                        "upload-scheme-data.html",
                        "support.html",
                        "support",
                        "change-password",
                        "change-password.html"
                    ],
                    "department-viewer": [
                        "all_departments_dasboard",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "all-financials",
                        "dashboard",
                        "dept_dashboard",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "indicator_dashboard",
                        "my-account",
                        "all-indicators-status",
                        "my-dashboards",
                        "reports",
                        "scheme_dashboard",
                        "raise-request",
                        "all_departments_dasboard.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "all-financials.html",
                        "dashboard.html",
                        "dept_dashboard.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "indicator_dashboard.html",
                        "my-account.html",
                        "all-indicators-status.html",
                        "my-dashboards.html",
                        "reports.html",
                        "scheme_dashboard.html",
                        "raise-request.html",
                        "send-notification",
                        "send-notification.html",
                        "support.html",
                        "support",
                        "change-password",
                        "change-password.html"
                    ],
                    "gnctd-viewer": [
                        "all_departments_dasboard",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "dashboard",
                        "all-indicators-status",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "dept_dashboard",
                        "indicator_dashboard",
                        "my-account",
                        "my-dashboards",
                        "reports",
                        "all-financials",
                        "scheme_dashboard",
                        "all_departments_dasboard.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "dashboard.html",
                        "all-indicators-status.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "dept_dashboard.html",
                        "indicator_dashboard.html",
                        "my-account.html",
                        "my-dashboards.html",
                        "reports.html",
                        "all-financials.html",
                        "scheme_dashboard.html",
                        "send-notification",
                        "send-notification.html",
                        "support.html",
                        "support",
                        "change-password",
                        "change-password.html"
                    ],
                    "hod": [
                        "all_departments_dasboard",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "all-indicators-status",
                        "dashboard",
                        "dept_dashboard",
                        "indicator_dashboard",
                        "my-account",
                        "my-dashboards",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "all-financials",
                        "reports",
                        "scheme_dashboard",
                        "add-user",
                        "all-users",
                        "all-users.html",
                        "all_departments_dasboard.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "all-indicators-status.html",
                        "dashboard.html",
                        "dept_dashboard.html",
                        "indicator_dashboard.html",
                        "my-account.html",
                        "my-dashboards.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "all-financials.html",
                        "reports.html",
                        "scheme_dashboard.html",
                        "add-user.html",
                        "send-notification.html",
                        "send-notification",
                        "support.html",
                        "support",
                        "change-password",
                        "change-password.html"
                    ],
                    "public-viewer": [
                        "all_departments_dasboard",
                        "compare-schemes",
                        "create-custom-dashboard",
                        "custom-dashboard",
                        "custom-reports",
                        "all-indicators-status",
                        "dashboard",
                        "dept_dashboard",
                        "indicator_dashboard",
                        "my-account",
                        "offtrack-indicators",
                        "ontrack-indicators",
                        "na-indicators",
                        "nr-indicators",
                        "my-dashboards",
                        "all-financials",
                        "critical-indicators",
                        "critical-offtrack-indicators",
                        "critical-ontrack-indicators",
                        "critical-na-indicators",
                        "critical-nr-indicators",
                        "reports",
                        "scheme_dashboard",
                        "all_departments_dasboard.html",
                        "compare-schemes.html",
                        "create-custom-dashboard.html",
                        "custom-dashboard.html",
                        "custom-reports.html",
                        "all-indicators-status.html",
                        "dashboard.html",
                        "dept_dashboard.html",
                        "indicator_dashboard.html",
                        "my-account.html",
                        "offtrack-indicators.html",
                        "ontrack-indicators.html",
                        "na-indicators.html",
                        "nr-indicators.html",
                        "my-dashboards.html",
                        "all-financials.html",
                        "critical-indicators.html",
                        "critical-offtrack-indicators.html",
                        "critical-ontrack-indicators.html",
                        "critical-na-indicators.html",
                        "critical-nr-indicators.html",
                        "reports.html",
                        "scheme_dashboard.html",
                        "scheme-list.html",
                        "change-password",
                        "change-password.html",
                        
                    ]
                }';
        $page_arr = json_decode($roles_spec_pages, TRUE);
        // return ($page_arr);
        $cuser = Auth::user(); 
        $croles = $cuser->getRoleNames();
        $page_name = strtok($page_name, '?');
        $currentrole = $croles[0];
        if( in_array( $page_name, $page_arr[ $currentrole ] ) ) {
            $flag = 1;
        }
        else{
            $flag = 0;
        }
        return $flag;
    }


    public function reset_password(Request $request)
    {
        # code...

        $email = $request->input('email');
        // echo $email;

        $password = rand(1111111,9999999);
        $this->validate($request, [
            'email'=>'required'
        ]);

        $user = User::where('email', '=', $email)->first();
        $user->password = Hash::make($password);
        $user->save();

        
        $user_data['to'] = $user->email;

        $data['msg'] = "Your New Password is ".$password;

        Mail::send('notif', $data, function($message) use ($user_data) {
            $message->to($user_data['to'], 'GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI')->subject('WELCOME TO GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
            $message->from('nishant060990@gmail.com','GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
        });
        return response()->json(['success'=>'true'],200);


    }
    public function audits(Request $request)
    {
        # code...
        $audits = DB::table('activity_log as a')
                        ->join('users as u', 'a.causer_id', '=', 'u.id')
                        ->select('a.*', 'u.name as user_name')                        ->limit(100)

                        ->orderBy('created_at', 'desc')
                        ->get();
        // $final_arr['audits'] = array();
        $htm="";
        $i=0;
        foreach($audits as $key=>$value){
            $i++;
            $subject_type_arr = explode("\\", $value->subject_type);

            $audits_text = $value->user_name." added ".$subject_type_arr[1]." with id#".$value->subject_id." on ".date('d M, Y', strtotime($value->created_at));
           if($subject_type_arr[1] == "Unit"){
                $subjectype = "Implementing Agency";
            }else{
                $subjectype = $subject_type_arr[1];
            }


            // array_push($final_arr, $audits_text);
            $htm.="<tr><td>".$i."</td><td>".$value->user_name."</td><td>".$subjectype."</td><td>".$value->subject_id."</td><td>".date('d M, Y', strtotime($value->created_at))."</td><td>".$value->description."</td></tr>";
        }

        return response()->json(['audits' => $htm], 200);
    }
}