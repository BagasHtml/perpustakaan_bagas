<?php
include '../config/koneksi.php';

$que = "SELECT * FROM tbl_user";
$result = $db->query($que);
$no = 1;

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['nama_user']))
    {
        $nama_user = $_POST['nama_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $que = "INSERT INTO tbl_user (nama_user, username, password, create_at) VALUES ('$nama_user','$username', '$password', NOW())";
        
        if ($db->query($que)) {
            echo '<script>
            window.alert("Berhasil menambahkan data!");
            window.location.href = "index.php?admin=user";
            </script>';
        }
    }
}

$search = "";

if (isset($_GET['keyword'])) {
    $search = $_GET['keyword'];
}

$que = "SELECT * FROM tbl_user WHERE nama_user LIKE '%$search%' OR username LIKE '%$search%'";

$result = $db->query($que);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
</head>
<body>
    <div class="wrapper">
        <section>
            <div class="search">
                <form action="" method="get">
                    <input type="hidden" name="admin" value="user" id="">
                    <input type="text" name="keyword"  id="">
                    <button type="submit">Search</button>
                </form>
            </div>
        </section>

        <section>
            <div class="form">
                <form action="" method="post">
                    <h1>Tambah User</h1>
                    <label for="">Nama Lengkap</label><br>
                    <input type="text" name="nama_user" placeholder="Nama Lengkap" required />
                    <br><br>

                    <label for="">Username</label><br>
                    <input type="text" name="username" placeholder="Username" required />
                    <br><br>

                    <label for="">Password</label><br>
                    <input type="text" name="password" placeholder="Password" required />
                    <br><br>

                    <input type="submit" value="Add User">
                </form>
            </div>
        </section>

        <section>
            <div class="tbl-user">
                <table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Create At</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $r): ?> 
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['nama_user'] ?></td>
                            <td><?= $r['username'] ?></td>
                            <td><?= $r['password'] ?></td>
                            <td><?= $r['create_at'] ?></td>
                            <td>
                                <a href="index.php?admin=edit_user&id_user=<?= $r['id_user'] ?>">Edit</a>
                                <a href="index.php?admin=delete_user&id_user=<?= $r['id_user'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>