<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomDashboard;
use Auth;
use App\Scheme;

class CustomDashboardController extends Controller
{
    
    public function index(Request $request)
	{

        $user = Auth::user();

        $customdashboards = CustomDashboard::where('user_id',$user->id)->get();
        return response()->json(['customdashboards'=>$customdashboards]);
	}
	public function create(Request $request)
	{
		$this->validate($request, [
            'dashboard_name'=>'required',
        ]);
        $requestAll = $request->all();
        $user = Auth::user();

        $customdashboard = CustomDashboard::create([
        	'name'=>$request->input('dashboard_name'),
            'scheme_ids'=>json_encode(request()->get('scheme_ids')),
            'user_id'=>$user->id

        ]);
        return response()->json(['success'=>'true','customdashboard'=>$customdashboard]);
	}

	public function update(Request $request)
	{
		$this->validate($request, [
            'name'=>'required',
            'id'=>'required',
        ]);
		$id = $request->input('id');
		$dashboard = CustomDashboard::find($id);
		$dashboard->name = $request->input('name');
		$dashboard->scheme_ids = json_encode(request()->get('scheme_ids'));
		$dashboard->update();
        return response()->json(['success'=>'true']);
	}
	public function show(Request $request)
	{
		$id=$request->input('dashboard_id');
		$dashboard = CustomDashboard::find($id);
		$allSchemes = array();
		if(isset($dashboard->name)){
				$scheme_ids = json_decode($dashboard->scheme_ids);
		
				foreach ($scheme_ids as $scheme_id) {
					$scheme = Scheme::find($scheme_id);
					if(isset($scheme->name)){
						array_push($allSchemes, $scheme);
					}
				}
		}
		

        return response()->json(['schemes'=>$allSchemes]);

	}

	public function getFinancials(Request $request,$id)
{

	$dashboard = CustomDashboard::find($id);
		$scheme_ids = json_decode($dashboard->scheme_ids);
		$totalSchemes = array();
		foreach ($scheme_ids as $scheme_id) {
			$scheme = Scheme::find($scheme_id);
			if(isset($scheme->name)){
				array_push($totalSchemes, $scheme);
			}
		}

	$dept_id = $request->input('dept_id');
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

	
		foreach ($totalSchemes as $scheme) {
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
			if($current_year == $concerned_year){
				$totalExp += $exp->revenue + $exp->capital + $exp->loan;
				if($current_month ==$concerned_month ){
					$current_month_exp = $exp->revenue + $exp->capital + $exp->loan;
				}
			}

		}
	}
	array_push($xtotalExp,$totalExp) ;
	array_push($xtotalEst,$totalEst) ;
}

return response()->json(['schemes'=>$allSchemes,'current_year'=>$current_year,'current_month_exp'=>$current_month_exp,'totalExp'=>$xtotalExp,'totalEst'=>$xtotalEst]);
}


public function actionpoints(Request $request,$id)
{
	
	$result = array();

	$dashboard = CustomDashboard::find($id);
		$scheme_ids = json_decode($dashboard->scheme_ids);
		$totalSchemes = array();
		foreach ($scheme_ids as $scheme_id) {
			$scheme = Scheme::find($scheme_id);
			if(isset($scheme->name)){
				array_push($totalSchemes, $scheme);
			}
		}
	  foreach ($totalSchemes as $scheme) {
		  $objectives = $scheme->objectives()->get();
		  foreach ($objectives as $objective) {
			  $outputs = $objective->outputs()->get();
			  foreach ($outputs as $output) {
				  $outcomes = $output->outcomes()->get();
				  foreach ($outcomes as $outcome) {
					$indicator = $outcome->outcomeIndicators()->get();
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
  $outputInds = $output->outputIndicators()->get();
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

return response()->json(['indicators'=>$result]);

		//return view('sector.index', compact('sectors'));
}


public function getChartData(Request $request,$id)
{

	$dashboard = CustomDashboard::find($id);
		$scheme_ids = json_decode($dashboard->scheme_ids);
		$totalSchemes = array();
		foreach ($scheme_ids as $scheme_id) {
			$scheme = Scheme::find($scheme_id);
			if(isset($scheme->name)){
				array_push($totalSchemes, $scheme);
			}
		}

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

	
	
	
	

	$deptTotalIndCount =0;
	$deptNaCount=0;
	$deptOntrackCount=0;
	$deptOfftrackCount=0;
	$deptInprogressCount=0;


		
		foreach ($totalSchemes as $scheme) {
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
					$outputIndicators = $output->outputIndicators()->get();
					$totalIndicatorscount += count($outputIndicators);
					$totalNaCount +=  $output->outputIndicators()->where('status',1)->count();
					$totalOntrackCount +=  $output->outputIndicators()->where('status',2)->count();
					$totalOfftrackCount +=  $output->outputIndicators()->where('status',3)->count();
					$totalInprogressCount  +=  $output->outputIndicators()->where('status',4)->count();

					$deptTotalIndCount += count($outputIndicators);
					$deptNaCount += $output->outputIndicators()->where('status',1)->count();
					$deptOntrackCount +=$output->outputIndicators()->where('status',2)->count();
					$deptOfftrackCount += $output->outputIndicators()->where('status',3)->count();
					$deptInprogressCount += $output->outputIndicators()->where('status',4)->count();

					$outcomes = $output->outcomes()->get();


					foreach ($outcomes as $outcome) {
						$outcomeIndicators = $outcome->outcomeIndicators()->get(); 
						
						$totalIndicatorscount += count($outcomeIndicators);
						$deptTotalIndCount += count($outcomeIndicators);
						$totalNaCount += $outcome->outcomeIndicators()->where('status',1)->count();
						$deptNaCount +=$outcome->outcomeIndicators()->where('status',1)->count();
						$totalOntrackCount += $outcome->outcomeIndicators()->where('status',2)->count();
						$deptOntrackCount += $outcome->outcomeIndicators()->where('status',2)->count();
						$totalOfftrackCount += $outcome->outcomeIndicators()->where('status',3)->count();
						$deptOfftrackCount +=$outcome->outcomeIndicators()->where('status',3)->count();
						$totalInprogressCount += $outcome->outcomeIndicators()->where('status',4)->count();
						$deptInprogressCount +=$outcome->outcomeIndicators()->where('status',4)->count();
						
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
	return response()->json(['dept_id'=>$dept_id,'sectors'=>$sectors,'schemes'=>$totalSchemes,'lables'=>$lables,'totalIndicators'=>$totalIndicators,'totalNa'=>$totalNa,'ontrack'=>$ontrack,'offtrack'=>$offtrack,'inprogress'=>$inprogress,'xtotalIndicators'=>$xtotalIndicators,'xtotalNa'=>$xtotalNa,'xontrack'=>$xontrack,'xofftrack'=>$xofftrack,'xinprogress'=>$xinprogress]);

}


	public function getCustomSchemeDetails(Request $request)
	{
		# code...
		$final_arr = array();
		$scheme_id = $request->input('scheme_id');
		$scheme = Scheme::find($scheme_id);
		$objectives = $scheme->objectives()->get();
		foreach($objectives as $objective){
			$final_arr[$objective->id]['name'] = $objective->description;
			$outputs = $objective->outputs()->get();
			foreach($outputs as $output){
				$outputIndicators = $output->outputIndicators()->get();
				foreach($outputIndicators as $outputIndicator){
					$final_arr[$objective->id]['output'][$outputIndicator->id]['name'] = substr($outputIndicator->name, 0, 50);
					$final_arr[$objective->id]['output'][$outputIndicator->id]['status'] = $outputIndicator->status;
					$outputTargets = $outputIndicator->outputTargets()->get();
					$target = 0;
					$achievement_total = 0;
					foreach($outputTargets as $outputTarget){
						if(is_numeric($outputTarget->value)){
							$target = $target + $outputTarget->value;
						}
						$achievements = $outputTarget->achievements()->get();
						foreach($achievements as $achievement){
							if(is_numeric($achievement->value)){
								$achievement_total = $achievement_total + $achievement->description;
							}
						}
					}
					$final_arr[$objective->id]['output'][$outputIndicator->id]['target'] = $target;
					$final_arr[$objective->id]['output'][$outputIndicator->id]['achievement'] = $achievement_total;
				}
				$outcomes = $output->outcomes()->get();
				foreach ($outcomes as $outcome) {
					# code...
					$outcomeIndicators = $outcome->outcomeIndicators()->get();
					foreach($outcomeIndicators as $outcomeIndicator){
						$final_arr[$objective->id]['outcome'][$outcomeIndicator->id]['name'] = substr($outcomeIndicator->name, 0, 50);
						$final_arr[$objective->id]['outcome'][$outcomeIndicator->id]['status'] = $outcomeIndicator->status;
						$outcomeTargets = $outcomeIndicator->outcomeTargets()->get();
						$achievement_total = 0;
						$target=0;
						foreach($outcomeTargets as $outcomeTarget){
							if(is_numeric($outcomeTarget->value)){
								$target = $target + $outcomeTarget->value;
							}
							$achievements = $outputTarget->achievements()->get();
							foreach($achievements as $achievement){
								if(is_numeric($achievement->value)){
									$achievement_total = $achievement_total + $achievement->description;
								}
							}
						}
						$final_arr[$objective->id]['outcome'][$outcomeIndicator->id]['target'] = $target;
						$final_arr[$objective->id]['outcome'][$outcomeIndicator->id]['achievement'] = $achievement_total;
					}
				}
			}
		}
		$data['scheme_dets'] = $final_arr;
		return view('scheme_dets', $data);
		// echo "<pre>";
		// print_r($final_arr);
		// echo "</pre>";
	}
}
