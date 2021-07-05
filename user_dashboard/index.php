<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>

<html>
    
    <?php include('template/header.php'); ?>
    
    <?php include('herosection.php'); ?>
    
    <?php include('user_product_collection.php'); ?>
        
    <?php include('template/footer.php');?>

</html>

