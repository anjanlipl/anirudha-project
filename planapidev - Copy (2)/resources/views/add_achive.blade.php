<table>
	<thead>
		<tr>
			<th style="background-color: #DDD"></th>
			<th style="background-color: #DDD">Name</th>
			<th style="background-color: #DDD">Target</th>
			<th style="background-color: #DDD">Achievement</th>
		</tr>
	</thead>
	<tbody>
		@foreach($schemes as $key=>$value)
			<tr>
				<td></td>
				<td style="background-color: #EEE" colspan="5"><b>{{ $value['name'] }}</b></td>
			</tr>
			@foreach($value['outputs'] as $key1=>$value1)
				@foreach($value1->targets as $key2=>$value2)
					<tr>
						<td>output-{{ $value2->id }}</td>
						<td>{{ $value1->name }}</td>
						<td>{{ $value2->value }}</td>
						<td></td>
					</tr>
				@endforeach
			@endforeach
			@foreach($value['outcomes'] as $key3=>$value3)
				@foreach($value3->targets as $key4=>$value4)
					<tr>
						<td>outcome-{{ $value4->id }}</td>
						<td>{{ $value3->name }}</td>
						<td>{{ $value4->value }}</td>
						<td></td>
					</tr>
				@endforeach
			@endforeach
		@endforeach
	</tbody>
</table>