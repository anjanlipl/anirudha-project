@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">All Users</span><span class="header-util-button"><a href="{{route('admincreateuser')}}"><button class="btn btn-primary" id="addNewSector">Add New</button></a></span>

  </div>
  <div class="main-content">
  	
  		@if(isset($users))
      		@if(count($users)>0)
		<table id="usersTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Created Date</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($users as $user)
              <?php $roles = $user->getRoleNames(); ?>
            <tr>
                <td>{{ $user->name}}</td>
                <td>{{  $user->created_at}}</td>
                <td><?php foreach ($roles as  $role) {
                  echo $role;
                }
                ?>
                   </td>
                   <td><a href="{{route('changeUser',$user->id)}}"><button class="btn btn-primary">change</button></a></td>
                
            </tr>
            @endforeach
          </tbody>
          </table>  
      		@else
      		<div class="alert alert-danger">No users Listed.</div>
      		@endif
      		
		@endif

  </div>
</div>
@endsection
<style type="text/css">
	#usersTable_wrapper .row{
		width:100%;
	}

</style>
