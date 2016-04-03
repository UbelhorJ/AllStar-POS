$(document).ready(function() {      
    $("#save_new_customer").click(function() {
        var firstName = $("#firstName").val();
        //var middleInitial = $("#middleInitial").val();
        var lastName = $("#lastName").val();
        //var areaCode = $("#areaCode").val();
        //var prefix = $("#prefix").val();
        //var lastFour = $("#lastFour").val();
        //var phoneNumber = areaCode + prefix + lastFour;
        //var emailAddress = $("#emailAddress").val();
        //var addressLine1 = $("#addressLine1").val();
        //var addressLine2 = $("#addressLine2").val();
        //var city = $("#city").val();
        //var state = $("#state").val();
        //var zipCode = $("#zipCode").val();
        var validated = true;
        var errorMessage = "";       
               
        if (lastName === "") {
            errorMessage += "You must enter a last name.<br>";
            $("#lastName").addClass("input_error");
            $("#lastName").focus();
            validated = false;
        }
        
        if (firstName === "") {
            errorMessage += "You must enter a first name.<br>";
            $("#firstName").addClass("input_error");
            $("#firstName").focus();
            validated = false;
        }
        
        if (validated) {
            $("#add_edit_customer").submit();
        } else {
            if ($("#error_section").css("display") === "none") {
                $("#error_section").slideToggle("fast", "swing");   
            }
            
            $("#section_body_error p").html(errorMessage); 
        }
        
    }); // end save_new_customer or save_changes click
}); //end ready