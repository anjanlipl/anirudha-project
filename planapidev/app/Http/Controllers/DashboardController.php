<?php

namespace App\Http\Controllers;
use App\Scheme;
use App\Outcomeindicator;
use App\Outputindicator;
use App\Sector;
use App\Department;
use  App\Outcometarget;
use App\Outputtarget;
use Illuminate\Http\Request;
use App\ActionUser;
use App\User;
use DB;

class DashboardController extends Controller
{


	public function offtrackIndicators(Request $request)
	{
		# code...
		//return $request;die();
		$status = $request->input('status');
		if(!empty($request->input('dept_id'))){
			$dept_id = $request->input('dept_id');
		}
		if(!empty($request->input('sector_id'))){
			$sector_id = $request->input('sector_id');
		}
		if(auth()->user()->department_id != NULL) {
			$dept_id = auth()->user()->department_id;
		}
		// ['oci.is_critical', '=', '1']
		if($status == 0){
			$title = "All Indicators";
			$opiwhere = ['opi.status', '>=', 0];
			$ociwhere = ['oci.status', '>=', 0];
		}
		if($status == 1){
			$title = "NA Indicators";
			$opiwhere = ['opi.status', '=', 1];
			$ociwhere = ['oci.status', '=', 1];
		}
		if($status == 2){
			$title = "On Track Indicators";
			$opiwhere = ['opi.status', '=', 2];
			$ociwhere = ['oci.status', '=', 2];
		}
		if($status == 3){
			$title = "Off Track Indicators";
			$opiwhere = ['opi.status', '=', 3];
			$ociwhere = ['oci.status', '=', 3];
		}
		if($status == 4){
			$title = "NR Indicators";
			$opiwhere = ['opi.status', '=', 4];
			$ociwhere = ['oci.status', '=', 4];
		}
		//echo $request->input('type');
		if(!empty($request->input('type'))){
			$allOfftrackIndsOutp = DB::table('outputindicators as opi')
									->join('outputs as op', 'opi.output_id', "=", 'op.id')
									->join('objectives as ob', 'op.objective_id', "=", 'ob.id')
									->join('schemes as s', 'ob.scheme_id', "=", 's.id')
									->join('units as u', 's.unit_id', '=', 'u.id')
									->join('departments as d', 'u.department_id', '=', 'd.id')
									->where([
										['opi.name', '!=', '.'],
										$opiwhere,
										['is_critical', 1]
									])
									->select('d.id as dept_id', 'd.name as dept_name', 's.id as sch_id', 's.name as scheme_name','opi.id as ind_id', 'opi.name as ind_name')
									->get();

			$allOfftrackIndsOutc = DB::table('outcomeindicators as oci')
									->join('outcomes as oc', 'oci.outcome_id', "=", 'oc.id')
									->join('outputs as op', 'oc.output_id', "=", 'op.id')
									->join('objectives as ob', 'op.objective_id', "=", 'ob.id')
									->join('schemes as s', 'ob.scheme_id', "=", 's.id')
									->join('units as u', 's.unit_id', '=', 'u.id')
									->join('departments as d', 'u.department_id', '=', 'd.id')
									->where([
										['oci.name', '!=', '.'],
										$ociwhere,
										['is_critical', 1]
									])
									->select('d.id as dept_id', 'd.name as dept_name', 's.id as sch_id', 's.name as scheme_name','oci.id as ind_id','oci.name as ind_name')
									->get();
		}
		else{
			$allOfftrackIndsOutp = DB::table('outputindicators as opi')
									->join('outputs as op', 'opi.output_id', "=", 'op.id')
									->join('objectives as ob', 'op.objective_id', "=", 'ob.id')
									->join('schemes as s', 'ob.scheme_id', "=", 's.id')
									->join('units as u', 's.unit_id', '=', 'u.id')
									->join('departments as d', 'u.department_id', '=', 'd.id')
									->join('subsectors as sub', 'd.subsector_id', '=', 'sub.id')
									->join('sectors as sec', 'sub.sector_id', '=', 'sec.id')
									->where([
										['opi.name', '!=', '.'],
										$opiwhere
									])
									->select('d.id as dept_id', 'd.name as dept_name','sec.id as sec_id', 'sec.name as sec_name', 's.id as sch_id', 's.name as scheme_name','opi.id as ind_id', 'opi.name as ind_name')
									->get();

			$allOfftrackIndsOutc = DB::table('outcomeindicators as oci')
									->join('outcomes as oc', 'oci.outcome_id', "=", 'oc.id')
									->join('outputs as op', 'oc.output_id', "=", 'op.id')
									->join('objectives as ob', 'op.objective_id', "=", 'ob.id')
									->join('schemes as s', 'ob.scheme_id', "=", 's.id')
									->join('units as u', 's.unit_id', '=', 'u.id')
									->join('departments as d', 'u.department_id', '=', 'd.id')
									->join('subsectors as sub', 'd.subsector_id', '=', 'sub.id')
									->join('sectors as sec', 'sub.sector_id', '=', 'sec.id')
									->where([
										['oci.name', '!=', '.'],
										$ociwhere
									])
									->select('d.id as dept_id', 'd.name as dept_name','sec.id as sec_id', 'sec.name as sec_name', 's.id as sch_id', 's.name as scheme_name','oci.id as ind_id','oci.name as ind_name')
									->get();
		}

		$final_arr = array();

		foreach ($allOfftrackIndsOutp as $key => $value) {
			# code...
			if(!empty($dept_id)){
				if($value->dept_id == $dept_id){
					$final_arr[$value->dept_name][$value->scheme_name]['outputs'][$value->ind_id]['name'] = $value->ind_name;
					$final_arr[$value->dept_name][$value->scheme_name]['outputs'][$value->ind_id]['type'] = 'output';
				}
			}
			else if(!empty($sector_id)){
				if($value->sec_id == $sector_id){
					$final_arr[$value->sec_name][$value->scheme_name]['outputs'][$value->ind_id]['name'] = $value->ind_name;
					$final_arr[$value->sec_name][$value->scheme_name]['outputs'][$value->ind_id]['type'] = 'output';
				}
			}
			else{
				$final_arr[$value->dept_name][$value->scheme_name]['outputs'][$value->ind_id]['name'] = $value->ind_name;
				$final_arr[$value->dept_name][$value->scheme_name]['outputs'][$value->ind_id]['type'] = 'output';
			}

		}

		foreach ($allOfftrackIndsOutc as $key => $value) {
			# code...
			if(!empty($dept_id)){
				if($value->dept_id == $dept_id){
					$final_arr[$value->dept_name][$value->scheme_name]['outcomes'][$value->ind_id]['name'] = $value->ind_name;
					$final_arr[$value->dept_name][$value->scheme_name]['outcomes'][$value->ind_id]['type'] = 'outcome';
				}
			}
			else if(!empty($sector_id)){
				if($value->sec_id == $sector_id){
					$final_arr[$value->sec_name][$value->scheme_name]['outcomes'][$value->ind_id]['name'] = $value->ind_name;
					$final_arr[$value->sec_name][$value->scheme_name]['outcomes'][$value->ind_id]['type'] = 'outcome';
				}
			}
			else{
				$final_arr[$value->dept_name][$value->scheme_name]['outcomes'][$value->ind_id]['name'] = $value->ind_name;
				$final_arr[$value->dept_name][$value->scheme_name]['outcomes'][$value->ind_id]['type'] = 'outcome';
			}
		}


		$data['title'] = $title;
		
		
		$data['inds'] = $final_arr;
		

		return view('inds', $data);
	}

	
	public function getDashboardFinancials(Request $request)
	{
		$schemes= Scheme::all();
		$finYear = $request->input('finYear');
		$getYear=explode('-',$finYear);
		//print_r($getYear);
		
		$current_begin_date = $getYear[0].'-04-01';
	    $current_end_date ="20".$getYear[1].'-03-31';
	    $na =0;
		$ontrack=0;
		$offtrack=0;
		$inProgess=0;
		$nr=0;
		$schemesCount=0;
		$allOfftrackOutputIndicators =array();
		$allOfftrackOutcomeIndicators = array();

		$current_month_exp =0;

		/*$current_month = date('m');
		$current_year = date('Y');
		

		if($current_month < 4){
			$est_end_year = date('Y');
			$current_year = date('Y', strtotime('-1 year'));

		}else{
			$est_end_year = date('Y', strtotime('+1 year'));
		}*/

		$current_year = date('Y',strtotime($current_begin_date));
		$est_end_year = date('Y',strtotime($current_end_date));

		$totalEst = 0;
		$totalExp =0;
		$current_month_exp_new=0;
		foreach ($schemes as $scheme) {
			$unit = $scheme->unit()->first();
			//return $unit;
          	$unitName ='NA';
          	if(isset($unit->id) && $unit->is_default == 0){
              	$unitName = $unit->name;
          	}
          	if(isset($unit->id)){
                $dept = $unit->department()->first();
             	//$deptName ='NA';
                if(isset($dept->id)){
                	if($dept->id == auth()->user()->department_id){
                		
                	}
                }
     		}

			$estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
			//print_r($estimate);
			if(!empty($estimate)){
				$revisedEstimate = $estimate->revisedEstimates()->get();
				
				if(count($revisedEstimate)){
					// print_r($revisedEstimate);
					foreach ($revisedEstimate as $re) {
					 $totalEst += $re->revenue + $re->capital + $re->loan;
				 }
			 }
			 else{
				$budgetEstimate = $estimate->budgetEstimates()->get();
				if(count($budgetEstimate)){
					foreach ($budgetEstimate as $be) {
					 $totalEst += $be->revenue + $be->capital + $be->loan;
				 }
			 }
		 }

		 $expenditures = $scheme->expenditures()->get();
		 
		 if(isset($expenditures) && count($expenditures)>1){
		 	//print_r($expenditures);
		 	foreach ($expenditures as $exp) {
			 	//print_r($exp);
			 	$exp_date = date('Y-m', strtotime($exp->exp_year));
				$year_exp =  explode('-',$exp->exp_year);

						// print_r($year_exp);
				$concerned_year = $year_exp[1];
				$concerned_month =  $year_exp[0];
				//echo $concerned_year;die();
				if((int)date('m') < 4){

					if(((int)$concerned_month > 3 && (int)$concerned_year == date('Y', strtotime('-1 years'))) || ((int)$concerned_month < 4 && (int)$concerned_year == date('Y'))) {
						$totalExp += $exp->revenue + $exp->capital + $exp->loan;
						//if($current_month ==$concerned_month ){
							$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
						//}
					}
				}
				else{
					
					if(((int)$concerned_month > 3 && (int)$concerned_year == date('Y')) || ((int)$concerned_month < 4 && (int)$concerned_year == date('Y', strtotime('+1 years')))) {
						//echo $exp->id.'@@';
						$totalExp += $exp->revenue + $exp->capital + $exp->loan;
						//if($current_month ==$concerned_month){
							$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
							
						//}
					}
				}
				
			}
			//echo $exp->scheme_id.'@@';
			$current_month_exp_new +=$current_month_exp;
			//echo $current_month_exp.'##';
		 }
		 	//die();
			//echo $current_month_exp.'@@';
			
		 
	}
	
}//die();
return response()->json(['current_year'=>$current_year,'current_month_exp'=>round(($current_month_exp_new/100), 2),'totalExp'=>round(($totalExp/100),2),'totalEst'=>round(($totalEst/100),2)]);
}

public function getDashboardFinancialsScheme(Request $request)
{
		// $schemes= Scheme::all();
  $scheme_id = $request->input('scheme_id');
  $current_month = date('m');
  $current_year = date('Y');
  $current_month_exp =0;
  if($current_month <4){
	$est_end_year = date('Y');
	$current_year = date('Y', strtotime('-1 year'));
}else{
	$est_end_year = date('Y', strtotime('+1 year'));
}
$totalEst = 0;
$totalExp =0;
		// foreach ($schemes as $scheme) {

$scheme = Scheme::find($scheme_id);

$estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
if(!empty($estimate)){
	$revisedEstimate = $estimate->revisedEstimates()->get();

	if(count($revisedEstimate)){
					// print_r($revisedEstimate);
		foreach ($revisedEstimate as $re) {
		 $totalEst += $re->revenue + $re->capital + $re->loan;
	 }
 }
 else{
	$budgetEstimate = $estimate->budgetEstimates()->get();
	if(count($budgetEstimate)){
		foreach ($budgetEstimate as $be) {
		 $totalEst += $be->revenue + $be->capital + $be->loan;
	 }
 }
}

$expenditures = $scheme->expenditures()->get();
foreach ($expenditures as $exp) {
	$year_exp =  explode('-',$exp->exp_year);
					// print_r($year_exp);
	$concerned_year = $year_exp[1];
	$concerned_month =  $year_exp[0];
	if(date('m') < 4){
		if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
			$totalExp += $exp->revenue + $exp->capital + $exp->loan;
			if($current_month ==$concerned_month ){
				$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
			}
		}
	}
	else{
		if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
			$totalExp += $exp->revenue + $exp->capital + $exp->loan;
			if($current_month ==$concerned_month ){
				$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
			}
		}
	}
	// if($current_year == $concerned_year){
	// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
	// 	if($current_month ==$concerned_month ){
	// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
	// 	}
	// }
	
}
}

		// }
return response()->json(['current_year'=>$current_year,'current_month_exp'=>$current_month_exp/100,'totalExp'=>$totalExp/100,'totalEst'=>$totalEst/100]);
}


public function getDashboardFinancialsSectorwise()
{
	$sectors = Sector::all();
	$alldepartments=Department::all();
	$schemes= Scheme::all();
	$current_month = date('m');
	$current_year = date('Y');
	$current_month_exp =0;
	if($current_month <4){
		$est_end_year = date('Y');
		$current_year = date('Y', strtotime('-1 year'));
	}else{
		$est_end_year = date('Y', strtotime('+1 year'));
	}
	

	$xtotalExp =array();
	$xtotalEst =array();

		
		 foreach ($alldepartments as $department) {
		 	$totalEst = 0;
	   		$totalExp =0;
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
							 $totalEst += $re->revenue + $re->capital + $re->loan;
						 }
					 }
					 else{
						$budgetEstimate = $estimate->budgetEstimates()->get();
						if(count($budgetEstimate)){
							foreach ($budgetEstimate as $be) {
							 $totalEst += $be->revenue + $be->capital + $be->loan;
						 }
					 }
				 }

				 $expenditures = $scheme->expenditures()->get();
				 foreach ($expenditures as $exp) {
					$year_exp =  explode('-',$exp->exp_year);
									// print_r($year_exp);
					$concerned_year = $year_exp[1];
					$concerned_month =  $year_exp[0];
					if(date('m') < 4){
						if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
							$totalExp += $exp->revenue + $exp->capital + $exp->loan;
							if($current_month ==$concerned_month ){
								$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
							}
						}
					}
					else{
						if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
							$totalExp += $exp->revenue + $exp->capital + $exp->loan;
							if($current_month ==$concerned_month ){
								$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
							}
						}
					}
					// if($current_year == $concerned_year){
					// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
					// 	if($current_month ==$concerned_month ){
					// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
					// 	}
					// }
					
				}
			}
			
		}
	}
	array_push($xtotalExp,$totalExp/100) ;
array_push($xtotalEst,$totalEst/100) ;
}





return response()->json(['sectors'=>$sectors,'departments'=>$alldepartments,'current_year'=>$current_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$xtotalExp,'totalEst'=>$xtotalEst]);
}
public function getDashboardFinancialsDeptwise(Request $request)
{
	$sector_id = $request->input('sector_id');
	$sector = Sector::find($sector_id);
		//$schemes= Scheme::all();
	$current_month = date('m');
	$current_year = date('Y');
	$current_month_exp =0;
	if($current_month <4){
		$est_end_year = date('Y');
		$current_year = date('Y', strtotime('-1 year'));
	}else{
		$est_end_year = date('Y', strtotime('+1 year'));
	}
	
	$allDepts = array();
	$xtotalExp =array();
	$xtotalEst =array();

	
	
	$subsectors = $sector->subsectors()->get();
	foreach ($subsectors as $subsector) {
	 $departments = $subsector->departments()->get();
	 foreach ($departments as $department) {
		array_push($allDepts, $department);
		$totalEst = 0;
		$totalExp =0;
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
						 $totalEst += $re->revenue + $re->capital + $re->loan;
					 }
				 }
				 else{
					$budgetEstimate = $estimate->budgetEstimates()->get();
					if(count($budgetEstimate)){
						foreach ($budgetEstimate as $be) {
						 $totalEst += $be->revenue + $be->capital + $be->loan;
					 }
				 }
			 }

			 $expenditures = $scheme->expenditures()->get();
			 foreach ($expenditures as $exp) {
				$year_exp =  explode('-',$exp->exp_year);
									// print_r($year_exp);
				$concerned_year = $year_exp[1];
				$concerned_month =  $year_exp[0];
				if(date('m') < 4){
					if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
						$totalExp += $exp->revenue + $exp->capital + $exp->loan;
						if($current_month ==$concerned_month ){
							$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
						}
					}
				}
				else{
					if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
						$totalExp += $exp->revenue + $exp->capital + $exp->loan;
						if($current_month ==$concerned_month ){
							$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
						}
					}
				}
				// if($current_year == $concerned_year){
				// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
				// 	if($current_month ==$concerned_month ){
				// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
				// 	}
				// }
				
			}
		}
		
	}
}
array_push($xtotalExp,$totalExp/100) ;
array_push($xtotalEst,$totalEst/100) ;
}
}





return response()->json(['departments'=>$allDepts,'current_year'=>$current_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$xtotalExp,'totalEst'=>$xtotalEst]);
}

public function getDashboardFinancialsSchemewise(Request $request)
{
	$dept_id = $request->input('dept_id');
	$department = Department::find($dept_id);
		//$schemes= Scheme::all();
	$current_month = date('m');
	$current_year = date('Y');
	$current_month_exp =0;
	if($current_month <4){
		$est_end_year = date('Y');
		$current_year = date('Y', strtotime('-1 year'));
	}else{
		$est_end_year = date('Y', strtotime('+1 year'));
	}
	
	$allSchemes= array();
	$xtotalExp =array();
	$xtotalEst =array();

	
	$units = $department->units()->get();
	foreach ($units as $unit) {
		$schemes= $unit->schemes()->get();
		foreach ($schemes as $scheme) {
			array_push($allSchemes, $scheme);
			$totalEst = 0;
			$totalExp =0;
			$estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
			if(!empty($estimate)){
				$revisedEstimate = $estimate->revisedEstimates()->get();

				if(count($revisedEstimate)){
									// print_r($revisedEstimate);
					foreach ($revisedEstimate as $re) {
					 $totalEst += $re->revenue + $re->capital + $re->loan;
				 }
			 }
			 else{
				$budgetEstimate = $estimate->budgetEstimates()->get();
				if(count($budgetEstimate)){
					foreach ($budgetEstimate as $be) {
					 $totalEst += $be->revenue + $be->capital + $be->loan;
				 }
			 }
		 }

		 $expenditures = $scheme->expenditures()->get();
		 foreach ($expenditures as $exp) {
			$year_exp =  explode('-',$exp->exp_year);
									// print_r($year_exp);
			$concerned_year = $year_exp[1];
			$concerned_month =  $year_exp[0];
			if(date('m') < 4){
				if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
					$totalExp += $exp->revenue + $exp->capital + $exp->loan;
					if($current_month ==$concerned_month ){
						$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
					}
				}
			}
			else{
				if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
					$totalExp += $exp->revenue + $exp->capital + $exp->loan;
					if($current_month ==$concerned_month ){
						$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
					}
				}
			}
			// if($current_year == $concerned_year){
			// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
			// 	if($current_month ==$concerned_month ){
			// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
			// 	}
			// }

		}
	}
	array_push($xtotalExp,$totalExp/100) ;
	array_push($xtotalEst,$totalEst/100) ;
}
}






return response()->json(['schemes'=>$allSchemes,'current_year'=>$current_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$xtotalExp,'totalEst'=>$xtotalEst]);
}
public function getDeptFinancials(Request $request)
{
	$dept_id = $request->input('dept_id');
	$department =  Department::find($dept_id) ;
	$units = $department->units()->get();
	foreach ($units as $unit) {
		$schemes= $unit->schemes()->get();
		
	}
	$current_month = date('m');
	$current_year = date('Y');
	$current_month_exp =0;
	if($current_month <4){
		$est_end_year = date('Y');
		$current_year = date('Y', strtotime('-1 year'));
	}else{
		$est_end_year = date('Y', strtotime('+1 year'));

	}
	$totalEst = 0;
	$totalExp =0;
	foreach ($schemes as $scheme) {
	   
		$estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
		if(isset($estimate)){
			$revisedEstimate = $estimate->revisedEstimates()->get();
			if(count($revisedEstimate)){
				foreach ($revisedEstimate as $re) {
				 $totalEst += $re->revenue + $re->capital + $re->loan;
			 }
		 }else{
			$budgetEstimate = $estimate->budgetEstimates()->get();
			if(count($budgetEstimate)){
				foreach ($budgetEstimate as $be) {
				 $totalEst += $be->revenue + $be->capital + $be->loan;
			 }
		 }
	 }

	 $expenditures = $scheme->expenditures()->get();
	 foreach ($expenditures as $exp) {
		$year_exp =  explode('-',$exp->exp_year);
		$concerned_year = $year_exp[1];
		$concerned_month =  $year_exp[0];
		if(date('m') < 4){
			if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
				$totalExp += $exp->revenue + $exp->capital + $exp->loan;
				if($current_month ==$concerned_month ){
					$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
				}
			}
		}
		else{
			if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
				$totalExp += $exp->revenue + $exp->capital + $exp->loan;
				if($current_month ==$concerned_month ){
					$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
				}
			}
		}
		// if($current_year == $concerned_year){
		// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
		// 	if($current_month ==$concerned_month ){
		// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
		// 	}
		// }
		
	}
}

}
return response()->json(['deptName'=> $department->name,'current_year'=>$current_year,'current_month_exp'=>$current_month_exp/100,'totalExp'=>$totalExp/100,'totalEst'=>$totalEst/100]);
}
public function getSectorFinancials(Request $request)
{
	$schemes = array();
	$sector_id = $request->input('sector_id');
	$sector = Sector::find($sector_id);
	$subsectors = $sector->subsectors()->get();
	foreach ($subsectors as $subsector) {
		$departments = $subsector->departments()->get();
		foreach ($departments as $department) {
			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes= $unit->schemes()->get();
			}
		}
	}
	
	
	$current_month = date('m');
	$current_year = date('Y');
	$current_month_exp =0;
	if($current_month <4){
		$est_end_year = date('Y');
		$current_year = date('Y', strtotime('-1 year'));
	}else{
		$est_end_year = date('Y', strtotime('+1 year'));

	}
	$totalEst = 0;
	$totalExp =0;
	foreach ($schemes as $scheme) {

		$estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
		if(isset($estimate)){
			$revisedEstimate = $estimate->revisedEstimates()->get();
			if(count($revisedEstimate)){
				foreach ($revisedEstimate as $re) {
				 $totalEst += $re->revenue + $re->capital + $re->loan;
			 }
		 }else{
			$budgetEstimate = $estimate->budgetEstimates()->get();
			if(count($budgetEstimate)){
				foreach ($budgetEstimate as $be) {
				 $totalEst += $be->revenue + $be->capital + $be->loan;
			 }
		 }
	 }

	 $expenditures = $scheme->expenditures()->get();
	 foreach ($expenditures as $exp) {
		$year_exp =  explode('-',$exp->exp_year);
		$concerned_year = $year_exp[1];
		$concerned_month =  $year_exp[0];
		if(date('m') < 4){
			if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
				$totalExp += $exp->revenue + $exp->capital + $exp->loan;
				if($current_month ==$concerned_month ){
					$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
				}
			}
		}
		else{
			if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
				$totalExp += $exp->revenue + $exp->capital + $exp->loan;
				if($current_month ==$concerned_month ){
					$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
				}
			}
		}
		// if($current_year == $concerned_year){
		// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
		// 	if($current_month ==$concerned_month ){
		// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
		// 	}
		// }
		
	}
}

}
return response()->json(['sector_name'=>$sector->name,'current_year'=>$current_year,'current_month_exp'=>$current_month_exp/100,'totalExp'=>$totalExp/100,'totalEst'=>$totalEst/100]);
}
public function getDashboardCounts(Request $request)
{
	//return $request;die();
	$finYear = $request->input('finYear');
	$getYear=explode('-',$finYear);
	//print_r($getYear);
	$current_begin_date = $getYear[0].'-04-01';
    $current_end_date ="20".$getYear[1].'-03-31';
    $na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$nr=0;
	$instatus=0;
	$schemesCount=0;

	$allOfftrackOutputIndicators =array();
	$allOfftrackOutcomeIndicators = array();

	if(auth()->user()->department_id){

		$dept_id = auth()->user()->department_id;
		$department =  Department::find($dept_id) ;
		
		$units = $department->units()->get();
		

		//return 
		foreach ($units as $unit) {
			$schemes = $unit->schemes()->get();
			//$estimates = $scheme->estimates()->get();
			foreach ($schemes as $scheme) {
				$objectives = $scheme->objectives()->get();
				$schemesCount += 1;
				foreach ($objectives as $objective) {
					$outputs = $objective->outputs()->get();
					foreach ($outputs as $output) {
						$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
						$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
						if(count($offtrackOutput)>0){
							array_push($allOfftrackOutputIndicators, $offtrackOutput);
						}
						foreach ($outputIndicators as $outputIndicator) {
							if($outputIndicator->status == 1){
								$na += 1;
								
							}else if($outputIndicator->status == 2){
							   $ontrack += 1;

						   }else if($outputIndicator->status == 3){
							  $offtrack += 1;
							  

						  }else if($outputIndicator->status == 4){
							$inProgess += 1;
						}
					}
					$outcomes = $output->outcomes()->get();
					foreach ($outcomes as $outcome) {
						$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
						$offtrackOutput = $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
						if(count($offtrackOutput)>0){
							array_push($allOfftrackOutcomeIndicators, $offtrackOutput);
						}
						foreach ($outcomeIndicators as $outcomeIndicator) {
						   	if($outcomeIndicator->status == 1){
								$na += 1;
							}
							else if($outcomeIndicator->status == 2){
						  		$ontrack += 1;
					  		}
					  		else if($outcomeIndicator->status == 3){
								$offtrack += 1;
							}
							else if($outcomeIndicator->status == 4){
								$inProgess += 1;
							}
						}
					}
				}
			}
		}
	}
	$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
	
	}
	else{
//$schemesCount
	   //$schemes = Scheme::where([['start_date', '>=', $current_begin_date],['start_date', '<=', $current_end_date]])->get();//count(Scheme::all());
		$schemes = Scheme::where([['start_date', '<=', $current_end_date]])->get();
	   //return $schemes;die();
	   //////////////////////////////////////////////////////////////////////

	   foreach ($schemes as $scheme) {
				$objectives = $scheme->objectives()->get();
				$schemesCount += 1;
				foreach ($objectives as $objective) {
					$outputs = $objective->outputs()->get();
					foreach ($outputs as $output) {
						$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
						//print_r($outputIndicators);die();
						$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
						if(count($offtrackOutput)>0){
							array_push($allOfftrackOutputIndicators, $offtrackOutput);
						}
						foreach ($outputIndicators as $outputIndicator) {
							if($outputIndicator->status == 1){
								$na += 1;
								
							}else if($outputIndicator->status == 2){
							   $ontrack += 1;

						   }else if($outputIndicator->status == 3){
							  $offtrack += 1;
							  

						  }else if($outputIndicator->status == 4){
							$inProgess += 1;
						}else if($outputIndicator->status == 0){
							$instatus += 1;
							}
					}
					$outcomes = $output->outcomes()->get();
					foreach ($outcomes as $outcome) {
						$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
						$offtrackOutput = $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
						if(count($offtrackOutput)>0){
							array_push($allOfftrackOutcomeIndicators, $offtrackOutput);
						}
						foreach ($outcomeIndicators as $outcomeIndicator) {
						   	if($outcomeIndicator->status == 1){
								$na += 1;
							}
							else if($outcomeIndicator->status == 2){
						  		$ontrack += 1;
					  		}
					  		else if($outcomeIndicator->status == 3){
								$offtrack += 1;
							}
							else if($outcomeIndicator->status == 4){
								$inProgess += 1;
							}else if($outcomeIndicator->status == 0){
							$instatus += 1;
							}
						}
					}
				}
			}
		}
		$totalIndicators = $na + $ontrack + $offtrack + $inProgess+$instatus;
	   //////////////////////////////////////////////////////////////////////


	   //$outputIndicators =  Outputindicator::where('name', '!=', '.')->get();
	   //$outcomeIndicators =  Outcomeindicator::where('name', '!=', '.')->get();
	   $allOfftrackInds = array();
	   //$totalIndicators = count($outputIndicators) + count($outcomeIndicators);
	   $allOfftrackOutputIndicators = Outputindicator::where([ ['status',3], ['name', '!=', '.'] ])->get();
	   $allOfftrackOutcomeIndicators = Outcomeindicator::where([ ['status',3], ['name', '!=', '.'] ])->get();
	   
	   //print_r($outputIndicators);die();

	   /*$na = count(Outputindicator::where([ ['status',1], ['name', '!=', '.'] ])->get()) + count(Outcomeindicator::where([ ['status',1], ['name', '!=', '.'] ])->get()) ;
	   $ontrack = count(Outputindicator::where([ ['status',2], ['name', '!=', '.'] ])->get()) + count(Outcomeindicator::where([ ['status',2], ['name', '!=', '.'] ])->get()) ;

	   $offtrack = count(Outputindicator::where([ ['status',3], ['name', '!=', '.'] ])->get()) + count(Outcomeindicator::where([ ['status',3], ['name', '!=', '.'] ])->get()) ;
	   $inProgess = count(Outputindicator::where([ ['status',4], ['name', '!=', '.'] ])->get()) + count(Outcomeindicator::where([ ['status',4], ['name', '!=', '.'] ])->get()) ;*/
   	}

   return response()->json(['schemesCount'=>$schemesCount,'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}


public function getIndicatorDataMain(Request $request)
{
	//return $request;die();
   $indicator_type = $request->input('indicator_type');
   $indicator_id = $request->input('indicator_id');
   if($indicator_type == 'outcome'){
   	$indicator = Outcomeindicator::find($indicator_id);
   }else if($indicator_type == 'output'){
   	$indicator = Outputindicator::find($indicator_id);
   }else{
   		$indicator ='';
   }
   
   if(isset($indicator->id)){
   		$status_id = $indicator->status;
   		if($status_id == 1){
   			$status = 'NA';
   		}else if($status_id == 2){
   			$status = 'On Track';

   		}else if($status_id == 3){
   			$status = 'Off Track';
   			
   		}else if($status_id == 4){
   			//$status = 'In progress';
   			$status = 'NR';
   			
   		}else{
   			$status = 'In progress';
   		}
   		$result_actionpoints = array();
   		if($indicator_type == 'outcome'){
   			$baseline = $indicator->outcomeBaselines()->first();
   			if(date('m')<4){
   				$today = date('Y-m-d', strtotime('-1 years'));
   			}
   			else{
   				$today = date('Y-m-d');
   			}
            $return_target = Outcometarget::where([
									['end_date','>=',$today],
									['outcomeindicator_id', $indicator->id]
								])
        						->first();

            $achivements=array();
        	if(isset($return_target) && $return_target!=''){
        		$achivements =$return_target->outcomeAchievements()->get();
        	}

                        $cummulativeAchieve = 0 ;
                         if(isset($achivements) && count($achivements)>0){
                           foreach ($achivements as $achievementItem) {
                           	//print_r($achievementItem->description);
                           	if(is_int($achievementItem->description)){
                           		$cummulativeAchieve += $achievementItem->description;
                           	}else{
                           		$cummulativeAchieve = $achievementItem->description;
                           	}
                          
                        }
                    }
                    //     if(isset($achivements) && count($achivements)>0){
                    //        foreach ($achivements as $achievementItem) {
                    //       $cummulativeAchieve += $achievementItem->description;
                    //     }
                    // }
		   	$targets = $indicator->outcomeTargets()->get();
   		foreach ($targets as $target) {
   			$outcomeAchievements = $target->outcomeAchievements()->get();
   			foreach ($outcomeAchievements as $outcomeAchievement) {
   				$reviews = $outcomeAchievement->reviews()->get();
   				foreach ($reviews as $review) {
	   					$actions = $review->actionpoints()->get();
	   					
	   					array_push($result_actionpoints, $actions);
	   				}
	   			}
	   		}
		 }else if($indicator_type == 'output'){

   			$baseline = $indicator->baselines()->first();
		   	$targets = $indicator->outputTargets()->get();

   			if(date('m')<4){
   				$today = date('Y-m-d', strtotime('-1 years'));
   			}
   			else{
   				$today = date('Y-m-d');
   			}
            // $return_target = Outputtarget::where('end_date','>=',$today)->first();
            $return_target = Outputtarget::where([
									['end_date','>=',$today],
									['outputindicator_id',$indicator->id]// $indicator->id
								])
        						->first();

        	//return $return_target;die();
        	//$return_target_count = $return_target->count();
        	//echo $return_target_count;die();					
        	$achivements=array();
        	if(isset($return_target) && $return_target!=''){
        		$achivements = $return_target->achievements()->get();
        	}		
        	//print_r($targets);die();
            //print_r($achivements);die();
                        $cummulativeAchieve = 0 ;
                        if(isset($achivements) && count($achivements)>0){
                           foreach ($achivements as $achievementItem) {
                           	//print_r($achievementItem->description);
                           	if(is_int($achievementItem->description)){
                           		$cummulativeAchieve += $achievementItem->description;
                           	}else{
                           		$cummulativeAchieve = $achievementItem->description;
                           	}
                          
                        }
                    }
        //echo $cummulativeAchieve;die();
        //print_r($targets);die();
   		foreach ($targets as $target) {
	   			$outcomeAchievements = $target->achievements()->get();
	   			//return $outcomeAchievements;die();
	   			foreach ($outcomeAchievements as $outcomeAchievement) {
	   				$reviews = $outcomeAchievement->reviews()->get();
	   				foreach ($reviews as $review) {
	   					$actions = $review->actionpoints()->get();
	   					
	   					array_push($result_actionpoints, $actions);
	   				}
	   			}
	   		}


		}

   		
   }else{
   		$actionpoints='';
   }
   $return_action =array();
   	foreach ($result_actionpoints as $key => $value) {
   		foreach ($result_actionpoints[$key] as $action) {
   			array_push($return_action,[
   			$action->description]
   		);
   		}
   		
   	}
   	//$result_actionpoints = array();

   return response()->json(['indicator_name'=>$indicator->name,'indicator_type'=>$indicator_type,'baseline'=>$baseline,'target'=>$return_target,'achievement'=>$cummulativeAchieve,'status'=>$status,'indicator'=>$indicator,'actionpoints'=>$return_action]);

}

public function getDashboardCountsCritical(Request $request)
{
	  # code...
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$nr=0;
	$schemesCount=0;

	$allOfftrackOutputIndicators =array();
	$allOfftrackOutcomeIndicators = array();

	$finYear = $request->input('finYear');
	$getYear=explode('-',$finYear);
	//print_r($getYear);
	$current_begin_date = $getYear[0].'-04-01';
	$current_end_date ="20".$getYear[1].'-03-31';
	$schemes = Scheme::where([['start_date', '<=', $current_end_date]])->get();

	foreach ($schemes as $scheme) {
				$objectives = $scheme->objectives()->get();
				$schemesCount += 1;
				foreach ($objectives as $objective) {
					$outputs = $objective->outputs()->get();
					//return $outputs;die();
					foreach ($outputs as $output) {
						$outputIndicators = $output->outputIndicators()->where([['is_critical', 1], ['name', '!=', '.']] )->get();
						
						$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
						if(count($offtrackOutput)>0){
							array_push($allOfftrackOutputIndicators, $offtrackOutput);
						}
						if(count($outputIndicators)>0){
							foreach ($outputIndicators as $outputIndicator) {
									if($outputIndicator->status == 1){
										$na += 1;
										
									}else if($outputIndicator->status == 2){
									   $ontrack += 1;

								   }else if($outputIndicator->status == 3){
									  $offtrack += 1;
									  

								  }else if($outputIndicator->status == 4){
									$inProgess += 1;
								}
							}
						}
						
					$outcomes = $output->outcomes()->get();
					foreach ($outcomes as $outcome) {
						$outcomeIndicators = $outcome->outcomeIndicators()->where([ ['is_critical', 1], ['name', '!=', '.'] ])->get();
						$offtrackOutput = $outcome->outcomeIndicators()->where([ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ])->get();
						if(count($offtrackOutput)>0){
							array_push($allOfftrackOutcomeIndicators, $offtrackOutput);
						}
						if(count($outcomeIndicators)>0){
							foreach ($outcomeIndicators as $outcomeIndicator) {
							   	if($outcomeIndicator->status == 1){
									$na += 1;
								}
								else if($outcomeIndicator->status == 2){
							  		$ontrack += 1;
						  		}
						  		else if($outcomeIndicator->status == 3){
									$offtrack += 1;
								}
								else if($outcomeIndicator->status == 4){
									$inProgess += 1;
								}
							}
						}
					}
				}
			}
		}
		$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
/*
  $schemesCount = count(Scheme::all());
  $outputIndicators =  Outputindicator::where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
  $outcomeIndicators =  Outcomeindicator::where([ ['is_critical', 1], ['name', '!=', '.'] ])->get();
  $allOfftrackInds = array();
  $totalIndicators = count($outputIndicators) + count($outcomeIndicators);
  $allOfftrackOutputIndicators = Outputindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
  $allOfftrackOutcomeIndicators = Outcomeindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
  


  $na = count(Outputindicator::where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) + count(Outcomeindicator::where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) ;
  $ontrack = count(Outputindicator::where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) + count(Outcomeindicator::where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) ;
  
  $offtrack = count(Outputindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) + count(Outcomeindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) ;
  $inProgess = count(Outputindicator::where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) + count(Outcomeindicator::where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->get()) ;*/

  return response()->json(['schemesCount'=>$schemesCount,'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}

public function getDashboardCountsSector(Request $request)
{
	$sector_id = $request->input('sector_id');
	$sector =  Sector::find($sector_id) ;
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$schemesCount=0;
	$allOfftrackOutputIndicators = array();
	$allOfftrackOutcomeIndicators =array();
	$subsectors =  $sector->subsectors()->get();
	foreach ($subsectors as $subsector) {
		$departments = $subsector->departments()->get();
		foreach ($departments as $department) {
			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes = $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$objectives = $scheme->objectives()->get();
					$schemesCount += 1;
					foreach ($objectives as $objective) {
						


						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
							$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
							if(count($offtrackOutput)>0){
								array_push($allOfftrackOutputIndicators, $offtrackOutput);
							}
							foreach ($outputIndicators as $outputIndicator) {
								if($outputIndicator->status == 1){
									$na += 1;
									
								}else if($outputIndicator->status == 2){
								   $ontrack += 1;
								   
							   }else if($outputIndicator->status == 3){
								  $offtrack += 1;


							  }else if($outputIndicator->status == 4){
								$inProgess += 1;
							}
						}
						$outcomes = $output->outcomes()->get();


						foreach ($outcomes as $outcome) {
							$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
							$offtrackOutput = $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
							if(count($offtrackOutput)>0){
								array_push($allOfftrackOutcomeIndicators, $offtrackOutput);
							}
							foreach ($outcomeIndicators as $outcomeIndicator) {
							   if($outcomeIndicator->status == 1){
								$na += 1;
							}else if($outcomeIndicator->status == 2){
							  $ontrack += 1;
						  }else if($outcomeIndicator->status == 3){
							$offtrack += 1;
						}else if($outcomeIndicator->status == 4){
							$inProgess += 1;
						}
					}
				}
			}
		}
	}
}
}
}   
$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
return response()->json(['sector'=>$sector,'schemesCount'=>$schemesCount,'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}

public function getDashboardCountsSectorCritical(Request $request)
{
	$sector_id = $request->input('sector_id');
	$sector =  Sector::find($sector_id) ;
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$schemesCount=0;
	$allOfftrackOutputIndicators = Outputindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
	$allOfftrackOutcomeIndicators = Outcomeindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();

	$subsectors =  $sector->subsectors()->get();
	foreach ($subsectors as $subsector) {
		$departments = $subsector->departments()->get();
		foreach ($departments as $department) {
			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes = $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$objectives = $scheme->objectives()->get();
					$schemesCount += 1;
					foreach ($objectives as $objective) {
						


						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							$outputIndicators = $output->outputIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
							foreach ($outputIndicators as $outputIndicator) {
								if($outputIndicator->status == 1){
									$na += 1;
									
								}else if($outputIndicator->status == 2){
								   $ontrack += 1;
								   
							   }else if($outputIndicator->status == 3){
								  $offtrack += 1;
								  

							  }else if($outputIndicator->status == 4){
								$inProgess += 1;
							}
						}
						$outcomes = $output->outcomes()->get();


						foreach ($outcomes as $outcome) {
							$outcomeIndicators = $outcome->outcomeIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
							foreach ($outcomeIndicators as $outcomeIndicator) {
							   if($outcomeIndicator->status == 1){
								$na += 1;
							}else if($outcomeIndicator->status == 2){
							  $ontrack += 1;
						  }else if($outcomeIndicator->status == 3){
							$offtrack += 1;
						}else if($outcomeIndicator->status == 4){
							$inProgess += 1;
						}
					}
				}
			}
		}
	}
}
}
}   
$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
return response()->json(['sector'=>$sector,'schemesCount'=>$schemesCount,'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);
}

public function getDashboardCountsDepart(Request $request)
{
	$dept_id = $request->input('dept_id');
	$department =  Department::find($dept_id) ;
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$schemesCount=0;
	$allOfftrackOutputIndicators =array();
	$allOfftrackOutcomeIndicators = array();
	$units = $department->units()->get();
	foreach ($units as $unit) {
		$schemes = $unit->schemes()->get();
		foreach ($schemes as $scheme) {
			$objectives = $scheme->objectives()->get();
			$schemesCount += 1;
			foreach ($objectives as $objective) {
				


				$outputs = $objective->outputs()->get();
				foreach ($outputs as $output) {
					$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
					$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
							if(count($offtrackOutput)>0){
								array_push($allOfftrackOutputIndicators, $offtrackOutput);
							}

					foreach ($outputIndicators as $outputIndicator) {
						if($outputIndicator->status == 1){
							$na += 1;
							
						}else if($outputIndicator->status == 2){
						   $ontrack += 1;

					   }else if($outputIndicator->status == 3){
						  $offtrack += 1;
						  

					  }else if($outputIndicator->status == 4){
						$inProgess += 1;
					}
				}
				$outcomes = $output->outcomes()->get();


				foreach ($outcomes as $outcome) {
					$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
					$offtrackOutput = $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
							if(count($offtrackOutput)>0){
								array_push($allOfftrackOutcomeIndicators, $offtrackOutput);
							}

					foreach ($outcomeIndicators as $outcomeIndicator) {
					   if($outcomeIndicator->status == 1){
						$na += 1;
					}else if($outcomeIndicator->status == 2){
					  $ontrack += 1;
				  }else if($outcomeIndicator->status == 3){
					$offtrack += 1;
				}else if($outcomeIndicator->status == 4){
					$inProgess += 1;
				}
			}
		}
	}
}
}
}

$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
return response()->json(['department'=>$department,'schemesCount'=>$schemesCount,'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}


public function getDashboardCountsScheme(Request $request)
{
	$scheme_id = $request->input('scheme_id');
	$scheme =  Scheme::find($scheme_id) ;
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$schemesCount=0;
	$allOfftrackOutputIndicators= array();
	$allOfftrackOutcomeIndicators = array();

	// $allOfftrackOutputIndicators = Outputindicator::where([ ['status',3], ['name', '!=', '.'] ])->get();
	// $allOfftrackOutcomeIndicators = Outcomeindicator::where([ ['status',3], ['name', '!=', '.'] ])->get();
	$objectives = $scheme->objectives()->get();
	$schemesCount += 1;
	foreach ($objectives as $objective) {
		$outputs = $objective->outputs()->get();
		foreach ($outputs as $output) {
			$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
			$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
							if(count($offtrackOutput)>0){
								array_push($allOfftrackOutputIndicators, $offtrackOutput);
							}
			foreach ($outputIndicators as $outputIndicator) {
				if($outputIndicator->status == 1){
					$na += 1;

				}else if($outputIndicator->status == 2){
				   $ontrack += 1;

			   }else if($outputIndicator->status == 3){
				  $offtrack += 1;


			  }else if($outputIndicator->status == 4){
				$inProgess += 1;
			}
		}
		$outcomes = $output->outcomes()->get();


		foreach ($outcomes as $outcome) {
			$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
			$offtrackOutput = $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->get();
							if(count($offtrackOutput)>0){
								array_push($allOfftrackOutcomeIndicators, $offtrackOutput);
							}

			foreach ($outcomeIndicators as $outcomeIndicator) {
			   if($outcomeIndicator->status == 1){
				$na += 1;
			}else if($outcomeIndicator->status == 2){
			  $ontrack += 1;
		  }else if($outcomeIndicator->status == 3){
			$offtrack += 1;
		}else if($outcomeIndicator->status == 4){
			$inProgess += 1;
		}
	}
}
}
}                
$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
return response()->json(['schemeName' => $scheme->name, 'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}




public function getDashboardCountsDepartCritical(Request $request)
{
	$dept_id = $request->input('dept_id');
	$department =  Department::find($dept_id) ;
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$schemesCount=0;

	$allOfftrackOutputIndicators = Outputindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
	$allOfftrackOutcomeIndicators = Outcomeindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
	
	$units = $department->units()->get();
	foreach ($units as $unit) {
		$schemes = $unit->schemes()->get();
		foreach ($schemes as $scheme) {
			$objectives = $scheme->objectives()->get();
			$schemesCount += 1;
			foreach ($objectives as $objective) {
				


				$outputs = $objective->outputs()->get();
				foreach ($outputs as $output) {
					$outputIndicators = $output->outputIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
					foreach ($outputIndicators as $outputIndicator) {
						if($outputIndicator->status == 1){
							$na += 1;
							
						}else if($outputIndicator->status == 2){
						   $ontrack += 1;
						   
					   }else if($outputIndicator->status == 3){
						  $offtrack += 1;


					  }else if($outputIndicator->status == 4){
						$inProgess += 1;
					}
				}
				$outcomes = $output->outcomes()->get();


				foreach ($outcomes as $outcome) {
					$outcomeIndicators = $outcome->outcomeIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
					foreach ($outcomeIndicators as $outcomeIndicator) {
					   if($outcomeIndicator->status == 1){
						$na += 1;
					}else if($outcomeIndicator->status == 2){
					  $ontrack += 1;
				  }else if($outcomeIndicator->status == 3){
					$offtrack += 1;
				}else if($outcomeIndicator->status == 4){
					$inProgess += 1;
				}
			}
		}
	}
}
}
}

$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
return response()->json(['department'=>$department,'schemesCount'=>$schemesCount,'indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}


public function getDashboardCountsSchemeCritical(Request $request)
{


	$scheme_id = $request->input('scheme_id');
	$scheme =  Scheme::find($scheme_id) ;
	$na =0;
	$ontrack=0;
	$offtrack=0;
	$inProgess=0;
	$schemesCount=0;
	$allOfftrackOutputIndicators= array();
	$allOfftrackOutcomeIndicators = array();

	// $allOfftrackOutputIndicators = Outputindicator::where([ ['status',3], ['name', '!=', '.'] ])->get();
	// $allOfftrackOutcomeIndicators = Outcomeindicator::where([ ['status',3], ['name', '!=', '.'] ])->get();
	$objectives = $scheme->objectives()->get();
	$schemesCount += 1;
	foreach($objectives as $objective) {
		$outputs = $objective->outputs()->get();
		foreach ($outputs as $output) {
			$outputIndicators = $output->outputIndicators()->where([ ['name', '!=', '.'], ['is_critical', 1] ])->get();
			$offtrackOutput =  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'], ['is_critical', 1] ])->get();
			if( count( $offtrackOutput ) > 0){
				array_push($allOfftrackOutputIndicators, $offtrackOutput);
			}
			foreach ($outputIndicators as $outputIndicator) {
				if($outputIndicator->status == 1){
					$na += 1;

				}else if($outputIndicator->status == 2){
				   $ontrack += 1;

			   }else if($outputIndicator->status == 3){
				  $offtrack += 1;


			  }else if($outputIndicator->status == 4){
				$inProgess += 1;
			}
		}
		$outcomes = $output->outcomes()->get();


		foreach ($outcomes as $outcome) {
			$outcomeIndicators = $outcome->outcomeIndicators()->where( [ ['name', '!=', '.'], ['is_critical', 1] ] )->get();
			$offtrackOutcome = $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'], ['is_critical', 1] ])->get();
				if(count($offtrackOutcome)>0){
					array_push($allOfftrackOutcomeIndicators, $offtrackOutcome);
				}

			foreach ($outcomeIndicators as $outcomeIndicator) {
			   if($outcomeIndicator->status == 1){
				$na += 1;
			}else if($outcomeIndicator->status == 2){
			  $ontrack += 1;
		  }else if($outcomeIndicator->status == 3){
			$offtrack += 1;
		}else if($outcomeIndicator->status == 4){
			$inProgess += 1;
		}
	}
}
}
}                
$totalIndicators = $na + $ontrack + $offtrack + $inProgess;
return response()->json(['indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

	##############################################################



// 	$scheme_id = $request->input('scheme_id');
// 	$scheme =  Scheme::find($scheme_id) ;
// 	$na =0;
// 	$ontrack=0;
// 	$offtrack=0;
// 	$inProgess=0;
// 	$schemesCount=0;

// 	$allOfftrackOutputIndicators = Outputindicator::where( [ ['status',3], ['is_critical', 1] ], ['name', '!=', '.'] )->get();
// 	$allOfftrackOutcomeIndicators = Outcomeindicator::where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->get();
	
	
// 	$objectives = $scheme->objectives()->get();
// 	$schemesCount += 1;
// 	foreach ($objectives as $objective) {
		


// 		$outputs = $objective->outputs()->get();
// 		foreach ($outputs as $output) {
// 			$outputIndicators = $output->outputIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
// 			foreach ($outputIndicators as $outputIndicator) {
// 				if($outputIndicator->status == 1){
// 					$na += 1;

// 				}else if($outputIndicator->status == 2){
// 				   $ontrack += 1;

// 			   }else if($outputIndicator->status == 3){
// 				  $offtrack += 1;


// 			  }else if($outputIndicator->status == 4){
// 				$inProgess += 1;
// 			}
// 		}
// 		$outcomes = $output->outcomes()->get();


// 		foreach ($outcomes as $outcome) {
// 			$outcomeIndicators = $outcome->outcomeIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
// 			foreach ($outcomeIndicators as $outcomeIndicator) {
// 			   if($outcomeIndicator->status == 1){
// 				$na += 1;
// 			}else if($outcomeIndicator->status == 2){
// 			  $ontrack += 1;
// 		  }else if($outcomeIndicator->status == 3){
// 			$offtrack += 1;
// 		}else if($outcomeIndicator->status == 4){
// 			$inProgess += 1;
// 		}
// 	}
// }
// }
// }                
// $totalIndicators = $na + $ontrack + $offtrack + $inProgess;
// return response()->json(['indicatorsCount'=>$totalIndicators,'na'=>$na,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inProgess'=>$inProgess,'allOfftrackOutputIndicators'=>$allOfftrackOutputIndicators,'allOfftrackOutcomeIndicators'=>$allOfftrackOutcomeIndicators]);

}




public function getChartDataMain() {
   $lables =array();
   $sectors = Sector::all();
   $xtotalIndicators =array();
   $xtotalNa = array();
   $xontrack =array();
   $xofftrack =array();
   $xinprogress =array();

   $totalIndicators =array();
   $totalNa =array();
   $ontrack =array();
   $offtrack =array();
   $inprogress =array();
   $na_all_arr = array();
	$off_all_arr = array();
	$on_all_arr = array();
	$prog_all_arr = array();


	 

	 
	$departments = Department::all();
		foreach ($departments as $department) {

		$totalIndicatorscount=0;
	  $totalNaCount=0;
	  $totalOntrackCount=0;
	  $totalOfftrackCount=0;
	  $totalInprogressCount=0;
	  if(strlen($department->name) > 25){
	  	array_push($lables, substr($department->name, 0, 25).'...');
	  }
	  else{
	  	array_push($lables, $department->name);
	  }

		   $units = $department->units()->get();
		   foreach ($units as $unit) {
			   $schemes = $unit->schemes()->get();
			   foreach ($schemes as $scheme) {
				  $objectives = $scheme->objectives()->get();
				  foreach ($objectives as $objective) {
					 


					 $outputs = $objective->outputs()->get();
					 foreach ($outputs as $output) {
						$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
						$totalIndicatorscount += count($outputIndicators);
						$totalNaCount +=  $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
						$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
						$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
						$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

						$outcomes = $output->outcomes()->get();


						foreach ($outcomes as $outcome) {
						 $outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
						 $totalIndicatorscount += count($outcomeIndicators);
						 $totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
						 $totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
						 $totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
						 $totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
						 
					 }
					 
				 }
				 
			 }

		 }
	 }

// $na_one_arr = ['y':$totalNaCount, 'label':$department->name];
$na_one_arr['y'] = $totalNaCount;
$na_one_arr['label']=$department->name;

$on_one_arr['y'] = $totalOntrackCount;
$on_one_arr['label']=$department->name;

$off_one_arr['y'] = $totalOfftrackCount;
$off_one_arr['label']=$department->name;

$prog_one_arr['y'] = $totalInprogressCount;
$prog_one_arr['label']=$department->name;


// $off_one_arr = ['y':$totalOfftrackCount,  'label':$department->name];
// $on_one_arr = ['y':$totalOntrackCount,  'label':$department->name];
// $prog_one_arr = ['y':$totalInprogressCount,  'label':$department->name];

array_push($na_all_arr, $na_one_arr);
array_push($off_all_arr, $off_one_arr);
array_push($on_all_arr, $on_one_arr);
array_push($prog_all_arr, $prog_one_arr);

$xtotalIndicators[$department->id] =$totalIndicatorscount;
$xtotalNa[$department->id] =$totalNaCount;
$xontrack[$department->id] =$totalOntrackCount;
$xofftrack[$department->id] =$totalOfftrackCount;
$xinprogress[$department->id] =$totalInprogressCount;



array_push($totalIndicators, $totalIndicatorscount);
array_push($totalNa, $totalNaCount);
array_push($ontrack, $totalOntrackCount);
array_push($offtrack, $totalOfftrackCount);
array_push($inprogress, $totalInprogressCount);
 }//end


$na_all_arr_en = json_encode($na_all_arr);
$on_all_arr_en = json_encode($on_all_arr);
$off_all_arr_en = json_encode($off_all_arr);
$prog_all_arr_en = json_encode($prog_all_arr);

 










return response()->json(['sectors'=>$departments,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack, 'na_all_arr'=>$na_all_arr, 'on_all_arr'=>$on_all_arr, 'off_all_arr'=>$off_all_arr, 'prog_all_arr'=>$prog_all_arr, 'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);
}

public function getChartDataCritical()
{
	  # code...

  $lables =array();
  $sectors = Sector::all();
  $xtotalIndicators =array();
  $xtotalNa = array();
  $xontrack =array();
  $xofftrack =array();
  $xinprogress =array();

  $totalIndicators =array();
  $totalNa =array();
  $ontrack =array();
  $offtrack =array();
  $inprogress =array();

   

	

	
		$departments = Department::all();
		foreach ($departments as $department) {
			$totalIndicatorscount=0;
	$totalNaCount=0;
	$totalOntrackCount=0;
	$totalOfftrackCount=0;
	$totalInprogressCount=0;
	if(strlen($department->name) > 25){
  		array_push($lables, substr($department->name, 0, 25).'...');
  	}
  	else{
  		array_push($lables, $department->name);
  	}
		  $units = $department->units()->get();
		  foreach ($units as $unit) {
			  $schemes = $unit->schemes()->get();
			  foreach ($schemes as $scheme) {
				$objectives = $scheme->objectives()->get();
				foreach ($objectives as $objective) {
				  


				  $outputs = $objective->outputs()->get();
				  foreach ($outputs as $output) {
					$outputIndicators = $output->outputIndicators()->where([ [ 'is_critical', 1], ['name', '!=', '.'] ])->get();
					$totalIndicatorscount += count($outputIndicators);
					$totalNaCount +=  $output->outputIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$totalOntrackCount +=  $output->outputIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$totalOfftrackCount +=  $output->outputIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$totalInprogressCount  +=  $output->outputIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();

					$outcomes = $output->outcomes()->get();


					foreach ($outcomes as $outcome) {
					  $outcomeIndicators = $outcome->outcomeIndicators()->where([ ['is_critical', 1], ['name', '!=', '.'] ])->get();
					  $totalIndicatorscount += count($outcomeIndicators);
					  $totalNaCount += $outcome->outcomeIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					  $totalOntrackCount += $outcome->outcomeIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					  $totalOfftrackCount += $outcome->outcomeIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					  $totalInprogressCount += $outcome->outcomeIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					  
				  }
				  
			  }
			  
		  }

	  }
  }

$xtotalIndicators[$department->id] =$totalIndicatorscount;
$xtotalNa[$department->id] =$totalNaCount;
$xontrack[$department->id] =$totalOntrackCount;
$xofftrack[$department->id] =$totalOfftrackCount;
$xinprogress[$department->id] =$totalInprogressCount;



array_push($totalIndicators, $totalIndicatorscount);
array_push($totalNa, $totalNaCount);
array_push($ontrack, $totalOntrackCount);
array_push($offtrack, $totalOfftrackCount);
array_push($inprogress, $totalInprogressCount);
} //end












return response()->json(['sectors'=>$departments,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);


}



public function getAllSectorsDashboard()
{

	$sectors = Sector::all();
	$allData =array();
	foreach ($sectors as $sector) {
		$allData[$sector->id] = 133;
		
	}

	return response()->json(['sectors'=>$sectors,'allData'=>$allData]);

}




public function getChartDataDept(Request $request)
{
	$dept_id = $request->input('dept_id');
	$lables =array();
	$sectors = Sector::all();
	$allSchemes = array();
	$xtotalIndicators =array();
	$xtotalNa = array();
	$xontrack =array();
	$xofftrack =array();
	$xinprogress =array();


	$totalIndicators =array();
	$totalNa =array();
	$ontrack =array();
	$offtrack =array();
	$inprogress =array();
	$totalIndicatorsSch = array();
	$totalNaSch = array();
	$ontrackSch = array();
	$offtrackSch = array();
	$inprogressSch = array();

	$department= Department::find($dept_id);
	$deptTotalIndCount =0;
	$deptNaCount=0;
	$deptOntrackCount=0;
	$deptOfftrackCount=0;
	$deptInprogressCount=0;
	$units = $department->units()->get();
	foreach ($units as $unit) {
		$schemes = $unit->schemes()->get();
		foreach ($schemes as $scheme) {
			$totalIndicatorscount=0;
			$totalNaCount=0;
			$totalOntrackCount=0;
			$totalOfftrackCount=0;
			$totalInprogressCount=0;

			if(strlen($scheme->name) > 25){
				array_push($lables, substr($scheme->name, 0, 25).'...');
			}
			else{
				array_push($lables, $scheme->name);
			}
			array_push($allSchemes, $scheme);
			$objectives = $scheme->objectives()->get();
			foreach ($objectives as $objective) {
				


				$outputs = $objective->outputs()->get();
				foreach ($outputs as $output) {
					$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
					$totalIndicatorscount += count($outputIndicators);
					$totalNaCount +=  $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
					$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
					$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
					$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

					$deptTotalIndCount += count($outputIndicators);
					$deptNaCount += $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
					$deptOntrackCount +=$output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
					$deptOfftrackCount += $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
					$deptInprogressCount += $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

					$outcomes = $output->outcomes()->get();


					foreach ($outcomes as $outcome) {
						$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get(); 
						
						$totalIndicatorscount += count($outcomeIndicators);
						$deptTotalIndCount += count($outcomeIndicators);
						$totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
						$deptNaCount +=$outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
						$totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
						$deptOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
						$totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
						$deptOfftrackCount +=$outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
						$totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
						$deptInprogressCount +=$outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
						
					}
					
				}
				
			}
			$xtotalIndicators[$scheme->id] =$deptTotalIndCount;
			$xtotalNa[$scheme->id] =$deptNaCount;
			$xontrack[$scheme->id] =$deptOntrackCount;
			$xofftrack[$scheme->id] =$deptOfftrackCount;
			$xinprogress[$scheme->id] =$deptInprogressCount;

			array_push($totalIndicatorsSch, $totalIndicatorscount);
			array_push($totalNaSch, $totalNaCount);
			array_push($ontrackSch, $totalOntrackCount);
			array_push($offtrackSch, $totalOfftrackCount);
			array_push($inprogressSch, $totalInprogressCount);

			array_push($totalIndicators, $deptTotalIndCount);
			array_push($totalNa, $deptNaCount);
			array_push($ontrack, $deptOntrackCount);
			array_push($offtrack, $deptOfftrackCount);
			array_push($inprogress, $deptInprogressCount);
		}
	}
	return response()->json(['dept_id'=>$dept_id,'sectors'=>$sectors,'departments'=>$allSchemes,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa, 'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress, 'totalIndicatorsSch' => $totalIndicatorsSch, 'totalNaSch' => $totalNaSch, 'ontrackSch' => $ontrackSch, 'offtrackSch' => $offtrackSch, 'inprogressSch' => $inprogressSch]);

}
public function getChartDataScheme(Request $request)
{
	$scheme_id = $request->input('scheme_id');
	$lables =array();
		// $sectors = Sector::all();
	$allSchemes = array();
	$xtotalIndicators =array();
	$xtotalNa = array();
	$xontrack =array();
	$xofftrack =array();
	$xinprogress =array();


	$totalIndicators =array();
	$totalNa =array();
	$ontrack =array();
	$offtrack =array();
	$inprogress =array();
	

	

	$totalIndicatorscount=0;
	$totalNaCount=0;
	$totalOntrackCount=0;
	$totalOfftrackCount=0;
	$totalInprogressCount=0;

	$scheme= Scheme::find($scheme_id);
	
	  if(strlen($scheme->name) > 25){
	  	array_push($lables, substr($scheme->name, 0, 25).'...');
	  }
	  else{
	  	array_push($lables, $scheme->name);
	  }
	// array_push($lables, $scheme->name);
	
	
	

	$deptTotalIndCount =0;
	$deptNaCount=0;
	$deptOntrackCount=0;
	$deptOfftrackCount=0;
	$deptInprogressCount=0;

	$objectives = $scheme->objectives()->get();
	foreach ($objectives as $objective) {
		


		$outputs = $objective->outputs()->get();
		foreach ($outputs as $output) {
			$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
			$totalIndicatorscount += count($outputIndicators);
			$totalNaCount +=  $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
			$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
			$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
			$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

			$deptTotalIndCount += count($outputIndicators);
			$deptNaCount += $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
			$deptOntrackCount +=$output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
			$deptOfftrackCount += $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
			$deptInprogressCount += $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

			$outcomes = $output->outcomes()->get();


			foreach ($outcomes as $outcome) {
				$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get(); 
				
				$totalIndicatorscount += count($outcomeIndicators);
				$deptTotalIndCount += count($outcomeIndicators);
				$totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
				$deptNaCount +=$outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
				$totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
				$deptOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
				$totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
				$deptOfftrackCount +=$outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
				$totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
				$deptInprogressCount +=$outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
				
			}
			
		}
		
	}
	$xtotalIndicators[$scheme->id] =$deptTotalIndCount;
	$xtotalNa[$scheme->id] =$deptNaCount;
	$xontrack[$scheme->id] =$deptOntrackCount;
	$xofftrack[$scheme->id] =$deptOfftrackCount;
	$xinprogress[$scheme->id] =$deptInprogressCount;

	array_push($totalIndicators, $deptTotalIndCount);
	array_push($totalNa, $deptNaCount);
	array_push($ontrack, $deptOntrackCount);
	array_push($offtrack, $deptOfftrackCount);
	array_push($inprogress, $deptInprogressCount);
	return response()->json(['lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);

}
public function getChartDataDeptCritical(Request $request)
{
	$dept_id = $request->input('dept_id');
	$lables =array();
	$sectors = Sector::all();
	$allSchemes = array();
	$xtotalIndicators =array();
	$xtotalNa = array();
	$xontrack =array();
	$xofftrack =array();
	$xinprogress =array();


	$totalIndicators =array();
	$totalNa =array();
	$ontrack =array();
	$offtrack =array();
	$inprogress =array();
	

	

	$totalIndicatorscount=0;
	$totalNaCount=0;
	$totalOntrackCount=0;
	$totalOfftrackCount=0;
	$totalInprogressCount=0;

	$department= Department::find($dept_id);
	
	
	
	

	$deptTotalIndCount =0;
	$deptNaCount=0;
	$deptOntrackCount=0;
	$deptOfftrackCount=0;
	$deptInprogressCount=0;

	$units = $department->units()->get();
	foreach ($units as $unit) {
		$schemes = $unit->schemes()->get();
		foreach ($schemes as $scheme) {
			
		  if(strlen($scheme->name) > 25){
		  	array_push($lables, substr($scheme->name, 0, 25).'...');
		  }
		  else{
		  	array_push($lables, $scheme->name);
		  }
			// array_push($lables, $scheme->name);

			array_push($allSchemes, $scheme);

			$objectives = $scheme->objectives()->get();
			foreach ($objectives as $objective) {



				$outputs = $objective->outputs()->get();
				foreach ($outputs as $output) {
					$outputIndicators = $output->outputIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
					$totalIndicatorscount += count($outputIndicators);
					$totalNaCount +=  $output->outputIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$totalOntrackCount +=  $output->outputIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$totalOfftrackCount +=  $output->outputIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$totalInprogressCount  +=  $output->outputIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();

					$deptTotalIndCount += count($outputIndicators);
					$deptNaCount += $output->outputIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$deptOntrackCount +=$output->outputIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$deptOfftrackCount += $output->outputIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
					$deptInprogressCount += $output->outputIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();

					$outcomes = $output->outcomes()->get();


					foreach ($outcomes as $outcome) {
						$outcomeIndicators = $outcome->outcomeIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get(); 
						
						$totalIndicatorscount += count($outcomeIndicators);
						$deptTotalIndCount += count($outcomeIndicators);
						$totalNaCount += $outcome->outcomeIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$deptNaCount +=$outcome->outcomeIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$totalOntrackCount += $outcome->outcomeIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$deptOntrackCount += $outcome->outcomeIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$totalOfftrackCount += $outcome->outcomeIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$deptOfftrackCount +=$outcome->outcomeIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$totalInprogressCount += $outcome->outcomeIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						$deptInprogressCount +=$outcome->outcomeIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
						
					}
					
				}
				
			}
			$xtotalIndicators[$scheme->id] =$deptTotalIndCount;
			$xtotalNa[$scheme->id] =$deptNaCount;
			$xontrack[$scheme->id] =$deptOntrackCount;
			$xofftrack[$scheme->id] =$deptOfftrackCount;
			$xinprogress[$scheme->id] =$deptInprogressCount;

			array_push($totalIndicators, $deptTotalIndCount);
			array_push($totalNa, $deptNaCount);
			array_push($ontrack, $deptOntrackCount);
			array_push($offtrack, $deptOfftrackCount);
			array_push($inprogress, $deptInprogressCount);
		}
	}
	return response()->json(['dept_id'=>$dept_id,'sectors'=>$sectors,'departments'=>$allSchemes,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);

}
public function getChartDataSchemeCritical(Request $request)
{
	$scheme_id = $request->input('scheme_id');
	$lables =array();
	$sectors = Sector::all();
	$allSchemes = array();
	$xtotalIndicators =array();
	$xtotalNa = array();
	$xontrack =array();
	$xofftrack =array();
	$xinprogress =array();


	$totalIndicators =array();
	$totalNa =array();
	$ontrack =array();
	$offtrack =array();
	$inprogress =array();

	$totalIndicatorscount=0;
	$totalNaCount=0;
	$totalOntrackCount=0;
	$totalOfftrackCount=0;
	$totalInprogressCount=0;

	$scheme= Scheme::find($scheme_id);
	
	
	
	

	$deptTotalIndCount =0;
	$deptNaCount=0;
	$deptOntrackCount=0;
	$deptOfftrackCount=0;
	$deptInprogressCount=0;
	
	  if(strlen($scheme->name) > 25){
	  	array_push($lables, substr($scheme->name, 0, 25).'...');
	  }
	  else{
	  	array_push($lables, $scheme->name);
	  }
	  // array_push($lables, $scheme->name);

	array_push($allSchemes, $scheme);

	$objectives = $scheme->objectives()->get();
	foreach ($objectives as $objective) {
		


		$outputs = $objective->outputs()->get();
		foreach ($outputs as $output) {
			$outputIndicators = $output->outputIndicators()->where( [ ['is_critical', 1], ['name', '!=', '.'] ] )->get();
			$totalIndicatorscount += count($outputIndicators);
			$totalNaCount +=  $output->outputIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
			$totalOntrackCount +=  $output->outputIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
			$totalOfftrackCount +=  $output->outputIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
			$totalInprogressCount  +=  $output->outputIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();

			$deptTotalIndCount += count($outputIndicators);
			$deptNaCount += $output->outputIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
			$deptOntrackCount +=$output->outputIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
			$deptOfftrackCount += $output->outputIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
			$deptInprogressCount += $output->outputIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();

			$outcomes = $output->outcomes()->get();


			foreach ($outcomes as $outcome) {
				$outcomeIndicators = $outcome->outcomeIndicators()->where( [ ['is_critical', 1] , ['name', '!=', '.']] )->get(); 
				
				$totalIndicatorscount += count($outcomeIndicators);
				$deptTotalIndCount += count($outcomeIndicators);
				$totalNaCount += $outcome->outcomeIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$deptNaCount +=$outcome->outcomeIndicators()->where( [ ['status',1], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$totalOntrackCount += $outcome->outcomeIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$deptOntrackCount += $outcome->outcomeIndicators()->where( [ ['status',2], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$totalOfftrackCount += $outcome->outcomeIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$deptOfftrackCount +=$outcome->outcomeIndicators()->where( [ ['status',3], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$totalInprogressCount += $outcome->outcomeIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				$deptInprogressCount +=$outcome->outcomeIndicators()->where( [ ['status',4], ['is_critical', 1], ['name', '!=', '.'] ] )->count();
				
			}
			
		}
		
	}
	$xtotalIndicators[$scheme->id] =$deptTotalIndCount;
	$xtotalNa[$scheme->id] =$deptNaCount;
	$xontrack[$scheme->id] =$deptOntrackCount;
	$xofftrack[$scheme->id] =$deptOfftrackCount;
	$xinprogress[$scheme->id] =$deptInprogressCount;

	array_push($totalIndicators, $deptTotalIndCount);
	array_push($totalNa, $deptNaCount);
	array_push($ontrack, $deptOntrackCount);
	array_push($offtrack, $deptOfftrackCount);
	array_push($inprogress, $deptInprogressCount);
	return response()->json(['lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);

}
public function getChartDataAllDeptMain(Request $request)
{
	$sector_id = $request->input('sector_id');
	$lables =array();
	$sectors = Sector::all();
	$allDepts = array();
	$xtotalIndicators =array();
	$xtotalNa = array();
	$xontrack =array();
	$xofftrack =array();
	$xinprogress =array();


	$totalIndicators =array();
	$totalNa =array();
	$ontrack =array();
	$offtrack =array();
	$inprogress =array();
	

	

	$totalIndicatorscount=0;
	$totalNaCount=0;
	$totalOntrackCount=0;
	$totalOfftrackCount=0;
	$totalInprogressCount=0;

	$sector= Sector::find($sector_id);
	$subsectors =  $sector->subsectors()->get();
	foreach ($subsectors as $subsector) {
		$departments = $subsector->departments()->get();
		array_push($allDepts, $departments);

		foreach ($departments as $department) {

			  if(strlen($department->name) > 25){
			  	array_push($lables, substr($department->name, 0, 25).'...');
			  }
			  else{
			  	array_push($lables, $department->name);
			  }
			// array_push($lables, $department->name);

			$deptTotalIndCount =0;
			$deptNaCount=0;
			$deptOntrackCount=0;
			$deptOfftrackCount=0;
			$deptInprogressCount=0;

			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes = $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$objectives = $scheme->objectives()->get();
					foreach ($objectives as $objective) {
						


						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
							$totalIndicatorscount += count($outputIndicators);
							$totalNaCount +=  $output->outputIndicators()->where('name', '!=', '.')->where([ ['status',1], ['name', '!=', '.'] ])->count();
							$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
							$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
							$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

							$deptTotalIndCount += count($outputIndicators);
							$deptNaCount += $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
							$deptOntrackCount +=$output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
							$deptOfftrackCount += $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
							$deptInprogressCount += $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

							$outcomes = $output->outcomes()->get();


							foreach ($outcomes as $outcome) {
								$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get(); 
								
								$totalIndicatorscount += count($outcomeIndicators);
								$deptTotalIndCount += count($outcomeIndicators);
								$totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
								$deptNaCount +=$outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
								$totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
								$deptOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
								$totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
								$deptOfftrackCount +=$outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
								$totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
								$deptInprogressCount +=$outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
								
							}
							
						}
						
					}

				}
			}

			$xtotalIndicators[$department->id] =$deptTotalIndCount;
			$xtotalNa[$department->id] =$deptNaCount;
			$xontrack[$department->id] =$deptOntrackCount;
			$xofftrack[$department->id] =$deptOfftrackCount;
			$xinprogress[$department->id] =$deptInprogressCount;

			array_push($totalIndicators, $deptTotalIndCount);
			array_push($totalNa, $deptNaCount);
			array_push($ontrack, $deptOntrackCount);
			array_push($offtrack, $deptOfftrackCount);
			array_push($inprogress, $deptInprogressCount);
		}

		
			}//subsector end
			
			



			


			
			

			
			

			return response()->json(['sector_id'=>$sector_id,'sectors'=>$sectors,'departments'=>$allDepts,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);

		}
		


		public function getSchemesHome($dept_id=""){

			$lables =array();
			$sectors = Sector::all();
			$allShemes= array();

			$xtotalIndicators =array();
			$xtotalNa = array();
			$xontrack =array();
			$xofftrack =array();
			$xinprogress =array();

			$totalIndicators =array();
			$totalNa =array();
			$ontrack =array();
			$offtrack =array();
			$inprogress =array();
			$totalIndicatorscount=0;
			$totalNaCount=0;
			$totalOntrackCount=0;
			$totalOfftrackCount=0;
			$totalInprogressCount=0;
			foreach ($sectors as $sector) {
				array_push($lables, $sector->name);
				$subsectors =  $sector->subsectors()->get();
				foreach ($subsectors as $subsector) {
					$departments = $subsector->departments()->get();
					foreach ($departments as $department){
						if($dept_id !=''){
							if($department->id == $dept_id){
								$units = $department->units()->get();
								foreach ($units as $unit) {
									$schemes = $unit->schemes()->get();
									if(isset($unit->id)){
										foreach ($schemes as $scheme) {
											array_push($allShemes, $scheme);

											$totalIndicatorscount=0;
											$totalNaCount=0;
											$totalOntrackCount=0;
											$totalOfftrackCount=0;
											$totalInprogressCount=0;

											
											$objectives = $scheme->objectives()->get();
											foreach ($objectives as $objective) {
												


												$outputs = $objective->outputs()->get();
												foreach ($outputs as $output) {
													$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
													$totalIndicatorscount += count($outputIndicators);
													$totalNaCount +=  $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
													$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
													$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
													$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

													$outcomes = $output->outcomes()->get();


													foreach ($outcomes as $outcome) {
														$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
														$totalIndicatorscount += count($outcomeIndicators);
														$totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
														$totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
														$totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
														$totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
														
													}
													
												}
												
											}
											$xtotalIndicators[$scheme->id] =$totalIndicatorscount;
											$xtotalNa[$scheme->id] =$totalNaCount;
											$xontrack[$scheme->id] =$totalOntrackCount;
											$xofftrack[$scheme->id] =$totalOfftrackCount;
											$xinprogress[$scheme->id] =$totalInprogressCount;
										}//scheme end
									}
								}
							}
						}
						else{
							$units = $department->units()->get();
							foreach ($units as $unit) {
								$schemes = $unit->schemes()->get();
								if(isset($unit->id)){
									foreach ($schemes as $scheme) {
										array_push($allShemes, $scheme);

										$totalIndicatorscount=0;
										$totalNaCount=0;
										$totalOntrackCount=0;
										$totalOfftrackCount=0;
										$totalInprogressCount=0;

										
										$objectives = $scheme->objectives()->get();
										foreach ($objectives as $objective) {
											


											$outputs = $objective->outputs()->get();
											foreach ($outputs as $output) {
												$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
												$totalIndicatorscount += count($outputIndicators);
												$totalNaCount +=  $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
												$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
												$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
												$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

												$outcomes = $output->outcomes()->get();


												foreach ($outcomes as $outcome) {
													$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
													$totalIndicatorscount += count($outcomeIndicators);
													$totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
													$totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
													$totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
													$totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
													
												}
												
											}
											
										}
										$xtotalIndicators[$scheme->id] =$totalIndicatorscount;
										$xtotalNa[$scheme->id] =$totalNaCount;
										$xontrack[$scheme->id] =$totalOntrackCount;
										$xofftrack[$scheme->id] =$totalOfftrackCount;
										$xinprogress[$scheme->id] =$totalInprogressCount;
									}//scheme end
								}
							}
						
						}
					}
				}
				array_push($totalIndicators, $totalIndicatorscount);
				array_push($totalNa, $totalNaCount);
				array_push($ontrack, $totalOntrackCount);
				array_push($offtrack, $totalOfftrackCount);
				array_push($inprogress, $totalInprogressCount);
			}
			return response()->json(['sectors'=>$sectors,'schemes'=>$allShemes,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);
	}


	public function getSchemesDeptHome( Request $request){
		$sector_id = $request->input('sector_id');
		$sector =  Sector::find($sector_id) ;


		$lables =array();
		$sectors = Sector::all();
		$allShemes= array();

		$xtotalIndicators =array();
		$xtotalNa = array();
		$xontrack =array();
		$xofftrack =array();
		$xinprogress =array();

		$totalIndicators =array();
		$totalNa =array();
		$ontrack =array();
		$offtrack =array();
		$inprogress =array();

		array_push($lables, $sector->name);

		$subsectors =  $sector->subsectors()->get();
		foreach ($subsectors as $subsector) {
			$departments = $subsector->departments()->get();
			foreach ($departments as $department) {
				$units = $department->units()->get();
				foreach ($units as $unit) {
					$schemes = $unit->schemes()->get();
					foreach ($schemes as $scheme) {

						
						array_push($allShemes, $scheme);

						$totalIndicatorscount=0;
						$totalNaCount=0;
						$totalOntrackCount=0;
						$totalOfftrackCount=0;
						$totalInprogressCount=0;

						
						$objectives = $scheme->objectives()->get();
						foreach ($objectives as $objective) {
							


							$outputs = $objective->outputs()->get();
							foreach ($outputs as $output) {
								$outputIndicators = $output->outputIndicators()->where('name', '!=', '.')->get();
								$totalIndicatorscount += count($outputIndicators);
								$totalNaCount +=  $output->outputIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
								$totalOntrackCount +=  $output->outputIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
								$totalOfftrackCount +=  $output->outputIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
								$totalInprogressCount  +=  $output->outputIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();

								$outcomes = $output->outcomes()->get();


								foreach ($outcomes as $outcome) {
									$outcomeIndicators = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
									$totalIndicatorscount += count($outcomeIndicators);
									$totalNaCount += $outcome->outcomeIndicators()->where([ ['status',1], ['name', '!=', '.'] ])->count();
									$totalOntrackCount += $outcome->outcomeIndicators()->where([ ['status',2], ['name', '!=', '.'] ])->count();
									$totalOfftrackCount += $outcome->outcomeIndicators()->where([ ['status',3], ['name', '!=', '.'] ])->count();
									$totalInprogressCount += $outcome->outcomeIndicators()->where([ ['status',4], ['name', '!=', '.'] ])->count();
									
								}

							}
							
						}
						$xtotalIndicators[$scheme->id] =$totalIndicatorscount;
						$xtotalNa[$scheme->id] =$totalNaCount;
						$xontrack[$scheme->id] =$totalOntrackCount;
						$xofftrack[$scheme->id] =$totalOfftrackCount;
						$xinprogress[$scheme->id] =$totalInprogressCount;
						}//scheme end
					}
				}

				
			}
			
			



			array_push($totalIndicators, $totalIndicatorscount);
			array_push($totalNa, $totalNaCount);
			array_push($ontrack, $totalOntrackCount);
			array_push($offtrack, $totalOfftrackCount);
			array_push($inprogress, $totalInprogressCount);


			
			

			
			

			return response()->json(['sectors'=>$sectors,'schemes'=>$allShemes,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);
		}


		
		public function actionpointMain()
		{
			$sectors = Sector::all();

			$result = array();
			

			foreach ($sectors as $sector) {
				$subsectors = $sector->subsectors()->get();
				foreach ($subsectors as $subsector) {
				  $departments = $subsector->departments()->get();
				  foreach ($departments as $department) {
					  $units=$department->units()->get();
					  foreach ($units as $unit) {
						$schemes = $unit->schemes()->get();
						foreach ($schemes as $scheme) {
							$objectives = $scheme->objectives()->get();
							foreach ($objectives as $objective) {
								$outputs = $objective->outputs()->get();
								foreach ($outputs as $output) {
									$outcomes = $output->outcomes()->get();
									foreach ($outcomes as $outcome) {
									  $indicator = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
									  foreach ($indicator as $outInd) {
									   $targets= $outInd->outcomeTargets()->get();
									   foreach ($targets as $target) {
										 $achievements =$target->outcomeAchievements()->get();
										 foreach ($achievements as $achievement) {
										   $reviews = $achievement->reviews()->get();
										   foreach ($reviews as $review) {
											 $actionpoints = $review->actionpoints()->get();
											 foreach ($actionpoints as $actionpoint) {
											 	$actionusers = ActionUser::where([['actionpoints_id', $actionpoint->id], ['action_type', 'outcome']])->get();
											 	$action_user_arr = array();
											 	foreach($actionuser as $user){
											 		$user = User::find($user->user_id);
											 		array_push($action_user_arr, $user->name);
											 	}
											   	array_push($result, [
													$scheme->name,
													$outInd->name,
													implode(',', $action_user_arr),
													$actionpoint->description,
													"<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>"
												]);
										   }
									   }
								   }
							   }


							   
						   }
					   }

				   }
				   foreach ($outputs as $output) {
					$outputInds = $output->outputIndicators()->where('name', '!=', '.')->get();
					foreach ($outputInds as $outInd) {
					   $targets= $outInd->outputTargets()->get();
					   foreach ($targets as $target) {
						 $achievements = $target->achievements()->get();
						 foreach ($achievements as $achievement) {
						   $reviews = $achievement->reviews()->get();
						   foreach ($reviews as $review) {
							 $actionpoints = $review->actionpoints()->get();
							 foreach ($actionpoints as $actionpoint) {
						 		$actionusers = ActionUser::where([['actionpoint_id', $actionpoint->id], ['action_type', 'output']])->get();
							 	$action_user_arr = array();
							 	foreach($actionusers as $user){
							 		$user = User::find($user->user_id);
							 		array_push($action_user_arr, $user->name);
							 	}
							   array_push($result, [
								$scheme->name,
								$outInd->name,
								implode(',', $action_user_arr),
								$actionpoint->description,
								"<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>"
							]);
						   }
					   }
				   }
			   }


			   
		   }

	   }

   }

}
}
}
}


}
return response()->json(['indicators'=>$result]);

		//return view('sector.index', compact('sectors'));
}

public function actionpointSector(Request $request)
{

   $result = array();
   $sector_id = $request->input('sector_id');
   $sector = Sector::find($sector_id);
   $subsectors = $sector->subsectors()->get();
   foreach ($subsectors as $subsector) {
	  $departments = $subsector->departments()->get();
	  foreach ($departments as $department) {
		  $units=$department->units()->get();
		  foreach ($units as $unit) {
			$schemes = $unit->schemes()->get();
			foreach ($schemes as $scheme) {
				$objectives = $scheme->objectives()->get();
				foreach ($objectives as $objective) {
					$outputs = $objective->outputs()->get();
					foreach ($outputs as $output) {
						$outcomes = $output->outcomes()->get();
						foreach ($outcomes as $outcome) {
						  $indicator = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
						  foreach ($indicator as $outInd) {
						   $targets= $outInd->outcomeTargets()->get();
						   foreach ($targets as $target) {
							 $achievements =$target->outcomeAchievements()->get();
							 foreach ($achievements as $achievement) {
							   $reviews = $achievement->reviews()->get();
							   foreach ($reviews as $review) {
								 $actionpoints = $review->actionpoints()->get();
								 foreach ($actionpoints as $actionpoint) {
								   array_push($result, [
									$scheme->name,
									$outInd->name,
									"<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>",
									$actionpoint->description
								]);
							   }
						   }
					   }
				   }


				   
			   }
		   }

	   }
	   foreach ($outputs as $output) {
		$outputInds = $output->outputIndicators()->where('name', '!=', '.')->get();
		foreach ($outputInds as $outInd) {
		   $targets= $outInd->outputTargets()->get();
		   foreach ($targets as $target) {
			 $achievements = $target->achievements()->get();
			 foreach ($achievements as $achievement) {
			   $reviews = $achievement->reviews()->get();
			   foreach ($reviews as $review) {
				 $actionpoints = $review->actionpoints()->get();
				 foreach ($actionpoints as $actionpoint) {

				   array_push($result, [
					$scheme->name,
					$outInd->name,
					"<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>",
					$actionpoint->description
				]);
			   }
		   }
	   }
   }


   
}

}

}

}
}
}
}
return response()->json(['indicators'=>$result]);

		//return view('sector.index', compact('sectors'));
}

public function actionpointDept(Request $request)
{
	
	$result = array();
	$dept_id = $request->input('dept_id');
	$department = Department::find($dept_id);
	$units=$department->units()->get();
	foreach ($units as $unit) {
	  $schemes = $unit->schemes()->get();
	  foreach ($schemes as $scheme) {
		  $objectives = $scheme->objectives()->get();
		  foreach ($objectives as $objective) {
			  $outputs = $objective->outputs()->get();
			  foreach ($outputs as $output) {
				  $outcomes = $output->outcomes()->get();
				  foreach ($outcomes as $outcome) {
					$indicator = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
					foreach ($indicator as $outInd) {
					 $targets= $outInd->outcomeTargets()->get();
					 foreach ($targets as $target) {
					   $achievements =$target->outcomeAchievements()->get();
					   foreach ($achievements as $achievement) {
						 $reviews = $achievement->reviews()->get();
						 foreach ($reviews as $review) {
						   $actionpoints = $review->actionpoints()->get();
						   foreach ($actionpoints as $actionpoint) {
							 array_push($result, [
							  $scheme->name,
							  $outInd->name,
							  "<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>",
							  $actionpoint->description
						  ]);
						 }
					 }
				 }
			 }


			 
		 }
	 }

 }
 foreach ($outputs as $output) {
  $outputInds = $output->outputIndicators()->where('name', '!=', '.')->get();
  foreach ($outputInds as $outInd) {
	 $targets= $outInd->outputTargets()->get();
	 foreach ($targets as $target) {
	   $achievements = $target->achievements()->get();
	   foreach ($achievements as $achievement) {
		 $reviews = $achievement->reviews()->get();
		 foreach ($reviews as $review) {
		   $actionpoints = $review->actionpoints()->get();
		   foreach ($actionpoints as $actionpoint) {

			 array_push($result, [
			  $scheme->name,
			  $outInd->name,
			  "<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>",
			  $actionpoint->description
		  ]);
		 }
	 }
 }
}



}

}

}

}
}
return response()->json(['indicators'=>$result]);

		//return view('sector.index', compact('sectors'));
}
public function actionpointScheme(Request $request)
{
	  # code...

	
	$result = array();
	$scheme_id = $request->input('scheme_id');
	$scheme = Scheme::find($scheme_id);
	$objectives = $scheme->objectives()->get();
	foreach ($objectives as $objective) {
	  $outputs = $objective->outputs()->get();
	  foreach ($outputs as $output) {
		  $outcomes = $output->outcomes()->get();
		  foreach ($outcomes as $outcome) {
			$indicator = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
			foreach ($indicator as $outInd) {
			 $targets= $outInd->outcomeTargets()->get();
			 foreach ($targets as $target) {
			   $achievements =$target->outcomeAchievements()->get();
			   foreach ($achievements as $achievement) {
				 $reviews = $achievement->reviews()->get();
				 foreach ($reviews as $review) {
				   $actionpoints = $review->actionpoints()->get();
				   foreach ($actionpoints as $actionpoint) {
					 array_push($result, [
					  $scheme->name,
					  $outInd->name,
					  "<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>",
					  $actionpoint->description
				  ]);
				 }
			 }
		 }
	 }


	 
 }
}

}
foreach ($outputs as $output) {
  $outputInds = $output->outputIndicators()->where('name', '!=', '.')->get();
  foreach ($outputInds as $outInd) {
	 $targets= $outInd->outputTargets()->get();
	 foreach ($targets as $target) {
	   $achievements = $target->achievements()->get();
	   foreach ($achievements as $achievement) {
		 $reviews = $achievement->reviews()->get();
		 foreach ($reviews as $review) {
		   $actionpoints = $review->actionpoints()->get();
		   foreach ($actionpoints as $actionpoint) {

			 array_push($result, [
			  $scheme->name,
			  $outInd->name,
			  "<div class='text-center'><span class='indstat".$actionpoint->status_id."'></div>",
			  $actionpoint->description
		  ]);
		 }
	 }
 }
}



}

}

}
return response()->json(['indicators'=>$result]);

		//return view('sector.index', compact('sectors'));
}


	public function getSchemeIndicatorsList(Request $request)
	{
		  # code...
  		$result = array();
  		$i = 0;
		$scheme_id = $request->input('scheme_id');
		$scheme = Scheme::find($scheme_id);
		$objectives = $scheme->objectives()->get();
		foreach ($objectives as $objective) {
	  		$outputs = $objective->outputs()->get();
	  		foreach ($outputs as $output) {
		  		$outcomes = $output->outcomes()->get();
		  		foreach ($outcomes as $outcome) {
					$indicator = $outcome->outcomeIndicators()->where('name', '!=', '.')->get();
					foreach ($indicator as $outInd) {
	 					$result[$i]['type'] = 'outcome';
	 					$result[$i]['id'] = $outInd->id;
	 					$result[$i]['name'] = $outInd->name;
  						$i++;
 					}
				}
			}
			foreach ($outputs as $output) {
  				$outputInds = $output->outputIndicators()->where('name', '!=', '.')->get();
  				foreach ($outputInds as $outInd) {	
					$result[$i]['type'] = 'output';
 					$result[$i]['id'] = $outInd->id;
 					$result[$i]['name'] = $outInd->name;
					$i++;
				}
			}
		}
		return response()->json(['indicators'=>$result]);
	}

	public function bestPerformingDash(Request $request)
	{
		$departments = Department::all();
		$departmentResult = array();
			$schemes= Scheme::all();
	$current_month = date('m');
	$current_year = date('Y');
	$current_month_exp =0;
	if($current_month <4){
		$est_end_year = date('Y');
		$current_year = date('Y', strtotime('-1 year'));
	}else{
		$est_end_year = date('Y', strtotime('+1 year'));
	}
	
	$xtotalExp =array();
	$xtotalEst =array();

		
		 foreach ($departments as $department) {
		 	$totalEst = 0;
	   		$totalExp =0;
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
							 $totalEst += $re->revenue + $re->capital + $re->loan;
						 }
					 }
					 else{
						$budgetEstimate = $estimate->budgetEstimates()->get();
						if(count($budgetEstimate)){
							foreach ($budgetEstimate as $be) {
							 $totalEst += $be->revenue + $be->capital + $be->loan;
						 }
					 }
				 }

				 $expenditures = $scheme->expenditures()->get();
				 foreach ($expenditures as $exp) {
					$year_exp =  explode('-',$exp->exp_year);
									// print_r($year_exp);
					$concerned_year = $year_exp[1];
					$concerned_month =  $year_exp[0];
					if(date('m') < 4){
						if(($concerned_month > 3 && $concerned_year == date('Y', strtotime('-1 years'))) || ($concerned_month < 4 && $concerned_year == date('Y'))) {
							$totalExp += $exp->revenue + $exp->capital + $exp->loan;
							if($current_month ==$concerned_month ){
								$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
							}
						}
					}
					else{
						if(($concerned_month > 3 && $concerned_year == date('Y')) || ($concerned_month < 4 && $concerned_year == date('Y', strtotime('+1 years')))) {
							$totalExp += $exp->revenue + $exp->capital + $exp->loan;
							if($current_month ==$concerned_month ){
								$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
							}
						}
					}
					// if($current_year == $concerned_year){
					// 	$totalExp += $exp->revenue + $exp->capital + $exp->loan;
					// 	if($current_month ==$concerned_month ){
					// 		$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
					// 	}
					// }
					
				}
			}
			
		}
	}
		array_push($xtotalExp,$totalExp/100) ;
	array_push($xtotalEst,$totalEst/100) ;
}
		// $length = count($departments);
		// $indexArray = array();
		// for($i = 0; $i< $length-1 ; $i++){
		// 	if($xtotalExp[$i] !=0){
		// 			$maxper=$xtotalEst[$i]/$xtotalExp[$i];
		// 		}else{
		// 			$maxper=0;
		// 		}
		// 	$maxIndex = $i;
		// 	for($j = $i+1; $j< $length ; $j++){
		// 		if($xtotalExp[$j] !=0){
		// 			$newPer=$xtotalEst[$j]/$xtotalExp[$j];
		// 		}else{
		// 			$newPer=0;
		// 		}
					

		// 			if($newPer > $maxper){
		// 				$maxper = $newPer;
		// 				$maxIndex = $j;
		// 			}
		// 	}
		// 	$indexArray[$i] = $maxIndex;

		// }
		$final_arr= array();
		$i=1;
		foreach ($departments as $key => $value) {
			# code...
			$dept_id = $value->id;
			$dept_name = $value->name;
			$dept_dets = $dept_id.'+'.$dept_name;
			if($xtotalEst[$key] > 0){
				$perf = round((($xtotalExp[$key] / $xtotalEst[$key])*100), 2);
			}
			else{
				$perf = 0;
			}
			array_push($final_arr, [
			  	$i.".",
			  	'<a href="dept_dashboard.html?dept_id='.$dept_id.'">'.$value->name.'</a>',
			  	$perf.'%'
		  	]);
		  	$i++;
	  	}

		return response()->json(['departments'=>$final_arr]);
	}


	public function bestPerformingDashInd(Request $request)
	{
		# code...


		if(auth()->user()->department_id){
			$dept_id = auth()->user()->department_id;
			$departments = Department::where('id', $dept_id)->get();
			$i=0;
			$final_arr = array();
			foreach($departments as $department){
				$units = $department->units()->get();
				foreach ($units as $unit) {
					$schemes= $unit->schemes()->get();
					foreach ($schemes as $scheme) {
						$totalOntrack = 0;
	   					$totalInd =0;
						$objectives = $scheme->objectives()->get();
						foreach ($objectives as $objective) {
							# code...
							$outputs = $objective->outputs()->get();
							foreach ($outputs as $output) {
								# code...
								$totalOutputIndicators = count($output->outputIndicators()->where('name', '!=', '.')->get());
								$totalOntrackOutputIndicators = count($output->outputIndicators()->where([['status', 2], ['name', '!=', '.']])->get());
								$totalOntrack = $totalOntrack + $totalOntrackOutputIndicators;
								$totalInd = $totalInd + $totalOutputIndicators;
								$outcomes = $output->outcomes()->get();
								foreach($outcomes as $outcome){
									$totalOutcomeIndicators = count($outcome->outcomeIndicators()->where('name', '!=', '.')->get());
									$totalOntrackOutcomeIndicators = count($outcome->outcomeIndicators()->where([['status', 2], ['name', '!=', '.']])->get());
									$totalOntrack = $totalOntrack + $totalOntrackOutcomeIndicators;
									$totalInd = $totalInd + $totalOutcomeIndicators;
								}
							}
						}
						if($totalInd > 0){
							$perf = round((($totalOntrack / $totalInd)*100), 2);
						}
						else{
							$perf = 0;
						}
						array_push($final_arr, [
						  	$i.".",
						  	'<a href="scheme_dashboard.html?scheme_id='.$scheme->id.'">'.$scheme->name.'</a>',
						  	$perf.'%'
					  	]);
					  	$i++;
					}
				}
			}
		}
		else{
			$departments = Department::all();
			$i=0;
			$final_arr = array();
			foreach($departments as $department){
				$totalOntrack = 0;
		   		$totalInd =0;
				$units = $department->units()->get();
				foreach ($units as $unit) {
					$schemes= $unit->schemes()->get();
					foreach ($schemes as $scheme) {
						$objectives = $scheme->objectives()->get();
						foreach ($objectives as $objective) {
							# code...
							$outputs = $objective->outputs()->get();
							foreach ($outputs as $output) {
								# code...
								$totalOutputIndicators = count($output->outputIndicators()->where('name', '!=', '.')->get());
								$totalOntrackOutputIndicators = count($output->outputIndicators()->where([['status', 2], ['name', '!=', '.']])->get());
								$totalOntrack = $totalOntrack + $totalOntrackOutputIndicators;
								$totalInd = $totalInd + $totalOutputIndicators;
								$outcomes = $output->outcomes()->get();
								foreach($outcomes as $outcome){
									$totalOutcomeIndicators = count($outcome->outcomeIndicators()->where('name', '!=', '.')->get());
									$totalOntrackOutcomeIndicators = count($outcome->outcomeIndicators()->where([['status', 2], ['name', '!=', '.']])->get());
									$totalOntrack = $totalOntrack + $totalOntrackOutcomeIndicators;
									$totalInd = $totalInd + $totalOutcomeIndicators;
								}
							}
						}
					}
				}
				if($totalInd > 0){
					$perf = round((($totalOntrack / $totalInd)*100), 2);
				}
				else{
					$perf = 0;
				}
				array_push($final_arr, [
				  	$i.".",
				  	'<a href="dept_dashboard.html?dept_id='.$department->id.'">'.$department->name.'</a>',
				  	$perf.'%'
			  	]);
			  	$i++;
			}
		}

		return response()->json(['departments'=>$final_arr]);;
	}

	public function bestPerformingDashIndCri(Request $request)
	{
		# code...
		$departments = Department::all();
		$i=0;
		$final_arr = array();
		foreach($departments as $department){
			$totalOntrack = 0;
	   		$totalInd =0;
			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes= $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$objectives = $scheme->objectives()->get();
					foreach ($objectives as $objective) {
						# code...
						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							# code...
							$totalOutputIndicators = count($output->outputIndicators()->where('name', '!=', '.')->get());
							$totalOntrackOutputIndicators = count($output->outputIndicators()->where([ ['name', '!=', '.'], ['is_critical', 1],['status', 2]])->get());
							$totalOntrack = $totalOntrack + $totalOntrackOutputIndicators;
							$totalInd = $totalInd + $totalOutputIndicators;
							$outcomes = $output->outcomes()->get();
							foreach($outcomes as $outcome){
								$totalOutcomeIndicators = count($outcome->outcomeIndicators()->where('name', '!=', '.')->get());
								$totalOntrackOutcomeIndicators = count($outcome->outcomeIndicators()->where([ ['name', '!=', '.'], ['is_critical', 1],['status', 2]])->get());
								$totalOntrack = $totalOntrack + $totalOntrackOutcomeIndicators;
								$totalInd = $totalInd + $totalOutcomeIndicators;
							}
						}
					}
				}
			}
			if($totalInd > 0){
				$perf = round((($totalOntrack / $totalInd)*100), 2);
			}
			else{
				$perf = 0;
			}
			array_push($final_arr, [
			  	$i.".",
			  	'<a href="dept_dashboard.html?dept_id='.$department->id.'">'.$department->name.'</a>',
			  	$perf.'%'
		  	]);
		  	$i++;
		}

		return response()->json(['departments'=>$final_arr]);;
	}


	public function bestPerformingDashDept(Request $request)
	{
		$dept_id = $request->input('dept_id');
		$departments = Department::where('id', $dept_id)->get();
		// $departmentResult = array();
		$current_month = date('m');
		$current_year = date('Y');
		$current_month_exp =0;
		if($current_month <4){
			$est_end_year = date('Y');
			$current_year = date('Y', strtotime('-1 year'));
		}else{
			$est_end_year = date('Y', strtotime('+1 year'));
		}
		
		$xtotalExp =array();
		$xtotalEst =array();
		$i=0;
		$final_arr = array();
	 	foreach ($departments as $department) {
			 $units = $department->units()->get();
			 foreach ($units as $unit) {
				$schemes= $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$totalEst = 0;
	   				$totalExp =0;
					$estimate =$scheme->estimates()->where('end_date',$est_end_year)->first();
					if(!empty($estimate)){
						$revisedEstimate = $estimate->revisedEstimates()->get();
						if(count($revisedEstimate)){
									// print_r($revisedEstimate);
							foreach ($revisedEstimate as $re) {
								$totalEst += $re->revenue + $re->capital + $re->loan;
							}
					 	}
					 	else{
							$budgetEstimate = $estimate->budgetEstimates()->get();
							if(count($budgetEstimate)){
								foreach ($budgetEstimate as $be) {
							 		$totalEst += $be->revenue + $be->capital + $be->loan;
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
								$totalExp += $exp->revenue + $exp->capital + $exp->loan;
								if($current_month ==$concerned_month ){
									$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
								}
							}
						}
					}
					if($totalExp > 0){
						$perf = round((($totalExp / $totalEst)*100), 2);
					}
					else{
						$perf = 0;
					}
					array_push($final_arr, [
					  	$i.".",
					  	'<a href="scheme_dashboard.html?scheme_id='.$scheme->id.'">'.$scheme->name.'</a>',
					  	$perf.'%'
				  	]);
				  	$i++;
				}
			}
		}

		return response()->json(['departments'=>$final_arr]);
	}


	public function bestPerformingDashIndDept(Request $request)
	{
		# code...
		$dept_id = $request->input('dept_id');
		$departments = Department::where('id', $dept_id)->get();
		$i=0;
		$final_arr = array();
		foreach($departments as $department){
			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes= $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$totalOntrack = 0;
   					$totalInd =0;
					$objectives = $scheme->objectives()->get();
					foreach ($objectives as $objective) {
						# code...
						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							# code...
							$totalOutputIndicators = count($output->outputIndicators()->where('name', '!=', '.')->get());
							$totalOntrackOutputIndicators = count($output->outputIndicators()->where([['status', 2], ['name', '!=', '.']])->get());
							$totalOntrack = $totalOntrack + $totalOntrackOutputIndicators;
							$totalInd = $totalInd + $totalOutputIndicators;
							$outcomes = $output->outcomes()->get();
							foreach($outcomes as $outcome){
								$totalOutcomeIndicators = count($outcome->outcomeIndicators()->where('name', '!=', '.')->get());
								$totalOntrackOutcomeIndicators = count($outcome->outcomeIndicators()->where([['status', 2], ['name', '!=', '.']])->get());
								$totalOntrack = $totalOntrack + $totalOntrackOutcomeIndicators;
								$totalInd = $totalInd + $totalOutcomeIndicators;
							}
						}
					}
					if($totalInd > 0){
						$perf = round((($totalOntrack / $totalInd)*100), 2);
					}
					else{
						$perf = 0;
					}
					array_push($final_arr, [
					  	$i.".",
					  	'<a href="scheme_dashboard.html?scheme_id='.$scheme->id.'">'.$scheme->name.'</a>',
					  	$perf.'%'
				  	]);
				  	$i++;
				}
			}
		}

		return response()->json(['departments'=>$final_arr]);;
	}

	public function bestPerformingDashIndCriDept(Request $request)
	{
		# code...
		$dept_id = $request->input('dept_id');
		$departments = Department::where('id', $dept_id)->get();
		$i=0;
		$final_arr = array();
		foreach($departments as $department){
			$totalOntrack = 0;
	   		$totalInd =0;
			$units = $department->units()->get();
			foreach ($units as $unit) {
				$schemes= $unit->schemes()->get();
				foreach ($schemes as $scheme) {
					$objectives = $scheme->objectives()->get();
					foreach ($objectives as $objective) {
						# code...
						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							# code...
							$totalOutputIndicators = count($output->outputIndicators()->where('name', '!=', '.')->get());
							$totalOntrackOutputIndicators = count($output->outputIndicators()->where([ ['name', '!=', '.'], ['is_critical', 1],['status', 2]])->get());
							$totalOntrack = $totalOntrack + $totalOntrackOutputIndicators;
							$totalInd = $totalInd + $totalOutputIndicators;
							$outcomes = $output->outcomes()->get();
							foreach($outcomes as $outcome){
								$totalOutcomeIndicators = count($outcome->outcomeIndicators()->where('name', '!=', '.')->get());
								$totalOntrackOutcomeIndicators = count($outcome->outcomeIndicators()->where([ ['name', '!=', '.'], ['is_critical', 1],['status', 2]])->get());
								$totalOntrack = $totalOntrack + $totalOntrackOutcomeIndicators;
								$totalInd = $totalInd + $totalOutcomeIndicators;
							}
						}
					}
					if($totalInd > 0){
						$perf = round((($totalOntrack / $totalInd)*100), 2);
					}
					else{
						$perf = 0;
					}
					array_push($final_arr, [
					  	$i.".",
					  	'<a href="scheme_dashboard.html?scheme_id='.$scheme->id.'">'.$scheme->name.'</a>',
					  	$perf.'%'
				  	]);
				  	$i++;
				}
			}
		}

		return response()->json(['departments'=>$final_arr]);;
	}

	
}