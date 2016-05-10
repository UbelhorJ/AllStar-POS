// get list of vehicle modes for the selected brand
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
    }); // end change
    
    // get list of customers matching search field    
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
    }); // end on

    // sets value of hidden customer ID field to that of customer selected in search results
    $("#customer_results").change(function() {
        $("#customerID").attr("value", $("#customer_results").val());
    });
    
    // enables or disables customer search functionality based on "customer" checkbox
    $("#customer_vehicles").change(function() {
        if ($("#customer_vehicles").is(':checked') == false) {
            $("#customer_search").attr("disabled", "disabled");
            $("#customer_results").attr("disabled", "disabled");
        } else {
            $("#customer_search").removeAttr("disabled");
            $("#customer_results").removeAttr("disabled");
        }
    }); // end change
    
    $("#save, #update").click(function(){
        $("#add_edit_vehicle").submit();
    });
    
    // expands vehicle info section to display more details
    // searches for vehicle records and adds them to details
    $(".vehicle_result_title").click(function() {
        $(this).next().toggleClass("hidden");
        
        if ($(this).find(":first-child").text() === "▶") {
            $(this).find(":first-child").text("🔻");
        } else {
            $(this).find(":first-child").text("▶");
        }
       
  
        if ($(this).next().find("div.vehicle_records").is(":empty")) {
            var vehicleID = $(this).parent().attr("id");
            var url = ".?action=getVehicleRecords&vehicleID=" + vehicleID;
           
            $.ajax({
                type: "get",
                url: url,
                dataType: "json",
                success: function(results) {                   
                    
                    console.log(results);
                    
                    // insert customer record if exists                                
                    if (typeof results.customer.customerID != "undefined") {
                        var vehicleID = "#" + results.customer.vehicleID;
                        var customerID = results.customer.customerID;
                        var customerURL = "../customers?customerID=" + customerID + "&action=view_add_edit_form";
                        var customerName = results.customer.customerName;
                        var customerEmail = "";
                        if (results.customer.emailAddress != null) {
                            customerEmail = results.customer.emailAddress;
                        }
                        var customerPhone = "";
                        if (results.customer.areaCode != null) {
                            customerPhone = "(" + results.customer.areaCode + ") " +
                                            results.customer.prefix + "-" +
                                            results.customer.lineNumber;
                        }
                        
                        $(vehicleID).find("div.vehicle_records").append(
                            "<fieldset id=\"customer_record\" style=\"width: 705px;\">" + 
                            "<legend>&nbsp;Customer Record&nbsp</legend>" +
                            "<a href=\"" + customerURL + "\">" +
                            "[" + customerID + "] " + customerName + " " + customerPhone + " " + customerEmail +
                            "</a>" +
                            "</fieldset>"
                        ); // end append
                    } // end customer record
                    
                    // insert sale record if exists
                    if (typeof results.sale.saleID != "undefined") {
                        var vehicleID = "#" + results.sale.vehicleID;
                        var salePrice = results.sale.salePrice;
                        var status = results.sale.status;
                        $(vehicleID).find("div.vehicle_records").append(
                            "<fieldset id=\"sale_record\" style=\"width: 705px;\">" + 
                            "<legend>&nbsp;Sale Record&nbsp</legend>" +
                            "Price: $" + salePrice + "<br>" + "Status: " + status + 
                            "</fieldset>"
                        ); // end append
                    } // end sale record
                    
                    if (typeof results.impound.impoundID != "undefined") {
                        var vehicleID = "#" + results.impound.vehicleID;
                        var byOrderOf = results.impound.byOrderOf;
                        var reason = results.impound.reason;
                        var impoundDate = new Date(results.impound.impoundDate);
                        var options = {
                            weekday: "short", month: "2-digit", day: "2-digit",  
                            year: "numeric", hour: "2-digit", minute: "2-digit",
                            hour12: "true", timeZone: "America/Los_Angeles"
                        }
                        var impoundDateString = impoundDate.toLocaleDateString("en-US", options);

                        $(vehicleID).find("div.vehicle_records").append(
                            "<fieldset id=\"sale_record\" style=\"width: 705px;\">" + 
                            "<legend>&nbsp;Sale Record&nbsp</legend>" +
                            "By Order Of: " + byOrderOf + "<br>" +
                            "Reason: " + reason + "<br>" +
                            "Date & Time: " + impoundDateString +
                            "</fieldset>"
                        ); // end append
                    } // end sale record
                    
                    // insert company vehicle record if exists
                    if (typeof results.sale.saleID != "undefined") {
                        var vehicleID = "#" + results.sale.vehicleID;
                        var salePrice = results.sale.salePrice;
                        var status = results.sale.status;
                        $(vehicleID).find("div.vehicle_records").append(
                            "<fieldset id=\"sale_record\" style=\"width: 705px;\">" + 
                            "<legend>&nbsp;Sale Record&nbsp</legend>" +
                            "Price: $" + salePrice + "<br>" + "Status: " + status + 
                            "</fieldset>"
                        ); // end append
                    } // end sale record
                    
                    if (typeof results.company.companyVehicleID != "undefined") {
                        var vehicleID = "#" + results.company.vehicleID;
                        alert("asdf");
                        $(vehicleID).find("div.vehicle_records").append(
                            "<fieldset id=\"sale_record\" style=\"width: 705px;\">" + 
                            "<legend>&nbsp;Sale Record&nbsp</legend>" +
                            "yup" +
                            "</fieldset>"
                        ); // end append
                    } // end company vehicle
                    
                } //end seccess
            }); //end ajax
        } // end if 
    }); // end click
    
}); // end ready