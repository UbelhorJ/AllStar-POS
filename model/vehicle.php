<?php
class Vehicle {
    
    private $vehicleID,
            $year,
            $brandID,
            $brandName,
            $modelID,
            $modelName,
            $VIN,
            $odometerReading,
            $plateState,
            $plateNumber,
            $exteriorColor,
            $interiorColor,
            $engineType,
            $driveType,
            $transmissionType,
            $fuelType,
            $titleStatus;

    public function __construct($vehicleID, $year, $brandID, $brandName, $modelID, $modelName, 
                                $VIN, $odometerReading, $plateState, $plateNumber, 
                                $exteriorColor, $interiorColor, $engineType, 
                                $driveType, $transmissionType, $fuelType, $titleStatus) {
        $this->vehicleID = $vehicleID;
        $this->year = $year;
        $this->brandID = $brandID;
        $this->brandName = $brandName;
        $this->modelID = $modelID;
        $this->modelName = $modelName;
        $this->VIN = $VIN;
        $this->odometerReading = $odometerReading;
        $this->plateState = $plateState;
        $this->plateNumber = $plateNumber;
        $this->exteriorColor = $exteriorColor;
        $this->interiorColor = $interiorColor;
        $this->engineType = $engineType;
        $this->driveType = $driveType;
        $this->transmissionType = $transmissionType;
        $this->fuelType = $fuelType;
        $this->titleStatus = $titleStatus;
    }
    
    // vehicleID
    
    public function getvehicleID() {
        return $this->vehicleID;
    }
    
    // year
    
    public function getYear() {
        return $this->year;
    }
    
    public function setYear($value) {
        $this->year = $value;
    }
    
    // brandID
    
    public function getBrandID() {
        return $this->brandID;
    }
    
    public function setBrandID($value) {
        $this->brandID = $value;
    }
    
    // brandName
    
    public function getBrandName() {
        return $this->brandName;
    }
    
    public function setBrandName($value) {
        $this->brandName = $value;
    }
    
    // modelID
    
    public function getModelID() {
        return $this->modelID;
    }
    
    public function setModelID($value) {
        $this->modelID = $value;
    }
    
    // modelName
    
    public function getModelName() {
        return $this->modelName;
    }
    
    public function setModelName($value) {
        $this->modelName = $value;
    }
    
    // VIN
    
    public function getVIN() {
        return $this->VIN;
    }
    
    public function setVIN($value) {
        $this->VIN = $value;
    }    
    
    // odometerReading
    
    public function getOdometerReading() {
        return $this->odometerReading;
    }
    
    public function setOdometerReading($value) {
        $this->odometerReading = $value;
    }  
    
    // plateState
    
    public function getPlateState() {
        return $this->plateState;
    }
    
    public function setPlateState($value) {
        $this->plateState = $value;
    }    
    
    // plateNumber
    
    public function getPlateNumber() {
        return $this->plateNumber;
    }
    
    public function setPlateNumber($value) {
        $this->plateNumber = $value;
    }
    
    // exteriorColor
    
    public function getExteriorColor() {
        return $this->exteriorColor;
    }
    
    public function setExteriorColor($value) {
        $this->exteriorColor = $value;
    }
    
    // interiorColor
    
    public function getInteriorColor() {
        return $this->interiorColor;
    }
    
    public function setInteriorColor($value) {
        $this->interiorColor = $value;
    }  
    
    // engineType
    
    public function getEngineType() {
        return $this->engineType;
    }
    
    public function setEngineType($value) {
        $this->engineType = $value;
    }  
    
    // driveType
    
    public function getDriveType() {
        return $this->driveType;
    }
    
    public function setDriveType($value) {
        $this->driveType = $value;
    }
    
    // transmissionType
    
    public function getTransmissionType() {
        return $this->transmissionType;
    }
    
    public function setTransmissionType($value) {
        $this->transmissionType = $value;
    }  
    
    // fuelType
    
    public function getFuelType() {
        return $this->fuelType;
    }
    
    public function setFuelType($value) {
        $this->fuelType = $value;
    }
    
    // titleStatus
    
    public function getTitleStatus() {
        return $this->titleStatus;
    }
    
    public function setTitleStatus($value) {
        $this->titleStatus = $value;
    }
    
    public function getVehicleIDFormatted() {
        $ID = str_pad($this->vehicleID, 4, '0', STR_PAD_LEFT);
        return $ID;
    }
    
    public function getEngineTypeLong() {
        $engineType = $this->getEngineType();
        
        switch ($engineType) {
            case '3':
                $engineType = '3-Cylinder';
                break;
            case '4';
                $engineType = '4-Cylinder';
                break;
            case '5';
                $engineType = '5-Cylinder';
                break;
            case '6';
                $engineType = '6-Cylinder';
                break;
            case '8';
                $engineType = '8-Cylinder';
                break;
            case 'R';
                $engineType = 'Rotary';
                break;
            case 'E';
                $engineType = 'Electric';
                break;
            case 'O';
                $engineType = 'Other';
                break;
        }
        
        return $engineType;
    }
    
    public function getFuelTypeLong() {
        $fuelType = $this->getFuelType();
        
        switch ($fuelType) {
            case 'G':
                $fuelType = 'Gas';
                break;
            case 'D':
                $fuelType = 'Diesel';
                break;
            case 'H':
                $fuelType = 'Hybrid';
                break;
            case 'E':
                $fuelType = 'Electric';
                break;
            case 'O':
                $fuelType = 'Other';
                break;
        }
        
        return $fuelType;
    }
    
    public function getTransmissionTypeLong() {
        $transType = $this->getTransmissionType();
        
        switch ($transType) {
            case 'A':
                $transType = 'Automatic';
                break;
            case 'M':
                $transType = 'Manual';
                break;
            case 'O':
                $transType = 'Other';
                break;
        }
        
        return $transType;
    }
}
?>