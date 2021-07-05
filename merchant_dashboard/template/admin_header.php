<?php
    
    error_reporting(E_ALL ^ E_NOTICE);
    
    include('../config/db_connect.php');

    $user_id = $_SESSION['id'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $email = $_SESSION['email'];

    $sql = "SELECT uploads FROM account WHERE id = '$user_id'";

    $result = mysqli_query($conn, $sql);

    $profile_image = mysqli_fetch_assoc($result);

    $sql1 = "SELECT DISTINCT orderId FROM order_item INNER JOIN customer WHERE  merchant_product_email = '$email'";

    $results = mysqli_query($conn, $sql1);

    $count = mysqli_num_rows($results);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Estorex an E-commerce website for buying and selling products">
        <meta name="keywords" content="CSS,JavaScript,PHP,MYSQL">
        <meta name="keywords" content="justice foundation">
        <meta name="author" content="Justice Chimobi">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./styles/admin_header.css">
        <link rel="stylesheet" href="./styles/index.css">
        <link rel="stylesheet" href="./styles/profile.css">
        <link rel="stylesheet" href="./styles/add_sale_product.css">
        <link rel="stylesheet" href="./styles/orders.css">
        <link rel="stylesheet" href="./styles/view_orders.css">
        <link rel="stylesheet" href="./styles/admin_footer.css">
        <title>Estorex/dashboard</title>
    </head>
        <nav id="navbar">
            <div class="menu-holder">
                <div id="menu-icon">
                    <div class="icon"></div>
                    <div class="icon"></div>
                    <div class="icon"></div>
                </div>
                <div id="close-icon">
                    <div class="icon"></div>
                    <div class="icon icon2"></div>
                    <div class="icon"></div>
                </div>
            </div>
            <div class="user-profile">
                <p><small><?php echo $fullname; ?></small></p>
                <div class="user-profile-photo">
                    <?php if (!$profile_image['uploads']) : ?>
                        <img src="../assets/images/avatar.png" alt="profile">
                    <?php elseif ($profile_image['uploads']) : ?>
                        <img src=".././assets/profiles/<?php echo htmlspecialchars($profile_image['uploads']); ?>">
                    <?php else :?>    
                        <img src="../assets/images/avatar.png" alt="profile">
                    <?php endif ;?>
                </div>    
            </div>
        </nav>
        <!-- mobile navbar -->
        <nav id="navbar-mobile">
            <div class="menu-holder-mobile">
                <div id="menu-icon-mobile">
                    <div class="icon-mobile"></div>
                    <div class="icon-mobile icon2-mobile"></div>
                    <div class="icon-mobile"></div>
                </div>
            </div>
            <div class="user-profile-mobile">
                <p class="text-dark"><small><?php echo $fullname; ?></small></p>
                <div class="user-profile-photo-mobile">
                    <?php if (!$profile_image['uploads']) : ?>
                        <img src="../assets/images/avatar.png" alt="profile">
                    <?php elseif ($profile_image['uploads']) : ?>
                        <img src=".././assets/profiles/<?php echo htmlspecialchars($profile_image['uploads']); ?>">
                    <?php else :?>    
                        <img src="../assets/images/avatar.png" alt="profile">
                    <?php endif ;?>
                </div>    
            </div>
        </nav>

        <aside class="aside-nav-mobile">
            <div class="aside-nav-header">
                <h1 id="header"><a href="../index.php" class="text-white">Estorex</a></h1>
                <div id="close-icon-mobile">&times;</div>
            </div>

            <ul class="mobile-dashboard_conponents-list">
                <li><a href="./index.php">Dashboard</a></li>
                <li><a href="./profile.php">Profile</a></li>
                <li><a href="./add_sale_product.php">Add sales</a></li>
                <?php if ($count == 0) :?>
                    <li><a href="./orders.php">Orders <?php echo ''; ?></a></li>
                <?php else :?>
                    <li><a href="./orders.php">Orders <?php echo "(" . $count . ")"; ?></a></li>
                <?php endif;?>
                <li><a href="#">Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </aside>

        <!-- END OF MOBILE  -->

        <aside class="aside_nav">
            <h1 id="header"><a href="../index.php">Estorex</a></h1>

            <div id="user_holder">
                <?php if (!$profile_image['uploads']) : ?>
                    <div class="image_profile_holder"><img src=".././assets/images/avatar.png" alt="profile"></div>
                <?php elseif ($profile_image['uploads']) : ?>
                    <div class="image_profile_holder"><img src=".././assets/profiles/<?php echo htmlspecialchars($profile_image['uploads']); ?>" alt="profile"></div>
                <?php else :?> 
                    <div class="image_profile_holder"><img src=".././assets/images/avatar.png" alt="profile"></div>
                <?php endif ;?>

                <h4>
                <span><?php echo htmlspecialchars($firstname); ?></span>
                <span><?php echo htmlspecialchars($lastname); ?></span>
                </h4> 
                <h4><?php echo htmlspecialchars($email); ?></h4>
            </div>
            
            <ul class="dashboard_conponents">
                <li><a href="./index.php">Dashboard</a></li>
                <li><a href="./profile.php">Profile</a></li>
                <li><a href="./add_sale_product.php">Add sales</a></li>
                <?php if ($count == 0) :?>
                    <li><a href="./orders.php">Orders <?php echo '';?></a></li>
                <?php else :?>
                    <li><a href="./orders.php">Orders <?php echo "(" . $count . ")";?></a></li>
                <?php endif;?>
                <li><a href="#">Settings</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </aside>


        <main class="main-body">