<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationCode;
use Illuminate\Http\Request;
use App\Models\Devices;

class DeviceConfig extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
       
        $device = Devices::where('deviceID', $id)->get();
       // return $device;
        return view('pages.deviceConfig')->with('device', $device);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $device = Devices::find($id);
        return view('pages.editDeviceConfig')->with('device', $device);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'authorization_code'=>'required',
            'device_name'=>'required',
            'device_type'=>'required',
                      
        ]);
        $id = $request->id;
        $updateDevice = Devices::find($id);

        
  //***********************Else if it is a two state DEVICE **************************************
     if($request->input('device_type')=='multi_state'){
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
            
    //Handle the file upload
    $filenameExtension = $request->file('device_image');
    if($filenameExtension!=null){
        return $filenameExtension;
        $extension = $request->file('device_image')->getClientOriginalExtension();
        $filenameToStore = $request->input('device_name').'_'.time().'.'.$extension;
        //Upload the image
        $path = $request->file('device_image')->storeAs('public/device_images', $filenameToStore); 
    }
    else{
        $filenameToStore = $updateDevice->device_image;
    }

          
          $updateDevice->device_name               =  $request->input('device_name');
          $updateDevice->device_type               =  $request->input('device_type');
          $updateDevice->low_state                 =   $lowState; 
          $updateDevice->medium_state              =   $mediumState; 
          $updateDevice->high_state                =   $highState; 
          $updateDevice->veryHigh_state            =   $veryHighState; 
          $updateDevice->device_image          =  $filenameToStore;
          $devices = Devices::where('user_id', $updateDevice->user_id)->get();

          if($updateDevice->save()){
            $id = $request->id;
            $device = Devices::find($id);
            return view('pages.deviceConfig')->with('device', $device);
          }
          else{
            return redirect('editDeviceConfig')->with('error', 'Device configuration update failed');
          }
    }

 //***********************Else if it is a two state DEVICE **************************************        
else{
    
        //Handle the file upload
        $filenameExtension = $request->file('device_image');
        if($filenameExtension){
            $extension = $request->file('device_image')->getClientOriginalExtension();
            $filenameToStore = $request->input('device_name').'_'.time().'.'.$extension;
            //Upload the image
            $path = $request->file('device_image')->storeAs('public/device_images', $filenameToStore); 
        }
        else{
            $filenameToStore = $updateDevice->device_image;
        }


//Updat the database
$updateDevice->device_name         =    $request->input('device_name');
$updateDevice->device_type         =    $request->input('device_type');
$updateDevice->on_state            =    'active'; 
$updateDevice->off_state          =    'active';  
$updateDevice->device_image        =    $filenameToStore;

//If the device is registered/save
if($updateDevice->save()){
            $id = $request->id;
            $device = Devices::find($id);
            return view('pages.deviceConfig')->with('device', $device);
  }
  else{
    return redirect('editDeviceConfig')->with('error', 'Device configuration update failed');
  }

    
}    
    }
 //***********************End of Update Method ************************************** 
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

    //Function to return all devices
    // public function DeviceConfig(){
    //     $userid= auth()->user()->id;
    //     $devices = Devices::where('user_id', $userid)->get();
    //     return view('home')->with('devices', $devices);
    // }
}
