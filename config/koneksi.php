<?php

$local = "localhost";
$username = "root";
$password = "";
$dbname = "perpustakaan_bagas";

$db = new mysqli($local, $username, $password, $dbname);

if ($db->connect_error) {
    die("KONEKSI ERROR" . $db->connect_error);
    exit();
}