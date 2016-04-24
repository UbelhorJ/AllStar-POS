                    <div id="customer_select">
                        <div id="vehicle_function" class="input_field">
                            <label for="function">Function:</label><br>
                            <input type="text" name="function" id="function" length="128" maxlength="64">
                            
                            <?php
                                if ($vehicleID === "new") {
                                    echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"add_vehicle_company\"";
                                } else {
                                    "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update_vehicle_company\"";
                                }
                            ?>
                            
                        </div>
                    </div>