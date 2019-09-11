@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Scheme : {{$scheme->name}}</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>

  </div>
  <div class="main-content">
  		<div class="row underlined-row highlighted-row">
  			<div class="col col-md-6">
  				<div><span class="desc-title space-10">Budget (Lakhs) :</span><span class="desc-detail">{{$scheme->budget}}</span></div>
  				<div><span class="desc-title space-10">Timeline :</span><span class="desc-detail"><?php echo date('Y', strtotime($scheme->start_date)); ?> - <?php echo date('Y', strtotime($scheme->end_date)); ?> </span></div>
  			</div>
  			<div class="col col-md-6">
  				<div><span class="desc-title space-10">Objectives:</span><span class="desc-detail">{{$scheme->objective}}</span></div>
  			</div>

  		</div>
  		<div class="row">
        <div class="col col-md-6">
          <div class="table-heading">Outputs</div>
           <table style="width: 100%;">
            <thead>
              <tr>
                <th style="width:40%;">
                 Indicator
                </th>
                <th>
                  Baseline
                </th>
                <th>Target</th>
              </tr>
            </thead>
            <tbody>
              @foreach($outputIndicators as $indicator)
              <tr>
                <td style="width:40%;">{{$indicator->name}}</td>
                <td>{{$indicator->baseline}}</td>
                <?php $allTargets = $indicator->outputTargets()->get(); ?>
                @foreach($allTargets as $target)
                <td>{{$target->name}}</td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
        
      </table>
          
        </div>
        <div class="col col-md-6">
          
          <div class="table-heading">Outcomes</div>
          <table style="width: 100%;">
            <thead>
              <tr>
                <th style="width:40%;">
                 Indicator
                </th>
                <th>
                  Baseline
                </th>
                <th>Target</th>
              </tr>
            </thead>
            <tbody>
              @foreach($outcomeIndicators as $indicator)
              <tr>
                <td style="width:40%;">{{$indicator->name}}</td>
                <td>{{$indicator->baseline}}</td>
                <?php $allTargets = $indicator->outcomeTargets()->get(); ?>
                @foreach($allTargets as $target)
                <td>{{$target->name}}</td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
        
      </table>
        </div>

  		</div>
  		
  </div>
</div>
@endsection

<style type="text/css">
  
  table, th, td  {
   border: 1px solid black;
}
</style>