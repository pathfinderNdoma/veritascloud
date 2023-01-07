@extends('layouts.app')
@section('content')
<style>
	.textboxs{
		background-color: white;
		border-top-color:white; 
		border-right-color:white;
		 border-left-color:white; 
		 border-bottom-color:#198754
	}
</style>	
<div class="row">


	<div class="col-lg-2 col-xs-12">
	</div>

	@foreach ($device as $device)
	<div class="col-lg-8 col-xs-12">
		<div class="container">
			<form name="form" method="POST" action="{{route('config.update', ['id'=>$device->deviceID])}}" enctype="multipart/form-data">
		
			<div class="card" style="border-color: #198754">
				<h5 class="card-header text-center btn-success" style="background-color:#198754; color:white">Register IoT Device</h5>
				<div class="card-body">


	

					<div class="form-group">
                        <label style="color:#198754; font-weight:bolder; font-size:16px">Authorization Code</label>
						<input type="text" name="authorization_code" class="form-control textboxs" value="{{$device->authorization_code}}" readonly>
					</div>
					<br/>

                    <div class="form-group">
                        <label style="color:#198754; font-weight:bolder; font-size:16px">Device ID</label>
						<input type="text" name="device_id" class="form-control textboxs" Value="{{$device->deviceID}}" readonly>
					</div>
					<br/>

				<div class="form-group">
                    <label style="color:#198754; font-weight:bolder; font-size:16px">Device Name</label>
					<input type="text" name="device_name" class="form-control" value="{{$device->device_name}}" style="background-color:white">
				</div>
				<br/>


				<div class="form-group">
                    <label style="color:#198754; font-weight:bolder; font-size:16px">Device States</label>
					<select name="device_type" class="device_type form-select" id="device_type"> 
					<option value="">{{ __('Choose Device Type') }}</option>
					<option value="two_state">Two State (Digital Device)</option>
					<option value="multi_state">Multi State (Analog Device)</option>
					</select>
	 			</div>
				</br>

				{{-- ********************* IN THIS DIV, THE DEVICE STATES FOR TWO_STATE DEVICES WILL BE DISPLAYED FOR SELECTION************* --}}
		<div class="two_states" id="two_states"></div>			
		{{-- ******************** IN THIS DIV, THE DEVICE STATES FOR TWO_STATE DEVICES WILL BE DISPLAYED FOR SELECTION************** --}}
	
	
	{{-- ******************************* IN THIS DIV, THE DEVICE STATES FOR MULTI_STATE DEVICES WILL BE DISPLAYED FOR SELECTION**************** --}}
					<div class="row multi_states d-none" id="multi_states">
							<div class="col-md-5 col-xs-12 col-lg-5">
							<select name="device_states" id="device_states" class="form-select" 
							style="border-top-color:white; border-right-color:white; border-left-color:white; border-bottom-color:#198754">
							<option value="">Select Device State</option>
							<option value="low">Low</option>
							<option value="medium">Medium</option>
							<option value="high">High</option>
							<option value="veryHigh">Very High</option>
							</select>
							</div>	
							<br/></br></br>
	
						
							<div class="col-md-3 col-xs-12 col-lg-3">
								<input type="button" value="Add Device State" name="add" id="add" class="btn btn-success form-control">
								</div> </br></br>
								
								<div class="col-md-4 col-xs-12 col-lg-4">
								<input type="button" value="Clear Selection" name="clear" id="clear" class="btn btn-dark form-control">
								</div></br>
					</div></br>
				{{-- ******************************* IN THIS DIV, THE DEVICE STATES FOR MULTI_STATE DEVICES WILL BE DISPLAYED FOR SELECTION**************** --}}
	
					{{-- ******************************* IN THIS DIV, THE DEVICE STATES SELECTED WILL BE APPENDED **************** --}}
					<div class="row" id="devStatesContainer">
						<div class="row devStates" id="devStates"></div>
					</div>
	
					{{-- ******************************* IN THIS DIV, THE DEVICE STATES SELECTED WILL BE APPENDED **************** --}}


				<div class="form-group">
					<label>Upload Device Image</label>
					<input type="file" class="form-control" name="device_image">
					@csrf
				</div>
				</br>
		@endforeach
	

	<div class="row">
		<div class="col-md-4 col-xs-12 col-lg-4">
			<input type="submit" value="Save Device Config" name="submit" class="btn btn-success form-control">
		</div>

	</br></br>
		<div class="col-md-4 col-xs-12 col-lg-4">
			<a id="switch" href="{{route('deviceConfig', ['id'=>$device->deviceID])}}" class="btn btn-outline-danger form-control">Cancel</a>
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