<?php include 'view/header.php'; ?>
<?php include 'view/navigation.php'; ?>
   
    <section>
        
        <div class="info_section">
            <div class="section_header_alert">
                <h2>Alert</h2>
            </div>
            <div class="section_body_alert">
                <p>This program is for demonstration purposes only. Do not use in a production environment. Do not use to store real customer information!</p>
            </div>
        </div>
        
        <br>
        <br>
        
        <div class="info_section">
            <div class="section_header_error">
                <h2>ERROR</h2>
            </div>
            <div class="section_body_error">
                <p>This is the error message text.</p>
            </div>
        </div>
                
        <br>
        <br>
        
        <div class="info_section">
            <div class="section_header_general">
                <h2>GENERAL INFORMATION</h2>
            </div>
            <div class="section_body_general">
                <p>
                   <?php
                    echo($app_path);
                   ?> 
                    
                </p>
            </div>
        </div>
        
        
    </section>

<?php include 'view/footer.php' ?>