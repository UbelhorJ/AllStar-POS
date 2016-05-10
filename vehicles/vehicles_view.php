<?php include 'view/head.php'; ?>
<script src="../javascript/vehicles.js"></script>
</head>

<?php include 'view/header.php'; ?>
    
<?php include 'view/navigation.php'; ?>

<style>
    fieldset {
        display: inline-block;
        padding: 5px;
    }
     
    .vehicle_result_title {
        size: 120%;
        font-weight: bold;
        padding: 2px 5px 2px 5px;
    }
    
    .vehicle_result_info {
        margin-bottom: 5px;
        vertical-align: text-top;
        padding: 5px;
    }
    
    #add_new {
        background-color: #BED7F0;
        padding: 5px;
        margin-bottom: 10px;
        border: 2px solid #1F4E79;
    }
    
    #vehicle_results > div:nth-child(even) {
        background-color: #BED7F0;
    }
    
    label {
        display: inline-block;
        font-weight: bold;
    }
    
    #make_model label {
        width: 55px;
        margin-bottom: 5px;
    }
    
    #registration_info label {
        width: 50px;
    }
    
    #drivetrain_info label {
        width: 60px;
    }
    
    #colors label {
        width: 85px;
    }
     
    fieldset {
        display: inline-block;
        vertical-align: top;
     }
     
    .filter_set {
        height: 100px;
    }
    
    .vehicle_list_set {
        height: 90px;
    }
    
    legend {
        font-weight: 600;
    }
    
    .info_field {
        font-family: "Courier New", Courier, monospace;
    }
</style>
   
    <section>
                                       
        <div class="info_section" id="selection_options">
            <div class="section_header_general">
                <h2>SEARCH AND FILTERS</h2>
            </div>
            <div class="section_body_general">
           
                <form id="vehicle_filters" action="." method="GET">
                    <fieldset id="make_model" class="filter_set">
                        <legend>&nbsp;Make / Model&nbsp;</legend>
                        <label for="year">Year: </label>
                        <input type="text" name="year" id="year" size="4" maxlength="4"><br>
                        <label for="make">Make: </label>
                        <select name="make" id="make">
                            <option value="all">All</option>
                             <?php 
                                foreach ($allVehicleBrands as $brand) {
                                    echo '<option value="' . $brand['brandID'] . '">' . $brand['brandName'] . '</options>';
                                }
                             ?>
                        </select>
                        <br>
                        <label for="model">Model: </label>
                        <select name="model" id="model" disabled>
                            <!-- Models filled in here after selecting Make -->
                        </select>
                    </fieldset>
                    <fieldset id="record_type" class="filter_set">
                        <legend>&nbsp;Record Types&nbsp;</legend>
                        <input type="checkbox" name="customer_vehicles" value="customer_vehicles" id="customer_vehicles" checked> Customer<br>
                        <input type="checkbox" name="forsale_vehicles" value="forsale_vehicles" checked> For Sale<br>
                        <input type="checkbox" name="impound_vehicles" value="impound_vehicles" checked> Impound<br>
                        <input type="checkbox" name="company_vehicles" id="company_vehicles" value="company_vehicles" checked> Company
                    </fieldset>
                    <fieldset id="customer_info" class="filter_set">
                        <legend>&nbsp;Customer Info&nbsp;</legend>
                        <input type="text" name="customer_search" id="customer_search" size="40" placeholder="Enter a customer's name, phone#, or e-mail."><br>
                        <select name="customer_results" id="customer_results" size="4" style="width: 480px;">
                            <!-- customer search results go here -->
                        </select>
                        <input type="hidden" name="customerID" id="customerID" value="">
                    </fieldset>
                    <input type="hidden" name="action" value="filter_vehicles">
                    <input type="submit" name="filter" value=" Filter " style="vertical-align: bottom;">
                </form>
            </div>
        </div>
        <BR>
        <div class="info_section" id="vehicle_list">
            <div class="section_header_general">
                <h2>VEHICLE LIST</h2>
            </div>
            <div class="section_body_general">
                <div id="add_new">
                    <form id="new_vehicle" action="." method="GET">
                        <input type="hidden" name="vehicleID" value="new">
                        <input type="hidden" name="action" value="view_add_edit_form">
                        <label>Add New:</label>
                        <select name="add_new_option" id="add_new_option">
                            <option value="customer">Customer Vehicle</option>
                            <option value="for_sale">For Sale Vehicle</option>
                            <option value="impound">Inpound Vehicle</option>
                            <option value="company">Company Vehicle</option>
                        </select> 
                        <input type="submit" value=" Go ">
                    </form>
                </div>
                <div id="vehicle_results">
                    <?php foreach ($vehicles as $vehicle) : ?>
                        <div id="<?php echo $vehicle->getVehicleID(); ?>">
                            <div class="vehicle_result_title">
                                <span class="twist">▶</span>
                                <?php
                                    echo '[' . $vehicle->getVehicleIDFormatted() . '] ' . $vehicle->getYear() . ' '  . $vehicle->getBrandName() . ' ' . $vehicle->getModelName();
                                ?>
                            </div>
                            <div class="vehicle_result_info hidden">
                                <div class="vehcile_base_info">
                                    <fieldset id="registration_info" class="vehicle_list_set" style="width: 230px; height: 90px;">
                                        <legend>&nbsp;Registration Info</legend>
                                        <label for="VIN">VIN: </label><span class="info_field" id="vin"><?php echo $vehicle->getVIN(); ?></span><br>
                                        <label for="license_plate">Plate: </label><span class="info_field" id="license_plate"><?php echo $vehicle->getPlateState() . ' / ' . $vehicle->getPlateNumber(); ?></span><br>
                                        <label for="title_status">Title: </label><span class="info_field" id="title_status"><?php echo $vehicle->getTitleStatus() ?></span>
                                    </fieldset>
                                    <fieldset id="drivetrain_info" class="vehicle_list_set" style="width: 270px; height: 90px;">
                                        <legend>&nbsp;Drivetrain Info&nbsp;</legend>
                                        <label for="miles">Miles: </label>
                                        <span class="info_field" id="miles"><?php echo $vehicle->getOdometerReading(); ?></span><br>
                                        <label for="engine_type">Engine: </label>
                                        <span class="info_field" id="engine_type"><?php echo $vehicle->getEngineTypeLong() . ' - ' . $vehicle->getFuelTypeLong(); ?></span><br>
                                        <label for="drive_type">Drive: </label>
                                        <span class="info_field" id="drive_type"><?php echo $vehicle->getDriveType(); ?></span><br>
                                        <label for="trans_type">Trans.: </label>
                                        <span class="info_field" id="trans_type"><?php echo $vehicle->getTransmissionTypeLong(); ?></span><br>
                                    </fieldset>
                                    <fieldset id="colors" class="vehicle_list_set" style="width: 160px; height: 90px;">
                                        <legend>&nbsp;Colors&nbsp;</legend>
                                        <label for="ext_color">Ext. Color: </label><span class="info_field" id="ext_color"><?php echo $vehicle->getExteriorColor(); ?></span><br>
                                        <label for="int_color">Int. Color: </label><span class="info_field" id="int_color"><?php echo $vehicle->getInteriorColor(); ?></span><br>
                                    </fieldset>
                                </div> <!-- end vehicle_base_info -->
                                <div class="vehicle_records"></div> <!-- end vehicle_records -->
                            </div> <!-- end vehicle_results_info -->
                        </div> <!-- end vehicle # -->
                    <?php endforeach ?>
                </div> <!-- end vehcile_results -->
            </div>
        </div>
                        
    </section>

<?php include 'view/footer.php' ?>