<?php
session_start();
if(isset($_POST['upload'])) { // check variable POST from FORM
    include "conection.php"; // call connection

    $folder = 'upload/user/'; // target folder for upload
    if(move_uploaded_file($_FILES['new_photo']['tmp_name'], $folder . $_FILES['new_photo']['name'])) {

        // success upload, get the photo name
        $photo = $_FILES['new_photo']['name'];

        // make query for update photo
        $query = "UPDATE pengguna SET photo='$photo' WHERE id_pengguna='$_SESSION[userid]'";

        // run the query
        $upload = mysqli_query($db_conection,$query);

        if($upload) { // check query result TRUE/success
            if($_POST['photo'] !== 'default.png') unlink($folder . $_POST['photo']); // delete old photo

            // update session photo
            $_SESSION['photo'] = $photo;

            // success msg
            echo "<script>alert('Change photo successed !'); window.location.replace('index.php'); </script>";
        } else {
            // failed msg
            echo "<script>alert('Change photo failed !'); window.location.replace('user_photo.php?id=$_POST[id_pengguna]');</script>";
        }
    // failed upload
    } else {
        echo "<script>alert('Upload photo failed !'); window.location.replace('user_photo.php?id=$_POST[id_pengguna]');</script>";
    }
}
?>