<?php 

    // All functions goes here

    function startSession() {
        session_start();
    }

    function comfirm_user() {
        return isset($_SESSION['id']);
    }

    function comfirm_user_logged_in($new_location) {
        if (!comfirm_user()) {
            header('location:' . $new_location);
        }
    }

    function escape_string($db_conn, $escape) {
        return mysqli_real_escape_string($db_conn, $escape);
    }

?>