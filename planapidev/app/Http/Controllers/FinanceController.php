<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Scheme;
use App\BudgetEstimate;
use App\RevisedEstimate;
use App\Expenditure;



class FinanceController extends Controller
{
	 public function addEstimate(Request $request){
	 		$schemeId = $request->input('scheme_id');
	 		$scheme = Scheme::find($schemeId);
	 		

	 		if(isset($scheme)){
	 			$start_year = $request->input('start_year');
	 			$end_year = $request->input('end_year');
	 			$estrevenue =$request->input('estrevenue');
	 			$estcapital =$request->input('estcapital');
	 			$estloan =$request->input('estloan');
	 			

	 			$revest_revenue =$request->input('revest_revenue');
	 			$revest_capital =$request->input('revest_capital');
	 			$revest_loan =$request->input('revest_loan');
	 			$bugetEst = '';
                $revisedEst ='';

	 			foreach ($start_year as $key => $value) {
	 				if($start_year[$key] != '' &&  $end_year[$key] != ''){
                            $foundEstimate = false;
                            $estimates = $scheme->estimates()->get();
                            foreach ($estimates as $estimateExist) {
                                if($estimateExist->start_date == $start_year[$key] && $estimateExist->end_date == $end_year[$key] ){
                                    $foundEstimate =true;
                                    $estimate = $estimateExist;
                                }
                            }
                            if(!$foundEstimate){
                                $estimate = $scheme->estimates()->create([
                                'start_date'=>$start_year[$key],
                                'end_date'=>$end_year[$key]
                            ]);
                            
                            }
	 						

                            if(isset($estrevenue[$key]) && $estrevenue[$key] != ''){
                                $bugetEst = $estimate->budgetEstimates()->create([
                                'start_date'=>$start_year[$key],
                                'end_date'=>$end_year[$key],
                                'revenue'=>$estrevenue[$key],
                                'capital'=>$estcapital[$key],
                                'loan'=> $estloan[$key]
                             ]); 
                            }

                            if(isset($revest_revenue[$key]) && $revest_revenue[$key] != ''){
                                $revisedEst = $estimate->revisedEstimates()->create([
                                'start_date'=>$start_year[$key],
                                'end_date'=>$end_year[$key],
                                'revenue'=>$revest_revenue[$key],
                                'capital'=>$revest_capital[$key],
                                'loan'=> $revest_loan[$key]
                            ]);
                            }
	 						
	 				}
	 				
	 			}
	 			

	 			return response()->json(['estimate'=>$estimate,'bugetEst'=>$bugetEst,'revisedEst'=>$revisedEst]);
	 		
	 		}



	 }
	 public function addExpenditure(Request $request){
	 		$schemeId = $request->input('scheme_id');
	 		$scheme = Scheme::find($schemeId);
	 		

	 		if(isset($scheme)){
	 			$expyear =$request->input('expyear');
	 			foreach ($expyear as $key => $value) { 
	 					if($expyear[$key] != ''){ 

	 						
	 			$exprevenue =$request->input('exprevenue');
	 			$expcapital =$request->input('expcapital');
	 			$exploan =$request->input('exploan');

	 							$expenditure = $scheme->expenditures()->create([
	 							'exp_year' =>$expyear[$key],
	 							'revenue'=>$exprevenue[$key],
	 							'capital'=>$expcapital[$key],
	 							'loan'=>$exploan[$key]
	 						]);
	 						
	

	 					}
	 			}
	 			

	 			return response()->json(['expenditure'=>$expenditure]);
	 		
	 		}



	 }
	 

	 
	  public function behistory(Request $request)
    {
        $scheme_id = request()->get('scheme_id');
        $scheme = Scheme::find($scheme_id);
        $esitmates = $scheme->estimates()->get();
        $expenditures = $scheme->expenditures()->get();
        $exp = array();

        $exp_per_be = array();
        $exp_per_re =array();
        $bugets = array();
        $revenues = array();
        $current_year=date("Y");
        $current_month=date('m');
        $next_year = date('Y', strtotime('+1 year'));
        $newDate=$next_year.'-03-01';
        $next_month = date('m', strtotime($newDate));
        //echo $next_month;die();
        foreach ($esitmates as $esitmate) {

        	$be = $esitmate->budgetEstimates()->first();
        	$re = $esitmate->revisedEstimates()->first();

        	//echo $current_month;die();
                    
                    if(isset($be)) {
                            $actionBtnbe = '<div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Actions <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu beAction" role="menu" id="actionDrop ">
                                        <li><a class="edit" data-toggle="modal"
                                        data-target="#editBeModal"  data-id="'.$be->id.'">Edit</a></li>
                                        <li><a class="delete" id="deleteBe" data-id="'.$be->id.'"  href="javascript:void(0);" >Delete</a></li>
                                    </ul>
                                </div>';

                         $total = $be->revenue + $be->capital + $be->loan; 
                            array_push($bugets, [
                       $esitmate->start_date.'-'. $esitmate->end_date,
                        $be->revenue,
                        $be->capital,
                        $be->loan,
                        $total,
                        $actionBtnbe,
                        
                    ]);
                    }
                
                    
                    if(isset($re))  {
                    $actionBtnre = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu reAction" role="menu" id="actionDrop ">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editBeModal"  data-id="'.$re->id.'">Edit</a></li>
                                    <li><a class="delete" id="deleteRe"  data-id="'.$re->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

                     $total = $re->revenue + $re->capital + $re->loan; 

                             array_push($revenues, [
                               $esitmate->start_date.'-'. $esitmate->end_date,
                                $re->revenue,
                                $re->capital,
                                $re->loan,
                                $total,
                                $actionBtnre,
                    
                            ]);
                    }
        }


        foreach ($expenditures as $expenditure) {

        	$actionBtnexp = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu expAction"  role="menu" id="actionDrop">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editBeModal"  data-id="'.$expenditure->id.'">Edit</a></li>
                                    <li><a class="delete" id="deleteExp"  data-id="'.$expenditure->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';
            $total = $expenditure->revenue + $expenditure->capital + $expenditure->loan; 

            $year_exp =  explode('-',$expenditure->exp_year);
            $concerned_year = $year_exp[1];
            $concerned_month =  $year_exp[0];
            //echo $concerned_year;die();
            $exp_this ='';
            if($concerned_month < 3){
             $exp_this = $scheme->estimates()->where('end_date',$concerned_year)->first();
            }else{
             $exp_this = $scheme->estimates()->where('start_date',$concerned_year)->first();
            }

            if(isset($exp_this) && $exp_this != '' ){
                $be_this = $exp_this->budgetEstimates()->first();
                $re_this = $exp_this->revisedEstimates()->first();
                // if((int)$current_month < 10 || (int)$current_month > 3){
                    
                // }
                // if(((int)$current_month > 9 && $current_year==date("Y")) || ((int)$next_month < 4 && $current_year == date('Y', strtotime('+1 year')))){

                   
                // }
                //return $be_this;die();
                 if(isset($be_this) && $be_this != '' && !empty($be_this)){
                    

                 $rev_per_be =0;$cap_per_be=0;$loan_per_be=0;$total_per_be=0;
                    if( $be_this->revenue !=0){
                       $rev_per_be = ($expenditure->revenue / $be_this->revenue)*100; 
                    }
                    if( $be_this->capital !=0){
                         $cap_per_be = ($expenditure->capital / $be_this->capital)*100;
                    }
                    if( $be_this->loan !=0){
                         $loan_per_be = ($expenditure->loan / $be_this->loan)*100;
                    }
                    
                    if( ($be_this->revenue+$be_this->capital+$be_this->loan )!=0){
                         $total_per_be = (($expenditure->revenue + $expenditure->capital + $expenditure->loan )/ ($be_this->revenue+$be_this->capital+$be_this->loan))*100;
                    }

                
                 

                        array_push($exp_per_be, [
                        $expenditure->exp_year,
                        round($rev_per_be,2),
                        round($cap_per_be,2),
                        round($loan_per_be,2),
                        round($total_per_be,2),
                        
                        
                    ]);

                 }
                
                 if(isset($re_this) && $re_this != '' && !empty($re_this)){

                    $rev_per_re =0;$cap_per_re=0;$loan_per_re=0;$total_per_re=0;
                    if( $re_this->revenue !=0){
                        $rev_per_re = ($expenditure->revenue / $re_this->revenue)*100;
                    }
                    if( $re_this->capital !=0){
                         $cap_per_re = ($expenditure->capital / $re_this->capital)*100;
                    }
                    if( $re_this->loan !=0){
                         $loan_per_re = ($expenditure->loan / $re_this->loan)*100;
                    }
                    
                    if( ($re_this->revenue+$re_this->capital+$re_this->loan) !=0 ){
                         $total_per_re = (($expenditure->revenue + $expenditure->capital + $expenditure->loan )/ ($re_this->revenue+$re_this->capital+$re_this->loan))*100;
                    }
                   
                    
                    

                    
                 
                    array_push($exp_per_re, [
                        $expenditure->exp_year,
                        round($rev_per_re,2),
                        round($cap_per_re,2),
                        round($loan_per_re,2),
                        round($total_per_re,2),
                       
                        
                    ]);
                 }
                 

            }
            
        	  array_push($exp, [
                   $expenditure->exp_year,
                    $expenditure->revenue,
                    $expenditure->capital,
                    $expenditure->loan,
                    $total,
                    $actionBtnexp
                    
                ]);
        }
        return response()->json(['revenues'=>$revenues,'bugets'=>$bugets,'exp'=>$exp,'exp_per_be'=>$exp_per_be,'exp_per_re'=>$exp_per_re,'current_month'=>$current_month,'current_year'=>$current_year,'next_year'=>$next_year]);

        //return view('department.index', compact('departments'));
    }

    
    public function deletebe($id)
    {
        $be = BudgetEstimate::find($id);
        
        if(!isset($be)){
         return response()->json(['deleted'=>'false']);

        }else{
            $be->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
     public function deletere($id)
    {
        $re = RevisedEstimate::find($id);
        
        if(!isset($re)){
         return response()->json(['deleted'=>'false']);

        }else{
            $re->delete();
            return response()->json(['deleted'=>'true']);
        }
    }
     public function deleteexp($id)
    {
        $exp = Expenditure::find($id);
        
        if(!isset($exp)){
         return response()->json(['deleted'=>'false']);

        }else{
            $exp->delete();
            return response()->json(['deleted'=>'true']);
        }
    }

      public function editschemeestimates(Request $request)
    {

        $type =$request->input('type');
       $id = $request->input('id');

        if($type == 'be'){
            $item  = BudgetEstimate::find($id);
        }else if($type  == 're'){
             $item  = RevisedEstimate::find($id);
        }else if($type  == 'exp'){
             $item  = Expenditure::find($id);
        }

        $item->revenue=  $request->input('revenue');
        $item->capital=  $request->input('capital');

        $item->loan=  $request->input('loan');
        $item->update();


         return response()->json(['success'=>'true']);
    }


    
}