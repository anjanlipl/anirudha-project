@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Output reports</span>

  </div>
  <div class="main-content">
  	<div class="row bottom-10">
  		
  		<div class="col col-md-6">
  			<div class="form-group">
  				<label for="schemes" class="space-10">Select Scheme : </label>
  				<select id="report_scheme_id">
            <option value="0">--select scheme--</option>
  					@foreach($schemes as $scheme)
  						<option value="{{$scheme->id}}">{{ $scheme->name}}</option>
  					@endforeach
  				</select>
  			</div>
  			<div class="form-group">
  				<button class="btn btn-primary seeReport">See Report</button>
  			</div>
  		</div>
  	</div>
    
  	<div class="row">
  		
  		<div class="col col-md-6">
  			<div id="barchartContainer" style="height: 300px; width: 100%;"></div>
        <div id="linechartContainer" style="margin-top:10px;height: 300px; width: 100%;"></div>
  		</div>
  		<div class="col col-md-6">
  			<div id="piechartContainer" style="height: 300px; width: 100%;"></div>
        <div id="scatteredchartContainer" style="margin-top:10px;height: 300px; width: 100%;"></div>
  		</div>
  	</div>

  	
  	
  </div>
</div>
@endsection


<script src="https://canvasjs.com/assets/script/canvasjs.min.js" defer></script>
<script type="text/javascript" src="{{asset('js/reports/outputreport.js')}}" defer></script>