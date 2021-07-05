<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>

<?php

    include('../config/db_connect.php');
    error_reporting(E_ALL ^ E_NOTICE);

    if (isset($_GET['gender_product_collection'])) {

        $get_product_category = $_GET['gender_product_collection'];

        $query = "SELECT * FROM products  WHERE category = '$get_product_category' ORDER BY created_at DESC limit 30";
    
        $query_result = mysqli_query($conn, $query);
    
        $fetch_uniqId_product = mysqli_fetch_all($query_result, MYSQLI_ASSOC);
    }

?>


<?php if (!isset($_GET['gender_product_collection']) || !isset($_GET['collectionproducts'])) :?>

  <div class="not-found-img-container" style="margin: 0; padding: 0; width=100;">
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

<?php include('template/header.php')?>

  <section id="products-category">
    <div class="products-category-wrapper">
      <?php foreach($fetch_uniqId_product as $product) :?>
          <div class="products-category-holder">
              <a href="shop_product.php?shopMyproduct=<?php echo htmlspecialchars(urldecode($product['id'])); ?>&addToCart=productItem&cartItem=<?php echo urldecode(uniqid(rand(111111111, 99999999))); ?>&productscartIdcategory=<?php echo htmlspecialchars(urldecode($product['sub_category'])); ?>">
                <div>
                  <img src="../assets/products/<?php echo $product['product_image']; ?>" alt="product-cloth">
                </div>
                <div>
                  <p><?php echo $product['product_name']; ?></p>
                  <p><?php echo $product['product_new_price']; ?></p>
                </div>                                                   
              </a>
          </div>
      <?php endforeach; ?>  
    </div>
  </section>

<?php include('template/footer.php')?>
