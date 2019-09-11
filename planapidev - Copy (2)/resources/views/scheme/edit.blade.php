@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Edit Scheme</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
@role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		
  		<form action="{{route('scheme.update',$scheme->id)}}" method="post">
        {{ method_field('PATCH') }}
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="schemeName">Scheme Name:</label>
            <input type="text" name="schemeName" class="form-control" id="schemeName" value="<?php echo $scheme->name != null ? $scheme->name:''; ?>">
          </div>
          
          <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" class="form-control" id="start_date" value="<?php echo $scheme->start_date != null ? $scheme->start_date:''; ?>">
          </div>
          <div class="form-group">
            <label for="budget">Budget (In Lakhs)
            :</label>
            <input type="text" name="budget" class="form-control" id="budget" value="<?php echo $scheme->budget != null ? $scheme->budget:''; ?>">
          </div>
          <div class="form-group">
            <label for="remarks">Remarks:</label>
            
            <textarea rows="3" style="width:100%;" name="remarks"><?php echo $scheme->remarks != null ? $scheme->remarks:''; ?></textarea>
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
          
         </div>
         <div class="col col-md-6">
           
           <div class="form-group">
            <label for="unit_id">Select Unit:</label>
            <select class="form-control" name="unit_id" value="<?php echo $scheme->unit_id != null ? $scheme->unit_id:''; ?>">
                @foreach($units as $unit)
                  <option value="{{$unit->id}}" >{{$unit->name}}</option>
                @endforeach

            </select>
          </div>

          <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" class="form-control" id="end_date" value="<?php echo $scheme->end_date != null ? $scheme->end_date:''; ?>">
          </div>

            <div class="form-group">
            <label for="objective">Objective:</label>
            
            <textarea rows="5" style="width:100%;" name="objective"><?php echo $scheme->objective != null ? $scheme->objective:''; ?></textarea>
          </div>

         </div>
  				
          
				   
  		</form>
  	</div>
  </div>

  @else
  <div class="main-content">
    <div class="alert alert-danger">You dont have access to edit this data.</div>
  </div>
@endrole
</div>
@endsection