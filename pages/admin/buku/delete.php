
<?php
include '../config/koneksi.php';

$que = "SELECT * FROM tbl_buku";
$result = $db->query($que);
$no = 1;

if ($_GET['admin'] && $_GET['admin'] == 'delete_buku') {
    $id_buku = $_GET['id_buku'];
    $que = "DELETE FROM tbl_buku WHERE id_buku = '$id_buku'";
    
    if ($db->query($que)) {
            echo '<script>
            window.alert("Berhasil menghapus data!");
            window.location.href = "index.php?admin=buku";
            </script>';
    }
}
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
            <div class="form">
                <form action="" method="post" enctype="multipart/form-data">
                    <h1>Tambah Buku</h1>
                    <label for="">Judul Buku</label><br>
                    <input type="text" name="judul_buku" placeholder="Nama Lengkap" required />
                    <br><br>

                    <label for="">Pengarang</label><br>
                    <input type="text" name="pengarang_buku" placeholder="Username" required />
                    <br><br>

                    <label for="">Penerbit</label><br>
                    <input type="text" name="penerbit_buku" placeholder="Penerbit" required />
                    <br><br>

                    <label for="">Tahun</label><br>
                    <input type="text" name="tahun" placeholder="Tahun" required />
                    <br><br>

                    <label for="">Penerbit</label><br>
                    <input type="file" name="gambar" />
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
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $r): ?> 
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['judul_buku'] ?></td>
                            <td><?= $r['pengarang_buku'] ?></td>
                            <td><?= $r['penerbit_buku'] ?></td>
                            <td><?= $r['tahun'] ?></td>
                            <td><img src="assets/<?= $r['gambar'] ?>" width="150" alt=""></td>
                            <td>
                                <a href="index.php?admin=edit_buku&id_buku=<?= $r['id_buku'] ?>">Edit</a>
                                <a href="index.php?admin=delete_buku&id_buku=<?= $r['id_buku'] ?>">Delete</a>
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