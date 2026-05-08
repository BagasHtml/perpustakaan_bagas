<?php

include "../config/koneksi.php";

$halaman_utama = "index.php?admin=user";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_user  = $_POST["nama_user"];
    $username   = $_POST["username"];

    // UPDATE
    if (!empty($_POST["id_user"])) {

        $id_user = $_POST["id_user"];

        if (!empty($_POST["password"])) {
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            mysqli_query($db, "UPDATE tbl_user SET 
                nama_user='$nama_user',
                username='$username',
                password='$password'
                WHERE id_user='$id_user'
            ");
        } else {
            mysqli_query($db, "UPDATE tbl_user SET 
                nama_user='$nama_user',
                username='$username'
                WHERE id_user='$id_user'
            ");
        }

        echo "<script>alert('User berhasil diupdate');window.location='index.php?admin=user';</script>";
        exit();

    } else {

        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        mysqli_query($db, "INSERT INTO tbl_user (nama_user, username, password, create_at)
            VALUES ('$nama_user','$username','$password',NOW())
        ");

        echo "<script>alert('User berhasil ditambah');window.location='index.php?admin=user';</script>";
        exit();
    }
}

if (isset($_GET["hapus"])) {
    $id = $_GET["hapus"];

    mysqli_query($db, "DELETE FROM tbl_user WHERE id_user='$id'");

    echo "<script>alert('User berhasil dihapus');window.location='index.php?admin=user';</script>";
    exit();
}

$editMode = false;
$editData = null;

if (isset($_GET["edit"])) {
    $id_edit = $_GET["edit"];
    $editMode = true;

    $q = mysqli_query($db, "SELECT * FROM tbl_user WHERE id_user='$id_edit'");
    $editData = mysqli_fetch_object($q);
}

if (isset($_GET['cari'])) {
    $keyword = $_GET['keyword'];

    $sql = "SELECT * FROM tbl_user 
            WHERE nama_user LIKE '%$keyword%' 
            OR username LIKE '%$keyword%'";
} else {
    $sql = "SELECT * FROM tbl_user";
}

$result = mysqli_query($db, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>CRUD User</title>
<link rel="stylesheet" href="../css/user.css">
</head>

<body>
<h2><a href="index.php?admin=user"> Dashboard User</a> | <a href="../index.php">Home</a> </h2>
<hr>
<br>

<div class="container-user">

    <div class="form-user">
        <h3><?= $editMode ? 'Edit User' : 'Tambah User' ?></h3>

        <form action="index.php?admin=user" method="POST">
            <input type="hidden" name="id_user" value="<?= $editMode ? $editData->id_user : '' ?>">

            <label>Nama User</label>
            <input type="text" name="nama_user"
                   value="<?= $editMode ? $editData->nama_user : '' ?>" required>

            <label>Username</label>
            <input type="text" name="username"
                   value="<?= $editMode ? $editData->username : '' ?>" required>

            <label>Password <?= $editMode ? '(kosongkan jika tidak diubah)' : '' ?></label>
            <input type="password" name="password" <?= $editMode ? '' : 'required' ?>>

            <button type="submit">
                <?= $editMode ? 'Update User' : 'Tambah User' ?>
            </button>
        </form>
    </div>

    <div class="view-user">
        <h3>Data User</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_object($result)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_user ?></td>
                    <td><?= $row->username ?></td>
                    <td>******</td>
                    <td><?= $row->create_at ?></td>
                    <td>
                        <a href="index.php?admin=user&edit=<?= $row->id_user ?>" class="edit">Edit</a>
                        <a href="index.php?admin=user&hapus=<?= $row->id_user ?>" 
                           onclick="return confirm('Hapus user?')" class="delete">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html> 