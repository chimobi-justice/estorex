<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>
<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');
    
    $checkout_id = $_SESSION['id'];

    if (isset($_POST['Checkout'])) { header('location: proceed.php'); }

    if (isset($_POST['removeProduct'])) {
        $productItem = $_POST['removeProductId'];
            
        $removeProductQuery = "DELETE FROM order_item WHERE id = '$productItem'";
    
        if (mysqli_query($conn, $removeProductQuery)) {
            header('location: checkout_fields.php?removecartProduct=' . urlencode(uniqid(rand(111111111,000000000))));
        } else {
            $response['message'] = 'can\'t remove item try again';
        }
    }


    if (isset($_POST['cancelCartItem'])) { header('location: checkout.php'); }

    $userCartQuery = "SELECT * FROM order_item WHERE orderId = '$checkout_id'";
    
    $userCartResults = mysqli_query($conn, $userCartQuery);

    $userCartRow = mysqli_fetch_all($userCartResults, MYSQLI_ASSOC);

    mysqli_free_result($userCartResults);

?>

    
    <?php include('template/header.php'); ?>

            <?php if (isset($_GET['removecartProduct'])):?>
                <p class="response success"><?php echo 'Item remove Successfully!' ?></p>
            <?php else :?>
                <p></p>
            <?php endif; ?>

            <?php if (isset($_GET['removeProductsItem'])) :?>

            <?php  $productId = $_GET['removeProductsItem']; ?>

            <div id="response">
                <p>Are you sure you want to remove the product!</p>
                <div class="flexBtn">
                    <form method="POST">
                        <input type="hidden" name="removeProductId" value="<?php echo $productId; ?>">
                        <button type="submit" name="cancelCartItem" class="cancelCart">cancel</button>
                        <button type="submit" name="removeProduct" class="removeCart">remove</button>
                    </form>
                </div>
            </div>

            <?php endif; ?>

            <div id="checkout-pay-method-wrapper">
                <form action="" method="POST" id="checkoutFormControl">
                    <div id="checkoutFormHolder">
                        <div class="checkout-form-wrapper">
                            <h3>Select Payment Method</h3>
                            <div class="checkout-pay-type">
                                <div>
                                    <img src="../assets/images/images.png">
                                    <p>Credit/Debit Card</p>
                                </div>
                                <div>
                                    <img src="../assets/images/images.png">
                                    <p>Visa Card</p>
                                </div>
                                <div>
                                    <img src="../assets/images/images.png">
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
                                    <?php foreach ($userCartRow as $row) :?>
                                        <div class="orders-container">
                                            <div class="orders-holder">
                                                <div class="orders-img-wrapper">
                                                    <img src="../assets/products/<?php echo $row['product_image']; ?>">
                                                </div>
                                                <div class="orders-description">
                                                    <p><?php echo $row['product_name']; ?></p>
                                                </div>
                                            </div>
                                            <div class="three">
                                                <div>
                                                    <p><a href="checkout.php?removeProductsItem=<?php echo urlencode($row['id']); ?>&productcartid=<?php echo urlencode(uniqid(rand(111111111, 999999999))); ?>" title="Remove Item">x</a></p>
                                                    <p><?php echo $row['product_new_price']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>

                            <div class="amountsOrders">
                                <div>
                                    <p>Subtotal</p>
                                    <p>$299.00</p>
                                </div>
                                <div>
                                    <p>Shipping</p>
                                    <p>free</p>
                                </div>
                                <div>
                                    <p>Total</p>
                                    <p>$299.00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
           
<?php include('newsletter.php'); ?>                     
        
<?php include('template/footer.php'); ?>        
            