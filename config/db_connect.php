<?php

    include('constanst.php');
    #connect to database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    #check connection
    if (!$conn) {
        die('conection error' . mysqli_connect_error($conn));
    }


?>