<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Estorex an E-commerce website for buying and selling products">
  <meta name="keywords" content="CSS,JavaScript,PHP,MYSQL">
  <meta name="keywords" content="justice foundation">
  <meta name="author" content="Justice Chimobi">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estorex</title>
  <link rel="stylesheet" href="assets/styles/header.css">
  <link rel="stylesheet" href="assets/styles/nav.css">
  <link rel="stylesheet" href="assets/styles/heroSection.css">
  <link rel="stylesheet" href="assets/styles/category.css">
  <link rel="stylesheet" href="assets/styles/product_collection.css">
  <link rel="stylesheet" href="assets/styles/gallery.css">
  <link rel="stylesheet" href="assets/styles/featured_product.css">
  <link rel="stylesheet" href="assets/styles/fast_seller.css">
  <link rel="stylesheet" href="assets/styles/about.css">
  <link rel="stylesheet" href="assets/styles/discount.css">
  <link rel="stylesheet" href="assets/styles/newsletter.css">
  <link rel="stylesheet" href="assets/styles/gender_category.css">
  <link rel="stylesheet" href="assets/styles/shop.css">
  <link rel="stylesheet" href="assets/styles/search.css">
  <link rel="stylesheet" href="assets/styles/checkout_pay.css">
  <link rel="stylesheet" href="assets/styles/checkout.css">
  <link rel="stylesheet" href="assets/styles/contact.css">
  <link rel="stylesheet" href="assets/styles/T&C.css">
  <link rel="stylesheet" href="assets/styles/footer.css">
</head>
<body>

  <nav id="headerNavBar">
      <div class="headerBrandWrapper">
          <h1 class="brand-holder"><a href="index.php" id="brand-name"><i>Estorex</i></a></h1>
          <div id="menu_icon">
              <div class="icon"></div>
              <div class="icon"></div>
              <div class="icon"></div>
          </div>
      </div>
      <ul>
          <li>
            <form action="search.php" method="get">
                <input type="text" name="search" id="search" placeholder="search products.....">
            </form>
          </li>
          <li><a href="auth/login.php" class="btn signin" id="login"><i class="fa fa-sign-in" aria-hidden="true"></i> </a></li>
          <li><a href="auth/signup.php?account=user" class="btn" id="signup"><i class="fa fa-user-plus" aria-hidden="true"></i> </a></li>
      </ul>
  </nav> 

  <aside id="asideNav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="gender_category.php?gender_product_collection=men&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Men</a></li>
        <li><a href="gender_category.php?gender_product_collection=women&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Women</a></li>
        <li><a href="gender_category.php?gender_product_collection=watches&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Watches</a></li>
        <li><a href="gender_category.php?gender_product_collection=bag&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Bags</a></li>
        <li><a href="gender_category.php?gender_product_collection=electronics&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Electronics</a></li>
        <li><a href="contact.php">Contact us</a></li>
      </ul>
  </aside>


  <!-- hambuger  -->
  <div id="hambuger">
      <div>
        <h1><a href="index.php">Estorex</a></h1>
      </div>
      <div>
        <div id="icon_container">
          <div id="mobile_menu">
            <div class="mobile_icon"></div>
            <div class="mobile_icon"></div>
            <div class="mobile_icon"></div>
          </div>
            <div class="close_menu">x</div>
        </div>
        <ul id="hambuger_wrapper_list">
          <li>
            <form action="search.php" method="get">
                <input type="text" name="search" id="search" placeholder="search products.....">
            </form>
          </li>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="gender_category.php?gender_product_collection=men&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Men</a></li>
          <li><a href="gender_category.php?gender_product_collection=women&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Women</a></li>
          <li><a href="gender_category.php?gender_product_collection=watches&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Watches</a></li>
          <li><a href="gender_category.php?gender_product_collection=bag&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Bags</a></li>
          <li><a href="gender_category.php?gender_product_collection=electronics&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Electronics</a></li>
          <li><a href="contact.php">Contact us</a></li>
          <li><a href="auth/login.php" class="btn signin" id="login"><i class="fa fa-sign-in" aria-hidden="true"></i>Login</a></li>
          <li><a href="auth/signup.php?account=user" class="btn" id="signup"><i class="fa fa-user-plus" aria-hidden="true"></i>Sign up</a></li>
        </ul>
      </div>
    </div>