@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Sectors</span><span class="header-util-button"><a href="{{route('sector.create')}}"><button class="btn btn-primary" id="addNewSector">Add New</button></a></span>
  </div>
  <div class="main-content">
  	
  		@if(isset($sectors))
      		@if(count($sectors)>0)
		<table id="sectorsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($sectors as $sector)
            <tr>
                <td>{{ $sector->name}}</td>
                <td>{{  $sector->created_at}}</td>
                <td>
                   <a href="{{ route('sector.show', $sector) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('sector.edit', $sector) }}"><button class="btn btn-primary" >Edit</button> </a>
                  @role('admin')
                   <form action="{{route('sector.destroy',$sector)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger deleteSector" id="deleteSector" data-id="{{$sector->id}}">Delete</button></form>
                    @endrole
                 </span></td>
                
            </tr>
            @endforeach
          </tbody>
          </table>  
      		@else
      		<div class="alert alert-danger">No sectors are Listed.</div>
      		@endif
      		
		@endif

  </div>
</div>
@endsection
<style type="text/css">
	#sectorsTable_wrapper .row{
		width:100%;
	}

</style>
