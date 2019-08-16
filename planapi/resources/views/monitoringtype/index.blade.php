@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Scheme Monitoring Types</span><span class="header-util-button"><a href="{{route('monitoringtype.create')}}"><button class="btn btn-primary" id="addNewMonitoringType">Add New</button></a></span>

  </div>
  <div class="main-content">
  	
  		@if(isset($monitoringTypes))
      		@if(count($monitoringTypes)>0)
		<table id="monitoringTypeTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($monitoringTypes as $monitoringType)
            
            <tr>
                <td>{{ $monitoringType->abbreviation}}</td>
                <td>{{ $monitoringType->description}}</td>
                <td><a href="{{ route('monitoringtype.show', $monitoringType) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('monitoringtype.edit', $monitoringType) }}"><button class="btn btn-primary" >Edit</button></a> 
                  @role('admin')
                  <form action="{{route('monitoringtype.destroy',$monitoringType)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deletemonitoringType" data-id="{{$monitoringType->id}}">Delete</button></form>
                    @endrole
                  </span></td>
                
            </tr>
            
            @endforeach
          </tbody>
          </table>  
      		@else
      		<div class="alert alert-danger">No Scheme Monitoring types are Listed.</div>
      		@endif
      		
		@endif

  </div>
</div>
@endsection
<style type="text/css">
	#monitoringTypeTable_wrapper .row{
		width:100%;
	}

</style>
