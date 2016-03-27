<?php
class Customer {
    
    private $customerID, 
            $firstName, 
            $middleInitial, 
            $lastName, 
            $phoneNumber, 
            $emailAddress, 
            $addressLine1, 
            $addressLine2, 
            $city, 
            $state, 
            $zipCode, 
            $dateCreated;
    
    public function __construct($customerID, $firstName, $middleInitial, $lastName,
                                $phoneNumber, $emailAddress, $addressLine1, 
                                $addressLine2, $city, $state, $zipCode, $dateCreated) {
        $this->customerID = $customerID;
        $this->firstName = $firstName;
        $this->middleInitial  = $middleInitial;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->emailAddress = $emailAddress;
        $this->addressLine1 = $addressLine1;
        $this->addressLine2 = $addressLine2;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->dateCreated = $dateCreated;
    }
    
    // customerID 
    
    public function getCustomerID() {
        return $this->customerID;
    }

    // firstName 
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function setFirstName($value) {
        $this->firstName = $value;
    }
    
    // middleInitial 
    
    public function getMiddleInitial() {
        return $this->middleInitial;
    }
    
    public function setMiddleInitial($value) {
        $this->middleInitial = $value;
    }
    
    // lastName 
    
        public function getLastName() {
        return $this->lastName;
    }
    
    public function setLastName($value) {
        $this->lastName = $value;
    }
    
    // phoneNumber 
    
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    
    public function setPhoneNumber($value) {
        $this->phoneNumber = $value;
    }
    
    // emailAddress 
    
    public function getEmailAddress() {
        return $this->emailAddress;
    }
    
    public function setEmailAddress($value) {
        $this->emailAddress = $value;
    }
    
    // addressLine1 
    
    public function getAddressLine1() {
        return $this->addressLine1;
    }
    
    public function setAddressLine1($value) {
        $this->addressLine1 = $value;
    }

    // addressLine2 

    public function getAddressLine2() {
        return $this->addressLine2;
    }
    
    public function setAddressLine2($value) {
        $this->addressLine2 = $value;
    }
    
    // city 
    
    public function getCity() {
        return $this->city;
    }
    
    public function setCity($value) {
        $this->city = $value;
    }
    
    // state 
    
    public function getState() {
        return $this->state;
    }
    
    public function setState($value) {
        $this->state = $value;
    }

    // zipcode 

    public function getZipCode() {
        return $this->zipCode;
    }
    
    public function setZipCode($value) {
        $this->zipCode = $value;
    }
    
    // dateCreated
    
    public function getDateCreated() {
        return $this->dateCreated;
    }
    
    public function getFullName() {
        // combine firstName, middleInitial, and lastName into a single string
         $fullName = $this->firstName .= ' ';
    
        if (!is_null($this->middleInitial)) {
            $fullName .= $this->middleInitial .= ' ';
        }
    
        $fullName .= $this->lastName;
    
        return $fullName;
    }
    
    public function getFullNameFamilyFirst() {
        // combine name into Last, First M format
        $fullName = $this->lastName . ', ' . $this->firstName;
        
        if (!is_null($this->middleInitial)) {
            $fullName .= ' ' . $this->middleInitial;
        }
        
        return $fullName;
        
    }

    public function getDateCreatedFormatted() {
        // returns dateCreated in MM/DD/YYYY format
        $dateCreatedFormatted = new DateTime($this->dateCreated);
        $dateCreatedFormatted = $dateCreatedFormatted->format('m/d/Y');
        
        return $dateCreatedFormatted;
    }
    
    public function getPhoneNumberFormatted() {
        // format phone number into (123) 456-7890 format.
        $formattedPhoneNumber = '(' . substr($this->phoneNumber, 0, 3) . ') ' .  substr($this->phoneNumber, 3, 3) . '-' . substr($this->phoneNumber, 6, 4);
        return $formattedPhoneNumber;
    }
    
    public function getPhoneNumberSplit() {
        $phoneNumberSplit = array('areaCode' => substr($this->phoneNumber, 0, 3),
                                  'prefix' => substr($this->phoneNumber, 3, 3),
                                  'lastFour' => substr($this->phoneNumber, 6, 4));
                                  
        return $phoneNumberSplit;
    }
    
    public function getCustomerIDFormatted() {
        $formattedCustomerID = str_pad($this->customerID, 4, '0', STR_PAD_LEFT);
        return $formattedCustomerID;
    }
    
    public function getAddressFormatted() {
        $formattedAddress = '';
        
        if (!is_null($this->addressLine1)) {
            $formattedAddress .= $this->addressLine1 . '<br>';
        }
        if (!is_null($this->addressLine2)) {
            $formattedAddress .= $this->addressLine2 . '<br>';
        }
        if (!is_null($this->city)) {
            $formattedAddress .= $this->city;
        } 
        if (!is_null($this->city) || !is_null($this->state)) {
            $formattedAddress .= ', ';
        }
        if (!is_null($this->state)) {
            $formattedAddress .= $this->state . ' ';
        }
        if (!is_null($this->zipCode)) {
            $formattedAddress .= $this->zipCode;   
        }
        
        return $formattedAddress;
    }
}
?>