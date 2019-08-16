@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">HOD Dashboard</span></span>

  </div>
  <div class="main-content">

  	<div class="row underlined-row">
  		
  		<div class="col col-md-6">
  			<div class="form-group">
  				<label for="schemes" class="space-10">Department : {{$department->name}} </label>
          
          <input type="hidden" id="report_department_id" value="{{$department->id}}">
  				
  			</div>
  			
  		</div>

      <div class="col col-md-6">
          <div class="form-group">
          <label for="schemes" class="space-10">Select Scheme : </label>
          <select id="report_scheme_id">
            <option value="0">--select scheme--</option>
            
          </select>
        </div>

        <div class="form-group">
          
          <button class="btn btn-primary view-scheme-progress">View Progress</button>
        </div>

      </div>
  	</div>
    <div class="row upper-10 display-department-selected">
      <table style="width:100%;" class="DepartmentTable"> 
        <thead>
          <tr><th>Department Name</th><th>Actions</th></tr>
        </thead>
          <tbody></tbody>
      </table>
    </div>

  	<div class="row upper-10">
  		
  		<div class="col col-md-6">
        <div id="detailChartContainer" style="margin-top:10px;height: 300px; width: 100%;"></div>
  			<div id="outputbarchartContainer" style="height: 300px; width: 100%;"></div>
        
  		</div>
  		<div class="col col-md-6">
  			<div id="outcomebarchartContainer" style="height: 300px; width: 100%;"></div>
        
  		</div>
  	</div>


  </div>
</div>
@endsection
<style type="text/css">
  
  .DepartmentTable th,.DepartmentTable td  {
   border: 1px solid black;
}

#detailChartContainer .chart-heading{
      text-align: center;
    font-size: 2rem;
    font-weight: 600;
    background: darkcyan;
    color: white;
}
#detailChartContainer table{
  width:100%;
}
#detailChartContainer table td{
  text-align: center;
  padding:5px;
  border:1px solid;
  border-color: var(--main-border-color); 
}
</style>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js" defer></script>
<script type="text/javascript" src="{{asset('js/dashboard/hod.js')}}" defer></script>