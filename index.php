<?php

    include('./config/db_connect.php');
    error_reporting(E_ALL ^ E_NOTICE);

?>

<html lang="en">

  <?php include('template/header.php'); ?>

  <?php include('heroSection.php'); ?>
  
  <?php include('category.php'); ?>

  <?php include('template/nav.php'); ?>

  <?php include('product_collection.php'); ?>
    
  <?php include('gallery.php'); ?>

  <?php include('fast_seller.php'); ?>

  <?php include('discount.php'); ?>

  <?php include('newsletter.php'); ?>
    
  <?php include('template/footer.php'); ?>

</html>