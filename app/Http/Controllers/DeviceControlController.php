<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceControl;
use App\Models\State;
use App\Models\Monitoring;

class DeviceControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function updatetwoState(Request $request)
   {
                $state                   =       $request->state;
                $id                      =       $request->id;

                /* *********IF THE DEVICE IS OFF********  */
                if($state=='Turn Device On'){
                    $state = 'on';
                    $updateState             =       State::where('deviceID', $id)->first();
                    $updateState->state      =       $state; 
                    $updateState->save();
    
                    $response["data"]        =       'Turn Device Off';
                    return response()->json($response);

                } /* *********IF THE DEVICE IS ON ENDS********  */

                /* *********IF THE DEVICE IS OFF********  */
                else{
                    $state = 'off';
                    $updateState             =       State::where('deviceID', $id)->first();
                    $updateState->state      =       $state; 
                    $updateState->save();
    
                    $response["data"]        =       'Turn Device On';
                    return response()->json($response);
                } /* *********IF THE DEVICE IS OFF ENDS ********  */

               
   }
    


  
    public function monitor(Request $request)
   {
              
                $id                      =       $request->id;
                $device                  =       Monitoring::where('deviceID', $id)->first(); 
                $state                  =       $device->deviceStatus;               
                $updated_at                  =       $device->updated_at;
                $last_updated            =      date($updated_at);
                $current_date             =     Date('y-m-d h:i:s');

               // $time = $last_updated-$current_date;
                $diff = strtotime($current_date)-strtotime($last_updated);
                $fullDays    = floor($diff/(60*60*24));   
                $fullHours   = floor(($diff-($fullDays*60*60*24))/(60*60));   
                $fullMinutes = floor(($diff-($fullDays*60*60*24)-($fullHours*60*60))/60);


                $response    =       array('data'=>$fullMinutes, 'state'=>$state);
                return response()->json($response);

                } /* *********IF THE DEVICE IS ON OR OFF ENDS********  */

               

               
   }