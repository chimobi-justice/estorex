<?php include('../template/functions.php'); ?>

<?php

    session_start();
    include('../config/db_connect.php');

    error_reporting(E_ALL ^ E_NOTICE);

    $email = $password = '';
    $errors = ['email' => '', 'password' => ''];
    $resErr = ['message' => ''];

    if (isset($_POST['submit'])) {
      
      if (empty($_POST['email'])) {
        $errors['email'] = 'Required*';

      } else {

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = 'email must be valid email address';

        }
      }
      if (empty($_POST['password'])) {
        $errors['password'] = 'Required*';

      } else {

        $password = $_POST['password'];

        if (strlen($password) < 6) {
          $errors['password'] = 'password not long enough';

        } else {
            $errors['password'] = '';
        }

      }

      if (!array_filter($errors)) {

        $email = escape_string($conn, $_POST['email']);
        $password = escape_string($conn, $_POST['password']);
        $hash_password = md5($password);

        $sql = "SELECT * FROM account WHERE emailaddress = '$email' AND psw = '$hash_password'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);


        if ($count > 0) {
          $user = mysqli_fetch_assoc($result);

          $_SESSION['id'] = $user['id'];
          $user_id = $_SESSION['id'];
          $_SESSION['firstname'] = $user['firstname'];
          $_SESSION['lastname'] = $user['lastname'];
          $_SESSION['email'] = $user['emailaddress'];

          if ($user['account'] === 'merchant') {
              header('location: ../merchant_dashboard/');
          } elseif ($user['account'] === 'user') {
            header('location: ../user_dashboard/');
          }
          
        } else {

            $res['message'] = 'Wrong Email Address or Password';
        }
      }

    }



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
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=".././assets/styles/login.css">
  <title>Estorex/login page</title>
</head>
<body>

  <div class="signin_container">
      <div id="signin_contact_holder">
        <h1><a href="../index.php" title="Estorex - home">Estorex</a></h1>
        <p><i>Login to your user account</i></p>
        <p id="errResponseText"><?php echo $res['message'] ?></p>
        <form method="POST" id="signin">
          <label for="email">Email Address</label>
          <input type="email" name="email" id="email" placeholder="email address" value="<?php echo htmlspecialchars($email); ?>">
          <p id="emailFeedBack"><?php echo $errors['email']; ?></p>
          <label for="psw">Password</label>
          <input type="password" name="password" id="psw" placeholder="password" value="<?php echo htmlspecialchars($password); ?>">
          <p id="pswFeedBack"><?php echo $errors['password']; ?></p>
          <p id="pswMe"></p>
          <button type="submit" name="submit" id="handleLoginBtn">login</button><br>
          <p class="signin-content">Don't have an account? <a href="signup.php?account=user"> sigup</a></p>
        </form>
      </div>
    </div>

  <script src="../assets/js/login.js"></script>
  
</body>
</html>
