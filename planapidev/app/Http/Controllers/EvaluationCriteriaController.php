<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaluationCriteria;

use App\Outcometarget;
use App\Outcomeindicator;
use App\outcomeAchievements;

use App\Outputtarget;
use App\Outputindicator;

use DB;

class EvaluationCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EvaluationCriteria::all();

         $result = array();

        foreach ($items as $item) {
             $actionBtn = '<div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Actions <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" id="actionDrop">
                                    <li><a class="edit" data-toggle="modal"
                                    data-target="#editSectorModal"  data-id="'.$item->id.'">Edit</a></li>
                                    <li><a class="delete" data-id="'.$item->id.'"  href="javascript:void(0);" >Delete</a></li>
                                </ul>
                            </div>';

                $createdDate = 'NA';

                if(isset($item->created_at)){
                  $createdDate =  date('d M, Y',strtotime($item->created_at) );
                }    
                array_push($result, [
                    $item->percentage,
                     date('d M, Y',strtotime($item->start_date)),
                     date('d M, Y',strtotime($item->end_date)),
                    // $createdDate,
                    $actionBtn
                ]);
        }
         return response()->json(['sectors'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
       public function getCriteriaDetails(Request $request )
    {

        $itemId = $request->input('itemId');
        $item = EvaluationCriteria::find($itemId);
        $result=array();
        $result['id']=$item->id;
        $result['percentage']=$item->percentage;
        $result['start_date']=date('Y-m-d',strtotime($item->start_date));
        $result['end_date']=date('Y-m-d',strtotime($item->end_date));
        return response()->json(['criteria'=>$result]);
       
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
            'percentage'=>'required|numeric',
            'start_date'=>'required',
            'end_date'=>'required',


        ]);
        $item = new EvaluationCriteria;
        $item->percentage = $request->input('percentage');
        $item->start_date = $request->input('start_date');
        $item->end_date = $request->input('end_date');

        $item->save();

        if(date('m') > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));

        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $begin_date = date('Y-04-01', strtotime('-1 years'));
            $end_date = date('Y-03-31');


            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }

        $scheme_outp = DB::table('schemes as s')
                        ->join('objectives as o', 'o.scheme_id', '=', 's.id')
                        ->join('outputs as op', 'op.objective_id', '=', 'o.id')
                        ->join('outputindicators as opi', 'opi.output_id', '=', 'op.id')
                        ->join('baselines as opb', 'opb.outputindicator_id', '=', 'opi.id', 'left')
                        ->join('outputtargets as opt', 'opt.outputindicator_id', '=', 'opi.id', 'left')
                        ->select('opt.id as target_id')
                        ->where([
                          ['opt.start_date', '>=', $request->input('start_date')],
                          ['opt.end_date', '<=', $request->input('end_date')]
                        ])
                        ->get();//$begin_date//$end_date
        // $sum1=0;
        // foreach($scheme_outp as $key30=>$value30){
        //     if(!empty($value30->opt_id)){
        //         $sum1 = DB::table('achievements')->where('outputtarget_id', $value30->opt_id)->sum('description');
        //     }
        //     $scheme_outp[$key30]->status = $sum1;
        // }

        foreach ($scheme_outp as $key => $value) {
            # code...

        }



        $scheme_outc = DB::table('schemes as s')
                        ->join('objectives as o', 'o.scheme_id', '=', 's.id')
                        ->join('outputs as op', 'op.objective_id', '=', 'o.id')
                        ->join('outcomes as oc', 'oc.output_id', '=', 'op.id')
                        ->join('outcomeindicators as oci', 'oci.outcome_id', '=', 'oc.id')
                        ->join('outcomebaselines as ocb', 'ocb.outcomeindicator_id', '=', 'oci.id', 'left')
                        ->join('outcometargets as oct', 'oct.outcomeindicator_id', '=', 'oci.id', 'left')
                        ->select('oct.id as oct_id')
                        ->where([
                          ['oct.start_date', '>=', $request->input('start_date')],
                          ['oct.end_date', '<=', $request->input('end_date')]
                        ])
                        ->get();

        // print_r($scheme_outp.'------------'.$scheme_outc);
        // die;

        foreach($scheme_outc as $key=>$value){
          //print_r($value);
            $this->outcomeStatus($value->oct_id,$request->input('start_date'),$request->input('end_date'));
        }

        foreach($scheme_outp as $key1=>$value1){
            $this->outputStatus($value1->target_id,$request->input('start_date'),$request->input('end_date'));
        }
        //$sectorCreated = Sector::where('name',$request->get('sectorName'))->first();
        
       
        return response()->json(['success'=>'true','criteria'=>$item]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'percentage_e'=>'required|numeric',
            'start_date_e'=>'required',
            'end_date_e'=>'required',


        ]);
        $item = EvaluationCriteria::find($id);
        $item->percentage = $request->input('percentage_e');
        $item->start_date = $request->input('start_date_e');
        $item->end_date = $request->input('end_date_e');

        $item->update();

        if(date('m') > 3){
            $current_begin_date = date('Y-04-01', strtotime('-2 years'));
            $current_end_date = date('Y-03-31', strtotime('-1 years'));

            $last_begin_date = date('Y-04-01', strtotime('-1 years'));
            $last_end_date = date('Y-03-31');

            $begin_date = date('Y-04-01');
            $end_date = date('Y-03-31', strtotime('+1 years'));


            $next_begin_date = date('Y-04-01', strtotime('+1 years'));
            $next_end_date = date('Y-03-31', strtotime('+2 years'));

        }
        else{
            $current_begin_date = date('Y-04-01', strtotime('-3 years'));
            $current_end_date = date('Y-03-31', strtotime('-2 years'));

            $last_begin_date = date('Y-04-01', strtotime('-2 years'));
            $last_end_date = date('Y-03-31', strtotime('-1 years'));

            $begin_date = date('Y-04-01', strtotime('-1 years'));
            $end_date = date('Y-03-31');


            $next_begin_date = date('Y-04-01');
            $next_end_date = date('Y-03-31', strtotime('+1 years'));

        }
        
        $scheme_outp = DB::table('schemes as s')
                        ->join('objectives as o', 'o.scheme_id', '=', 's.id')
                        ->join('outputs as op', 'op.objective_id', '=', 'o.id')
                        ->join('outputindicators as opi', 'opi.output_id', '=', 'op.id')
                        ->join('baselines as opb', 'opb.outputindicator_id', '=', 'opi.id', 'left')
                        ->join('outputtargets as opt', 'opt.outputindicator_id', '=', 'opi.id', 'left')
                        ->select('opt.id as target_id')
                        ->where([
                          ['opt.start_date', '>=', $request->input('start_date_e')],
                          ['opt.end_date', '<=', $request->input('end_date_e')]
                        ])
                        ->get();
        // $sum1=0;
        // foreach($scheme_outp as $key30=>$value30){
        //     if(!empty($value30->opt_id)){
        //         $sum1 = DB::table('achievements')->where('outputtarget_id', $value30->opt_id)->sum('description');
        //     }
        //     $scheme_outp[$key30]->status = $sum1;
        // }

        foreach ($scheme_outp as $key => $value) {
            # code...

        }



        $scheme_outc = DB::table('schemes as s')
                        ->join('objectives as o', 'o.scheme_id', '=', 's.id')
                        ->join('outputs as op', 'op.objective_id', '=', 'o.id')
                        ->join('outcomes as oc', 'oc.output_id', '=', 'op.id')
                        ->join('outcomeindicators as oci', 'oci.outcome_id', '=', 'oc.id')
                        ->join('outcomebaselines as ocb', 'ocb.outcomeindicator_id', '=', 'oci.id', 'left')
                        ->join('outcometargets as oct', 'oct.outcomeindicator_id', '=', 'oci.id', 'left')
                        ->select('oct.id as oct_id')
                        ->where([
                          ['oct.start_date', '>=', $request->input('start_date_e')],
                          ['oct.end_date', '<=', $request->input('end_date_e')]
                        ])
                        ->get();

        // print_r($scheme_outp.'------------'.$scheme_outc);
        // die;

        foreach($scheme_outc as $key=>$value){
          print_r($value);
            $this->outcomeStatus($value->oct_id,$request->input('start_date_e'),$request->input('end_date_e'));
        }

        foreach($scheme_outp as $key1=>$value1){
            $this->outputStatus($value1->target_id,$request->input('start_date_e'),$request->input('end_date_e'));
        }
        //die();
        return response()->json(['success'=>'true','criteria'=>$item]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $item = EvaluationCriteria::find($id);
        
        if(!isset($item)){
         return response()->json(['deleted'=>'false']);

        }else{
            $item->delete();
            return response()->json(['deleted'=>'true']);
        }
    }

    public function outcomeStatus($target_id,$start_date,$end_date)
    {
        # code...
        if(empty($target_id)){
            return;
        }
        //echo $target_id;
        //$target = Outcometarget::find($target_id);
        $target = Outcometarget::where([['id', '=', $target_id],['start_date','>=', $start_date],['end_date', '<=', $end_date]])->first();
        
        //$target = Outcometarget::where([['id', '=', $target_id]])->toSql();
        //dd($target);
        $targetVal = $target->value;
        if (strpos($targetVal, '%') !== false) {
            $targetValNew = str_replace("%", "",$targetVal);
        }
        else{
            $targetValNew = $targetVal;
        }
        
        $per = 0;
        if(isset($target) && is_numeric($targetValNew) && $targetValNew > 0)
        {
            $indicator_id = $target->outcomeindicator_id;
            //echo $indicator_id;
            $indicator = Outcomeindicator::find($indicator_id);

            $achivements =$target->outcomeAchievements()->get();
            /*echo '<pre>';
            print_r($achivements);*/
            $cummulativeAchieve = 0;
            if(isset($achivements) && count($achivements)>0){
                foreach ($achivements as $achievementItem) {
                    $desc =$achievementItem->description;
                    //echo $desc.',';
                    
                    $descNew = str_replace("%", "",$desc );
                    if(is_numeric($descNew)){
                      
                      $cummulativeAchieve += $descNew;
                    }                      
                }
            }
            
            if($cummulativeAchieve > 0){
                $per = ($cummulativeAchieve/$targetValNew)*100;
            }
            else{
                $per = 0;
            }



            $outcome = $indicator->outcome()->first();
            $output = $outcome->output()->first();
            $objective = $output->objective()->first();
            $scheme = $objective->scheme()->first();
            $today = date('Y-m-d');
            $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
            if(!empty($evalcriteria)){
                $criteriaPer = $evalcriteria->percentage;
            }
            else{
                $criteriaPer = 0;
            }
            //echo $per.'@@'.$criteriaPer.'##';

          if($scheme->is_capital !=1){
                 if($indicator->respond_to_criteria == 1){
                     if($per > $criteriaPer){
                    $indicator->status = 2;
                  }else{
                    $indicator->status = 3;
                  }
                 }else{
                     if($per > $criteriaPer){
                      $indicator->status = 3;
                    }else{
                      $indicator->status = 2;
                    }
                 }
                   
                  $indicator->update();
              }else{
                $targetEndDate = $target->end_date;
                

                   if($indicator->respond_to_criteria == 1){
                     if($per >$criteriaPer && $targetEndDate < $today){
                        $indicator->status = 2;
                      }else{
                        $indicator->status = 3;
                      }
                 }else{
                     if($per >$criteriaPer && $targetEndDate < $today){
                    $indicator->status = 3;
                  }else{
                    $indicator->status = 2;
                  }
                 }
                  $indicator->update();
              }
        }
        else{
          if($targetValNew == 'NA'){
            $indicator_id = $target->outcomeindicator_id;
            //echo $indicator_id;
            $indicator = Outcomeindicator::find($indicator_id);

            $achivements =$target->outcomeAchievements()->get();
            /*echo '<pre>';
            print_r($achivements);*/
            $cummulativeAchieve = 0;
            if(isset($achivements) && count($achivements)>0){
                foreach ($achivements as $achievementItem) {
                  if($achievementItem->description!='NA' || $achievementItem->description!='NR'){
                      $desc =$achievementItem->description;
                
                      $descNew = str_replace("%", "",$desc );
                      if(is_numeric($descNew)){
                        $cummulativeAchieve += $descNew;
                      }
                  }
                    /*$desc =$achievementItem->description;
                    //echo $desc.',';
                    
                    $descNew = str_replace("%", "",$desc );
                    if(is_numeric($descNew)){
                      
                      $cummulativeAchieve += $descNew;
                    }*/                      
                }
            }
            
            if($cummulativeAchieve > 0){
                $per = ($cummulativeAchieve)*100;
            }
            else{
                $per = 0;
            }



            $outcome = $indicator->outcome()->first();
            $output = $outcome->output()->first();
            $objective = $output->objective()->first();
            $scheme = $objective->scheme()->first();
            $today = date('Y-m-d');
            $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
            if(!empty($evalcriteria)){
                $criteriaPer = $evalcriteria->percentage;
            }
            else{
                $criteriaPer = 0;
            }
            //echo $per.'@@'.$criteriaPer.'##';

          if($scheme->is_capital !=1){
                 if($indicator->respond_to_criteria == 1){
                     if($per > $criteriaPer){
                    $indicator->status = 2;
                  }else{
                    $indicator->status = 3;
                  }
                 }else{
                     if($per > $criteriaPer){
                      $indicator->status = 3;
                    }else{
                      $indicator->status = 2;
                    }
                 }
                   
                  $indicator->update();
              }else{
                $targetEndDate = $target->end_date;
                

                   if($indicator->respond_to_criteria == 1){
                     if($per >$criteriaPer && $targetEndDate < $today){
                        $indicator->status = 2;
                      }else{
                        $indicator->status = 3;
                      }
                 }else{
                     if($per >$criteriaPer && $targetEndDate < $today){
                    $indicator->status = 3;
                  }else{
                    $indicator->status = 2;
                  }
                 }
                  $indicator->update();
              }
            /*$indicator_id = $target->outcomeindicator_id;
            $indicator = Outcomeindicator::find($indicator_id);
            //$indicator->status = 4;
            $indicator->status = 1;
            $indicator->update();*/
          }
        }
    }

    public function outputStatus($target_id,$start_date,$end_date)
    {
        # code...
        if(empty($target_id)){
            return;
        }
        
        //$target = Outputtarget::find($target_id);
        $target = Outputtarget::where([['id', '=', $target_id],['start_date','>=', $start_date],['end_date', '<=', $end_date]])->first();
        // //dd($target);
        // print_r($target);die();
        $targetVal = $target->value;
        if (strpos($targetVal, '%') !== false) {
            $targetValNew = str_replace("%", "",$targetVal);
        }
        else{
            $targetValNew = $targetVal;
        }
        
        $per = 0;
        if(isset($target) && is_numeric($targetValNew) && $targetValNew > 0)
        {
            //return $target->id ;exit;
             
            $indicator_id = $target->outputindicator_id;
            $indicator = Outputindicator::find($indicator_id);
            $achivements =$target->achievements()->get();
            $cummulativeAchieve = 0 ;
            if(isset($achivements) && count($achivements)>0){

                foreach ($achivements as $achievementItem) {

                $desc =$achievementItem->description;
                
                $descNew = str_replace("%", "",$desc );
                if(is_numeric($descNew)){
                  $cummulativeAchieve += $descNew;
                }

                  
              }
            }
            
            if($cummulativeAchieve > 0){
                $per = ($cummulativeAchieve/$targetValNew)*100;
            }
            else{
                $per = 0;
            }
            
            $output = $indicator->output()->first();
            $objective = $output->objective()->first();
            $scheme = $objective->scheme()->first();
            $today = date('Y-m-d');
            $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
            if(!empty($evalcriteria)){
                $criteriaPer = $evalcriteria->percentage;
            }
            else{
                $criteriaPer = 0;
            }
            //echo $per.'@@'.$criteriaPer.'##';
             if($scheme->is_capital !=1){
                 if($indicator->respond_to_criteria == 1){
                     if($per > $criteriaPer){
                    $indicator->status = 2;
                  }else{
                    $indicator->status = 3;
                  }
                 }else{
                     if($per > $criteriaPer){
                      $indicator->status = 3;
                    }else{
                      $indicator->status = 2;
                    }
                 }
                   
                  $indicator->update();
              }else{
                $targetEndDate = $target->end_date;
                

                   if($indicator->respond_to_criteria == 1){
                     if($per >$criteriaPer && $targetEndDate < $today){
                        $indicator->status = 2;
                      }else{
                        $indicator->status = 3;
                      }
                 }else{
                     if($per >$criteriaPer && $targetEndDate < $today){
                    $indicator->status = 3;
                  }else{
                    $indicator->status = 2;
                  }
                 }
                  $indicator->update();
              }
        }
        else{
          if($targetValNew == 'NA'){
            $indicator_id = $target->outputindicator_id;
            $indicator = Outputindicator::find($indicator_id);
            $achivements =$target->achievements()->get();
            $cummulativeAchieve = 0 ;
            if(isset($achivements) && count($achivements)>0){

                foreach ($achivements as $achievementItem) {
                  if($achievementItem->description!='NA' || $achievementItem->description!='NR'){
                      $desc =$achievementItem->description;
                
                      $descNew = str_replace("%", "",$desc );
                      if(is_numeric($descNew)){
                        $cummulativeAchieve += $descNew;
                      }
                  }
                  
              }
            }
            
            if($cummulativeAchieve > 0){
                $per = ($cummulativeAchieve)*100;
            }
            else{
                $per = 0;
            }
            
            $output = $indicator->output()->first();
            $objective = $output->objective()->first();
            $scheme = $objective->scheme()->first();
            $today = date('Y-m-d');
            $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
            if(!empty($evalcriteria)){
                $criteriaPer = $evalcriteria->percentage;
            }
            else{
                $criteriaPer = 0;
            }
            //echo $per.'@@'.$criteriaPer.'##';
             if($scheme->is_capital !=1){
                 if($indicator->respond_to_criteria == 1){
                     if($per > $criteriaPer){
                    $indicator->status = 2;
                  }else{
                    $indicator->status = 3;
                  }
                 }else{
                     if($per > $criteriaPer){
                      $indicator->status = 3;
                    }else{
                      $indicator->status = 2;
                    }
                 }
                   
                  $indicator->update();
              }else{
                $targetEndDate = $target->end_date;
                

                   if($indicator->respond_to_criteria == 1){
                     if($per >$criteriaPer && $targetEndDate < $today){
                        $indicator->status = 2;
                      }else{
                        $indicator->status = 3;
                      }
                 }else{
                     if($per >$criteriaPer && $targetEndDate < $today){
                    $indicator->status = 3;
                  }else{
                    $indicator->status = 2;
                  }
                 }
                  $indicator->update();
              }
            /*$indicator_id = $target->outputindicator_id;
            $indicator = Outputindicator::find($indicator_id);
            //$indicator->status = 4;
            $indicator->status = 1;
            $indicator->update();*/
          }
        }
    }
}
