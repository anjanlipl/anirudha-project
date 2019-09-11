@extends('layouts.app')
@section('content')
<div class="container">
  
  <div class="page-header">
  		<span class="header-text">Outcome Indicators</span><span class="header-util-button"><a href="{{route('outcomeindicator.create')}}"><button class="btn btn-primary" id="addNewIndicator">Add New</button></a></span>

  </div>
  <div class="main-content">
  	
  		@if(isset($outcomeindicators))
      		@if(count($outcomeindicators)>0)
		<table id="subsectorsTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width: 40%;">Name</th>
                 <th>Baseline</th>
                <th>Status</th>
                <th>Scheme</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        	@foreach ($outcomeindicators as $outcomeindicator)
            <?php $outcome = $outcomeindicator->outcome()->first(); 
              $scheme = $outcome->scheme()->first();
            ?>
            <tr>
                <td style="width: 40%;">{{ $outcomeindicator->name}}</td>
                 <td>{{ $outcomeindicator->baseline}}</td>
                 <td>{{ $scheme->name}}</td>
                <td><span class="space-10">{{ $outcomeindicator->status}}</span><button class="btn btn-primary header-util-button change-outcomeindicator" data-id="{{$outcomeindicator->id}}" >change</button><span></span></td>
                
                <td>
                  <a href="{{ route('outcomeindicator.show', $outcomeindicator) }}"><button class="btn btn-primary space-10">Show</button></a>
                  <a href="{{ route('outcomeindicator.edit', $outcomeindicator) }}"><button class="btn btn-primary" >Edit</button></a> 
                  <form action="{{route('outcomeindicator.destroy',$outcomeindicator)}}" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }} 
                    <button type="submit" style="margin-top:10px;" class="btn btn-danger" id="deleteOutcomeindicator" data-id="{{$outcomeindicator->id}}">Delete</button></form>
                  </span></td>
                
            </tr>
            @endforeach
          </tbody>
          </table>  
      		@else
      		<div class="alert alert-danger">No Indicators are Listed.</div>
      		@endif
      		
		@endif

  </div>


  <!-- Modal -->
  <div class="modal fade" id="outcomeindicatorProgress" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form action="{{route('changeoutcomeindicator')}}" method="post">
          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="modal-header">
          <h4 class="modal-title">Change Indicator Status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          
            <input type="hidden" id="indicator_id" name="indicator_id" value="">
            <label>Choose status :</label>
            <select name="status_name">
              <option value="">--select--</option>
              <option value="ontrack">Target Achieved</option>
              <option value="inprogress">In Progress</option>
              <option value="offtrack">Delayed /Critical</option>
              <option value="NA">Data Not Availaible</option>
            </select>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >submit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection
<style type="text/css">
	#subsectorsTable_wrapper .row{
		width:100%;
	}

</style>
