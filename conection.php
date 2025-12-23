<?php
    $db_host="localhost";
    $db_username= "root";
    $db_password= "";
    $db_name="laundry_db";

    $db_conection = mysqli_connect($db_host,$db_username,$db_password,) or die;

    mysqli_select_db($db_conection,$db_name);
?>