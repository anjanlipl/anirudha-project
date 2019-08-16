@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Create Sector</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>

  </div>
  @role('admin')
  <div class="main-content">

  	<div class="form_wrapper">
  		
  		<form action="{{route('sector.store')}}" method="post">
  			 <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
  				<div class="form-group">
				    <label for="sectorName">Sector Name:</label>
				    <input type="text" name="sectorName" class="form-control" id="sectorName">
				  </div>
				   <button type="submit" class="btn btn-primary">Create</button>
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