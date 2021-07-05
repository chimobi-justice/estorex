<?php include('./template/functions.php'); ?>


<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('./config/db_connect.php');

    if (isset($_GET['payProduct'])) {
        
        $id = $_GET['payProduct'];

        $sql = "SELECT * FROM products WHERE id = '$id'";
       
        $product_result = mysqli_query($conn, $sql);
    
        $product_row = mysqli_fetch_assoc($product_result);  
        
        $getProductName = $product_row['product_name'];
        $getProductDescription = $product_row['product_description'];
        $getNewPrice = $product_row['product_new_price'];
        $getOldPrice = $product_row['product_old_price'];
        $getProductImage = $product_row['product_image'];

    }

?>


<?php if (!isset($_GET['payProduct']) || !isset($_GET['checkoutproductId'])) :?>

  <div class="not-found-img-container" style="margin: 0; padding: 0;width=100;">
     <div>
        <h1>Sorry, you can't assess this page</h1>
        <a href="index.php">click here to go back</a>
        <div>
          <img src="assets/images/404.jpg" style="width=100%; height: 597px;">
        </div>
      </div>
    </div>

    <?php exit(); ?>

<?php endif; ?>


<?php include('template/header.php'); ?>

    <div id="checkout-pay-method-wrapper">
        <form action="" method="POST" id="checkoutFormControl">
            <div id="checkoutFormHolder">
                <div class="checkout-form-wrapper">
                    <h3>Select Payment Method</h3>
                    <div class="checkout-pay-type">
                        <div>
                            <img src="./assets/images/images.png">
                            <p>Credit/Debit Card</p>
                        </div>
                        <div>
                            <img src="./assets/images/images.png">
                            <p>Visa Card</p>
                        </div>
                        <div>
                            <img src="./assets/images/images.png">
                            <p>Master Card</p>
                        </div>
                    </div>
                    <div><span><img src=""></span><span><img src=""></span><span><img src=""></span></div>
                    <div class="form-container">
                        <div class="form-group-container">
                            <label for="CardNumber">Card number</label>
                            <input type="text" id="CardNumber" placeholder="Card number">
                        </div>
                        <div class="form-group-container">
                            <label for="nameOnCard">Name on card</label>
                            <input type="text" id="nameOnCard" placeholder="Name on card">
                        </div>
                    </div>
                    <div class="form-container form-container-col">
                        <div class="form-group-container">
                            <label for="expirationDate">Expiration date</label>
                            <input type="text" id="expirationDate" placeholder="Expiration date">
                        </div>
                        <div class="form-group-container">
                            <label for="CvvNumber">CVV</label>
                            <input type="text" id="CvvNumber" placeholder="CVV">
                        </div>
                        <div class="form-group-detailed-content">
                            <div>
                                <input type="checkbox"> <label>Save Card</label>
                                <p>I acknowledge that my card information is saved in my account for subsequent transactions.</p>
                            </div>
                        </div>
                    </div>
                    <div id="buttonHolder">
                        <button type="submit">Pay Now</button>
                    </div>
                </div>

                        <div class="order-form-wrapper">
                            <h3>Your Orders</h3>
                            <div class="content-flex">
                                <p>Products</p>
                                <p>Subtotal</p>
                            </div>
                            <div class="holding-orders">
                                <div class="orders">
                                    <div class="orders-container">
                                        <div class="orders-holder">
                                            <div class="orders-img-wrapper">
                                                <img src="./assets/products/<?php echo $product_row['product_image']; ?>">
                                            </div>
                                            <div class="orders-description">
                                                <p><?php echo $product_row['product_name']; ?></p>
                                            </div>
                                        </div>
                                        <div class="three">
                                            <div>
                                                <p>$<?php echo $product_row['product_new_price']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="amountsOrders">
                                <div>
                                    <p>Subtotal</p>
                                    <p>$<?php echo $product_row['product_new_price']; ?></p>
                                </div>
                                <div>
                                    <p>Shipping</p>
                                    <p>free</p>
                                </div>
                                <div>
                                    <p>Total</p>
                                    <p>$<?php echo $product_row['product_new_price']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

<?php include('newsletter.php'); ?>        
           
<?php include('template/footer.php'); ?>        