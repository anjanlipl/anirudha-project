<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
    	session_start();
    	$_SESSION['test'] ="mysql";
        DB::setDefaultConnection($_SESSION['test']);
        DB::connection()->getPdo();
        /*if(DB::connection()->getDatabaseName()){
            echo $_SESSION['test'];
            echo "Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName();
        }else{
            die("Could not find the database. Please check your configuration.");
        }*/

    	// echo $_SESSION['test'];

    	//$value ="x";
        //Session::set('variableName', $value);
        //echo Session::get('variableName');
        //$this->middleware('auth');
         //$this->middleware(['role:admin'])->only('create','store');
    }
}
