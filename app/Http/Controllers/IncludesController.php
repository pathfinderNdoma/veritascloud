<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devices;

class IncludesController extends Controller
{

    //Function to upload Device Imagess
    public function deviceImage(Request $request){
        //Handle the file upload
        $filenameExtension = $request->file('device_image');
        $extension = $request->file('device_image')->getClientOriginalExtension();
        $filenameToStore = $request->input('device_name').'_'.time().'.'.$extension;
        //Upload the image
        $path = $request->file('device_image')->storeAs('public/device_images', $filenameToStore); 
        return $filenameToStore;
    }


    //Function to generate Unique ID
    function generate_ID() {
        $numinput = '0123456789';
        $numstrength = 5;
        $input_length = strlen($numinput);
        $num = '';
        for($i = 0; $i < $numstrength; $i++) {
            $random_num = $numinput[mt_rand(0, $input_length - 1)];
            $num.= $random_num;
        }
    
        //Generating character
        $charinput = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charstrength = 4;
        $input_length = strlen($charinput);
        $char = '';
        for($i = 0; $i < $charstrength; $i++) {
            $random_char = $charinput[mt_rand(0, $input_length - 1)];
            $char.= $random_char;
        }
       
        $unique_id = $num.$char;
        return $unique_id;
    }

}
