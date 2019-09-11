<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Scheme;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDashboard()
    {
        $user = \Auth::user();
        $roles = $user->getRoleNames(); 
        $departments = Department::all();
        foreach ($roles as  $role) {
                if($role == 'admin'){
                    return view('admin/dashboard',compact('departments'));
                }else if($role == 'hod'){
                    $department = Department::find($user->dept_id);
                    return view('hod/dashboard',compact('department'));
                }
            }
        
        
    }

     public function showDepartmentDashboard($id)
    {   
                    $department = Department::find($user->dept_id);
                    return view('hod/dashboard',compact('department'));
        
    }

    

    public function getDepartmentSchemes($depId)
    {
        $department = Department::find($depId);
        $units = $department->units()->get();
        $schemesTotal=array();
        foreach ($units as $unit) {
            $schemes = $unit->schemes()->get();
            foreach ($schemes as $scheme) {
                $schemeId = $scheme->id;
                $schemeName = $scheme->name;
                $schemeItem = array('schemeId'=>$schemeId,'schemeName'=>$schemeName);
                array_push($schemesTotal, $schemeItem);
            }
        }
        
        return $schemesTotal;
    }
    public function getDepartmentDetails($depId)
    {
        $department = Department::find($depId);
        
        return $department;
    }
    

    
    public function getSchemeProgress($schemeId)
    {
       $output_total=0;
       $output_ontrack =0;
       $output_offtrack=0;
       $output_notApplicable=0;
       $output_inProgress=0;

       $outcome_total=0;
       $outcome_ontrack =0;
       $outcome_offtrack=0;
       $outcome_notApplicable=0;
       $outcome_inProgress=0;

        $scheme = Scheme::find($schemeId);
        if(isset($scheme)){
                                $output =$scheme->output()->first();
                    $outcome =$scheme->outcome()->first();

                        $outputIndicators = $output->outputIndicators()->get();
                        $outcomeIndicators =$outcome->outcomeIndicators()->get();

                        foreach ($outputIndicators as $outputIndicator) {
                            $output_total +=  1;
                            if($outputIndicator->status == 'ontrack'){
                                $output_ontrack += 1;
                            }else if($outputIndicator->status == 'offtrack'){
                                $output_offtrack += 1;
                            }else if($outputIndicator->status == 'inprogress'){
                                $output_inProgress += 1;
                            }else{
                                $output_notApplicable += 1;
                            }
                        }

                        foreach ($outcomeIndicators as $outcomeIndicator) {
                            $outcome_total +=  1;
                            if($outcomeIndicator->status == 'ontrack'){
                                $outcome_ontrack += 1;
                            }else if($outcomeIndicator->status == 'offtrack'){
                                $outcome_offtrack += 1;
                            }else if($outcomeIndicator->status == 'inprogress'){
                                $outcome_inProgress += 1;
                            }else{
                                $outcome_notApplicable += 1;
                            }
                        }

        }

       

        $result=array();
           array_push($result, ['output_total'=>$output_total,
            'output_ontrack'=>$output_ontrack,
            'output_offtrack'=>$output_offtrack,
            'output_inProgress'=>$output_inProgress,
            'output_notApplicable'=>$output_notApplicable,
            'outcome_total'=>$outcome_total,
            'outcome_ontrack'=>$outcome_ontrack,
            'outcome_offtrack'=>$outcome_offtrack,
            'outcome_inProgress'=>$outcome_inProgress,
            'outcome_notApplicable'=>$outcome_notApplicable,
            
       ]);

        
        return $result ; 

    }

    public function getDepartmentProgress($depId)
    {
       $output_total=0;
       $output_ontrack =0;
       $output_offtrack=0;
       $output_notApplicable=0;
       $output_inProgress=0;

       $outcome_total=0;
       $outcome_ontrack =0;
       $outcome_offtrack=0;
       $outcome_notApplicable=0;
       $outcome_inProgress=0;


       
       $department = Department::find($depId);
       if(isset($department)){
        $units = $department->units()->get();
            foreach ($units as $unit) {
                $schemes = $unit->schemes()->get();
                foreach ($schemes as $scheme) {
                    $output =$scheme->output()->first();
                    $outcome =$scheme->outcome()->first();

                        $outputIndicators = $output->outputIndicators()->get();
                        $outcomeIndicators =$outcome->outcomeIndicators()->get();

                        foreach ($outputIndicators as $outputIndicator) {
                            $output_total +=  1;
                            if($outputIndicator->status == 'ontrack'){
                                $output_ontrack += 1;
                            }else if($outputIndicator->status == 'offtrack'){
                                $output_offtrack += 1;
                            }else if($outputIndicator->status == 'inprogress'){
                                $output_inProgress += 1;
                            }else{
                                $output_notApplicable += 1;
                            }
                        }

                        foreach ($outcomeIndicators as $outcomeIndicator) {
                            $outcome_total +=  1;
                            if($outcomeIndicator->status == 'ontrack'){
                                $outcome_ontrack += 1;
                            }else if($outcomeIndicator->status == 'offtrack'){
                                $outcome_offtrack += 1;
                            }else if($outcomeIndicator->status == 'inprogress'){
                                $outcome_inProgress += 1;
                            }else{
                                $outcome_notApplicable += 1;
                            }
                        }


                }
            }
       }

        $result=array();
           array_push($result, ['output_total'=>$output_total,
            'output_ontrack'=>$output_ontrack,
            'output_offtrack'=>$output_offtrack,
            'output_inProgress'=>$output_inProgress,
            'output_notApplicable'=>$output_notApplicable,
            'outcome_total'=>$outcome_total,
            'outcome_ontrack'=>$outcome_ontrack,
            'outcome_offtrack'=>$outcome_offtrack,
            'outcome_inProgress'=>$outcome_inProgress,
            'outcome_notApplicable'=>$outcome_notApplicable,
            
       ]);

        
        return $result ; 

    }

    


}
