	<div class="row">
		<div class="col-md-3 scheme_dets_block_wrap">
			<div class="scheme_dets_block title">Objectives</div>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-6 scheme_dets_block_wrap">
					<div class="scheme_dets_block title">Outputs</div>
				</div>
				<div class="col-md-6 scheme_dets_block_wrap">
					<div class="scheme_dets_block title">Outcomes</div>
				</div>
			</div>
		</div>
	</div> 
@foreach($scheme_dets as $key=>$value)
	<div class="row">
		<div class="col-md-3 scheme_dets_block_wrap">
			<div class="scheme_dets_block text-center">{{ $value['name'] }}</div>
		</div>
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						@if(!empty($value['output']))
							@foreach($value['output'] as $key1=>$value1)
								@php
									if($value1['status'] == 1){
										$class = 'na';
									}
									else if($value1['status'] == 2){
										$class = 'ontrack';
									}
									else if($value1['status'] == 3){
										$class = 'offtrack';
									}
									else if($value1['status'] == 4){
										$class = 'inprogress';
									}
								@endphp
								<div class="col-md-6 scheme_dets_block_wrap">
									<div class="scheme_dets_block {{ $class }}">
										<div class="scheme_dets_ind">{{ $value1['name'] }}</div>
										<div class="scheme_dets_ach">{{ $value1['achievement'] }}</div>
										<div class="scheme_dets_targ">
											<span class="scheme_dets_targ_prev">
												<span class="title">FY {{ date('Y', strtotime('-1 years')) }} - {{ date('y') }}</span>
												<span class="value"></span>
											</span>
											<span class="scheme_dets_targ_curr">
												<span class="title">FY {{ date('Y') }} - {{ date('y', strtotime('+1 years')) }}</span>
												<span class="value">{{ $value1['target'] }}</span>
											</span>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="col-md-12 scheme_dets_block_wrap text-center">
								<div class="scheme_dets_block">No Outputs</div>
							</div>
						@endif
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						@if(!empty($value['outcome']))
							@foreach($value['outcome'] as $key1=>$value1)
								@php
									if($value1['status'] == 1){
										$class = 'na';
									}
									else if($value1['status'] == 2){
										$class = 'ontrack';
									}
									else if($value1['status'] == 3){
										$class = 'offtrack';
									}
									else if($value1['status'] == 4){
										$class = 'inprogress';
									}
								@endphp
								<div class="col-md-6 scheme_dets_block_wrap">
									<div class="scheme_dets_block {{ $class }}">
										<div class="scheme_dets_ind">{{ $value1['name'] }}</div>
										<div class="scheme_dets_ach">{{ $value1['achievement'] }}</div>
										<div class="scheme_dets_targ">
											<span class="scheme_dets_targ_prev">
												<span class="title">FY {{ date('Y', strtotime('-1 years')) }} - {{ date('y') }}</span>
												<span class="value"></span>
											</span>
											<span class="scheme_dets_targ_curr">
												<span class="title">FY {{ date('Y') }} - {{ date('y', strtotime('+1 years')) }}</span>
												<span class="value">{{ $value1['target'] }}</span>
											</span>
										</div>
									</div>
								</div>
							@endforeach
						@else
							<div class="col-md-12 scheme_dets_block_wrap text-center">
								<div class="scheme_dets_block">No Outcomes</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach