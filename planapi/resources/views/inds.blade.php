<style type="text/css">
	body .panel{
		margin-bottom: 20px !important;
		margin-top: 20px !important;
	}
</style>
@php $i = 0; @endphp
@foreach($inds as $key => $value)
<div class="panel panel-default">
	<div class="panel-heading">
  		<h4 class="panel-title">
    		<a data-toggle="collapse" href="#collapse{{ ++$i }}">{{ $key }}</a>
  		</h4>
	</div>
	<div id="collapse{{ $i }}" class="panel-collapse collapse" style="padding: 20px;">
  		@foreach($value as $key1 => $value1)
  		<div class="panel panel-default">
	    	<div class="panel-heading">
	      		<h4 class="panel-title">
	        		<a data-toggle="collapse" href="#collapse{{ ++$i }}">{{ $key1 }}</a>
	      		</h4>
	    	</div>
	    	<div id="collapse{{ $i }}" class="panel-collapse collapse">
	    		<table class="table table-bordered">
	    			<thead>
	    				<th>{{ $title }}</th>
	    			</thead>
	    			<tbody> 
	    				@if( !empty( $inds[$key][$key1]['outputs'] ) )
				      		@foreach($inds[$key][$key1]['outputs'] as $key2=>$value2)
				      			<tr>
				      				<td><a href="indicator_dashboard?type={{ $value2['type'] }}&id={{ $key2 }}">{{ $value2['name'] }}</td>
				      			</tr>
				      		@endforeach
			      		@endif
	    				@if( !empty( $inds[$key][$key1]['outcomes'] ) )
				      		@foreach($inds[$key][$key1]['outcomes'] as $key2=>$value2)
				      			<tr>
				      				<td><a href="indicator_dashboard?type={{ $value2['type'] }}&id={{ $key2 }}">{{ $value2['name'] }}</td>
				      			</tr>
				      		@endforeach
			      		@endif
		      		</tbody>
	      		</table>
	    	</div>
		</div>
		@endforeach
	</div>
</div>
@endforeach