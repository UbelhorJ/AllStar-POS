                    <div id="customer_select">
                        <div id="customer" class="input_field">
                            <label for="customer">Customer:</label><br>
                            <input type="text" name="customer_search" id="customer_search" size="40" placeholder="Enter a customer's name, phone#, or e-mail."><br>
                            <select name="customer_results" id="customer_results" size="10">
                                <!-- customer search results go here -->
                            </select>
                            <input type="hidden" name="customerID" id="customerID" value="">
                            
                            <?php
                                if ($vehicleID === "new") {
                                    echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"add_vehicle_customer\"";
                                } else {
                                    "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update_vehicle_customer\"";
                                }
                            ?>
                            
                        </div>
                    </div>