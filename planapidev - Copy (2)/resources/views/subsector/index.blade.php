@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Sub sectors</span><span class="header-util-button"><a href="{{route('subsector.create')}}"><button class="btn btn-primary" id="addNewSector">Add New</button></a></span>

  </div>
  <div class="main-content">
  	
  		@if(isset($subsectors))
      		@if(count($subsectors)>0)
		<table id="subsectorsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Belongs To</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($subsectors as $subsector)
              <?php $sector = $subsector->sector()->first(); ?>
              @if(strpos($subsector->name,'_default') == false)
            <tr>
                <td>{{ $subsector->name}}</td>
                <td>{{$sector->name}}</td>
                <td>{{  $subsector->created_at}}</td>
                <td>
                  <a href="{{ route('subsector.show', $subsector) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('subsector.edit', $subsector) }}"><button class="btn btn-primary" >Edit</button></a> 
                  @role('admin')
                  <form action="{{route('subsector.destroy',$subsector)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteSubSector" data-id="{{$subsector->id}}">Delete</button></form>
                    @endrole
                  </span></td>
                
            </tr>
            @endif
            @endforeach
          </tbody>
          </table>  
      		@else
      		<div class="alert alert-danger">No subsectors are Listed.</div>
      		@endif
      		
		@endif

  </div>
</div>
@endsection
<style type="text/css">
	#subsectorsTable_wrapper .row{
		width:100%;
	}

</style>
<script src="{{ asset('js/sectors/sector.js') }}" defer ></script>