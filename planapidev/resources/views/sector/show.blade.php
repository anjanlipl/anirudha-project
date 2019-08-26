@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Sector : {{$sector->name}}</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="addNewSector">Back</button></a></span>

  </div>
  <div class="main-content">
  		 @if(isset($subsectors))
          @if(count($subsectors)>0)
    <table id="departmentsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subsector</th>
                <th>Sector</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        	
        	 @foreach ($subsectors as $subsectorParent)
        	 <?php $departments = $subsectorParent->departments()->get(); ?>
          @foreach ($departments as $department)
            
            <?php $subsector = App\Subsector::find($department->subsector_id);
                 $subsectorName = $subsector->name;
                 $sector = $subsector->sector()->first(); 
            ?>
            <tr>
                <td>{{ $department->name}}</td>
                 @if(strpos($subsectorName,'_default') == false)
                <td>{{$subsectorName}}</td>
                @else
                  <td>NA</td>
                @endif
                <td>{{$sector->name}}</td>
                <td>{{  $department->created_at}}</td>
                <td>
                  <a href="{{ route('department.show', $department) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('department.edit', $department) }}"><button class="btn btn-primary" >Edit</button></a> 

                  <form action="{{route('department.destroy',$department)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteDepartment" data-id="{{$department->id}}">Delete</button></form>
                </span></td>
                
            </tr>
            @endforeach
             @endforeach
          </tbody>
          </table>  
          @else
          <div class="alert alert-danger">No departments are Listed.</div>
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