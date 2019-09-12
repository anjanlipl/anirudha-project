<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Role;
use App\Department;
use Illuminate\Support\Facades\Hash;
use App\Rules\RoleValidRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Mail;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$results = DB::select('select * from users');
        //print_r();

        $users = User::all();
        return response()->json(['users'=>$users]);

       // return view('user.index', compact('users'));
    }

   
    public function create(Request $request)
    {
        $errorMsg = $request->errorMsg;
        if(!isset($errorMsg)){
            $errorMsg ='';
        }
        $roles = Role::all();
        $departments = Department::all();
        return response()->json(['allowed'=>'true']);

        //return view('user.create',compact('roles','departments','errorMsg'));
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
            'user_name'=>'required|max:191',
            'email'=>'required|max:191|email|unique:users',
            'user_role'=>'required'

        ]);

         $user_name = $request->user_name;
        $user_password= $this->createRandomPassword();
         $user_email = $request->email;
        $user_role =$request->user_role;

        $user = new User;
        $user->name = $user_name;
        $user->email = $user_email;
        $user->password = Hash::make($user_password);
        $user->save();
        $user->assignRole($user_role);
        $rand_pass = $user_password;
        $user_data['email'] = $user->email;
        $user_data['name'] = $user->name;
        $user_data['rand_pass'] = $rand_pass;
        Mail::send('user_reg', $user_data, function($message) use ($user_data) {
            $message->to($user_data['email'], 'GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI')->subject('WELCOME TO GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
            $message->from('nishant6639@gmail.com','GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
        });
      /*  $this->validate($request, [
            'user_name'=>'required|max:191',
            'user_password'=>'required|max:191',
            'user_password_confirm'=>'required|max:191',
            'email'=>'required|max:191|email|unique:users',
            'user_role'=>'required'

        ]);
        $user_name = $request->user_name;
        $user_password= $request->user_password;
        $user_password_confirm = $request->user_password_confirm;
        $user_email = $request->email;
        $user_role =$request->user_role;
        $user_dept = $request->user_dept;
        if($user_password != $user_password_confirm){
            $errorMsg = "Password and Confirm password should be same";
        return response()->json(['saved'=>'false','error'=>$errorMsg]);*/

            //return redirect()->route('admincreateuser',compact('errorMsg',$errorMsg));
         /*   }

        

        $user = new User;
        $user->name = $user_name;
        $user->email = $user_email;
        $user->password = Hash::make($user_password_confirm);
        $user->dept_id = $user_dept;
        $user->save();
        $user->assignRole($user_role);*/
        return response()->json(['saved'=>'true','user'=>$user]);

       // return redirect()->route('user.index')->with('success','User added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!isset($user)){
        return response()->json(['found'=>'true','user'=>$user]);

        }else{
        return response()->json(['found'=>'true','user'=>$user]);

        }

       // return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $userSelected = User::find($id);
        $errorMsg = $request->errorMsg;
        if(!isset($errorMsg)){
            $errorMsg ='';
        }

        $roles = Role::all();
        $departments = Department::all();
         return response()->json(['errorMsg'=>$errorMsg , 'roles'=>$roles,'departments'=>$departments,'user'=>$user]);
        //return view('user.edit',compact('userSelected','roles','departments','errorMsg'));

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
       $user = User::find($id);
        if(!isset($user)){
        return response()->json(['saved'=>'false','user'=>$user]);

        }else{
             $user->name = $request->get('username');
            //echo $request->get('usertype-select'); exit;

             $role = Role::find($request->get('usertype-select'));
              $user->roles()->detach(); 
              $user->assignRole($role->name);
              if($role->name == 'public-viewer'){
                $user->department_id = null;
              }
        $user->update();
        return response()->json(['saved'=>'true','user'=>$user]);

        }


        //return redirect()->route('user.index')->with('success','User added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $user = User::find($id);
        
        if(!isset($user) && $user !=null){
         return response()->json(['deleted'=>'false']);

        }else{
            $depart = DB::table('departments')
                        ->where('assigned_to', '=', $user->id)
                        ->update(['assigned_to' => null]);
            $user->delete();
            return response()->json(['deleted'=>'true']);
        }return response()->json(['deleted'=>'true']);
        
        
    }

    /**
     * Show the form for syncing roles to user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sync(User $user)
    {
        return view('user.sync', compact('user'));
    }

    /**
     * Sync Permission to a Role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function syncRoles(Request $request, User $user)
    {
        $this->validate($request, [
            'roles' => 'required|array|min:1',
            'roles.*' => ['required', 'distinct', new RoleValidRule]
        ]);
        $role->syncRoles($request->all());
        return redirect()->route('user.index')
            ->with('success',
             'Roles synced successfully!');
    }

    public function createRandomPassword()
    {
        # code...
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 12; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}
