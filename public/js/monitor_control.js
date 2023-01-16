<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');	

/* ************************************** Function to show if there is just one device in the database *************** */
$(document).ready(function () {

/* ****************************** If it is a two State Device *************** */
                            $("#two_state").click(function (e) { 
                                e.preventDefault();
                                const url = "{{route('updateState')}}";
                                alert(url)
                                 $.ajax({
                                url: url,
                                type: 'GET',
                                data:{id:1},
                                cache:false,
                                success: function(response){
                                        alert('yes')
                                    alert(response.data)
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
