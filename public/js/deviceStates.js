
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).ready(function(e) {
        $("select.device_type").change(function(e) {

            //Checking the Selected device type
            const device_type = $("#device_type").val();

            //If the selected device is a two state device
            if(device_type =='two_state'){
                let info = '<div class="row col-12">'+
                        '<h6>Device Stages for Two State Devices</h6>'+
                    '<div class="col-md-3 col-lg-3 col-xs-12">'+
                        '<input type="text" name="on" value="On" style="background-color:#f8f9fa; border-color:green" readonly >'+
                    '</div>'+
                    '</br><br/>'+
                    '<div class="col-md-3 col-lg-3 col-xs-12">'+
                        '<input type="text" name="off" value="Off" style="background-color:#f8f9fa; border-color:green" readonly >'+
                    '</div>'+

                    '</div>';
                //$(".disp_state").remove();
                $("#disp_state").html(info);
                
            }
            else if(device_type=='multi_state'){

        const url = "{{route('pages.getDevice')}}";
         //alert(url)
        $.ajax({
       url: url,
       type: 'GET',
       data:{id:device_type},
       cache:false,
       success: function(response){
          /* If the html is rendered */
        if($("#disp_state").html(response.data)){

            $("#add").click(function (e) { 
                e.preventDefault();
                let states = $("#device_states").val();

                /* Checking if the state selected is invalid */
                if(states==""){
                    alert("Kindly select a valid state")
                }
                else{
                    let info ='<div class="col-md-3 col-lg-3 col-xs-3 addedStates">'+
                                    '<input type="text" name="'+states+'" value="'+states+'" style="background-color:#f8f9fa; border-color:green" readonly >'+
                                '</div>'+
                                '</br><br/>'
                    
                    $("#disp_state").append(info);

        //If the clear section button is clicked, reset the device states
                    $("#clear").click(function (e) { 
                        e.preventDefault();
                        $("#disp_state").empty();
                    });
        //If the clear section button is clicked, reset the device states
        
                    
                    
                }

                /* Checking if the state selected is invalid */
                
            });
        }

        /* End of If the html is rendered */

       }
     });


            }
        //End of checking for device state

                   });   
       });
    