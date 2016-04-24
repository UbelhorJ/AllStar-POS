$(document).ready(function() {      
    $("#make").change(function() {
       var url = ".?action=getModelsForBrand&brandID=" + $(this).find("option:selected").attr("value");        
        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function(results) {
                 $("#model").empty();
                
                var numberOfModels = results.length - 1;
                
                while (numberOfModels >= 0) {
                    $("#model").append(
                        "<option value=\"" + results[numberOfModels].modelID + "\">" + results[numberOfModels].model + "</option>"
                    );
                    numberOfModels -= 1;
                }
                
                $("#model").removeAttr("disabled");
            } // end success
        }); // end $.ajax
    }); // end $("#make").change
    
    
    $("#customer_search").on('input propertychange paste', function(){
        if ($("#customer_search").val() === "") {
            $("#customer_results").empty();
        } else {
            var url=".?action=getCustomersForDatalist&text=" + $("#customer_search").val();
            
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(results) {                   
                    $("#customer_results").empty();
                    
                    var numberOfCustomers = results.length - 1;

                    while (numberOfCustomers >= 0) {
                        $("#customer_results").append(
                            "<option value=\"" + results[numberOfCustomers].ID + "\">" + results[numberOfCustomers].info + "</option>"
                        );
                        numberOfCustomers -= 1;
                    } // end while
                } // end success
            }); // end ajax   
        } // end if
    }); // end $("#customer_search").on
    
    $("#customer_results").change(function() {
        $("#customerID").attr("value", $("#customer_results").val());
    });
    
    $("#customer_vehicles").change(function() {
        if ($("#customer_vehicles").is(':checked') == false) {
            $("#customer_search").attr("disabled", "disabled");
            $("#customer_results").attr("disabled", "disabled");
        } else {
            $("#customer_search").removeAttr("disabled");
            $("#customer_results").removeAttr("disabled");
        }
    }); // end $("#customer_vehicles").change
    
    $("#save, #update").click(function(){
        $("#add_edit_vehicle").submit();
    });
}); // end ready