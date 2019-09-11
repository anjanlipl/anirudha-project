<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outputindicator;
use App\Outcomeindicator;
use App\Outputtarget;
use App\Achievement;
use App\Output;
use App\Department;
use App\Scheme;
use App\EvaluationCriteria;
use App\Outcometarget;
use App\Outcome;
use App\IndicatorUnit;
use App\OutcomeAchievement;
use Excel;


class TargetEntryController extends Controller
{

	public function __construct()
     {
       // $this->middleware('auth');
        $this->data = "";
     }
	
	public function showSchemeIndicators(Request $request){
		//return $request;die();
		// print_r($request->input());
		$dept_id = $request->input('dept_id');
		$depart = Department::find($dept_id);
		$units = $depart->units()->get();
		$year =  $request->input('year');
		$dates = explode('-', $year);
	  	$start_dates = date('Y-m-d', strtotime($dates[0].'-04-01'));
	  	$end_dates = date('Y-m-d', strtotime('20'.$dates[1].'-03-31'));

		if(count($units) > 1){
	        $schemes_ret = array();
			$k=0;
			foreach ($units as $unit) {
				# code...
				$schemes = $unit->schemes()->orderBy('name', 'asc')->get();
		        
		        foreach($schemes as $scheme){
		        	$outcomeIndicators = array();
					$outcomeIndicatorsFinal = array();
					$outputIndicators=array();
					$outputIndicatorsFinal=array();
					$objectives = $scheme->objectives()->get();
			  		$indicator_units = IndicatorUnit::all();
			  		$i=0;
			  		$j=0;
					if(count($objectives)>0){
						foreach ($objectives as $objective) {		
							$outputs = $objective->outputs()->get();
							foreach ($outputs as $output) {
								$outputIndicators = $output->outputIndicators()->get();
					  			foreach ($outputIndicators as $key=>$outputIndicator) {
									# code...
									$outputIndicatorsFinal[$i] = $outputIndicators[$key];
									$outputTargets = $outputIndicator->outputTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
									//print_r($outputTargets);
									$outputIndicatorsFinal[$i]->targets = $outputTargets;
									$i++;
					  			}
								$outcomes = $output->outcomes()->get();
								foreach ($outcomes as $outcome) {
									$outcomeIndicators = $outcome->outcomeIndicators()->get();
									foreach ($outcomeIndicators as $key1=>$outcomeIndicator) {
										$outcomeIndicatorsFinal[$j] = $outcomeIndicators[$key1];
										$outcomeTargets = $outcomeIndicator->outcomeTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
										$outcomeIndicatorsFinal[$j]->targets = $outcomeTargets;
										$j++;
					  				}
										
								}
							}
						}
					}
					$schemes_ret[$k]['name'] = $scheme->name;
					$schemes_ret[$k]['outputs'] = $outputIndicatorsFinal;
					$schemes_ret[$k]['outcomes'] = $outcomeIndicatorsFinal;
					$k++;
		        }
			}
		}
		else{

			$unit = $depart->units()->where('is_default',1)->first();
	        
	        $schemes = $unit->schemes()->orderBy('name', 'asc')->get();
	        $schemes_ret = array();
	        $k=0;
	        foreach($schemes as $scheme){
	        	$outcomeIndicators = array();
				$outcomeIndicatorsFinal = array();
				$outputIndicators=array();
				$outputIndicatorsFinal=array();
				$objectives = $scheme->objectives()->get();
		  		$indicator_units = IndicatorUnit::all();
		  		$i=0;
		  		$j=0;
				if(count($objectives)>0){
					foreach ($objectives as $objective) {		
						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							$outputIndicators = $output->outputIndicators()->get();
				  			foreach ($outputIndicators as $key=>$outputIndicator) {
								# code...
								$outputIndicatorsFinal[$i] = $outputIndicators[$key];
								$outputTargets = $outputIndicator->outputTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
								//print_r($outputTargets);
								$outputIndicatorsFinal[$i]->targets = $outputTargets;
								$i++;
				  			}
							$outcomes = $output->outcomes()->get();
							foreach ($outcomes as $outcome) {
								$outcomeIndicators = $outcome->outcomeIndicators()->get();
								foreach ($outcomeIndicators as $key1=>$outcomeIndicator) {
									$outcomeIndicatorsFinal[$j] = $outcomeIndicators[$key1];
									$outcomeTargets = $outcomeIndicator->outcomeTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
									$outcomeIndicatorsFinal[$j]->targets = $outcomeTargets;
									$j++;
				  				}
							}
						}
					}
				}
				$schemes_ret[$k]['name'] = $scheme->name;
				$schemes_ret[$k]['outputs'] = $outputIndicatorsFinal;
				$schemes_ret[$k]['outcomes'] = $outcomeIndicatorsFinal;
				$k++;
	        }
        }



        return response()->json(['schemes'=>$schemes_ret, 'indicator_units' => $indicator_units]);



		// $scheme = Scheme::find($schemeId);
	}


	public function exportSchemeIndicators(Request $request){
		$dept_id = $request->input('dept_id');
		$depart = Department::find($dept_id);
		$units = $depart->units()->get();
		$year =  $request->input('year');
		$dates = explode('-', $year);
	  	$start_dates = date('Y-m-d', strtotime($dates[0].'-04-01'));
	  	$end_dates = date('Y-m-d', strtotime('20'.$dates[1].'-03-31'));
		if(count($units) > 1){
	        $schemes_ret = array();
			$k=0;
			foreach ($units as $unit) {
				# code...
				$schemes = $unit->schemes()->orderBy('name', 'asc')->get();
		        
		        foreach($schemes as $scheme){
		        	$outcomeIndicators = array();
					$outcomeIndicatorsFinal = array();
					$outputIndicators=array();
					$outputIndicatorsFinal=array();
					$objectives = $scheme->objectives()->get();
			  		$indicator_units = IndicatorUnit::all();
			  		$i=0;
			  		$j=0;
					if(count($objectives)>0){
						foreach ($objectives as $objective) {		
							$outputs = $objective->outputs()->get();
							foreach ($outputs as $output) {
								$outputIndicators = $output->outputIndicators()->get();
					  			foreach ($outputIndicators as $key=>$outputIndicator) {
									# code...
									$outputIndicatorsFinal[$i] = $outputIndicators[$key];
									$outputTargets = $outputIndicator->outputTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
									$outputIndicatorsFinal[$i]->targets = $outputTargets;
									$i++;
					  			}
								$outcomes = $output->outcomes()->get();
								foreach ($outcomes as $outcome) {
									$outcomeIndicators = $outcome->outcomeIndicators()->get();
									foreach ($outcomeIndicators as $key1=>$outcomeIndicator) {
										$outcomeIndicatorsFinal[$j] = $outcomeIndicators[$key1];
										$outcomeTargets = $outcomeIndicator->outcomeTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
										$outcomeIndicatorsFinal[$j]->targets = $outcomeTargets;
										$j++;
					  				}
										
								}
							}
						}
					}
					$schemes_ret[$k]['name'] = $scheme->name;
					$schemes_ret[$k]['outputs'] = $outputIndicatorsFinal;
					$schemes_ret[$k]['outcomes'] = $outcomeIndicatorsFinal;
					$k++;
		        }
			}
		}
		else{

			$unit = $depart->units()->where('is_default',1)->first();
	        
	        $schemes = $unit->schemes()->orderBy('name', 'asc')->get();
	        $schemes_ret = array();
	        $k=0;
	        foreach($schemes as $scheme){
	        	$outcomeIndicators = array();
				$outcomeIndicatorsFinal = array();
				$outputIndicators=array();
				$outputIndicatorsFinal=array();
				$objectives = $scheme->objectives()->get();
		  		$indicator_units = IndicatorUnit::all();
		  		$i=0;
		  		$j=0;
				if(count($objectives)>0){
					foreach ($objectives as $objective) {		
						$outputs = $objective->outputs()->get();
						foreach ($outputs as $output) {
							$outputIndicators = $output->outputIndicators()->get();
				  			foreach ($outputIndicators as $key=>$outputIndicator) {
								# code...
								$outputIndicatorsFinal[$i] = $outputIndicators[$key];
								$outputTargets = $outputIndicator->outputTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
								$outputIndicatorsFinal[$i]->targets = $outputTargets;
								$i++;
				  			}
							$outcomes = $output->outcomes()->get();
							foreach ($outcomes as $outcome) {
								$outcomeIndicators = $outcome->outcomeIndicators()->get();
								foreach ($outcomeIndicators as $key1=>$outcomeIndicator) {
									$outcomeIndicatorsFinal[$j] = $outcomeIndicators[$key1];
									$outcomeTargets = $outcomeIndicator->outcomeTargets()->where([
											['start_date', '>=', $start_dates],
											['end_date', '<=', $end_dates]
										])->get();
									$outcomeIndicatorsFinal[$j]->targets = $outcomeTargets;
									$j++;
				  				}
							}
						}
					}
				}
				$schemes_ret[$k]['name'] = $scheme->name;
				$schemes_ret[$k]['outputs'] = $outputIndicatorsFinal;
				$schemes_ret[$k]['outcomes'] = $outcomeIndicatorsFinal;
				$k++;
	        }
        }

        $data['schemes'] = $schemes_ret;
        $this->data = $data;
        $sheet_title = $this->rand_string(12);
        Excel::create($sheet_title, function($excel) {

            $excel->sheet('Sheet 1', function($sheet) {
                $sheet->loadView('add_achive', $this->data);
            });

            $lastrow= $excel->getActiveSheet()->getHighestRow();
            // echo 'A1:P'.$lastrow;
            $excel->getActiveSheet()->getStyle('A1:P'.$lastrow)->getAlignment()->setWrapText(true);
            $excel->getActiveSheet()->getColumnDimension('A')->setVisible(false);
            for($rowIndex=1; $rowIndex<=$lastrow; $rowIndex++){
                $excel->getActiveSheet()->getRowDimension($rowIndex)->setRowHeight(70);
            }
            $excel->getActiveSheet()->cells('A1:P'.$lastrow, function($cells) {
                // manipulate the range of cells
                $cells->setValignment('middle');

            });

            $excel->getActiveSheet()->setStyle([
                'borders' => [
                    'allborders' => [
                        'color' => [
                            'rgb' => 'DDDDDD'
                        ]
                    ]
                ]
            ]);


            $excel->getActiveSheet()->setWidth(array(
                'A'     =>  0,
                'B'     =>  30,
                'C'     =>  30,
                'D'     =>  30,
                'E'     =>  30,
                'F'     =>  30,
                'G'     =>  30,
                'H'     =>  30,
                'I'     =>  30,
                'J'     =>  30,
                'K'     =>  30,
                'L'     =>  30,
                'M'     =>  30,
                'N'     =>  30,
                'O'     =>  30,
                'P'     =>  30,
            ));

        })->store('xlsx', public_path('uploads'));

        $path = 'uploads/'.$sheet_title.'.xlsx';
		// $headers = ['Content-Type':'application/xlsx'];
		// $headers = [
  //           'Content-type'        => 'application/pdf',
  //           'Content-Disposition' => 'attachment; filename="' . $path .
  //               '"',
  //           'Content-Transfer-Encoding' => 'Binary"',
  //       ];
        return $path;
	}


	function rand_string( $length ) {  
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz@#$&*";  
		$size = strlen( $chars );
		$str = "";
		for( $i = 0; $i < $length; $i++ ) {  
			$str.= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}


	public function uploadAchieve(Request $request)
	{
		# code...
		$this->validate($request, [
            'dept_id'=>'required'
        ]);
		
		$quarter = $request->input('quarter');
		
		if($quarter == 'q1'){
			$qrt = '06';
		}
		if($quarter == 'q2'){
			$qrt = '09';
		}
		if($quarter == 'q3'){
			$qrt = '12';
		}
		if($quarter == 'q4'){
			$qrt = '03';
		}
		
		$year =  $request->input('year');
		
		$dates = explode('-', $year);
	  	
	  	$start_dates = date('Y-m-d', strtotime($dates[0].'-04-01'));
	  	
	  	if($qrt == '03'){
	  		$end_dates = date('Y-m-d', strtotime('20'.$dates[1].'-'.$qrt.'-31'));
	  	}
	  	else{
	  		$end_dates = date('Y-m-d', strtotime($dates[0].'-'.$qrt.'-31'));
	  	}

	  	// print_r($start_dates); die;
        
        $file = $request->file('excel');
        $destinationPath = 'uploads/schemes';
        $img_path ='';
        if(isset($file)){
            $file->move($destinationPath, $file->getClientOriginalName());
            $img_path = $destinationPath . '/' . $file->getClientOriginalName();
            $reader = \Excel::load($img_path, 'UTF-8');
            $reader->ignoreEmpty();
            $reader->noHeading();
            $results = $reader->get();
            foreach($results as $sheet){
            // }
            // $reader->each(function($sheet){
            	if($sheet[0]!=''){
            		// echo $sheet[0];
            		$targ_data = explode('-', $sheet[0]);
            		if($targ_data[0] == 'output'){
						$target = Outputtarget::find($targ_data[1]);
						if(!empty($sheet[4])){
							$remark = $sheet[4];
						}
						else{
							$remark="";
						}
						if(!empty($sheet[3])){
							$achieveValue = $sheet[3];
							$achievement = $target->achievements()->create([
							  	'description' => $achieveValue,
							  	'start_date' => $start_dates,
							  	'end_date' => $end_dates,
							  	'remarks' => $remark
							]);
						}
            		}

            		if($targ_data[0] == 'outcome'){
						$target = Outcometarget::find($targ_data[1]);
						if(!empty($sheet[4])){
							$remark = $sheet[4];
						}
						else{
							$remark="";
						}
						if(!empty($sheet[3])){
							$achieveValue = $sheet[3];
							$achievement = $target->achievements()->create([
							  	'description' => $achieveValue,
							  	'start_date' => $start_dates,
							  	'end_date' => $end_dates,
							  	'remarks' => $remark
							]);
						}
            		}
        		}
            }
      	}

      	return response(['success'=>true], 200);
	}

	public function addTargetSubmit(Request $request)
	{
		$allRequest = $request->all();
		$indicator_ids =  $request->input('ind_id');
		$indicator_types =  $request->input('ind_type');
		$targetNames =  array();
		$values =  $request->input('value');
		$year =  $request->input('year');
		// $end_dates =  $request->input('end_date');
		$remarks =  $request->input('remark');
		$dates = explode('-', $year);
		// print_r($year);
		// die;
	  	$start_dates = date('Y-m-d', strtotime($dates[0].'-04-01'));
	  	$end_dates = date('Y-m-d', strtotime('20'.$dates[1].'-03-31'));

		$totalInds = count($indicator_ids);

		for($i=0;$i< $totalInds;$i++){
			$ind_id = $indicator_ids[$i];
			if($indicator_types[$i] == 1){
				$indicator = Outputindicator::find($ind_id);
				if($values[$i] != null){
				$targetNames[$i] = 'Target '.$dates[0].'-'.$dates[1];
		  if(empty($remarks[$i])){
			$remarks[$i] = " ";
		  }
		  $dates_full = explode(' ', $targetNames[$i]);
					 $indicator->outputTargets()->create([
						'name'=>$targetNames[$i],
						'value'=>$values[$i],
						'start_date'=>$start_dates,
						'end_date'=>$end_dates,
						'remark'=>$remarks[$i]

					]);
		  }
				}
		else{
				$indicator = Outcomeindicator::find($ind_id);
				if($values[$i] != null){
				  if(empty($remarks[$i])){
			$remarks[$i] = " ";
		  }
		  // $dates_full = explode(' ', $targetNames[$i]);
		  // $dates = explode('-', $dates_full[1]);
		  // $start_dates[$i] = date('Y-m-d', strtotime($dates[0].'-04-01'));
		  // $end_dates[$i] = date('Y-m-d', strtotime('20'.$dates[1].'-03-31'));
		  $indicator->outcomeTargets()->create([
					'name'=>$targetNames[$i],
					'value'=>$values[$i],
					'start_date'=>$start_dates,
					'end_date'=>$end_dates,
					'remark'=>$remarks[$i]
				 ]);
				}
				
			}
		}

		return response()->json(['allRequest'=>$allRequest,'count'=>$totalInds]);
	}

	//  public function addAchievementSubmit(Request $request)
	// {

 //    $target_ids = $request->input('target_ids');
 //    $type = $request->input('type');
 //    $achievement_val = $request->input('achievement_val');
 //    $start_date = $request->input('start_date');
 //    $end_date = $request->input('end_date');
 //    $remarks = $request->input('remarks');
 //    $ind_ids = $request->input('ind_ids');
 //    $ind_types = $request->input('ind_types');
 //    $ind_unit = $request->input('ind_unit');
 //    $evaluation_types = $request->input('evaluation_types');
 //    // print_r($evaluation_types); die;
 //    foreach($ind_ids as $key1=>$value1){
 //      if($ind_types[$key1] == 'output'){
 //        $indic = Outputindicator::find($value1);
 //        if(!empty($ind_unit[$key1])){
 //          $indic->unit_id = $ind_unit[$key1];
 //        }
 //        if(!empty($evaluation_types[$key1])){
 //          $indic->respond_to_criteria = $evaluation_types[$key1];
 //        }
 //        $indic->save();
 //      }
 //      else if($ind_types[$key1] == 'outcome'){
 //        $indic = Outcomeindicator::find($value1);
 //        if(!empty($ind_unit[$key1])){
 //          $indic->unit_id = $ind_unit[$key1];
 //        }
 //        if(!empty($evaluation_types[$key1])){
 //          $indic->respond_to_criteria = $evaluation_types[$key1];
 //        }
 //        $indic->save();
 //      }
 //    }

 //    foreach ($target_ids as $key => $value) {
 //      # code...
 //      if($type[$key] == 'output'){
 //        if(!empty($achievement_val[$key])){
 //          $target_id = $target_ids[$key];

 //        $target = Outputtarget::find($target_id);
 //        $targetVal = $target->value;
 //        $achieveValue = $achievement_val[$key];
 //        $per = 0;
 //        if(isset($target))
 //        {
 //            //return $target->id ;exit;
 //            if(empty($remarks[$key])){
 //              $remarks[$key] = " ";
 //            }
 //            $indicator_id = $target->outputindicator_id;
 //            $indicator = Outputindicator::find($indicator_id);
 //            $achievement = $target->achievements()->create([
 //              'description' => $achievement_val[$key],
 //              'start_date' => $start_date[$key],
 //              'end_date' => $end_date[$key],
 //              'remarks' => $remarks[$key]
 //            ]);
 //            // if($achieveValue == 'NA' || $achieveValue == 'na'){
 //            //   $indicator->status = 4;
 //            //   $indicator->save();
 //            //   continue;
 //            //   // return response()->json(['success'=>'true']);
 //            // }
 //            // elseif($achieveValue == 'NR' || $achieveValue == 'nr'){
 //            //   $indicator->status = 1;
 //            //   $indicator->save();
 //            //   continue;
 //            //   // return response()->json(['success'=>'true']);
 //            // }
 //            // if($indicator->unit_id == 15){


 //            //   $achivements =$target->achievements()->get();
 //            //   $cummulativeAchieve = 0 ;
 //            //   if(isset($achivements) && count($achivements)>0){

 //            //     foreach ($achivements as $achievementItem) {

 //            //     $desc =$achievementItem->description;
 //            //     $descNew = str_replace("%", "",$desc );
			
 //            //     $cummulativeAchieve += $descNew;
 //            //     }
 //            //   }
			  
 //            //   $per = ($cummulativeAchieve/$targetVal)*100;


 //            // }
 //            // else if($indicator->unit_id == 16){
 //            //   // $achieveValueNew = str_replace("%", "",$achieveValue );
 //            //   $numbers=explode(":",$achieveValue);
 //            //   $targetValNew = round($numbers[0]/$numbers[1],6);
 //            //   // $targetValNew = str_replace("%", "",$targetVal );
 //            //   $achivements =$target->achievements()->get();
 //            //   $cummulativeAchieve = 0 ;
 //            //   if(isset($achivements) && count($achivements)>0){
 //            //     foreach ($achivements as $achievementItem) {
 //            //       $desc =$achievementItem->description;
 //            //       $numbers=explode(":",$desc);
 //            //       $descNew = round($numbers[0]/$numbers[1],6);
 //            //       // $descNew = str_replace("%", "",$desc );
 //            //       $cummulativeAchieve += $descNew;
 //            //     }
 //            //     $per = ($cummulativeAchieve/$targetValNew)*100;
 //            //   }

			  
 //            // }
 //            // else if($indicator->unit_id == 17){
			  

 //            //   $achieveValueNew = str_replace("%", "",$achieveValue );
 //            //   $targetValNew = str_replace("%", "",$targetVal );
 //            //   $achivements =$target->achievements()->get();
 //            //   $cummulativeAchieve = 0 ;
 //            //   if(isset($achivements) && count($achivements)>0){
 //            //     foreach ($achivements as $achievementItem) {
 //            //       $desc =$achievementItem->description;
 //            //       $descNew = str_replace("%", "",$desc );
 //            //       $cummulativeAchieve += $descNew;
 //            //     }
 //            //   }
 //            //   $per = ($cummulativeAchieve/$targetValNew)*100;


 //            // }
 //            // else if($indicator->unit_id == 18){
 //            //     if($indicator->respond_to_criteria == 1){
 //            //       if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
 //            //         $indicator->status = 2;
 //            //       }
 //            //       else{
 //            //         $indicator->status = 3;
 //            //       }
 //            //       $indicator->save();
 //            //     }
 //            //     else{
 //            //       if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
 //            //         $indicator->status = 3;
 //            //       }
 //            //       else{
 //            //         $indicator->status = 2;
 //            //       }
 //            //       $indicator->save();
 //            //     }
 //            //     continue;

 //            //     // return response()->json(['success'=>'true','achievement'=>$achievement,'indicator'=>$indicator,'per'=>$per,'evalcriteria'=>$evalcriteria,'criteriaPer'=>$criteriaPer,'is_capital'=>$scheme->is_capital]);

 //            // }
 //            // else{
			  
 //            // }

 //            // $output = $indicator->output()->first();
 //            // $objective = $output->objective()->first();
 //            // $scheme = $objective->scheme()->first();
 //            // $today = date('Y-m-d');
 //            // // echo $today; die;
 //            // $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
 //            // $criteriaPer = $evalcriteria->percentage;
 //            // if($scheme->is_capital !=1){
 //            //    if($indicator->respond_to_criteria == 1){
 //            //        if($per > $criteriaPer){
 //            //       $indicator->status = 2;
 //            //     }else{
 //            //       $indicator->status = 3;
 //            //     }
 //            //    }else{
 //            //        if($per > $criteriaPer){
 //            //         $indicator->status = 3;
 //            //       }else{
 //            //         $indicator->status = 2;
 //            //       }
 //            //    }
				 
 //            //     $indicator->save();
 //            // }else{
 //            //   $targetEndDate = $target->end_date;
			  

 //            //      if($indicator->respond_to_criteria == 1){
 //            //        if($per >$criteriaPer && $targetEndDate < $today){
 //            //           $indicator->status = 2;
 //            //         }else{
 //            //           $indicator->status = 3;
 //            //         }
 //            //    }else{
 //            //        if($per >$criteriaPer && $targetEndDate < $today){
 //            //       $indicator->status = 3;
 //            //     }else{
 //            //       $indicator->status = 2;
 //            //     }
 //            //    }
 //            //     $indicator->save();
 //            // }
 //        }
 //        }
 //      }
 //    }
 //      else if($type[$key] == 'outcome'){
 //        if(!empty($achievement_val[$key])){
 //          $target_id = $target_ids[$key];
 //        $target = Outcometarget::find($target_id);
 //        $targetVal = $target->value;
 //        $achieveValue = $achievement_val[$key];
 //        $per = 0;
 //        if(isset($target))
 //        {
 //            //return $target->id ;exit;
			 
 //            $indicator_id = $target->outcomeindicator_id;
 //            $indicator = Outcomeindicator::find($indicator_id);
 //            if($achieveValue == 'NA' || $achieveValue == 'na'){
 //              $indicator->status = 4;
 //              $indicator->save();
 //              continue;
 //            }
 //            elseif($achieveValue == 'NR' || $achieveValue == 'nr'){
 //              $indicator->status = 1;
 //              $indicator->save();
 //              continue;
 //            }
 //            if(empty($remarks[$key])){
 //              $remarks[$key] = " ";
 //            }
 //            $achievement = $target->outcomeAchievements()->create([
 //              'description' => $achievement_val[$key],
 //              'start_date' => $start_date[$key],
 //              'end_date' => $end_date[$key],
 //              'remarks' => $remarks[$key]
 //            ]);
 //            // if($indicator->unit_id == 15){


 //            //   $achivements =$target->outcomeAchievements()->get();
 //            //   $cummulativeAchieve = 0 ;
 //            //   if(isset($achivements) && count($achivements)>0){

 //            //     foreach ($achivements as $achievementItem) {

 //            //       $desc =$achievementItem->description;
 //            //       // $descNew = str_replace("%", "",$desc );
 //            //       if(is_numeric($desc)){
 //            //         $cummulativeAchieve += $desc;
 //            //       }
 //            //     }
 //            //   }
			  
 //            //   $per = ($cummulativeAchieve/$targetVal)*100;


 //            // }
 //            // else if($indicator->unit_id == 16){


 //            //   // $achieveValueNew = str_replace("%", "",$achieveValue );
 //            //   $numbers=explode(":",$achieveValue);
 //            //   $targetValNew = round($numbers[0]/$numbers[1],6);
 //            //   // $targetValNew = str_replace("%", "",$targetVal );
 //            //   $achivements =$target->outcomeAchievements()->get();
 //            //   $cummulativeAchieve = 0 ;
 //            //   if(isset($achivements) && count($achivements)>0){
 //            //     foreach ($achivements as $achievementItem) {
 //            //       $desc =$achievementItem->description;
 //            //       $numbers=explode(":",$desc);
 //            //       $descNew = round($numbers[0]/$numbers[1],6);
 //            //       // $descNew = str_replace("%", "",$desc );
 //            //       $cummulativeAchieve += $descNew;
 //            //     }
 //            //     $per = ($cummulativeAchieve/$targetValNew)*100;
 //            //   }

			  
 //            // }
 //            // else if($indicator->unit_id == 17){
			  

 //            //   $achieveValueNew = str_replace("%", "",$achieveValue );
 //            //   $targetValNew = str_replace("%", "",$targetVal );
 //            //   $achivements =$target->outcomeAchievements()->get();
 //            //   $cummulativeAchieve = 0 ;
 //            //   if(isset($achivements) && count($achivements)>0){
 //            //     foreach ($achivements as $achievementItem) {
 //            //       $desc =$achievementItem->description;
 //            //       $descNew = str_replace("%", "",$desc );
 //            //       $cummulativeAchieve += $descNew;
 //            //     }
 //            //   }
 //            //   $per = ($cummulativeAchieve/$targetValNew)*100;


 //            // }
 //            // else if($indicator->unit_id == 18){
 //            //     if($indicator->respond_to_criteria == 1){
 //            //       if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
 //            //         $indicator->status = 2;
 //            //       }
 //            //       else{
 //            //         $indicator->status = 3;
 //            //       }
 //            //       $indicator->save();
 //            //     }
 //            //     else{
 //            //       if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
 //            //         $indicator->status = 3;
 //            //       }
 //            //       else{
 //            //         $indicator->status = 2;
 //            //       }
 //            //       $indicator->save();
 //            //     }

 //            //     continue;

 //            // }
 //            // else{
			  
 //            // }

 //            // $outcome = $indicator->outcome()->first();
 //            // $output = $outcome->output()->first();
 //            // $objective = $output->objective()->first();
 //            // $scheme = $objective->scheme()->first();
 //            // $today = date('Y-m-d');
 //            // // echo $today; die;
 //            // $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
 //            // $criteriaPer = $evalcriteria->percentage;
 //            // if($scheme->is_capital !=1){
 //            //   if($indicator->respond_to_criteria == 1){
 //            //     if($per > $criteriaPer){
 //            //       $indicator->status = 2;
 //            //     }
 //            //     else{
 //            //       $indicator->status = 3;
 //            //     }
 //            //   }
 //            //   else{
 //            //     if(isset($evalcriteria->percentage)){
 //            //       $criteriaPer = $evalcriteria->percentage;
 //            //     }
 //            //     else{
 //            //       $criteriaPer = 70;
 //            //     }
 //            //   }
 //            //   $indicator->save();
 //            // }
 //            // else{
 //            //   $targetEndDate = $target->end_date;
 //            //      if($indicator->respond_to_criteria == 1){
 //            //        if($per >$criteriaPer && $targetEndDate < $today){
 //            //           $indicator->status = 2;
 //            //         }else{
 //            //           $indicator->status = 3;
 //            //         }
 //            //    }else{
 //            //        if($per >$criteriaPer && $targetEndDate < $today){
 //            //       $indicator->status = 3;
 //            //     }else{
 //            //       $indicator->status = 2;
 //            //     }
 //            //    }
 //            //     $indicator->save();
 //            // }
 //        }
 //        }
 //      }

 //    }
 //        return response()->json(['success'=>true]);
	// }


public function addAchievementSubmit(Request $request) {
	//return $request;
	$target_ids = $request->input('target_ids');
	$type = $request->input('type');
	$achievement_val = $request->input('achievement_val');
	$year = $request->input('year');
	$quarter = $request->input('quarter');
	//$target_indicator_ids = $request->input('target_indicator_ids');
	//print_r($target_indicator_ids);
	//print_r($target_ids);die();
	if($quarter == 'q1'){
		$qrt = '06';
	}
	if($quarter == 'q2'){
		$qrt = '09';
	}
	if($quarter == 'q3'){
		$qrt = '12';
	}
	if($quarter == 'q4'){
		$qrt = '03';
	}

	$year =  $request->input('year');
		// $end_dates =  $request->input('end_date');
	$dates = explode('-', $year);
  	$start_dates = date('Y-m-d', strtotime($dates[0].'-04-01'));
  	if($qrt == '03'){
  		$end_dates = date('Y-m-d', strtotime('20'.$dates[1].'-'.$qrt.'-31'));
  	}
  	else{
  		$end_dates = date('Y-m-d', strtotime($dates[0].'-'.$qrt.'-31'));
  	}
	// $start_date = $request->input('start_date');

	// $end_date = $request->input('end_date');
	$remarks = $request->input('remarks');
	$ind_ids = $request->input('ind_ids');
	$ind_types = $request->input('ind_types');
	$ind_unit = $request->input('ind_unit');
	$evaluation_types = $request->input('evaluation_types');
	
	// print_r($evaluation_types); die;
	// foreach($ind_ids as $key1=>$value1){
	//   	if($ind_types[$key1] == 'output'){
	// 		$indic = Outputindicator::find($value1);
	// 		if(!empty($ind_unit[$key1])){
	// 	  		$indic->unit_id = $ind_unit[$key1];
	// 		}
	// 		if(!empty($evaluation_types[$key1])){
	// 	  		$indic->respond_to_criteria = $evaluation_types[$key1];
	// 		}
	// 		$indic->save();
	//   	}
	//   	else if($ind_types[$key1] == 'outcome'){
	// 		$indic = Outcomeindicator::find($value1);
	// 		if(!empty($ind_unit[$key1])){
	// 	  		$indic->unit_id = $ind_unit[$key1];
	// 		}
	// 		if(!empty($evaluation_types[$key1])){
	// 	  		$indic->respond_to_criteria = $evaluation_types[$key1];
	// 		}
	// 		$indic->save();
	//   	}
	// }

	//return $achievement_val;
	foreach ($target_ids as $key => $value) {
		//echo $achievement_val[$key];
		//print_r($target_ids); 
	  	# code...
	  	if($type[$key] == 'output'){
			if(!empty($achievement_val[$key])){
		  		$target_id = $target_ids[$key];
				$target = Outputtarget::find($target_id);
				$targetVal = $target->value;
				$achieveValue = $achievement_val[$key];
				$per = 0;
				if(isset($target)) {
					//return $target->id ;exit;
					if(empty($remarks[$key])){
			  			$remarks[$key] = " ";
					}
					$indicator_id = $target->outputindicator_id;
					$indicator = Outputindicator::find($indicator_id);
					// echo $achieveValue;
					// print_r($indicator);die();
					if($achieveValue == 'NA' || $achieveValue == 'na'){
				  		$indicator->status = 1;
				  		$indicator->save();
				  		//continue;
					}
					elseif($achieveValue == 'NR' || $achieveValue == 'nr'){
				  		$indicator->status = 4;
				  		$indicator->save();
				  		//continue;
					}

					$achievement = $target->achievements()->create([
					  	'description' => $achievement_val[$key],
					  	'start_date' => $start_dates,
					  	'end_date' => $end_dates,
					  	'remarks' => $remarks[$key]
					]);
				}
			}
	  	}
	  	else if($type[$key] == 'outcome'){
			if(!empty($achievement_val[$key])){
			  	$target_id = $target_ids[$key];
				$target = Outcometarget::find($target_id);
				$targetVal = $target->value;
				$achieveValue = $achievement_val[$key];
				$per = 0;
				if(isset($target)) {
					$indicator_id = $target->outcomeindicator_id;
					$indicator = Outcomeindicator::find($indicator_id);
					if($achieveValue == 'NA' || $achieveValue == 'na'){
				  		$indicator->status = 1;
				  		$indicator->save();
				  		//continue;
					}
					elseif($achieveValue == 'NR' || $achieveValue == 'nr'){
				  		$indicator->status = 4;
				  		$indicator->save();
				  		//continue;
					}
					if(empty($remarks[$key])){
				  		$remarks[$key] = " ";
					}
					$achievement = $target->outcomeAchievements()->create([
					  	'description' => $achievement_val[$key],
					  	'start_date' => $start_dates,
					  	'end_date' => $end_dates,
					  	'remarks' => $remarks[$key]
					]);
					
				}
			}
	  	}

	}//die();
	return response()->json(['success'=>true]);
}


  public function deleteInd(Request $request)
  {
	# code...
	$type = $request->input('type');
	$id = $request->input('id');
	if($type == 'output'){
	  $ind = Outputindicator::find($id);
	  $ind->delete();
	  return 'true';
	}
	if($type == 'outcome'){
	  $ind = Outcomeindicator::find($id);
	  $ind->delete();
	  return 'true';
	}

	return 'false';
  }

	
	
}
