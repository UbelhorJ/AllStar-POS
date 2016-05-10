<?php include 'view/head.php'; ?>
</head>

<?php include 'view/header.php'; ?>

<?php include 'view/navigation.php'; ?>

<style>
    #customer_search {
        float: right;
        padding: 5px 0 5px 0;
    }
    
    #new_customer {
        float: left;
        padding: 5px 0 5px 0;
    }
    
    table {
        border: 2px solid #1F4E79;
    } 
    
    tr, td {
        padding: 5px;
    }
    
    tr:nth-child(4n), tr:nth-child(4n-1) {
        background-color: #BED7F0;
    }
    
    #id {
        width: 50px;
    }
    
    #name {
        width: 300px;
    }
    
    #phone {
        width: 200px;
    }
    
    .delete_button {
        width: 50px;
        float: right;
        margin-left: 5px;
    }
    
    .edit_button {
        width: 35px;
        float: right;
    }
    
</style>

<script>
    $(document).ready(function() {
       $(".customerInfoLine").click(function() {
           $(this).next().toggleClass("hidden");
           if ($(this).find(':first-child').text() === "▶") {
                $(this).find(':first-child').text("🔻");     
           } else {
               $(this).find(':first-child').text("▶");
           }
       });
    });
</script>
   
    <section>
        <div class="info_section">
            <div class="section_header_general">
                <h2>CUSTOMERS</h2>
            </div>
            <div class="section_body_general">
                
                <div id="new_customer">
                    <form action="." method="GET">
                        <input type="hidden" name="customerID" value="new">
                        <input type="hidden" name="action" value="view_add_edit_form">
                        <input type="submit" name="add_new_customer" value=" Add New Customer ">
                    </form>
                </div>
                
                <div id="customer_search">
                    <form action="." method="get">
                        <input type="text" name="customer_search" size="64"> <input type="submit" value=" Search ">
                        <input type="hidden" name="action" value="search">
                    </form>
                </div>
                
                <table>
                    <thead>
                        <tr>
                            <td id="twist">&nbsp;</td>
                            <td id="id">ID</td>
                            <td id="name">Name</td>
                            <td id="phone">Phone#</td>
                            <td id="email">E-Mail</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($customers as $customer) : ?>
                        <tr class="customerInfoLine">
                            <td>▶</td>
                            <td><?php echo $customer->getCustomerIDFormatted(); ?></td>
                            <td><?php echo $customer->getFullNameFamilyFirst(); ?></td>
                            <td><?php echo $customer->getPhoneNumberFormatted(); ?></td>
                            <td><?php echo $customer->getEmailAddress(); ?></td>
                        </tr>
                        <tr class="hidden">
                            <td colspan="2">&nbsp;</td>
                            <td colspan="2">
                                <?php echo $customer->getAddressFormatted() ?>
                            </td>
                            <td>
                                Member Since: <?php echo $customer->getDateCreatedFormatted(); ?><br>
                                    <form class="delete_button" action="." method="POST">
                                        <input type="hidden" name="customerID" value="<?php echo $customer->getCustomerID(); ?>">
                                        <input type="hidden" name="action" value="delete_customer">
                                        <input type="submit" id="deleteCustomer" value=" Delete ">
                                    </form>
                                    <form class="edit_button" action="." method="GET">
                                        <input type="hidden" name="customerID" value="<?php echo $customer->getCustomerID(); ?>">
                                        <input type="hidden" name="action" value="view_add_edit_form">
                                        <input type="submit" id="editCustomer" value=" Edit ">
                                    </form>
                            </td>
                        </td>
                    <?php endforeach ?>
                    </tbody>
                </table>

        </div>
        </div>
        
    </section>

<?php include 'view/footer.php' ?>