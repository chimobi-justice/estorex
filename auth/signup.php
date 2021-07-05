<?php include('../template/functions.php'); ?>

<?php

  include('../config/db_connect.php');

  $firstname = $lastname = $email = $password = '';
  $errors = ['firstname' => '', 'lastname' => '', 'email' => '', 'password' => ''];
  $res = ['message' => '']; 

  if (isset($_POST['submit'])) {

    if (empty($_POST['firstname'])) {
      $errors['firstname'] = 'Required*';
    } else {

      $firstname = $_POST['firstname'];
      if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
        $errors['firstname'] = 'firstname must be letters only';
      }
    }
    if (empty($_POST['lastname'])) {
      $errors['lastname'] = 'Required*';
    } else {

      $lastname = $_POST['lastname'];
      if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
        $errors['lastname'] = 'lastname must be letters only';
      }
    }
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
      $firstname = escape_string($conn, $_POST['firstname']);
      $lastname = escape_string($conn, $_POST['lastname']);
      $email = escape_string($conn, $_POST['email']);
      $password = escape_string($conn, $_POST['password']);
      $hash_password = md5($password);


        $sql = "SELECT emailaddress FROM account WHERE emailaddress = '$email'";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
          $res['message'] = 'Email Address Already Exit';
        } else {
            $sql = "INSERT INTO account(`firstname`,
                                      `lastname`,
                                      `emailaddress`, 
                                      `psw`, 
                                      `account`)
                              VALUES('$firstname', 
                                    '$lastname',
                                    '$email', 
                                    '$hash_password', 
                                    'user')";
                                      
            $result = mysqli_query($conn, $sql);

            if ($result) {
              $res['message'] = 'Account created successfully, please login';
              $firstname = '';
              $lastname = '';
              $email = '';
              $password = '';
            } 
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
  <link rel="stylesheet" href="../assets/styles/signup.css">
  <title>Estorex/signup page</title>
</head>
<body>
  <div class="signup_container">
      <div id="signup_contact_holder">
          <h1><a href="../index.php" title="Estorex - home">Estorex</a></h1>
          <p><i>signup to create your account</i></p>
          <div>
              <?php if (!$res) :?>
                  <p></p>
              <?php elseif ($res['message'] === 'Account created successfully, please login'):?>
                  <p class="response success"><?php echo $res['message']?></p>
              <?php elseif ($res['message'] === 'Email Address Already Exit'):?>
                  <p class="response err"><?php echo $res['message']?></p>
              <?php else :?>
                  <p><?php echo $res['message']?></p>
              <?php endif;?>  
          </div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="signup">
          <label for="firstname">firstname</label>
          <input type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo htmlspecialchars($firstname); ?>">
          <p id="firstNameFeedBack"><?php echo $errors['firstname']; ?></p>
          <label for="lastname">lastname</label>
          <input type="text" name="lastname" id="lastname" placeholder="lastname" value="<?php echo htmlspecialchars($lastname); ?>">
          <p id="lastNameFeedBack"><?php echo $errors['lastname']; ?></p>
          <label for="email">email</label>
          <input type="email" name="email" id="email" placeholder="email address" value="<?php echo htmlspecialchars($email); ?>">
          <p id="emailFeedBack"><?php echo $errors['email']; ?></p>
          <label for="psw">password</label>
          <input type="password" name="password" id="psw" placeholder="password" value="<?php echo htmlspecialchars($password); ?>">
          <p id="pswFeedBack"><?php echo $errors['password']; ?></p>
          <button type="submit" name="submit" id="btn_submit" class="show_btn handleSignupBtn">signup</button><br>
          <p  class="signup-content">Already a user? <a href="login.php"> Login</a></p>
        </form>
      </div>
  </div>

  <script src="../assets/js/signup.js"></script>

</body>
</html>

  