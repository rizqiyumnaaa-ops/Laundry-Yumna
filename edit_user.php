<!DOCTYPE html>
<html>
<head>
    <title>Yumna Laundry</title>
</head>
<body>
    <h1>Yumna Laundry</h1>
    <h3>Form Edit User</h3>
    <?php
        include "conection.php";

        $query= "SELECT * FROM pengguna WHERE id_pengguna='$_GET[id]'";

        $users=mysqli_query($db_conection,$query);

        $data=mysqli_fetch_assoc($users);
    ?>
    <form method="post" action="update_user.php">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" value="<?=$data ['username'] ?>" required></td>
        </tr>
        <tr>
            <td>User Type</td>
            <td>
                <input type="radio" name="role" value="kasir" <?=($data['role']=='kasir')?'checked':''?> required> Kasir |
                <input type="radio" name="role" value="owner" <?=($data['role']=='owner')?'checked':''?> required> Owner
            </td>
        </tr>
         <tr>
            <td>Full Name</td>
            <td><input type="text" name="full_name" value="<?=$data ['full_name'] ?>" required></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="save" value="save">
                <input type="reset" name="reset" value="reset">
                <input type="hidden" name="id_pengguna" value="<?=$data ['id_pengguna'] ?>">
            </td>
        </tr>
    </table>
    </form>
    <p><a href="read_user.php">Cancel</a></p>
</body>
</html>