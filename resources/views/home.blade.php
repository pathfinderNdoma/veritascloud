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

     <!--****************************Checking if there is only one device starts***********************  -->
    @elseif(count($devices)==1)

              <!-- Checking if the device type is two state device starts -->
                            @if ($devices->device_type=='two_state')
                            <div class="col-xs-4">
                              <div class="card h-100" style="border-color:#198754">
                                <img src="/storage/device_images/{{$device->device_image}}" class="card-img-top" alt="..." height="200" width="250">
                                <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                                <div class="card-body text-center">
                                  <p>Device Name:{{$device->device_name}}</p>
                                  <p>Device Status: OFF</p>
                                  
                                  <div class="row">
                                    <div class="col-12">
                                      <input type="button" id="switch" value="Turn Device On" class="btn btn-success form-control">
                                    
                                    </div>
                        
                                    <div class="col-12">
                                      <a id="switch" href="{{route('editdeviceConfig', ['id'=>$device->id])}}" class="btn btn-outline-success form-control">Device Config</a>
                                    </div>
                        
                                  </div>
                              
                                </div>
                              </div>
                            </div>
          <!-- Checking if the device type is two state device ends -->

          <!-- If the device type is multi state starts-->
              @else
                    <div class="col-xs-4">
                        <div class="card h-100" style="border-color:#198754; background-color:#f8f9fa">
                        <img src="/storage/device_images/{{$device->device_image}}" class="h-100 " alt="..." height="200" width="250">
                        <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                        <div class="card-body text-center">
                          <p>Device Name:{{$device->device_name}}</p>
                          <p>Device Status:Off</p>
                          

                          {{-- <div class="row vstack gap-2 col-md-12 mx-auto"> --}}
                          <div class="row col-12">
                            <div class="col-6">
                              <select class="form-select">
                                <option>Select Device Level</option>
                                <option>Off</option>
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Very High</option>
                              </select>
                            </div>

                            <div class="col-12">
                              <input type="button" id="switch" value="Apply" class="btn btn-success form-control">
                            </div> 
                                
                          </div>
                      
                        </div>
                      </div> 
                @endif
     <!--****************************Checking if there is only one device ends***********************  -->


    
        
  <!--****************************Checking if there is  more than one device***********************  -->
    @elseif(count($devices)>1)

    
    {{-- Looping through the array --}}
    <div class="row row-cols-1 row-cols-md-3 g-4 ">
    @foreach ($devices as $device)
    
                      {{-- Checking if the device for each item is a two state device --}}
                      @if ($device->device_type=='two_state')
                      
                      <div class="col-xs-4">
                        <div class="card h-100" style="border-color:#198754; background-color:#f8f9fa">

                          {{-- <div class="row"> --}}

                            {{-- <div class="col-2"></div> --}}
                           
                              <img src="/storage/device_images/{{$device->device_image}}" class="h-100 img-fluid rounded mx-auto d-block" alt="Device Image" height="200" width="250">
                                                       
                            {{-- <div class="col-2"></div> --}}

                          {{-- </div> --}}
                          
                          <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                          <div class="card-body text-center">
                            <p>Device Name:{{$device->device_name}}</p>
                            <p>Device Status:Off</p>
                            
                            <div class="row vstack gap-2 col-md-12 mx-auto">
                              <div class="col-12">
                                <input type="button" id="switch" value="Turn Device On" class="btn btn-success form-control">
                              
                              </div>
        
                              <div class="col-12">
                                <a id="switch" href="{{route('deviceConfig', ['id'=>$device->id])}}" class="btn btn-outline-success form-control">Device Config</a>
                              </div>
        
                            </div>
                        
                          </div>
                        </div>
                      </div>
                      
                      {{-- If it is not a two state device --}}
                      @else
                      <div class="col-xs-4">
                        <div class="card h-100" style="border-color:#198754; background-color:#f8f9fa">
                          <img src="/storage/device_images/{{$device->device_image}}" class=" h-100 img-fluid rounded mx-auto d-block" alt="Device Image" height="200" width="250">
                          <hr style="color:#198754; border-color:#198754; font-weight:bolder">
                          <div class="card-body text-center">
                            <p>Device Name: {{$device->device_name}}</p>
                            <p>Device Status: Off</p>
                           
                            <div class="row g-3">
                              <div class="col">
                                <select class="form-select">
                                  <option>Select Device Level</option>
                                  <option>Off</option>
                                  <option>Low</option>
                                  <option>Medium</option>
                                  <option>High</option>
                                  <option>Very High</option>
                                </select>
                              </div>
                              <div class="col">
                                <input type="button" class="form-control btn btn-success" value="Apply" aria-label="apply">
                              </div>

                              <div class="col-12">
                                <a id="switch" href="{{route('deviceConfig', ['id'=>$device->id])}}" class="btn btn-outline-success form-control">Device Config</a>
                              </div>
                            
                            

                              {{-- <div class="col-12">
                                <a id="switch" href="/pages/{{$device->id}}" class="btn btn-outline-success form-control">Device Config</a>
                              </div>  --}}
                                   
                            </div>
                        
                          </div>
                        </div>
                      </div>
                          
                      @endif
                      
    @endforeach
  </div>
    
</div>
          


             

    
    


    
  
  @endif
@endsection
