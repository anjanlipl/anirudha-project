<?php

namespace App\Http\Controllers;

use App\Scheme;
use App\Unit;
use App\Type;
use App\Output;
use App\Department;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\User;
use Auth;
use DB;
use App\RaisedRequest;

class RaiserequestController extends Controller
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
        $raisedReqs = RaisedRequest::where('is_active',1)->get(); 
        
         $result = array();

        foreach ($raisedReqs as $raised) {
             $actionBtn = '<a class="btn btn-small btn-primary" href="assign-departments.html">
                    <span class="text respondReq"  data-id="'.$raised->id .'" >Respond</span>
                  </a>';

                $createdDate = 'NA';

                if(isset($raised->created_at)){
                  $createdDate =  date('d M, Y',strtotime($raised->created_at) );
                }    
                $dept =Department::find($raised->scheme_id) ;
                $user =User::find($raised->user_id) ;
                if($raised->edit_scheme == 1){
                  $perm = 'edit';
                }else if($raised->access_scheme == 1){
                  $perm = 'access';
                }else if($raised->delete_scheme == 1){
                  $perm = 'delete';

                }
                array_push($result, [
                    $dept->name,
                    $user->name,
                    $perm,
                    $createdDate,
                    $actionBtn
                ]);
        }
         return response()->json(['requests'=>$result]);
        
    }


    public function submit(Request $request)
    {
        $schemeId = $request->input('scheme_id');
        $req_type = $request->input('request_type');
        // $scheme = Scheme::find($schemeId);
        $raisedReq = new RaisedRequest;
        $raisedReq->scheme_id = $schemeId;
        $raisedReq->user_id = auth()->user()->id;
        if($req_type == 1){
          $raisedReq->edit_scheme = 1;
        }
        else if($req_type == 2){
            $raisedReq->access_scheme = 1;
        }
        else if($req_type == 3){
          $raisedReq->delete_scheme = 1;
        }
        $raisedReq->save();
        $department = DB::table('schemes as s')
                        ->join('units as u', 's.unit_id', '=', 'u.id')
                        ->select('u.department_id as department_id')
                        ->where('s.id', '=', $schemeId)
                        ->first();
        $department_id = $department->department_id;
        $users = DB::table('users')
                    ->where('department_id', $department_id)
                    ->get();
        $message = '<li><a href="respond-request.html">New Request Received</a></li>';
        foreach($users as $key=>$value){
          // echo $value->id;
          $roles = DB::table('model_has_roles')
                      ->where('model_id', $value->id)
                      ->get();
          foreach($roles as $role){
            if($role->role_id == 4 || $role->role_id == 6){
              event(new \App\Events\SchemeCreateEvent('delhi_planning_'.$value->id.'', $message));
            }
          }
        }

        return response()->json(['added'=>1]);
        
    }
    
}
