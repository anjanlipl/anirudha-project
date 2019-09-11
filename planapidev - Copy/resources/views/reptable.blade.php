<style type="text/css">
	.rep-table td b{
		display: block;
		margin: 0px -15px;
	}
</style>
@foreach($schemes as $scheme_key=>$scheme)
<div class="row rep-table" style="width: 1800px;">
	<div class="scheme-title">{{ $scheme->name }}</div>
	<table class="table table-bordered" id="ExcelTable">
		<thead>
			<tr>
				<th width="200">Budget Allocation (Rs. Lakh)</th>
				<th width="200">Timeline</th>
				<th class="padd-0" width="1100">
					<table class="table table-bordered">
						<thead>
							<th width="200">Objectives</th>
							<th class="padd-0" width="450">
								<table class="table table-bordered">
									<thead>
										<tr><th colspan="3">Outputs</th></tr>
										<tr>
											<th width="150">Indicators</th>
											<th width="100">Baselines</th>
											<th width="100">Targets</th>
											<th width="100">Status</th>
										</tr>
									</thead>
								</table>
							</th>
							<th class="padd-0" width="450">
								<table class="table table-bordered">
									<thead>
										<tr><th colspan="3">Outcomes</th></tr>
										<tr>
											<th width="150">Indicators</th>
											<th width="100">Baselines</th>
											<th width="100">Targets</th>
											<th width="100">Status</th>
										</tr>
									</thead>
								</table>
							</th>
						</thead>
					</table>
				</th>
				<th width="300">Remarks</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td width="200"></td>
				<td width="200"><b>{{ date('Y' ,strtotime($scheme->start_date)) }} - {{ date('y' ,strtotime($scheme->end_date)) }}</b></td>
				<td class="padd-0" width="1100">
					<table class="table table-bordered">
						<tbody>
							@foreach($scheme->objectives as $key=>$value)
							<tr>
								<td width="200">{{ $value->description }}</td>
								<td class="padd-0" width="450">
									<table class="table table-bordered">
										<tbody>
											@foreach($value->outputs as $key5=>$value5)
												@foreach($value5->indicators as $key6=>$value6)
													<tr>
														<td width="150">{{ $value6->name }}</td>
														<td width="100" class="padd-0">
															<table class="table table-bordered">
																<tbody>
																	@foreach($value6->baselines as $key7=>$value7)
																	<tr><td>
																			<b>({{ date('Y', strtotime($value7->start_date)) }} - {{ date('y', strtotime($value7->end_date)) }})</b> 
																			{{ $value7->value }}
																		</td></tr>
																	@endforeach
																</tbody>
															</table>
														</td>
														<td width="100" class="padd-0">
															<table class="table table-bordered">
																<tbody>
																	@foreach($value6->targets as $key8=>$value8)
																	<tr><td>
																		<b>({{ date('Y', strtotime($value8->start_date)) }} - {{ date('y', strtotime($value8->end_date)) }})</b> 
																		{{ $value8->value }}</td>
																	</tr>
																	@endforeach
																</tbody>
															</table>
														</td>
														<td width="100" class="padd-0">
															<table class="table table-bordered">
																<tbody>
																	@foreach($value6->targets as $key8=>$value8)
																		@php $achieve = 0; @endphp
																		@foreach($value8->achievements as $key9=>$value9)
																		@php $achieve = $achieve + $value9->description @endphp
																		@endforeach
																		<tr><td>
																			<b>({{ date('Y', strtotime($value8->start_date)) }} - {{ date('y', strtotime($value8->end_date)) }})</b> 
																			{{ $achieve }}</td>
																		</tr>
																	@endforeach
																</tbody>
															</table>
														</td>
													</tr>
												@endforeach
											@endforeach
										</tbody>
									</table>
								</td>
								<td class="padd-0" width="450">
									<table class="table table-bordered">
										<tbody>
											@foreach($value->outputs as $key1=>$value1)
												@foreach($value1->outcomes as $key2=>$value2)
													@foreach($value2->indicators as $key3=>$value3)
													<tr>
														<td width="150">{{ $value3->name }}</td>
														<td width="100" class="padd-0">
															<table class="table table-bordered">
																<tbody>
																	@foreach($value3->baselines as $key4=>$value4)
																		<tr><td>
																			<b>({{ date('Y', strtotime($value4->start_date)) }} - {{ date('y', strtotime($value4->end_date)) }})</b> 
																			{{ $value4->value }}</td>
																		</tr>
																	@endforeach
																</tbody>
															</table>
														</td>
														<td width="100" class="padd-0">
															<table class="table table-bordered">
																<tbody>
																	@foreach($value3->targets as $key10=>$value10)
																	<tr><td><b>({{ date('Y', strtotime($value10->start_date)) }} - {{ date('y', strtotime($value10->end_date)) }})</b> {{ $value10->value }}</td></tr>
																	@endforeach
																</tbody>
															</table>
														</td>
														<td width="100" class="padd-0">
															<table class="table table-bordered">
																<tbody>
																	@foreach($value3->targets as $key11=>$value11)
																		@php $achieve = 0; @endphp
																		@foreach($value11->achievements as $key12=>$value12)
																			@php $achieve = $achieve + $value12->description @endphp
																		@endforeach
																	<tr><td><b>({{ date('Y', strtotime($value11->start_date)) }} - {{ date('y', strtotime($value11->end_date)) }})</b> {{ $achieve }}</td></tr>
																	@endforeach
																</tbody>
															</table>
														</td>
													</tr>
													@endforeach
												@endforeach
											@endforeach
										</tbody>
									</table>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</td>
				<td width="300">{{ $scheme->remarks }}</td>
			</tr>
		</tbody>
	</table>
</div>
@endforeach

<div class="row rep-table" style="width: 1300px;">
	<div class="col-md-12">
		<a id="downPDF" class="btn btn-primary"><span class="text">Download Report as Pdf</span></a>
		<a id="downExcel" class="btn btn-primary"><span class="text">Download Report as Excel</span></a>
	</div>
</div>