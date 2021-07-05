<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>

<?php

    include('../config/db_connect.php');

    $custCartId = $_SESSION['id'];

    $response = ['message' => ''];

    $custQuery = "SELECT * FROM account WHERE id = '$custCartId'";
    
    $custResults = mysqli_query($conn, $custQuery);

    $custRow = mysqli_fetch_assoc($custResults);

    $cartQuery = "SELECT * FROM order_item WHERE orderId = '$custCartId'";
    
    $cartResults = mysqli_query($conn, $cartQuery);

    $custCartRow = mysqli_fetch_all($cartResults, MYSQLI_ASSOC);


    if (isset($_POST['proceed'])) { header('location: checkout_fields.php'); }

    $i = 1;

    if (isset($_POST['removeCart'])) {
        $cart = $_POST['removeId'];
            
        $removeCartQuery = "DELETE FROM order_item WHERE id = '$cart'";
    
        if (mysqli_query($conn, $removeCartQuery)) {
            header('location: cart.php?removecartProduct=' . urlencode(uniqid(rand(111111111,000000000))));
        } else {
            $response['message'] = 'can\'t remove item try again';
        }
    }


    if (isset($_POST['cancelCartItem'])) { header('location: cart.php'); }

?>


<?php include('template/header.php'); ?>

        <!-- start response message -->

        <?php if (isset($_GET['removecartProduct'])) :?>
            <p class="response success"><?php echo 'Item remove From Cart!' ?></p>
        <?php else :?>
            <p></p>
        <?php endif; ?>

        <?php if (isset($_GET['removecartItem'])) :?>

            <?php  $cartId = $_GET['removecartItem']; ?>
        
            <div id="response">
                <p>Are you sure you want to remove the product!</p>
                <div class="flexBtn">
                    <form method="POST">
                        <input type="hidden" name="removeId" value="<?php echo $cartId; ?>">
                        <button type="submit" name="cancelCartItem" class="cancelCart">cancel</button>
                        <button type="submit" name="removeCart" class="removeCart">remove</button>
                    </form>
                </div>
            </div>

        <?php endif; ?>

        <!-- end response message-->

        <?php if (!$custCartRow):?>
            <div id="emptyCart-wrapper">
                <div class="emptyCart-content">
                    <h2>Your Shopping cart is empty</h2>
                    <h3>You Don't have any item in your shopping cart, please click the button down below!</h3>
                    <div id="buttonHolder">
                        <a href="index.php">Click here to add a product</a>
                    </div>
                </div>
            </div>
        <?php else :?>    

            <div id="cart-wrapper">
                <h3 class="cart-title">Your Cart</h3>
                <div id="cart-container">
                    <div class="cart-header">
                        <p id="cartNumber">#</p>
                        <p>Products</p>
                        <p>Price</p>
                        <p>Quantity</p>
                        <p>Subtotal</p>
                        <p id="cartRemove">Action</p>
                    </div>
                    <?php foreach($custCartRow as $cartRow) :?>
                        <div>
                            <p id="cartNumber"><?php echo $i++; ?></p>
                            <p><?php echo $cartRow['product_name']; ?></p>
                            <p>$<?php echo $cartRow['product_new_price']; ?></p>
                            <p><?php echo $cartRow['quantity']; ?></p>
                            <p>$<?php echo $cartRow['product_new_price']; ?></p>
                            <p id="cartRemove"><a href="cart.php?removecartItem=<?php echo urlencode($cartRow['id']); ?>&productcartid=<?php echo urlencode(uniqid(rand(111111111, 999999999))); ?>" title="Remove Item">Remove</a></p>                                                   
                        </div>
                    <?php endforeach; ?>
                   
                    <div class="coupon">
                        <div>
                            <form method="POST">
                                <div class="form-group-container">
                                    <input type="text" placeholder="Coupon Code">
                                    <input type="submit" value="Apply Coupon">
                                </div>
                            </form>
                        </div>
                        <div>
                            <div>
                                <p>Subtotal: <span><?php echo '$299.00'; ?></span></p>
                                <p>Total: <span><?php echo '$299.00' ?></span></p>
                            </div>
                            <div id="buttonHolder">
                                <form method="POST">
                                    <button type="submit" name="proceed">Proceed to checkout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif;?>

<?php include('template/footer.php'); ?>