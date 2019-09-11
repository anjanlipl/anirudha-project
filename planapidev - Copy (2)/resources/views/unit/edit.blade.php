@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
      <span class="header-text">Edit Unit</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>

  </div>
  @role('admin')
  <div class="main-content">

    <div class="form_wrapper">
      
      <form action="{{route('unit.update',$unit->id)}}" method="POST">
         {{ method_field('PATCH') }}
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          
          <div class="col col-md-6">
            
            <div class="form-group">
            <label for="unitName">Sector Name:</label>
            <input type="text" name="unitName" class="form-control" id="unitName" value="<?php echo $unit->name != null ? $unit->name:''; ?> ">
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          
          </div>

          <div class="col col-md-6">
           
           <div class="form-group">
            <label for="department_id">Select Department:</label>
            <select class="form-control" name="department_id" value="<?php echo $unit->department_id != null ? $unit->department_id:''; ?>">
                @foreach($departments as $department)
                  <option value="{{$department->id}}" >{{$department->name}}</option>
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