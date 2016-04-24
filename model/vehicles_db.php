<?php
function getAllVehicleBrands() {
    global $db;
  
    $query = "SELECT * FROM vehicles_brands";
    
    try {          
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();  
                                       
        return $results;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }       
}

function getModelsForBrand($brandID) {
    global $db;
  
    $query = "SELECT modelID, model
              FROM vehicles_models
              WHERE brandID = :brandID
              ORDER BY modeL DESC";
    
    try {          
        $statement = $db->prepare($query);
        $statement->bindValue(':brandID', $brandID);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();  
              
        echo json_encode($results, JSON_PRETTY_PRINT);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }   
}

function addVehicleBaseRecord($vehicleInfo) {
    global $db;
  
    $query = "INSERT INTO vehicles_base
                 (year, brandID, modelID, VIN, odometerReading, plateState, 
                  plateNumber, exteriorColor, interiorColor, engineType, 
                  driveType, transmissionType, fuelType, titleStatus)
              VALUES
                 (:year, :brandID, :modelID, :VIN, :odometerReading, :plateState, 
                  :plateNumber, :exteriorColor, :interiorColor, :engineType, 
                  :driveType, :transmissionType, :fuelType, :titleStatus)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':year', $vehicleInfo['year']);
        $statement->bindValue(':brandID', $vehicleInfo['brandID']);
        $statement->bindValue(':modelID', $vehicleInfo['modelID']);
        $statement->bindValue(':VIN', $vehicleInfo['VIN']);
        $statement->bindValue(':odometerReading', $vehicleInfo['odometerReading']);
        $statement->bindValue(':plateState', $vehicleInfo['plateState']);
        $statement->bindValue(':plateNumber', $vehicleInfo['plateNumber']);
        $statement->bindValue(':exteriorColor', $vehicleInfo['exteriorColor']);
        $statement->bindValue(':interiorColor', $vehicleInfo['interiorColor']);
        $statement->bindValue(':engineType', $vehicleInfo['engineType']);
        $statement->bindValue(':driveType', $vehicleInfo['driveType']);
        $statement->bindValue(':transmissionType', $vehicleInfo['transmissionType']);
        $statement->bindValue(':fuelType', $vehicleInfo['fuelType']);
        $statement->bindValue(':titleStatus', $vehicleInfo['titleStatus']);
        $statement->execute();
        $vehicleID = $db->lastInsertID();
        return $vehicleID;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

function addVehicleCustomer($vehicleID, $recordInfo) {
    global $db;
  
    $query = "INSERT INTO vehicles_customers
                 (vehicleID, customerID)
              VALUES
                 (:vehicleID, :customerID)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':vehicleID', $vehicleID);
        $statement->bindValue(':customerID', $recordInfo);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

function addVehicleSales($vehicleID, $recordInfo) {
    global $db;
  
    $query = "INSERT INTO vehicles_sales
                 (vehicleID, salePrice, status)
              VALUES
                 (:vehicleID, :salePrice, :saleStatus)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':vehicleID', $vehicleID);
        $statement->bindValue(':salePrice', $recordInfo['salePrice']);
        $statement->bindValue(':saleStatus', $recordInfo['saleStatus']);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

function addVehicleImpound($vehicleID, $recordInfo) {
    global $db;
  
    $query = "INSERT INTO vehicles_impound
                  (vehicleID, reason, byOrderOf, impoundDate)
              VALUES
                  (:vehicleID, :reason, :byOrderOf, :impoundDate)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':vehicleID', $vehicleID);
        $statement->bindValue(':reason', $recordInfo['reason']);
        $statement->bindValue(':byOrderOf', $recordInfo['byOrderOf']);
        $statement->bindValue(':impoundDate', $recordInfo['impoundDateTime']);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

function addVehicleCompany($vehicleID, $recordInfo) {
    global $db;
    
    $query = "INSERT INTO vehicles_company
                  (vehicleID, function)
              VALUES
                  (:vehicleID, :function)";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":vehicleID", $vehicleID);
        $statement->bindValue(":function", $recordInfo);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }
}

function addVehicleRecord($vehicleInfo, $recordInfo, $recordType) {
    $vehicleID = addVehicleBaseRecord($vehicleInfo);
    
    switch ($recordType) {
        case 'customer':
            addVehicleCustomer($vehicleID, $recordInfo);
            break;
        case 'sale':
            addVehicleSales($vehicleID, $recordInfo);
            break;
        case 'impound':
            addVehicleImpound($vehicleID, $recordInfo);
            break;
        case 'company':
            addVehicleCompany($vehicleID, $recordInfo);
            break;
    }
}
?>