<?php

    include('./config/db_connect.php');
    error_reporting(E_ALL ^ E_NOTICE);

    if (isset($_GET['shopMyproduct'])) {
        $product_id = mysqli_real_escape_string($conn, $_GET['shopMyproduct']);

        $product_detail = "SELECT * FROM products WHERE id = '$product_id'";

        $product_Result = mysqli_query($conn, $product_detail);

        $fetch_product = mysqli_fetch_assoc($product_Result);

        mysqli_free_result($product_Result);
    }

    if (isset($_POST['submitProduct'])) { header('location: auth/login.php'); }

?>


<?php if (!isset($_GET['cartItem']) || !isset($_GET['shopMyproduct']) || !isset($_GET['addToCart'])) :?>

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

<?php include('template/header.php')?>

    <div id="shoppingCartHolder">
        <div class="shoppingCartContainer">
            <div>
                <img src="assets/products/<?php echo $fetch_product['product_image']; ?>" alt="<?php echo $fetch_product['product_name']; ?>">
            </div>
            <div>
                <div class="description">
                    <h3><?php echo $fetch_product['product_name']; ?></h3>
                    <p><?php echo $fetch_product['product_description']; ?></p>
                    <span><?php echo $fetch_product['product_new_price']; ?></span>
                    <span id="oldPrice"><s><?php echo $fetch_product['product_old_price']; ?></s></span>
                </div>

                <div class="size">
                    <label for="Size">Size:</label>
                    <select name="size" disabled>
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
                        <select name="quantity" disabled>
                            <option value="1">1</option>
                            <option value="1">2</option>
                            <option value="1">3</option>
                            <option value="1">4</option>
                            <option value="1">5</option>
                        </select>
                    </div>
                    <div>
                        <p class="info">Category <?php echo $fetch_product['category']; ?></p>
                        <p class="info">Subtotla <?php echo $fetch_product['product_new_price']; ?></p>
                        <div id="buttonHolder">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <input type="hidden" name="productId" id="productId" value="<?php echo $fetch_product['id']; ?>">
                                <button type="submit" name="submitProduct">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
<?php include('template/footer.php')?>