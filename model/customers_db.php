<?php

// creates a single customer object
    function createCustomer($result) {
        $customer = new customer($result['customerID'], 
                                 $result['firstName'], 
                                 $result['middleInitial'], 
                                 $result['lastName'], 
                                 $result['phoneNumber'], 
                                 $result['emailAddress'],
                                 $result['addressLine1'], 
                                 $result['addressLine2'], 
                                 $result['city'], 
                                 $result['state'], 
                                 $result['zipCode'], 
                                 $result['dateCreated']);
        
        return $customer;    
}

// creates an array of multiple customers
function buildCustomerArray($results) {
    $customerList = array();
    
    foreach($results as $result) {
            $customer = createCustomer($result);
            $customerList[] = $customer;
    }
    
    return $customerList;
}

// Run query that returns a single customer row based on supplied customerID
function getSingleCustomer($customerID) {
    global $db;
  
    $query = "SELECT * FROM customers
              WHERE customerID = :customerID";
    try {          
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        
        $customer = createCustomer($result);      
                                       
        return $customer;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }       
}

// Runs a query that returns customers based on search criterea
function getSelectCustomers($searchTerm) {  
    $searchTerm = trim($searchTerm);
    $searchTerm = strtolower($searchTerm);
    $searchTerm = '%' . $searchTerm . '%'; 
  
    global $db;
  
    $query = "SELECT * FROM customers WHERE 
	            LOWER(firstName) LIKE :searchTerm OR
                LOWER(lastName) LIKE :searchTerm OR
                phoneNumber LIKE :searchTerm OR
                LOWER(emailAddress) LIKE :searchTerm OR
                LOWER(addressLine1) LIKE :searchTerm OR
                LOWER(addressLine2) LIKE :searchTerm OR
                LOWER(city) LIKE :searchTerm OR
	            LOWER(state) LIKE :searchTerm OR
                zipCode LIKE :searchTerm";
                
     try {
        $statement = $db->prepare($query);
        $statement->bindValue(':searchTerm', $searchTerm);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        
        $customerList = buildCustomerArray($results);      
       
        return $customerList;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }            
          
}

// returns formatted customer data for ajax customer search box
function getCustomersForDatalist($searchTerm) {
    $customerJSON = array();
    $results = getSelectCustomers($searchTerm);
    
    foreach ($results as $result) {
        $customer = array();
        $customer['ID'] = $result->getCustomerID(); 
        $customer['info'] = 
            $result->getCustomerIDFormatted() . " " .
            $result->getFullNameFamilyFirst() . " " .
            $result->getPhoneNumberFormatted() . " " .
            $result->getEmailAddress();
        
        $customerJSON[] = $customer;     
    }
    
    echo json_encode($customerJSON, JSON_PRETTY_PRINT);
}

// returns all customers in customers
function getAllCustomers() {
    global $db;

    $query = 'SELECT * FROM customers';

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        
        $customerList = buildCustomerArray($results);
        
        return $customerList;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }
}

// add new customer to database
function addNewCustomer($customerInfo) {
    global $db;

    $query = 'INSERT INTO customers (firstName, middleInitial, lastName, 
                       phoneNumber, emailAddress, 
                       addressLine1, addressLine2, city, state, zipCode, dateCreated)
              VALUES (:firstName, :middleInitial, :lastName, 
                      :phoneNumber, :emailAddress,
                      :addressLine1, :addressLine2, :city, :state, :zipCode, NOW())';
       
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $customerInfo['firstName']);
        $statement->bindValue(':middleInitial', $customerInfo['middleInitial']);
        $statement->bindValue(':lastName', $customerInfo['lastName']);
        $statement->bindValue(':phoneNumber', $customerInfo['phoneNumber']);
        $statement->bindValue(':emailAddress', $customerInfo['emailAddress']);
        $statement->bindValue(':addressLine1', $customerInfo['addressLine1']);
        $statement->bindValue(':addressLine2', $customerInfo['addressLine2']);
        $statement->bindValue(':city', $customerInfo['city']);
        $statement->bindValue(':state', $customerInfo['state']);
        $statement->bindValue(':zipCode', $customerInfo['zipCode']);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

// update an existing customer
function updateCustomer($customerInfo, $customerID) {
    global $db;

    $query = 'UPDATE customers
              SET firstName=:firstName, middleInitial=:middleInitial, lastName=:lastName, 
                  phoneNumber=:phoneNumber, emailAddress=:emailAddress, addressLine1=:addressLine1, 
                  addressline2=:addressLine2, city=:city, state=:state, zipCode=:zipCode
              WHERE customerID = :customerID';
       
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $customerInfo['firstName']);
        $statement->bindValue(':middleInitial', $customerInfo['middleInitial']);
        $statement->bindValue(':lastName', $customerInfo['lastName']);
        $statement->bindValue(':phoneNumber', $customerInfo['phoneNumber']);
        $statement->bindValue(':emailAddress', $customerInfo['emailAddress']);
        $statement->bindValue(':addressLine1', $customerInfo['addressLine1']);
        $statement->bindValue(':addressLine2', $customerInfo['addressLine2']);
        $statement->bindValue(':city', $customerInfo['city']);
        $statement->bindValue(':state', $customerInfo['state']);
        $statement->bindValue(':zipCode', $customerInfo['zipCode']);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

// delete customer record
// !!!!!need to check if customer is attached to any transactions or vehicles first
function deleteCustomer($customerID) {
    global $db;
    
    $query = 'DELETE FROM customers
              WHERE customerID = :customerID';
    
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':customerID', $customerID);
        $statement->execute();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';  
    }
}

// returns the customer with the highest customerID
function getNewestCustomerID() {
    global $db;
    
    $query = 'SELECT * FROM customers
              WHERE customerID IN
	            (SELECT MAX(customerID)
                 FROM customers)';
                 
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $customers = buildCustomerArray($result);
                
        return $customers;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'errors/error_view.php';
    }
}

?>