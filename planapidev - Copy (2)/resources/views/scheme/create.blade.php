@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Create New Scheme</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		@include('common.errors')
  		<form action="{{route('scheme.store')}}" method="post">
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="schemeName">Scheme Name:</label>
            <input type="text" name="schemeName" class="form-control" id="schemeName" required>
          </div>
          <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="text" name="start_date" class="form-control datepicker" required id="start_date">
          </div>
          <div class="form-group">
            <label for="budget">Budget (In Lakhs)
            :</label>
            <input type="text" required name="budget" class="form-control" id="budget">
          </div>
          <div class="form-group">
            <label for="remarks">Remarks:</label>
            
            <textarea rows="3" style="width:100%;" name="remarks"></textarea>
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
          
         </div>
         <div class="col col-md-6">
           
           <div class="form-group">
            <label for="unit_id">Select Unit:</label>
            <select class="form-control" name="unit_id" required>
              <option value="0">--select unit--</option>
                @foreach($units as $unit)
                  <option value="{{$unit->id}}" >{{$unit->name}}</option>
                @endforeach

            </select>
            <div>or</div>
          </div>
          <div class="form-group">
            <label for="unit_id">Select Department:</label>
            <select class="form-control" name="department_id" required>
              <option value="0">--select Department--</option>
                @foreach($departments as $department)
                  <option value="{{$department->id}}" >{{$department->name}}</option>
                @endforeach

            </select>
          </div>

          <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="text" name="end_date" class="form-control datepicker" required id="end_date">
          </div>

            <div class="form-group">
            <label for="objective">Objective:</label>
            
            <textarea rows="5" style="width:100%;" name="objective"  ></textarea>
          </div>

         </div>
  				
          
				   
  		</form>
  	</div>
  </div>
  @else
  <div class="main-content">
    <div class="alert alert-danger">You dont have Permission to create.</div>
  </div>
@endrole
</div>
@endsection