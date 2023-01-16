<style>
	.textboxs{
		background-color: white;
		border-top-color:white; 
		border-right-color:white;
		 border-left-color:white; 
		 border-bottom-color:#198754
	}
</style>
@extends('layouts.app')
@section('content')

<div class="row">


	<div class="col-lg-2 col-xs-12">
	</div>

	<div class="col-lg-8 col-xs-12">
		<div class="container">
			<form name="form" method="POST" action="{{route('add.store')}}" enctype="multipart/form-data">

			<div class="card" style="border-color: #198754">
				<h5 class="card-header text-center btn-success" style="background-color:#198754; color:white">Register IoT Device</h5>
				<div class="card-body">


					<div class="form-group">
						<input type="text" name="authorization_code" class="form-control textboxs" placeholder="Enter authorization code"
						style="background-color:white">
					</div>
					<br/>

				<div class="form-group">
					<input type="text" name="device_name" class="form-control" placeholder="Enter Device Name" 
					style="background-color:white">
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

				
				
	{{-- ********************* IN THIS DIV, THE DEVICE STATES FOR TWO_STATE DEVICES WILL BE DISPLAYED FOR SELECTION************* --}}
		<div class="two_states" id="two_states"></div>			
	{{-- ******************** IN THIS DIV, THE DEVICE STATES FOR TWO_STATE DEVICES WILL BE DISPLAYED FOR SELECTION************** --}}


{{-- ******************************* IN THIS DIV, THE DEVICE STATES FOR MULTI_STATE DEVICES WILL BE DISPLAYED FOR SELECTION**************** --}}
				<div class="row multi_states d-none" id="multi_states">
						<div class="col-md-5 col-xs-12 col-lg-5">
						<select name="device_states" id="device_states" class="form-select" style="background-color:white">
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
	
						
						<div class="row">
							<div class="col-md-4 col-xs-12 col-lg-4">
								<input type="submit" value="Register Device" name="submit" class="btn btn-outline-success form-control">
							</div>

						</br></br>
							<div class="col-md-4 col-xs-12 col-lg-4">
								<a href="../home" class="btn btn-success form-control" >
									Back to Dashboard
								</a>
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

{{-- <script src="{{ asset('js/monitor_control.js') }}"></script> --}}