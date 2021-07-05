<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>
<?php

    $custCartId = $_SESSION['id'];
    $email = $_SESSION['email'];

    include('../config/db_connect.php');

    if (isset($_GET['custorder']) && intval($_GET['custorder'])) {
        $custOrder = mysqli_real_escape_string($conn, $_GET['custorder']);

        $cartQuery = "SELECT * FROM order_item WHERE orderId = '$custOrder' AND merchant_product_email = '$email'";

        $cartResults = mysqli_query($conn, $cartQuery);
    
        $custCartRow = mysqli_fetch_all($cartResults, MYSQLI_ASSOC);

        $sql = "SELECT * FROM customer WHERE customer_id = '$custOrder' ORDER BY created_at DESC";

        $result = mysqli_query($conn, $sql);
    
        $customer = mysqli_fetch_assoc($result);


        $customer_firstname = $customer['firstname'];
        $customer_lastname = $customer['lastname'];
        $customer_email = $customer['emailaddress'];
        $customer_phone = $customer['phone'];
        $customer_city = $customer['city'];
        $customer_postcode = $customer['post_code'];
        $customer_address = $customer['address'];
        $customer_date_created = $customer['created_at'];
    } else {
        die();
    }

?>

<?php include('template/admin_header.php'); ?>

        <div id="detailHolder">
            <?php foreach ($custCartRow as $order) :?>
                <div class="detailContainer">
                    <div>
                        <img src=".././assets/products/<?php echo $order['product_image']; ?>" alt="image">
                    </div>
                    <div>
                        <div class="description">
                            <h3><?php echo $order['product_name']; ?></h3>
                            <p><?php echo $order['product_description']; ?></p>
                            <span><?php echo $order['product_new_price']; ?></span>
                            <span id="oldPrice"><s><?php echo $order['product_old_price']; ?></s></span>
                        </div>

                        <div class="size">
                            <p>Size: <?php echo $order['size']; ?></p>
                        </div>

                        <div class="color">
                            <p>Color: <?php echo $order['color']; ?></p>
                        </div>

                        <div class="quantity">
                            <p>Quantity: <?php echo $order['quantity']; ?></p>
                        </div>
                        <div class="price">
                            <p>Total Price: <?php echo $order['product_new_price']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>    
        </div>    
        <?php if (!$custCartRow) :?>
            <div></div>
        <?php else :?>
            <div class="customer-info">
                <h2>customer Info</h2>   
                <div class="customer-name">
                    <h3>Customer Name</h3>
                    <p><?php echo $customer_firstname . ' ' . '<strong>' . $customer_lastname. '</strong>'; ?></p>
                </div>
                <div class="customer-email">
                    <h3>Customer Email Address</h3>
                    <p><?php echo $customer_email; ?></p>
                </div>
                <div class="customer-tel">
                    <h3>Customer Phone Number</h3>
                    <p><?php echo $customer_phone; ?></p>
                </div>
                <div class="customer-city">
                    <h3>Customer town/City</h3>
                    <p><?php echo $customer_city; ?></p>
                </div>
                <div class="customer-postcode">
                    <h3>Customer Postcode</h3>
                    <p><?php echo $customer_postcode; ?></p>
                </div>
                <div class="customer-home-address">
                    <h3>Customer Home Address</h3>
                    <p><?php echo $customer_address; ?>.</p>
                </div>
                <div class="customer-date-created">
                    <h3>Customer Order Date</h3>
                    <p><?php echo $customer_date_created; ?>.</p>
                </div>
            </div> 
        <?php endif;?>

<?php include('template/admin_footer.php'); ?>  