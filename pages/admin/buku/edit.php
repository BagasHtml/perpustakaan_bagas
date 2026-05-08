<?php
include '../config/koneksi.php';

$que = "SELECT * FROM tbl_buku";
$result = $db->query($que);
$no = 1;

$id_buku = $_GET['id_buku'];
$queEdit = "SELECT * FROM tbl_buku WHERE id_buku = '$id_buku'";
$resulltEdit = $db->query($queEdit);
$row = $resulltEdit->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['judul_buku']))
    {
        $judulBuku = $_POST['judul_buku'];
        $pengarangBuku = $_POST['pengaramg_buku'];
        $penerbitBuku = $_POST['penerbit_buku'];
        $tahun = $_POST['tahun'];
        $gambar_lama = $_POST['gambar_lama'];

        $path = 'assets/';
        $gambar_baru = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];

        if (!empty($gambar_baru)) {
            move_uploaded_file($tmp_file, $path . $gambar_baru);
            $gambar_fix = $gambar_baru;
        } else {
            $gambar_fix = $gambar_lama;
        }

        $que = "UPDATE tbl_buku SET judul_buku = '$judulBuku', pengarang_buku = '$pengarangBuku', penerbit_buku = '$penerbitBuku', tahun = '$tahun', gambar = '$gambar_fix' WHERE id_buku = '$id_buku'";

        if ($db->query($que)) {
            echo '<script>
            window.alert("Berhasil mengedit data!");
            window.location.href = "index.php?admin=buku";
            </script>';
        }
    }
}

$search = "";

if (isset($_GET['keyword'])) {
    $search = $_GET['keyword'];
}

$que = "SELECT * FROM tbl_buku WHERE judul_buku LIKE '%$search%' OR pengarang_buku LIKE '%$search%' OR penerbit_buku LIKE '%$search%'";
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
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>" id="">

                    <h1>Tambah Buku</h1>
                    <label for="">Judul Buku</label><br>
                    <input type="text" name="judul_buku" value="<?= $row['judul_buku'] ?>" required />
                    <br><br>

                    <label for="">Pengarang</label><br>
                    <input type="text" name="pengarang_buku" value="<?= $row['pengarang_buku'] ?>" required />
                    <br><br>

                    <label for="">Penerbit</label><br>
                    <input type="text" name="penerbit_buku" value="<?= $row['penerbit_buku'] ?>" required />
                    <br><br>

                    <label for="">Tahun</label><br>
                    <input type="text" name="tahun" value="<?= $row['tahun'] ?>" required />
                    <br><br>

                    <label for="">Cover Buku lama</label><br>
                    <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>" id="">
                    <img src="assets/<?= $row['gambar'] ?>" width="150px" alt="">
                    <input type="file" name="gambar" />
                    <br><br>

                    <input type="submit" value="Edit Buku">
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