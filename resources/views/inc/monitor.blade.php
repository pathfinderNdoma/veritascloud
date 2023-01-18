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
    for (let i = 1; i <= device_count; i++) {

        //Get the Device type
        let device_type = $('#d_type'+i).val()
        
        //If it is a two_state device
//**********************************************************************************************************************
        if(device_type=='two_state'){
            let device_ID = $('#twoStatedeviceID'+i).val()
            const url = "{{route('monitor')}}";
                    $.ajax({
                    url: url,
                    type: 'GET',
                    data:{id:device_ID},
                    cache:false,
                    success: function(response){
                   
                    if(response.data>22){
                        $("#twoState_status"+i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device is Offline</p>');
                    }

                    else{
                            $("#twoState_status"+i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device Online (<span>Device is currently '+response.state+'</span>)</p>');   
                    }


                    }                         
                    });
        } 
//**********************************************************************************************************************
        // End of If it is a two_state device

        //If it is a multi_state device
//**********************************************************************************************************************
        
        else if(device_type =='multi_state'){

                     let device_ID = $('#multiStatedeviceID'+i).val()
                    const url = "{{route('monitor')}}";
                    //alert(url)
                    //alert(url)
                    $.ajax({
                    url: url,
                    type: 'GET',
                    data:{id:device_ID},
                    cache:false,
                    success: function(response){
                   
                    if(response.data>22){
                        $("#multiState_status"+i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device is Offline</p>');
                    }

                    else{
                            $("#multiState_status"+i).html('<p style="color:#0a4e2e; font-weight:bolder" class="multiState_status">Device Status: Device Online (<span>Device is currently '+response.state+'</span>)</p>');   
                    }


                    }                         
                    });
            
        }
//**********************************************************************************************************************
   // End of If it is a multi_state device     

    }
       
          
        
    
});
/* ************************************** \ IF THERE ARE MORE THAN ONE ONE DEVICE IN THE DATABASE*************** */
    
</script>
    
