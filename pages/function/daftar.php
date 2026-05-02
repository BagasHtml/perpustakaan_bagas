<?php
session_start();
include '../../config/koneksi.php';

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
            window.alert("Yey Register Berhasil!");
            window.location.href = "../auth/login.php";
            </script>';
        }
    }
}