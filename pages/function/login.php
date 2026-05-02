<?php
session_start();
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    if (isset($_POST['username']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $que = "SELECT * FROM tbl_user WHERE username = '$username'";
        $result = $db->query($que);
        $row = $result->fetch_assoc();

        if ($password === $row['password']) 
        {
            $_SESSION['sudahLogin'] = true;
            $_SESSION['nama_user'] = $row['nama_user'];
            
            echo '<script>
            window.alert("berhasil login!, selamat datang!");
            window.location.href = "../index.php";
            </script>';
        } else {
            echo '<script>
            window.alert("Password salah!");
            history.back();
            </script>';
        }
    } else {
        echo '<script>
            window.alert("Username salah!");
            history.back();
            </script>';
    }
}