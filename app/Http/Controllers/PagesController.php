<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationCode;
use Illuminate\Http\Request;
use App\Models\Devices;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'authorization_code'=>'required',
            'device_name'=>'required',
            'device_type'=>'required',
            'device_image'=>'image|max:1999'
            
        ]);
        $authorization_codes = $request->input('authorization_code');
         $authCodes = AuthorizationCode::where('authorization_code', $authorization_codes)->pluck('authorization_code');
         $count = count($authCodes);
         
        

         
         if($count==1){

            

            //Checking if the device is a two state device
        if($request->input('device_type')=='two_state'){

            //Handle the file upload
            $filenameExtension = $request->file('device_image');
            $extension = $request->file('device_image')->getClientOriginalExtension();
            $filenameToStore = $request->input('device_name').'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('device_image')->storeAs('public/device_images', $filenameToStore); 

            $device = new Devices;

            $device->authorization_code  =  $request->input('authorization_code');
            $device->device_name         =  $request->input('device_name');
            $device->device_type         =  $request->input('device_type');
            $device->on_state            =   'active'; 
            $device->off_state           =   'active'; 
            $device->low_state           =   'inactive'; 
            $device->medium_state        =   'inactive'; 
            $device->high_state          =   'inactive'; 
            $device->veryHigh_state      =   'inactive'; 
            $device->user_id             =    auth()->user()->id; 
            $device->user_email          =    auth()->user()->email; 
            $device->device_image          =  $filenameToStore;

            //If the device is registered/save
           if($device->save()){

            

            //Then redirect with a success message
            return redirect('add_device')->with('success', 'Device Registered Successfully');
           }
           else{
            return redirect('add_device')->with('error', 'Device Not Registered Successfully, kindly try again');
           }
           //If the device is registered ends 

        }
        //Checking if the device is a two state device ends

        //If the device type is a multi state device
        elseif($request->input('device_type')=='multi_state'){
     //Checking the selected states for the device
                    
                    if($request->input('low')!=''){
                        $lowState = 'active';
                    }
                    else{
                        $lowState = 'inactive';
                    }
                    //Checking for MEDIUM state
                    if($request->input('medium')!=''){
                        $mediumState = 'active';
                    }
                    else{
                        $mediumState = 'inactive';
                    }

                    //Checking for HIGH STATE
                    if($request->input('high')!=''){
                        $highState = 'active';
                    }
                    else{
                        $highState = 'inactive';
                    }
                    //Checking for VERY HIGH state
                    if($request->input('veryHigh')!=''){
                        $veryHighState ='active';
                    }
                    else{
                        $veryHighState = 'inactive';
                    }

                $device = new Devices;

                    //Handle the file upload
                    $filenameExtension = $request->file('device_image');
                    $extension = pathinfo($filenameExtension, PATHINFO_FILENAME);
                    $filenameToStore = $request->input('device_name').'_'.time().'.'.$extension;
                    //Upload the image

                     $path = $request->file('device_image')->storeAs('public/device_images', $filenameToStore); 
                     $device->authorization_code        =  $request->input('authorization_code');
                     $device->device_name               =  $request->input('device_name');
                     $device->device_type               =  $request->input('device_type');
                     $device->on_state                  =   'active'; 
                     $device->off_state                 =  'active'; 
                     $device->low_state                 =   $lowState; 
                     $device->medium_state              =   $mediumState; 
                     $device->high_state                =   $highState; 
                     $device->veryHigh_state            =   $veryHighState; 
                     $device->user_id                   =   auth()->user()->id; 
                     $device->user_email                =   auth()->user()->email; 

           //If the device is registered
           if($device->save()){
            return redirect('add_device')->with('success', 'Device Registered Successfully');
           }
           else{
            return redirect('add_device')->with('error', 'Device Not Registered Successfully, kindly try again');
           }
           //If the device is registered ends 

        }
        //IF the device is a multi state device ends

                   
//End of if the authorization code is wrong.
         }

       
         //If the authorization code is not correct
         else{
            return redirect('/add_device')->with('error', 'Invalid authorization code');
         }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //php
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_device()
    {
        return view('pages.add_device');
    }

    //Return the device state
    public function getDeviceState(Request $request)
    {
        $state =$request->id;
        
        //$state = 2;
            if($state=='1'){
                $html = '<div class="col-md-5 col-xs-4 col-lg-5" >
                <select name="device_states" id="device_states" class="form-select" 
                style="border-top-color:white; border-right-color:white; border-left-color:white; border-bottom-color:#198754">
                <option value="">Select Device State</option>
                <option value="on">On</option>
                <option value="off">Off</option>
                </select>
                </div>	
                <br/></br>
                <div class="col-md-6 col-xs-6 col-lg-6">
					<input type="button" value="Add Device State" name="add" id="add" class="btn btn-success">
					</div></br>';
            }
            else if($state=='multi_state'){
                
                $html = '
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
                <br/></br>

                    <div class="col-md-3 col-xs-6 col-lg-3">
					<input type="button" value="Add Device State" name="add" id="add" class="btn btn-success">
					</div>
                    
                    <div class="col-md-4 col-xs-6 col-lg-4">
					<input type="button" value="Clear Selection" name="clear" id="clear" class="btn btn-success">
					</div></br>
                    ';

            }
        
        $response["data"] = $html;
        //$response = json_encode ($html);
        //return response($response);
        return response()->json($response);
    }
}
