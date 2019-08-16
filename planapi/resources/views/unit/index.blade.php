@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
      <span class="header-text">Units</span><span class="header-util-button"><a href="{{route('unit.create')}}"><button class="btn btn-primary" id="addNewUnit">Add New</button></a></span>

  </div>
  <div class="main-content">
      @include('common.errors')
      @if(isset($units))
          @if(count($units)>0)
    <table id="departmentsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($units as $unit)
            <?php $department = App\Department::find($unit->department_id);
                 $departmentName = $department->name; 
            ?>
             @if(strpos($unit->name,'_default') == false)
            <tr>
                <td>{{ $unit->name}}</td>
                <td>{{$departmentName}}</td>
                <td>{{  $unit->created_at}}</td>
                <td>
                  <a href="{{ route('unit.show', $unit) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('unit.edit', $unit) }}"><button class="btn btn-primary" >Edit</button></a> 
                  @role('admin')
                  <form action="{{route('unit.destroy',$unit)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteUnit" data-id="{{$unit->id}}">Delete</button></form>
                    @endrole
                </span></td>
                
            </tr>
            @endif
            @endforeach
          </tbody>
          </table>  
          @else
          <div class="alert alert-danger">No Units are Listed.</div>
          @endif
          
    @endif

  </div>
</div>
@endsection
<style type="text/css">
  #departmentsTable_wrapper .row{
    width:100%;
  }

</style>
