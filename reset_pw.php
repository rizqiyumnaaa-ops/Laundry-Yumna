<?php
    if (isset($_POST ['save'])) { // check variable POST from FORM
        include "conection.php"; // call connection php MYSQL

        // create default password
        $password = password_hash($_POST['role'], PASSWORD_DEFAULT);

        // sql query INSERT INTO values
        $query = "INSERT INTO pengguna (username, password, role, full_name) VALUES ('$_POST[username]', '$password',
        '$_POST[role]', '$_POST[full_name]')"; 

        // run query
        $create = mysqli_query($db_conection, $query); // make a sql query

        if ($create) { // check if query TRUE/success
            // success msg (html version)
            echo "<p>User added succesfully !</p>";
            // success msg (javascript version)
            echo "<script> alert('User added succesfully !'); </script>";
        } else {
            // fail msg (html version)
            echo "<p>User added failed !</p>"; 
            // fail msg (javascript version)
            echo "<script> alert('User added failed !'); </script>";
        }
    }
?>
<p><a href="read_user.php">BACK TO PETS LIST</a></p>
<script>window.location.replace("read_user.php");</script>