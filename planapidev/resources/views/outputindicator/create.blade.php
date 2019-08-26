@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Create Output Indicator</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
  <div class="main-content">
  	<div class="form_wrapper">
  		@include('common.errors')
  		<form action="{{route('outputindicator.store')}}" method="post">
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
           <div class="row">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="indicatorName">Indicator Description:</label>
            <input type="text" name="indicatorName" class="form-control" id="indicatorName" required>
          </div>

          <div class="form-group">
            <label for="baseline">Baseline:</label>
            <input type="text" name="baseline" class="form-control" id="baseline">
          </div>
         
          
         </div>
         <div class="col col-md-6">
           
           <div class="form-group">
            <label for="scheme_id">Select Scheme:</label>
            <select class="form-control" name="scheme_id">
              <option value="0">--select scheme--</option>
                @foreach($schemes as $scheme)
                  <option value="{{$scheme->id}}" >{{$scheme->name}}</option>
                @endforeach

            </select>
          </div>

         </div>
       </div>
         <div class="row">
                    <div class="col col-md-6">
          
          <div class="form-group">
            <label for="target_name">Target:</label>
            <input type="text" name="target_name" class="form-control" id="target_name">
          </div>
          <div class="form-group">
            <label for="start_date">Target Start Date:</label>
            <input  name="start_date" class="form-control datepicker" id="start_date">
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
          
         </div>
           <div class="col col-md-6">
           

          <div class="form-group">
            <label for="end_date">Target End Date:</label>
            <input  name="end_date" class="form-control datepicker" id="end_date">
          </div>
         </div>
         </div>
  				
          
				   
  		</form>
  	</div>
  </div>
</div>
@endsection