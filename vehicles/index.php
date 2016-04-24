<?php
require_once('../util/main.php');
require_once('../model/database.php');
require_once('../model/customer.php');
require_once('../model/customers_db.php');
require_once('../model/vehicle.php');
require_once('../model/vehicles_db.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = 'view_vehicles';
}

switch ($action) {
    case 'view_vehicles':
        $allVehicleBrands = getAllVehicleBrands();     
        include 'vehicles_view.php';
        break;
    case 'getModelsForBrand':
        $brandID = $_GET['brandID'];
        getModelsForBrand($brandID); // returns data to AJAX call
        break;
    case 'getCustomersForDatalist':
        $searchTerm = $_GET['text'];
        getCustomersForDatalist($searchTerm);
        break;
    case 'view_add_edit_form':
        if (isset($_GET['vehicleID'])) {
            $vehicleID = $_GET['vehicleID'];
            // $vehicle = getvehicleobject...
        } else {
            $vehicleID = 'new';
        }
        
        if (isset($_GET['add_new_option'])) {
            $addNewOption = $_GET['add_new_option'];
        }
        
        $allVehicleBrands = getAllVehicleBrands();
        
        include 'vehicles_add_edit_view.php';
        break;
    case 'add_vehicle_customer';
        $recordInfo = $_POST['customerID'];
        $vehicleInfo = setVehicleVariables();
        addVehicleRecord($vehicleInfo, $recordInfo, 'customer');
        header("Location: .?action=view_vehicles");
        break; 
    case 'add_vehicle_sale':
        $recordInfo = setSaleVariables();
        $vehicleInfo = setVehicleVariables();
        addVehicleRecord($vehicleInfo, $recordInfo, 'sale');
        header("Location: .?action=view_vehicles");
        break;
    case 'add_vehicle_impound':
        $recordInfo = setImpoundVariables();
        $vehicleInfo = setVehicleVariables();
        addVehicleRecord($vehicleInfo, $recordInfo, 'impound');
        header("Location: .?action=view_vehicles");
        break;
    case 'add_vehicle_company':
        $recordInfo = $_POST['function'];
        $vehicleInfo = setVehicleVariables();
        addVehicleRecord($vehicleInfo, $recordInfo, 'company');
        header("Location: .?action=view_vehicles");
        break;
}

function setVehicleVariables() {
    $vehicleInfo = array();
    
    $vehicleInfo['year'] = ($_POST['year'] === '') ? NULL : $_POST['year'];
    $vehicleInfo['brandID'] = ($_POST['make'] === '') ? NULL : $_POST['make'];
    $vehicleInfo['modelID'] = ($_POST['model'] === '') ? NULL : $_POST['model'];
    $vehicleInfo['VIN'] = ($_POST['vin'] === '') ? NULL : $_POST['vin'];
    $vehicleInfo['odometerReading'] = ($_POST['odometer'] === '') ? NULL : $_POST['odometer'];
    $vehicleInfo['plateState'] = ($_POST['plate_state'] === '') ? NULL : $_POST['plate_state'];
    $vehicleInfo['plateNumber'] = ($_POST['plate_number'] === '') ? NULL : $_POST['plate_number'];
    $vehicleInfo['exteriorColor'] = ($_POST['ext_color'] === '') ? NULL : $_POST['ext_color'];
    $vehicleInfo['interiorColor'] = ($_POST['int_color'] === '') ? NULL : $_POST['int_color'];
    $vehicleInfo['engineType'] = ($_POST['engine'] === '') ? NULL : $_POST['engine'];
    $vehicleInfo['driveType'] = ($_POST['drive'] === '') ? NULL : $_POST['drive'];
    $vehicleInfo['transmissionType'] = ($_POST['transmission'] === '') ? NULL : $_POST['transmission'];
    $vehicleInfo['fuelType'] = ($_POST['fuel'] === '') ? NULL : $_POST['fuel'];
    $vehicleInfo['titleStatus'] = ($_POST['title'] === '') ? NULL : $_POST['title'];
    
    return $vehicleInfo;
}

function setImpoundVariables() {
    $impoundInfo = array();
    
    $impoundInfo['reason'] = $_POST['reason'];
    $impoundInfo['byOrderOf'] = $_POST['order_of'];
    $impoundInfo['impoundDateTime'] = str_replace('T', ' ', $_POST['date_time']);
    
    return $impoundInfo;
}

function setSaleVariables() {
        $saleInfo = array();
    
        $saleInfo['salePrice'] = $_POST['price'];
        $saleInfo['saleStatus'] = $_POST['status'];
        
        return $saleInfo;
}

?>