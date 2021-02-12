<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estorex</title>
  <link rel="stylesheet" href="assets/styles/header.css">
  <link rel="stylesheet" href="assets/styles/heroSection.css">
  <link rel="stylesheet" href="assets/styles/index.css">
  <link rel="stylesheet" href="assets/styles/about.css">
  <link rel="stylesheet" href="assets/styles/contact.css">
  <link rel="stylesheet" href="assets/styles/T&C.css">
  <link rel="stylesheet" href="assets/styles/footer.css">
</head>
<body>

  <!-- navigation bar -->
  <nav id="navBar">
    <div class="brand-holder"><a href="index.php#" id="brand-name"><i>Estorex</i></a></div>
    <ul id="midside-nav">
      <li><a href="index.php#">Home</a></li>
      <li><a href="index.php#category">Category</a></li>
      <li><a href="index.php#products">Products</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>
    <div id="rightside-nav">
      <a href="#" id="cart">cart</a>
         <input type="text" list="product" placeholder="search" id="search">
         <button class="btn signin" id="login">Sign in</button>
         <button class="btn" id="signup">Sign up</button>

         <datalist id="product" style="display: none;">
            <option value="Cap">Cap</option>
            <option value="Green shirt">Green shirt</option>
            <option value="Darken jeans">Darken jeans</option>
            <option value="Nike">Nike</option>
            <option value="Adidas">Adidas</option>
            <option value="Shoe">Shoes</option>
            <option value="Baleciaga">Baleciaga</option>
            <option value="Tef">Tef</option>
            <option value="Rocks">Rock</option>
            <option value="Bent">Bent</option>
            <option value="Peplay">Peplay</option>
            <option value="Iphone">Iphone</option>
            <option value="Andriod">Andriod</option>
            <option value="Italy">Laptops</option>
            <option value="Human hair">Human hair</option>
         <datalist>
      <!-- <input type="text" id="search" placeholder="search products"> -->
      <!-- <button class="btn signin" id="login">Sign in</button>
      <button class="btn" id="signup">Sign up</button> -->
    </div>
  </nav>

  <!-- hambuger -->
    <!-- mobile navigation for phones and tablets -->
     <div id="hambuger">
      <div id="brand_for_mobile_holder">
        <a href="#">Estorex</a>
      </div>
      <div>
        <div id="icon_container">
          <div id="menu_icon">
            <div class="icon"></div>
            <div class="icon"></div>
            <div class="icon"></div>
          </div>
            <div class="close_menu_icon">x</div>
        </div>
        <ul id="ham_wrapper_list">
          <li><a href="index.php#about-section">Home</a></li>
          <li><a href="index.php#service">About</a></li>
          <li><a href="index.php#work_section">Products</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="contact.php">Cart</a></li>
          <li><a href="contact.php">Search</a></li>
          <li><a href="contact.php">Signin</a></li>
          <li><a href="contact.php">Signup</a></li>
        </ul>
      </div>
    </div>

