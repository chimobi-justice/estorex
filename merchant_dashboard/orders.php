<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>
<?php

    include('../config/db_connect.php');

    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];

    $sql = "SELECT DISTINCT orderId, firstname, lastname, emailaddress, phone
             FROM order_item 
             INNER JOIN customer
             ON order_item.orderId = customer.customer_id 
             WHERE  merchant_product_email = '$email' 
             ORDER BY created_at DESC";

    $results = mysqli_query($conn, $sql);

    $products = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>


<?php include('template/admin_header.php'); ?>

        <?php if (!$products):?>
            <div id="emptyCart-wrapper">
                <div class="emptyCart-content">
                    <h2>No Orders Yet</h2>
                    <h3>You Don't have any Orders Yet</h3>
                </div>
            </div>
        <?php else :?>    

            <div id="proceed-order-wrapper">
                <h3 class="proceed-order-title">Your Orders</h3>
                <div id="proceed-order-container">
                    <div class="proceed-order-header">
                        <p>Customer Firstname</p>
                        <p>Customer Lastname</p>
                        <p>Customer Number</p>
                        <p>Action</p>
                    </div>
                    <?php foreach($products as $customerOrder) :?>
                        <div>
                            <p><?php echo $customerOrder['firstname']; ?></p>
                            <p><?php echo $customerOrder['lastname']; ?></p>
                            <p><?php echo $customerOrder['phone']; ?></p>
                            <p id="proceedOrder"><a href="view_orders.php?custorder=<?php echo $customerOrder['orderId']; ?>&custId=<?php echo uniqid(rand(111111111,999999999)); ?>" title="View Order">View Order</a></p>                                                   
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif;?> 

<?php include('template/admin_footer.php'); ?>    