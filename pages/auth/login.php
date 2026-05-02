<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
        <section>
            <div class="header">
                <img src="../assets/logo2.png" alt="">
                <h1>Masuk User</h1>
                <h2>Masukan Username dan Password dengan benar</h2>
            </div>
        </section>

        <section>
            <div>
                <form action="../function/login.php" method="post">
                    <label for="">Username</label> <br>
                    <input type="text" name="username" placeholder="username" require />
                    <br><br>

                    <label for="">Password</label> <br>
                    <input type="password" name="password" placeholder="password" require />
                    <br><br>

                    <input type="submit" value="Login">
                </form>

                <p>Belum memiliki akun?</p>
                <a href="daftar.php">Daftar Akun</a>
            </div>
        </section>
    </div>
</body>
</html>