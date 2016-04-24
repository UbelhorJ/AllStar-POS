<?php include 'view/head.php'; ?>
<script src="../javascript/vehicles.js"></script>
</head>

<?php include 'view/header.php'; ?>
    
<?php include 'view/navigation.php'; ?>

<style>
     .input_field {
         display: inline-block;
         margin: 5px;
     }
     
     #customer_results {
        width: 500px;
    }
    
    label {
        font-size: 75%;
    }
</style>
   
    <section>
           
        <div class="info_section">
            <div class="section_header_general">
                <h2>VEHICLE INFO</h2>
            </div>
            <div class="section_body_general">
                
                <form name="add_edit_vehicle" id="add_edit_vehicle" action="." method="POST">
                    
                    <div id="year_make_model_title">
                        <div id="year" class="input_field">
                            <label for="year">Year:</label><br>
                            <input type="text" name="year" id="year" size="4" maxlength="4">
                        </div>
                        
                        <div id="makes" class="input_field">
                            <label for="make">Make: </label><br>
                            <select name="make" id="make">
                                <option value="all">All</option>
                                <?php 
                                    foreach ($allVehicleBrands as $brand) {
                                        echo '<option value="' . $brand['brandID'] . '">' . $brand['brandName'] . '</options>';
                                    }
                                ?>
                            </select>
                        </div>
                        
                        <div id="models" class="input_field">
                            <label for="model">Model: </label><br>
                            <select name="model" id="model" disabled>
                                <!-- Models filled in here after selecting Make -->
                            </select>
                        </div>
                        
                        <div id="title" class="input_field">
                            <label for="title">Title:</label><br>
                            <select name="title" id="title">
                                <option value="clean">Clean</option>
                                <option value="Salvage">Salvage</option>
                                <option value="Rebuilt">Rebuilt</option>
                                <option value="Parts Only">Parts Only</option>
                                <option value="Lien">Lien</option>
                                <option value="Missing">Missing</option>
                            </select>
                        </div>                        
                    </div> <!-- end year_make_model_title -->
                    
                    <div id="vin_plate">
                        <div id="vin" class="input_field">
                            <label for="vin">VIN:</label><br>
                            <input type="text" name="vin" id="vin" size="17" maxlength="17">
                        </div>
                        
                        <div id="plate" class="input_field">
                            <label for="plate">License Plate:</label><br>
                            <select name="plate_state" id="plate_state">
                                <option value=""></option>
                                <option value="OR">OR</option>
                                <option value="WA">WA</option>
                                <option value="ID">ID</option>
                                <option value="CA">CA</option>
                            </select>
                            <input type="text" name="plate_number" id="plate_number" size="7" maxlength="7">
                        </div>
                    </div> <!-- end vin_plate -->
                    
                    <div id="drivetrain">
                        <div id="engine" class="input_field">
                            <label for="engine">Engine:</label><br>
                            <select name="engine" id="engine">
                                <option value="3">3-Cylinder</option>
                                <option value="4">4-Cylinder</option>
                                <option value="5">5-Cylinder</option>
                                <option value="6">6-Cylinder</option>
                                <option value="8">8-Cylinder</option>
                                <option value="R">Rotary</option>
                                <option value="E">Electric</option>
                                <option value="O">Other</option>
                            </select>
                        </div>
                        
                        <div id="drive_type" class="input_field">
                            <label for="drive">Drive:</label><br>
                            <select name="drive" id="drive">
                                <option value="FF">FF</option>
                                <option value="FR">FR</option>
                                <option value="RR">RR</option>
                                <option value="MR">MR</option>
                                <option value="AWD">AWD</option>
                                <option value="4WD">4WD</option>
                            </select>
                        </div>
                        
                        <div id="transmission" class="input_field">
                            <label for="transmission">Transmission:</label><br>
                            <select name="transmission" id="transmission">
                                <option value="A">Automatic</option>
                                <option value="M">Manual</option>
                                <option value="O">Other</option>
                            </select>
                        </div>
                        
                        <div id="fuel" class="input_field">
                            <label for="fuel">Fuel:</label><br>
                            <select name="fuel" id="fuel">
                                <option value="G">Gas</option>
                                <option value="D">Diesel</option>
                                <option value="H">Hybrid</option>
                                <option value="E">Electric</option>
                                <option value="O">Other</option>
                            </select>
                        </div>
                    </div> <!-- end drivetrain -->
                    
                    <div id="color_miles">
                        <div id="ext_color" class="input_field">
                            <label for="ext_color">Ext. Color:</label><br>
                            <select name="ext_color" id="ext_color">
                                <option value="black">black</option>
                                <option value="blue">blue</option>
                                <option value="green">green</option>
                                <option value="gray">gray</option>
                                <option value="orange">orange</option>
                                <option value="purple">purple</option>
                                <option value="red">red</option>
                                <option value="silver">silver</option>
                                <option value="white">white</option>
                                <option value="yellow">yellow</option>
                                <option value="brown">brown</option>
                                <option value="other">other</option>
                            </select>
                        </div>
                        
                        <div id="int_color" class="input_field">
                            <label for="int_color">Int. Color:</label><br>
                            <select name="int_color" id="int_color">
                                <option value="black">black</option>
                                <option value="gray">gray</option>
                                <option value="white">white</option>
                                <option value="tan">tan</option>
                                <option value="brown">brown</option>
                                <option value="red">red</option>
                                <option value="blue">blue</option>
                                <option value="green">green</option>
                                <option value="other">other</option>
                            </select>
                        </div>    
                        
                        <div id="odometer" class="input_field">
                            <label for="odometer">Odometer:</label><br>
                            <input type="text" name="odometer" id="odometer" length="6" maxlength="6">
                        </div>     
                    </div> <!-- end color_miles_title -->
                          
                    <?php
                        switch ($addNewOption) {
                            case 'customer';
                            include 'vehicles_customer_form.php';
                                break;
                            case 'for_sale':
                                include 'vehicles_for_sale_form.php';
                                break;
                            case 'impound':
                                include 'vehicles_impound_form.php';
                                break;
                            case 'company':
                                include 'vehicles_company_form.php';
                                break;
                        }                       
                    ?>
                    
                    <div id="save_update">
                        <div id="save_update_button" class="input_field">
                            <?php
                                if ($vehicleID === "new") {
                                    echo "<input type=\"button\" name=\"save\" id=\"save\" value=\"&nbsp;Save&nbsp;\"";
                                } else {
                                    "<input type=\"button\" name=\"update\" id=\"update\" value=\"&nbsp;Update&nbsp;\"";
                                }
                            ?>
                        </div>
                    </div>
                                                            
                </form>
                
            </div>
        </div>
        
        
    </section>

<?php include 'view/footer.php' ?>