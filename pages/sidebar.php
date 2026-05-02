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
            <div class="sidebar">
                <h1>MENU</h1>
                <a href="index.php?admin=dashboard">Dashboard</a> <br>
                <a href="index.php?admin=user">Data User</a> <br>
                <a href="index.php?admin=buku">Data Buku</a> <br>
            </div>
        </section>

        <section>
            <div class="user">
                <h2>Halo! <?= $_SESSION['nama_user'] ?></h2>
                <form action="auth/logout.php" method="post">
                    <button type="submit" name="logout">
                        Logout
                    </button>
                </form>
            </div>
        </section>
    </div>
</body>
</html>