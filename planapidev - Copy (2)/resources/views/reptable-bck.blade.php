<div class="row rep-table" style="width: 2400px;">
	<div class="scheme-title">{{ $scheme->name }}</div>
	<table class="table table-bordered">
		<thead>
			{{-- <th>Sr. No.</th> --}}
			{{-- <th>Name of the Scheme/Programme</th> --}}
			<th>Budget Allocation (Rs. Lakh)</th>
			<th>Timelines</th>
			<th>Objectives</th>
		</thead>
		<tbody>
			<tr>
				{{-- <td>1.</td> --}}
				{{-- <td></td> --}}
				<td></td>
				<td>{{ date('Y' ,strtotime($scheme->start_date)) }} - {{ date('Y' ,strtotime($scheme->end_date)) }}</td>
				<td class="padd-0">
					<table class="table table-bordered">
						<thead>
							<th>Objective</th>
							<th>Outputs</th>
						</thead>
						<tbody>
							@foreach($objectives as $key=>$value)
							<tr>
								<td>{{ $value->name }}</td>
								<td class="padd-0" width="">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Output name</th>
												<th>Outcome</th>
												<th>Indicators</th>
											</tr>
										</thead>
										<tbody>
											@foreach($value->outputs as $key1=>$value1)
											<tr>
												<td>{{ $value1->name }}</td>
												<td class="padd-0">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>Name</th>
																<th>Indicators</th>
															</tr>
														</thead>
														<tbody>
															@foreach($value1->outcomes as $key2=>$value2)
															<tr>
																<td>{{ $value2->name }}</td>
																<td class="padd-0">
																	<table class="table table-bordered">
																		<thead>
																			<th>Indicator Name</th>
																			<th>Baseline</th>
																			<th>Targets</th>
																		</thead>
																		<tbody>
																			@foreach($value2->indicators as $key10=>$value10)
																			<tr>
																				<td>{{ $value10->name }}</td>
																				<td class="padd-0">
																					<table class="table table-bordered">
																						<tbody>
																							@foreach($value10->baselines as $key11=>$value11)
																							<tr>
																								<td>{{ $value11->value }}</td>
																							</tr>
																							@endforeach
																						</tbody>
																					</table>
																				</td>
																				<td class="padd-0">
																					<table class="table table-bordered">
																						<thead>
																							<th>Target Name</th>
																							<th>
																								Achievements
																							</th>
																						</thead>
																						<tbody>
																							@foreach($value10->targets as $key12=>$value12)
																							<tr>
																								<td>
																									{{ $value12->value }}
																								</td>
																								<td class="padd-0">
																									<table class="table table-bordered">
																										<thead>
																											<th>Achievement Title</th>
																											<th>Reviews</th>
																										</thead>
																										<tbody>
																											@foreach($value12->achievements as $key13=>$value13)
																											<tr>
																												<td>
																													{{ $value13->description }}
																												</td>
																												<td class="padd-0">
																													<table class="table table-bordered">
																														<thead>
																															<th>Review description</th>
																															<th>Action Points</th>
																														</thead>
																														<tbody>
																															@foreach($value13->reviews as $key14=>$value14)
																															<tr>
																																<td>
																																	{{ $value14->description }}
																																</td>
																																<td class="padd-0">
																																	<table class="table table-bordered">
																																		<tbody>
																																			@foreach($value14->actions as $key15=>$value15)
																																			<tr>
																																				<td>
																																					{{ $value15->description }}
																																				</td>
																																			</tr>
																																			@endforeach
																																		</tbody>
																																	</table>
																																</td>
																															</tr>
																															@endforeach
																														</tbody>
																													</table>
																												</td>
																											</tr>
																											@endforeach
																										</tbody>
																									</table>
																								</td>
																							</tr>
																							@endforeach
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			@endforeach
																		</tbody>
																	</table>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</td>
												<td class="padd-0">
													<table class="table table-bordered">
														<thead>
															<th>Indicator Name</th>
															<th>Baseline</th>
															<th>Targets</th>
														</thead>
														<tbody>
															@foreach($value1->indicators as $key4=>$value4)
															<tr>
																<td>{{ $value4->name }}</td>
																<td class="padd-0">
																	<table class="table table-bordered">
																		<tbody>
																			@foreach($value4->baselines as $key5=>$value5)
																			<tr>
																				<td>{{ $value5->value }}</td>
																			</tr>
																			@endforeach
																		</tbody>
																	</table>
																</td>
																<td class="padd-0">
																	<table class="table table-bordered">
																		<thead>
																			<th>Target Name</th>
																			<th>
																				Achievements
																			</th>
																		</thead>
																		<tbody>
																			@foreach($value4->targets as $key6=>$value6)
																			<tr>
																				<td>
																					{{ $value6->value }}
																				</td>
																				<td class="padd-0">
																					<table class="table table-bordered">
																						<thead>
																							<th>Achievement Title</th>
																							<th>Reviews</th>
																						</thead>
																						<tbody>
																							@foreach($value6->achievements as $key7=>$value7)
																							<tr>
																								<td>
																									{{ $value7->description }}
																								</td>
																								<td class="padd-0">
																									<table class="table table-bordered">
																										<thead>
																											<th>Review description</th>
																											<th>Action Points</th>
																										</thead>
																										<tbody>
																											@foreach($value7->reviews as $key8=>$value8)
																											<tr>
																												<td>
																													{{ $value8->description }}
																												</td>
																												<td class="padd-0">
																													<table class="table table-bordered">
																														<tbody>
																															@foreach($value8->actions as $key9=>$value9)
																															<tr>
																																<td>
																																	{{ $value9->description }}
																																</td>
																															</tr>
																															@endforeach
																														</tbody>
																													</table>
																												</td>
																											</tr>
																											@endforeach
																										</tbody>
																									</table>
																								</td>
																							</tr>
																							@endforeach
																						</tbody>
																					</table>
																				</td>
																			</tr>
																			@endforeach
																		</tbody>
																	</table>
																</td>
															</tr>
															@endforeach
														</tbody>
													</table>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>