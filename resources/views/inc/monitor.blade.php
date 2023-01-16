<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');	
  
/* ************************************** END OF IF THERE IS ONLY ONE DEVICE IN THE DATABASE*************** */
$(document).ready(function () {
                /* ************************************** *************** 
                IF THERE IS ONLY ONE DEVICE: AND THE DEVICE IS A TWO STATE THEN CHECK IF THE DEVICE IS ONLINE OR OFFLINE
                 ************************************** *************** */
                                    let type = $('#d_type').val()
                            if(type=='two_state'){

                                let deviceID =$('#deviceID_two').val();
                                    //if(data =alert(data)
                                    const url = "{{route('monitor')}}";
                                    //alert(url)
                                     $.ajax({
                                    url: url,
                                    type: 'GET',
                                    data:{id:deviceID},
                                    cache:false,
                                    success: function(response){
                                    
                                     
                                     
                                     if(response.data>22){
                                        $("#twoState_status").html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device is Offline</p>');
                                    }

                                    else{
                                        $("#twoState_status").html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device Online (<span>Device is currently '+response.state+'</span>)</p>');   
                                    }
                                        }
                                    });
                            }
                /* ************************************** *************** 
                IF THERE IS ONLY ONE DEVICE: AND THE DEVICE IS A TWO STATE THEN CHECK IF THE DEVICE IS ONLINE OR OFFLINE
                 ************************************** *************** */
                            else{
                                let deviceID =$('#deviceID_multi').val();
                                    //alert(deviceID)
                                    const url = "{{route('monitor')}}";
                                    //alert(url)
                                     $.ajax({
                                    url: url,
                                    type: 'GET',
                                    data:{id:deviceID},
                                    cache:false,
                                    success: function(response){
                                    //alert(deviceID)
                                    //alert(response.state)

                                    if(response.data>22){
                                        $("#multiState_status").html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device is Offline</p>');
                                    }

                                    else{
                                        $("#multiState_status").html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device Online (<span>Device is currently '+response.state+'</span>)</p>');   
                                    }


                                   
                                        }
                                    });
                            }
 /* ************************************** IF THERE IS ONLY ONE DEVICE: AND THE DEVICE IS A TWO STATE*************** */                                        
}); //END OF DOCUMENT READY FUNCTION 
    



/* ************************************** \ IF THERE ARE MORE THAN ONE ONE DEVICE IN THE DATABASE*************** */
$(document).ready(function () {
    let device_count = $('#device_count').val();
    for (let i = 0; i < device_count; i++) {

        //Get the Device type
        let device_type1 = $('#d_type'+i).val()
        //let device_type2 = $('#twoState_'+i).val()
        //alert(device_type1)
        //****************************IF the device type is multi_state ****************************
        if(device_type1=='multi_state'){

            let deviceID = $('#multiStatedeviceID'+i).val()
            //alert(deviceID)
            
            $('#multiState_'+i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device is Offline</p>');
            const url = "{{route('monitor')}}";
                    $.ajax({
                    url: url,
                    type: 'GET',
                    data:{id:deviceID},
                    cache:false,
                    success: function(response){
                    //alert(deviceID)
                    //alert(response.state)

                    if(response.data>22){
                        $("#multiState_status"+$i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device is Offline</p>');
                    }

                    else{
                        $("#multiState_status"+$i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device Online (<span>Device is currently '+response.state+'</span>)</p>');   
                    }


                    
                        }
                    });
           
        } //**************************************End of if the device is multi_state

        //If the device is two_state
        if(device_type2=='two_state'){
        let deviceID = $('#twoStatedeviceID'+i).val()
        //alert(i) 
        } //End of if the device is two_state
    


    }
       
          
        
    
});
/* ************************************** \ IF THERE ARE MORE THAN ONE ONE DEVICE IN THE DATABASE*************** */
    
</script>
    
