<script>
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');	
    
    /* ************************************** Function to show if there is just one device in the database *************** */
    $(document).ready(function () {
    
    /* ****************************** If it is a two State Device *************** */
                        $("#two_state").click(function (e) { 
                                    e.preventDefault();
                                    let state = $('#two_state').val()
                                    let deviceID =$('#deviceID_two').val();
                                    
                                    //if(data =alert(data)
                                    const url = "{{route('updatetwoState')}}";
                                    //alert(url)
                                     $.ajax({
                                    url: url,
                                    type: 'GET',
                                    data:{id:deviceID, state:state},
                                    cache:false,
                                    success: function(response){
                                        
                                    if(response.data=='Turn Device On'){
                                        $('#two_state').val(response.data)
                                        $('#two_state').css('background-color', '#198754');
                                        $('#two_state').css('color', 'white');
                                        
    
                                    }
    
                                    else if(response.data=='Turn Device Off'){
                                        $('#two_state').val(response.data)
                                        $('#two_state').css('background-color', 'red');   
                                    }
                                    
                                    
                                        }
                                    });
                                    
                                }); 
    
                 
                               
    /* ****************************** If it is a two State Device *************** */
    
    /* ****************************** If it is a Multi State Device *************** */
    $("#multiChangeState").click(function (e) { 
        let level = $('#multiDeviceLevel').val();
        let device_ID = $('#deviceID_multi').val();
        if(level!=='Select Device Level'){
            const url = "{{route('updateMultiState')}}";
    
                                    $.ajax({
                                    url: url,
                                    type: 'GET',
                                    data:{id:device_ID, state:level},
                                    cache:false,
                                    success: function(response){  
                                    alert(response.data)
    
                                        }
                                    });
        }//ENd of if the device level is not default: 'Select Device Level'
    
        else{
            alert('Select a valid level')
        }
        
    });
    /* ****************************** If it is a MultiState Device *************** */
        
        
    }); //END OF DOCUMENT READY FUNCTION 
    /* ************************************** Function to show if there is just one device in the database *************** */
    
    // ************************** IF THERE ARE MORE THAN ONE DEVICE ****************************************************
    $(document).ready(function () {
    
                let device_count = $('#device_count').val();
                if(device_count>1){
                for(let j =1; j<=device_count; j++){

                device_type = $('#d_type'+j).val();
         
        //Checking if the device type is a two_state device
        if(device_type == 'two_state'){

            $('#two_state'+j).click(function (e) { 
                e.preventDefault();
                let state = $('#two_state'+j).val()
                                    let device_ID =$('#twoStatedeviceID'+j).val();
                                    //alert(deviceID)
                                    //if(data =alert(data)
                                    const url = "{{route('updatetwoState')}}";
                                    //alert(url)
                                     $.ajax({
                                    url: url,
                                    type: 'GET',
                                    data:{id:device_ID, state:state},
                                    cache:false,
                                    success: function(response){
                                        
                                    if(response.data=='Turn Device On'){
                                        $('#two_state'+j).val(response.data)
                                        $('#two_state'+j).css('background-color', '#198754');
                                        $('#two_state'+j).css('color', 'white');
                                        
    
                                    }
    
                                    else if(response.data=='Turn Device Off'){
                                        $('#two_state'+j).val(response.data)
                                        $('#two_state'+j).css('background-color', 'red');   
                                    }
                                    
                                    
                                        }
                                    });
                
            });
        } //End of checking if the device is multi state

    //Checking if the device type is a multi_state device type
        if(device_type = 'multi_state'){

                $('#apply_level'+j).click(function (e) { 

                        let device_ID = $('#multiStatedeviceID'+j).val();
                        let level = $('#multiState_level'+j).val();


                        if(level!=='Select Device Level'){
                    const url = "{{route('updateMultiState')}}";
        
                                        $.ajax({
                                        url: url,
                                        type: 'GET',
                                        data:{id:device_ID, state:level},
                                        cache:false,
                                        success: function(response){  
                                        alert(response.data)
                                            }
                                        });
        }//End of Checking if the device type is a multi_state device type
                        
                });
                        
                    }//End of device_type 

                }//ENd of For loop
                }//End of it the device count is greater than one
    });
    </script>
    