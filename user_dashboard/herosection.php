<?php 
   include('../config/db_connect.php');

   $sql = "SELECT * FROM products ORDER BY created_at DESC limit 1";

   $result = mysqli_query($conn, $sql);

   $fetch_product = mysqli_fetch_assoc($result);
?>

<section id="heroSection">
   <div id="img-container">
       <img src="../assets/images/hero-img.png" alt="hero-man">
   </div>
   <div id="heroSection-detail">
     <div>
        <h3><?php echo $fetch_product['product_name']; ?></h3>
        <div id="heroSection-product">
          <p>Latest product from Estorex.</p>
          <p>$<?php echo $fetch_product['product_new_price']; ?> $<?php echo $fetch_product['product_new_price']; ?></p>
        </div>
        <div class="herobuttonHolder">
        <a href="shop_product.php?shopMyproduct=<?php echo htmlspecialchars(urldecode($fetch_product['id'])); ?>&addToCart=productItem&cartItem=<?php echo urldecode(uniqid(rand(111111111, 99999999))); ?>&productscartIdcategory=<?php echo htmlspecialchars(urldecode($fetch_product['sub_category'])); ?>">Buy Now</a>
        </div>
      </div>
    </div>
</section>