                    <div id="sale_info">
                        <div id="sale_price" class="input_field">
                            <label for="price">Sale Price:</label><br>
                            <label>$</label><input type="text" name="price" id="price" size="8">
                        </div>
                        
                        <div id="sale_status" class="input_field">
                            <label for="status">Status</status><br>
                            <select name="status" id="status">
                                <option value="prep">Prep</option>
                                <option value="sale">For Sale</option>
                                <option value="sold">Sold</option>
                            </select>
                        </div>
                            
                        <?php
                            if ($vehicleID === "new") {
                                echo "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"add_vehicle_sale\"";
                            } else {
                                "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update_vehicle_sale\"";
                            }
                        ?>
                            
                        
                    </div>