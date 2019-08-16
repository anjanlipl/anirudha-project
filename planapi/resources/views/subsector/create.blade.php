@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Create Sub Sector</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="addNewSector">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		
  		<form action="{{route('subsector.store')}}" method="post">
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="subsectorName">Sub Sector Name:</label>
            <input type="text" name="subsectorName" class="form-control" id="subsectorName">
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
          
         </div>
         <div class="col col-md-6">
           
           <div class="form-group">
            <label for="sector_id">Select Sector:</label>
            <select class="form-control" name="sector_id">
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