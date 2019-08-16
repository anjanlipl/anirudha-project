@php $count = count($schemes); @endphp
<table class="table table-bordered">
	<thead>
		<th></th>
		@for($i=0; $i<$count; $i++)
			<th>{{ $schemes[$i]['scheme_name'] }}</th>
		@endfor
	</thead>
	<tbody>
		<tr>
			<td style="font-weight: 600;" class="text-center">Object Head</td>
			@for($i=0; $i<$count; $i++)
				<td class="text-center">{{ $schemes[$i]['code'] }}</td>
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Scheme Duration</td>
			@for($i=0; $i<$count; $i++)
				<td class="text-center">{{ date('d M, Y', strtotime($schemes[$i]['start_date'])) }} to {{ date('d M, Y', strtotime($schemes[$i]['end_date'])) }}</td>
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Total Allocation</td>
			@for($i=0; $i<$count; $i++)
				<td class="text-center">{{ $schemes[$i]['totalEst'] }}</td>
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Total Expenditure</td>
			@for($i=0; $i<$count; $i++)
				<td class="text-center">{{ $schemes[$i]['totalExp'] }}</td>
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Expenditure %</td>
			@for($i=0; $i<$count; $i++)
				@if($schemes[$i]['totalEst'] == 0)
					<td class="text-center">0</td>
				@else
					<td class="text-center">{{ round(($schemes[$i]['totalExp'] / $schemes[$i]['totalEst'])*100, 2) }} %</td>
				@endif
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Total Indicators</td>
			@for($i=0; $i<$count; $i++)
				<td class="text-center">{{ $schemes[$i]['totalInd'] }}</td>
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Total On track Indicators</td>
			@for($i=0; $i<$count; $i++)
				<td class="text-center">{{ $schemes[$i]['totalIndOn'] }}</td>
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Total On track %</td>
			@for($i=0; $i<$count; $i++)
				@if($schemes[$i]['totalInd'] == 0)
					<td class="text-center">0</td>
				@else
					<td class="text-center">{{ round(($schemes[$i]['totalIndOn'] / $schemes[$i]['totalInd'])*100, 2) }} %</td>
				@endif
			@endfor
		</tr>
		<tr>
			<td style="font-weight: 600;" class="text-center">Dashboard</td>
			@for($i=0; $i<$count; $i++)
					<td class="text-center"><a href="scheme_dashboard.html?scheme_id={{ $schemes[$i]['scheme_id'] }}" class="btn btn-primary"><span class="text">Visit Dashboard</span></a></td>
			@endfor
		</tr>
	</tbody>
</table>