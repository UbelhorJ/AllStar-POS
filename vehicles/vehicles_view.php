<?php include 'view/head.php'; ?>
<script src="../javascript/vehicles.js"></script>
</head>

<?php include 'view/header.php'; ?>
    
<?php include 'view/navigation.php'; ?>

<style>
    fieldset {
        display: inline-block;
    }
    
    #customer_results {
        width: 500px;
    }
</style>
   
    <section>
                                       
        <div class="info_section" id="selection_options">
            <div class="section_header_general">
                <h2>SEARCH AND FILTERS</h2>
            </div>
            <div class="section_body_general">
           
                <form id="vehicle_filters" action="." method="GET">
                    <fieldset>
                        <legend>&nbsp;Make / Model&nbsp;</legend>
                        <label for="year">Year: </label><input type="text" name="year" id="year" size="4" maxlength="4"><br>
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
                    <fieldset>
                        <legend>&nbsp;Record Types&nbsp;</legend>
                        <input type="checkbox" name="customer_vehicles" value="customer_vehicles" id="customer_vehicles" checked> Customer<br>
                        <input type="checkbox" name="forsale_vehicles" value="forsale_vehicles" checked> For Sale<br>
                        <input type="checkbox" name="impound_vehicles" value="impound_vehicles" checked> Impound<br>
                        <input type="checkbox" name="company_vehicles" id="company_vehicles" value="company_vehicles" checked> Company
                    </fieldset>
                    <fieldset>
                        <legend>&nbsp;Customer Info&nbsp;</legend>
                        <input type="text" name="customer_search" id="customer_search" size="40" placeholder="Enter a customer's name, phone#, or e-mail."><br>
                        <select name="customer_results" id="customer_results" size="4">
                            <!-- customer search results go here -->
                        </select>
                        <input type="hidden" name="customerID" id="customerID" value="">
                    </fieldset>
                    <input type="hidden" name="action" value="filter_vehicles">
                    <input type="submit" name="filter" value=" Filter ">
                </form>
            </div>
        </div>
        <BR>
        <div class="info_section">
            <div class="section_header_general">
                <h2>VEHICLE LIST</h2>
            </div>
            <div class="section_body_general">
                <form id="new_vehicle" action="." method="GET">
                    <input type="hidden" name="vehicleID" value="new">
                    <input type="hidden" name="action" value="view_add_edit_form">
                    Add New:
                    <select name="add_new_option" id="add_new_option">
                        <option value="customer">Customer Vehicle</option>
                        <option value="for_sale">For Sale Vehicle</option>
                        <option value="impound">Inpound Vehicle</option>
                        <option value="company">Company Vehicle</option>
                    </select> 
                    <input type="submit" value=" Go ">
                </form>
                $RESULTS
            </div>
        </div>
                        
    </section>

<?php include 'view/footer.php' ?>