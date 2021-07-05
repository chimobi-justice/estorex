<?php

    include('../config/db_connect.php');
    error_reporting(E_ALL ^ E_NOTICE);

    $product_query = "SELECT * FROM products ORDER BY created_at ASC LIMIT 30";

    $product_results = mysqli_query($conn, $product_query);

    $products = mysqli_fetch_all($product_results, MYSQLI_ASSOC);

?>

<section id="products">
  <div class="product-wrapper">
     <?php foreach($products as $product) :?>
        <div class="product-holder">
            <a href="shop_product.php?shopMyproduct=<?php echo htmlspecialchars(urldecode($product['id'])); ?>&addToCart=productItem&cartItem=<?php echo urldecode(uniqid(rand(111111111, 99999999))); ?>&productscartIdcategory=<?php echo htmlspecialchars(urldecode($product['sub_category'])); ?>">
              <div>
                <img src="../assets/products/<?php echo $product['product_image']; ?>" alt="product-cloth">
              </div>
              <div>
                <p><?php echo $product['product_name']; ?></p>
                <p>$<?php echo $product['product_new_price']; ?></p>
              </div>                                                   
            </a>
        </div>
     <?php endforeach; ?>  
  </div>
</section>
