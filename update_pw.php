<?php
    session_start(); // start the session

    if (isset($_POST['change'])) { // check variable POST from FORM
        // include connection_240032.php
        include "conection.php"; // call connection

        // encrypt the new password
        $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        // make query for update password
        $query="UPDATE pengguna SET password='$password' WHERE id_pengguna='$_SESSION[userid]'";

        // run the query
        $update=mysqli_query($db_conection, $query);

        // check query result TRUE/success
        if($update) {
            $_SESSION['password'] = $password; // update data session if success
            // success msg
            echo "<script>alert('Change password succeeded !');window.location.replace('index.php');</script>";
        } else {
            // failed msg
            echo "<script>alert('Change password failed !');window.location.replace('change_password_240032.php');</script>";
        }
    }
?>