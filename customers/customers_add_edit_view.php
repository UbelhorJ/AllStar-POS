<?php include 'view/head.php'; ?>
    <script src="../javascript/customers_add_edit.js"></script>
    <script src="../javascript/validation.js"></script>
</head>

<?php include 'view/header.php'; ?>

<?php include 'view/navigation.php'; ?>

<style>
    table, tr, td {
        padding: 2px;
        margin: 2px;
    }
</style>

    <section>      
       <div class="info_section hidden" id="error_section">
            <div class="section_header_error">
                <h2>ERROR</h2>
            </div>
            <div class="section_body_error" id="section_body_error">
                <p>This is the error message text.</p>
            </div>
        </div>
        <br>
        <div class="info_section">
            <div class="section_header_general">
                <h2>CUSTOMER INFORMATION</h2>
            </div>
            <div class="section_body_general">
                <br>
                <form name="add_edit_customer" id="add_edit_customer" action="." method="POST">
                    <fieldset>
                        <legend>&nbsp;Customer Name&nbsp;</legend>
                        <table id="customer_name">
                            <tr>
                                <td>First Name:</td>
                                <td>M.</td>
                                <td>Last Name:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="firstName" id="firstName" size="50" maxlength="64" <?php if ($customer != 'new') echo 'value="' . $customer->getFirstName() . '"'; ?>></td>
                                <td><input type="text" name="middleInitial" id="middleInitial" size="3" maxlength="3" <?php if ($customer != 'new') echo 'value="' . $customer->getMiddleInitial() . '"'; ?>></td>
                                <td><input type="text" name="lastName" id="lastName" size="50" maxlength="64" <?php if ($customer != 'new') echo 'value="' . $customer->getLastName() . '"'; ?>></td>
                            </tr>
                        </table>                                
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>&nbsp;Contact Info&nbsp;</legend>
                        <table id="customer_contact_info">
                            <tr>
                                <td>Phone Number:</td>
                                <td>E-Mail Address:</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php $phone = $customer->getPhoneNumberSplit(); ?>
                                    (<input type="text" name="areaCode" id="areaCode" size="3" maxlength="3" <?php if ($customer != 'new') echo 'value="' . $phone['areaCode'] . '"'; ?>>)
                                    <input type="text" name="prefix" id="prefix" size="3" maxlength="3" <?php if ($customer != 'new') echo 'value="' . $phone['prefix'] . '"'; ?>>&nbsp;-
                                    <input type="text" name="lastFour" id="lastFour" size="4" maxlength="4" <?php if ($customer != 'new') echo 'value="' . $phone['lastFour'] . '"'; ?>>
                                </td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size="50" maxlength="64" <?php if ($customer != 'new') echo 'value="' . $customer->getEmailAddress() . '"'; ?>></td>
                            </tr>
                         </table>
                    </fieldset>
                    <br>
                    <fieldset>
                        <legend>&nbsp;Address&nbsp;</legend>
                        <table>
                            <tr>
                                <td colspan="3">Street:</td>
                            </tr>
                            <tr>
                                <td colspan="3"><input type="text" name="addressLine1" id="addressLine1" size="50" maxlength="64" <?php if ($customer != 'new') echo 'value="' . $customer->getAddressLine1() . '"'; ?>>
                            </tr>
                            <tr>
                                <td colspan="3">Line 2:</td>
                            </tr>
                            <tr>
                                <td colspan="3"><input type="text" name="addressLine2" id="addressLine2" size="50" maxlength="64" <?php if ($customer != 'new') echo 'value="' . $customer->getAddressLine2() . '"'; ?>>
                            </tr>
                            <tr>
                                <td>City:</td>
                                <td>State:</td>
                                <td>Zip Code:</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="city" id="city" size="50" maxlength="64" <?php if ($customer != 'new') echo 'value="' . $customer->getCity() . '"'; ?>></td>
                                <td>
                                    <select name="state">
                                        <option value="">&nbsp;</option>
                                        <option value="OR" <?php if ($customer != 'new' && $customer->GetState() === 'OR') echo 'selected';?>>Oregon</option>
                                        <option value="WA" <?php if ($customer != 'new' && $customer->GetState() === 'WA') echo 'selected';?>>Washington</option>
                                        <option value="CA" <?php if ($customer != 'new' && $customer->GetState() === 'CA') echo 'selected';?>>California</option>
                                        <option value="ID" <?php if ($customer != 'new' && $customer->GetState() === 'ID') echo 'selected';?>>Idaho</option>
                                    </select>
                                </td>
                                <td><input type="text" name="zipCode" id="zipCode" size="5" maxlength="5" <?php if ($customer != 'new') echo 'value="' . $customer->getZipCode() . '"'; ?>></td>
                            </tr>
                        </table>
                    </fieldset> 
                    <br>
                    <div style="float: right;">
                        <?php 
                        if ($customerID === 'new') {
                            echo "<input type=\"hidden\" name=\"action\" value=\"add_customer\"> \n";
                            echo "<input type=\"button\" id=\"save_new_customer\" value=\" Save New Customer \">";
                        } else {
                            echo "<input type=\"hidden\" name=\"action\" value=\"update_customer\"> \n";
                            echo "<input type=\"hidden\" name=\"customerID\" value=\"" . $customerID . "\"> \n";
                            echo "<input type=\"button\" id=\"save_changes\" value=\" Save Changes \">";
                        }                 
                        ?>
                    </div>      
                </form>
            </div>
        </div>
        
        
    </section>

<?php include 'view/footer.php' ?>