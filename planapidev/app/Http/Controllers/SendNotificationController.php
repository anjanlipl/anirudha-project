<?php

namespace App\Http\Controllers;

use App\User;
use Mail;
use Illuminate\Http\Request;

class SendNotificationController extends Controller
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
    public function getDepartmentUsers()
    {
        # code...
        $dept_id = auth()->user()->department_id;
        $users = User::where('department_id', $dept_id)->get();
        return response()->json(['users'=>$users]);
    }

    public function send(Request $request)
    {
        # code...
        $to_mail = $request->input('user_id');
        $data['msg'] = $request->input('message');
        if($to_mail == 0){
            $dept_id = auth()->user()->department_id;
            $users_to_send = USer::where('department_id', $dept_id)->get();
            foreach ($users_to_send as $key => $value) {
                # code...
                $to = $value->email;
                $user_data['to'] = $to;
                Mail::send('notif', $data, function($message) use ($user_data) {
                    $message->to($user_data['to'], 'GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI')->subject('WELCOME TO GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
                    $message->from('nishant060990@gmail.com','GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
                });
            }
        }else{
            $users_to_send = User::where('id', $to_mail)->first();
            $user_data['to'] = $users_to_send->email;
            Mail::send('notif', $data, function($message) use ($user_data) {
                $message->to($user_data['to'], 'GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI')->subject('WELCOME TO GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
                $message->from('nishant060990@gmail.com','GOVERNMENT OF THE NATIONAL CAPITAL TERRITORY OF DELHI');
            });
        }
        
    }
}
