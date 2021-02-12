<?php

    error_reporting(E_ALL ^ E_NOTICE);
    session_start();

    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];
    $uploads = $_SESSION['upload'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estorex/dashboard</title>
    <link rel="stylesheet" href="././assets/styles/dashboard.css">
</head>
<body>


    <aside class="aside_nav">
        <h1 id="header"><a href="index.php">Estorex</a></h1>

        <div id="user_holder">
            <div class="image_profile_holder"><img src="assets/images/avatar.png" alt="profile_photo"></div>
            <h4>
            <span><?php echo htmlspecialchars($firstname); ?></span>
            <span><?php echo htmlspecialchars($lastname); ?></span>
            </h4> 
            <h4><?php echo htmlspecialchars($email); ?></h4>
        </div>

        <div class="dashboard_conponents">
            <p><a href="dashboard.php">Dashboard</a></p>
            <p><a href="profile.php">Profile</a></p>
            <p><a href="#">Conponents</a></p>
            <p><a href="add_sale_product.php">Add sales</a></p>
            <p><a href="#">Calender</a></p>
            <p><a href="#">Settings</a></p>
        </div>
    </aside>
    
</body>
</html>