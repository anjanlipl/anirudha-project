<?php

namespace App\Http\Controllers;

use App\User;
// use Mail;
use Illuminate\Http\Request;
use App\Notification;
use DB;

class NotificationController extends Controller
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
    
    public function getNotifications()
    {
        # code...
        $user_id = auth()->user()->id;
        $notifications = DB::table('notifications')
                            ->whereRaw('FIND_IN_SET('.$user_id.',intended_for)')
                            ->get();
        $read_count = 0;
        foreach ($notifications as $key => $value) {
            # code...
            $read_by_arr = explode(',', $value->read_by);
            if(in_array($user_id, $read_by_arr)){
                $message = '<li class="notify-item read" data-id="'.$value->id.'">'.$value->message.'</li>';
            }
            else{
                $read_count++;
                $message = '<li class="notify-item" data-id="'.$value->id.'">'.$value->message.'</li>';
            }
            $notifications[$key]->message = $message;
        }
        return response()->json(['notifications'=>$notifications, 'count'=>$read_count]);
    }

    public function markNoteRead(Request $request)
    {
        # code..
        $note_id = $request->input('note_id');
        $user_id = auth()->user()->id;
        $this_note = DB::table('notifications')
                        ->where('id', $note_id)
                        ->first();
        $read_by = $this_note->read_by;
        $read_by_arr = explode(',', $read_by);
        if(!in_array($user_id, $read_by_arr)){
            array_push($read_by_arr, $user_id);
        }
        $notif = Notification::find($note_id);
        $notif->read_by = implode(',', $read_by_arr);
        $notif->save();
        echo 1;
    }
}
