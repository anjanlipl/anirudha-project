@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Department : {{$department->name}}</span><span class="header-util-button"><a href=" {{url()->previous()}}"><button class="btn btn-primary" id="addNewSector">Back</button></a></span>

  </div>
  <div class="main-content">

  		@if(isset($units) && count($units)>0)
  			@foreach($units as $unit)
  			<?php $schemes = $unit->schemes()->get(); ?>
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
                 $unitName = $unit->name; 
            ?>
            <tr>
                <td>{{ $scheme->name}}</td>
                <td>{{ $scheme->budget}}</td>
                <td>{{ date('d-m-Y', strtotime($scheme->start_date)) }} </td>
                <td>{{ date('d-m-Y', strtotime($scheme->end_date)) }} </td>
                <td>{{$unitName}}</td>
                <td>{{$scheme->objective}}</td>
                <td>{{$scheme->remarks}}</td>
                <td>
                  <a href="{{ route('scheme.show', $scheme) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('scheme.edit', $scheme) }}"><button class="btn btn-primary" >Edit</button></a> 

                  <form action="{{route('scheme.destroy',$scheme)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteScheme" data-id="{{$scheme->id}}">Delete</button></form>
                </span></td>
                
            </tr>
            @endforeach
          </tbody>
          </table>  
  			@endforeach
  		@endif
  </div>
</div>
@endsection