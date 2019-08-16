@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Create Department</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="addNewSector">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		
  		<form action="{{route('department.store')}}" method="post">
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="departmentName">Department Name:</label>
            <input type="text" name="departmentName" class="form-control" id="departmentName">
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
          
         </div>
         <div class="col col-md-6">
           
           <div class="form-group">
            <label for="subsector_id">Select Subsector:</label>
            <select class="form-control" name="subsector_id">
              <option value="0">--select subsector--</option>
                @foreach($subsectors as $subsector)
                @if(strpos($subsector->name,'_default') == false)
                  <option value="{{$subsector->id}}" >{{$subsector->name}}</option>
                  @endif
                @endforeach

            </select>
          </div>
              <div >Or</div>
          <div class="form-group">

            <label for="subsector_id">Select Sector:</label>
            <select class="form-control" name="sector_id">
              <option value="0">--select sector--</option>
                @foreach($sectors as $sector)
                  <option value="{{$sector->id}}" >{{$sector->name}}</option>
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