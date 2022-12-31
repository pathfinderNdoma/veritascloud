@extends('layouts.app')
@section('content')

<div class="row">


	<div class="col-lg-2 col-xs-12">
	</div>

	<div class="col-lg-8 col-xs-12">
		<div class="container">
			<form name="form" method="POST" action="{{route('add.store')}}" enctype="multipart/form-data">

			<div class="card bg-light" style="border-color: #198754">
				<h5 class="card-header text-center btn-success" style="background-color:#198754; color:white">Register IoT Device</h5>
				<div class="card-body">


					<div class="form-group">
						<input type="text" name="authorization_code" class="form-control" placeholder="Enter authorization code" 
						style="border-top-color:white; border-right-color:white; border-left-color:white; border-bottom-color:#198754">
					</div>
					<br/>

				<div class="form-group">
					<input type="text" name="device_name" class="form-control" placeholder="Enter Device Name" 
					style="border-top-color:white; border-right-color:white; border-left-color:white; border-bottom-color:#198754">
				</div>
				<br/>


				<div class="form-group">
					<select name="device_type" class="device_type form-select" id="device_type" 
					style="border-top-color:white; border-right-color:white; border-left-color:white; border-bottom-color:#198754">
					<option value="">{{ __('Choose Device Type') }}</option>
					<option value="two_state">Two State (Digital Device)</option>
					<option value="multi_state">Multi State (Analog Device)</option>
					</select>
	 			</div>
				</br>

				<div class="row disp_state" id="disp_state">
				
				</div></br>


				<div class="form-group">
					<label>Upload Device Image</label>
					<input type="file" class="form-control" name="device_image">
					@csrf
				</div>
				</br>
	
	<input type="submit" value="Register Device" name="submit" class="btn btn-outline-success">
						
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