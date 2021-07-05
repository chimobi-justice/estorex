<?php include('../template/functions.php'); ?>
<?php startSession(); ?>
<?php comfirm_user_logged_in('../index.php');?>
<?php

    error_reporting(E_ALL ^ E_NOTICE);
    include('../config/db_connect.php');

    $userid = $_SESSION['id'];
    $f = $_SESSION['firstname'];
    $l = $_SESSION['lastname'];
    $e = $_SESSION['email'];

    $profileFirstName = $profileLastName = $profileEmail  = '';
    $errors = ['firstname' => '', 'lastname' => '', 'email' => '', 'upload' => ''];
    $res = ['message' => ''];

    if (isset($_POST['submit'])) {
    
        if (empty($_POST['firstname'])) {
            $errors['firstname'] = 'Required*';
        } else {
            $profileFirstName = $_POST['firstname'];
            $f = trim($profileFirstName);
      
            if (!preg_match('/^[a-zA-Z]+$/', $profileFirstName)) { $errors['firstname'] = 'firstname must be letters only'; }
        }

        if (empty($_POST['lastname'])) {
            $errors['lastname'] = 'Required*';
        } else {
            $profileLastName = $_POST['lastname'];
            $l = trim($profileLastName);

           if (!preg_match('/^[a-zA-Z]+$/', $profileLastName)) { $errors['lastname'] = 'lastname must be letters only'; }
        }

        if (empty($_POST['email'])) {
            $errors['email'] = 'Required*';
        } else {
            $profileEmail = $_POST['email'];
            $e = trim($profileEmail);

            if (!filter_var($profileEmail, FILTER_VALIDATE_EMAIL)) { $errors['email'] = 'email must be valid email address'; } 
        }

        $uploadImage = $_FILES['profile_image']['name'];
        $uploadTmpImageLoc = $_FILES['profile_image']['tmp_name'];
        $uploadImageSize = $_FILES['profile_image']['size'];
        $uploadImageType = $_FILES['profile_image']['type'];


        if (!$uploadTmpImageLoc) {
            $res['message'] = 'Please choose a file before submit';
        } elseif ($imageSize > 500000) {
            $res['message'] = 'Sorry, file can\'t be uploaded';
        }

       if (!array_filter($errors)) {
           $profileFirstName = escape_string($conn, $_POST['firstname']);
           $profileLastName = escape_string($conn, $_POST['lastname']);
           $profileEmail = escape_string($conn, $_POST['email']);

           $rndNum = rand(111111111, 99999999)."-".$uploadImage;

           $move_result = move_uploaded_file($uploadTmpImageLoc, "../assets/profiles/$rndNum");

           if ($move_result != true) { $res['message'] = 'ERROR: file not uploaded please try again'; }


            $userEmail = "SELECT * FROM account WHERE emailaddress =  '$profileEmail'";
            $userEmailIdRow = mysqli_query($conn, $userEmail);
            $countUser = mysqli_num_rows($userEmailIdRow);

            if ($countUser > 0) {
                $sql = "UPDATE account SET firstname = '$profileFirstName', lastname = '$profileLastName', 
                emailaddress = '$profileEmail', uploads = '$rndNum' WHERE id = $userid";

                if (mysqli_query($conn, $sql)) { $res['message'] = 'profile undated successfully'; } 
            } else {
                return false;
            }      
       }

    }


?>

<?php include('template/admin_header.php'); ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="profileForm" method="POST" enctype="multipart/form-data">
            <div>
                <?php if (!$res): ?>
                    <p></p>
                <?php elseif($res['message'] === 'profile undated successfully'): ?> 
                    <p class="response success"><?php echo $res['message']; ?></p>        
                <?php elseif($res['message'] === 'ERROR: file not uploaded please try again'): ?> 
                    <p class="response err"><?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'Sorry, file can\'t be uploaded'): ?>
                    <p class="response "><?php echo $res['message']; ?></p>       
                <?php elseif($res['message'] === 'Please choose a file before submit'): ?>
                    <p class="response err"><?php echo $res['message']; ?></p>
                <?php elseif($res['message'] === 'ERROR: file not uploaded please try again!'): ?>
                    <p class="response err"><?php echo $res['message']; ?></p>           
                <?php else: ?>
                    <p></p>       
                <?php endif; ?>
            </div>
    
            <div class="form-group-container">
                <label for="firstname">firstname</label>
                <input type="text" name="firstname" id="firstname" placeholder="firstname" value="<?php echo $f; ?>">
                <p id="firstNameFeedBack" class="notice"><?php echo $errors['firstname']; ?></p>
            </div>
            <div class="form-group-container">
                <label for="lastname">lastname</label>
                <input type="text" name="lastname" id="lastname" placeholder="lastname" value="<?php echo $l; ?>">
                <p id="lastNameFeedBack" class="notice"><?php echo $errors['lastname']; ?></p>
            </div>
            <div class="form-group-container">
                <label for="email">email</label>
                <input type="email" name="email" id="email" placeholder="email" value="<?php echo $e; ?>">
                <p id="emailFeedBack" class="notice"><?php echo $errors['email']; ?></p>
            </div>
            <div id="uploadContainer">
                <label for="upload" id="openUploadBox"><span>+</span>upload</label>
                <input type="file" id="upload" name="profile_image">
                <p id="uploadErr" class="notice"><?php echo $errors['upload']; ?></p>
            </div>
            <div id="buttonHolder">
                <button type="submit" name="submit">submit</button>
            </div>
        </form>

<?php include('template/admin_footer.php'); ?>  