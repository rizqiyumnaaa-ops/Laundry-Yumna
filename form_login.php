<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
</head>
<body>

    <div class="overlay-gambar"></div>

    <div class="container">
        
        <div class="bagian-kiri">
            <div class="login-box">
                <h2>LOGIN</h2>
                
                <form method="post" action="login.php">
                    <label>Username</label>
                    <input type="text" name="username" required>

                    <label>Password</label>
                    <input type="password" name="password" id="pass" required>

                    <div class="checkbox-container">
                        <input type="checkbox" id="chk-show" onclick="show()">
                        <label for="chk-show" style="margin-bottom: 0; cursor:pointer;">Show Password</label>
                    </div>

                    <div class="tombol-container">
                        <input type="submit" name="login" value="LOG IN" class="btn-login">
                        <input type="reset" name="reset" value="RESET" class="btn-reset">
                    </div>
                </form>
            </div>
        </div>

        <div class="bagian-kanan">
            <div class="text-welcome">
                <p class="script-font">Welcome To</p>
                <h1>YUMNA<br>LAUNDRY</h1>
            </div>
        </div>

    </div>

    <script>
    function show() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>

</body>
</html>