@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Create New Scheme Monitoring Type</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>
  </div>
  @role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		
  		<form action="{{route('monitoringtype.store')}}" method="post">
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="col col-md-6">
           <div class="form-group">
            <label for="abbreviation">Abbreviation:</label>
            <input type="text" name="abbreviation" class="form-control" id="abbreviation">
          </div>
          <div class="form-group"><button type="submit" class="btn btn-primary">Create</button></div>
          
         </div>
         <div class="col col-md-6">
           <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" class="form-control" id="description">
          </div>
           
         </div>
  				
          
				   
  		</form>
  	</div>
  </div>
  @else
  <div class="main-content">
    <div class="alert alert-danger">You dont have access to  this data.</div>
  </div>
@endrole
</div>
@endsection