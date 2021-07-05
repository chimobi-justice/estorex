<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>


<?php

    include('../config/db_connect.php');

    $userCartId = $_SESSION['id'];
    $f = $_SESSION['firstname'];
    $l = $_SESSION['lastname'];
    $e = $_SESSION['email'];

    $userCartQuery = "SELECT * FROM order_item WHERE orderId = '$userCartId'";
    
    $userCartResults = mysqli_query($conn, $userCartQuery);

    $userCartRow = mysqli_fetch_all($userCartResults, MYSQLI_ASSOC);

    if (isset($_POST['removeProduct'])) {
        $productItem = $_POST['removeProductId'];
            
        $removeProductQuery = "DELETE FROM order_item WHERE id = '$productItem'";
    
        if (mysqli_query($conn, $removeProductQuery)) {
            header('location: checkout_fields.php?removecartProduct=' . urlencode(uniqid(rand(111111111,000000000))));
        } else {
            $response['message'] = 'can\'t remove item try again';
        }
    }


    if (isset($_POST['cancelCartItem'])) { header('location: checkout_fields.php'); } 

    $firstname = '';
    $lastname = '';
    $address = '';
    $phone = '';
    $email = '';
    $city = '';
    $post_code = '';
     
    $errors = [
                'firstname' => '',
                'lastname' => '', 
                'address' => '', 
                'phone' => '', 
                'email' => '', 
                'city' => '', 
                'post_code' => ''
            ];
     
    $res = ['message' => ''];        

    if (isset($_POST['PlaceOrder'])) {

        if (empty($_POST['firstname'])) {
            $errors['firstname'] = 'Required*';
        } else {

            $firstname = trim($_POST['firstname']);
            $userFirstname = $firstname;
            if (!preg_match('/^[a-zA-Z]+$/', $firstname)) { $errors['firstname'] = 'Firstname must be letters only'; }
        }
        if (empty($_POST['lastname'])) {
            $errors['lastname'] = 'Required*';
        } else {

            $lastname = trim($_POST['lastname']);
            $userLastname = $lastname;
            if (!preg_match('/^[a-zA-Z]+$/', $lastname)) { $errors['lastname'] = 'Lastname must be letters only'; }
        }
        if (empty($_POST['address'])) {
             $errors['address'] = 'Required*';
        } else { 
            $address = trim($_POST['address']);
            $userAddress = $address; 
        }

        if (empty($_POST['phone'])) {
            $errors['phone'] = 'Required*';
        } else {

            $phone = trim($_POST['phone']);
            $userPhone = $phone;
            if (!is_numeric($phone) || (!preg_match('/^[0-9]*$/', $phone))) {
                $errors['phone'] = 'Tel must be Numbers only';
            } elseif (strlen($phone) > 11) {
                $errors['phone'] = 'Tel should be atleast 11 Numbers long';
            }
        }
        if (empty($_POST['email'])) {
            $errors['email'] = 'Required*';
        } else {

            $email = trim($_POST['email']);
            $userEmail = $email;
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors['email'] = 'Email must be valid email address'; }
        }
        if (empty($_POST['city'])) { 
            $errors['city'] = 'Required*'; 
        } else { 
            $city = trim($_POST['city']); 
            $userCity = $city;
        }

        if (empty($_POST['postcode'])) {
            $errors['post_code'] = 'Required*';
        } else {

            $post_code = trim($_POST['postcode']);
            $userPostCode = $post_code;
            if (!is_numeric($post_code) || (!preg_match('/^[0-9]*$/', $post_code))) { $errors['post_code'] = 'Postcode should be Numbers'; }
        }

        if (!array_filter($errors)) {
            $firstname = escape_string($conn, $_POST['firstname']);
            $lastname = escape_string($conn, $_POST['lastname']);
            $address = escape_string($conn, $_POST['address']);
            $phone = escape_string($conn, $_POST['phone']);
            $email = escape_string($conn, $_POST['email']);
            $city = escape_string($conn, $_POST['city']);
            $post_code = escape_string($conn, $_POST['postcode']);

            $sql = "INSERT INTO customer(`firstname`,
                                        `lastname`, 
                                        `address`,  
                                        `phone`, 
                                        `emailaddress`,  
                                        `city`, 
                                        `post_code`, 
                                        `customer_id`)
                                VALUES('$firstname', 
                                        '$lastname', 
                                        '$address',  
                                        '$phone', 
                                        '$email', 
                                        '$city', 
                                        '$post_code',
                                        '{$userCartId}')";                            


            $custResult = mysqli_query($conn, $sql);  

            if ($custResult) {
                header('location: checkout.php');
            } else {
                $res['message'] = 'Failed to Place an Order please try again';
            }
        }
    }

?>
    
<?php include('template/header.php'); ?>

    <!-- start response message -->

    <?php if (isset($_GET['removecartProduct'])):?>
        <p class="response success"><?php echo 'Item remove Successfully!' ?></p>
    <?php else :?>
        <p></p>
    <?php endif; ?>

    <!-- end response message-->

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

    <div>
        <?php if (!$res) :?>
            <p></p>
        <?php elseif ($res['message'] === 'Failed to Place an Order please try again') :?>  
            <p class="response err">Failed to proceed please try again</p>
        <?php endif;?>    
    </div>

    <div id="checkout-fields-wrapper">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="checkoutFormControl">
            <div id="checkoutFormHolder">
                <div class="checkout-form-wrapper">
                    <h3>Shipping Address</h3>
                        <div class="form-container">
                            <div class="form-group-container">
                                <label for="firstname">Firstname</label>
                                <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="<?php echo htmlspecialchars($f); ?>">
                                <p class="errors notice"><?php echo $errors['firstname']; ?></p>
                            </div>
                            <div class="form-group-container">
                                <label for="lastname">Lastname</label>
                                <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="<?php echo htmlspecialchars($l); ?>">
                                <p class="errors notice"><?php echo $errors['lastname']; ?></p>
                            </div>
                        </div>
                        <div class="form-container-address">
                            <div class="form-address">
                                <label for="address">Address</label>
                                <textarea name="address" id="address" cols="30" rows="10" placeholder="address"><?php echo htmlspecialchars($userAddress); ?></textarea>
                                <p class="errors notice"><?php echo $errors['address']; ?></p>                                
                            </div>
                       </div>
                       <div class="form-container">
                            <div class="form-group-container">
                                <label for="phone">Phone/Mobile</label>
                                <input type="text" name="phone" id="phone" placeholder="Phone/Mobile" value="<?php echo htmlspecialchars($userPhone); ?>">
                                <p class="errors notice"><?php echo $errors['phone']; ?></p>                               
                            </div>
                            <div class="form-group-container">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($e); ?>">
                                <p class="errors notice"><?php echo $errors['email']; ?></p>
                            </div>
                        </div>
                        <div class="form-container">
                            <div class="form-group-container">
                                <label for="city">City/Town</label>
                                <input type="text" name="city" id="city" placeholder="City/Town" value="<?php echo htmlspecialchars($userCity); ?>">
                                <p class="errors notice"><?php echo $errors['city']; ?></p>                                
                            </div>
                            <div class="form-group-container">
                                <label for="postcode">Postcode</label>
                                <input type="text" name="postcode" id="postcode" placeholder="Postcode" value="<?php echo htmlspecialchars($userPostCode); ?>">
                                <p class="errors notice"><?php echo $errors['post_code']; ?></p>                                
                            </div>
                        </div>
                        <div id="buttonHolder">
                            <form method="POST">
                                <button type="submit" name="PlaceOrder">Place Order</button>
                            </form>
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
                                                <p><a href="checkout_fields.php?removeProductsItem=<?php echo urlencode($row['id']); ?>&productcartid=<?php echo urlencode(uniqid(rand(111111111, 999999999))); ?>" title="Remove Item">x</a></p>
                                                <p><?php echo $row['product_new_price']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                        <?php if (!$userCartRow) :?>
                            <div class="amountsOrders">
                                <p>No orders Found <a href="index.php">click here to add an item</a></p>
                            </div>
                        <?php else : ?>
                            <div class="amountsOrders">
                                <div>
                                    <p>Subtotal</p>
                                    <p><?php echo $cartTotal; ?></p>
                                </div>
                                <div>
                                    <p>Shipping</p>
                                    <p>free</p>
                                </div>
                                <div>
                                    <p>Total</p>
                                    <p><?php echo  $cartTotal ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
             </div>
        </form>
    </div>

<?php include('newsletter.php'); ?>                     

<?php include('template/footer.php'); ?>                     