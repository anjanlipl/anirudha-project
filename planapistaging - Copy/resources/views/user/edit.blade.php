@extends('layouts.app')
@section('content')
<div class="container">
  <div class="page-header">
  		<span class="header-text">Edit User</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="goBack">Back</button></a></span>

  </div>
  @role('admin')
  <div class="main-content">
     @include('common.errors')
  	<div class="form_wrapper">
  		
  		<form action="{{route('userupdate',$userSelected->id)}}" method="post">
         <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
         <div class="row">
           
           <div class="col col-md-6">
            <div class="form-group">
            <label for="user_name"> Name:</label>
            <input type="text" name="user_name" value="<?php echo $userSelected->name != null ? $userSelected->name:''; ?>" class="form-control" id="user_name" required>
          </div>

          <div class="form-group">
            <label for="user_role"> Assign a role:</label>
              <select style="width:100%;" name="user_role">
                <option value="0">--select--</option>
                @foreach($roles as $role)
                  <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
              </select>
          </div>
          
          
          </div>

          <div class="col col-md-6">
            <div class="form-group">
            <label for="email"> Email:</label>
            <input type="email" value="<?php echo $userSelected->email != null ? $userSelected->email:''; ?>" name="email" class="form-control" id="email" required>
          </div>
          <div class="form-group">
            <label for="user_dept"> Assign a Department:</label>
              <select style="width:100%;" name="user_dept">
                <option value="0">--select--</option>
                @foreach($departments as $department)
                  <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
              </select>
          </div>

          
          </div>


         </div>
         <div class="row">
           
           <div class="col col-md-6">
             <div class="form-group">
          <button type="submit" class="btn btn-primary">Create</button>
          </div>

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