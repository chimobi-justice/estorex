<?php include('./template/functions.php'); ?>
<?php

    include('./config/db_connect.php');

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

    if (isset($_GET['shopMyproduct'])) {
        
        $id = $_GET['shopMyproduct'];

        $sql = "SELECT * FROM products WHERE id = '$id'";
       
        $product_result = mysqli_query($conn, $sql);
    
        $product_row = mysqli_fetch_assoc($product_result);  
        
        $getProductName = $product_row['product_name'];
        $getProductDescription = $product_row['product_description'];
        $getNewPrice = $product_row['product_new_price'];
        $getOldPrice = $product_row['product_old_price'];
        $getProductImage = $product_row['product_image'];

    }

    if (isset($_GET['productscategoryItems'])) {

        $get_product_category = $_GET['productscategoryItems'];

        $query = "SELECT * FROM products  WHERE sub_category = '$get_product_category' ORDER BY created_at DESC limit 4";
    
        $query_result = mysqli_query($conn, $query);
    
        $fetch_uniqId_product = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
    }


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

            $sql = "INSERT INTO temp_customer(`firstname`,
                                        `lastname`, 
                                        `address`,  
                                        `phone`, 
                                        `emailaddress`,  
                                        `city`, 
                                        `post_code`,
                                        `product_name`,
                                        `product_description`,
                                        `product_new_price`,
                                        `product_old_price`,
                                        `product_image`)
                                VALUES('$firstname', 
                                        '$lastname', 
                                        '$address',  
                                        '$phone', 
                                        '$email', 
                                        '$city', 
                                        '$post_code',
                                        '$getProductName',
                                        '$getProductDescription',
                                        '$getNewPrice',
                                        '$getOldPrice',
                                        '$getProductImage')";                            

            $custResult = mysqli_query($conn, $sql); 
              
            if ($custResult) {
                header('location: checkout.php?payProduct='. htmlspecialchars(urlencode($id)) . '&checkoutproductId=' . htmlspecialchars(urlencode(uniqid(rand(111111111, 999999999)))));
            } else {
                $res['message'] = 'Failed to Place Order please try again';
            }
        }
    }

?>
  

<?php if (!isset($_GET['shopMyproduct']) || !isset($_GET['products']) || !isset($_GET['productscategoryItems'])) :?>

    <div class="not-found-img-container" style="margin: 0; padding: 0;width=100;">
        <div>
            <h1>Sorry, you can't access this page</h1>
            <a href="index.php">click here to go back</a>
            <div>
                <img src="assets/images/404.jpg" style="width=100%; height: 597px;">
            </div>
        </div>
    </div>

  <?php exit(); ?>

<?php endif; ?>


<?php include('template/header.php'); ?>

    <div>
        <?php if (!$res) :?>
            <p></p>
        <?php elseif ($res['message'] === 'Failed to Place Order please try again') :?>  
            <p class="response err"><?php echo $res['message']; ?></p>
        <?php endif;?>    
    </div>

    <div id="checkout-fields-wrapper">
                <form action="" method="POST" id="checkoutFormControl">
                    <div id="checkoutFormHolder">
                        <div class="checkout-form-wrapper">
                            <h3>Shipping Address</h3>
                            <div class="form-container">
                                <div class="form-group-container">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="<?php echo htmlspecialchars($firstname); ?>">
                                    <p class="errors"><?php echo $errors['firstname']; ?></p>
                                </div>
                                <div class="form-group-container">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="<?php echo htmlspecialchars($lastname); ?>">
                                    <p class="errors"><?php echo $errors['lastname']; ?></p>
                                </div>
                            </div>
                            <div class="form-container-address">
                                <div class="form-address">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="10" placeholder="address"><?php echo htmlspecialchars($address); ?></textarea>
                                    <p class="errors"><?php echo $errors['address']; ?></p>                                
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group-container">
                                    <label for="phone">Phone/Mobile</label>
                                    <input type="text" name="phone" id="phone" placeholder="Phone/Mobile" value="<?php echo htmlspecialchars($phone); ?>">
                                    <p class="errors"><?php echo $errors['phone']; ?></p>                               
                                </div>
                                <div class="form-group-container">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                                    <p class="errors"><?php echo $errors['email']; ?></p>
                                </div>
                            </div>
                            <div class="form-container">
                                <div class="form-group-container">
                                    <label for="city">City/Town</label>
                                    <input type="text" name="city" id="city" placeholder="City/Town" value="<?php echo htmlspecialchars($city); ?>">
                                    <p class="errors"><?php echo $errors['city']; ?></p>                                
                                </div>
                                <div class="form-group-container">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" name="postcode" id="postcode" placeholder="Postcode" value="<?php echo htmlspecialchars($post_code); ?>">
                                    <p class="errors"><?php echo $errors['post_code']; ?></p>                                
                                </div>
                            </div>
                            <div class="buttonHolder">
                                <button type="submit" name="PlaceOrder">Place Order</button>
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
                                                    <img src="assets/products/<?php echo $product_row['product_image']; ?>">
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
                            <?php if (!$product_row) :?>
                                <div class="amountsOrders">
                                    <p>No orders Found <a href="index.php">click here to add an item</a></p>
                                </div>
                            <?php else : ?>
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
                            <?php endif; ?>

                        </div>
                    </div>
                </form>
            </div>

            <section id="related_products">
            <div class="related_product-wrapper">
                <?php if (count($fetch_uniqId_product) == 1): ?>
                    <span></span>
                <?php else :?>
                    <h3>Related Products</h3>
                    <?php foreach ($fetch_uniqId_product as $fetch_product) :?>
                        <div class="related_product-holder">
                            <a href="checkout_pay.php?shopMyproduct=<?php echo htmlspecialchars($fetch_product['id']);?>&products=<?php echo urlencode(uniqid(rand(111111111, 999999999))); ?>&productscategoryItems=<?php echo htmlspecialchars(urldecode($fetch_product['sub_category'])); ?>">
                                <div>
                                    <img src="./assets/products/<?php echo $fetch_product['product_image']; ?>" alt="product-cloth">
                                </div>
                                <div>
                                    <p><?php echo $fetch_product['product_name']; ?></p>
                                    <p><?php echo $fetch_product['product_new_price']; ?></p>
                                </div>                                                   
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif;?>    
            </div>
        </section>


<?php include('newsletter.php'); ?>                     

<?php include('template/footer.php'); ?>                     