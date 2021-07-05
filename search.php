<?php

    include('./config/db_connect.php');
    error_reporting(E_ALL ^ E_NOTICE);

    if (isset($_GET['search'])) {
        $q = htmlspecialchars(urlencode($_GET['search']));
    
        $product_query = "SELECT * FROM products
                          WHERE product_name LIKE '%$q%' 
                          OR product_new_price LIKE '%$q%' 
                          OR category LIKE '%$q%' 
                          OR sub_category LIKE '%$q%'
                          ORDER BY created_at DESC";
    
        $product_results = mysqli_query($conn, $product_query);
    
        $products = mysqli_fetch_all($product_results, MYSQLI_ASSOC);
    }

?>

<?php if (!isset($_GET['search']) || $q === '') :?>

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

<section id="search">
  <div class="search-wrapper">
    <?php if(!$products) :?>
        <div class="no-product-holder">
            <h3>Sorry, there is no product found!</h3>
            <div>
                <img src="assets/images/searching.png">
            </div>
        </div>
    <?php else :?>
        <?php foreach($products as $product) :?>
            <div class="search-holder">
                <a href="shop.php?shopMyproduct=<?php echo htmlspecialchars(urldecode($product['id'])); ?>&addToCart=productItem&cartItem=<?php echo urldecode(uniqid(rand(111111111, 99999999))); ?>">
                <div>
                    <img src="assets/products/<?php echo $product['product_image']; ?>" alt="product-cloth">
                </div>
                <div>
                    <p><?php echo $product['product_name']; ?></p>
                    <p>$<?php echo $product['product_new_price']; ?></p>
                </div>                                                   
                </a>
            </div>
        <?php endforeach; ?>  
    <?php endif; ?>    
  </div>
</section>
    
<?php include('template/footer.php'); ?>