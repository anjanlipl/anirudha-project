@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
      <span class="header-text">Schemes</span><span class="header-util-button"><a href="{{route('scheme.create')}}"><button class="btn btn-primary" id="addNewUnit">Add New</button></a></span>

  </div>
  <div class="main-content">
    
      @if(isset($schemes))
          @if(count($schemes)>0)
    <table id="departmentsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>

            <tr>
                <th>Name</th>
                <th>Budget</th>  
                <th>Start Date</th>
                <th>End Date</th>
                <th>Unit</th>
                <th>Objective</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
          @foreach ($schemes as $scheme)
            <?php $unit = App\Unit::find($scheme->unit_id);
            if(isset($unit)){
              $unitName = $unit->name;
            }else{
              $unitName = '';
            }
                  
            ?>
            <tr>
                <td>{{ $scheme->name}}</td>
                <td>{{ $scheme->budget}}</td>
                <td>{{ date('d-m-Y', strtotime($scheme->start_date)) }} </td>
                <td>{{ date('d-m-Y', strtotime($scheme->end_date)) }} </td>
                
                @if(strpos($unitName,'_default') == false)
                <td>{{$unitName}}</td>
                @else
                  <td>NA</td>
                @endif
                <td>{{$scheme->objective}}</td>
                <td>{{$scheme->remarks}}</td>
                <td>
                  <a href="{{ route('scheme.show', $scheme) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('scheme.edit', $scheme) }}"><button class="btn btn-primary" >Edit</button></a> 
                  @role('admin')
                  <form action="{{route('scheme.destroy',$scheme)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteScheme" data-id="{{$scheme->id}}">Delete</button></form>
                    @endrole
                </span></td>
                
            </tr>
            @endforeach
          </tbody>
          </table>  
          @else
          <div class="alert alert-danger">No Schemes are Listed.</div>
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
