<?php
  
  error_reporting(E_ALL ^ E_NOTICE);    
  include('../config/db_connect.php');

  $user_id = $_SESSION['id'];
  $f = $_SESSION['firstname'];
  $l = $_SESSION['lastname'];

  $sql = "SELECT uploads FROM account WHERE id = '$user_id'";
  
  $result = mysqli_query($conn, $sql);

  $profile_image = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Estorex an E-commerce website for buying and selling products">
  <meta name="keywords" content="CSS,JavaScript,PHP,MYSQL">
  <meta name="keywords" content="justice foundation">
  <meta name="author" content="Justice Chimobi">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estorex / Dashboard</title>
  <link rel="stylesheet" href="./styles/header.css">
  <link rel="stylesheet" href="./styles/herosection.css">
  <link rel="stylesheet" href="./styles/user_product_collection.css">
  <link rel="stylesheet" href="./styles/profile.css">
  <link rel="stylesheet" href="./styles/shop_product.css">
  <link rel="stylesheet" href="./styles/search.css">
  <link rel="stylesheet" href="./styles/cart.css">
  <link rel="stylesheet" href="./styles/gender_category.css">
  <link rel="stylesheet" href="./styles/checkout.css">
  <link rel="stylesheet" href="./styles/checkout_fields.css">
  <link rel="stylesheet" href="./styles/newsletter.css">
  <link rel="stylesheet" href="./styles/footer.css">
</head>
<body>

  <!-- navigation bar -->

  <nav id="headerNavBar">
      <div class="headerBrandWrapper">
          <h1 class="brand-holder"><a href="../index.php" id="brand-name"><i>Estorex</i></a></h1>
          <div id="menu_icon">
              <div class="icon"></div>
              <div class="icon"></div>
              <div class="icon"></div>
          </div>
      </div>
      <ul>
          <li>
              <form action="search.php" method="get">
                    <input type="text" name="search" id="search" placeholder="search products....." value="<?php echo htmlspecialchars($searchQuery); ?>">
              </form>
          </li>
          <li><a href="cart.php">c</a></li>
          <?php if (!$profile_image['uploads']) : ?>
              <li><a href="#" class="profile_image" id="openProfileModal"><img src=".././assets/images/avatar.png"> <span class="arrow down"></span></a></li>
          <?php elseif ($profile_image['uploads']) : ?>
              <li><a href="#" class="profile_image" id="openProfileModal"><img src=".././assets/profiles/<?php echo htmlspecialchars($profile_image['uploads']); ?>"> <span class="arrow down"></span></a></li>
          <?php else :?> 
              <li><a href="#" class="profile_image" id="openProfileModal"><img src=".././assets/images/avatar.png"> <span class="arrow down"></span></a></li>     
          <?php endif ;?>
      </ul>
      <div id="profileBox">
        <ul>
          <li><a href="./profile.php">profile</a></li>
          <li><a href="../logout.php">logout</a></li>
        </ul>
      </div>
  </nav>

  <aside id="asideNav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="gender_category.php?gender_product_collection=men&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Men</a></li>
        <li><a href="gender_category.php?gender_product_collection=women&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Women</a></li>
        <li><a href="gender_category.php?gender_product_collection=watches&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Watches</a></li>
        <li><a href="gender_category.php?gender_product_collection=bag&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Bags</a></li>
        <li><a href="gender_category.php?gender_product_collection=electronics&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Electronics</a></li>
        <li><a href="../contact.php">Contact us</a></li>
      </ul>
  </aside>

  <div id="hambuger">
      <div>
        <h1><a href="../index.php">Estorex</a></h1>
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
          <li><a href="../about.php">About</a></li>
          <li><a href="gender_category.php?gender_product_collection=men&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Men</a></li>
          <li><a href="gender_category.php?gender_product_collection=women&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Women</a></li>
          <li><a href="gender_category.php?gender_product_collection=watches&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Watches</a></li>
          <li><a href="gender_category.php?gender_product_collection=bag&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Bags</a></li>
          <li><a href="gender_category.php?gender_product_collection=electronics&collectionproducts=<?php echo uniqid(rand(111111111, 999999999)); ?>">Electronics</a></li>
          <li><a href="../contact.php">Contact us</a></li>
          <li><a href="cart.php">cart</a></li>
          <?php if (!$profile_image['uploads']) : ?>
              <li><a href="#" class="profile_image" id="mobileProfileModal"><img src=".././assets/images/avatar.png"> <span class="mobileArrow down"></span></a></li>
          <?php elseif ($profile_image['uploads']) : ?>
              <li><a href="#" class="profile_image" id="mobileProfileModal"><img src=".././assets/profiles/<?php echo htmlspecialchars($profile_image['uploads']); ?>"> <span class="mobileArrow down"></span></a></li>
          <?php else :?> 
              <li><a href="#" class="profile_image" id="mobileProfileModal"><img src=".././assets/images/avatar.png"> <span class="mobileArrow down"></span></a></li>     
          <?php endif ;?>
        </ul>
        <div id="mobileProfileBox">
              <ul>
                <li><a href="./profile.php">profile</a></li>
                <li><a href="../logout.php">logout</a></li>
              </ul>
            </div>
      </div>
    </div>
