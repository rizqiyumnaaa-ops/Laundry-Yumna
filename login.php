<?php
// start the session
session_start();

// check POST variable from FORM
if (isset($_POST['login'])) {

    // call connection
    include "conection.php";

    // make the query based on username
    $query = "SELECT * FROM pengguna WHERE username='" . $_POST['username'] . "'";

    // run the query
    $login = mysqli_query($db_conection, $query);

    // check if the username found or not
    if (mysqli_num_rows($login) > 0) {

        // if user found, extract the data
        $user = mysqli_fetch_assoc($login);

        // verify the password
        if (password_verify($_POST['password'], $user['password'])) {

            // if password match, then make session variable
            $_SESSION['login'] = TRUE;
            $_SESSION['userid'] = $user['id_pengguna'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['fullname'] = $user['full_name'];
            $_SESSION['photo'] = $user['photo'];

            // success login msg
            echo "<script>alert('Login success !');window.location.replace('index.php');</script>";

        } else {
            // password did not match
            // wrong password msg then redirect to login form
            echo "<script>alert('Login failed, wrong password !');window.location.replace('form_login.php');</script>";
        }

    } else {
        // user not found
        // login failed msg then redirect to login form
        echo "<script>alert('Login failed, user not found !');window.location.replace('form_login.php');</script>";
    }
}

?>