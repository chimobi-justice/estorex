<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>

<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');
    
    $customer_id = $_SESSION['id'];

    $res = ['message' => ''];

    if (isset($_GET['shopMyproduct'])) {

        $product_id = $_GET['shopMyproduct'];

        $sql = "SELECT * FROM products WHERE id = '$product_id'";

        $result = mysqli_query($conn, $sql);

        $get_product = mysqli_fetch_assoc($result);

        $product_name = $get_product['product_name'];
        $product_description = $get_product['product_description'];
        $product_new_price = $get_product['product_new_price'];
        $product_old_price = $get_product['product_old_price'];
        $product_image = $get_product['product_image'];
        $merchant_product_email = $get_product['merchant_product_email'];

    }


    if (isset($_GET['productscartIdcategory'])) {

        $get_product_category = $_GET['productscartIdcategory'];

        $query = "SELECT * FROM products  WHERE sub_category = '$get_product_category' ORDER BY created_at DESC limit 4";
    
        $query_result = mysqli_query($conn, $query);
    
        $fetch_uniqId_product = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
    }


    if (isset($_POST['submitProduct'])) {

        $product_size = $_POST['size'];

        $product_quantity = $_POST['quantity'];

        $sql = "INSERT INTO order_item(product_name,
                                        product_description,
                                        product_new_price,
                                        product_old_price,
                                        size,
                                        color,
                                        quantity,
                                        product_image,
                                        merchant_product_email,
                                        orderId)
                            VALUES('$product_name',
                                    '$product_description',
                                    '$product_new_price',
                                    '$product_old_price',
                                    '$product_size',
                                    'default',
                                    '$product_quantity',
                                    '$product_image',
                                    '$merchant_product_email',
                                    '$customer_id')";

        if (!mysqli_query($conn, $sql)) { $res['message'] = 'Inserted Failed'; } 
    }

?>

<?php if (!isset($_GET['productscartIdcategory']) || !isset($_GET['shopMyproduct']) || !isset($_GET['cartItem'])) :?>

  <div class="not-found-img-container" style="margin: 0; padding: 0;width=100;">
     <div>
        <h1>Sorry, you can't access this page</h1>
        <a href="index.php">click here to go back</a>
        <div>
          <img src="../assets/images/404.jpg" style="width=100%; height: 597px;">
        </div>
      </div>
    </div>

    <?php exit(); ?>

<?php endif; ?>

<?php include('template/header.php'); ?>

    <?php if ($res['message']) :?>
        <p></p>
    <?php elseif ($res['message'] === 'Inserted Failed') :?>
        <p class="response err"><?php echo $res['message']; ?></p>
    <?php endif; ?>

    <form action="" method="POST" id="shoppingCartHolder">
        <div class="shoppingCartContainer">
            <div>
                <img src="../assets/products/<?php echo $get_product['product_image']; ?>" alt="<?php echo $get_product['product_name']; ?>">
            </div>
            <div>
                <div class="description">
                    <h3><?php echo $get_product['product_name']; ?></h3>
                    <p><?php echo $get_product['product_description']; ?></p>
                    <span><?php echo $get_product['product_new_price']; ?></span>
                    <span id="oldPrice"><s><?php echo $get_product['product_old_price']; ?></s></span>
                </div>

                <div class="size">
                    <label for="Size">Size:</label>
                    <select name="size">
                        <option value="medium">M</option>
                        <option value="small">S</option>
                        <option value="large">L</option>
                        <option value="extra-large">XL</option>
                    </select>
                </div>

                <div class="color">
                    <h5>Color</h5>
                    <span class="color1"></span>
                    <span class="color2"></span>
                    <span class="color3"></span>
                    <span class="color4"></span>
                    <span class="color5"></span>
                    <span class="color6"></span>
                </div>

                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <select name="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div>
                    <p class="info">Category <?php echo $get_product['category']; ?></p>
                    <p class="info">Subtotal <?php echo $get_product['product_new_price']; ?></p>
                    <div class="buttonHolder">
                        <button type="submit" name="submitProduct">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </form>  
        
    <section id="related_products">
        <div class="related_product-wrapper">
            <?php if (count($fetch_uniqId_product) == 1): ?>
                <span></span>
            <?php else :?>
                <h3>Related Products</h3>
                <?php foreach ($fetch_uniqId_product as $fetch_product) :?>
                    <div class="related_product-holder">
                        <a href="shop_product.php?shopMyproduct=<?php echo htmlspecialchars(urldecode($fetch_product['id'])); ?>&addToCart=productItem&cartItem=<?php echo urldecode(uniqid(rand(111111111, 99999999))); ?>&productscartIdcategory=<?php echo htmlspecialchars(urldecode($fetch_product['sub_category'])); ?>">
                            <div>
                                <img src="../assets/products/<?php echo $fetch_product['product_image']; ?>" alt="product-cloth">
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

<?php include('template/footer.php'); ?>        