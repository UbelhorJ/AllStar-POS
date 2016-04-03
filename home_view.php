<?php include 'view/head.php'; ?>
</head>

<?php include 'view/header.php'; ?>
    
<?php include 'view/navigation.php'; ?>

<style>
    
    thead tr > :nth-child(2) {
        width: 100px;
        text-align: right;
    }
    
    tr, td {
        border: 2px solid #1F4E79;
        padding: 3px;
    }  
</style>
   
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
                <h2>RELEASE NOTES</h2>
            </div>
            <div class="section_body_general">
                <br>
                <?php foreach ($release_notes as $note) : ?>
                    <?php 
                        $noteDate = new DateTime($note['dateTime']);
                        $noteDate = $noteDate->format('m/d/Y');
                    ?>
					<table>
                        <thead>
						    <tr>
							    <td >
								    <b><?php echo $note['description']; ?></b>
							    </td>
							    <td>
								    <b><?php echo $noteDate; ?></b>
							    </td>
						    </tr>
                        </thead>
                        <tbody>
						    <tr>
							    <td colspan="2">
							    <?php echo $note['detailedDescription']; ?>
							    </td>
						    </tr>
                        </tbody>
					</table>
                    <br>
                <?php endforeach ?>
            </div>
        </div>
        
        
    </section>

<?php include 'view/footer.php' ?>