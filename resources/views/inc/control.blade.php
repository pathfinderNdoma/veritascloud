<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');	

/* ************************************** Function to show if there is just one device in the database *************** */
$(document).ready(function () {

/* ****************************** If it is a two State Device *************** */
                    $("#two_state").click(function (e) { 
                                e.preventDefault();
                                let state = $('#two_state').val()
                                let deviceID =$('#deviceID_two').val();
                                alert(deviceID)
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
$("#two_state").click(function (e) { 
    e.preventDefault();
    
    
});
/* ****************************** If it is a MultiState Device *************** */
    
    
}); //END OF DOCUMENT READY FUNCTION 
/* ************************************** Function to show if there is just one device in the database *************** */

</script>
