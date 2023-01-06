<script>

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
                    '<input type="text" name="on_state" value="On" style="background-color:#f8f9fa; border-color:green" readonly >'+
                '</div>'+
                '</br><br/>'+
                '<div class="col-md-3 col-lg-3 col-xs-12">'+
                    '<input type="text" name="off_state" value="Off" style="background-color:#f8f9fa; border-color:green" readonly >'+
                '</div>'+

                '</div>';
            //$(".disp_state").remove();
            $("#two_states").removeClass('d-none ');
            $("#two_states").html(info);
            $("#multi_states").addClass('d-none ');
            
        }
        else if(device_type=='multi_state'){
            $("#two_states").addClass('d-none ');
            $("#multi_states").removeClass('d-none ');
            $("#devStatesContainer").append('<div class="devStates" id="devStates"></div>');


        $("#add").click(function (e) { 

            //Checking if the devstates div exists
            if($("#devStates").length){
                
            }
            else{
                $("#devStatesContainer").append('<div class="devStates" id="devStates"></div>');
            }
           // $("#devStatesContainer").append('<div class="devStates" id="devStates"></div>');
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
                
                $("#devStates").append(info);
                

    //If the clear section button is clicked, reset the device states
                $("#clear").click(function (e) { 
                    e.preventDefault();
                    $(".devStates").remove();
                    
                });
    //If the clear section button is clicked, reset the device states
    
                
                
            }

            /* Checking if the state selected is invalid */
            
        });
    

  


        }
    //End of checking for device state

               });   
   });

</script>