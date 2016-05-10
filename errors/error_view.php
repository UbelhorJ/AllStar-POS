<?php include '../view/head.php'; ?>
</head>

<?php include 'view/header.php'; ?>
    
<?php include '../view/navigation.php'; ?>
   
    <section>
         
        <div class="info_section">
            <div class="section_header_error">
                <h2>ERROR</h2>
            </div>
            <div class="section_body_error">
                <p>
                    <?php
                        echo $error_message;                                          
                    ?>
                </p>
            </div>
        </div>        
        
    </section>

<?php include '../view/footer.php' ?>