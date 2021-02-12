<?php

    include('./config/db_connect.php');
    
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    $userid = $_SESSION['id'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $upload = $_SESSION['upload'];


    $profileFirstName = $profileLastName = $profileEmail = '';
    $errors = ['firstname' => '', 'lastname' => '', 'email' => ''];
    $res = ['message' => ''];

    if (isset($_POST['submit'])) {
    
        if (empty($_POST['firstname'])) {
            $errors['firstname'] = 'Required*';
        } else {
            $profileFirstName = $_POST['firstname'];
      
            if (!preg_match('/^[a-zA-Z]+$/', $profileFirstName)) {
                $errors['firstname'] = 'firstname must be letters only';
            }
        }

        if (empty($_POST['lastname'])) {
            $errors['lastname'] = 'Required*';
        } else {
            $profileLastName = $_POST['lastname'];

          if (!preg_match('/^[a-zA-Z]+$/', $profileLastName)) {
              $errors['lastname'] = 'lastname must be letters only';
          }
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'Required*';
        } else {

            $profileEmail = $_POST['email'];

            if (!filter_var($profileEmail, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'email must be valid email address';
            } 
        }

       if (!array_filter($errors)) {
           $profileFirstName = mysqli_real_escape_string($conn, $_POST['firstname']);
           $profileLastName = mysqli_real_escape_string($conn, $_POST['lastname']);
           $profileEmail = mysqli_real_escape_string($conn, $_POST['email']);
           $uploads = mysqli_real_escape_string($conn, $_POST['upload']);

           $sql = "UPDATE account SET firstname = '$profileFirstName', lastname = '$profileLastName', 
                   emailaddress = '$profileEmail', uploads = '$uploads' WHERE id = $userid";

            if (mysqli_query($conn,$sql)) {
                $res['message'] = 'profile undated successfully';
                header('location: dashboard.php');
            } else {
                header('location: profile.php');
            }


            if (isset($_GET['id'])) {

                $userid = mysqli_real_escape_string($conn,  $_GET['id']);
        
                // make sql
                $sql = "SELECT * FROM account WHERE id = '$userid'";
                
                // get the query result
                $result  = mysqli_query($conn, $sql);
        
                // fetch result in an array
                $user = mysqli_fetch_ASSOC($result);
                mysqli_free_result($result);
                mysqli_close($conn);
        
            }
       }

        // upload profile image to database

        // $pname = rand(1000, 10000)."-". $_FILES['upload']['name'];
        // $tname = $_FILES['upload']['tem_name'];

        // $upload_dir = '../assets/uploads/';

        
        // move_uploaded_file($tname, $upload_dir.'/'.$pname);

        // $sql = "SELECT * FROM account WHERE id = '$userid'";
        

        // $insert_sql_upload = "INSERT INTO account(uploads) VALUES('$pname') WHERE id = '$userid'";

        // if (mysqli_query($conn, $sql)) {
        //     echo 'image uploaded successfully';
        // } else {
        //     echo 'Error while try upload image';
        // }

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Extorex/<?php echo htmlspecialchars($firstname); ?> profile</title>
    <link rel="stylesheet" href="assets/styles/profile.css">
</head>
<body>

    <?php include('template/dashboard/header_admin.php');?>

    <?php include('template/dashboard/dashboard_admin.php');?>
    


    <main id="main_body">
    <div class="profile_background_cover"></div>  
        <form action="profile.php" method="POST">
            <label for="firstname">firstname</label>
            <input type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo $profileFirstName;?>">
            <p id="firstNameFeedBack"><?php echo $errors['firstname']; ?></p>
            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname" placeholder="lastname" value="<?php echo $profileLastName;?>">
            <p id="lastNameFeedBack"><?php echo $errors['lastname']; ?></p>
            <label for="email">email</label>
            <input type="email" name="email" id="email" placeholder="email" value="<?php echo $profileEmail;?>">
            <p id="emailFeedBack"><?php echo $errors['email']; ?></p>
            <label for="upload">upload image</label><br>
            <input type="file" name="upload" id="upload" value="<?php echo $uploads;?>">
            <p id="uploadErr"><?php echo $errors['upload']; ?></p>
            <button name="submit">submit</button>
        </form>
    </main>

    <script src="assets/js/dashboard_admin.js"></script>
</body>
</html>