@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Tags</span><span class="header-util-button"><a href="{{route('tag.create')}}"><button class="btn btn-primary" id="addNewTag">Add New</button></a></span>

  </div>
  <div class="main-content">
  	
  		@if(isset($tags))
      		@if(count($tags)>0)
		<table id="tagsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($tags as $tag)
            
            <tr>
                <td>{{ $tag->tag_name}}</td>
                
                <td><a href="{{ route('tag.show', $tag) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('tag.edit', $tag) }}"><button class="btn btn-primary" >Edit</button></a> 
                  @role('admin')
                  <form action="{{route('tag.destroy',$tag)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteTag" data-id="{{$tag->id}}">Delete</button></form>
                    @endrole
                  </span></td>
                
            </tr>
            
            @endforeach
          </tbody>
          </table>  
      		@else
      		<div class="alert alert-danger">No tags are Listed.</div>
      		@endif
      		
		@endif

  </div>
</div>
@endsection
<style type="text/css">
	#tagsTable_wrapper .row{
		width:100%;
	}

</style>
