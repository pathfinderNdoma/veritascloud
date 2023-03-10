<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Devices;
use App\Models\Monitoring;
use App\Models\State;
use Illuminate\Support\Facades\Storage;

class DeviceConfig extends Controller
{

    public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
       
        $device = Devices::where('deviceID', $id)->first();
       //return $device;
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
        $device = Devices::where('deviceID', $id)->get();
        //return $device;
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
        $updateDevice =  Devices::where('deviceID', $id)->first();

        
  //***********************IF IT IS  A MULTI STATE DEVICE**************************************
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
            if($filenameExtension){
            
            $deviceID = app('App\Http\Controllers\IncludesController')->generate_ID($request);
            // return $deviceID;
            $filenameToStore = app('App\Http\Controllers\IncludesController')->deviceImage($request, $deviceID);
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
          

          if($updateDevice->save()){
            echo '<script>alert("Device configuration updated")</script>';
            $id = $request->id;
            $device = Devices::where('deviceID', $id)->first();
            return view('pages.deviceConfig')
            ->with('device', $device)
            ->with('success', 'Device Configuration updated successully');
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
            //Calling the image upload function
            $deviceID = app('App\Http\Controllers\IncludesController')->generate_ID($request);
            // return $deviceID;
            $filenameToStore = app('App\Http\Controllers\IncludesController')->deviceImage($request, $deviceID);
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
            echo '<script>alert("Device configuration updated")</script>';
            $id = $request->id;
            $device = Devices::where('deviceID', $id)->first();
            // return $device;
            return view('pages.deviceConfig')
            ->with('success', 'Device Configuration updated successully')   
            ->with('device', $device);
            
  }
  else{
    return redirect('editDeviceConfig')->with('error', 'Device configuration update failed');
  }

    
}    
    }
 //***********************End of Update Method ************************************** 



 //******************DELETE THE DEVICE METHOD */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(Request $request){
    $id = $request->id;
    $filename =$request->imageName;
    $filePath = 'symlink/' . $filename;



    $device = Devices::where('deviceID', $id)->first();
    $dev_monitoring = Monitoring::where('deviceID', $id)->first();
    $dev_state = State::where('deviceID', $id)->first();

   if( $device->delete() && $dev_monitoring->delete() && $dev_state->delete()){

    if(Storage::disk('public')->exists($filePath)){
        Storage::disk('public')->delete($filePath);
        return redirect('home')->with('success', 'Device Deleted');
    }
    else{
    return redirect('home')->with('error', 'Error Encountered');
    }
      
   }
   else{
    return redirect('home')->with('error', 'Error Encountered: Device Image was not deleted from the public folder');
   } //End of delete if statement


   }
} //End of class
