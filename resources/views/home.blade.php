@extends('layouts.app')

@section('content')
<div class="row col-12">
  <p><marquee><span style="">{{auth()->user()->name}} IoT Project</span></marquee></p>
</div>

    @if (count($devices)==0)

    <!--****************************Checking if there is no devices registere***********************  -->
              <div class="row col-12">

                <div class="col-md-2 col-xs-2 col-lg-2"></div>

                <div class="col-md-8 col-xs-12 col-lg-8">
                    <div class="card" style="border-color:#198754">
                      <div class="card-header text-center" style="background-color:#198754; color:white">
                        Hello {{auth()->user()->name}}
                      </div>
                      <div class="card-body">
                        <h5 class="card-title text-center">You do not have any device added yet</h5>
                        <br/>
                        {{-- <p class="card-text">You do not have any device added yet</p> --}}
                        <div class="row col-12">
                          <div class="col-4"></div>
                          <div class="col-8">

                            <a href="/add_device" class="btn btn-outline-success ">Add Device</a>
                            <a href="#" class="btn btn-success">Get Authorization Code</a>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                  
                <div class="col-md-2 col-xs-2 col-lg-2"></div>
                </div>
    <!--****************************Checking if there is no devices registered ends***********************  -->     

@endif
     <!--****************************Checking if there is only one device starts***********************  -->
    @if(count($devices)==1)

              <!-- Checking if the device type is two state device starts -->
              
              @foreach ($devices as $device)
               
              {{--HIDDEN FIELD: DEVICE TYPE --}}
              <input type="button" id="d_type" value="{{$device->device_type}}" >
              {{--HIDDEN FIELD: DEVICE TYPE --}}

                            @if ($device->device_type=='two_state')
                            <div class="container">
                            <div class="row">
                              

                              <div class="col-md-2 col-xs-12 col-lg-2"></div>
              
                              <div class="col-md-8 col-xs-12 col-lg-8">
                                  <div class="card" style="border-color:#198754">

                                    {{-- HIDDEN FIELD: DEVICE ID--}}
                                    <input type="button" id="deviceID_two" value="{{$device->deviceID}}" class=" d-none">
                                    
                                    {{-- HIDDEN FIELD: DEVICE ID--}}


                                    <div class="card-body">
                                      <img src="/storage/device_images/{{$device->device_image}}" class="h-100 img-fluid rounded mx-auto d-block" alt="Device Image" height="200" width="250">
                                      <br/>
                                      <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                                <div class="card-body text-center">
                                  <p style="color:#0a4e2e; font-weight:bolder">Device Name: {{$device->device_name}}</p>
                                  
                                  <p id="twoState_status"</p>
                                  
                                  
                                  <div class="row vstack gap-2 col-md-12 mx-auto">
                                    <div class="col-12">
                                      <input type="button" name="two_state" id="two_state" value="Turn Device On" 
                                      class="btn btn-success form-control" onclick="call()">
                                      {{-- <input type="button" id="button" onclick="testfunc()" value="Test"> --}}
                                   
                                    
                                    </div>
              
                                    <div class="col-12">
                                      <a id="switch" href="{{route('deviceConfig', ['id'=>$device->deviceID])}}" class="btn btn-outline-success form-control">Device Configuration</a>
                                    </div>
              
                                  </div>
                              
                                </div>
                                      {{-- <p class="card-text">You do not have any device added yet</p> --}}
                                      
                                      
                                    </div>
                                  </div>
                                
                              <div class="col-md-2 col-xs-2 col-lg-2"></div>
                              </div>
                            </div>

                              <!-- Checking if the device type is two state device ends -->
          
              

          <!-- If the device type is multi state starts-->
              @else
              <div class="container">
                <div class="row">
                  

                  <div class="col-md-2 col-xs-12 col-lg-2"></div>
  
                  <div class="col-md-8 col-xs-12 col-lg-8">
                      <div class="card" style="border-color:#198754">

                        {{-- HIDDEN FIELD: DEVICE ID--}}
                        <input type="button" id="deviceID_multi" value="{{$device->deviceID}}" class=" d-none">
                                    
                        {{-- HIDDEN FIELD: DEVICE ID--}}

                        <div class="card-body text-center">
                          <img src="/storage/device_images/{{$device->device_image}}" class="h-100 img-fluid rounded mx-auto d-block" alt="Device Image" height="200" width="250">
                          <br/>
                          <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                          <p style="color:#0a4e2e; font-weight:bolder">Device Name: {{$device->device_name}}</p>
                          <p id="multiState_status"</p>
                          {{-- <div class="row vstack gap-2 col-md-12 mx-auto"> --}}
                          <div class="row">
                            <div class="col-6">
                              <select class="form-select" id="multiDeviceLevel">
                                <option>Select Device Level</option>
                                <option value="off">Off</option>
                                @if ($device->low_state=='active')
                                  <option value="low">Low</option>  
                                  @endif

                                  @if ($device->medium_state=='active')
                                  <option value="medium">Medium</option>  
                                  @endif

                                  @if ($device->high_state=='active')
                                  <option value="high">High</option>  
                                  @endif

                                  @if ($device->veryHigh_state=='active')
                                  <option value="very_high">Very High</option>  
                                  @endif
                              </select>
                            </div>

                            <div class="col-6">
                              <input type="button" id="multiChangeState" value="Apply" class="btn btn-success form-control">
                            </div>
                            
                          </br></br> 
                          <div class="row">
                            <div class="col-3">
                            
                            </div> 

                            <div class="col-6">
                              <a id="switch" href="{{route('deviceConfig', ['id'=>$device->deviceID])}}" class="btn btn-outline-success form-control">Device Configuration</a>
                            </div> 

                            <div class="col-3x  ">
                             
                            </div> 

                          </div>
                              
                          </div>
                      
                        </div>
                      </div> 
                    </div>
            @endif
             @endforeach
     <!--****************************Checking if there is only one device ends***********************  -->
 
@endif
    
        
  <!--****************************Checking if there is  more than one device***********************  -->
    @if(count($devices)>1)

              {{--HIDDEN FIELD: COUNT THE NUMBER OF DEVICES --}}
             
              <input type="button" id="device_count" value="{{count($devices)}}" >
              {{--HIDDEN FIELD: COUNT THE NUMBER OF DEVICES --}}
    
    {{-- Looping through the array --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
      <p class="d-none">{{$count=1}}</p>
    @foreach ($devices as $device)

   
    
                      {{-- Checking if the device for each item is a two state device --}}
                      @if ($device->device_type=='two_state')
            
                   
                     
                      <div class="col-xs-4">
                        <div class="card h-100" style="border-color:#198754;">

                          {{-- <div class="row"> --}}

                            {{-- <div class="col-2"></div> --}}
                           
                              <img src="/storage/device_images/{{$device->device_image}}" class="h-100 img-fluid rounded mx-auto d-block" alt="Device Image" height="200" width="250">
                                                       
                            {{-- <div class="col-2"></div> --}}

                          {{-- </div> --}}
                          
                          <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                          <div class="card-body text-center">


                    {{--HIDDEN FIELD: DEVICE TYPE --}}
                          
                           <input type="button" id="d_type{{$count}}" value="{{$device->device_type}}" >
                           <input type="button" id="twoStatedeviceID{{$count}}" value="{{$device->deviceID}}" >
                           
                   {{--HIDDEN FIELD: DEVICE TYPE --}}


                            <p style="color:#0a4e2e; font-weight:bolder">Device Name: {{$device->device_name}}</p>
                            <p id="twoState_status{{$count}}" style="color:#0a4e2e; font-weight:bolder">Device Status:</p>
                            
                            <div class="row vstack gap-2 col-md-12 mx-auto">
                              <div class="col-12">
                                <input type="button" id="two_state{{$count}}" value="Turn Device On" class="btn btn-success form-control">
                              
                              </div>
        
                              <div class="col-12">
                                <a id="switch" href="{{route('deviceConfig', ['id'=>$device->deviceID])}}" class="btn btn-outline-success form-control">Device Configuration</a>
                              </div>
        
                            </div>
                        
                          </div>
                        </div>
                      </div>
                           
      {{-- ***************************************************************************************************** --}}
                      {{-- IF THE DEVICE IS A MULTI STATE DEVICE--}}



                      @else
                      <div class="col-xs-4">
                        <div class="card h-100" style="border-color:#198754;">
                          <img src="/storage/device_images/{{$device->device_image}}" class=" h-100 img-fluid rounded mx-auto d-block" alt="Device Image" height="200" width="250">
                          <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                          <div class="card-body text-center">


              {{--HIDDEN FIELD: DEVICE TYPE --}}
                    
              <input type="button" id="d_type{{$count}}" value="{{$device->device_type}}" >
              <input type="button" id="multiStatedeviceID{{$count}}" value="{{$device->deviceID}}" >
                   
              {{--HIDDEN FIELD: DEVICE TYPE --}}



                            <p style="color:#0a4e2e; font-weight:bolder">Device Name: {{$device->device_name}}</p>
                            <p id="multiState_status{{$count}}" style="color:#0a4e2e; font-weight:bolder"></p>
                           {{$count}}
                            <div class="row g-3">
                              <div class="col">
                                <select class="form-select" id="multiState_level{{$count}}">
                                  <option>Select Device Level</option>
                                  <option value="off">Off</option>
                                  @if ($device->low_state=='active')
                                    <option value="low">Low</option>  
                                    @endif
  
                                    @if ($device->medium_state=='active')
                                    <option value="medium">Medium</option>  
                                    @endif
  
                                    @if ($device->high_state=='active')
                                    <option value="high">High</option>  
                                    @endif
  
                                    @if ($device->veryHigh_state=='active')
                                    <option value="very_high">Very High</option>  
                                  @endif
                                 
                                </select>
                              </div>
                              <div class="col">
                                <input type="button" id="apply_level{{$count}}" class="form-control btn btn-success" value="Apply" aria-label="apply">
                              </div>

                              <div class="col-12">
                                <a id="switch" href="{{route('deviceConfig', ['id'=>$device->deviceID])}}" class="btn btn-outline-success form-control">Device Configuration</a>
                              </div>
                            
                            

                              {{-- <div class="col-12">
                                <a id="switch" href="/pages/{{$device->id}}" class="btn btn-outline-success form-control">Device Config</a>
                              </div>  --}}
                                   
                            </div>
                        
                          </div>
                        </div>
                      </div>
                          
                      @endif
          <p class="d-none">{{ $count++ }}</p>            
    @endforeach
   
  </div>
  @csrf 
</div>
 @endif

@endsection
<script src="{{ asset('jquery/jquery.js') }}"></script>
@section('page-script')
@include('inc.control')
@include('inc.monitor')



