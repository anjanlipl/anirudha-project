<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\EstablishmentBe;
use App\EstablishmentRe;
use App\EstablishmentExp;
use App\Establishment;
use App\Scheme;
use App\Sector;
use DB;


class EstablishmentController extends Controller
{
     public function behistory(Request $request)
    {
    	$dept_id = request()->get('dept_id');

    	  $allexp = array();
        $exp_per_be = array();
        $exp_per_re =array();
        $bugets = array();
        $revised = array();
        $current_year=date("Y");
        $current_month=date('m');
        $next_year = date('Y', strtotime('+1 year'));
        $newDate=$next_year.'-03-01';
        $next_month = date('m', strtotime($newDate));
    	if(isset($dept_id) && $dept_id != null){
    		$department = Department::find($dept_id);

    		if(isset($department) && $department != null){

    			$estab = $department->establishmentExpenditure()->first();

    			
    				$be = $estab->establishmentBe()->get();
    				$re = $estab->establishmentRe()->get();
    				$exp = $estab->establishmentExp()->get();

    				if(isset($be))  {
    					foreach ($be as $be1) {
    							  $actionBtnbe = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu beAction" role="menu" id="actionDrop ">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editBeModal"  data-id="'.$be1->id.'">Edit</a></li>
                                    <li><a class="delete deleteBe" id="deleteBe" data-id="'.$be1->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

			                     $total = $be1->sal + $be1->benefits + $be1->wages + $be1->machinery + $be1->office_exp; 
			                        array_push($bugets, [
			                   $be1->start_date.'-'. $be1->end_date,
			                    $be1->sal,
			                    $be1->benefits,
			                    $be1->wages,
			                    $be1->machinery,
			                    $be1->office_exp,
			                    $total,
			                    $actionBtnbe,
			                    
			                ]);
    					}

    				}

    				if(isset($re))  {
    					foreach ($re as $re1) {
    							  $actionBtnbe = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu reAction" role="menu" id="actionDrop ">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editBeModal"  data-id="'.$re1->id.'">Edit</a></li>
                                    <li><a class="delete deleteRe " id="deleteRe" data-id="'.$re1->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

			                     $total = $re1->sal + $re1->benefits + $re1->wages + $re1->machinery + $re1->office_exp; 
			                        array_push($revised, [
			                   $re1->start_date.'-'. $re1->end_date,
			                    $re1->sal,
			                    $re1->benefits,
			                    $re1->wages,
			                    $re1->machinery,
			                    $re1->office_exp,
			                    $total,
			                    $actionBtnbe,
			                    
			                ]);
    					}

    				}
    				if(isset($exp))  {
    					foreach ($exp as $exp1) {
    							  $actionBtnbe = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu expAction" role="menu" id="actionDrop ">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editBeModal"  data-id="'.$exp1->id.'">Edit</a></li>
                                    <li><a class="delete deleteExp" id="deleteExp" data-id="'.$exp1->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

			                     $total = $exp1->sal + $exp1->benefits + $exp1->wages + $exp1->machinery + $exp1->office_exp; 
			                        array_push($allexp, [
			                   $exp1->exp_year,
			                    $exp1->sal,
			                    $exp1->benefits,
			                    $exp1->wages,
			                    $exp1->machinery,
			                    $exp1->office_exp,
			                    $total,
			                    $actionBtnbe,
			                    
			                ]);
    					}
	    			}
    				
    				
    			

    		}
    	}
               return response()->json(['bugets'=>$bugets,'revised'=>$revised,'exp' =>$allexp,'current_month'=>$current_month,'current_year'=>$current_year,'next_year'=>$next_year]);

        //return view('department.index', compact('departments'));
    }
    
     public function getChartDataEstablishment(Request $request){
        $department = Department::all();
        
            $totalBe = 0;
            $totalRe = 0;
            $totalExp = 0;
            $year_exp = array();

          $current_month = date('m');
            $current_year = date('Y');
            $current_month_exp =0;
         if($current_month <4){
            $est_end_year = date('Y');
            $current_year = date('Y', strtotime('-1 year'));
         }else{
            $est_end_year = date('Y', strtotime('+1 year'));
         }
        foreach ($department as $dept) {
            $xtotalRe = 0;
            $xtotalBe = 0;
            $xtotalExp = 0;
            $estab = $dept->establishmentExpenditure()->get();
            foreach ($estab as $estabishment) {
            $be = $estabishment->establishmentBe()->get();
            $re = $estabishment->establishmentRe()->get();
            $exp = $estabishment->establishmentExp()->get();
            
             
             if(isset($re) && count($re)>0){
                 foreach ($re as $value) {
                  //print_r($value);
                 if($value->end_date == $est_end_year){
                    $xtotalRe = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }else if(isset($be) && count($be)>0){
                foreach ($be as $value) {
                  //print_r($value);
                 if($value->end_date == $est_end_year){
                    $xtotalRe = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }
             // echo $xtotalRe;
             // die();
             if(isset($exp) && count($exp)>0){
                 foreach ($exp as $value) {
                    $year_exp =  explode('-',$value->exp_year);
                    $concerned_year = $year_exp[1];
                    $concerned_month =  $year_exp[0];
                    if($concerned_month < 4){
                            if($concerned_year == $est_end_year){
                            $xtotalExp = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                        }
                    }else{
                           if($concerned_year == $current_year ){
                            $xtotalExp = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                        }
                    }
                 
                }
             }


             $totalBe +=  $xtotalBe;
             $totalRe +=  $xtotalRe;
             $totalExp +=  $xtotalExp;

           
            }
        }

            $schemes= Scheme::all();
           
        $totalScehmeEst = 0;
        $totalSchemeExp =0;
        foreach ($schemes as $scheme) {
 
                $estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
                  if(!empty($estimate)){
                    $revisedEstimate = $estimate->revisedEstimates()->get();

                    if(count($revisedEstimate)){
                    // print_r($revisedEstimate);
                    foreach ($revisedEstimate as $re) {
                       $totalScehmeEst += $re->revenue + $re->capital + $re->loan;
                    }
                }
                else{
                    $budgetEstimate = $estimate->budgetEstimates()->get();
                    if(count($budgetEstimate)){
                    foreach ($budgetEstimate as $be) {
                       $totalScehmeEst += $be->revenue + $be->capital + $be->loan;
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
                        $totalSchemeExp += $exp->revenue + $exp->capital + $exp->loan;
                        if($concerned_month < 4){
                            if($concerned_year == $est_end_year){
                            $xtotalExp = $exp->sal + $exp->benefits + $exp->wages + $exp->machinery + $exp->office_exp ;
                            }
                        }else{
                                   if($concerned_year == $current_year ){
                                    $xtotalExp = $exp->sal + $exp->benefits + $exp->wages + $exp->machinery + $exp->office_exp ;
                                }
                        }
                    }
                     
                }
                }
            
        }

        return response()->json(['current_year'=>$est_end_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$totalExp,'totalBe'=>$totalBe,'totalestablishRe'=>$totalRe,'totalSchemeExp'=>$totalSchemeExp,'totalSchmeEst'=>$totalScehmeEst,'year_exp'=>$year_exp]);
        
        
     }

      public function getChartDataDepartEstablishment(Request $request){
        $dept_id = $request->input('dept_id');
        $department = Department::find($dept_id);

        
            $totalBe = 0;
            $totalRe = 0;
            $totalExp = 0;

          $current_month = date('m');
            $current_year = date('Y');
            $current_month_exp =0;
         if($current_month <4){
            $est_end_year = date('Y');
            $current_year = date('Y', strtotime('-1 year'));
         }else{
            $est_end_year = date('Y', strtotime('+1 year'));
         }
        
            $xtotalRe = 0;
            $xtotalBe = 0;
            $xtotalExp = 0;
            $estab = $department->establishmentExpenditure()->get();
            foreach ($estab as $estabishment) {
            $be = $estabishment->establishmentBe()->get();
            $re = $estabishment->establishmentRe()->get();
            $exp = $estabishment->establishmentExp()->get();
            
             
             if(isset($re) && count($re)>0){
                 foreach ($re as $value) {
                 if($value->end_date == $est_end_year){
                    $xtotalRe = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }else if(isset($be) && count($be)>0){
                foreach ($be as $value) {
                 if($value->end_date == $est_end_year){
                    $totalRe = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }

             if(isset($exp) && count($exp)>0){
                 foreach ($exp as $value) {
                    $year_exp =  explode('-',$value->exp_year);
                 if($year_exp == $est_end_year){
                    $xtotalExp = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }


             $totalBe +=  $xtotalBe;
             $totalRe +=  $xtotalRe;
             $totalExp +=  $xtotalExp;

           
            }
    

            $schemes= Scheme::all();
           
        $totalScehmeEst = 0;
        $totalSchemeExp =0;

        $units = $department->units()->get();
                           foreach ($units as $unit) {
                            $schemes= $unit->schemes()->get();
                               
  

        foreach ($schemes as $scheme) {
 
                $estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
                  if(!empty($estimate)){
                    $revisedEstimate = $estimate->revisedEstimates()->get();

                    if(count($revisedEstimate)){
                    // print_r($revisedEstimate);
                    foreach ($revisedEstimate as $re) {
                       $totalScehmeEst += $re->revenue + $re->capital + $re->loan;
                    }
                }
                else{
                    $budgetEstimate = $estimate->budgetEstimates()->get();
                    if(count($budgetEstimate)){
                    foreach ($budgetEstimate as $be) {
                       $totalScehmeEst += $be->revenue + $be->capital + $be->loan;
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
                        $totalSchemeExp += $exp->revenue + $exp->capital + $exp->loan;
                        if($concerned_month < 4){
                            if($concerned_year == $est_end_year){
                            $xtotalExp = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                            }
                        }else{
                                   if($concerned_year == $current_year ){
                                    $xtotalExp = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                                }
                        }
                    }
                     
                }
                }
            
        }
    }

        return response()->json(['current_year'=>$est_end_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$totalExp,'totalBe'=>$totalBe,'totalestablishRe'=>$totalRe,'totalSchemeExp'=>$totalSchemeExp,'totalSchmeEst'=>$totalScehmeEst]);
        
        
     }

     public function getChartDataSectorEstablishment(Request $request){
        $sector_id = $request->input('sector_id');
        $sector = Sector::find($sector_id);
        

        
            $totalBe = 0;
            $totalRe = 0;
            $totalExp = 0;

          $current_month = date('m');
            $current_year = date('Y');
            $current_month_exp =0;
         if($current_month <4){
            $est_end_year = date('Y');
            $current_year = date('Y', strtotime('-1 year'));
         }else{
            $est_end_year = date('Y', strtotime('+1 year'));
         }
        

        $subsectors = $sector->subsectors()->get();
                   foreach ($subsectors as $subsector) {
                       $departments = $subsector->departments()->get();
                       foreach ($departments as $department) {

                          $xtotalRe = 0;
            $xtotalBe = 0;
            $xtotalExp = 0;
            $estab = $department->establishmentExpenditure()->get();

            foreach ($estab as $estabishment) {
            $be = $estabishment->establishmentBe()->get();
            $re = $estabishment->establishmentRe()->get();
            $exp = $estabishment->establishmentExp()->get();
            
             
             if(isset($re) && count($re)>0){
                 foreach ($re as $value) {
                 if($value->end_date == $est_end_year){
                    $xtotalRe = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }else if(isset($be) && count($be)>0){
                foreach ($be as $value) {
                 if($value->end_date == $est_end_year){
                    $totalRe = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }

             if(isset($exp) && count($exp)>0){
                 foreach ($exp as $value) {
                    $year_exp =  explode('-',$value->exp_year);
                 if($year_exp == $est_end_year){
                    $xtotalExp = $value->sal + $value->benefits + $value->wages + $value->machinery + $value->office_exp ;
                 }
                }
             }


             $totalBe +=  $xtotalBe;
             $totalRe +=  $xtotalRe;
             $totalExp +=  $xtotalExp;

           
            }
                       }
                   }


           
        $totalScehmeEst = 0;
        $totalSchemeExp =0;

                $subsectors = $sector->subsectors()->get();
                   foreach ($subsectors as $subsector) {
                       $departments = $subsector->departments()->get();
                       foreach ($departments as $department) {
                           $units = $department->units()->get();
                           foreach ($units as $unit) {
                            $schemes= $unit->schemes()->get();
                                foreach ($schemes as $scheme) {
 
                $estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
                  if(!empty($estimate)){
                    $revisedEstimate = $estimate->revisedEstimates()->get();

                    if(count($revisedEstimate)){
                    // print_r($revisedEstimate);
                    foreach ($revisedEstimate as $re) {
                       $totalScehmeEst += $re->revenue + $re->capital + $re->loan;
                    }
                }
                else{
                    $budgetEstimate = $estimate->budgetEstimates()->get();
                    if(count($budgetEstimate)){
                    foreach ($budgetEstimate as $be) {
                       $totalScehmeEst += $be->revenue + $be->capital + $be->loan;
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
                        $totalSchemeExp += $exp->revenue + $exp->capital + $exp->loan;
                        if($current_month ==$concerned_month ){
                            $current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
                        }
                    }
                     
                }
                }
            
        }

                              }
                             }
                            }  
                                
  

        
    

        return response()->json(['current_year'=>$est_end_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$totalExp,'totalBe'=>$totalBe,'totalestablishRe'=>$totalRe,'totalSchemeExp'=>$totalSchemeExp,'totalSchmeEst'=>$totalScehmeEst]);
        
        
     }


    public function addEstimate(Request $request){
	 		$deptId = $request->input('dept_id');

	 		if(isset($deptId) && $deptId != null){
    			$department = Department::find($deptId);



    			if(isset($department) && $department != null){

            $count = DB::table('establishments')
                        ->where('department_id', '=', $deptId)
                        ->count();

            if($count == 0){
              $estbl = new Establishment;
              $estbl->department_id = $deptId;
              $estbl->save();
            }

    				$establishmentExpenditure = $department->establishmentExpenditure()->first();

	 				$start_year = $request->input('start_year');
	 				$end_year = $request->input('end_year');
			 		$besalary = (double)$request->input('besalary');
			 		$bebenefits = (double)$request->input('bebenefits');
			 		$bewages = (double)$request->input('bewages');
			 		$bemachinery = (double)$request->input('bemachinery');
			 		$beoffice = (double)$request->input('beoffice');

			 		$resalary = (double)$request->input('resalary');
			 		$rebenefits = (double)$request->input('rebenefits');
			 		$rewages = (double)$request->input('rewages');
			 		$remachinery = (double)$request->input('remachinery');
			 		$reoffice = (double)$request->input('reoffice');
			 		$total_be = (double)$request->input('total_be');
			 		$total_re= (double)$request->input('total_re');

			 		if($start_year != '' && $end_year != '' &&  $total_be != 0 ){

			 			$establishmentExpenditure->establishmentBe()->create([
			 				'sal'=>$besalary,
			 				'benefits'=>$bebenefits,
			 				'wages'=>$bewages,
			 				'machinery'=>$bemachinery,
			 				'office_exp'=>$beoffice,
			 				'start_date'=>date('Y-m-d', strtotime($start_year)),
			 				'end_date'=>date('Y-m-d', strtotime($end_year)),

			 			]);
			 		}

			 		if($start_year != ''  && $end_year != '' && $total_re != 0 ){

			 			$establishmentExpenditure->establishmentRe()->create([
			 				'sal'=>$resalary,
			 				'benefits'=>$rebenefits,
			 				'wages'=>$rewages,
			 				'machinery'=>$remachinery,
			 				'office_exp'=>$reoffice,
              'start_date'=>date('Y-m-d', strtotime($start_year)),
              'end_date'=>date('Y-m-d', strtotime($end_year))

			 			]);
			 		}//add be

			 		


    			}
    		}// end if final
	 		

               return response()->json(['success'=>'success']);
	 		 


	 }

	  public function addExpenditure(Request $request){
	 	$deptId = $request->input('dept_id');

	 		if(isset($deptId) && $deptId != null){
    			$department = Department::find($deptId);

    			if(isset($department) && $department != null){
    				$establishmentExpenditure = $department->establishmentExpenditure()->first();

    				$expyear = $request->input('expyear');
			 		$exp_salary = (double)$request->input('exp_salary');
			 		$exp_benefits = (double)$request->input('exp_benefits');
			 		$exp_wages = (double)$request->input('exp_wages');
			 		$exp_machinery = (double)$request->input('exp_machinery');
			 		$exp_office = (double)$request->input('exp_office');
			 		$total_exp = (double)$request->input('total_exp');
              // return response()->json(['success'=>'success']);
			 		
			 		if($expyear != ''  && $total_exp != 0 ){

			 			$establishmentExpenditure->establishmentExp()->create([
			 				'sal'=>$exp_salary,
			 				'benefits'=>$exp_benefits,
			 				'wages'=> $exp_wages,
			 				'machinery' => $exp_machinery,
			 				'office_exp' => $exp_office,
			 				'exp_year' => $expyear
			 			]);
			 		}
    			}
    		}//end if final	
               return response()->json(['success'=>'success']);


	 }

	  public function deletebe($id)
    {
        $be = EstablishmentBe::find($id);
        
        if(!isset($be)){
         return response()->json(['deleted'=>'false']);

        }else{
            $be->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
	 
	    public function deletere($id)
    {
        $re = EstablishmentRe::find($id);
        
        if(!isset($re)){
         return response()->json(['deleted'=>'false']);

        }else{
            $re->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
     public function deleteexp($id)
    {
        $exp = EstablishmentExp::find($id);
        
        if(!isset($exp)){
         return response()->json(['deleted'=>'false']);

        }else{
            $exp->delete();
            return response()->json(['deleted'=>'true']);
        }
    }

    

      public function editestablishmentestimates(Request $request)
    {

        $type =$request->input('type');
       $id = $request->input('id');

        if($type == 'be'){
            $item  = EstablishmentBe::find($id);
        }else if($type  == 're'){
             $item  = EstablishmentRe::find($id);
        }else if($type  == 'exp'){
             $item  = EstablishmentExp::find($id);
        }

        $item->sal=  $request->input('salary');
        $item->benefits=  $request->input('benefits');

        $item->wages=  $request->input('wages');
        $item->machinery=  $request->input('machinery');
        $item->office_exp=  $request->input('officeexp');

        $item->update();


         return response()->json(['success'=>'true']);
    }
}
