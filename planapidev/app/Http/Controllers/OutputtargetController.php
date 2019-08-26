<?php

namespace App\Http\Controllers;

use App\Outputtarget;
use App\Outputindicator;
use App\Achievement;
use App\Review;
use App\Actionpoint;
use Illuminate\Http\Request;
use App\Objective;
use App\Output;
use App\Scheme;
use App\Baseline;
use App\Status;
use App\EvaluationCriteria;

class OutputtargetController extends Controller
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
      public function baselineslist(Request $request)
    {
        //$output_id =  request()->get('output_id');
        $indicator_id = $request->input('indicator_id');

        $indicator = Outputindicator::find($indicator_id);
        $result = array();
        if(isset($indicator)){

            
            $baselines = $indicator->baselines()->get();
                 foreach ($baselines as $baseline) {
    

                    $actionBtn = '<a class="btn btn-sm btn-primary editBaseline" data-toggle="modal" data-target="#editBaselineModal" data-id="'. $baseline->id.'">
                                                                <span class="text" >Edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger deleteOutputBase"  data-id="'. $baseline->id.'" >
                                                                <span class="text">Delete</span>
                                                            </a>';


            array_push($result, [

                    $baseline->name,
                    $baseline->value,
                    $baseline->start_date,
                    $baseline->end_date,
                    $actionBtn

                ]);
             }
        }

         return response()->json(['baselines'=>$result]);
    }

    public function baselinesheadinfo(Request $request) {

        $indicator_id = $request->input('indicator_id');

        $indicator = Outputindicator::find($indicator_id);

        $output = Output::find($indicator->output_id);
        $objective = Objective::find($output->objective_id);
        $scheme = Scheme::find($objective->scheme_id);

        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>
                <p class='indicatorinfo' data-id='$indicator->id'><b>Indicator :</b> $indicator->name</p>";
        return response()->json(['headInfo'=>$result]);

    }

    public function baselinessave(Request $request)
    {
        //$output_id =  request()->get('output_id');
       $this->validate($request, [
            'indicator_id' => 'required|exists:outputindicators,id',
            'name'=>'required|max:191',
        ]);
       $indicator_id = $request->input('indicator_id');

        $indicator = Outputindicator::find($indicator_id);

        if(isset($indicator))
        {
            $baseline = $indicator->baselines()->create([
                'name'=>request()->get('name'),
                'value'=>request()->get('value'),
                'start_date'=>request()->get('start_date'),
                'end_date'=>request()->get('end_date')
            ]);
        }
         return response()->json(['success'=>'true','baseline'=>$baseline]);
    }

    public function baselineUpdate(Request $request)
    {
        //$output_id =  request()->get('output_id');
       $this->validate($request, [
            'base_name'=>'required|max:191',
        ]);
       $id = $request->input('id');

        $baseline = Baseline::find($id);

        if(isset($baseline))
        {
          $baseline->name = $request->input('base_name');
          $baseline->value = $request->input('base_value');
          $baseline->update();

        }
         return response()->json(['success'=>'true','baseline'=>$baseline]);
    }

    

   

      public function targetslist(Request $request)
    {
        //$output_id =  request()->get('output_id');
        $indicator_id = $request->input('indicator_id');

        $indicator = Outputindicator::find($indicator_id);
        $result = array();
        if(isset($indicator)){

            
            $targets = $indicator->outputTargets()->get();
                 foreach ($targets as $target) {
    

                    $actionBtn = '<a href="output-target-achievements.html?target_id='.$target->id.'" class="btn btn-sm btn-green">
                                                                <span class="text">Achievements</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-primary edittarget" data-toggle="modal" data-target="#editTargetModal" data-id="'. $target->id.'">
                                                                <span class="text">Edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger deleteOutputTarget" data-id="'. $target->id.'">
                                                                <span class="text">Delete</span>
                                                            </a>';


            array_push($result, [
                    $target->name,
                    $target->value,
                    $target->start_date,
                    $target->end_date,
                    
                    $actionBtn

                ]);
                 }


        }

         return response()->json(['targets'=>$result]);
    }

    public function targetsave(Request $request)
    {
        //$output_id =  request()->get('output_id');
        
       $this->validate($request, [
          
            'name'=>'required|max:191',
        ]);
       $indicator_id = $request->input('indicator_id');

        $indicator = Outputindicator::find($indicator_id);

        if(isset($indicator))
        {
            $target = $indicator->outputTargets()->create([
                'name'=>request()->get('name'),
                'value'=>request()->get('value'),
                'start_date'=>request()->get('start_date'),
                'end_date'=>request()->get('end_date'),
                'status'=>request()->get('status')

                
            ]);
        }
         return response()->json(['success'=>'true','target'=>$target]);
    }
    public function targetUpdate(Request $request)
    {
        //$output_id =  request()->get('output_id');
        
       $this->validate($request, [
          
            'target_name'=>'required|max:191',
        ]);
       $targetId = $request->input('id');

        $target = Outputtarget::find($targetId);

        if(isset($target))
        {
            $target->name = $request->input('target_name');
            $target->value = $request->input('target_value');
            $target->update();

        }
         return response()->json(['success'=>'true','target'=>$target]);
    }

    
     public function achieventlist(Request $request)
    {
        //$output_id =  request()->get('output_id');
        $target_id = $request->input('target_id');

        $target = Outputtarget::find($target_id);
        $result = array();
        if(isset($target)){

            
            $achievements = $target->achievements()->get();
                 foreach ($achievements as $achievement) {
    

                    $actionBtn = '<a href="output-target-achievements-reviews.html?achievement_id='.$achievement->id .'" class="btn btn-sm btn-green">
                                                                <span class="text">Reviews</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-primary editAchieve" data-toggle="modal" data-target="#editAchievementModal" data-id="'. $achievement->id.'" data-name= "'.$achievement->description.'">
                                                                <span class="text">Edit</span>
                                                            </a>
                                                            <a class="btn btn-sm btn-danger deleteOutputAchievement" data-id="'. $achievement->id.'" >
                                                                <span class="text">Delete</span>
                                                            </a>';


            array_push($result, [
                    $achievement->description,
                    $achievement->start_date,
                    $achievement->end_date,
                    $actionBtn
                ]);
                 }


        }

         return response()->json(['achievements'=>$result]);
    }

    public function achieventheadinfo(Request $request) {

        $target_id = $request->input('target_id');
        $target = Outputtarget::find($target_id);
        $indicator = Outputindicator::find($target->outputindicator_id);
        $output = Output::find($indicator->output_id);
        $objective = Objective::find($output->objective_id);
        $scheme = Scheme::find($objective->scheme_id);

        $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>
                <p class='indicatorinfo' data-id='$indicator->id'><b>Indicator :</b> $indicator->name</p>
                <p class='targetinfo' data-id='$target->id'><b>Target :</b> $target->name</p>";

        return response()->json(['headInfo'=>$result]);

    }

    public function achieventsave(Request $request)
    {
        //$output_id =  request()->get('output_id');
        
       $this->validate($request, [
          
            'description'=>'required|max:191',
        ]);
       $target_id = $request->input('target_id');

        $target = Outputtarget::find($target_id);
        $targetVal = $target->value;
        $achieveValue = request()->get('description');
        $per = 0;
        if(isset($target))
        {
            //return $target->id ;exit;
             
            $indicator_id = $target->outputindicator_id;
            $indicator = Outputindicator::find($indicator_id);
            $achievement = $target->achievements()->create([
              'description' => request()->get('description'),
              'start_date' => request()->get('start_date'),
              'end_date' => request()->get('end_date')
            ]);
            if($achieveValue == 'NA'){
              $indicator->status = 4;
              $indicator->save();
              return response()->json(['success'=>'true']);
            }
            elseif($achieveValue == 'NR'){
              $indicator->status = 1;
              $indicator->save();
              return response()->json(['success'=>'true']);
            }
            if($indicator->unit_id == 15){


              $achivements =$target->achievements()->get();
              $cummulativeAchieve = 0 ;
              if(isset($achivements) && count($achivements)>0){

                foreach ($achivements as $achievementItem) {

                $desc =$achievementItem->description;
                $descNew = str_replace("%", "",$desc );
            
                $cummulativeAchieve += $descNew;
                }
              }
              
              $per = ($cummulativeAchieve/$targetVal)*100;


            }
            else if($indicator->unit_id == 16){


              // $achieveValueNew = str_replace("%", "",$achieveValue );
              $numbers=explode(":",$achieveValue);
              $targetValNew = round($numbers[0]/$numbers[1],6);
              // $targetValNew = str_replace("%", "",$targetVal );
              $achivements =$target->achievements()->get();
              $cummulativeAchieve = 0 ;
              if(isset($achivements) && count($achivements)>0){
                foreach ($achivements as $achievementItem) {
                  $desc =$achievementItem->description;
                  $numbers=explode(":",$desc);
                  $descNew = round($numbers[0]/$numbers[1],6);
                  // $descNew = str_replace("%", "",$desc );
                  $cummulativeAchieve += $descNew;
                }
                $per = ($cummulativeAchieve/$targetValNew)*100;
              }

              
            }
            else if($indicator->unit_id == 17){
              

              $achieveValueNew = str_replace("%", "",$achieveValue );
              $targetValNew = str_replace("%", "",$targetVal );
              $achivements =$target->achievements()->get();
              $cummulativeAchieve = 0 ;
              if(isset($achivements) && count($achivements)>0){
                foreach ($achivements as $achievementItem) {
                  $desc =$achievementItem->description;
                  $descNew = str_replace("%", "",$desc );
                  $cummulativeAchieve += $descNew;
                }
              }
              $per = ($cummulativeAchieve/$targetValNew)*100;


            }
            else if($indicator->unit_id == 18){
                if($indicator->respond_to_criteria == 1){
                  if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
                    $indicator->status = 2;
                  }
                  else{
                    $indicator->status = 3;
                  }
                  $indicator->save();
                }
                else{
                  if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
                    $indicator->status = 3;
                  }
                  else{
                    $indicator->status = 2;
                  }
                  $indicator->save();
                }

                return response()->json(['success'=>'true','achievement'=>$achievement,'indicator'=>$indicator,'per'=>$per,'evalcriteria'=>$evalcriteria,'criteriaPer'=>$criteriaPer,'is_capital'=>$scheme->is_capital]);

            }
            else{
              
            }

            $output = $indicator->output()->first();
            $objective = $output->objective()->first();
            $scheme = $objective->scheme()->first();
            $today = date('Y-m-d');
            // echo $today; die;
            $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
            $criteriaPer = $evalcriteria->percentage;
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
                 
                $indicator->save();
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
                $indicator->save();
            }
        }
         return response()->json(['success'=>'true','achievement'=>$achievement,'indicator'=>$indicator,'per'=>$per,'evalcriteria'=>$evalcriteria,'criteriaPer'=>$criteriaPer,'is_capital'=>$scheme->is_capital]);
    }

    public function achievementUpdate(Request $request)
    {
        //$output_id =  request()->get('output_id');
        
       $this->validate($request, [
          
            'desc'=>'required|max:191',
        ]);
       $achId = $request->input('id');
        $achieveValue =  $request->input('desc');

        $achievement = Achievement::find($achId);
        $achievement->description = $achieveValue;
        $achievement->start_date = request()->get('start_date');
        $achievement->end_date = request()->get('end_date');
        // echo $achievement->description;
        $achievement->update();
        $target = $achievement->outputtarget()->first();
        $targetVal = $target->value;


        if(isset($target))
        {
            //return $target->id ;exit;
             
            $indicator_id = $target->outputindicator_id;
            $indicator = Outputindicator::find($indicator_id);
            if($achieveValue == 'NA'){
              $indicator->status = 4;
              $indicator->save();
              return response()->json(['success'=>'true']);
            }
            elseif($achieveValue == 'NR'){
              $indicator->status = 1;
              $indicator->save();
              return response()->json(['success'=>'true']);
            }
            // $achievement = $target->achievements()->create([
            //   'description' => request()->get('description')
            // ]);
            if($indicator->unit_id == 15){
              $achivements =$target->achievements()->get();
              $cummulativeAchieve = 0 ;
              if(isset($achivements) && count($achivements)>0){

                foreach ($achivements as $achievementItem) {

                $desc =$achievementItem->description;
                $descNew = str_replace("%", "",$desc );
            
                $cummulativeAchieve += $descNew;
                }
              }
              
              $per = ($cummulativeAchieve/$targetVal)*100;
            }
            else if($indicator->unit_id == 16){
              // $achieveValueNew = str_replace("%", "",$achieveValue );
              $numbers=explode(":",$achieveValue);
              $targetValNew = round($numbers[0]/$numbers[1],6);
              // $targetValNew = str_replace("%", "",$targetVal );
              $achivements =$target->achievements()->get();
              $cummulativeAchieve = 0 ;
              if(isset($achivements) && count($achivements)>0){
                foreach ($achivements as $achievementItem) {
                  $desc =$achievementItem->description;
                  $numbers=explode(":",$desc);
                  $descNew = round($numbers[0]/$numbers[1],6);
                  // $descNew = str_replace("%", "",$desc );
                  $cummulativeAchieve += $descNew;
                }
                $per = ($cummulativeAchieve/$targetValNew)*100;
              }

              
            }
            else if($indicator->unit_id == 17){
              $achieveValueNew = str_replace("%", "",$achieveValue );
              $targetValNew = str_replace("%", "",$targetVal );
              $achivements =$target->achievements()->get();
              $cummulativeAchieve = 0 ;
              if(isset($achivements) && count($achivements)>0){
                foreach ($achivements as $achievementItem) {
                  $desc =$achievementItem->description;
                  $descNew = str_replace("%", "",$desc );
                  $cummulativeAchieve += $descNew;
                }
              }
              $per = ($cummulativeAchieve/$targetValNew)*100;
            }
            else if($indicator->unit_id == 18){
              if($indicator->respond_to_criteria == 1){
                  if(date('Y-m-d', strtotime($targetVal)) > date('Y-m-d', strtotime($achieveValue))){
                    $indicator->status = 2;
                  }
                  else{
                    $indicator->status = 3;
                  }
                  $indicator->save();
                }
                else{
                  if(date('Y-m-d', $targetVal) > date('Y-m-d', $achieveValue)){
                    $indicator->status = 3;
                  }
                  else{
                    $indicator->status = 2;
                  }
                  $indicator->save();
                }

                return response()->json(['success'=>'true','achievement'=>$achievement,'indicator'=>$indicator]);
            }
            else{
              $per = 0;
            }
            // if(strpos($achieveValue, '%') !== false) {
            //         if (strpos($targetVal, '%') !== false) {
            //           $achievement = $target->achievements()->create([
            //           'description' => request()->get('description')
            //         ]);

                     
            //           $achieveValueNew = str_replace("%", "",$achieveValue );
            //           $targetValNew = str_replace("%", "",$targetVal );
            //           $achivements =$target->achievements()->get();
            //           $cummulativeAchieve = 0 ;
            //           if(isset($achivements) && count($achivements)>0){

            //             foreach ($achivements as $achievementItem) {

            //             $desc =$achievementItem->description;
            //             $descNew = str_replace("%", "",$desc );
                    
            //             $cummulativeAchieve += $descNew;
            //             }
            //           }
                      
            //           $per = ($cummulativeAchieve/$targetValNew)*100;

            //     }
               

            // }else{
            //    $achievement = $target->achievements()->create([
            //           'description' => request()->get('description')
            //         ]);
            //    $achivements =$target->achievements()->get();
            //           $cummulativeAchieve = 0 ;
            //           if(isset($achivements) && count($achivements)>0){
            //               foreach ($achivements as $achievementItem) {
            //               $cummulativeAchieve += $achievementItem->description;
            //             }
            //           }
                      
            //     $per = ($cummulativeAchieve/$targetVal)*100;

            // }

            $output = $indicator->output()->first();
            $objective = $output->objective()->first();
            $scheme = $objective->scheme()->first();
            $today = date('Y-m-d');
            // echo $today; die;
            $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
            $criteriaPer = $evalcriteria->percentage;
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
                 
                $indicator->save();
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
                $indicator->save();
            }
        }



        // if(isset($target))
        // {
        //     //return $target->id ;exit;
             
        //      $indicator_id = $target->outputindicator_id;
        //      $indicator = Outputindicator::find($indicator_id);
        //       if (strpos($achieveValue, '%') !== false) {
        //               if (strpos($targetVal, '%') !== false) {
                        

                       
        //                 $achieveValueNew = str_replace("%", "",$achieveValue );
        //                 $targetValNew = str_replace("%", "",$targetVal );

        //                 $achivements =$target->achievements()->get();
        //                 $cummulativeAchieve = 0 ;

        //                 if(isset($achivements) && count($achivements)>0){
        //                   foreach ($achivements as $achievementItem) {
        //                   $desc =$achievementItem->description;
        //                   $descNew = str_replace("%", "",$desc );
                      
        //                   $cummulativeAchieve += $descNew;
        //                 }
        //                 }
                        
        //                 $per = ($cummulativeAchieve/$targetValNew)*100;

        //           }
                 

        //       }else{
        //            $achievement->description = $request->input('desc');
        //             $achievement->update();
        //             $achivements =$target->achievements()->get();
        //                 $cummulativeAchieve = 0 ;
        //                 if(isset($achivements) && count($achivements)>0){
        //                    foreach ($achivements as $achievementItem) {
        //                   $cummulativeAchieve += $achievementItem->description;
        //                 }
        //                 }
                       
        //             $per = ( $cummulativeAchieve/$targetVal)*100;

        //       }
        //        $output = $indicator->output()->first();
        //       $objective = $output->objective()->first();
        //       $scheme = $objective->scheme()->first();
        //       $today = date('Y-m-d');
        //       $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
        //       $criteriaPer = $evalcriteria->percentage;
        //      if($scheme->is_capital !=1){
        //          if($indicator->respond_to_criteria == 1){
        //              if($per > $criteriaPer){
        //             $indicator->status = 2;
        //           }else{
        //             $indicator->status = 3;
        //           }
        //          }else{
        //              if($per > $criteriaPer){
        //               $indicator->status = 3;
        //             }else{
        //               $indicator->status = 2;
        //             }
        //          }
             //        $per = ( $cummulativeAchieve/$targetVal)*100;

             //  }
             //   $output = $indicator->output()->first();
             //  $objective = $output->objective()->first();
             //  $scheme = $objective->scheme()->first();
             //  $today = date('Y-m-d');
             //  $evalcriteria = EvaluationCriteria::where('end_date','>=',$today)->first();
             //  if(isset($evalcriteria->percentage)){
             //       $criteriaPer = $evalcriteria->percentage;

             //  }else{
             //     $criteriaPer = 70;

             //  }
             // if($scheme->is_capital !=1){
             //     if($indicator->respond_to_criteria == 1){
             //         if($per > $criteriaPer){
             //        $indicator->status = 2;
             //      }else{
             //        $indicator->status = 3;
             //      }
             //     }else{
             //         if($per > $criteriaPer){
             //          $indicator->status = 3;
             //        }else{
             //          $indicator->status = 2;
             //        }
             //     }
        //           $indicator->save();
        //       }else{
        //         $targetEndDate = $target->end_date;
                

        //            if($indicator->respond_to_criteria == 1){
        //              if($per >$criteriaPer && $targetEndDate < $today){
        //                 $indicator->status = 2;
        //               }else{
        //                 $indicator->status = 3;
        //               }
        //          }else{
        //              if($per >$criteriaPer && $targetEndDate < $today){
        //             $indicator->status = 3;
        //           }else{
        //                 $indicator->status = 2;
        //               }
        //         }   
              
        //     }
          
        // }

         return response()->json(['success'=>'true','achievement'=>$achievement,'per'=>$per,'indicator'=>$indicator,'criteriaPer'=>$criteriaPer,'is_capital'=>$scheme->is_capital]);
    }

    public function reviewslist(Request $request)
    {
        //$output_id =  request()->get('output_id');
        $achievement_id = $request->input('achievement_id');

        $achievement = Achievement::find($achievement_id);
        $result = array();
        if(isset($achievement)){

            
            $reviews = $achievement->reviews()->get();
                 foreach ($reviews as $review) {
    

                    $actionBtn = '<a href="output-target-achievements-reviews-action.html?review_id=' . $review->id . '" class="btn btn-sm btn-green">
                                <span class="text">Action Points</span>
                              </a>
                              <a class="btn btn-sm btn-primary reviewedit" data-toggle="modal" data-target="#editReviewModal" data-id="'. $review->id.'" data-name= "'.$review->description.'">
                                <span class="text">Edit</span>
                              </a>
                              <a class="btn btn-sm btn-danger deleteOutputReview" data-id="'. $review->id.'" >
                                <span class="text">Delete</span>
                              </a>';


            array_push($result, [
                    $review->description,
                    $actionBtn

                ]);
                 }


        }

         return response()->json(['reviews'=>$result]);
    }
    public function reviewUpdate(Request $request)
    {
        //$output_id =  request()->get('output_id');
        
       $this->validate($request, [
          
            'desc'=>'required|max:191',
        ]);
       $achId = $request->input('id');

        $review = Review::find($achId);

        if(isset($review))
        {
           $review->description = $request->input('desc');
           $review->update();
        }
         return response()->json(['success'=>'true','review'=>$review]);
    }

    public function reviewsheadinfo(Request $request) {

      $achievement_id = $request->input('achievement_id');
      $achievement = Achievement::find($achievement_id);
      $target = Outputtarget::find($achievement->outputtarget_id);
      $indicator = Outputindicator::find($target->outputindicator_id);
      $output = Output::find($indicator->output_id);
      $objective = Objective::find($output->objective_id);
      $scheme = Scheme::find($objective->scheme_id);

      $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>
                <p class='indicatorinfo' data-id='$indicator->id'><b>Indicator :</b> $indicator->name</p>
                <p class='targetinfo' data-id='$target->id'><b>Target :</b> $target->name</p>
              <p class='achievementinfo ' data-id='$achievement->id'><b>Achievement :</b> $achievement->description</p>";
      return response()->json(['headInfo'=>$result]);
    }

    public function reviewSave(Request $request)
    {
        //$output_id =  request()->get('output_id');

       $this->validate($request, [
            'description'=>'required|max:191',
        ]);
       $achievement_id = $request->input('achievement_id');

        $achievement = Achievement::find($achievement_id);

        if(isset($achievement))
        {
            $review = $achievement->reviews()->create([
                'description' => request()->get('description')
            ]);
        }
         return response()->json(['success'=>'true','review'=>$review]);
    }

    public function actionlist(Request $request)
    {
        //$output_id =  request()->get('output_id');
        $review_id = $request->input('review_id');

        $review = Review::find($review_id);
        $result = array();
        if(isset($review)){

            
            $actions = $review->actionpoints()->get();
                 foreach ($actions as $action) {
    

                    $actionBtn = '<a class="btn btn-sm btn-primary editaction" data-toggle="modal" data-target="#editActionModal" data-id="'. $action->id.'" data-name= "'.$action->description.'">
                                <span class="text">Edit</span>
                              </a>
                              <a class="btn btn-sm btn-danger deleteOutputAction"  data-id="'. $action->id.'">
                                <span class="text">Delete</span>
                              </a> 
                              <a class="btn btn-sm btn-green assignUser dadmin"  data-toggle="modal" data-target="#assignActionModal"  data-id="'. $action->id.'">
                                <span class="text">Assign</span>
                              </a>';
                              $status_id = $action->status_id;
                      if($status_id != 0){
                      $status = Status::find($status_id);
                      $statusName = $status->name;
                    }else{
                      $statusName ='NA';
                    }


            array_push($result, [
                $action->description,
                $action->start_date,
                $action->end_date,
                $statusName,
                $actionBtn
            ]);
                 }


        }

         return response()->json(['actions'=>$result]);
    }

    public function actionheadinfo(Request $request) {

      $review_id = $request->input('review_id');
      $review = Review::find($review_id);
      $achievement = Achievement::find($review->achievement_id);
      $target = Outputtarget::find($achievement->outputtarget_id);
      $indicator = Outputindicator::find($target->outputindicator_id);
      $output = Output::find($indicator->output_id);
      $objective = Objective::find($output->objective_id);
      $scheme = Scheme::find($objective->scheme_id);

      $result = "<p class='schemeinfo' data-id='$scheme->id'><b>Scheme : </b>$scheme->name</p> 
                <p  class='objectiveinfo' data-id='$objective->id' ><b>Objective :</b> $objective->description</p>
                <p class='outputinfo' data-id='$output->id'><b>Output : </b>$output->name</p>
                <p class='indicatorinfo' data-id='$indicator->id'><b>Indicator :</b> $indicator->name</p>
                <p class='targetinfo' data-id='$target->id'><b>Target :</b> $target->name</p>
              <p class='achievementinfo ' data-id='$achievement->id'><b>Achievement :</b> $achievement->description</p>
              <p><b>Review :</b> $review->description</p>";
      return response()->json(['headInfo'=>$result]);
    }

    public function actionsave(Request $request)
    {
        //$output_id =  request()->get('output_id');

       $this->validate($request, [
            'description'=>'required|max:191',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
       $review_id = $request->input('review_id');
       $status_id = $request->input('status_id');
      $start_date = date('Y-m-d',strtotime(request()->get('start_date')));
      $end_date = date('Y-m-d',strtotime(request()->get('end_date')));
      $today = date("Y-m-d");

        $review = Review::find($review_id);

        if(isset($review))
        {
          if($end_date > $today){
              $action = $review->actionpoints()->create([
                'description' => request()->get('description'),
                'status_id'=>$status_id,
                'start_date'=>$start_date,
                'end_date'=>$end_date 
            ]);
          }else{

              return response()->json(['success'=>'fasle','action'=>array()]);

          }
            
        }
         return response()->json(['success'=>'true','action'=>$action]);
          
    }
    
    public function actionUpdate(Request $request)
    {
        //$output_id =  request()->get('output_id');
        
       $this->validate($request, [
          
            'desc'=>'required|max:191',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);
       $achId = $request->input('id');
       $status_id = $request->input('status_id');

        $start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $end_date = date('Y-m-d',strtotime($request->input('end_date')));
        $action = Actionpoint::find($achId);

        if(isset($action))
        {
           $action->description = $request->input('desc');
           $action->status_id = $status_id;
           $action->start_date= $start_date;
           $action->end_date= $end_date;
           $action->update();
        }
         return response()->json(['success'=>'true','action'=>$action]);
    }


      public function baselinenameAutogenerate(Request $request)
    {
        $id = $request->input('indicator_id');
        $indicator = Outputindicator::find($id);
        $output = $indicator->output()->first();
        $objective = $output->objective()->first();
        $scheme = $objective->scheme()->first();

        $start_date = date('Y',strtotime($scheme->start_date));
        $end_date = date('y',strtotime($scheme->end_date));

        $baselineName = 'Baseline ' . ($start_date -1)  .'-'. ($end_date -1) ;
        $targetName = 'Target ' . $start_date .'-'. $end_date;
         return response()->json(['success'=>'true','baselineName'=>$baselineName,'targetName'=>$targetName]);
      
    }

     public function deleteOutputBaseline(Request $request,$id)
    {
        $baseline = Baseline::find($id);
        if(isset($baseline)){
            $baseline->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }

    public function deleteOutputTarget(Request $request,$id)
    {
        $target = Outputtarget::find($id);
        if(isset($target)){
            $target->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }

     public function deleteOutputAchievement(Request $request,$id)
    {
        $ach = Achievement::find($id);
        if(isset($ach)){
            $ach->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
     public function deleteOutputReview(Request $request,$id)
    {
        $item = Review::find($id);
        if(isset($item)){
            $item->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }

     public function deleteOutputAction(Request $request,$id)
    {
        $item = Actionpoint::find($id);
        if(isset($item)){
            $item->delete();
            return response()->json(['deleted'=>'true']);
        }else{
         return response()->json(['deleted'=>'false']);

        }


    }
    

    
}
