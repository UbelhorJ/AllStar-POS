<?php
require_once('../util/main.php');
require_once('../model/database.php');
require_once('../model/customer.php');
require_once('../model/customers_db.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} elseif (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = 'view_customers';
}

switch ($action) {
    case 'view_customers':
        $customers = getAllCustomers();      
        include 'customers_view.php';
        break;
    case 'search':
        if (isset($_GET['customer_search'])) {
            $customers = getSelectCustomers($_GET['customer_search']);
        } else {
            $customers = getAllCustomers();
        }
    
        include 'customers_view.php';
        break;
    case 'view_add_edit_form';
        if (isset($_GET['customerID'])) {
            $customerID = $_GET['customerID'];
            $customer = getSingleCustomer($_GET['customerID']);
        } else {
            $customer = 'new';
        }
        
        include ('customers_add_edit_view.php');
        break;
    case 'add_customer':       
        $customerInfo = setCustomerVariables();
        addNewCustomer($customerInfo);
        $customers = getNewestCustomerID();
        include 'customers_view.php';
        break;
    case 'update_customer':
        $customerID = $_POST['customerID'];
        $customerInfo = setCustomerVariables();
        updateCustomer($customerInfo, $customerID);
        $customers = getNewestCustomerID();
        include 'customers_view.php';
        break;
    case 'delete_customer':
        $customerID = $_POST['customerID'];
        deleteCustomer($customerID);
        header('Location: .?action=view_customers');
        break;
}

// collect and format customer info for INSERT or UPDATE statement
function setCustomerVariables() {
    $customerInfo = array();
 
    $customerInfo['firstName'] = ($_POST['firstName'] === '') ? NULL : $_POST['firstName'];   
    $customerInfo['middleInitial'] = ($_POST['middleInitial'] === '') ? NULL : $_POST['middleInitial'];
    $customerInfo['lastName'] = ($_POST['lastName'] === '') ? NULL : $_POST['lastName'];
    $areaCode = $_POST['areaCode'];
    $prefix = $_POST['prefix'];
    $lastFour = $_POST['lastFour'];
    $phoneNumber = $areaCode . $prefix . $lastFour;
    $customerInfo['phoneNumber'] = ($phoneNumber === '') ? NULL : $phoneNumber;
    $customerInfo['emailAddress'] = ($_POST['emailAddress'] === '') ? NULL : $_POST['emailAddress'];
    $customerInfo['addressLine1'] = ($_POST['addressLine1'] === '') ? NULL : $_POST['addressLine1'];
    $customerInfo['addressLine2'] = ($_POST['addressLine2'] === '') ? NULL : $_POST['addressLine2'];
    $customerInfo['city'] = ($_POST['city'] === '') ? NULL : $_POST['city'];
    $customerInfo['state'] = ($_POST['state'] === '') ? NULL : $_POST['state'];
    $customerInfo['zipCode'] = ($_POST['zipCode'] === '') ? NULL : $_POST['zipCode'];
   
    return $customerInfo;
}

?>