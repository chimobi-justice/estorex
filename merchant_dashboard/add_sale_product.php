<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>
<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    $user_id = $_SESSION['id'];
    $merchant_product_email = $_SESSION['email'];

    $productName = $productDescription = $productNewPrice = $productOldPrice = $category = $subCategory = '';

    $errors = ['name' => '', 'description' => '', 'newPrice' => '', 'oldPrice' => ''];
    $res = ['message' => ''];

    if (isset($_POST['submit'])) {

        if (empty($_POST['productName'])) { $errors['name'] = 'Please Enter a product name';} else { $productName = $_POST['productName']; }

        if (empty($_POST['description'])) { $errors['description'] = 'Please Add A Description'; } else { $productDescription = $_POST['description']; }
        
        if (empty($_POST['newPrice'])) { $errors['newPrice'] = 'Please Enter your new Price'; } else { $productNewPrice = $_POST['newPrice']; }

        if (empty($_POST['oldPrice'])) { $errors['oldPrice'] = 'Please Enter your old Price'; } else { $productOldPrice = $_POST['oldPrice']; }

        $category = $_POST['category'];

        $subCategory = $_POST['subCategory'];


        $fileName = $_FILES['uploaded_file']['name'];
        $fileTempLoc = $_FILES['uploaded_file']['tmp_name'];
        $fileType = $_FILES['uploaded_file']['type'];
        $fileSize = $_FILES['uploaded_file']['size'];


        if (!$fileTempLoc) {
            $res['message'] = 'Error: please browse for a file before clicking the Submit button';
        } elseif ($fileSize > 500000) {
            $res['message'] = 'Sorry, large files can\'t be uploaded';
        }


        if (!array_filter($errors)) {
            $productName = escape_string($conn, $_POST['productName']);
            $productNewPrice = escape_string($conn, $_POST['newPrice']);
            $productOldPrice = escape_string($conn, $_POST['oldPrice']);
            $productDescription = escape_string($conn, $_POST['description']);
            $category = escape_string($conn, $_POST['category']);
            $subCategory = escape_string($conn, $_POST['subCategory']);

            $rndNum = rand(111111111, 99999999)."-".$fileName;

            $move_result = move_uploaded_file($fileTempLoc, "../assets/products/$rndNum");

            if ($move_result != true) { $res['message'] = 'ERROR: file not uploaded please try again'; }

            $sql = "INSERT INTO products(product_name,
                                         product_description,
                                         product_new_price, 
                                         product_old_price,
                                         category, 
                                         sub_category,
                                         merchant_product_email,
                                         product_image, 
                                         product_id) 
                                VALUES('$productName',
                                        '$productDescription', 
                                        '$productNewPrice', 
                                        '$productOldPrice', 
                                        '$category',
                                        '$subCategory',
                                        '$merchant_product_email',
                                        '$rndNum', 
                                        '$user_id')";
            $result = mysqli_query($conn, $sql);

            if ($result) { $res['message'] = 'Sales Added Successfully'; } else { $res['message'] = 'Sorry Error while adding Your Sales'; }
        }

    }

?>


<?php include('template/admin_header.php'); ?>

        <div>
            <?php if (!$res): ?>
                <p></p>      
            <?php elseif($res['message'] === 'Sales Added Successfully'): ?> 
                <p class="response success"><?php echo $res['message']; ?></p>
            <?php elseif($res['message'] === 'Sorry Error while adding Your Sales'): ?>
                <p class="response err"><?php echo $res['message']; ?></p>
            <?php elseif($res['message'] === 'ERROR: file not uploaded please try again'): ?>
                <p class="response err"><?php echo $res['message']; ?></p>   
            <?php elseif($res['message'] === 'Error: please browse for a file before clicking the Submit button'): ?>
                <p class="response err"><?php echo $res['message']; ?></p>      
            <?php elseif($res['message'] === 'Sorry, Large files can\'t be uploaded'): ?>
                <p class="response"><?php echo $res['message']; ?></p>             
            <?php else: ?>
                <p></p>       
            <?php endif; ?>

        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="addSaleForm" method="POST" enctype="multipart/form-data">
            <div class="wrapper">
                <div class="form-group-container">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="productName" id="product_name" placeholder="Enter a product name">
                    <p id="productNameFeedBack" class="notice"><?php echo htmlspecialchars($errors['name']); ?></p> 
                </div>
                <div class="form-group-container">
                    <label for="price">Enter New Price</label>
                    <input type="text" name="newPrice" id="newPrice" placeholder="Enter a new price">
                    <p id="newPriceFeedBack" class="notice"><?php echo htmlspecialchars($errors['newPrice']); ?></p>
                </div>
            </div>
            <div class="wrapper">
                <div class="form-group-container">
                    <label for="price">Enter Old Price</label>
                    <input type="text" name="oldPrice" id="oldPrice" placeholder="Enter a old price">
                    <p id="oldPriceFeedBack" class="notice"><?php echo htmlspecialchars($errors['oldPrice']); ?></p>
                </div>
                <div class="form-group-container">
                    <label for="category">Categories</label>
                    <select name="category" id="category">
                        <option value="men">Men</option>
                        <option value="women">Women</option>
                        <option value="makeup">Makeup</option>
                        <option value="Hair Care">Hair Care</option>
                        <option value="Skill Care">Skill Care</option>
                        <option value="Drinks">Drinks</option>
                        <option value="Watches">Watches</option>
                        <option value="Clothes">Electronics</option>
                        <option value="Baby">Baby</option>
                        <option value="Clothes">Clothes</option>
                    </select>
                </div>
            </div>
            <div class="form-group-container">
                <label for="subCategory">Sub Categories</label>
                <select name="subCategory" id="subCategory">
                    <option value="shoe">shoe</option>
                    <option value="shirt">shirt</option>
                    <option value="suit">suit</option>
                    <option value="top">top</option>
                    <option value="short">short</option>
                    <option value="crop neck">crop neck</option>
                    <option value="suit">jacket</option>
                    <option value="suit">join suit</option>
                    <option value="Clothes">baby clothes</option>
                    <option value="phone">phone</option>
                    <option value="laptops">laptops</option>
                    <option value="cream">cream</option>
                    <option value="wine">wine</option>
                    <option value="champaign">champaign</option>
                    <option value="jeans">jeans</option>
                    <option value="toys">toys</option>
                    <option value="television">television</option>
                    <option value="sweater">sweater</option>
                    <option value="fridge">fridge</option>
                    <option value="games">games</option>
                    <option value="computer">computer</option>
                    <option value="speaker">speaker</option>
                    <option value="handbag">handbag</option>
                    <option value="schoolbag">schoolbag</option>
                    <option value="fan">fan</option>
                    <option value="cap">cap</option>
                </select>
            </div>
            <div class="form-group-container">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Enter a product description"></textarea>
                <p id="descriptionFeedBack" class="notice"><?php echo htmlspecialchars($errors['description']); ?></p>
            </div>
            <div id="uploadContainer">
                <label for="upload" id="openUploadBox"><span>+</span>upload</label>
                <input type="file" id="upload" name="uploaded_file">
            </div>
            <div id="buttonHolder">
                <button type="submit" name="submit">submit</button>
            </div>
        </form>
 
    <script src="./js/add_sale_product.js"></script>

<?php include('template/admin_footer.php'); ?>