@extends('layouts.app')
@section('content')

<div class="row">


	<div class="col-lg-2 col-xs-12">
	</div>

	<div class="col-lg-8 col-xs-12">
		<div class="container">
			<form name="form" method="POST" action="{{route('add.store')}}" enctype="multipart/form-data">

			<div class="card bg-light" style="border-color: #198754">
				<h5 class="card-header text-center btn-success" style="background-color:#198754; color:white">Device Config</h5>
				<div class="card-body">


				<div class="row form-group">
					

					<div class="col-lg-6 col-md-6 col-xs-12">
						<label class="" style="color:#198754; font-weight:bolder">Device Name</label>
						<div class="col">
						<div class="p-3 border bg-light">{{$device->device_name}}</div>
						  </div>
						  
						  
						{{-- <input type="text" name="device_name" class="form-control" value="{{$device->device_name}}"  readonly
						style="border-top-color:white; border-right-color:white; border-left-color:white; border-bottom-color:#198754"> --}}
					</div>
					<div class="col-lg-6 col-md-6 col-xs-12">
						<label style="color:#198754; font-weight:bolder">Device Type</label>
						<div class="col">
							@if ($device->device_type=='multi_state')
							<div class="p-3 border bg-light">Multi State Device</div>	
							@else
							<div class="p-3 border bg-light">Two State Device</div>
							@endif
							
						  </div>
					</div><p></p>
					<div class="col-lg-6 col-md-6 col-xs-12">
						<label style="color:#198754; font-weight:bolder">Device ID</label>
						<div class="p-3 border bg-light">DFHJTT55</div>					
						  </div>

					</div>
		{{-- <hr> --}}
					
					@if ($device->device_type=='multi_state')
					
					
						<div class="row col-12 text-center">
							<div class="row col-12 text-center"><h4 style="font-weight:bolder">Device States</h4></div>
							<div class="row row-cols-2 row-cols-lg-5 g-1 g-lg-1">
								
								@if ($device->low_state=='active')
								<div class="col">
									<div class="p-3 border bg-light">Low State</div>
								  </div>
								@endif

								
								@if ($device->medium_state=='active')
								<div class="col">
									<div class="p-3 border bg-light">Medium State</div>
								  </div>
								@endif

								@if ($device->high_state=='active')
								<div class="col">
									<div class="p-3 border bg-light">High State</div>
								  </div>
								@endif

								@if ($device->veryHigh_state=='active')
								<div class="col">
									<div class="p-3 border bg-light">Very High State</div>
								  </div>
								@endif
								
								
								
								
						</div>
		
					</p></p></div>
					@endif
					
				<div class="form-group">
					<div class="text-center" style="background-color:#f8f9fa;">
						<h4 class="card-header"style="background-color:#f8f9fa; font-weight:bolder">Device Image</h4>
						
						<div class="card-body">
							<div class="align-middle"><img src="/storage/device_images/{{$device->device_image}}" class="align-middle" alt="..." width="200" height="200">
							</div>
						</div>
					  </div>
				</div>
				<br/>


				
					@csrf
			<div class="row">

				<div class="col-4 text-center">
					
				</div>

				<div class="col-lg-4 col-md-4 col-xs-12 text-center">
					<a id="switch" href="{{route('edit', ['id'=>$device->id])}}" class="btn btn-success form-control">Device Config</a>
				</div>

				<div class="col-4 text-center">
					
				</div>

			</div>
						
						
				</div>
			  </div>
		</div>
	</div>

	<div class="col-lg-2 col-xs-12">
	</div>
@csrf
</form>
 
</div>
	
@endsection
<script src="{{ asset('jquery/jquery.js') }}"></script>
@section('page-script')
@include('inc.deviceStates')