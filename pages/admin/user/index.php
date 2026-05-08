<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama_user = $_POST['nama_user'];
    $username = $_POST['username'];

    if (!empty($_POST['id_user'])) {
        $id_user = $_POST['id_user'];

        if (!empty($_POST['password'])) {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            mysqli_query($db, "UPDATE tbl_user SET 
            nama_user = '$nama_user',
            username = '$username',
            password = '$password'
            WHERE id_user = '$id_user'
            ");
        } else {
            mysqli_query($db, "UPDATE tbl_user SET 
            nama_user = '$nama_user',
            username = '$username'
            WHERE id_user = '$id_user'"
            );
        }

        echo "<script>
        window.alert('berhasil update data user');
        window.location.href = 'index.php?admin=user;
        </script>";
        exit();

    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        mysqli_query($db, "INSERT INTO tbl_user (nama_user, username, password, create_at) VALUES ('$nama_user', '$username', '$password', NOW())");

        echo '<script>
        window.alert("berhasil menambahkan data user");
        window.location.href = "index.php?admin=user";
        </script>';
        exit();
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    mysqli_query($db, "DELETE FROM tbl_user WHERE id_user = '$id'");

    echo "<script>
        window.alert('berhasil menghapus data user');
        window.location.href = 'index.php?admin=user;
        </script>";
        exit();
}

$editMode = false;
$editData = null;

if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $editMode = true;
    $que = mysqli_query($db, "SELECT * FROM tbl_user WHERE id_user ='$id_edit'");
    $editData = mysqli_fetch_object($que);
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
    <title>Document</title>
</head>
<body>
    <h2><a href="index.php?admin=user"> Dashboard User</a> | <a href="index.php">Home</a></h2>

    <hr>
    <br>

    <div class="container-user">
        <h3><?= $editMode ? 'Edit User' : 'Tambah User' ?></h3>

        <form action="index.php?admin=user" method="post">
            <input type="hidden" name="id_user" value="<?= $editMode ? $editData->id_user : '' ?>" id="">

            <label for="">Nama User</label><br>
            <input type="text" name="nama_user" value="<?= $editMode ? $editData->nama_user : '' ?>" required />
            <br><br>

            <label for="">Username</label> <br>
            <input type="text" name="username" value="<?= $editMode ? $editData->username : '' ?>" required />
            <br><br>

            <label for="">Password <?= $editMode ? '(Kosongkan jika diubah)' : '' ?></label> <br>
            <input type="password" name="password" value="<?= $editMode ? '' : 'required' ?>" id="">

            <button type="Submit">
                Add
            </button>
        </form>

        <br>

        <table>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_object($result)) { ?> 
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama_user ?></td>
                        <td><?= $row->username ?></td>
                        <td><?= $row->password ?></td>
                        <td><?= $row->create_at ?></td>
                        <td>
                            <a href="index.php?admin=user&edit=<?= $row->id_user ?>" class="edit">Edit</a>
                            <a href="index.php?admin=user&hapus=<?= $row->id_user ?>" class="delete"
                            onclick="return confirm('hapus user')">
                            Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>