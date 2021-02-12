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

        if (!preg_match('/^[a-zA-Z]+[0-9]+$/', $password)) {
          $errors['password'] = 'password must be letters and numbers';
        }
      }
    }

    if (!array_filter($errors)) {
      $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
      $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $hash_password = md5($password);

      $sql = "SELECT emailaddress FROM account WHERE emailaddress = '$email'";
      $result = mysqli_query($conn, $sql);
      $count = mysqli_num_rows($result);

      if ($count > 0) {
        $errors['email'] = 'Email already exit';
      } else {
        $sql = "INSERT INTO account(firstname, lastname, emailaddress, psw) VALUES('$firstname', '$lastname', '$email', '$hash_password')";
        $result = mysqli_query($conn, $sql);

        if ($result === true) {
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


<head>
  <title>Estorex/signup</title>
  <link rel="stylesheet" href="../assets/styles/signup.css">
</head>

<div class="signup_container">
  <div class="signup_img_holder">
    <div id="signup_content">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam voluptas a cumque expedita obcaecati! Doloribus, culpa perspiciatis! Facere, reprehenderit tempore.</div>
    <div id="signup_img_wrapper"><img src="../assets/images/signup.png" alt="sign-illustratrion"></div>
  </div>

  <div id="signup_contact_holder">
    <h1><a href="../index.php" title="Estorex - home">Estorex</a></h1>
    <div>
      <?php if (!$res['message']) :?>
            <div id="successResponseText"></div>
          <?php elseif ($res['message'] === 'Account created successfully, please login'):?>
            <div id="successResponseText" style="background: green;color:lightgreen; padding:16px;width: 57%;margin: auto;"><?php echo $res['message']?></div>
          <?php else :?>
            <div><p><?php echo $res['message']?></p></div>
          <?php endif;?>  
    </div>
    <form action="signup.php" method="POST" id="signup">
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
      <button type="submit" name="submit" id="btn_submit" class="show_btn">signup</button><br>
      <p  class="signup-content">Already a user <a href="login.php"> Login here</a></p>
      <p class="signup-content-inform">firstname and lastname must be letters only</p>
      <p class="signup-content-inform">password must be 6 characters with a number</p>
    </form>
  </div>
</div>


<script src="../assets/js/signup.js"></script>