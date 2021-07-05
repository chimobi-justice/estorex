<?php

    $product_query = "SELECT * FROM products ORDER BY created_at DESC LIMIT 4";

    $product_results = mysqli_query($conn, $product_query);

    $products = mysqli_fetch_all($product_results, MYSQLI_ASSOC);

?>

<section id="fast-products">
  <div class="fast-product-wrapper">
    <h3>Fast Sellers</h3>
     <?php foreach($products as $product) :?>
        <div class="fast-product-holder">
          <a href="checkout_pay.php?shopMyproduct=<?php echo htmlspecialchars($product['id']);?>&products=<?php echo urlencode(uniqid(rand(111111111, 999999999))); ?>&productscategoryItems=<?php echo htmlspecialchars(urldecode($product['sub_category'])); ?>">
              <div>
                <img src="assets/products/<?php echo $product['product_image']; ?>" alt="product-cloth">
              </div>
              <div>
                <p><?php echo $product['product_name']; ?></p>
                <p>$<?php echo $product['product_new_price']; ?> <s>$<?php echo $product['product_old_price']; ?></s></p>
              </div>                                                   
            </a>
        </div>
     <?php endforeach; ?>  
  </div>
</section>