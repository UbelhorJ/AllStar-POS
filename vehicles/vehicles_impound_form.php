                    <div id="impound_info">
                        <div id="impound_reason" class="input_field">
                            <label for="reason">Reason:</label><br>
                            <select name="reason" id="reason">
                                <option value="abandoned">Abandonded</option>
                                <option value="stolen">Stolen</option>
                                <option value="arrest">Arrest</option>
                                <option value="accident">Accident</option>
                                <option value="tow_zone">Tow Zone</option>
                            </select>
                        </div>
                        
                        <div id="by_order_of" class="input_field">
                            <label for="order_of">Order Of:</label></br>
                            <select name="order_of" id="order_of">
                                <option value="property_owner">Property Owner</option>
                                <option value="state_police">State Police</option>
                                <option value="local_police">Local Police</option>
                            </select>
                        </div>
                        
                        <div id="impound_date_time" class="input_field">
                            <label for="date_time">Date & Time</label><br>
                            <input type="datetime-local" name="date_time" id="date_time">
                        </div>
                            
                        <?php
                            if ($vehicleID === "new") {
                                echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"add_vehicle_impound\"";
                            } else {
                                "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update_vehicle_impound\"";
                            }
                        ?>
                            
                        
                    </div>