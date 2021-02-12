<?php

    include('./config/db_connect.php');

    $productImg = $productDescription = $productPrice = '';
    $errors = ['description' => '', 'price' => '', 'upload' => ''];
    $res = ['message' => ''];

    if (isset($_POST['submit'])) {

        $ext = $_FILES["file"]["type"];
        $size = $_FILES["file"]["size"];
        $imageName = $_FILES["file"]["name"];

        if (empty($_POST['description'])) {

            $errors['description'] = 'Please Add A Description';
        } else {

            $productDescription = $_POST['description'];
        }
        if (empty($_POST['price'])) {
            $errors['price'] = 'Please Add A Price';

        } else {

            $productPrice = $_POST['price'];
        }

        if ($ext === 'image/jpg' || $ext === 'image/png' || $ext === 'image/gif' || $ext === 'image/JPG' || $ext === 'image/jpeg') {
            if ($sizeOfImage > '5186182') {
                $errors['upload'] = 'Image size too large';
            }

            if (!array_filter($errors)) {
                $productDescription = mysqli_real_escape_string($conn, $_POST['description']);
                $productPrice = mysqli_real_escape_string($conn, $_POST['price']);

                $rndNum = rand(111111111, 999999999)."-".$imageName;
                $tmpName = $_FILES["file"]["tmp_name"];
                $uploads_dir = './assets/uploads';
                move_uploaded_file($tmpName , $uploads_dir.'/'.$rndNum);


                $sql = "INSERT INTO products(productDescription, productPrice, productImage) VALUES('$productDescription', '$productPrice', '$rndNum')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $res['message'] = 'Sales Added Successfully';
                    $productDescription = '';
                    $productPrice = '';
                } else {
                    $res['message'] = mysqli_error($conn);
                }
                mysql_close($conn);
            }
        } else {
            $res['message'] = 'Image Only';
        } 

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Extorex/dashboard/add sales</title>
    <link rel="stylesheet" href="assets/styles/add_sale_product.css">
</head>
<body>

    <?php include('template/dashboard/header_admin.php');?>

    <?php include('template/dashboard/dashboard_admin.php');?>

    <main id="main_body">
        <div class="dash-text-flex">
            <div><h3>Dashboard</h3></div>
            <div>
                <p><a href="index.php">Extorex</a> > <a href="#">Add sales</a></p>
            </div>
        </div>

        <form action="add_sale_product.php" method="POST" ectype="multipart/form-data">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="Description">
            <p id="descriptionFeedBack"><?php echo htmlspecialchars($errors['description']); ?></p>
            <label for="price">Price</label>
            <input type="text" name="price" id="price" placeholder="price">
            <p id="priceFeedBack"><?php echo htmlspecialchars($errors['price']); ?></p>
            <label for="upload">upload product</label><br>
            <input type="file" name="file" id="upload">
            <p id="uploadErr"><?php echo htmlspecialchars($errors['upload']); ?></p>
            <button name="submit">submit</button>
        </form>
    </main>

    <script src="assets/js/dashboard_admin.js"></script>
</body>
</html>