@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Edit Department</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="addNewSector">Back</button></a></span>

  </div>
  @role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		
  		<form action="{{route('department.update',$department->id)}}" method="POST">
  			 {{ method_field('PATCH') }}
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  				
          <div class="col col-md-6">
            
            <div class="form-group">
            <label for="DepartmentName">Department Name:</label>
            <input type="text" name="DepartmentName" class="form-control" id="DepartmentName" value="<?php echo $department->name != null ? $department->name:''; ?> ">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          
          </div>

          <div class="col col-md-6">
           
           <div class="form-group">
            <label for="subsector_id">Select Subsector:</label>
            <select class="form-control" name="subsector_id" value="<?php echo $department->subsector_id != null ? $department->subsector_id:''; ?>">
                @foreach($subsectors as $subsector)
                  <option value="{{$subsector->id}}" >{{$subsector->name}}</option>
                @endforeach

            </select>
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