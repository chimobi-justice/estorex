<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>
<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    $user_id = $_SESSION['id'];

    $sql = "SELECT * FROM products WHERE product_id = $user_id";

    $results = mysqli_query($conn, $sql);

    $products = mysqli_fetch_all($results, MYSQLI_ASSOC);

    if (isset($_POST['cancelCartItem'])) { header('location: index.php'); }

    if (isset($_POST['removeCart'])) {
        $product = $_POST['removeId'];
            
        $removeCartProduct = "DELETE FROM products WHERE id = '$product'";
    
        if (mysqli_query($conn, $removeCartProduct)) {
            header('location: index.php?removeItem=' . urlencode(uniqid(rand(111111111,000000000))));
        } else {
            $response['message'] = 'can\'t remove item try again';
        }
     
    }


?>


<?php include('template/admin_header.php'); ?>

<!-- start response message -->

        <?php if (isset($_GET['removeItem'])):?>
            <p class="response success"><?php echo 'Item remove Successfully!' ?></p>
        <?php else :?>
            <p></p>
        <?php endif; ?>

        <!-- end response message-->

        <div class="dashboard-option-text">
            <div><h3><a href="index.php">Dashboard</a></h3></div>
        </div>

        <?php if (isset($_GET['removeproduct'])) :?>

            <?php  $productId = $_GET['removeproduct']; ?>
        
            <div id="response">
                <p>Are you sure you want to remove the product!</p>
                <div class="flexBtn">
                    <form method="POST">
                        <input type="hidden" name="removeId" value="<?php echo $productId; ?>">
                        <button type="submit" name="cancelCartItem" class="cancelCart">cancel</button>
                        <button type="submit" name="removeCart" class="removeCart">remove</button>
                    </form>
                </div>
            </div>

        <?php endif; ?>


        <?php if ($products): ?>
            <h3 id="product_text">Products</h3>
        <?php else :?>
            <h3 id="product_text">Welcome To Estorex</h3>
            <div id="buttonHolder">
                <a href="add_sale_product.php">Click here to add a product</a>
            </div>
        <?php endif;?>

        <div class="container_wrapper">
            <?php foreach ($products as $row) : ?>
                <a href="index.php?removeproduct=<?php echo htmlspecialchars($row['id']); ?>&productnumItem=<?php echo urlencode(uniqid(rand(111111111, 99999999))); ?>">
                    <div class="container">
                        <div>
                            <img src=".././assets/products/<?php echo htmlspecialchars($row['product_image']); ?>">
                            <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                            <p class="price"><?php echo htmlspecialchars($row['product_price']); ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>  
        </div>

<?php include('template/admin_footer.php'); ?>
