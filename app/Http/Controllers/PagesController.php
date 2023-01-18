<?php

namespace App\Http\Controllers;

use App\Models\AuthorizationCode;
use Illuminate\Http\Request;
use App\Models\Devices;
use App\Http\Controllers\IncludesController;
use App\Models\Monitoring;
use App\Models\State;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }


    public function index()
    {
        return view('index');
    }

    // public function home()
    // {
    //     return view('home');
    // }


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
        /* ********************Checking if the authorization code is correct***************** */
        $authorization_codes = $request->input('authorization_code');
         $authCodes = AuthorizationCode::where('authorization_code', $authorization_codes)->pluck('authorization_code');
         $count = count($authCodes);
         
        

         //IF the authorization code is valid
         if($count==1){

            

            //Checking if the device is a two state device
        if($request->input('device_type')=='two_state'){

           

            // ************** Calling the Device ID Function
            $deviceID = app('App\Http\Controllers\IncludesController')->generate_ID($request);
            // return $deviceID;
            $filenameToStore = app('App\Http\Controllers\IncludesController')->deviceImage($request, $deviceID);
            

            

            // ******************Checking if the device ID Exists in the database
            $id_exists = Devices::where('deviceID', $deviceID)->pluck('deviceID');
            if(count($id_exists)==0){
                $deviceID = $deviceID;
            }

            else{
                $deviceID = app('App\Http\Controllers\IncludesController')->generate_ID($request);   
            }// ******************Checking if the device ID Exists in the database
         

        //Registering the device
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
            $device->device_image        =    $filenameToStore;
            $device->deviceID            =    $deviceID;

            //If the device is registered/save
           if($device->save()){

            //Registering the device in the monitoring table
            $monitoring = new Monitoring;
            $monitoring ->deviceID = $deviceID;
            $monitoring->deviceStatus = 'Off';
            $monitoring->save();

            //Registering the device in the device read
            $states                 =    new State;
            $states->deviceID       =    $deviceID;
            $states->state          =   'Off';

            $states->save();

            

            //Then redirect with a success message
            return redirect('add_device')->with('success', 'Device Registered Successfully');
           }
           else{
            return redirect('add_device')->with('error', 'Device Not Registered Successfully, kindly try again');
           }//If the device is registered ends 
           

        }//Checking if the device is a two state device ENDS
        

        //******************************IF THE DEVICE IS A MULTI STATE DEVICE***********************
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

                    // ************** Calling the Device ID Function
                        $deviceID = app('App\Http\Controllers\IncludesController')->generate_ID($request);
                        // return $deviceID;
                        $filenameToStore = app('App\Http\Controllers\IncludesController')->deviceImage($request, $deviceID);
            
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
                     $device->device_image              =  $filenameToStore;
                     $device->deviceID                 =   $deviceID;

           //If the device is registered
           if($device->save()){
            //Registering the device in the monitoring table
            $monitoring = new Monitoring;
            $monitoring ->deviceID = $deviceID;
            $monitoring->deviceStatus = 'Off';
            $monitoring->save();

            //Registering the device in the device read
            $states                 =    new State;
            $states->deviceID       =    $deviceID;
            $states->state          =   'Off';

            $states->save();

            //Then redirect after saving into all the tables
            return redirect('add_device')->with('success', 'Device Registered Successfully');
           }
           else{
            return redirect('add_device')->with('error', 'Device Not Registered Successfully, kindly try again');
           }
           //If the device is registered ends 

        }
        //IF the device is a multi state device ends

                   

         }//End of if the authorization code is wrong.

       
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

     //Edit the Device Config
    public function edit(Request $request)
    {
        $id = $request->id;
        $device = Devices::find($id);
        return view('pages.deviceConfig')->with('device', $device);
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






    // //Return the device state
    // public function updateState(Request $request)
    // {
    //    //$state =$request->id;
    //    $html ='<p></p>';

    //    $response["data"] = $html;
    //    //$response = json_encode ($html);
    //    //return response($response);
    //    return response()->json($response);
    // }


//Dashboard method
    public function dashboard(){
            $userid= auth()->user()->id;
            $devices = Devices::where('user_id', $userid)->get();
            //return $devices;
            return view('home')->with('devices', $devices);
        }
    


}


