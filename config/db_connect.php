<?php

    #connect to database
    $conn = mysqli_connect('localhost', 'justice', '123456789', 'extorex');

    #check connection
    if (!$conn) {
        die('conection error' . mysqli_connect_error($conn));
    }


?>