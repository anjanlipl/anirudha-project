<?php

namespace App\Http\Controllers\User;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Rules\PermissionValidRule;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json(['roles'=>$roles]);
        //return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return response()->json(['errorMsg'=>'','allowed'=>'true']);
        //return view('role.create');
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
            'name'=>'required|max:40|unique:roles,name',
        ]);
        $role = new Role;
        $role->name = $request->name;
        $role->save();
        return response()->json(['success'=>'true','role'=>$role]);

        //return redirect()->route('role.index')->with('success','Role added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $role = Role::find($id);
        if(!isset($role)){
        return response()->json(['found'=>'false','role'=>$role]);

        }else{
        return response()->json(['found'=>'true','role'=>$role]);

        }

        //return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return response()->json(['errorMsg'=>'']);
        
        //return view('role.edit', compact('role'));
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
            'name'=>'required|max:70|unique:roles,name'.$this->id,
        ]);
        $role = Role::find($id);
        
        if(!isset($role)){
        return response()->json(['saved'=>'false','role'=>$role]);

        }else{
            $role->name = $request->name;
        $role->save();
        return response()->json(['saved'=>'true','role'=>$role]);

        }

       /* return redirect()->route('role.index')
            ->with('success',
             'role'. $role->name.' updated!');
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if(!isset($role)){
         return response()->json(['deleted'=>'false']);

        }else{
            $role->delete();
            return response()->json(['deleted'=>'true']);
        }
    }

    /**
     * Show the form for syncing permissions to role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sync(Role $role)
    {
        return view('role.sync', compact('role'));
    }

    /**
     * Sync Permission to a Role
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function syncPermissions(Request $request, Role $role)
    {
        $this->validate($request, [
            'permissions' => 'required|array|min:1',
            'permissions.*' => ['required', 'distinct', new PermissionValidRule]
        ]);
        $role->syncPermissions($request->all());
        return redirect()->route('role.index')
            ->with('success',
             'Permissions synced successfully!');
    }
}
